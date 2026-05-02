{{-- resources/views/user/history.blade.php --}}
@extends('_partials.master')

@section('title', 'Historique des Actions | Bantou-Foundation')
@section('description', 'Consultez l\'historique complet de vos dons, adhésions, bénévolat et partenariats.')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        /* ... (gardez vos styles existants) ... */
        :root {
            --navy-blue: #0f1a3a;
            --dark-blue: #1a2b55;
            --medium-blue: #2d4a8a;
            --light-blue: #3a5fc0;
            --accent-gold: #d4af37;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #8b5cf6;
        }

        /* ... autres styles ... */
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { transform: translateY(-5px); }
        .timeline-item { position: relative; padding-left: 30px; }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #e5e7eb;
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
        .activity-badge { font-size: 0.75rem; padding: 0.25rem 0.75rem; border-radius: 9999px; }
        .filter-btn.active { background-color: var(--medium-blue); color: white; border-color: var(--medium-blue); }
        .history-card { transition: all 0.2s ease; border: 1px solid #e5e7eb; }
        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            border-color: var(--light-blue);
        }
        .status-completed { background-color: #d1fae5; color: #065f46; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-in-progress { background-color: #dbeafe; color: #1e40af; }
    </style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Historique des Actions</h1>
                <p class="text-gray-600">Consultez l'ensemble de vos activités et contributions</p>
            </div>
            <div class="flex space-x-4">
                <button onclick="exportHistory()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                    <i class="fas fa-download mr-2"></i> Exporter
                </button>
                <a href="{{ route('user_dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i> Tableau de bord
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full mr-4"><i class="fas fa-heart text-green-600 text-xl"></i></div>
                    <div><p class="text-gray-500 text-sm">Total des dons</p><h3 class="text-2xl font-bold" id="totalDonations">--</h3></div>
                </div>
                <div class="mt-4"><span class="text-sm text-green-600" id="donationCount">--</span></div>
            </div>
            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-4"><i class="fas fa-clock text-blue-600 text-xl"></i></div>
                    <div><p class="text-gray-500 text-sm">Heures bénévolat</p><h3 class="text-2xl font-bold" id="totalHours">--</h3></div>
                </div>
                <div class="mt-4"><span class="text-sm text-blue-600" id="volunteerCount">--</span></div>
            </div>
            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-full mr-4"><i class="fas fa-handshake text-purple-600 text-xl"></i></div>
                    <div><p class="text-gray-500 text-sm">Partenariats</p><h3 class="text-2xl font-bold" id="partnershipCount">--</h3></div>
                </div>
            </div>
            <div class="stat-card glass-effect rounded-xl p-6 shadow-lg border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-full mr-4"><i class="fas fa-calendar-alt text-yellow-600 text-xl"></i></div>
                    <div><p class="text-gray-500 text-sm">Membre depuis</p><h3 class="text-xl font-bold" id="memberSince">--</h3></div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="glass-effect rounded-xl p-6 shadow-lg mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                    <input type="text" id="dateRange" class="w-full p-3 border rounded-lg" placeholder="Sélectionner une période">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type d'activité</label>
                    <select id="activityType" class="w-full p-3 border rounded-lg">
                        <option value="all">Tous</option>
                        <option value="donation">Dons</option>
                        <option value="membership">Adhésions</option>
                        <option value="volunteering">Bénévolat</option>
                        <option value="partnership">Partenariats</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select id="statusFilter" class="w-full p-3 border rounded-lg">
                        <option value="all">Tous</option>
                        <option value="completed">Terminé</option>
                        <option value="pending">En attente</option>
                        <option value="in-progress">En cours</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-between items-center">
                <div class="flex gap-2">
                    <button class="filter-btn px-4 py-2 border rounded-lg active" data-filter="all">Tous</button>
                    <button class="filter-btn px-4 py-2 border rounded-lg" data-filter="donation"><i class="fas fa-heart text-red-500 mr-2"></i>Dons</button>
                    <button class="filter-btn px-4 py-2 border rounded-lg" data-filter="volunteering"><i class="fas fa-hands-helping text-yellow-500 mr-2"></i>Bénévolat</button>
                    <button class="filter-btn px-4 py-2 border rounded-lg" data-filter="membership"><i class="fas fa-user-check text-blue-500 mr-2"></i>Adhésions</button>
                    <button class="filter-btn px-4 py-2 border rounded-lg" data-filter="partnership"><i class="fas fa-handshake text-purple-500 mr-2"></i>Partenariats</button>
                </div>
                <button onclick="clearFilters()" class="text-sm text-gray-600 hover:text-gray-800"><i class="fas fa-times mr-1"></i>Effacer</button>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="glass-effect rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b bg-gray-50"><h2 class="text-lg font-bold">Chronologie</h2></div>
                    <div class="p-6">
                        <div id="timelineContainer" class="space-y-8 max-h-[600px] overflow-y-auto pr-2">
                            {{-- Les éléments seront injectés dynamiquement --}}
                            <div class="text-center py-8 text-gray-500" id="loadingTimeline"><i class="fas fa-spinner fa-spin mr-2"></i>Chargement...</div>
                        </div>
                        <div class="mt-8 text-center" id="loadMoreBtn" style="display:none;">
                            <button onclick="loadMore()" class="px-6 py-3 bg-white border rounded-lg hover:bg-gray-50">Charger plus <i class="fas fa-arrow-down ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                {{-- Résumé par catégorie (sera mis à jour dynamiquement) --}}
                <div class="glass-effect rounded-xl p-6 shadow-lg mb-8" id="summaryContainer">
                    <h2 class="text-xl font-bold mb-4 flex items-center"><i class="fas fa-chart-bar text-blue-500 mr-3"></i>Résumé</h2>
                    <div id="summaryContent"><p class="text-gray-500">Chargement...</p></div>
                </div>
                {{-- Stats rapides --}}
                <div class="glass-effect rounded-xl p-6 shadow-lg">
                    <h2 class="text-xl font-bold mb-4 flex items-center"><i class="fas fa-chart-line text-purple-500 mr-3"></i>Impact</h2>
                    <div id="impactContent"><p class="text-gray-500">Chargement...</p></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
let currentPage = 1;
let allActivities = [];
let filteredActivities = [];

$(document).ready(function() {
    $('#dateRange').daterangepicker({
        opens: 'left',
        locale: { format: 'DD/MM/YYYY', applyLabel: 'Appliquer', cancelLabel: 'Annuler' },
        ranges: {
            'Aujourd\'hui': [moment(), moment()],
            'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
            'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')]
        },
        startDate: moment().subtract(30, 'days'),
        endDate: moment()
    });
    $('.filter-btn').on('click', function() { $('.filter-btn').removeClass('active'); $(this).addClass('active'); applyFilters(); });
    $('#activityType, #statusFilter').on('change', applyFilters);
    $('#dateRange').on('apply.daterangepicker', applyFilters);
    loadActivities();
});

