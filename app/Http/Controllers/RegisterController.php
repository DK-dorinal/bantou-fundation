<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Handle form submission for all types (donation, membership, volunteer, partnership)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        try {
            // Valider les champs communs de base (tous optionnels)
            $validatedData = $request->validate([
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'profession' => 'nullable|string|max:255',
                'nom' => 'nullable|string|max:255',
                'prenom' => 'nullable|string|max:255',
                'donation_amount' => 'nullable|numeric',
                'anonymous_donor' => 'nullable|boolean',
                'is_anonymous' => 'nullable|boolean',
                'message' => 'nullable|string',
                'payment_method' => 'nullable|string|max:50',

                // Fichiers
                'id_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            // Déterminer le type de formulaire
            $formType = $this->getFormType($request);

            // Préparer les données utilisateur
            $userData = $this->prepareUserData($request, $formType);

            // Vérifier si c'est un don anonyme
            $isAnonymousDonation = $request->boolean('anonymous_donor') || $request->boolean('is_anonymous');

            // Pour un don anonyme, on ne vérifie pas l'email
            if ($isAnonymousDonation && $formType === 'donation') {
                // Créer un email unique pour le donateur anonyme
                $anonymousEmail = 'anonymous_' . uniqid() . '_' . time() . '@donation.bantou-foundation.org';
                $userData['email'] = $anonymousEmail;
                $userData['is_anonymous'] = true;

                // Créer l'utilisateur anonyme
                $userData['password'] = Hash::make(Str::random(32));
                $userData['email_verified_at'] = now();
                $user = User::create($userData);
                $message = 'Merci pour votre don anonyme ! Votre générosité fait la différence.';

                // Connexion automatique pour les utilisateurs anonymes
                auth()->login($user);

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'redirect' => route('user_dashboard'),
                    'user' => $user,
                    'form_type' => $formType,
                    'is_anonymous' => true
                ], 201);
            }

            // Pour les cas non anonymes, vérifier l'email si fourni
            $user = null;
            $emailProvided = $request->filled('email') && !empty($request->email);

            if ($emailProvided) {
                $user = User::where('email', $request->email)->first();
            }

            // Gérer les fichiers
            if ($request->hasFile('id_document')) {
                $userData['id_document'] = $this->uploadFile($request->file('id_document'), 'documents/id');
            }

            if ($request->hasFile('attachment')) {
                $userData['attachment'] = $this->uploadFile($request->file('attachment'), 'documents/partnership');
            }

            // Créer ou mettre à jour l'utilisateur
            if ($user) {
                $user->update($userData);
                $message = 'Vos informations ont été mises à jour avec succès !';
            } else {
                $userData['password'] = Hash::make(Str::random(16));
                $userData['email_verified_at'] = now();

                // Si pas d'email fourni, créer un email temporaire
                if (!$emailProvided) {
                    $userData['email'] = 'temp_' . uniqid() . '_' . time() . '@temp.bantou-foundation.org';
                }

                $user = User::create($userData);
                $message = 'Votre inscription a été enregistrée avec succès !';
            }

            // Connexion automatique de l'utilisateur
            auth()->login($user);

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('user_dashboard'),
                'user' => $user,
                'form_type' => $formType
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Prepare user data based on form type
     *
     * @param Request $request
     * @param string $formType
     * @return array
     */
    private function prepareUserData(Request $request, $formType)
    {
        $userData = [];

        // Champs communs
        if ($request->filled('email')) {
            $userData['email'] = $request->email;
        }

        if ($request->filled('phone')) {
            $userData['phone'] = $request->phone;
        }

        if ($request->filled('address')) {
            $userData['address'] = $request->address;
        }

        if ($request->filled('latitude')) {
            $userData['latitude'] = $request->latitude;
        }

        if ($request->filled('longitude')) {
            $userData['longitude'] = $request->longitude;
        }

        if ($request->filled('profession')) {
            $userData['profession'] = $request->profession;
        }

        // Gestion du nom
        if ($request->filled('full_name')) {
            $userData['name'] = $request->full_name;
        } elseif ($request->filled('nom') && $request->filled('prenom')) {
            $userData['name'] = trim($request->prenom . ' ' . $request->nom);
        } elseif ($request->filled('nom')) {
            $userData['name'] = $request->nom;
        } elseif ($request->filled('prenom')) {
            $userData['name'] = $request->prenom;
        } elseif ($request->filled('contact_name')) {
            $userData['name'] = $request->contact_name;
        }

        // Ajouter le rôle
        $userData['role'] = $this->getRoleFromFormType($formType);

        // Ajouter les données spécifiques au formulaire
        switch ($formType) {
            case 'membership':
                $userData = array_merge($userData, $this->getMembershipData($request));
                break;
            case 'volunteer':
                $userData = array_merge($userData, $this->getVolunteerData($request));
                break;
            case 'donation':
                $userData = array_merge($userData, $this->getDonationData($request));
                break;
            case 'partnership':
                $userData = array_merge($userData, $this->getPartnershipData($request));
                break;
        }

        return $userData;
    }

    /**
     * Get data specific to membership form
     */
    private function getMembershipData(Request $request)
    {
        $data = [];

        if ($request->filled('birth_date')) {
            $data['birth_date'] = $request->birth_date;
        }

        if ($request->filled('gender')) {
            $data['gender'] = $request->gender;
        }

        if ($request->filled('motivation')) {
            $data['motivation'] = $request->motivation;
        }

        if ($request->filled('expertise_areas')) {
            $expertiseAreas = $request->expertise_areas;
            if (is_string($expertiseAreas)) {
                $expertiseAreas = explode(',', $expertiseAreas);
            }
            $data['expertise_areas'] = $expertiseAreas;
        }

        if ($request->filled('membership_type')) {
            $data['membership_type'] = $request->membership_type;
        }

        if ($request->filled('commitment')) {
            $data['is_active'] = true;
        }

        return $data;
    }

    /**
     * Get data specific to volunteer form
     */
    private function getVolunteerData(Request $request)
    {
        $data = [];

        if ($request->filled('age')) {
            $birthYear = date('Y') - (int)$request->age;
            $data['birth_date'] = $birthYear . '-01-01';
        }

        if ($request->filled('city')) {
            $data['address'] = $request->city;
        }

        if ($request->filled('country')) {
            $data['address'] = isset($data['address'])
                ? $data['address'] . ', ' . $request->country
                : $request->country;
        }

        if ($request->has('interests')) {
            $data['interests'] = $request->interests;
        }

        if ($request->has('skills')) {
            $data['skills'] = $request->skills;
        }

        if ($request->filled('experience')) {
            $data['experience'] = $request->experience;
        }

        if ($request->filled('languages')) {
            $data['languages'] = $request->languages;
        }

        if ($request->filled('availability')) {
            $data['availability'] = $request->availability;
        }

        if ($request->filled('engagement')) {
            $data['engagement'] = $request->engagement;
        }

        if ($request->filled('duration')) {
            $data['duration'] = $request->duration;
        }

        if ($request->filled('motivation')) {
            $data['motivation'] = $request->motivation;
        }

        if ($request->filled('expectations')) {
            $data['expectations'] = $request->expectations;
        }

        return $data;
    }

    /**
     * Get data specific to donation form
     */
    private function getDonationData(Request $request)
    {
        $data = [];

        // Don anonyme
        $isAnonymous = $request->boolean('anonymous_donor') || $request->boolean('is_anonymous');
        $data['is_anonymous'] = $isAnonymous;

        // Montant du don
        if ($request->filled('donation_amount')) {
            $data['donation_total'] = $request->donation_amount;
        }

        // Message
        if ($request->filled('message')) {
            $data['message'] = $request->message;
        }

        // Mode de paiement
        if ($request->filled('payment_method')) {
            $data['payment_method'] = $request->payment_method;
        }

        return $data;
    }

    /**
     * Get data specific to partnership form
     */
    private function getPartnershipData(Request $request)
    {
        $data = [];

        if ($request->filled('organization_name')) {
            $data['organization_name'] = $request->organization_name;
        }

        if ($request->filled('sector')) {
            $data['sector'] = $request->sector;
        }

        if ($request->filled('contact_name')) {
            $data['contact_name'] = $request->contact_name;
        }

        if ($request->filled('position')) {
            $data['position'] = $request->position;
        }

        if ($request->filled('city_country')) {
            $data['city_country'] = $request->city_country;
            $data['address'] = $request->city_country;
        }

        if ($request->filled('partnership_type')) {
            $data['partnership_type'] = $request->partnership_type;
        }

        if ($request->filled('message')) {
            $data['message'] = $request->message;
        }

        if ($request->filled('other_partnership_type')) {
            $data['partnership_type'] = $request->other_partnership_type;
        }

        return $data;
    }

    /**
     * Determine the form type from request
     */
    private function getFormType(Request $request)
    {
        if ($request->has('donation_amount') || $request->has('anonymous_donor') || $request->has('payment_method')) {
            return 'donation';
        }

        if ($request->has('membership_type') || $request->has('expertise_areas') || $request->has('commitment')) {
            return 'membership';
        }

        if ($request->has('interests') || $request->has('skills') || $request->has('availability')) {
            return 'volunteer';
        }

        if ($request->has('organization_name') || $request->has('sector') || $request->has('partnership_type')) {
            return 'partnership';
        }

        return 'membership';
    }

    /**
     * Get role from form type
     */
    private function getRoleFromFormType($formType)
    {
        $roles = [
            'membership' => 'adherent',
            'volunteer' => 'benevole',
            'donation' => 'donateur',
            'partnership' => 'partenaire',
        ];

        return $roles[$formType] ?? 'benevole';
    }

    /**
     * Upload file to storage
     */
    private function uploadFile($file, $path)
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');
        return $filePath;
    }

    /**
     * Get all submissions (for admin)
     */
    public function getAllSubmissions(Request $request)
    {
        $role = $request->get('role');
        $query = User::query();

        if ($role && in_array($role, ['donateur', 'adherent', 'partenaire', 'benevole', 'admin'])) {
            $query->where('role', $role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Get single submission
     */
    public function getSubmission($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Update submission status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        $user->is_active = $request->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès',
            'data' => $user
        ]);
    }
}
