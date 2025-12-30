@extends('_partials.master')

@section('title', 'Tableau de Bord | Bantou-Foundation')
@section('description', 'Tableau de bord personnel pour gérer vos dons, adhésions, bénévolat et partenariats.')

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

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .animate-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
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

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
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

        /* Loading animation */
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

        <!-- Dashboard Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div
                class="rounded-2xl bg-gradient-to-r from-blue-900 to-indigo-900 p-6 sm:p-8 shadow-2xl overflow-hidden relative">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60"
                        height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none"
                        fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath
                        d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                        /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div class="text-white mb-6 md:mb-0">
                        <h1 class="text-3xl sm:text-4xl font-bold mb-2">Bonjour, {{ Auth::user()->name ?? 'Membre' }}! 👋
                        </h1>
                        <p class="text-blue-200 mb-4">Bienvenue sur votre tableau de bord personnel</p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-800 text-blue-100">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Membre depuis:
                            </span>
                            @if (Auth::user()->is_volunteer ?? false)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white">
                                    <i class="fas fa-hands-helping mr-2"></i>
                                    Bénévole actif
                                </span>
                            @endif
                            @if (Auth::user()->is_donor ?? false)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500 text-white">
                                    <i class="fas fa-heart mr-2"></i>
                                    Donateur
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="relative">
                        <!-- Photo de profil fictive avec placeholder d'image -->
                        <div
                            class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-blue-200 to-indigo-200 flex items-center justify-center overflow-hidden border-4 border-yellow-400 shadow-xl">
                            <!-- Image de profil fictive avec fallback -->
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                alt="Photo de profil de {{ Auth::user()->name ?? 'Membre' }}"
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iNTAiIGN5PSI1MCIgcj0iNTAiIGZpbGw9IiMxRTQwQTkiLz48dGV4dCB4PSI1MCIgeT0iNTUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSI0MCIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIwLjNlbSI+eyUgaWYgQXV0aDo6dXNlcigpLm5hbWUgJX17eyBBdXRoOjp1c2VyKCkubmFtZS5jaGFyQXQoMCkgfX17JSBlbHNlICV9TXslIGVuZGlmICV9PC90ZXh0Pjwvc3ZnPg=='">
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm border-2 border-white shadow-lg">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Statistics Grid -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Donations Card -->
                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-green-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Dons</p>
                            <h3 id="donationsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-heart text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <p id="donationsTotal" class="text-gray-600 text-sm">Total: <span class="font-semibold">0 FCFA</span>
                    </p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                            <span>0% depuis le mois dernier</span>
                        </div>
                    </div>
                </div>

                <!-- Memberships Card -->
                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-blue-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Adhésions</p>
                            <h3 id="membershipsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-user-check text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <p id="membershipType" class="text-gray-600 text-sm">Statut: <span class="font-semibold">Aucune</span>
                    </p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('adhesion') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            <span>Adhérer maintenant</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Volunteering Card -->
                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Bénévolat</p>
                            <h3 id="volunteeringHours" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-hands-helping text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Heures de bénévolat</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock text-yellow-500 mr-2"></i>
                            <span>Engagement: Non défini</span>
                        </div>
                    </div>
                </div>

                <!-- Partnerships Card -->
                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-purple-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Partenariats</p>
                            <h3 id="partnershipsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-handshake text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Statut: <span class="font-semibold">Aucun</span></p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('partenaire') }}"
                            class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                            <span>Devenir partenaire</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Tabs Container -->
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="glass-effect rounded-2xl p-6 shadow-lg mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                            Actions Rapides
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('don') }}"
                                class="group bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-blue-100 hover:border-blue-300 text-center">
                                <div
                                    class="bg-blue-100 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-heart text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-blue-700">Faire un don</span>
                            </a>

                            <a href="{{ route('adhesion') }}"
                                class="group bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-blue-100 hover:border-blue-300 text-center">
                                <div
                                    class="bg-blue-100 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-user-plus text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-blue-700">Adhérer</span>
                            </a>

                            <a href="{{ route('benevole') }}"
                                class="group bg-gradient-to-br from-white to-yellow-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-yellow-100 hover:border-yellow-300 text-center">
                                <div
                                    class="bg-yellow-100 text-yellow-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-hands-helping text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-yellow-700">Devenir bénévole</span>
                            </a>

                            <a href="{{ route('partenaire') }}"
                                class="group bg-gradient-to-br from-white to-purple-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-purple-100 hover:border-purple-300 text-center">
                                <div
                                    class="bg-purple-100 text-purple-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-handshake text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-purple-700">Devenir
                                    partenaire</span>
                            </a>

                            <a href="{{ route('user_profil') }}"
                                class="group bg-gradient-to-br from-white to-gray-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-gray-300 text-center">
                                <div
                                    class="bg-gray-100 text-gray-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-user-cog text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-gray-700">Mon profil</span>
                            </a>

                            <a href="{{ route('historique') }}"
                                class="group bg-gradient-to-br from-white to-gray-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-gray-300 text-center">
                                <div
                                    class="bg-gray-100 text-gray-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-history text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-700 group-hover:text-gray-700">Historique</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="glass-effect rounded-2xl p-6 shadow-lg">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-history text-blue-500 mr-3"></i>
                            Activités récentes
                        </h2>
                        <div class="space-y-4 max-h-80 overflow-y-auto custom-scrollbar pr-2">
                            <div id="recentActivities">
                                <!-- Activities will be loaded here -->
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <a href="#"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center justify-center">
                                <span>Voir toutes les activités</span>
                                <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Tabs -->
                <div class="lg:col-span-2">
                    <div class="glass-effect rounded-2xl shadow-lg overflow-hidden">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200">
                            <nav class="flex flex-wrap -mb-px">
                                <button data-tab="dons"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-heart mr-2"></i>
                                    Mes Dons
                                </button>
                                <button data-tab="adhesions"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-user-check mr-2"></i>
                                    Mes Adhésions
                                </button>
                                <button data-tab="benevolat"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-hands-helping mr-2"></i>
                                    Mon Bénévolat
                                </button>
                                <button data-tab="partenariats"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-handshake mr-2"></i>
                                    Mes Partenariats
                                </button>
                                <button data-tab="documents"
                                    class="tab-btn inline-flex items-center py-4 px-6 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    <i class="fas fa-folder mr-2"></i>
                                    Documents
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-6">
                            <!-- Dons Tab -->
                            <div id="dons" class="tab-pane">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-gray-800">Historique de mes dons</h3>
                                    <button onclick="exportDonations()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-download mr-2"></i>
                                        Exporter
                                    </button>
                                </div>
                                <div id="donationsLoading" class="loading">
                                    <!-- Loading animation -->
                                </div>
                                <div id="donationsContent" style="display: none;">
                                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Montant</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Méthode</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Statut</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="donationsList" class="bg-white divide-y divide-gray-200">
                                                <!-- Donations will be loaded here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Adhésions Tab -->
                            <div id="adhesions" class="tab-pane hidden">
                                <div id="membershipsLoading" class="loading">
                                    <!-- Loading animation -->
                                </div>
                                <div id="membershipsContent" style="display: none;">
                                    <div class="max-w-2xl mx-auto">
                                        <div class="gradient-border rounded-2xl p-8 text-center">
                                            <div
                                                class="bg-blue-100 text-blue-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                                <i class="fas fa-user-check text-3xl"></i>
                                            </div>
                                            <h3 id="membershipStatus" class="text-2xl font-bold text-gray-800 mb-3">Non
                                                adhérent</h3>
                                            <p id="membershipDetails" class="text-gray-600 mb-6">Vous n'avez pas encore
                                                adhéré à la fondation</p>
                                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                                <a href="{{ route('adhesion') }}"
                                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                                                    <i class="fas fa-user-plus mr-2"></i>
                                                    Adhérer maintenant
                                                </a>
                                                <a href="#"
                                                    class="inline-flex items-center px-6 py-3 bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-colors">
                                                    <i class="fas fa-question-circle mr-2"></i>
                                                    En savoir plus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bénévolat Tab -->
                            <div id="benevolat" class="tab-pane hidden">
                                <div id="volunteeringLoading" class="loading">
                                    <!-- Loading animation -->
                                </div>
                                <div id="volunteeringContent" style="display: none;">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                        <div
                                            class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-6 border border-yellow-100">
                                            <div class="text-center">
                                                <div class="text-3xl font-bold text-yellow-600 mb-2" id="totalHours">0
                                                </div>
                                                <div class="text-sm font-medium text-gray-700">Heures totales</div>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-6 border border-yellow-100">
                                            <div class="text-center">
                                                <div class="text-3xl font-bold text-yellow-600 mb-2"
                                                    id="completedMissions">0</div>
                                                <div class="text-sm font-medium text-gray-700">Missions terminées</div>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-6 border border-yellow-100">
                                            <div class="text-center">
                                                <div class="text-xl font-bold text-yellow-600 mb-2" id="mainDomain">Aucun
                                                </div>
                                                <div class="text-sm font-medium text-gray-700">Domaine principal</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                            <h4 class="font-bold text-gray-800">Mes missions</h4>
                                        </div>
                                        <div class="divide-y divide-gray-100" id="missionsList">
                                            <!-- Missions will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Partenariats Tab -->
                            <div id="partenariats" class="tab-pane hidden">
                                <div id="partnershipsLoading" class="loading">
                                    <!-- Loading animation -->
                                </div>
                                <div id="partnershipsContent" style="display: none;">
                                    <div id="partnershipsList">
                                        <!-- Partnerships will be loaded here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div id="documents" class="tab-pane hidden">
                                <h3 class="text-lg font-bold text-gray-800 mb-6">Mes documents</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                    <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl p-6 border border-blue-100 hover:border-blue-300 transition-colors cursor-pointer"
                                        onclick="generateReceipt()">
                                        <div
                                            class="bg-blue-100 text-blue-600 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-file-invoice text-2xl"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800 text-center mb-2">Reçu fiscal</h4>
                                        <p class="text-gray-600 text-sm text-center">Générez votre reçu fiscal pour
                                            déduction</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-white to-yellow-50 rounded-xl p-6 border border-yellow-100 hover:border-yellow-300 transition-colors cursor-pointer"
                                        onclick="downloadCertificate()">
                                        <div
                                            class="bg-yellow-100 text-yellow-600 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-award text-2xl"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800 text-center mb-2">Certificat de bénévolat</h4>
                                        <p class="text-gray-600 text-sm text-center">Téléchargez votre certificat de
                                            bénévolat</p>
                                    </div>

                                    <a href=""
                                        class="bg-gradient-to-br from-white to-gray-50 rounded-xl p-6 border border-gray-100 hover:border-gray-300 transition-colors">
                                        <div
                                            class="bg-gray-100 text-gray-600 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-folder-open text-2xl"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800 text-center mb-2">Tous mes documents</h4>
                                        <p class="text-gray-600 text-sm text-center">Accédez à l'ensemble de vos documents
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Initialize dashboard
            initializeDashboard();

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

                // Load data for the selected tab
                loadTabData(tabId);
            });

            // Set first tab as active
            $('.tab-btn:first').addClass('text-blue-600 border-blue-600');

            // Check for URL hash to open specific tab
            const hash = window.location.hash.substring(1);
            if (hash && $(`.tab-btn[data-tab="${hash}"]`).length) {
                $(`.tab-btn[data-tab="${hash}"]`).click();
            }
        });

        function initializeDashboard() {
            // Load dashboard stats
            loadDashboardStats();

            // Load recent activities
            loadRecentActivities();

            // Load initial tab data
            loadTabData('dons');
        }

        function loadDashboardStats() {
            // Simulate API call with loading animation
            simulateLoading('.stat-card h3', 800);

            // Sample data - Replace with actual API calls
            setTimeout(() => {
                $('#donationsCount').text('3');
                $('#donationsTotal').html('Total: <span class="font-semibold">65 000 FCFA</span>');

                $('#membershipsCount').text('1');
                $('#membershipType').html('Statut: <span class="font-semibold text-green-600">Membre actif</span>');

                $('#volunteeringHours').text('48');
                $('#partnershipsCount').text('2');
            }, 800);
        }

        function loadTabData(tabId) {
            // Show loading for the specific tab
            $(`#${tabId}Loading`).show().html(`
        <div class="flex justify-center items-center py-12">
            <div class="loading-spinner w-12 h-12 border-4 border-gray-200 rounded-full"></div>
        </div>
    `);
            $(`#${tabId}Content`).hide();

            // Simulate API call based on tab
            setTimeout(() => {
                $(`#${tabId}Loading`).hide();
                $(`#${tabId}Content`).show();

                switch (tabId) {
                    case 'dons':
                        loadDonations();
                        break;
                    case 'adhesions':
                        loadMemberships();
                        break;
                    case 'benevolat':
                        loadVolunteering();
                        break;
                    case 'partenariats':
                        loadPartnerships();
                        break;
                }
            }, 600);
        }

        function loadDonations() {
            const donations = [{
                    id: 1,
                    date: '15/01/2024',
                    amount: '25 000 FCFA',
                    method: 'Orange Money',
                    status: 'Complété',
                    statusColor: 'bg-green-100 text-green-800'
                },
                {
                    id: 2,
                    date: '10/12/2023',
                    amount: '15 000 FCFA',
                    method: 'MTN Mobile Money',
                    status: 'Complété',
                    statusColor: 'bg-green-100 text-green-800'
                },
                {
                    id: 3,
                    date: '05/11/2023',
                    amount: '25 000 FCFA',
                    method: 'Carte Bancaire',
                    status: 'Complété',
                    statusColor: 'bg-green-100 text-green-800'
                }
            ];

            let html = '';
            donations.forEach(donation => {
                html += `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${donation.date}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">${donation.amount}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${donation.method}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${donation.statusColor}">
                        ${donation.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewReceipt(${donation.id})" class="text-blue-600 hover:text-blue-900 mr-4">
                        <i class="fas fa-file-invoice mr-1"></i> Reçu
                    </button>
                    <button onclick="viewDonationDetails(${donation.id})" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-eye mr-1"></i> Détails
                    </button>
                </td>
            </tr>
        `;
            });

            $('#donationsList').html(html || `
        <tr>
            <td colspan="5" class="px-6 py-12 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-heart text-4xl"></i>
                </div>
                <p class="text-gray-500">Aucun don trouvé</p>
                <a href="{{ route('don') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Faire mon premier don
                </a>
            </td>
        </tr>
    `);
        }

        function loadMemberships() {
            // Sample membership data
            $('#membershipStatus').text('Membre Actif');
            $('#membershipDetails').html(`
        <div class="space-y-2">
            <p class="flex items-center justify-center">
                <i class="fas fa-calendar-check text-blue-500 mr-2"></i>
                <span>Date d'adhésion: <strong>15/01/2024</strong></span>
            </p>
            <p class="flex items-center justify-center">
                <i class="fas fa-tag text-blue-500 mr-2"></i>
                <span>Type: <strong>Membre actif avec cotisation annuelle</strong></span>
            </p>
            <p class="flex items-center justify-center">
                <i class="fas fa-clock text-blue-500 mr-2"></i>
                <span>Prochaine échéance: <strong>15/01/2025</strong></span>
            </p>
        </div>
    `);
        }

        function loadVolunteering() {
            // Sample volunteering data
            $('#totalHours').text('48');
            $('#completedMissions').text('3');
            $('#mainDomain').text('Éducation');

            $('#missionsList').html(`
        <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="flex justify-between">
                        <h5 class="font-medium text-gray-900">Tutorat scolaire</h5>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            En cours
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Janvier 2024 - Présent • 20 heures</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                            <i class="fas fa-map-marker-alt mr-1"></i> Yaoundé
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-users mr-1"></i> Éducation
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-hand-holding-usd text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="flex justify-between">
                        <h5 class="font-medium text-gray-900">Collecte de fonds</h5>
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            Terminé
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Décembre 2023 • 18 heures</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                            <i class="fas fa-map-marker-alt mr-1"></i> Douala
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-hands-helping mr-1"></i> Financement
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `);
        }

        function loadPartnerships() {
            $('#partnershipsList').html(`
        <div class="max-w-2xl mx-auto">
            <div class="gradient-border rounded-2xl p-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-handshake text-2xl text-purple-600"></i>
                        </div>
                    </div>
                    <div class="ml-6 flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Partenariat Événementiel</h3>
                        <div class="space-y-2 mb-6">
                            <p class="text-gray-600 flex items-center">
                                <i class="fas fa-calendar-alt text-purple-500 mr-3"></i>
                                <span>Soumis le: <strong>20/01/2024</strong></span>
                            </p>
                            <p class="text-gray-600 flex items-center">
                                <i class="fas fa-tag text-purple-500 mr-3"></i>
                                <span>Type: <strong>Événementiel</strong></span>
                            </p>
                            <p class="text-gray-600 flex items-center">
                                <i class="fas fa-hourglass-half text-purple-500 mr-3"></i>
                                <span>Statut: <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">En attente de validation</span></span>
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <button onclick="viewPartnershipDetails(1)" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                Voir les détails
                            </button>
                            <button onclick="contactSupport()" class="inline-flex items-center px-4 py-2 bg-white border border-purple-600 text-purple-600 hover:bg-purple-50 rounded-lg font-medium transition-colors">
                                <i class="fas fa-question-circle mr-2"></i>
                                Contacter le support
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);
        }

        function loadRecentActivities() {
            const activities = [{
                    icon: 'fa-heart',
                    iconColor: 'text-red-500',
                    bgColor: 'bg-red-100',
                    title: 'Don effectué',
                    description: '25 000 FCFA via Orange Money',
                    time: 'Il y a 2 jours',
                    timeColor: 'text-blue-600'
                },
                {
                    icon: 'fa-user-check',
                    iconColor: 'text-blue-500',
                    bgColor: 'bg-blue-100',
                    title: 'Adhésion confirmée',
                    description: 'Devenu membre actif de la fondation',
                    time: 'Il y a 1 semaine',
                    timeColor: 'text-green-600'
                },
                {
                    icon: 'fa-hands-helping',
                    iconColor: 'text-yellow-500',
                    bgColor: 'bg-yellow-100',
                    title: 'Mission de bénévolat',
                    description: 'A commencé le tutorat scolaire',
                    time: 'Il y a 2 semaines',
                    timeColor: 'text-purple-600'
                },
                {
                    icon: 'fa-handshake',
                    iconColor: 'text-purple-500',
                    bgColor: 'bg-purple-100',
                    title: 'Demande de partenariat',
                    description: 'Nouvelle demande soumise',
                    time: 'Il y a 3 semaines',
                    timeColor: 'text-gray-600'
                }
            ];

            let html = '';
            activities.forEach(activity => {
                html += `
            <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex-shrink-0">
                    <div class="${activity.bgColor} w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fas ${activity.icon} ${activity.iconColor}"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <div class="flex justify-between">
                        <h4 class="text-sm font-medium text-gray-900">${activity.title}</h4>
                        <span class="text-xs ${activity.timeColor} font-medium">${activity.time}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">${activity.description}</p>
                </div>
            </div>
        `;
            });

            $('#recentActivities').html(html);
        }

        function simulateLoading(selector, duration) {
            $(selector).each(function() {
                const $element = $(this);
                const originalText = $element.text();
                $element.html('<span class="inline-block w-16 h-6 bg-gray-200 rounded animate-pulse"></span>');

                setTimeout(() => {
                    $element.text(originalText);
                }, duration);
            });
        }

        function viewReceipt(donationId) {
            Swal.fire({
                title: 'Téléchargement du reçu',
                html: `Voulez-vous télécharger le reçu pour le don #${donationId}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Télécharger',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate download
                    Swal.fire({
                        title: 'Téléchargement',
                        text: 'Votre reçu est en cours de téléchargement...',
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        }

        function viewDonationDetails(donationId) {
            Swal.fire({
                title: 'Détails du don',
                html: `
            <div class="text-left">
                <p class="mb-2"><strong>ID:</strong> #${donationId}</p>
                <p class="mb-2"><strong>Date:</strong> 15/01/2024</p>
                <p class="mb-2"><strong>Montant:</strong> 25 000 FCFA</p>
                <p class="mb-2"><strong>Méthode:</strong> Orange Money</p>
                <p class="mb-2"><strong>Statut:</strong> <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Complété</span></p>
                <p class="mt-4 text-sm text-gray-500">Transaction ID: TXN-${donationId}234567</p>
            </div>
        `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#3b82f6'
            });
        }

        function generateReceipt() {
            Swal.fire({
                title: 'Générer un reçu fiscal',
                html: `
            <div class="text-left">
                <p class="mb-4">Sélectionnez l'année fiscale pour laquelle vous souhaitez générer un reçu:</p>
                <select id="fiscalYear" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="2023">2023</option>
                    <option value="2024" selected>2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Générer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    const year = document.getElementById('fiscalYear').value;
                    return {
                        year: year
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Génération en cours',
                        html: `Génération du reçu fiscal pour ${result.value.year}...`,
                        icon: 'info',
                        timer: 2500,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Reçu généré!',
                            text: 'Votre reçu fiscal est prêt à être téléchargé.',
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    });
                }
            });
        }

        function downloadCertificate() {
            Swal.fire({
                title: 'Certificat de bénévolat',
                text: 'Voulez-vous télécharger votre certificat de bénévolat?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Télécharger',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Téléchargement',
                        text: 'Votre certificat est en cours de téléchargement...',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        }

        function exportDonations() {
            Swal.fire({
                title: 'Exporter les données',
                html: `
            <div class="text-left">
                <p class="mb-4">Choisissez le format d'export:</p>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="radio" id="formatPdf" name="exportFormat" value="pdf" checked class="mr-3">
                        <label for="formatPdf" class="flex items-center cursor-pointer">
                            <i class="fas fa-file-pdf text-red-500 text-xl mr-2"></i>
                            <span>PDF (Recommandé)</span>
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="formatExcel" name="exportFormat" value="excel" class="mr-3">
                        <label for="formatExcel" class="flex items-center cursor-pointer">
                            <i class="fas fa-file-excel text-green-500 text-xl mr-2"></i>
                            <span>Excel (Pour l'analyse)</span>
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="formatCsv" name="exportFormat" value="csv" class="mr-3">
                        <label for="formatCsv" class="flex items-center cursor-pointer">
                            <i class="fas fa-file-csv text-blue-500 text-xl mr-2"></i>
                            <span>CSV (Données brutes)</span>
                        </label>
                    </div>
                </div>
            </div>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Exporter',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    const format = document.querySelector('input[name="exportFormat"]:checked').value;
                    return {
                        format: format
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Export en cours',
                        text: `Génération du fichier ${result.value.format.toUpperCase()}...`,
                        icon: 'info',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Export terminé!',
                            text: 'Votre fichier a été généré avec succès.',
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    });
                }
            });
        }

        function viewPartnershipDetails(id) {
            Swal.fire({
                title: 'Détails du partenariat',
                width: '700px',
                html: `
            <div class="text-left space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">ID Partenariat</p>
                        <p class="font-medium">#P${id}2024</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date de soumission</p>
                        <p class="font-medium">20/01/2024</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="font-medium">Événementiel</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Statut</p>
                        <p class="font-medium"><span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">En attente de validation</span></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-2">Description</p>
                    <p class="bg-gray-50 p-4 rounded-lg">Partenariat pour l'organisation d'un événement caritatif annuel visant à collecter des fonds pour l'éducation des enfants en milieu rural.</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-2">Échéance estimée</p>
                    <p class="font-medium">15/02/2024</p>
                </div>
            </div>
        `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#8b5cf6',
                showCloseButton: true
            });
        }

        function contactSupport() {
            Swal.fire({
                title: 'Contacter le support',
                html: `
            <div class="text-left space-y-4">
                <p class="text-gray-600">Vous pouvez contacter notre équipe de support pour toute question concernant votre partenariat.</p>
                <div class="space-y-2">
                    <p class="flex items-center">
                        <i class="fas fa-envelope text-blue-500 mr-3"></i>
                        <span>support@bantou-foundation.org</span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-phone text-blue-500 mr-3"></i>
                        <span>+237 6XX XXX XXX</span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-clock text-blue-500 mr-3"></i>
                        <span>Lun - Ven: 8h00 - 18h00</span>
                    </p>
                </div>
            </div>
        `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#3b82f6',
                showCloseButton: true
            });
        }

        // Poll for new notifications (simulated)
        setInterval(() => {
            // In a real app, this would check for new activities via AJAX
            console.log('Checking for new activities...');
        }, 30000);
    </script>
@endsection
