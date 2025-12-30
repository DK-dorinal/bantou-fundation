@extends('_partials.master')

@section('title', 'Historique des Actions | Bantou-Foundation')
@section('description', 'Consultez l\'historique complet de vos dons, adhésions, bénévolat et partenariats.')

@section('styles')
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            --pink: #ec4899;
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

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #e5e7eb;
        }

        .timeline-item:last-child::before {
            bottom: 50%;
        }

        .timeline-dot {
            position: absolute;
            left: -10px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .activity-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }

        .filter-btn.active {
            background-color: var(--medium-blue);
            color: white;
            border-color: var(--medium-blue);
        }

        .history-card {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--light-blue);
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

        /* Status badges */
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-in-progress {
            background-color: #dbeafe;
            color: #1e40af;
        }

        /* Activity type colors */
        .activity-donation {
            border-left-color: #10b981;
        }

        .activity-membership {
            border-left-color: #3b82f6;
        }

        .activity-volunteering {
            border-left-color: #f59e0b;
        }

        .activity-partnership {
            border-left-color: #8b5cf6;
        }

        .activity-other {
            border-left-color: #6b7280;
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Historique des Actions</h1>
                    <p class="text-gray-600">Consultez l'ensemble de vos activités et contributions à Bantou-Foundation</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="exportHistory()"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                        <i class="fas fa-download mr-2"></i>
                        Exporter
                    </button>
                    <a href="{{ route('user_dashboard') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Overview -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-heart text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total des dons</p>
                            <h3 class="text-2xl font-bold text-gray-800" id="totalDonations">65 000 FCFA</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-2"></i>
                            <span>3 dons effectués</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Heures de bénévolat</p>
                            <h3 class="text-2xl font-bold text-gray-800" id="totalVolunteering">48h</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-blue-600">
                            <i class="fas fa-users mr-2"></i>
                            <span>2 missions complétées</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-handshake text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Partenariats</p>
                            <h3 class="text-2xl font-bold text-gray-800" id="totalPartnerships">1 actif</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-purple-600">
                            <i class="fas fa-hourglass-half mr-2"></i>
                            <span>1 en attente</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-alt text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Période couverte</p>
                            <h3 class="text-xl font-bold text-gray-800">Depuis 2023</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-yellow-600">
                            <i class="fas fa-history mr-2"></i>
                            <span>12 mois d'activité</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="glass-effect rounded-xl p-6 shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Date Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                            <input type="text" id="dateRange" class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Sélectionner une période">
                        </div>
                    </div>

                    <!-- Activity Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type d'activité</label>
                        <select id="activityType" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">Tous les types</option>
                            <option value="donation">Dons</option>
                            <option value="membership">Adhésions</option>
                            <option value="volunteering">Bénévolat</option>
                            <option value="partnership">Partenariats</option>
                            <option value="other">Autres</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <select id="statusFilter" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">Tous les statuts</option>
                            <option value="completed">Complété</option>
                            <option value="pending">En attente</option>
                            <option value="in-progress">En cours</option>
                            <option value="cancelled">Annulé</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <button class="filter-btn px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors active" data-filter="all">
                        Toutes les activités
                    </button>
                    <button class="filter-btn px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors" data-filter="donation">
                        <i class="fas fa-heart mr-2 text-red-500"></i>Dons
                    </button>
                    <button class="filter-btn px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors" data-filter="volunteering">
                        <i class="fas fa-hands-helping mr-2 text-yellow-500"></i>Bénévolat
                    </button>
                    <button class="filter-btn px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors" data-filter="membership">
                        <i class="fas fa-user-check mr-2 text-blue-500"></i>Adhésions
                    </button>
                    <button class="filter-btn px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors" data-filter="partnership">
                        <i class="fas fa-handshake mr-2 text-purple-500"></i>Partenariats
                    </button>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        <span id="resultsCount">8 activités trouvées</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="clearFilters()" class="text-sm text-gray-600 hover:text-gray-800">
                            <i class="fas fa-times mr-1"></i> Effacer les filtres
                        </button>
                        <button onclick="applyFilters()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-filter mr-2"></i> Appliquer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Timeline View -->
                <div class="lg:col-span-2">
                    <div class="glass-effect rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-bold text-gray-800">Chronologie des activités</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-8 max-h-[600px] overflow-y-auto custom-scrollbar pr-2">
                                <!-- Timeline Item: Donation -->
                                <div class="timeline-item" data-type="donation" data-status="completed">
                                    <div class="timeline-dot bg-green-500"></div>
                                    <div class="history-card activity-donation bg-white rounded-lg p-5 border-l-4 border-green-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-heart text-green-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Don effectué</h3>
                                                    <p class="text-sm text-gray-500">25 000 FCFA via Orange Money</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Complété</span>
                                                <span class="text-sm text-gray-500">15/01/2024</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">Transaction #DON-2024-001 • Reçu généré</p>
                                            <div class="mt-3 flex space-x-2">
                                                <button onclick="viewDonationDetails(1)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye mr-1"></i> Voir les détails
                                                </button>
                                                <button onclick="downloadReceipt(1)" class="text-sm text-green-600 hover:text-green-800">
                                                    <i class="fas fa-download mr-1"></i> Reçu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Membership -->
                                <div class="timeline-item" data-type="membership" data-status="completed">
                                    <div class="timeline-dot bg-blue-500"></div>
                                    <div class="history-card activity-membership bg-white rounded-lg p-5 border-l-4 border-blue-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-user-check text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Adhésion confirmée</h3>
                                                    <p class="text-sm text-gray-500">Devenu membre actif</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Complété</span>
                                                <span class="text-sm text-gray-500">10/01/2024</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">Type: Membre actif • Prochaine échéance: 10/01/2025</p>
                                            <div class="mt-3">
                                                <button onclick="viewMembershipDetails()" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-id-card mr-1"></i> Voir la carte de membre
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Volunteering -->
                                <div class="timeline-item" data-type="volunteering" data-status="in-progress">
                                    <div class="timeline-dot bg-yellow-500"></div>
                                    <div class="history-card activity-volunteering bg-white rounded-lg p-5 border-l-4 border-yellow-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-hands-helping text-yellow-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Mission de bénévolat</h3>
                                                    <p class="text-sm text-gray-500">Tutorat scolaire</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-in-progress mb-2">En cours</span>
                                                <span class="text-sm text-gray-500">05/01/2024 - Présent</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">20 heures complétées • Centre éducatif de Yaoundé</p>
                                            <div class="mt-3 flex space-x-2">
                                                <button onclick="viewMissionDetails(1)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-tasks mr-1"></i> Progression
                                                </button>
                                                <button onclick="downloadCertificate()" class="text-sm text-yellow-600 hover:text-yellow-800">
                                                    <i class="fas fa-award mr-1"></i> Certificat
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Partnership -->
                                <div class="timeline-item" data-type="partnership" data-status="pending">
                                    <div class="timeline-dot bg-purple-500"></div>
                                    <div class="history-card activity-partnership bg-white rounded-lg p-5 border-l-4 border-purple-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-handshake text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Demande de partenariat</h3>
                                                    <p class="text-sm text-gray-500">Événementiel</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-pending mb-2">En attente</span>
                                                <span class="text-sm text-gray-500">20/12/2023</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">En attente de validation • Échéance: 20/02/2024</p>
                                            <div class="mt-3">
                                                <button onclick="viewPartnershipDetails(1)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-file-contract mr-1"></i> Voir la proposition
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Donation -->
                                <div class="timeline-item" data-type="donation" data-status="completed">
                                    <div class="timeline-dot bg-green-500"></div>
                                    <div class="history-card activity-donation bg-white rounded-lg p-5 border-l-4 border-green-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-heart text-green-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Don effectué</h3>
                                                    <p class="text-sm text-gray-500">15 000 FCFA via MTN Mobile Money</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Complété</span>
                                                <span class="text-sm text-gray-500">10/12/2023</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">Transaction #DON-2023-012 • Reçu généré</p>
                                            <div class="mt-3 flex space-x-2">
                                                <button onclick="viewDonationDetails(2)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye mr-1"></i> Détails
                                                </button>
                                                <button onclick="downloadReceipt(2)" class="text-sm text-green-600 hover:text-green-800">
                                                    <i class="fas fa-download mr-1"></i> Reçu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Volunteering -->
                                <div class="timeline-item" data-type="volunteering" data-status="completed">
                                    <div class="timeline-dot bg-yellow-500"></div>
                                    <div class="history-card activity-volunteering bg-white rounded-lg p-5 border-l-4 border-yellow-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-hands-helping text-yellow-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Collecte de fonds</h3>
                                                    <p class="text-sm text-gray-500">Mission de bénévolat</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Terminé</span>
                                                <span class="text-sm text-gray-500">15-22/12/2023</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">18 heures • Centre commercial de Douala</p>
                                            <div class="mt-3">
                                                <button onclick="viewMissionDetails(2)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-file-alt mr-1"></i> Rapport
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Donation -->
                                <div class="timeline-item" data-type="donation" data-status="completed">
                                    <div class="timeline-dot bg-green-500"></div>
                                    <div class="history-card activity-donation bg-white rounded-lg p-5 border-l-4 border-green-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-heart text-green-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Premier don</h3>
                                                    <p class="text-sm text-gray-500">25 000 FCFA via Carte Bancaire</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Complété</span>
                                                <span class="text-sm text-gray-500">05/11/2023</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">Transaction #DON-2023-011 • Merci pour votre générosité!</p>
                                            <div class="mt-3 flex space-x-2">
                                                <button onclick="viewDonationDetails(3)" class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye mr-1"></i> Détails
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item: Other -->
                                <div class="timeline-item" data-type="other" data-status="completed">
                                    <div class="timeline-dot bg-gray-500"></div>
                                    <div class="history-card activity-other bg-white rounded-lg p-5 border-l-4 border-gray-500">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="bg-gray-100 p-2 rounded-lg mr-3">
                                                    <i class="fas fa-user-plus text-gray-600"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800">Compte créé</h3>
                                                    <p class="text-sm text-gray-500">Inscription sur la plateforme</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="activity-badge status-completed mb-2">Complété</span>
                                                <span class="text-sm text-gray-500">01/11/2023</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-gray-600 text-sm">Bienvenue dans la communauté Bantou-Foundation!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Load More -->
                            <div class="mt-8 text-center">
                                <button onclick="loadMoreActivities()" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                    <i class="fas fa-plus mr-2"></i> Charger plus d'activités
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary & Export -->
                <div class="lg:col-span-1">
                    <!-- Summary Card -->
                    <div class="glass-effect rounded-xl p-6 shadow-lg mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-chart-bar text-blue-500 mr-3"></i>
                            Résumé par catégorie
                        </h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-heart text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Dons</p>
                                        <p class="text-sm text-gray-500">3 transactions</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">65 000 FCFA</p>
                                    <p class="text-sm text-green-600">Total</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-hands-helping text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Bénévolat</p>
                                        <p class="text-sm text-gray-500">2 missions</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">48 heures</p>
                                    <p class="text-sm text-yellow-600">Cumulées</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-user-check text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Adhésion</p>
                                        <p class="text-sm text-gray-500">Membre actif</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">1 an</p>
                                    <p class="text-sm text-blue-600">Depuis 2024</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-handshake text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Partenariats</p>
                                        <p class="text-sm text-gray-500">1 demande</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">En attente</p>
                                    <p class="text-sm text-purple-600">Validation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Export Options -->
                    <div class="glass-effect rounded-xl p-6 shadow-lg mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-file-export text-green-500 mr-3"></i>
                            Options d'export
                        </h2>
                        <div class="space-y-3">
                            <button onclick="exportByType('donation')" class="w-full flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-heart text-green-600"></i>
                                </div>
                                <div class="text-left">
                                    <p class="font-medium text-gray-700">Exporter les dons</p>
                                    <p class="text-sm text-gray-500">PDF, Excel ou CSV</p>
                                </div>
                            </button>

                            <button onclick="exportByType('volunteering')" class="w-full flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-yellow-50 hover:border-yellow-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-hands-helping text-yellow-600"></i>
                                </div>
                                <div class="text-left">
                                    <p class="font-medium text-gray-700">Exporter le bénévolat</p>
                                    <p class="text-sm text-gray-500">Rapport détaillé</p>
                                </div>
                            </button>

                            <button onclick="exportAllHistory()" class="w-full flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-history text-blue-600"></i>
                                </div>
                                <div class="text-left">
                                    <p class="font-medium text-gray-700">Tout l'historique</p>
                                    <p class="text-sm text-gray-500">Archive complète</p>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="glass-effect rounded-xl p-6 shadow-lg">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-chart-line text-purple-500 mr-3"></i>
                            Statistiques rapides
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-blue-50 to-white p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Activité ce mois-ci</p>
                                        <p class="text-2xl font-bold text-gray-800">3</p>
                                    </div>
                                    <div class="text-green-500">
                                        <i class="fas fa-arrow-up text-2xl"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-white p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Impact total</p>
                                        <p class="text-2xl font-bold text-gray-800">113</p>
                                    </div>
                                    <div class="text-green-500">
                                        <i class="fas fa-users text-2xl"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Personnes aidées</p>
                            </div>

                            <div class="bg-gradient-to-r from-yellow-50 to-white p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500">Prochaine échéance</p>
                                        <p class="text-xl font-bold text-gray-800">10/01/2025</p>
                                    </div>
                                    <div class="text-blue-500">
                                        <i class="fas fa-calendar-check text-2xl"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Renouvellement d'adhésion</p>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('#dateRange').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Appliquer',
                    cancelLabel: 'Annuler',
                    fromLabel: 'De',
                    toLabel: 'À',
                    customRangeLabel: 'Personnalisé',
                    daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    firstDay: 1
                },
                ranges: {
                    'Aujourd\'hui': [moment(), moment()],
                    'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
                    'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
                    'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
                    'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(30, 'days'),
                endDate: moment()
            });

            // Filter buttons functionality
            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                applyFilters();
            });

            // Initialize with all activities
            updateResultsCount();
        });

        function applyFilters() {
            const typeFilter = $('#activityType').val();
            const statusFilter = $('#statusFilter').val();
            const dateRange = $('#dateRange').val();
            const buttonFilter = $('.filter-btn.active').data('filter');

            let visibleCount = 0;

            $('.timeline-item').each(function() {
                const itemType = $(this).data('type');
                const itemStatus = $(this).data('status');
                const itemDate = $(this).find('.text-gray-500:last').text().split('•')[0].trim();

                let showItem = true;

                // Apply type filters
                if (typeFilter !== 'all' && itemType !== typeFilter) {
                    showItem = false;
                }

                // Apply button filter (overrides type filter)
                if (buttonFilter !== 'all' && itemType !== buttonFilter) {
                    showItem = false;
                }

                // Apply status filter
                if (statusFilter !== 'all' && itemStatus !== statusFilter) {
                    showItem = false;
                }

                // Apply date filter (simplified for demo)
                if (dateRange && !isDateInRange(itemDate, dateRange)) {
                    showItem = false;
                }

                if (showItem) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            updateResultsCount(visibleCount);

            // Show message if no results
            if (visibleCount === 0) {
                showNoResultsMessage();
            }
        }

        function clearFilters() {
            $('#activityType').val('all');
            $('#statusFilter').val('all');
            $('#dateRange').val('');
            $('.filter-btn').removeClass('active');
            $('.filter-btn[data-filter="all"]').addClass('active');

            $('.timeline-item').show();
            updateResultsCount();
        }

        function updateResultsCount(count) {
            if (count === undefined) {
                count = $('.timeline-item').length;
            }
            $('#resultsCount').text(`${count} activité${count !== 1 ? 's' : ''} trouvée${count !== 1 ? 's' : ''}`);
        }

        function showNoResultsMessage() {
            Swal.fire({
                icon: 'info',
                title: 'Aucun résultat',
                text: 'Aucune activité ne correspond à vos critères de recherche.',
                confirmButtonText: 'Réinitialiser les filtres',
                confirmButtonColor: '#3b82f6'
            }).then((result) => {
                if (result.isConfirmed) {
                    clearFilters();
                }
            });
        }

        function isDateInRange(dateString, rangeString) {
            // Simplified date range checking for demo
            // In a real app, you would parse the dates properly
            return true;
        }

        function viewDonationDetails(donationId) {
            Swal.fire({
                title: 'Détails du don',
                width: '700px',
                html: `
                    <div class="text-left space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">ID Don</p>
                                <p class="font-medium">#DON-${donationId === 1 ? '2024-001' : donationId === 2 ? '2023-012' : '2023-011'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Date</p>
                                <p class="font-medium">${donationId === 1 ? '15/01/2024' : donationId === 2 ? '10/12/2023' : '05/11/2023'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Montant</p>
                                <p class="font-medium">${donationId === 1 ? '25 000' : donationId === 2 ? '15 000' : '25 000'} FCFA</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Méthode</p>
                                <p class="font-medium">${donationId === 1 ? 'Orange Money' : donationId === 2 ? 'MTN Mobile Money' : 'Carte Bancaire'}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Statut</p>
                            <p class="font-medium"><span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Complété</span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Transaction ID</p>
                            <p class="font-medium">TXN-${donationId}23456789</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Impact</p>
                            <p class="bg-blue-50 p-3 rounded-lg">
                                Votre don a permis de financer ${donationId === 1 ? 'des kits scolaires' : donationId === 2 ? 'des bourses partielles' : 'des infrastructures'} pour des étudiants défavorisés.
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

        function downloadReceipt(donationId) {
            Swal.fire({
                title: 'Télécharger le reçu',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Voulez-vous télécharger le reçu pour le don #DON-${donationId === 1 ? '2024-001' : donationId === 2 ? '2023-012' : '2023-011'} ?</p>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Format</label>
                            <select id="receiptFormat" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="pdf">PDF (Recommandé)</option>
                                <option value="jpg">JPG (Image)</option>
                                <option value="html">HTML (Web)</option>
                            </select>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Télécharger',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                preConfirm: () => {
                    const format = document.getElementById('receiptFormat').value;
                    return { format: format };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Téléchargement',
                        text: 'Votre reçu est en cours de téléchargement...',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        }

        function viewMembershipDetails() {
            Swal.fire({
                title: 'Adhésion',
                html: `
                    <div class="text-left space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Type</p>
                                <p class="font-medium">Membre actif</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Date d'adhésion</p>
                                <p class="font-medium">10/01/2024</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Prochaine échéance</p>
                                <p class="font-medium">10/01/2025</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Statut</p>
                                <p class="font-medium"><span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Actif</span></p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Avantages</p>
                            <ul class="list-disc pl-5 space-y-1 text-gray-700">
                                <li>Accès prioritaire aux événements</li>
                                <li>Newsletter exclusive</li>
                                <li>Réduction sur les goodies</li>
                                <li>Rapports annuels détaillés</li>
                            </ul>
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#3b82f6',
                showCloseButton: true
            });
        }

        function viewMissionDetails(missionId) {
            Swal.fire({
                title: 'Détails de la mission',
                width: '700px',
                html: `
                    <div class="text-left space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Mission</p>
                                <p class="font-medium">${missionId === 1 ? 'Tutorat scolaire' : 'Collecte de fonds'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Période</p>
                                <p class="font-medium">${missionId === 1 ? '05/01/2024 - Présent' : '15-22/12/2023'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Heures</p>
                                <p class="font-medium">${missionId === 1 ? '20 heures' : '18 heures'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lieu</p>
                                <p class="font-medium">${missionId === 1 ? 'Yaoundé' : 'Douala'}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Description</p>
                            <p class="bg-gray-50 p-3 rounded-lg">
                                ${missionId === 1 ?
                                    'Tutorat scolaire pour enfants défavorisés dans le centre éducatif de Yaoundé. Matières principales: Mathématiques et Français.' :
                                    'Collecte de fonds pour financer des projets éducatifs dans le centre commercial de Douala.'}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Responsable</p>
                            <p class="font-medium">Marie Ngo (Coordinatrice des bénévoles)</p>
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#f59e0b',
                showCloseButton: true
            });
        }

        function downloadCertificate() {
            Swal.fire({
                title: 'Certificat de bénévolat',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Télécharger votre certificat de bénévolat:</p>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                <div>
                                    <p class="font-medium">Certificat officiel</p>
                                    <p class="text-sm text-gray-500">PDF haute résolution</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-file-image text-green-500 text-xl mr-3"></i>
                                <div>
                                    <p class="font-medium">Version partageable</p>
                                    <p class="text-sm text-gray-500">JPG pour les réseaux sociaux</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Télécharger les deux',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Génération en cours',
                        text: 'Vos certificats sont en préparation...',
                        icon: 'info',
                        timer: 2500,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Certificats prêts!',
                            text: 'Vos certificats ont été générés avec succès.',
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    });
                }
            });
        }

        function viewPartnershipDetails(partnershipId) {
            Swal.fire({
                title: 'Détails du partenariat',
                width: '700px',
                html: `
                    <div class="text-left space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">ID</p>
                                <p class="font-medium">#PART-2023-00${partnershipId}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Date de soumission</p>
                                <p class="font-medium">20/12/2023</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Type</p>
                                <p class="font-medium">Événementiel</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Statut</p>
                                <p class="font-medium"><span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">En attente</span></p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Description</p>
                            <p class="bg-gray-50 p-3 rounded-lg">
                                Organisation d'un événement caritatif annuel visant à collecter des fonds pour l'éducation des enfants en milieu rural.
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Contact</p>
                            <p class="font-medium">support@bantou-foundation.org</p>
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Fermer',
                confirmButtonColor: '#8b5cf6',
                showCloseButton: true
            });
        }

        function loadMoreActivities() {
            Swal.fire({
                title: 'Chargement',
                text: 'Chargement des activités supplémentaires...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                Swal.close();
                Swal.fire({
                    title: 'Chargement terminé',
                    text: 'Toutes les activités ont été chargées.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            }, 1500);
        }

        function exportHistory() {
            Swal.fire({
                title: 'Exporter l\'historique',
                html: `
                    <div class="text-left space-y-4">
                        <p class="mb-4">Choisissez les options d'export:</p>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                            <select id="exportPeriod" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="current">Période actuelle (avec filtres)</option>
                                <option value="all">Tout l'historique</option>
                                <option value="year">Cette année</option>
                                <option value="last-year">L'année dernière</option>
                                <option value="custom">Période personnalisée</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Format</label>
                            <select id="exportFormat" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="pdf">PDF (Document structuré)</option>
                                <option value="excel">Excel (Données tabulées)</option>
                                <option value="csv">CSV (Importation)</option>
                                <option value="json">JSON (Développement)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclure</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" id="includeDetails" class="mr-2" checked>
                                    <span>Détails complets</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="includeReceipts" class="mr-2">
                                    <span>Reçus et documents</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="includeCharts" class="mr-2" checked>
                                    <span>Graphiques et statistiques</span>
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
                width: '600px'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Génération en cours',
                        text: 'Votre fichier est en préparation...',
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
                            html: `
                                <div class="text-left">
                                    <p class="mb-4">Votre fichier a été généré avec succès.</p>
                                    <div class="p-3 bg-green-50 rounded-lg mb-4">
                                        <p class="text-green-800 font-medium">Résumé de l'export:</p>
                                        <ul class="list-disc pl-5 mt-2 text-sm text-green-700">
                                            <li>8 activités exportées</li>
                                            <li>Période: 01/11/2023 - 15/01/2024</li>
                                            <li>Taille estimée: 1.2 MB</li>
                                        </ul>
                                    </div>
                                </div>
                            `,
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    });
                }
            });
        }

        function exportByType(type) {
            const typeNames = {
                donation: 'dons',
                volunteering: 'bénévolat',
                membership: 'adhésions',
                partnership: 'partenariats'
            };

            Swal.fire({
                title: `Exporter les ${typeNames[type]}`,
                text: `Voulez-vous exporter l'historique des ${typeNames[type]} ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Exporter',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Export en cours',
                        text: 'Génération du fichier...',
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Export terminé!',
                            text: `Votre historique des ${typeNames[type]} a été exporté.`,
                            icon: 'success',
                            confirmButtonText: 'Télécharger',
                            confirmButtonColor: '#10b981'
                        });
                    });
                }
            });
        }

        function exportAllHistory() {
            Swal.fire({
                title: 'Exporter tout l\'historique',
                text: 'Cette action générera une archive complète de toutes vos activités.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Générer l\'archive',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Création de l\'archive',
                        text: 'Cette opération peut prendre quelques minutes...',
                        icon: 'info',
                        timer: 4000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Archive prête!',
                            html: `
                                <div class="text-left">
                                    <p class="mb-4">Votre archive complète est prête à être téléchargée.</p>
                                    <div class="p-3 bg-blue-50 rounded-lg">
                                        <p class="text-blue-800 font-medium">Détails de l'archive:</p>
                                        <ul class="list-disc pl-5 mt-2 text-sm text-blue-700">
                                            <li>Format: ZIP (compressé)</li>
                                            <li>Contenu: Toutes les activités + documents</li>
                                            <li>Taille: 3.5 MB</li>
                                            <li>Dernière mise à jour: ${new Date().toLocaleDateString('fr-FR')}</li>
                                        </ul>
                                    </div>
                                </div>
                            `,
                            icon: 'success',
                            confirmButtonText: 'Télécharger l\'archive',
                            confirmButtonColor: '#3b82f6'
                        });
                    });
                }
            });
        }
    </script>
@endsection
