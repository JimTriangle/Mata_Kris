<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Admin\ConcertController as AdminConcertController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;

// --- Routes Publiques ---
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/concerts', [PageController::class, 'concerts'])->name('concerts');
Route::get('/galerie', [PageController::class, 'galerie'])->name('galerie');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'handleContactForm'])->name('contact.submit');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');
// --- Routes de l'Administration ---
// 'prefix' ajoute /admin à l'URL
// 'middleware' protège l'accès (seuls les utilisateurs connectés peuvent y accéder)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() { return view('admin.dashboard'); })->name('dashboard');
    // La bonne méthode avec Volt
    Volt::route('profile', 'settings.profile')->name('profile.edit');
    // Route::resource crée automatiquement les routes pour le CRUD (index, create, store, edit, update, destroy)
    Route::resource('concerts', AdminConcertController::class);
    Route::resource('photos', AdminPhotoController::class);
    
});

// Ajoute les routes d'authentification (login, logout, etc.)
require __DIR__.'/auth.php';