function loadActivities(reset = true) {
    if (reset) { currentPage = 1; allActivities = []; filteredActivities = []; }
    $('#loadingTimeline').html('<div class="text-center py-8"><i class="fas fa-spinner fa-spin mr-2"></i>Chargement...</div>');
    $.ajax({
        url: "{{ route('historique.data') }}",
        method: 'GET',
        data: { page: currentPage },
        success: function(response) {
            if (response.activities) {
                if (reset) allActivities = response.activities;
                else allActivities.push(...response.activities);
                updateStatsAndSummary();
                applyFilters();
                $('#loadMoreBtn').toggle(response.hasMorePages);
            } else { $('#loadingTimeline').html('<div class="text-center py-8 text-gray-500">Aucune activité trouvée</div>'); }
        },
        error: function() { $('#loadingTimeline').html('<div class="text-center py-8 text-red-500">Erreur de chargement</div>'); }
    });
}

function updateStatsAndSummary() {
    let totalDonations = 0, donationCount = 0, totalHours = 0, volunteerCount = 0, partnershipCount = 0;
    let memberSince = null;
    allActivities.forEach(act => {
        if (act.type === 'donation') { totalDonations += act.amount; donationCount++; }
        if (act.type === 'volunteering') { totalHours += act.hours || 0; volunteerCount++; }
        if (act.type === 'partnership') partnershipCount++;
        if (act.type === 'membership' && act.status === 'active' && !memberSince) memberSince = act.date;
    });
    $('#totalDonations').text(totalDonations.toLocaleString() + ' FCFA');
    $('#donationCount').text(donationCount + ' don(s)');
    $('#totalHours').text(totalHours);
    $('#volunteerCount').text(volunteerCount + ' mission(s)');
    $('#partnershipCount').text(partnershipCount);
    $('#memberSince').text(memberSince ? moment(memberSince).format('MMM YYYY') : '--');

    let summaryHtml = `
        <div class="space-y-3">
            <div class="flex justify-between p-3 bg-green-50 rounded-lg"><div><i class="fas fa-heart text-green-600 mr-2"></i> Dons</div><div class="font-bold">${totalDonations.toLocaleString()} FCFA</div></div>
            <div class="flex justify-between p-3 bg-yellow-50 rounded-lg"><div><i class="fas fa-hands-helping text-yellow-600 mr-2"></i> Bénévolat</div><div class="font-bold">${totalHours} h</div></div>
            <div class="flex justify-between p-3 bg-purple-50 rounded-lg"><div><i class="fas fa-handshake text-purple-600 mr-2"></i> Partenariats</div><div class="font-bold">${partnershipCount}</div></div>
        </div>`;
    $('#summaryContent').html(summaryHtml);
    $('#impactContent').html(`<div class="bg-blue-50 p-4 rounded-lg text-center"><p class="text-sm">Personnes aidées</p><p class="text-3xl font-bold text-blue-600">~${Math.floor(totalDonations/5000) + volunteerCount*5}</p></div>`);
}

