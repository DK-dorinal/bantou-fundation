@extends('_partials.master')

@section('title', 'Tableau de Bord | Bantou-Foundation')
@section('description', 'Tableau de bord personnel pour gérer vos dons, adhésions, bénévolat et partenariats.')

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
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes shimmer {
            0%   { background-position: -1000px 0; }
            100% { background-position:  1000px 0; }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover { transform: translateY(-5px); }

        .tab-content { animation: fadeIn 0.3s ease-out; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--medium-blue); border-radius: 10px; }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top-color: var(--medium-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .tab-btn.active {
            color: var(--medium-blue);
            border-bottom-color: var(--medium-blue);
        }
    </style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="rounded-2xl bg-gradient-to-r from-blue-900 to-indigo-900 p-6 sm:p-8 shadow-2xl overflow-hidden relative">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                <div class="text-white mb-6 md:mb-0">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">
                        Bonjour, <span id="userName">{{ Auth::user()->name ?? 'Membre' }}</span>! 👋
                    </h1>
                    <p class="text-blue-200 mb-4">Bienvenue sur votre tableau de bord personnel</p>
                    <div class="flex flex-wrap gap-2" id="userBadges"></div>
                </div>
                <div class="relative">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-blue-200 to-indigo-200 flex items-center justify-center overflow-hidden border-4 border-yellow-400 shadow-xl">
                        <div id="userAvatar" class="w-full h-full flex items-center justify-center text-3xl font-bold text-blue-700">
                            {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
                        </div>
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm border-2 border-white shadow-lg">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIQUES --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-green-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Dons</p>
                        <h3 id="donationsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full"><i class="fas fa-heart text-green-600 text-xl"></i></div>
                </div>
                <p id="donationsTotal" class="text-gray-600 text-sm">Total : <span class="font-semibold">0 FCFA</span></p>
            </div>

            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-blue-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Adhésions</p>
                        <h3 id="membershipsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full"><i class="fas fa-user-check text-blue-600 text-xl"></i></div>
                </div>
                <p id="membershipType" class="text-gray-600 text-sm">Statut : <span class="font-semibold">Aucune</span></p>
            </div>

            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-yellow-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Bénévolat</p>
                        <h3 id="volunteeringHours" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full"><i class="fas fa-hands-helping text-yellow-600 text-xl"></i></div>
                </div>
                <p class="text-gray-600 text-sm">Heures de bénévolat</p>
            </div>

            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg hover:shadow-xl border-l-4 border-purple-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Partenariats</p>
                        <h3 id="partnershipsCount" class="text-3xl font-bold text-gray-800 mt-1">0</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full"><i class="fas fa-handshake text-purple-600 text-xl"></i></div>
                </div>
                <p class="text-gray-600 text-sm">Statut : <span class="font-semibold" id="partnershipStatus">Aucun</span></p>
            </div>
        </div>
    </div>

    {{-- ONGLETS --}}
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                {{-- Actions rapides --}}
                <div class="glass-effect rounded-2xl p-6 shadow-lg mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-3"></i> Actions Rapides
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('don') }}" class="group bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-blue-100 hover:border-blue-300 text-center">
                            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fas fa-heart text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Faire un don</span>
                        </a>
                        <a href="{{ route('adhesion') }}" class="group bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-blue-100 hover:border-blue-300 text-center">
                            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fas fa-user-plus text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Adhérer</span>
                        </a>
                        <a href="{{ route('benevole') }}" class="group bg-gradient-to-br from-white to-yellow-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-yellow-100 hover:border-yellow-300 text-center">
                            <div class="bg-yellow-100 text-yellow-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                                <i class="fas fa-hands-helping text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Bénévole</span>
                        </a>
                        <a href="{{ route('partenaire') }}" class="group bg-gradient-to-br from-white to-purple-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-purple-100 hover:border-purple-300 text-center">
                            <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <i class="fas fa-handshake text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Partenaire</span>
                        </a>
                        <a href="{{ route('user_profil') }}" class="group bg-gradient-to-br from-white to-gray-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-gray-300 text-center">
                            <div class="bg-gray-100 text-gray-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                <i class="fas fa-user-cog text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Mon profil</span>
                        </a>
                        <a href="{{ route('historique') }}" class="group bg-gradient-to-br from-white to-gray-50 rounded-xl p-5 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-gray-300 text-center">
                            <div class="bg-gray-100 text-gray-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                <i class="fas fa-history text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700 text-sm">Historique</span>
                        </a>
                    </div>
                </div>

                {{-- Activités récentes --}}
                <div class="glass-effect rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-history text-blue-500 mr-3"></i> Activités récentes
                    </h2>
                    <div class="space-y-4 max-h-80 overflow-y-auto custom-scrollbar pr-2" id="recentActivities"></div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="glass-effect rounded-2xl shadow-lg overflow-hidden">
                    <div class="border-b border-gray-200 overflow-x-auto">
                        <nav class="flex flex-nowrap -mb-px min-w-max">
                            <button data-tab="dons" class="tab-btn inline-flex items-center py-4 px-5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-colors whitespace-nowrap">
                                <i class="fas fa-heart mr-2"></i> Mes Dons
                            </button>
                            <button data-tab="adhesions" class="tab-btn inline-flex items-center py-4 px-5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-colors whitespace-nowrap">
                                <i class="fas fa-user-check mr-2"></i> Mon Adhésion
                            </button>
                            <button data-tab="benevolat" class="tab-btn inline-flex items-center py-4 px-5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-colors whitespace-nowrap">
                                <i class="fas fa-hands-helping mr-2"></i> Mon Bénévolat
                            </button>
                            <button data-tab="partenariats" class="tab-btn inline-flex items-center py-4 px-5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-colors whitespace-nowrap">
                                <i class="fas fa-handshake mr-2"></i> Mes Partenariats
                            </button>
                        </nav>
                    </div>

                    <div class="p-6">
                        <div id="dons" class="tab-pane"></div>
                        <div id="adhesions" class="tab-pane hidden"></div>
                        <div id="benevolat" class="tab-pane hidden"></div>
                        <div id="partenariats" class="tab-pane hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const user = @json(Auth::user());

