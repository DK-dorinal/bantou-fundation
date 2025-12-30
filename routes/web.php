<?php

use Illuminate\Support\Facades\Route;

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


##ROUTE POUR LA GESTION DES DONS
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


##ROUTES POUR LA GESTIONS DES COMPTES
Route::get('/mon_compte', function () {
    return view('dashboard.user_dashboard');
})->name("user_dashboard");
Route::get('/profil', function () {
    return view('dashboard.profil');
})->name("user_profil");
Route::get('/historique', function () {
    return view('dashboard.historique');
})->name("historique");
