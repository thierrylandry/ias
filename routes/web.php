<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/accueil.html', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('/checking', 'HomeController@checkState')->name('rappel');

//Véhicules
Route::prefix('vehicules')->middleware('auth')->group(function (){
    Route::get('liste.html','Car\RegisterController@index')->name('vehicule.liste');
    Route::get('nouveau.html','Car\RegisterController@showNewFormView')->name('vehicule.nouveau');
    Route::post('nouveau.html','Car\RegisterController@ajouter');
    Route::get('reparations.html','Car\ReparationController@index')->name('reparation.liste');
    Route::get('interventions/nouvelle.html','Car\ReparationController@nouvelle')->name("reparation.nouvelle");
    Route::post('interventions/nouvelle.html','Car\ReparationController@ajouter');
    Route::get("{immatriculation}/details.html","Car\FicheController@details")->name("vehicule.details");
});

//Missions
Route::prefix('missions')->middleware('auth')->group(function (){
    Route::get('nouvelle.html','Mission\CreateController@nouvelle')->name('mission.nouvelle');
    Route::post('nouvelle.html','Mission\CreateController@ajouter');
    Route::get('liste.html','Mission\MissionController@liste')->name('mission.liste');
    Route::get('{reference}/detail.html','Mission\MissionController@details')->name('mission.details');
    Route::get('{reference}/modifier.html','Mission\UpdateController@modifier')->name('mission.modifier');
    Route::post('{reference}/modifier.html','Mission\UpdateController@update');
});

Route::prefix('administration')->middleware('auth')->group(function (){
    //Chauffeur
    Route::get('chauffeurs.html','Admin\ChauffeurController@liste')->name('admin.chauffeur.liste');
    Route::get('chauffeurs/ajouter.html','Admin\ChauffeurController@ajouter')->name('admin.chauffeur.ajouter');
    Route::post('chauffeurs/ajouter.html','Admin\ChauffeurController@register');
    Route::get('chauffeurs/{matricule}/situation.html','Admin\ChauffeurController@situation')->name("admin.chauffeur.situation");

    //Employé
    Route::get('employes.html','Admin\EmployeController@liste')->name('admin.employe.liste');
    Route::get('employes/ajouter.html','Admin\EmployeController@ajouter')->name('admin.employe.ajouter');
    Route::post('employes/ajouter.html','Admin\EmployeController@register');
    Route::get('employes/{matricule}/modifier.html','Admin\EmployeController@modifier')->name('admin.employe.modifier');
    Route::post('employes/{matricule}/modifier.html','Admin\EmployeController@update');
    Route::get('employe/{matricule}/fiche.html','Admin\EmployeController@fiche')->name('admin.employe.fiche');
    //Utilisateurs
    Route::get('utilisateurs.html', 'Admin\UtilisateurController@index')->name('admin.utilisateur.liste');
    Route::get('utilisateur/ajouter.html', 'Admin\UtilisateurController@ajouter')->name('admin.utilisateur.ajouter');
    Route::post('utilisateur/ajouter.html', 'Admin\UtilisateurController@register');
});

Route::get('/pdf.html',function (){
    echo \App\Metier\Finance\NombreToLettre::getLetter(3357200);
});

//Facturation
Route::prefix('factures')->middleware('auth')->group(function (){
    Route::get("liste.html","Order\FactureController@liste")->name("facturation.liste.all");
    Route::get("normale/liste.html","Order\FactureController@listeFacture")->name("facturation.liste.facture");
    Route::get("proforma/liste.html","Order\FactureController@listeProforma")->name("facturation.liste.proforma");
    Route::get("proforma/nouvelle.html","Order\ProformaController@nouvelle")->name("facturation.proforma.nouvelle");
    Route::post("proforma/nouvelle.html","Order\ProformaController@ajouter");
    Route::post("normale/make","Order\FactureController@makeNormal")->name("facturation.switch.normal");
    Route::get("{id}/livraison/make","Order\BonLivraisonController@makeBonLivraison")->name("facturation.switch.livraison");
    Route::get("{reference}/option-email.html","Order\SenderController@choice")->name("facturation.envoie.emailchoice");
    Route::get("{reference}/details.html","Order\FactureController@details")->name("facturation.details");
});

//Versement
Route::prefix("versement")->middleware("auth")->group(function (){
    Route::get("mission/{code}/nouveau.html","Money\VersementController@nouveauVersement")->name("versement.mission.ajouter");
    Route::post("mission/{code}/nouveau.html","Money\VersementController@ajouter");
});

//PDF
Route::prefix('impression')->middleware('auth')->group(function (){
    Route::get("{reference}/{state}/pdf.html","Printer\PdfController@imprimerPieceComptable")->name("print.piececomptable");
});

//Partenaires
Route::prefix('partenaires')->middleware('auth')->group(function (){
    Route::get('{type}/liste.html','Partenaire\RegisterController@liste')->name('partenaire.liste');
    Route::get('nouveau.html','Partenaire\RegisterController@nouveau')->name('partenaire.nouveau');
    Route::post('nouveau.html','Partenaire\RegisterController@ajouter');
    Route::get('{id}/modifier.html','Partenaire\RegisterController@modifier')->name('partenaire.modifier');
    Route::post('{id}/modifier.html','Partenaire\RegisterController@update');
    Route::get("{id}/details.html","Partenaire\DetailsController@fiche")->name("partenaire.client");
});

//Email
Route::prefix('email')->middleware('auth')->group(function (){
    Route::post('proforma/{reference}/send.html','Mail\OrderController@envoyerProforma')->name("email.proforma");
});