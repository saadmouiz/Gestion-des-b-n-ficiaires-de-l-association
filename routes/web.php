<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\AdminController;

// Page d'accueil, redirige vers la liste des bénéficiaires (ou vers la page de connexion si l'administrateur n'est pas connecté)
Route::get('/', function () {
    // Vérifiez si l'administrateur est connecté

    if (auth('admin')->check()) {

        return redirect()->route('beneficiaries.index'); // Si connecté, afficher les bénéficiaires

    } else {

        return redirect()->route('admin.login'); // Sinon, rediriger vers la page de connexion
    }
});


// Routes d'authentification pour l'administrateur
Route::prefix('admin')->group(function () {
    // Afficher le formulaire de connexion
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');


    // Soumettre le formulaire de connexion
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');


    // Déconnexion de l'administrateur
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


// Protéger toutes les routes d'administration par un middleware pour s'assurer que l'administrateur est connecté
Route::middleware(['auth:admin'])->group(function () {

    // Liste des bénéficiaires
    Route::resource('beneficiaries', BeneficiaryController::class);


    // Afficher un bénéficiaire spécifique
    Route::get('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');


    // Formulaire de création d'un bénéficiaire
    Route::get('beneficiaries/create', [BeneficiaryController::class, 'create'])->name('beneficiaries.create');


    // Enregistrer un nouveau bénéficiaire
    Route::post('beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');


    // Formulaire d'édition d'un bénéficiaire
    Route::get('beneficiaries/{beneficiary}/edit', [BeneficiaryController::class, 'edit'])->name('beneficiaries.edit');


    // Mettre à jour un bénéficiaire
    Route::put('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');


    // Supprimer un bénéficiaire
    Route::delete('beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');
});