function renderTimeline(activities) {
    if (!activities.length) { $('#timelineContainer').html('<div class="text-center py-8 text-gray-500">Aucune activité correspondante</div>'); return; }
    let html = '';
    activities.forEach(act => {
        let dotColor = '', borderColor = '', icon = '', bgIcon = '', title = '', desc = '', statusBadge = '';
        switch(act.type) {
            case 'donation': dotColor = 'bg-green-500'; borderColor = 'border-green-500'; icon = 'fa-heart'; bgIcon = 'bg-green-100'; title = `Don de ${act.amount} FCFA`; desc = act.method || 'Paiement'; statusBadge = act.status === 'completed' ? '<span class="activity-badge status-completed">Complété</span>' : '<span class="activity-badge status-pending">En attente</span>'; break;
            case 'membership': dotColor = 'bg-blue-500'; borderColor = 'border-blue-500'; icon = 'fa-user-check'; bgIcon = 'bg-blue-100'; title = 'Adhésion'; desc = act.type_label || 'Membre'; statusBadge = '<span class="activity-badge status-completed">Actif</span>'; break;
            case 'volunteering': dotColor = 'bg-yellow-500'; borderColor = 'border-yellow-500'; icon = 'fa-hands-helping'; bgIcon = 'bg-yellow-100'; title = act.mission_name; desc = `${act.hours}h effectuées`; statusBadge = act.status === 'completed' ? '<span class="activity-badge status-completed">Terminé</span>' : '<span class="activity-badge status-in-progress">En cours</span>'; break;
            case 'partnership': dotColor = 'bg-purple-500'; borderColor = 'border-purple-500'; icon = 'fa-handshake'; bgIcon = 'bg-purple-100'; title = act.title; desc = act.sector; statusBadge = '<span class="activity-badge status-pending">En attente</span>'; break;
        }
        html += `<div class="timeline-item" data-type="${act.type}" data-status="${act.status}">
            <div class="timeline-dot ${dotColor}"></div>
            <div class="history-card bg-white rounded-lg p-5 border-l-4 ${borderColor}">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center"><div class="${bgIcon} p-2 rounded-lg mr-3"><i class="fas ${icon} text-${dotColor.split('-')[1]}-600"></i></div><div><h3 class="font-bold">${title}</h3><p class="text-sm text-gray-500">${desc}</p></div></div>
                    <div class="text-right">${statusBadge}<div class="text-sm text-gray-500 mt-1">${moment(act.date).format('DD/MM/YYYY')}</div></div>
                </div>
                <div class="mt-3"><p class="text-gray-600 text-sm">${act.description || ''}</p></div>
            </div>
        </div>`;
    });
    $('#timelineContainer').html(html);
}

function applyFilters() {
    let type = $('#activityType').val();
    let status = $('#statusFilter').val();
    let buttonFilter = $('.filter-btn.active').data('filter');
    let dateRange = $('#dateRange').val();
    let start = dateRange ? moment(dateRange.split(' - ')[0], 'DD/MM/YYYY') : null;
    let end = dateRange ? moment(dateRange.split(' - ')[1], 'DD/MM/YYYY') : null;
    filteredActivities = allActivities.filter(act => {
        if (type !== 'all' && act.type !== type) return false;
        if (buttonFilter !== 'all' && act.type !== buttonFilter) return false;
        if (status !== 'all' && act.status !== status) return false;
        if (start && end) { let actDate = moment(act.date); if (!actDate.isBetween(start, end, null, '[]')) return false; }
        return true;
    });
    renderTimeline(filteredActivities);
    $('#resultsCount').text(`${filteredActivities.length} activité(s)`);
}

function clearFilters() {
    $('#activityType').val('all'); $('#statusFilter').val('all'); $('#dateRange').val('');
    $('.filter-btn').removeClass('active'); $('.filter-btn[data-filter="all"]').addClass('active');
    applyFilters();
}

function loadMore() { currentPage++; loadActivities(false); }

function exportHistory() { Swal.fire('Export', 'Fonctionnalité d\'export à implémenter', 'info'); }
</script>
@endsection
