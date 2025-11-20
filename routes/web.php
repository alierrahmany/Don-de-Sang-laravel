<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonneurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReceveurController;
use App\Http\Controllers\MatchingController;



// Route racine - redirige vers le dashboard si authentifié, sinon vers le login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login.form');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par middleware auth
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     

    // Routes pour les donneurs
    Route::prefix('donneurs')->group(function () {
        Route::get('/', [DonneurController::class, 'index'])->name('donneurs.index');
        Route::get('/create', [DonneurController::class, 'create'])->name('donneurs.create');
        Route::post('/', [DonneurController::class, 'store'])->name('donneurs.store');
        Route::get('/{donneur}/edit', [DonneurController::class, 'edit'])->name('donneurs.edit');
        Route::put('/{donneur}', [DonneurController::class, 'update'])->name('donneurs.update');
        Route::delete('/{donneur}', [DonneurController::class, 'destroy'])->name('donneurs.destroy');
        Route::put('/{donneur}/toggle-disponibilite', [DonneurController::class, 'toggleDisponibilite'])->name('donneurs.toggle-disponibilite');
        Route::put('/{donneur}/enregistrer-don', [DonneurController::class, 'enregistrerDon'])->name('donneurs.enregistrer-don');
    });

// Routes pour les receveurs
Route::prefix('receveurs')->group(function () {
    Route::get('/', [ReceveurController::class, 'index'])->name('receveurs.index');
    Route::get('/create', [ReceveurController::class, 'create'])->name('receveurs.create');
    Route::post('/', [ReceveurController::class, 'store'])->name('receveurs.store');
    Route::get('/{receveur}', [ReceveurController::class, 'show'])->name('receveurs.show');
    Route::get('/{receveur}/edit', [ReceveurController::class, 'edit'])->name('receveurs.edit');
    Route::put('/{receveur}', [ReceveurController::class, 'update'])->name('receveurs.update');
    Route::delete('/{receveur}', [ReceveurController::class, 'destroy'])->name('receveurs.destroy');
    
    // Actions supplémentaires
    Route::put('/{receveur}/toggle-urgence', [ReceveurController::class, 'toggleUrgence'])->name('receveurs.toggle-urgence');
    Route::put('/{receveur}/satisfait', [ReceveurController::class, 'markAsSatisfied'])->name('receveurs.satisfait');
    Route::put('/{receveur}/en-attente', [ReceveurController::class, 'markAsPending'])->name('receveurs.en-attente');
});

// Routes pour le matching
Route::prefix('matching')->group(function () {
        Route::get('/', [MatchingController::class, 'index'])->name('matching.index');
        Route::post('/assigner', [MatchingController::class, 'assignerDonneur'])->name('matching.assigner');
        Route::get('/historique', [MatchingController::class, 'historique'])->name('matching.historique');
        Route::get('/assignation/{id}', [MatchingController::class, 'showAssignation'])->name('matching.show');
    });

});