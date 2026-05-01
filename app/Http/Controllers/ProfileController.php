<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Afficher la page de profil
     */
    public function index()
    {
        $user = Auth::user();

        // Décoder les données JSON si nécessaire
        $user->expertise_areas = $this->decodeJson($user->expertise_areas);
        $user->interests = $this->decodeJson($user->interests);
        $user->skills = $this->decodeJson($user->skills);

        return view('dashboard.profil', compact('user'));
    }

    /**
     * Décoder les données JSON
     */
    private function decodeJson($data)
    {
        if (empty($data)) {
            return [];
        }

        if (is_array($data)) {
            return $data;
        }

        $decoded = json_decode($data, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Mettre à jour les informations personnelles
     */
    public function updatePersonalInfo(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:homme,femme,autre',
            'profession' => 'nullable|string|max:255',
            'motivation' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'motivation' => $request->motivation
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Informations personnelles mises à jour',
            'user' => $user
        ]);
    }

    /**
     * Mettre à jour le numéro de téléphone
     */
    public function updatePhone(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update(['phone' => $request->phone]);

        return response()->json([
            'success' => true,
            'message' => 'Numéro de téléphone mis à jour'
        ]);
    }

    /**
     * Mettre à jour l'adresse
     */
    public function updateAddress(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Adresse mise à jour'
        ]);
    }

    /**
     * Mettre à jour la photo de profil
     */
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Supprimer l'ancien avatar s'il existe
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Stocker le nouvel avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Photo de profil mise à jour',
            'avatar_url' => Storage::url($path)
        ]);
    }

    /**
     * Mettre à jour les domaines d'expertise
     */
    public function updateExpertise(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'expertise_areas' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            'expertise_areas' => json_encode($request->expertise_areas)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Domaines d\'expertise mis à jour'
        ]);
    }

    /**
     * Mettre à jour les centres d'intérêt
     */
    public function updateInterests(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'interests' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            'interests' => json_encode($request->interests)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Centres d\'intérêt mis à jour'
        ]);
    }

    /**
     * Mettre à jour la disponibilité
     */
    public function updateAvailability(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'availability' => 'nullable|in:ponctuel,hebdomadaire,regulier,plein'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update(['availability' => $request->availability]);

        return response()->json([
            'success' => true,
            'message' => 'Disponibilité mise à jour'
        ]);
    }

    /**
     * Supprimer le compte utilisateur
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Vérifier le mot de passe
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Mot de passe incorrect'
            ], 401);
        }

        // Supprimer l'avatar s'il existe
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Déconnecter l'utilisateur
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Votre compte a été supprimé'
        ]);
    }

    /**
     * Télécharger les données de l'utilisateur
     */
    public function downloadData()
    {
        $user = Auth::user();

        $data = [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'birth_date' => $user->birth_date,
                'gender' => $user->gender,
                'profession' => $user->profession,
                'role' => $user->role,
                'membership_type' => $user->membership_type,
                'expertise_areas' => $this->decodeJson($user->expertise_areas),
                'interests' => $this->decodeJson($user->interests),
                'skills' => $this->decodeJson($user->skills),
                'motivation' => $user->motivation,
                'availability' => $user->availability,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ],
            'donations' => $user->donations ?? [],
            'volunteer_applications' => $user->volunteerApplications ?? [],
            'partnership_requests' => $user->partnershipRequests ?? [],
            'membership' => $user->membership ?? null
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $filename = 'user_data_' . $user->id . '_' . now()->format('Ymd_His') . '.json';

        return response($json)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Obtenir les statistiques de l'utilisateur (pour le dashboard)
     */
    public function getStats()
    {
        $user = Auth::user();

        $stats = [
            'donation_count' => $user->donations()->count() ?? 0,
            'donation_total' => $user->donations()->sum('amount') ?? 0,
            'volunteer_hours' => $user->volunteerApplications()->sum('hours') ?? 0,
            'missions_count' => $user->volunteerApplications()->where('status', 'completed')->count() ?? 0,
            'partnership_count' => $user->partnershipRequests()->count() ?? 0,
            'member_since' => $user->created_at ? $user->created_at->format('F Y') : 'N/A',
            'role' => ucfirst($user->role),
            'status' => $user->is_active ? 'Actif' : 'Inactif'
        ];

        return response()->json($stats);
    }

    /**
     * Obtenir l'activité récente (pour le dashboard)
     */
    public function getRecentActivity()
    {
        $user = Auth::user();

        $activities = [];

        // Derniers dons
        foreach ($user->donations()->latest()->take(5)->get() as $donation) {
            $activities[] = [
                'type' => 'donation',
                'title' => 'Don effectué',
                'description' => 'Vous avez fait un don de ' . number_format($donation->amount, 0, ',', ' ') . ' FCFA',
                'date' => $donation->created_at->diffForHumans(),
                'icon' => 'fas fa-heart',
                'icon_color' => 'text-green-500'
            ];
        }

        // Dernières candidatures de bénévolat
        foreach ($user->volunteerApplications()->latest()->take(5)->get() as $application) {
            $activities[] = [
                'type' => 'volunteer',
                'title' => 'Candidature bénévole',
                'description' => 'Vous avez postulé comme bénévole',
                'date' => $application->created_at->diffForHumans(),
                'icon' => 'fas fa-hands-helping',
                'icon_color' => 'text-blue-500'
            ];
        }

        // Dernières demandes de partenariat
        foreach ($user->partnershipRequests()->latest()->take(5)->get() as $partnership) {
            $activities[] = [
                'type' => 'partnership',
                'title' => 'Demande de partenariat',
                'description' => 'Vous avez soumis une demande de partenariat',
                'date' => $partnership->created_at->diffForHumans(),
                'icon' => 'fas fa-handshake',
                'icon_color' => 'text-purple-500'
            ];
        }

        // Trier par date décroissante
        $activities = collect($activities)->sortByDesc(function($activity) {
            return strtotime($activity['date']);
        })->values()->take(10)->toArray();

        return response()->json($activities);
    }
}
