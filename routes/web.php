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