$(document).ready(function() {
    loadDashboardData();

    $('.tab-btn').on('click', function() {
        $('.tab-btn').removeClass('active border-blue-600 text-blue-600').addClass('border-transparent text-gray-500');
        $(this).addClass('active border-blue-600 text-blue-600');

        $('.tab-pane').addClass('hidden');
        $('#' + $(this).data('tab')).removeClass('hidden');

        loadTabData($(this).data('tab'));
    });

    $('.tab-btn:first').trigger('click');
});

function loadDashboardData() {
    $.ajax({
        url: '{{ route("dashboard.stats") }}',
        type: 'GET',
        success: function(data) {
            $('#donationsCount').text(data.donations.count);
            $('#donationsTotal').html('Total : <span class="font-semibold">' + data.donations.total + ' FCFA</span>');
            $('#membershipsCount').text(data.membership ? 1 : 0);
            $('#membershipType').html('Statut : <span class="font-semibold">' + (data.membership ? data.membership.status : 'Non adhérent') + '</span>');
            $('#volunteeringHours').text(data.volunteer?.hours || 0);
            $('#partnershipsCount').text(data.partnerships?.length || 0);

            let badges = '';
            if(data.is_donor) badges += '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500 text-white"><i class="fas fa-heart mr-2"></i> Donateur</span>';
            if(data.is_member) badges += '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-500 text-white"><i class="fas fa-user-check mr-2"></i> Membre</span>';
            if(data.is_volunteer) badges += '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white"><i class="fas fa-hands-helping mr-2"></i> Bénévole</span>';
            if(data.is_partner) badges += '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-500 text-white"><i class="fas fa-handshake mr-2"></i> Partenaire</span>';
            $('#userBadges').html(badges);
        },
        error: function() {
            console.log('Erreur chargement stats');
        }
    });
}

function loadTabData(tab) {
    $('#' + tab).html('<div class="flex justify-center py-12"><div class="loading-spinner"></div></div>');

    $.ajax({
        url: '{{ route("dashboard.tab") }}',
        type: 'GET',
        data: { tab: tab },
        success: function(data) {
            if(tab === 'dons') renderDonations(data);
            else if(tab === 'adhesions') renderMembership(data);
            else if(tab === 'benevolat') renderVolunteer(data);
            else if(tab === 'partenariats') renderPartnerships(data);
        },
        error: function() {
            $('#' + tab).html('<div class="text-center py-12 text-red-500">Erreur de chargement</div>');
        }
    });
}

function renderDonations(data) {
    if(!data.donations || data.donations.length === 0) {
        $('#dons').html(`<div class="text-center py-12"><i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Aucun don effectué</p><a href="{{ route('don') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg">Faire un don</a></div>`);
        return;
    }

    let html = `<div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Date</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Montant</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Méthode</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Statut</th></tr></thead><tbody>`;

    data.donations.forEach(d => {
        html += `<tr class="border-b"><td class="px-6 py-4 text-sm">${d.date}</td><td class="px-6 py-4 text-sm font-semibold">${d.amount} FCFA</td><td class="px-6 py-4 text-sm">${d.method}</td><td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">${d.status}</span></td></tr>`;
    });

    html += `</tbody></table></div>`;
    $('#dons').html(html);
}

