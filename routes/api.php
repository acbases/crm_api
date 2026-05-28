<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategorieClientController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\FournisseurClientController;
use App\Http\Controllers\CorrespondantClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\TypeVisiteController;
use App\Http\Controllers\CategorieVisiteController;
use App\Http\Controllers\RapportB2BController;


use Illuminate\Support\Facades\Route;

Route::get('/clients', [ClientController::class, 'getAllClients']);
Route::post('/client', [ClientController::class, 'createClient']);
Route::get('/client/{id}', [ClientController::class, 'findClient']);
Route::get('/categorieClients', [CategorieClientController::class, 'getAllCategorieClients']);
Route::get('/agences', [AgenceController::class, 'getAllAgences']);
// to test 
Route::get('/fournisseurs', [FournisseurController::class, 'getAllFournisseurs']);
Route::get('/fournisseur/{id}', [FournisseurController::class, 'getFournisseur']);
Route::post('/fournisseur', [FournisseurController::class, 'createFournisseur']);

Route::get('/correspondants', [CorrespondantController::class, 'getAllCorrespondants']);
Route::get('/correspondant/{id}', [CorrespondantController::class, 'getCorrespondant']);
Route::post('/correspondant', [CorrespondantController::class, 'createCorrespondant']);

Route::post('/fournisseurClient', [FournisseurClientController::class, 'createFournisseurClient']);

Route::post('/correspondantClient', [CorrespondantClientController::class, 'createCorrespondantClient']);
Route::get('/correspondantClientByIdClient/{id}', [CorrespondantClientController::class, 'getCorrespondantClientByIdClient']);


Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/user', [UserController::class, 'createUser']);

Route::post('/visite', [VisiteController::class, 'createVisite']);
Route::put('/visite/{id}', [VisiteController::class, 'updateVisite']);
Route::get('/visite', [VisiteController::class, 'getAllVisites']);
Route::get('/visite/{id}', [VisiteController::class, 'findVisite']);
Route::get('/visiteByIdClient/{id}', [VisiteController::class, 'getVisiteByIdClient']);
Route::get('/visiteByIdUtilisateur/{id}', [VisiteController::class, 'getVisiteByIdUtilisateur']);



Route::get('/typeVisites', [TypeVisiteController::class, 'getAllTypeVisites']);
Route::get('/categorieVisites', [CategorieVisiteController::class, 'getAllCategorieVisites']);

Route::get('/rapportB2B', [RapportB2BController::class, 'getAllRapportB2B']);
Route::get('/rapportB2B/{id}', [RapportB2BController::class, 'findRapportB2B']);
Route::post('/rapportB2B', [RapportB2BController::class, 'createRapportB2B']);
