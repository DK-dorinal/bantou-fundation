<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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
            // Log de débogage
            Log::info('Soumission formulaire reçue', [
                'form_type' => $this->getFormType($request),
                'all_data' => $request->all()
            ]);

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

            // Pour un don anonyme
            if ($isAnonymousDonation && $formType === 'donation') {
                $anonymousEmail = 'anonymous_' . uniqid() . '_' . time() . '@donation.bantou-foundation.org';
                $userData['email'] = $anonymousEmail;
                $userData['is_anonymous'] = true;
                $userData['password'] = Hash::make(Str::random(32));
                $userData['email_verified_at'] = now();

                $user = User::create($userData);

                // CRÉER LE DON
                $this->createDonationForUser($user, $request);

                auth()->login($user);

                return response()->json([
                    'success' => true,
                    'message' => 'Merci pour votre don anonyme !',
                    'redirect' => route('user_dashboard'),
                    'user' => $user,
                    'form_type' => $formType,
                    'is_anonymous' => true
                ], 201);
            }

            // Pour les utilisateurs normaux
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

                if (!$emailProvided) {
                    $userData['email'] = 'temp_' . uniqid() . '_' . time() . '@temp.bantou-foundation.org';
                }

                $user = User::create($userData);
                $message = 'Votre inscription a été enregistrée avec succès !';
            }

            // CRÉER LE DON uniquement si formulaire de don
            if ($formType === 'donation') {
                $this->createDonationForUser($user, $request);
            }

            // CRÉER LA DEMANDE DE PARTENARIAT (si formulaire partenaire)
            $this->createPartnershipRequest($user, $request);

            // CRÉER LA CANDIDATURE BÉNÉVOLAT (si formulaire bénévole)
            $this->createVolunteerApplication($user, $request);

            auth()->login($user);

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('user_dashboard'),
                'user' => $user,
                'form_type' => $formType
            ], 201);

        } catch (ValidationException $e) {
            Log::error('Erreur de validation', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erreur dans submit: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crée un enregistrement de don après la création de l'utilisateur.
     * Le donation_total dans la table users est calculé ici uniquement
     * pour éviter tout double comptage.
     */
    private function createDonationForUser($user, Request $request)
    {
        $donationAmount = $request->input('donation_amount');

        if ($donationAmount && $donationAmount > 0) {
            try {
                if (Schema::hasTable('donations')) {
                    \DB::table('donations')->insert([
                        'user_id'    => $user->id,
                        'amount'     => $donationAmount,
                        'method'     => $request->input('payment_method', 'Non spécifié'),
                        'status'     => 'Complété',
                        'reference'  => 'DON_' . uniqid() . '_' . time(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    Log::info('Don créé dans la table donations', [
                        'user_id' => $user->id,
                        'amount'  => $donationAmount
                    ]);
                } else {
                    Log::warning('La table donations n\'existe pas', ['user_id' => $user->id]);
                }

                // ✅ CORRECTION BUG 2 : donation_total est calculé UNE SEULE FOIS ici.
                // Il ne doit plus être pré-rempli dans getDonationData() pour éviter le doublon.
                // On recharge le user depuis la BD pour avoir la valeur réelle en base.
                $user->refresh();
                $currentTotal = $user->donation_total ?? 0;
                $user->donation_total = $currentTotal + $donationAmount;
                $user->save();

                Log::info('Total des dons mis à jour', [
                    'user_id'   => $user->id,
                    'added'     => $donationAmount,
                    'new_total' => $user->donation_total
                ]);

            } catch (\Exception $e) {
                Log::error('Erreur lors de la création du don: ' . $e->getMessage(), [
                    'user_id' => $user->id,
                    'amount'  => $donationAmount
                ]);
            }
        }
    }

    /**
     * Crée une demande de partenariat
     */
    private function createPartnershipRequest($user, Request $request)
    {
        $formType = $this->getFormType($request);

        if ($formType === 'partnership') {
            try {
                if (Schema::hasTable('partnership_requests')) {
                    \DB::table('partnership_requests')->insert([
                        'user_id'          => $user->id,
                        'partnership_type' => $request->input('partnership_type', $request->input('other_partnership_type')),
                        'organization_name'=> $request->input('organization_name'),
                        'sector'           => $request->input('sector'),
                        'message'          => $request->input('message'),
                        'status'           => 'En attente',
                        'created_at'       => now(),
                        'updated_at'       => now()
                    ]);

                    Log::info('Demande de partenariat créée', ['user_id' => $user->id]);
                } else {
                    Log::warning('La table partnership_requests n\'existe pas', ['user_id' => $user->id]);
                }
            } catch (\Exception $e) {
                Log::error('Erreur création partenariat: ' . $e->getMessage());
            }
        }
    }

    /**
     * Crée une candidature de bénévolat
     */
    private function createVolunteerApplication($user, Request $request)
    {
        $formType = $this->getFormType($request);

        if ($formType === 'volunteer') {
            try {
                if (Schema::hasTable('volunteer_applications')) {
                    \DB::table('volunteer_applications')->insert([
                        'user_id'      => $user->id,
                        'interests'    => is_array($request->input('interests')) ? json_encode($request->input('interests')) : $request->input('interests'),
                        'skills'       => is_array($request->input('skills')) ? json_encode($request->input('skills')) : $request->input('skills'),
                        'experience'   => $request->input('experience'),
                        'availability' => $request->input('availability'),
                        'status'       => 'En attente',
                        'created_at'   => now(),
                        'updated_at'   => now()
                    ]);

                    Log::info('Candidature bénévolat créée', ['user_id' => $user->id]);
                } else {
                    Log::warning('La table volunteer_applications n\'existe pas', ['user_id' => $user->id]);
                }
            } catch (\Exception $e) {
                Log::error('Erreur création bénévolat: ' . $e->getMessage());
            }
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
     * Get data specific to donation form.
     *
     * ✅ CORRECTION BUG 2 : donation_total est RETIRÉ d'ici.
     * Il était écrit dans $userData puis recalculé dans createDonationForUser(),
     * ce qui provoquait un double comptage (ex: 5000 + 5000 = 10000 pour un seul don).
     * La mise à jour de donation_total est désormais gérée UNIQUEMENT dans createDonationForUser().
     *
     * ✅ CORRECTION BUG 5 : payment_method est RETIRÉ d'ici.
     * Ce champ n'est pas dans $fillable du modèle User et appartient à la table donations,
     * où il est déjà inséré via createDonationForUser().
     */
    private function getDonationData(Request $request)
    {
        $data = [];

        // Don anonyme
        $isAnonymous = $request->boolean('anonymous_donor') || $request->boolean('is_anonymous');
        $data['is_anonymous'] = $isAnonymous;

        // Message
        if ($request->filled('message')) {
            $data['message'] = $request->message;
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
            'membership'  => 'adherent',
            'volunteer'   => 'benevole',
            'donation'    => 'donateur',
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
