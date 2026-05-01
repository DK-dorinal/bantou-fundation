<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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
// ROUTES D'AUTHENTIFICATION (accessible sans auth)
// =============================================

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});


// =============================================
// ROUTE UNIQUE POUR LA SOUMISSION DES FORMULAIRES
// =============================================

Route::post('/soumettre-formulaire', [RegisterController::class, 'submit'])->name('form.submit');


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
// ROUTES PROTÉGÉES PAR AUTHENTIFICATION
// =============================================

Route::middleware(['auth'])->group(function () {

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Pages du dashboard
    Route::get('/mon_compte', function () {
        return view('dashboard.user_dashboard');
    })->name("user_dashboard");

    Route::get('/profil', function () {
        return view('dashboard.profil');
    })->name("user_profil");

    Route::get('/historique', function () {
        return view('dashboard.historique');
    })->name("historique");

    // Routes API pour le dashboard (données dynamiques)
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/tab', [DashboardController::class, 'getTabData'])->name('dashboard.tab');
    Route::get('/dashboard/activities', [DashboardController::class, 'getActivities'])->name('dashboard.activities');
});


// =============================================
// ROUTES ADMINISTRATIVES (authentification + admin)
// =============================================

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/submissions', [RegisterController::class, 'getAllSubmissions'])->name('admin.submissions');
    Route::get('/admin/submissions/{id}', [RegisterController::class, 'getSubmission'])->name('admin.submission.show');
    Route::put('/admin/submissions/{id}/status', [RegisterController::class, 'updateStatus'])->name('admin.submission.status');
});
