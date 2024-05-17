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



Route::post('/demande/{slug}/image',  [AdminController::class, 'uploadImage'])->name('admin.demande.upload.image');

Route::get('/client/{slug}/image/download',  [AdminController::class, 'download'])->name('admin.demande.show.image');
