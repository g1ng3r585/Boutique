<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\SuperAdminsController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\CompagnesController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\CouleursController;
use App\Http\Controllers\CommandesProduitsController;
use App\Http\Controllers\TaillesController;


use Illuminate\Support\Facades\Auth;



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
/*-----------------------Compagne------------------------*/

// ZOOM 
Route::get('/compagnes/{compagne}', 
[CompagnesController::class, 'show'])->name('compagnes.show') ->middleware('auth');

//Supprimer client
Route::delete('/compagnes/{id}', 
[CompagnesController::class, 'destroy'])->name('compagnes.destroy') ->middleware('auth');    

//Edit campagne
Route::get('/compagnes/{id}/edit/',
[CompagnesController::class, 'edit'])->name('compagnes.edit') ->middleware('auth');

//Formulaire campagnes
Route::post('/compagnes/store',
[CompagnesController::class, 'store'])->name('compagnes.store') ->middleware('auth');


Route::patch('/compagnes/{id}/',
[CompagnesController::class, 'update'])->name('compagnes.update') ->middleware('auth');

/*-----------------------Produits------------------------*/


Route::get('/', 
[ProduitsController::class, 'index'])->name('produits.index');



// ZOOM 
Route::get('/produits/{produit}', 
[ProduitsController::class, 'show'])->name('produits.show');

// Ajouter un produit en tant qu'admin
Route::post('/produits/store',
[ProduitsController::class, 'store'])->name('produits.store');



Route::delete('/produits/delete/{id}',
[ProduitsController::class, 'destroy'])->name('produits.destroy')->middleware('auth');

/*-----------------------Admin------------------------*/
//Page admin
Route::middleware(['auth', 'checkrole:Admin'])->group(function () {
Route::get('admins', 
[AdminsController::class, 'index'])->name('admins.index') ->middleware('auth');
});
//Supprimer un admin
Route::delete('/admins/{id}', 
[AdminsController::class, 'destroy'])->name('admins.destroy') ->middleware('auth');

//Formulaire Admin
Route::post('/admins/store',
[AdminsController::class, 'store'])->name('admins.store') ->middleware('auth');

Route::get('/admins/gestionProduit',
[ProduitsController::class, 'gestionProduit'])->name('admins.gestionProduit') ->middleware('auth');


Route::get('/admins/gestionCouleurTaille',
[CouleursController::class, 'index'])->name('admins.gestionCouleurTaille') ->middleware('auth');



/*-----------------------SuperAdmin------------------------*/

//Page Super Admin
Route::middleware(['auth', 'checkrole:SuperAdmin'])->group(function () {

Route::get('superadmins', 
[SuperAdminsController::class, 'index'])->name('superadmins.index') ->middleware('auth');

});


/*-----------------------Clients------------------------*/

Route::get('clients', 
[ClientsController::class, 'index'])->name('clients.index') ->middleware('auth');

//Formulaire ajout client
Route::get('clients/create', 
[ClientsController::class, 'createClient'])->name('clients.create');

//Ajouter client
Route::post('/clients/store',
[ClientsController::class, 'store'])->name('clients.store') ;

//Supprimer client
Route::delete('/clients/{id}', 
[ClientsController::class, 'destroy'])->name('clients.destroy') ->middleware('auth');

/*-----------------------Usagers------------------------*/

Route::get('/formConnexion', [UsagersController::class, 'formConnexion'])->name('usagers.formConnexion');


Route::post('connexion',
[UsagersController::class, 'connexion'])->name('usagers.connexion');



// // ENVOIE DE FORMULAIRE
// Route::post('connexion',
// [UsagersController::class, 'login'])->name('usagers.login');

// ROUTE DECONNEXION
Route::get('logout',
[UsagersController::class, 'logout'])->name('logout');




/*-----------------------commandes------------------------*/

Route::get('commandes', 
[CommandesController::class, 'index'])->name('commandes.index');

Route::get('commandes/panier', 
[CommandesController::class, 'commande'])->name('commandes.commande');

//Supprimer un admin
Route::delete('/commandes/{id}', 
[CommandesController::class, 'destroy'])->name('commande.destroy') ->middleware('auth');


//Ajouter commande
Route::post('/commandes/ajouter',
[CommandesController::class, 'store'])->name('commandes.ajouter') ;

Route::get('/admins/listeCommande',
[CommandesController::class, 'index'])->name('admins.listeCommande') ->middleware('auth');

Route::post('/commandes/{id}/paied', 
[CommandesController::class, 'paied'])->name('commandes.paied');

Route::post('/commandes/{id}/rembourser', 
[CommandesController::class, 'rembourser'])->name('commandes.rembourser');

Route::post('/commandes/{id}/ramasse', [CommandesController::class, 'ramassage'])->name('commandes.ramasse');

/*-----------------------couleur/taille------------------------*/


Route::post('/admins/gestionCouleur',
[CouleursController::class, 'store'])->name('couleurs.store')->middleware('auth');

Route::post('/admins/gestionTaille',
[TaillesController::class, 'store'])->name('tailles.store')->middleware('auth');

Route::delete('/couleurs/{id}', 
[CouleursController::class, 'destroy'])->name('couleurs.destroy') ->middleware('auth');

Route::delete('/tailles/{id}', 
[TaillesController::class, 'destroy'])->name('tailles.destroy') ->middleware('auth');

