<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonneurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

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
});