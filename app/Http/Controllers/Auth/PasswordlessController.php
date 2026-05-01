<?php
// app/Http/Controllers/Auth/PasswordlessController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordlessToken;
use App\Mail\PasswordlessLoginMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordlessController extends Controller
{
    /**
     * Afficher le formulaire de demande d'email
     */
    public function showEmailForm()
    {
        return view('auth.passwordless-email');
    }

    /**
     * Afficher le formulaire de saisie du code
     */
    public function showCodeForm(Request $request)
    {
        $email = $request->session()->get('passwordless_email');

        if (!$email) {
            return redirect()->route('passwordless.email');
        }

        return view('auth.passwordless-code', compact('email'));
    }

    /**
     * Envoyer le code OTP par email
     */
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;

        // Limiter le nombre de tentatives par email (10 par heure)
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

        // Nettoyer les anciens tokens non utilisés pour cet email
        PasswordlessToken::where('email', $email)
            ->where(function($q) {
                $q->where('expires_at', '<', Carbon::now())
                  ->orWhere('is_used', true);
            })
            ->delete();

        // Créer le token
        $token = PasswordlessToken::create([
            'email' => $email,
            'token' => Hash::make($code),
            'code' => $code, // Stocké en clair pour DEBUG (à supprimer en production)
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_used' => false,
            'attempts' => 0
        ]);

        // Envoyer l'email
        try {
            Mail::to($email)->send(new PasswordlessLoginMail($code, $email, 10));
        } catch (\Exception $e) {
            // Supprimer le token en cas d'échec d'envoi
            $token->delete();

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email. Veuillez réessayer.'
            ], 500);
        }

        // Stocker l'email en session pour la prochaine étape
        $request->session()->put('passwordless_email', $email);
        $request->session()->put('passwordless_token_id', $token->id);

        return response()->json([
            'success' => true,
            'message' => 'Un code de validation a été envoyé à votre adresse email.',
            'redirect' => route('passwordless.code')
        ]);
    }

    /**
     * Vérifier le code OTP et connecter l'utilisateur
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $email = $request->session()->get('passwordless_email');

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Session expirée. Veuillez recommencer.'
            ], 401);
        }

        // Récupérer le token non utilisé et non expiré
        $token = PasswordlessToken::where('email', $email)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$token) {
            $request->session()->forget(['passwordless_email', 'passwordless_token_id']);

            return response()->json([
                'success' => false,
                'message' => 'Aucun code valide trouvé. Veuillez demander un nouveau code.'
            ], 401);
        }

        // Vérifier le nombre de tentatives (max 5)
        if ($token->attempts >= 5) {
            $token->update(['is_used' => true]);
            $request->session()->forget(['passwordless_email', 'passwordless_token_id']);

            return response()->json([
                'success' => false,
                'message' => 'Trop de tentatives infructueuses. Veuillez demander un nouveau code.'
            ], 401);
        }

        // Vérifier le code
        if (!Hash::check($request->code, $token->token)) {
            $token->increment('attempts');

            $remainingAttempts = 5 - $token->attempts;

            return response()->json([
                'success' => false,
                'message' => "Code invalide. Il vous reste {$remainingAttempts} tentative" . ($remainingAttempts > 1 ? 's' : '') . "."
            ], 401);
        }

        // Code valide - Marquer comme utilisé
        $token->update([
            'is_used' => true,
            'attempts' => 0
        ]);

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

        // Nettoyer la session
        $request->session()->forget(['passwordless_email', 'passwordless_token_id']);

        // Déterminer la redirection
        $redirect = $user->isAdmin() ? route('admin.submissions') : route('user_dashboard');

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie !',
            'redirect' => $redirect
        ]);
    }

    /**
     * Renvoyer un nouveau code
     */
    public function resendCode(Request $request)
    {
        $email = $request->session()->get('passwordless_email');

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Session expirée. Veuillez recommencer.'
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
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_used' => false,
            'attempts' => 0
        ]);

        // Envoyer l'email
        try {
            Mail::to($email)->send(new PasswordlessLoginMail($code, $email, 10));
        } catch (\Exception $e) {
            $token->delete();

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email.'
            ], 500);
        }

        $request->session()->put('passwordless_token_id', $token->id);

        return response()->json([
            'success' => true,
            'message' => 'Un nouveau code a été envoyé à votre adresse email.'
        ]);
    }
}
