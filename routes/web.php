<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\AdminController;

// Page d'accueil : redirection en fonction de l'authentification de l'admin
Route::get('/', function () {
    if (auth('admin')->check()) {
        return redirect()->route('folders.index'); // Si l'admin est connecté, rediriger vers la liste des dossiers
    } else {
        return redirect()->route('admin.login'); // Sinon rediriger vers la page de connexion
    }
});

// Routes pour l'authentification administrateur
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login'); // Formulaire de connexion
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit'); // Soumettre la connexion
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout'); // Déconnexion
});

// Routes protégées par le middleware 'auth:admin' (requiert une connexion admin)
Route::middleware(['auth:admin'])->group(function () {
    // Routes pour l'affichage des dossiers
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index'); // Afficher tous les dossiers
    Route::get('folders/create', [FolderController::class, 'create'])->name('folders.create'); // Formulaire de création d'un dossier
    Route::post('folders', [FolderController::class, 'store'])->name('folders.store'); // Soumettre la création d'un dossier
    
    // Affichage des bénéficiaires d'un dossier spécifique
    Route::get('folders/{folder}/beneficiaries', [FolderController::class, 'showBeneficiaries'])->name('folders.beneficiaries');
    Route::get('folders/{folder}/beneficiaries', [FolderController::class, 'beneficiaries'])->name('folders.beneficiaries');
    Route::put('/folders/{folder}', [FolderController::class, 'update'])->name('folders.update');
   

// Route pour afficher le formulaire d'édition
Route::get('/folders/{folder}/edit', [FolderController::class, 'edit'])->name('folders.edit');

    Route::delete('folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');
    // Routes pour gérer les bénéficiaires (CRUD)
    Route::resource('beneficiaries', BeneficiaryController::class);
});
