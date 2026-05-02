<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserHistoryController;

// =============================================
// ROUTES PUBLIQUES (accessible sans authentification)
// =============================================

// Pages statiques
Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/notre_identite', function () {
    return view('identite');
})->name("identite");

Route::get('/nos_actions', function () {
    return view('action');
})->name("action");

Route::get('/blog_actualites', function () {
    return view('blog');
})->name("blog");

Route::get('/nous_rejoindre', function () {
    return view('nous_rejoindre');
})->name("nous_rejoindre");


// =============================================
// ROUTES D'AFFICHAGE DES FORMULAIRES (publiques)
// =============================================

Route::get('/faire_un_don', function () {
    return view('don.formulaire_don');
})->name("don");

Route::get('/devenir_benevole', function () {
    return view('don.formulaire_benevole');
})->name("benevole");

Route::get('/devenir_partenaire', function () {
    return view('don.formulaire_partenaire');
})->name("partenaire");

Route::get('/adherer_fondation', function () {
    return view('don.formulaire_adhesion');
})->name("adhesion");


// =============================================
// ROUTE UNIQUE POUR LA SOUMISSION DES FORMULAIRES
// =============================================

Route::post('/soumettre-formulaire', [RegisterController::class, 'submit'])->name('form.submit');


// =============================================
// ROUTES D'AUTHENTIFICATION (accessible sans auth)
// =============================================

Route::middleware(['guest'])->group(function () {
    // Connexion classique avec mot de passe
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Inscription
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Mot de passe oublié
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // ROUTES OTP (Connexion sans mot de passe par code magic)
    Route::post('/magic-login/send', [AuthController::class, 'sendMagicCode'])->name('magic.login.send');
    Route::post('/magic-login/verify', [AuthController::class, 'verifyMagicCode'])->name('magic.login.verify');
    Route::post('/magic-login/resend', [AuthController::class, 'resendMagicCode'])->name('magic.login.resend');
});

// Page de validation du code OTP (accessible même avec une session expirée)
Route::get('/verify-code', function () {
    return view('auth.verify-code');
})->name('verify.code');


// =============================================
// ROUTES PROTÉGÉES PAR AUTHENTIFICATION
// =============================================

Route::middleware(['auth'])->group(function () {

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =============================================
    // DASHBOARD PRINCIPAL
    // =============================================

    Route::get('/mon_compte', function () {
        return view('dashboard.user_dashboard');
    })->name("user_dashboard");

    // Routes API pour le dashboard (données dynamiques)
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/tab', [DashboardController::class, 'getTabData'])->name('dashboard.tab');
    Route::get('/dashboard/activities', [DashboardController::class, 'getActivities'])->name('dashboard.activities');

    // =============================================
    // GESTION DU PROFIL
    // =============================================

    // Page profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('user_profil');

    // Mises à jour du profil
    Route::post('/profile/update-personal', [ProfileController::class, 'updatePersonalInfo'])->name('profile.update.personal');
    Route::post('/profile/update-phone', [ProfileController::class, 'updatePhone'])->name('profile.update.phone');
    Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->name('profile.update.address');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::post('/profile/update-expertise', [ProfileController::class, 'updateExpertise'])->name('profile.update.expertise');
    Route::post('/profile/update-interests', [ProfileController::class, 'updateInterests'])->name('profile.update.interests');
    Route::post('/profile/update-availability', [ProfileController::class, 'updateAvailability'])->name('profile.update.availability');

    // Suppression du compte
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');

    // Export des données personnelles
    Route::get('/profile/download-data', [ProfileController::class, 'downloadData'])->name('profile.download');

    // API Statistiques et activité récente du profil
    Route::get('/profile/stats', [ProfileController::class, 'getStats'])->name('profile.stats');
    Route::get('/profile/recent-activity', [ProfileController::class, 'getRecentActivity'])->name('profile.recent-activity');

    // =============================================
    // HISTORIQUE DES ACTIVITÉS
    // =============================================

    // Page d'affichage de l'historique (correspond à votre fichier historique.blade.php)
    Route::get('/historique', [UserHistoryController::class, 'index'])->name('historique');

    // API pour les données de l'historique (chargement AJAX avec pagination)
    Route::get('/historique/data', [UserHistoryController::class, 'getData'])->name('historique.data');

    // Export de l'historique complet
    Route::get('/historique/export', [UserHistoryController::class, 'export'])->name('historique.export');

    // Export filtré par type
    Route::get('/historique/export/{type}', [UserHistoryController::class, 'exportByType'])->name('historique.export.type');

    // Téléchargement d'un reçu spécifique
    Route::get('/historique/receipt/{donationId}', [UserHistoryController::class, 'downloadReceipt'])->name('historique.receipt');

    // Téléchargement d'un certificat de bénévolat
    Route::get('/historique/certificate/{volunteerId}', [UserHistoryController::class, 'downloadCertificate'])->name('historique.certificate');

    // Détail d'une activité spécifique
    Route::get('/historique/{type}/{id}', [UserHistoryController::class, 'showDetails'])->name('historique.details');
});


// =============================================
// ROUTES ADMINISTRATIVES (authentification + admin)
// =============================================

Route::middleware(['auth', 'admin'])->group(function () {
    // Gestion des soumissions de formulaires
    Route::get('/admin/submissions', [RegisterController::class, 'getAllSubmissions'])->name('admin.submissions');
    Route::get('/admin/submissions/{id}', [RegisterController::class, 'getSubmission'])->name('admin.submission.show');
    Route::put('/admin/submissions/{id}/status', [RegisterController::class, 'updateStatus'])->name('admin.submission.status');

    // Administration de l'historique
    Route::get('/admin/historique', [UserHistoryController::class, 'adminIndex'])->name('admin.historique');
    Route::get('/admin/historique/user/{userId}', [UserHistoryController::class, 'adminUserHistory'])->name('admin.historique.user');
});
