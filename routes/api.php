<?php
use App\Http\Controllers\AutreProduitController;
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
use App\Http\Controllers\RapportController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RefPrixProduitController;
use App\Http\Controllers\RecensementPlvController;
use App\Http\Controllers\ProduitClientController;
use App\Http\Controllers\PlvController;

use Illuminate\Support\Facades\Route;

Route::get('/clients', [ClientController::class, 'getAllClients']);
Route::post('/client', [ClientController::class, 'createClient']);
Route::get('/client/{id}', [ClientController::class, 'findClient']);
Route::get('/client/{id}/qrcode', [QRCodeController::class, 'getClientQRCode']);
Route::put('/client/{id}', [ClientController::class, 'updateClient']);
Route::get('/zone', [ClientController::class, 'getUniqueZones']);
Route::get('/quartier', [ClientController::class, 'getUniqueQuartiers']);

Route::get('/categorieClients', [CategorieClientController::class, 'getAllCategorieClients']);

Route::get('/agences', [AgenceController::class, 'getAllAgences']);
Route::post('/agence', [AgenceController::class, 'createAgence']);
// to test 
Route::get('/fournisseurs', [FournisseurController::class, 'getAllFournisseurs']);
Route::get('/fournisseur/{id}', [FournisseurController::class, 'getFournisseur']);
Route::post('/fournisseur', [FournisseurController::class, 'createFournisseur']);
Route::put('/fournisseur/{id}', [FournisseurController::class, 'updateFournisseur']);

Route::get('/correspondants', [CorrespondantController::class, 'getAllCorrespondants']);
Route::get('/correspondant/{id}', [CorrespondantController::class, 'getCorrespondantById']);
Route::post('/correspondant', [CorrespondantController::class, 'createCorrespondant']);
Route::put('/correspondant/{id}', [CorrespondantController::class, 'updateCorrespondant']);


Route::post('/fournisseurClient', [FournisseurClientController::class, 'createFournisseurClient']);
Route::get('/fournisseurClientByIdClient/{id}', [FournisseurClientController::class, 'getFournisseurClientByIdClient']);
Route::get('/fournisseurClient/{id}', [FournisseurClientController::class, 'getFournisseurClientById']);
Route::delete('/fournisseurClient/{id}', [FournisseurClientController::class, 'deleteFournisseurClient']);

Route::post('/correspondantClient', [CorrespondantClientController::class, 'createCorrespondantClient']);
Route::get('/correspondantClientByIdClient/{id}', [CorrespondantClientController::class, 'getCorrespondantClientByIdClient']);
Route::get('/correspondantClient/{id}', [CorrespondantClientController::class, 'getCorrespondantClientById']);
Route::delete('/correspondantClient/{id}', [CorrespondantClientController::class, 'deleteCorrespondantClient']);

Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::get('/userByMatricule/{matricule}', [UserController::class, 'getUserByMatricule']);
Route::post('/user', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/update-password', [UserController::class, 'updatePassword']);
Route::post('/update-role', [UserController::class, 'updateRole']);
Route::post('/users/import-allpro-rh', [UserController::class, 'importAllproRhUsers']);

Route::post('/visite', [VisiteController::class, 'createVisite']);
Route::put('/visite/{id}', [VisiteController::class, 'updateVisite']);
Route::get('/visite', [VisiteController::class, 'getAllVisites']);
Route::get('/visite/{id}', [VisiteController::class, 'findVisite']);
Route::get('/visiteByIdClient/{id}', [VisiteController::class, 'getVisiteByIdClient']);
Route::get('/visiteByIdUtilisateur/{id}', [VisiteController::class, 'getVisiteByIdUtilisateur']);
Route::get('/visiteStatut0byIdClientAndIdUtilisateur', [VisiteController::class, 'getVisitesByIdClientAndIdUtilisateurAndStatutZero']);
Route::get('viewVisiteDetails/{id}', [VisiteController::class, 'getViewVisiteDetailsByIdVisite']);
Route::get('viewVisitePlv/{id}', [VisiteController::class, 'getViewVisitePlvByIdVisite']);


Route::get('/typeVisites', [TypeVisiteController::class, 'getAllTypeVisites']);
Route::get('/categorieVisites', [CategorieVisiteController::class, 'getAllCategorieVisites']);

Route::get('/rapportB2B', [RapportB2BController::class, 'getAllRapportB2B']);
Route::get('/rapportB2B/{id}', [RapportB2BController::class, 'findRapportB2B']);
Route::post('/rapportB2B', [RapportB2BController::class, 'createRapportB2B']);
Route::get('/getRapportB2BByIdVisite/{id}', [RapportB2BController::class, 'getRapportB2BByIdVisite']);

Route::get('/rapports', [RapportController::class, 'getAllRapports']);
Route::get('/rapport/{id}', [RapportController::class, 'findRapport']);
Route::post('/rapport', [RapportController::class, 'createRapport']);
Route::get('/getVueRapportProduitsByIdVisite/{id}', [RapportController::class, 'getVueRapportProduitsByIdVisite']);
Route::get('/getVueRapportAutresProduitsByIdVisite/{id}', [RapportController::class, 'getVueRapportAutresProduitsByIdVisite']);
Route::get('/getVueRapportPlvByIdVisite/{id}', [RapportController::class, 'getVueRapportPlvByIdVisite']);
Route::get('/getRapportByIdVisite/{id}', [RapportController::class, 'getRapportByIdVisite']);

Route::get('/refPrixProduits', [RefPrixProduitController::class, 'getAllRefPrixProduits']);
Route::get('/refPrixProduit/{id}', [RefPrixProduitController::class, 'findRefPrixProduit']);
Route::post('/refPrixProduit', [RefPrixProduitController::class, 'createRefPrixProduit']);

Route::get('/produits', [ProduitController::class, 'getAllProduits']);
Route::get('/produit/{id}', [ProduitController::class, 'findProduit']);
Route::post('/produit', [ProduitController::class, 'createProduit']);

Route::get('/autreProduits', [AutreProduitController::class, 'getAllAutreProduits']);
Route::get('/autreProduit/{id}', [AutreProduitController::class, 'findAutreProduit']);
Route::post('/autreProduit', [AutreProduitController::class, 'createAutreProduit']);

Route::get('/recensementPlv', [RecensementPlvController::class, 'getAllRecensementPlv']);
Route::get('/recensementPlv/{id}', [RecensementPlvController::class, 'findRecensementPlv']);
Route::post('/recensementPlv', [RecensementPlvController::class, 'createRecensementPlv']);

Route::get('/produitClients', [ProduitClientController::class, 'getAllProduitClients']);
Route::get('/produitClient/{id}', [ProduitClientController::class, 'findProduitClient']);
Route::post('/produitClient', [ProduitClientController::class, 'createProduitClient']);
Route::get('/produitClientByIdClient/{id}', [ProduitClientController::class, 'getProduitClientByIdClient']);

Route::get('/plvs', [PlvController::class, 'getAllPlvs']);
Route::get('/plv/{id}', [PlvController::class, 'findPlv']);
Route::post('/plv', [PlvController::class, 'createPlv']);