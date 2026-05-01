<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordlessToken;
use App\Mail\PasswordlessLoginMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Afficher la page de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Afficher la page d'inscription
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'remember' => 'nullable|boolean'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirection selon le rôle
            if ($user->role === 'admin') {
                return redirect()->route('admin.submissions');
            }

            return redirect()->intended(route('user_dashboard'))->with('success', 'Bienvenue ' . $user->name . ' !');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Traiter l'inscription
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'accept_terms' => 'required|accepted'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'benevole', // Rôle par défaut
            'is_active' => true
        ]);

        Auth::login($user);

        return redirect()->route('user_dashboard')->with('success', 'Bienvenue ' . $user->name . ' ! Votre compte a été créé avec succès.');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * Afficher le formulaire de demande de réinitialisation
     */
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    /**
     * Envoyer le lien de réinitialisation
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Un lien de réinitialisation a été envoyé à votre adresse email.'])
            : back()->withErrors(['email' => 'Impossible d\'envoyer le lien de réinitialisation.']);
    }

    /**
     * Afficher le formulaire de réinitialisation
     */
    public function showResetForm($token)
    {
        return view('auth.reset', ['token' => $token]);
    }

    /**
     * Réinitialiser le mot de passe
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé avec succès.')
            : back()->withErrors(['email' => 'Impossible de réinitialiser le mot de passe.']);
    }

    // =============================================
    // MÉTHODES OTP (CONNEXION SANS MOT DE PASSE)
    // =============================================

    /**
     * Envoi du code OTP par email (Magic Link)
     */
    public function sendMagicCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Limiter les tentatives (10 par heure)
        $recentAttempts = PasswordlessToken::where('email', $email)
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentAttempts >= 10) {
            return response()->json([
                'success' => false,
                'message' => 'Trop de tentatives. Veuillez réessayer dans une heure.'
            ], 429);
        }

        // Générer un code à 6 chiffres
        $code = sprintf("%06d", random_int(100000, 999999));

        // Nettoyer les anciens tokens
        PasswordlessToken::where('email', $email)
            ->where(function($q) {
                $q->where('expires_at', '<', Carbon::now())
                  ->orWhere('is_used', true);
            })->delete();

        // Créer le token
        $token = PasswordlessToken::create([
            'email' => $email,
            'token' => Hash::make($code),
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_used' => false,
            'attempts' => 0
        ]);

        // Envoyer l'email
        try {
            Mail::to($email)->send(new PasswordlessLoginMail($code, 10));
        } catch (\Exception $e) {
            $token->delete();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email. Veuillez réessayer.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Un code de validation a été envoyé à votre adresse email.'
        ]);
    }

    /**
     * Vérification du code OTP et connexion
     */
    public function verifyMagicCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $email = $request->email;

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email requis. Veuillez recommencer.'
            ], 401);
        }

        // Récupérer le token valide
        $token = PasswordlessToken::where('email', $email)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun code valide trouvé. Veuillez demander un nouveau code.'
            ], 401);
        }

        // Vérifier les tentatives (max 5)
        if ($token->attempts >= 5) {
            $token->update(['is_used' => true]);
            return response()->json([
                'success' => false,
                'message' => 'Trop de tentatives. Veuillez demander un nouveau code.'
            ], 401);
        }

        // Vérifier le code
        if (!Hash::check($request->code, $token->token)) {
            $token->increment('attempts');
            $remaining = 5 - $token->attempts;
            return response()->json([
                'success' => false,
                'message' => "Code invalide. Il vous reste {$remaining} tentative" . ($remaining > 1 ? 's' : '') . "."
            ], 401);
        }

        // Code valide
        $token->update(['is_used' => true, 'attempts' => 0]);

        // Créer ou récupérer l'utilisateur
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => explode('@', $email)[0],
                'password' => Hash::make(Str::random(32)),
                'role' => User::ROLE_BENEVOLE,
                'is_active' => true
            ]
        );

        // Connecter l'utilisateur
        Auth::login($user, true);

        // Redirection
        $redirect = $user->isAdmin() ? route('admin.submissions') : route('user_dashboard');

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie !',
            'redirect' => $redirect
        ]);
    }

    /**
     * Renvoyer un nouveau code OTP
     */
    public function resendMagicCode(Request $request)
    {
        $email = $request->email;

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email requis. Veuillez recommencer.'
            ], 401);
        }

        // Limiter les renvois (3 par heure)
        $recentResends = PasswordlessToken::where('email', $email)
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentResends >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Trop de demandes. Veuillez réessayer dans une heure.'
            ], 429);
        }

        // Générer un nouveau code
        $code = sprintf("%06d", random_int(100000, 999999));

        // Invalider l'ancien token
        PasswordlessToken::where('email', $email)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // Créer le nouveau token
        $token = PasswordlessToken::create([
            'email' => $email,
            'token' => Hash::make($code),
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_used' => false,
            'attempts' => 0
        ]);

        // Envoyer l'email
        try {
            Mail::to($email)->send(new PasswordlessLoginMail($code, 10));
        } catch (\Exception $e) {
            $token->delete();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Un nouveau code a été envoyé à votre adresse email.'
        ]);
    }
}
