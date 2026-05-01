@extends('_partials.master')

@section('title', 'Mon Profil | Bantou-Foundation')
@section('description', 'Gérez votre profil personnel et vos informations de compte.')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy-blue: #0f1a3a;
            --dark-blue: #1a2b55;
            --medium-blue: #2d4a8a;
            --light-blue: #3a5fc0;
            --accent-gold: #d4af37;
            --accent-light: #e6c34d;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #8b5cf6;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-avatar-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-avatar-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .profile-avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tab-content {
            animation: fadeIn 0.3s ease-out;
        }

        .form-input:focus {
            border-color: var(--medium-blue);
            box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.1);
        }

        .loading-spinner {
            border-top-color: var(--medium-blue);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .stat-badge {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">

    <!-- Profile Header -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="rounded-2xl bg-gradient-to-r from-blue-900 to-indigo-900 p-6 sm:p-8 shadow-2xl overflow-hidden relative">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center">
                <!-- Avatar Section -->
                <div class="mb-6 md:mb-0 md:mr-8">
                    <div class="profile-avatar-upload">
                        <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gradient-to-br from-blue-200 to-indigo-200 flex items-center justify-center overflow-hidden border-4 border-yellow-400 shadow-xl relative">
                            <img id="profileImage"
                                 src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=2d4a8a&color=fff&size=128' }}"
                                 alt="Photo de profil"
                                 class="w-full h-full object-cover">
                            <div class="avatar-overlay">
                                <i class="fas fa-camera text-white text-2xl"></i>
                            </div>
                        </div>
                        <input type="file" id="avatarUpload" accept="image/*" class="hidden">
                        <div class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-sm border-2 border-white shadow-lg">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="text-white flex-1 text-center md:text-left">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">{{ Auth::user()->name }}</h1>
                    <p class="text-blue-200 mb-4">{{ ucfirst(Auth::user()->role) }} de Bantou-Foundation</p>

                    <div class="flex flex-wrap gap-3 mb-6 justify-center md:justify-start">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-800 text-blue-100">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Membre depuis: {{ Auth::user()->created_at ? Auth::user()->created_at->format('F Y') : 'Janvier 2024' }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white">
                            <i class="fas fa-user-tag mr-2"></i>
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                        @if(Auth::user()->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500 text-white">
                            <i class="fas fa-check-circle mr-2"></i>
                            Compte actif
                        </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold" id="donationCount">0</div>
                            <div class="text-blue-200 text-sm">Dons</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" id="volunteerHours">0</div>
                            <div class="text-blue-200 text-sm">Heures</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" id="missionsCount">0</div>
                            <div class="text-blue-200 text-sm">Missions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold" id="adhesionStatus">-</div>
                            <div class="text-blue-200 text-sm">Adhésion</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Quick Stats & Actions -->
            <div class="lg:col-span-1">
                <!-- Account Status -->
                <div class="glass-effect rounded-2xl p-6 shadow-lg mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-user-shield text-blue-500 mr-3"></i>
                        Statut du compte
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Email</p>
                                    <p class="text-sm text-gray-500" id="profileEmail">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-200 text-green-800">Vérifié</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-phone text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Téléphone</p>
                                    <p class="text-sm text-gray-500" id="profilePhone">{{ Auth::user()->phone ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                            <button onclick="editPhone()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Modifier
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Rôle</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-effect rounded-2xl p-6 shadow-lg mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                        Actions Rapides
                    </h2>
                    <div class="space-y-3">
                        <a href="#" onclick="editPersonalInfo()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-edit text-blue-600"></i>
                            </div>
                            <span class="font-medium text-gray-700">Modifier le profil</span>
                        </a>

                        <a href="#" onclick="editAddress()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-green-600"></i>
                            </div>
                            <span class="font-medium text-gray-700">Modifier l'adresse</span>
                        </a>

                        <a href="#" onclick="editExpertise()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                <i class="fas fa-code-branch text-purple-600"></i>
                            </div>
                            <span class="font-medium text-gray-700">Modifier compétences</span>
                        </a>

                        <a href="#" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors" id="logoutBtn">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                <i class="fas fa-sign-out-alt text-red-600"></i>
                            </div>
                            <span class="font-medium text-gray-700">Déconnexion</span>
                        </a>
                    </div>
                </div>

                <!-- Security Badge -->
                <div class="glass-effect rounded-2xl p-6 shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Sécurité du compte</h3>
                        <p class="text-gray-600 text-sm mb-4">Votre compte est bien protégé</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Force: 85%</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Profile Details & Tabs -->
            <div class="lg:col-span-2">
                <div class="glass-effect rounded-2xl shadow-lg overflow-hidden mb-8">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="flex flex-wrap -mb-px">
                            <button data-tab="informations" class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors active-tab">
                                <i class="fas fa-user-circle mr-2"></i>
                                Informations personnelles
                            </button>
                            <button data-tab="contact" class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                <i class="fas fa-address-book mr-2"></i>
                                Coordonnées
                            </button>
                            <button data-tab="activite" class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                <i class="fas fa-chart-line mr-2"></i>
                                Activité récente
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Informations Personnelles Tab -->
                        <div id="informations" class="tab-pane">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Informations personnelles</h3>
                                <button onclick="editPersonalInfo()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    <i class="fas fa-edit mr-2"></i>
                                    Modifier
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 rounded-xl p-5">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Nom complet</label>
                                    <p class="text-gray-800 font-medium" id="profileFullName">{{ Auth::user()->name }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-5">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Email</label>
                                    <p class="text-gray-800 font-medium" id="profileEmailDisplay">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-5">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Date de naissance</label>
                                    <p class="text-gray-800 font-medium" id="profileBirthDate">{{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('d/m/Y') : 'Non renseignée' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-5">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Genre</label>
                                    <p class="text-gray-800 font-medium" id="profileGender">{{ Auth::user()->gender ? ucfirst(Auth::user()->gender) : 'Non renseigné' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-5 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Profession</label>
                                    <p class="text-gray-800 font-medium" id="profileProfession">{{ Auth::user()->profession ?? 'Non renseignée' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-5 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Motivation</label>
                                    <p class="text-gray-600" id="profileMotivation">{{ Auth::user()->motivation ?? 'Aucune motivation renseignée' }}</p>
                                </div>
                            </div>

                            @if(Auth::user()->expertise_areas)
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                                    Domaines d'expertise
                                </h4>
                                <div class="flex flex-wrap gap-2" id="expertiseAreas">
                                    @php
                                        $expertises = is_array(Auth::user()->expertise_areas) ? Auth::user()->expertise_areas : json_decode(Auth::user()->expertise_areas ?? '[]', true);
                                    @endphp
                                    @foreach($expertises as $expertise)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        {{ ucfirst($expertise) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Coordonnées Tab -->
                        <div id="contact" class="tab-pane hidden">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Coordonnées</h3>
                                <button onclick="editAddress()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    <i class="fas fa-edit mr-2"></i>
                                    Modifier
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 border border-blue-100">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-envelope text-blue-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-800 mb-1">Email</h4>
                                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-5 border border-green-100">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-phone text-green-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-800 mb-1">Téléphone</h4>
                                            <p class="text-gray-600" id="contactPhone">{{ Auth::user()->phone ?? 'Non renseigné' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-5 border border-yellow-100 md:col-span-2">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                                <i class="fas fa-map-marker-alt text-yellow-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-800 mb-1">Adresse</h4>
                                            <p class="text-gray-600" id="contactAddress">{{ Auth::user()->address ?? 'Non renseignée' }}</p>
                                            @if(Auth::user()->latitude && Auth::user()->longitude)
                                            <p class="text-gray-500 text-sm mt-1">
                                                <i class="fas fa-location-dot"></i>
                                                Lat: {{ Auth::user()->latitude }}, Lon: {{ Auth::user()->longitude }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activité récente Tab -->
                        <div id="activite" class="tab-pane hidden">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Type d'adhésion</h3>
                            </div>

                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-8">
                                <div class="flex items-center justify-between flex-wrap gap-4">
                                    <div>
                                        <p class="text-gray-500 text-sm">Type d'adhésion</p>
                                        <p class="text-2xl font-bold text-blue-800" id="membershipType">
                                            {{ ucfirst(Auth::user()->membership_type ?? 'Non défini') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Statut</p>
                                        <p class="text-lg font-semibold text-green-600">
                                            <i class="fas fa-check-circle mr-1"></i> Actif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Depuis le</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            {{ Auth::user()->created_at ? Auth::user()->created_at->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                Détails de votre compte
                            </h3>

                            <div class="space-y-4">
                                <div class="bg-white border border-gray-200 rounded-xl p-5">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-gray-800">Informations d'inscription</h4>
                                        <span class="text-sm text-gray-500">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d/m/Y H:i') : '-' }}</span>
                                    </div>
                                    <p class="text-gray-600">Vous avez rejoint Bantou-Foundation en tant que <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>
                                </div>

                                @if(Auth::user()->interests || Auth::user()->skills)
                                <div class="bg-white border border-gray-200 rounded-xl p-5">
                                    <h4 class="font-bold text-gray-800 mb-3">Centres d'intérêt</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $interests = is_array(Auth::user()->interests) ? Auth::user()->interests : json_decode(Auth::user()->interests ?? '[]', true);
                                        @endphp
                                        @foreach($interests as $interest)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            {{ ucfirst($interest) }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->availability)
                                <div class="bg-white border border-gray-200 rounded-xl p-5">
                                    <h4 class="font-bold text-gray-800 mb-3">Disponibilité</h4>
                                    <p class="text-gray-600">{{ ucfirst(Auth::user()->availability) }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Management -->
                <div class="glass-effect rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-cogs text-gray-500 mr-3"></i>
                        Gestion du compte
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button onclick="downloadData()" class="flex items-center p-4 bg-white border border-gray-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-colors">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <i class="fas fa-download text-blue-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-800">Télécharger mes données</p>
                                <p class="text-sm text-gray-500">Exportez toutes vos informations</p>
                            </div>
                        </button>

                        <button onclick="deleteAccount()" class="flex items-center p-4 bg-white border border-gray-200 rounded-xl hover:bg-red-50 hover:border-red-200 transition-colors">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                                <i class="fas fa-trash-alt text-red-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-800">Supprimer mon compte</p>
                                <p class="text-sm text-gray-500">Action irréversible</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="max-w-7xl mx-auto mt-12 pt-8 border-t border-gray-200">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-500 text-sm mb-4 md:mb-0">
                <p>© {{ date('Y') }} Bantou-Foundation. Tous droits réservés.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-500 hover:text-blue-600 text-sm transition-colors">Support</a>
                <a href="#" class="text-gray-500 hover:text-blue-600 text-sm transition-colors">FAQ</a>
                <a href="#" class="text-gray-500 hover:text-blue-600 text-sm transition-colors">Politique de confidentialité</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Tab functionality
    $('.tab-btn').on('click', function() {
        const tabId = $(this).data('tab');
        $('.tab-btn').removeClass('text-blue-600 border-blue-600').addClass('text-gray-500 border-transparent');
        $(this).removeClass('text-gray-500 border-transparent').addClass('text-blue-600 border-blue-600');
        $('.tab-pane').addClass('hidden');
        $(`#${tabId}`).removeClass('hidden');
    });

    // Set active tab
    $('.tab-btn:first').addClass('text-blue-600 border-blue-600');

    // Avatar upload
    $('.profile-avatar-upload').on('click', function(e) {
        if (!$(e.target).is('input')) {
            $('#avatarUpload').click();
        }
    });

    $('#avatarUpload').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('profile.update.avatar') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#profileImage').attr('src', response.avatar_url);
                        Swal.fire({ title: 'Succès', text: 'Photo de profil mise à jour', icon: 'success', timer: 2000, showConfirmButton: false });
                    }
                },
                error: function() {
                    Swal.fire({ title: 'Erreur', text: 'Une erreur est survenue', icon: 'error' });
                }
            });
        }
    });

    // Logout
    $('#logoutBtn').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Déconnexion',
            text: 'Voulez-vous vraiment vous déconnecter ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Non',
            confirmButtonColor: '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
        });
    });

    // Load stats
    loadUserStats();

    // Load recent activity
    loadRecentActivity();
});

function loadUserStats() {
    $.ajax({
        url: "{{ route('profile.stats') }}",
        type: 'GET',
        success: function(response) {
            $('#donationCount').text(response.donation_count || 0);
            $('#volunteerHours').text(response.volunteer_hours || 0);
            $('#missionsCount').text(response.missions_count || 0);
            $('#adhesionStatus').text(response.status || '-');
        },
        error: function() {
            console.log('Erreur chargement des stats');
        }
    });
}

function loadRecentActivity() {
    $.ajax({
        url: "{{ route('profile.recent-activity') }}",
        type: 'GET',
        success: function(activities) {
            if (activities && activities.length > 0) {
                let html = '';
                activities.forEach(function(activity) {
                    html += `
                        <div class="relative">
                            <div class="absolute -left-12 top-0 w-8 h-8 rounded-full bg-${activity.icon_color === 'text-green-500' ? 'green-100' : activity.icon_color === 'text-blue-500' ? 'blue-100' : 'purple-100'} flex items-center justify-center border-2 border-white">
                                <i class="${activity.icon} ${activity.icon_color}"></i>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-gray-800">${activity.title}</h4>
                                    <span class="text-sm text-gray-500">${activity.date}</span>
                                </div>
                                <p class="text-gray-600">${activity.description}</p>
                            </div>
                        </div>
                    `;
                });
                $('.space-y-8').html(html);
            }
        },
        error: function() {
            console.log('Erreur chargement des activités');
        }
    });
}

function editPersonalInfo() {
    Swal.fire({
        title: 'Modifier le profil',
        html: `
            <div class="text-left">
                <input type="text" id="editName" class="form-input w-full p-3 border border-gray-300 rounded-lg mb-3" placeholder="Nom complet" value="{{ Auth::user()->name }}">
                <input type="date" id="editBirthDate" class="form-input w-full p-3 border border-gray-300 rounded-lg mb-3" placeholder="Date de naissance" value="{{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') : '' }}">
                <select id="editGender" class="form-input w-full p-3 border border-gray-300 rounded-lg mb-3">
                    <option value="">Sélectionnez le genre</option>
                    <option value="homme" {{ Auth::user()->gender == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ Auth::user()->gender == 'femme' ? 'selected' : '' }}>Femme</option>
                </select>
                <input type="text" id="editProfession" class="form-input w-full p-3 border border-gray-300 rounded-lg mb-3" placeholder="Profession" value="{{ Auth::user()->profession }}">
                <textarea id="editMotivation" class="form-input w-full p-3 border border-gray-300 rounded-lg" rows="3" placeholder="Motivation">{{ Auth::user()->motivation }}</textarea>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#2d4a8a',
        preConfirm: () => {
            return {
                name: document.getElementById('editName').value,
                birth_date: document.getElementById('editBirthDate').value,
                gender: document.getElementById('editGender').value,
                profession: document.getElementById('editProfession').value,
                motivation: document.getElementById('editMotivation').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('profile.update.personal') }}",
                type: 'POST',
                data: { ...result.value, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ title: 'Succès', text: response.message, icon: 'success' }).then(() => location.reload());
                    }
                },
                error: function(xhr) {
                    let message = 'Une erreur est survenue';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({ title: 'Erreur', text: message, icon: 'error' });
                }
            });
        }
    });
}

function editPhone() {
    Swal.fire({
        title: 'Modifier le téléphone',
        input: 'tel',
        inputValue: "{{ Auth::user()->phone }}",
        inputPlaceholder: 'Numéro de téléphone',
        showCancelButton: true,
        confirmButtonText: 'Enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#2d4a8a',
        preConfirm: (phone) => {
            if (!phone) {
                Swal.showValidationMessage('Le numéro de téléphone est requis');
                return false;
            }
            return { phone: phone };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('profile.update.phone') }}",
                type: 'POST',
                data: { phone: result.value.phone, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ title: 'Succès', text: response.message, icon: 'success' }).then(() => location.reload());
                    }
                },
                error: function(xhr) {
                    let message = 'Une erreur est survenue';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({ title: 'Erreur', text: message, icon: 'error' });
                }
            });
        }
    });
}

function editAddress() {
    Swal.fire({
        title: 'Modifier l\'adresse',
        html: `
            <input type="text" id="editAddress" class="form-input w-full p-3 border border-gray-300 rounded-lg mb-3" placeholder="Adresse" value="{{ Auth::user()->address }}">
            <button type="button" id="getLocationBtn" class="w-full py-2 bg-blue-600 text-white rounded-lg">📍 Me localiser</button>
        `,
        showCancelButton: true,
        confirmButtonText: 'Enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#2d4a8a',
        didOpen: () => {
            $('#getLocationBtn').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        $.ajax({
                            url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`,
                            success: function(data) {
                                if (data.display_name) {
                                    $('#editAddress').val(data.display_name);
                                }
                            }
                        });
                    });
                }
            });
        },
        preConfirm: () => {
            return { address: document.getElementById('editAddress').value };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('profile.update.address') }}",
                type: 'POST',
                data: { address: result.value.address, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ title: 'Succès', text: response.message, icon: 'success' }).then(() => location.reload());
                    }
                },
                error: function(xhr) {
                    let message = 'Une erreur est survenue';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({ title: 'Erreur', text: message, icon: 'error' });
                }
            });
        }
    });
}

