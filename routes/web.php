<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/',  [AdminController::class, 'index'])->name('admin.home');
Route::post('/demande/create',  [AdminController::class, 'createDemande'])->name('admin.demande.create');
Route::get('/demande/{slug}',  [AdminController::class, 'showDemande'])->name('admin.demande.show');
Route::get('/demande/etat/{slug}/{etat}',  [AdminController::class, 'changeEtat'])->name('admin.demande.change.etat');


Route::get('/images-bornes/{timestamp}/codes-qr.svg', function ($timestamp) {
    // Répertoire où se trouve votre fichier SVG
    $filePath = public_path('images-bornes/' . $timestamp . '/codes-qr.svg');

    // Vérifie si le fichier existe
    if (file_exists($filePath)) {
        // Retourne le fichier SVG
        return response()->file($filePath, ['Content-Type' => 'image/svg+xml']);
    } else {
        // Retourne une erreur 404 si le fichier n'existe pas
        abort(404);
    }
});
