@extends('_partials.master')

@section('title', 'Mon Profil | Bantou-Foundation')
@section('description', 'Gérez votre profil personnel et vos informations de compte.')

@section('styles')
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom styles -->
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
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-border {
            position: relative;
            border: double 3px transparent;
            background-image: linear-gradient(white, white),
                linear-gradient(to right, var(--medium-blue), var(--accent-gold));
            background-origin: border-box;
            background-clip: padding-box, border-box;
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

        .stat-badge {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .tab-content {
            animation: fadeIn 0.3s ease-out;
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: var(--medium-blue);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: var(--dark-blue);
        }

        /* Form styles */
        .form-input:focus {
            border-color: var(--medium-blue);
            box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.1);
        }

        .loading-spinner {
            border-top-color: var(--medium-blue);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">

        <!-- Profile Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="rounded-2xl bg-gradient-to-r from-blue-900 to-indigo-900 p-6 sm:p-8 shadow-2xl overflow-hidden relative">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center">
                    <!-- Avatar Section -->
                    <div class="mb-6 md:mb-0 md:mr-8">
                        <div class="profile-avatar-upload">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gradient-to-br from-blue-200 to-indigo-200 flex items-center justify-center overflow-hidden border-4 border-yellow-400 shadow-xl relative">
                                <!-- Current profile image -->
                                <img id="profileImage"
                                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                     alt="Photo de profil"
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iNTAiIGN5PSI1MCIgcj0iNTAiIGZpbGw9IiMxRTQwQTkiLz48dGV4dCB4PSI1MCIgeT0iNTUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSI0MCIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIwLjNlbSI+e0pKfTwvdGV4dD48L3N2Zz4='">
                                <div class="avatar-overlay">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                            </div>
                            <input type="file" id="avatarUpload" accept="image/*" class="hidden" onchange="previewProfileImage(event)">
                            <div class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-sm border-2 border-white shadow-lg">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="text-white flex-1 text-center md:text-left">
                        <h1 class="text-3xl sm:text-4xl font-bold mb-2">{{ Auth::user()->name ?? 'Jean Kabeya' }}</h1>
                        <p class="text-blue-200 mb-4">Membre actif de Bantou-Foundation</p>

                        <div class="flex flex-wrap gap-3 mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-800 text-blue-100">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Membre depuis: Janvier 2024
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white">
                                <i class="fas fa-hands-helping mr-2"></i>
                                Bénévole actif
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500 text-white">
                                <i class="fas fa-heart mr-2"></i>
                                Donateur régulier
                            </span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold">3</div>
                                <div class="text-blue-200 text-sm">Dons</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">48</div>
                                <div class="text-blue-200 text-sm">Heures</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">2</div>
                                <div class="text-blue-200 text-sm">Missions</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">1</div>
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
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Email vérifié</p>
                                        <p class="text-sm text-gray-500">jean.kabeya@email.com</p>
                                    </div>
                                </div>
                                <button onclick="verifyEmail()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Modifier
                                </button>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-phone text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Téléphone vérifié</p>
                                        <p class="text-sm text-gray-500">+237 6XX XXX XXX</p>
                                    </div>
                                </div>
                                <button onclick="verifyPhone()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Modifier
                                </button>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-shield-alt text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Sécurité du compte</p>
                                        <p class="text-sm text-gray-500">Fort</p>
                                    </div>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Améliorer
                                </a>
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
                            <a href="#" onclick="editProfile()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-edit text-blue-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Modifier le profil</span>
                            </a>

                            <a href="#" onclick="changePassword()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-key text-green-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Changer le mot de passe</span>
                            </a>

                            <a href="#" onclick="notificationSettings()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-bell text-purple-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Préférences de notification</span>
                            </a>

                            <a href="#" onclick="privacySettings()" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-lock text-gray-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Paramètres de confidentialité</span>
                            </a>

                            <a href="#" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
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
                                <button data-tab="informations"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Informations personnelles
                                </button>
                                <button data-tab="contact"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-address-book mr-2"></i>
                                    Coordonnées
                                </button>
                                <button data-tab="preferences"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-cog mr-2"></i>
                                    Préférences
                                </button>
                                <button data-tab="activite"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
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
                                    <button onclick="editPersonalInfo()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-edit mr-2"></i>
                                        Modifier
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50 rounded-xl p-5">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Nom complet</label>
                                        <p class="text-gray-800 font-medium" id="profileFullName">Jean Kabeya</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-5">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Date de naissance</label>
                                        <p class="text-gray-800 font-medium" id="profileBirthDate">15/03/1985</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-5">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Genre</label>
                                        <p class="text-gray-800 font-medium" id="profileGender">Homme</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-5">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Nationalité</label>
                                        <p class="text-gray-800 font-medium" id="profileNationality">Camerounaise</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-5 md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Profession</label>
                                        <p class="text-gray-800 font-medium" id="profileProfession">Ingénieur en Informatique</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-5 md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-500 mb-2">À propos de moi</label>
                                        <p class="text-gray-600" id="profileBio">
                                            Passionné par le développement communautaire et l'éducation en Afrique. Je m'engage à contribuer au développement durable de notre continent par le bénévolat et le soutien aux initiatives éducatives.
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-8 pt-8 border-t border-gray-200">
                                    <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                                        Compétences & Domaines d'expertise
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-code mr-2"></i>
                                            Développement Web
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                                            Enseignement
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            <i class="fas fa-project-diagram mr-2"></i>
                                            Gestion de Projet
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-language mr-2"></i>
                                            Multilingue
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Coordonnées Tab -->
                            <div id="contact" class="tab-pane hidden">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-gray-800">Coordonnées</h3>
                                    <button onclick="editContactInfo()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
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
                                                <h4 class="font-medium text-gray-800 mb-1">Email principal</h4>
                                                <p class="text-gray-600" id="contactEmail">jean.kabeya@email.com</p>
                                                <p class="text-green-600 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Vérifié
                                                </p>
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
                                                <p class="text-gray-600" id="contactPhone">+237 6XX XXX XXX</p>
                                                <p class="text-green-600 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Vérifié
                                                </p>
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
                                                <p class="text-gray-600" id="contactAddress">Rue 1234, Quartier Bastos</p>
                                                <p class="text-gray-600" id="contactCityCountry">Yaoundé, Cameroun</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <h4 class="text-md font-bold text-gray-800 mb-4">Coordonnées supplémentaires</h4>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <i class="fab fa-whatsapp text-green-500 text-xl mr-3"></i>
                                                <div>
                                                    <p class="font-medium text-gray-800">WhatsApp</p>
                                                    <p class="text-sm text-gray-500">Même numéro que le téléphone</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                Disponible
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <i class="fab fa-linkedin text-blue-600 text-xl mr-3"></i>
                                                <div>
                                                    <p class="font-medium text-gray-800">LinkedIn</p>
                                                    <p class="text-sm text-gray-500">Non connecté</p>
                                                </div>
                                            </div>
                                            <button onclick="connectLinkedIn()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Connecter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Préférences Tab -->
                            <div id="preferences" class="tab-pane hidden">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-gray-800">Préférences et paramètres</h3>
                                    <button onclick="savePreferences()"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-save mr-2"></i>
                                        Enregistrer
                                    </button>
                                </div>

                                <div class="space-y-6">
                                    <!-- Language Preference -->
                                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                            <i class="fas fa-language text-blue-500 mr-2"></i>
                                            Langue préférée
                                        </h4>
                                        <select id="languagePreference" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                                            <option value="fr" selected>Français</option>
                                            <option value="en">English</option>
                                            <option value="pt">Português</option>
                                            <option value="es">Español</option>
                                        </select>
                                        <p class="text-gray-500 text-sm mt-2">Cette langue sera utilisée pour toutes les communications et l'interface du tableau de bord.</p>
                                    </div>

                                    <!-- Notification Preferences -->
                                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                            <i class="fas fa-bell text-purple-500 mr-2"></i>
                                            Préférences de notification
                                        </h4>
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Emails de nouvelles</p>
                                                    <p class="text-sm text-gray-500">Recevoir les dernières actualités de la fondation</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="newsEmails" class="sr-only peer" checked>
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Notifications de dons</p>
                                                    <p class="text-sm text-gray-500">Recevoir des confirmations et reçus par email</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="donationEmails" class="sr-only peer" checked>
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Notifications de bénévolat</p>
                                                    <p class="text-sm text-gray-500">Alertes pour nouvelles missions et mises à jour</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="volunteerNotifications" class="sr-only peer" checked>
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Notifications SMS</p>
                                                    <p class="text-sm text-gray-500">Recevoir des alertes importantes par SMS</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="smsNotifications" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Privacy Settings -->
                                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                            <i class="fas fa-lock text-gray-500 mr-2"></i>
                                            Paramètres de confidentialité
                                        </h4>
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Profil public</p>
                                                    <p class="text-sm text-gray-500">Autoriser d'autres membres à voir mon profil</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="publicProfile" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-800">Dons anonymes</p>
                                                    <p class="text-sm text-gray-500">Par défaut, mes dons apparaîtront anonymes</p>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="anonymousDonations" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Activité récente Tab -->
                            <div id="activite" class="tab-pane hidden">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-gray-800">Activité récente</h3>
                                    <button onclick="exportActivity()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-download mr-2"></i>
                                        Exporter
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <!-- Activity Timeline -->
                                    <div class="relative">
                                        <!-- Timeline line -->
                                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-blue-200"></div>

                                        <!-- Activity Items -->
                                        <div class="space-y-8 ml-12">
                                            <!-- Activity 1 -->
                                            <div class="relative">
                                                <div class="absolute -left-12 top-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center border-2 border-white">
                                                    <i class="fas fa-heart text-green-600"></i>
                                                </div>
                                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <h4 class="font-bold text-gray-800">Don effectué</h4>
                                                        <span class="text-sm text-gray-500">Il y a 2 jours</span>
                                                    </div>
                                                    <p class="text-gray-600 mb-3">Vous avez fait un don de 25 000 FCFA via Orange Money</p>
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="fas fa-receipt mr-2"></i>
                                                        <span>Reçu #DON-2024-001 généré</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Activity 2 -->
                                            <div class="relative">
                                                <div class="absolute -left-12 top-0 w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center border-2 border-white">
                                                    <i class="fas fa-hands-helping text-yellow-600"></i>
                                                </div>
                                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <h4 class="font-bold text-gray-800">Mission de bénévolat</h4>
                                                        <span class="text-sm text-gray-500">Il y a 1 semaine</span>
                                                    </div>
                                                    <p class="text-gray-600 mb-3">Vous avez complété 5 heures de tutorat scolaire</p>
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                                        <span>Centre éducatif de Yaoundé</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Activity 3 -->
                                            <div class="relative">
                                                <div class="absolute -left-12 top-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white">
                                                    <i class="fas fa-user-check text-blue-600"></i>
                                                </div>
                                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <h4 class="font-bold text-gray-800">Adhésion confirmée</h4>
                                                        <span class="text-sm text-gray-500">Il y a 2 semaines</span>
                                                    </div>
                                                    <p class="text-gray-600 mb-3">Votre adhésion en tant que membre actif a été confirmée</p>
                                                    <div class="flex items-center text-sm text-green-600">
                                                        <i class="fas fa-check-circle mr-2"></i>
                                                        <span>Statut: Actif jusqu'au 15/01/2025</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Activity 4 -->
                                            <div class="relative">
                                                <div class="absolute -left-12 top-0 w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center border-2 border-white">
                                                    <i class="fas fa-handshake text-purple-600"></i>
                                                </div>
                                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <h4 class="font-bold text-gray-800">Demande de partenariat</h4>
                                                        <span class="text-sm text-gray-500">Il y a 3 semaines</span>
                                                    </div>
                                                    <p class="text-gray-600 mb-3">Vous avez soumis une demande de partenariat événementiel</p>
                                                    <div class="flex items-center text-sm text-yellow-600">
                                                        <i class="fas fa-hourglass-half mr-2"></i>
                                                        <span>Statut: En attente de validation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 pt-8 border-t border-gray-200">
                                    <div class="text-center">
                                        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            <span>Voir toute l'activité</span>
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
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

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Initialize profile
            initializeProfile();

            // Tab functionality
            $('.tab-btn').on('click', function() {
                const tabId = $(this).data('tab');

                // Update active tab button
                $('.tab-btn').removeClass('text-blue-600 border-blue-600');
                $('.tab-btn').addClass('text-gray-500 border-transparent');
                $(this).removeClass('text-gray-500 border-transparent');
                $(this).addClass('text-blue-600 border-blue-600');

                // Show active tab content
                $('.tab-pane').addClass('hidden');
                $(`#${tabId}`).removeClass('hidden');
            });

            // Set first tab as active
            $('.tab-btn:first').addClass('text-blue-600 border-blue-600');

            // Avatar upload click handler
            $('.profile-avatar-upload').on('click', function(e) {
                if (!$(e.target).is('input')) {
                    $('#avatarUpload').click();
                }
            });

            // Check for URL hash to open specific tab
            const hash = window.location.hash.substring(1);
            if (hash && $(`.tab-btn[data-tab="${hash}"]`).length) {
                $(`.tab-btn[data-tab="${hash}"]`).click();
            }
        });

        function initializeProfile() {
            // Load profile data from local storage or default values
            loadProfileData();

            // Initialize toggle switches
            initializeToggleSwitches();
        }

        function loadProfileData() {
            // This function would typically load data from an API
            // For now, we'll use default values
            const profileData = {
                fullName: "Jean Kabeya",
                birthDate: "15/03/1985",
                gender: "Homme",
                nationality: "Camerounaise",
                profession: "Ingénieur en Informatique",
                bio: "Passionné par le développement communautaire et l'éducation en Afrique. Je m'engage à contribuer au développement durable de notre continent par le bénévolat et le soutien aux initiatives éducatives.",
                email: "jean.kabeya@email.com",
                phone: "+237 6XX XXX XXX",
                address: "Rue 1234, Quartier Bastos",
                cityCountry: "Yaoundé, Cameroun",
                language: "fr",
                newsEmails: true,
                donationEmails: true,
                volunteerNotifications: true,
                smsNotifications: false,
                publicProfile: false,
                anonymousDonations: false
            };

            // Populate form fields
            Object.keys(profileData).forEach(key => {
                const element = document.getElementById(`profile${key.charAt(0).toUpperCase() + key.slice(1)}`) ||
                               document.getElementById(`contact${key.charAt(0).toUpperCase() + key.slice(1)}`) ||
                               document.getElementById(`${key}Preference`) ||
                               document.getElementById(`${key}Emails`) ||
                               document.getElementById(`${key}Notifications`) ||
                               document.getElementById(key);

                if (element) {
                    if (element.tagName === 'SELECT' || element.tagName === 'INPUT') {
                        element.value = profileData[key];
                        if (element.type === 'checkbox') {
                            element.checked = profileData[key];
                        }
                    } else {
                        element.textContent = profileData[key];
                    }
                }
            });
        }

        function initializeToggleSwitches() {
            // Initialize all toggle switches
            $('input[type="checkbox"].sr-only').each(function() {
                const $this = $(this);
                const $switch = $this.next();

                $this.on('change', function() {
                    const isChecked = $this.is(':checked');
                    // Here you would typically save the preference via API
                    console.log(`Setting ${this.id} to:`, isChecked);
                });
            });
        }

        function previewProfileImage(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function() {
                const image = document.getElementById('profileImage');
                image.src = reader.result;

                // Show success message
                Swal.fire({
                    title: 'Photo mise à jour!',
                    text: 'Votre photo de profil a été modifiée avec succès.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function editProfile() {
            Swal.fire({
                title: 'Modifier le profil',
                html: `
                    <div class="text-left space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <input type="text" id="editFullName" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="Jean Kabeya">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                                <input type="date" id="editBirthDate" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="1985-03-15">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                                <select id="editGender" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                                    <option value="homme" selected>Homme</option>
                                    <option value="femme">Femme</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">À propos de moi</label>
                            <textarea id="editBio" class="form-input w-full p-3 border border-gray-300 rounded-lg" rows="4">Passionné par le développement communautaire et l'éducation en Afrique. Je m'engage à contribuer au développement durable de notre continent par le bénévolat et le soutien aux initiatives éducatives.</textarea>
                        </div>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Enregistrer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    return {
                        fullName: document.getElementById('editFullName').value,
                        birthDate: document.getElementById('editBirthDate').value,
                        gender: document.getElementById('editGender').value,
                        bio: document.getElementById('editBio').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update UI with new data
                    $('#profileFullName').text(result.value.fullName);
                    $('#profileBirthDate').text(formatDate(result.value.birthDate));
                    $('#profileGender').text(result.value.gender.charAt(0).toUpperCase() + result.value.gender.slice(1));
                    $('#profileBio').text(result.value.bio);

                    Swal.fire({
                        title: 'Profil mis à jour!',
                        text: 'Vos informations ont été modifiées avec succès.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        }

        function editContactInfo() {
            Swal.fire({
                title: 'Modifier les coordonnées',
                html: `
                    <div class="text-left space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="editContactEmail" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="jean.kabeya@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" id="editContactPhone" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="+237600000000">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" id="editContactAddress" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="Rue 1234, Quartier Bastos">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ville et Pays</label>
                            <input type="text" id="editContactCityCountry" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="Yaoundé, Cameroun">
                        </div>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Enregistrer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    return {
                        email: document.getElementById('editContactEmail').value,
                        phone: document.getElementById('editContactPhone').value,
                        address: document.getElementById('editContactAddress').value,
                        cityCountry: document.getElementById('editContactCityCountry').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update UI with new data
                    $('#contactEmail').text(result.value.email);
                    $('#contactPhone').text(result.value.phone);
                    $('#contactAddress').text(result.value.address);
                    $('#contactCityCountry').text(result.value.cityCountry);

                    Swal.fire({
                        title: 'Coordonnées mises à jour!',
                        text: 'Vos informations de contact ont été modifiées.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        }

        function changePassword() {
            Swal.fire({
                title: 'Changer le mot de passe',
                html: `
                    <div class="text-left space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                            <input type="password" id="currentPassword" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                            <input type="password" id="newPassword" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
                            <input type="password" id="confirmPassword" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, un chiffre et un caractère spécial.
                            </p>
                        </div>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Changer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    const currentPassword = document.getElementById('currentPassword').value;
                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;

                    if (!currentPassword || !newPassword || !confirmPassword) {
                        Swal.showValidationMessage('Tous les champs sont requis');
                        return false;
                    }

                    if (newPassword !== confirmPassword) {
                        Swal.showValidationMessage('Les mots de passe ne correspondent pas');
                        return false;
                    }

                    if (newPassword.length < 8) {
                        Swal.showValidationMessage('Le mot de passe doit contenir au moins 8 caractères');
                        return false;
                    }

                    return {
                        currentPassword: currentPassword,
                        newPassword: newPassword
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate API call
                    Swal.fire({
                        title: 'Mise à jour en cours...',
                        text: 'Veuillez patienter pendant la modification de votre mot de passe',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        Swal.fire({
                            title: 'Mot de passe modifié!',
                            text: 'Votre mot de passe a été changé avec succès.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                    }, 2000);
                }
            });
        }

        function savePreferences() {
            const preferences = {
                language: $('#languagePreference').val(),
                newsEmails: $('#newsEmails').is(':checked'),
                donationEmails: $('#donationEmails').is(':checked'),
                volunteerNotifications: $('#volunteerNotifications').is(':checked'),
                smsNotifications: $('#smsNotifications').is(':checked'),
                publicProfile: $('#publicProfile').is(':checked'),
                anonymousDonations: $('#anonymousDonations').is(':checked')
            };

            // Simulate saving preferences
            Swal.fire({
                title: 'Enregistrement en cours...',
                text: 'Vos préférences sont en cours de sauvegarde',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                Swal.fire({
                    title: 'Préférences enregistrées!',
                    text: 'Vos préférences ont été sauvegardées avec succès.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            }, 1500);
        }

        function verifyEmail() {
            Swal.fire({
                title: 'Vérifier l\'email',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Un code de vérification sera envoyé à votre adresse email:</p>
                        <p class="font-medium text-center mb-4">jean.kabeya@email.com</p>
                        <input type="email" id="verifyEmail" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="jean.kabeya@email.com">
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Envoyer le code',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280'
            });
        }

        function verifyPhone() {
            Swal.fire({
                title: 'Vérifier le téléphone',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Un code de vérification sera envoyé par SMS à votre numéro:</p>
                        <p class="font-medium text-center mb-4">+237 6XX XXX XXX</p>
                        <input type="tel" id="verifyPhone" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="+237600000000">
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Envoyer le code',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280'
            });
        }

        function notificationSettings() {
            // Navigate to preferences tab and focus on notifications
            $('.tab-btn[data-tab="preferences"]').click();

            // Scroll to notification section
            setTimeout(() => {
                document.getElementById('preferences').scrollIntoView({ behavior: 'smooth' });
            }, 300);
        }

        function privacySettings() {
            // Navigate to preferences tab
            $('.tab-btn[data-tab="preferences"]').click();

            // Scroll to privacy section
            setTimeout(() => {
                const privacySection = document.querySelector('#preferences .bg-white.border-gray-200:nth-child(3)');
                if (privacySection) {
                    privacySection.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }

        function connectLinkedIn() {
            Swal.fire({
                title: 'Connecter LinkedIn',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Connectez votre compte LinkedIn pour:</p>
                        <ul class="list-disc pl-5 mb-4 space-y-2 text-gray-600">
                            <li>Étendre votre réseau professionnel</li>
                            <li>Partager vos activités bénévoles</li>
                            <li>Découvrir des opportunités de partenariat</li>
                        </ul>
                        <div class="text-center">
                            <button onclick="connectLinkedInOAuth()" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                <i class="fab fa-linkedin mr-2"></i>
                                Se connecter avec LinkedIn
                            </button>
                        </div>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                cancelButtonText: 'Plus tard',
                confirmButtonText: false,
                showConfirmButton: false
            });
        }

        function connectLinkedInOAuth() {
            Swal.fire({
                title: 'Redirection...',
                text: 'Vous allez être redirigé vers LinkedIn',
                icon: 'info',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        }

        function exportActivity() {
            Swal.fire({
                title: 'Exporter l\'activité',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Sélectionnez la période à exporter:</p>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
                                <input type="date" id="exportStartDate" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="${getDateString(-30)}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
                                <input type="date" id="exportEndDate" class="form-input w-full p-3 border border-gray-300 rounded-lg" value="${getDateString(0)}">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Format d'export</label>
                            <select id="exportFormat" class="form-input w-full p-3 border border-gray-300 rounded-lg">
                                <option value="pdf">PDF (Recommandé)</option>
                                <option value="csv">CSV (Données brutes)</option>
                                <option value="json">JSON (Pour développeurs)</option>
                            </select>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Exporter',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Génération en cours...',
                        text: 'Votre fichier est en cours de préparation',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        Swal.fire({
                            title: 'Export terminé!',
                            text: 'Votre fichier est prêt à être téléchargé',
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    }, 3000);
                }
            });
        }

        function downloadData() {
            Swal.fire({
                title: 'Télécharger mes données',
                text: 'Voulez-vous télécharger toutes vos données personnelles au format ZIP?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Télécharger',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Préparation des données...',
                        text: 'Vos données sont en cours de préparation. Cela peut prendre quelques minutes.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        Swal.fire({
                            title: 'Données prêtes!',
                            text: 'Votre fichier ZIP est prêt à être téléchargé.',
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    }, 4000);
                }
            });
        }

        function deleteAccount() {
            Swal.fire({
                title: 'Supprimer mon compte',
                html: `
                    <div class="text-left">
                        <div class="p-4 bg-red-50 rounded-lg mb-4">
                            <p class="text-red-800 font-medium mb-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Attention: Cette action est irréversible!
                            </p>
                            <p class="text-red-700 text-sm">
                                Toutes vos données seront définitivement supprimées. Cette action ne peut pas être annulée.
                            </p>
                        </div>
                        <p class="mb-4">Pour confirmer la suppression, veuillez saisir votre mot de passe:</p>
                        <input type="password" id="deletePassword" class="form-input w-full p-3 border border-gray-300 rounded-lg" placeholder="Votre mot de passe">
                        <p class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-2"></i>
                            Vous recevrez un email de confirmation une fois la suppression terminée.
                        </p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Supprimer définitivement',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                backdrop: 'rgba(0,0,0,0.4)',
                preConfirm: () => {
                    const password = document.getElementById('deletePassword').value;
                    if (!password) {
                        Swal.showValidationMessage('Le mot de passe est requis');
                        return false;
                    }
                    return { password: password };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Suppression en cours...',
                        text: 'Votre compte est en cours de suppression. Cette opération peut prendre quelques minutes.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        }

        // Utility functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR');
        }

        function getDateString(daysOffset) {
            const date = new Date();
            date.setDate(date.getDate() + daysOffset);
            return date.toISOString().split('T')[0];
        }
    </script>
@endsection