function editExpertise() {
    const currentExpertise = {!! json_encode(is_array(Auth::user()->expertise_areas) ? Auth::user()->expertise_areas : json_decode(Auth::user()->expertise_areas ?? '[]', true)) !!};

    Swal.fire({
        title: 'Domaines d\'expertise',
        html: `
            <div class="flex flex-wrap gap-2 justify-center">
                <label class="px-3 py-2 bg-gray-100 rounded-lg cursor-pointer ${currentExpertise.includes('education') ? 'bg-blue-100' : ''}">
                    <input type="checkbox" value="education" ${currentExpertise.includes('education') ? 'checked' : ''} class="mr-2"> Éducation
                </label>
                <label class="px-3 py-2 bg-gray-100 rounded-lg cursor-pointer ${currentExpertise.includes('sante') ? 'bg-blue-100' : ''}">
                    <input type="checkbox" value="sante" ${currentExpertise.includes('sante') ? 'checked' : ''} class="mr-2"> Santé
                </label>
                <label class="px-3 py-2 bg-gray-100 rounded-lg cursor-pointer ${currentExpertise.includes('environnement') ? 'bg-blue-100' : ''}">
                    <input type="checkbox" value="environnement" ${currentExpertise.includes('environnement') ? 'checked' : ''} class="mr-2"> Environnement
                </label>
                <label class="px-3 py-2 bg-gray-100 rounded-lg cursor-pointer ${currentExpertise.includes('social') ? 'bg-blue-100' : ''}">
                    <input type="checkbox" value="social" ${currentExpertise.includes('social') ? 'checked' : ''} class="mr-2"> Social
                </label>
                <label class="px-3 py-2 bg-gray-100 rounded-lg cursor-pointer ${currentExpertise.includes('communication') ? 'bg-blue-100' : ''}">
                    <input type="checkbox" value="communication" ${currentExpertise.includes('communication') ? 'checked' : ''} class="mr-2"> Communication
                </label>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#2d4a8a',
        preConfirm: () => {
            let selected = [];
            $('input[type="checkbox"]:checked').each(function() {
                selected.push($(this).val());
            });
            return { expertise_areas: selected };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('profile.update.expertise') }}",
                type: 'POST',
                data: { expertise_areas: result.value.expertise_areas, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ title: 'Succès', text: response.message, icon: 'success' }).then(() => location.reload());
                    }
                },
                error: function() {
                    Swal.fire({ title: 'Erreur', text: 'Une erreur est survenue', icon: 'error' });
                }
            });
        }
    });
}

function deleteAccount() {
    Swal.fire({
        title: 'Supprimer mon compte',
        text: 'Cette action est irréversible !',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Supprimer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#dc2626',
        input: 'password',
        inputPlaceholder: 'Confirmez votre mot de passe',
        inputAttributes: { required: true }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            $.ajax({
                url: "{{ route('profile.delete') }}",
                type: 'DELETE',
                data: { password: result.value, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ title: 'Succès', text: response.message, icon: 'success' }).then(() => {
                            window.location.href = "{{ route('home') }}";
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'Une erreur est survenue';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({ title: 'Erreur', text: message, icon: 'error' });
                }
            });
        }
    });
}

function downloadData() {
    Swal.fire({
        title: 'Préparation...',
        text: 'Vos données sont en cours de préparation',
        icon: 'info',
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
    }).then(() => {
        window.location.href = "{{ route('profile.download') }}";
    });
}
</script>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection
