<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Toate rutele publice ale site-ului.
| Ordinea contează: pune rutele statice înaintea celor cu {parametri}.
*/

// --- Pagini statice / simple
Route::get('/',            [PageController::class, 'home'])->name('home');
Route::get('/about',       [PageController::class, 'about'])->name('about');
Route::get('/projects',    [PageController::class, 'projects'])->name('projects.index');

// --- Contact: pagină + submit formular
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// --- Servicii: index + pagină detaliu
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/',            [ServiceController::class, 'index'])->name('index');
    // slug: litere, cifre, -, _ (poți ajusta după nevoie)
    Route::get('/{slug}',      [ServiceController::class, 'show'])
        ->where('slug', '[A-Za-z0-9\-_]+')
        ->name('show');
});