function renderMembership(data) {
    if(!data.membership) {
        $('#adhesions').html(`<div class="text-center py-12"><i class="fas fa-user-plus text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Vous n'êtes pas encore membre</p><a href="{{ route('adhesion') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg">Adhérer maintenant</a></div>`);
        return;
    }

    let html = `<div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-6"><div class="flex items-center gap-4"><div class="bg-blue-100 p-4 rounded-full"><i class="fas fa-user-check text-2xl text-blue-600"></i></div><div><h3 class="text-xl font-bold">${data.membership.type || 'Membre'}</h3><p class="text-gray-600">Adhérent depuis le ${data.membership.join_date}</p></div></div></div>`;

    if(data.parrain) {
        html += `<div class="border rounded-xl p-4 mb-4"><h4 class="font-bold mb-3"><i class="fas fa-star text-yellow-500 mr-2"></i>Mon Parrain</h4><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center"><span class="font-bold">${data.parrain.name.charAt(0)}</span></div><div><p class="font-medium">${data.parrain.name}</p><p class="text-sm text-gray-500">Parrain depuis ${data.parrain.since}</p></div></div></div>`;
    }

    if(data.filleuls && data.filleuls.length > 0) {
        html += `<div class="border rounded-xl overflow-hidden"><div class="bg-gray-50 px-4 py-3 border-b"><h4 class="font-bold"><i class="fas fa-users mr-2"></i>Mes Filleuls (${data.filleuls.length})</h4></div>`;
        data.filleuls.forEach(f => {
            html += `<div class="flex items-center gap-3 px-4 py-3 border-b"><div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-bold">${f.name.charAt(0)}</div><div><p class="font-medium">${f.name}</p><p class="text-xs text-gray-500">Inscrit le ${f.join_date}</p></div></div>`;
        });
        html += `</div>`;
    }

    $('#adhesions').html(html);
}

function renderVolunteer(data) {
    if(!data.missions || data.missions.length === 0) {
        $('#benevolat').html(`<div class="text-center py-12"><i class="fas fa-hands-helping text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Aucune mission de bénévolat</p><a href="{{ route('benevole') }}" class="inline-block mt-4 px-6 py-2 bg-yellow-600 text-white rounded-lg">Devenir bénévole</a></div>`);
        return;
    }

    let html = `<div class="grid grid-cols-3 gap-4 mb-6"><div class="bg-yellow-50 rounded-xl p-4 text-center"><div class="text-2xl font-bold text-yellow-600">${data.total_hours}</div><div class="text-sm text-gray-600">Heures totales</div></div><div class="bg-yellow-50 rounded-xl p-4 text-center"><div class="text-2xl font-bold text-yellow-600">${data.completed_missions}</div><div class="text-sm text-gray-600">Missions</div></div><div class="bg-yellow-50 rounded-xl p-4 text-center"><div class="text-sm font-bold text-yellow-600">${data.main_domain || 'Non défini'}</div><div class="text-sm text-gray-600">Domaine principal</div></div></div><div class="space-y-3">`;

    data.missions.forEach(m => {
        html += `<div class="border rounded-lg p-4"><div class="flex justify-between"><h4 class="font-bold">${m.title}</h4><span class="px-2 py-1 text-xs rounded-full ${m.status === 'En cours' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">${m.status}</span></div><p class="text-sm text-gray-600 mt-1">${m.hours} heures • ${m.location}</p></div>`;
    });

    html += `</div>`;
    $('#benevolat').html(html);
}

function renderPartnerships(data) {
    if(!data.partnerships || data.partnerships.length === 0) {
        $('#partenariats').html(`<div class="text-center py-12"><i class="fas fa-handshake text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Aucun partenariat</p><a href="{{ route('partenaire') }}" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-lg">Devenir partenaire</a></div>`);
        return;
    }

    let html = `<div class="space-y-4">`;
    data.partnerships.forEach(p => {
        html += `<div class="border rounded-xl p-4"><div class="flex justify-between items-start"><div><h4 class="font-bold">${p.type}</h4><p class="text-sm text-gray-600 mt-1">Soumis le ${p.date}</p></div><span class="px-2 py-1 text-xs rounded-full ${p.status === 'Approuvé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">${p.status}</span></div><p class="text-sm text-gray-700 mt-2">${p.message || 'En attente de traitement'}</p></div>`;
    });
    html += `</div>`;
    $('#partenariats').html(html);
}

function loadRecentActivities() {
    $.ajax({
        url: '{{ route("dashboard.activities") }}',
        type: 'GET',
        success: function(data) {
            let html = '';
            data.activities.forEach(a => {
                html += `<div class="flex items-start p-3 rounded-lg hover:bg-gray-50"><div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center"><i class="fas ${a.icon} text-blue-600"></i></div><div class="ml-3"><p class="text-sm font-medium">${a.title}</p><p class="text-xs text-gray-500">${a.time}</p></div></div>`;
            });
            $('#recentActivities').html(html || '<p class="text-center text-gray-500 py-4">Aucune activité récente</p>');
        }
    });
}
</script>
@endsection
