<?php

use App\Http\Controllers\PakUniversityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsCredentialsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'preventBackHistory'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
// Grouped routes protected by 'auth' middleware.
Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/find-portal', [DashboardController::class, 'findBestPortal'])->name('dashboard.findBestPortal');

    // Portal routes
    Route::get('/portals', [PortalController::class, 'index'])->name('portals.index');
    Route::get('/portals/create', [PortalController::class, 'create'])->name('portals.create');
    Route::post('/portals', [PortalController::class, 'store'])->name('portals.store');
    Route::get('/portals/{portal}', [PortalController::class, 'show'])->name('portals.show');
    Route::get('/portals/{portal}/edit', [PortalController::class, 'edit'])->name('portals.edit');
    Route::put('/portals/{portal}', [PortalController::class, 'update'])->name('portals.update');
    Route::delete('/portals/{portal}', [PortalController::class, 'destroy'])->name('portals.destroy');

    // University routes
    Route::get('/universities', [UniversityController::class, 'index'])->name('universities.index');
    Route::get('/universities/create', [UniversityController::class, 'create'])->name('universities.create');
    Route::post('/universities', [UniversityController::class, 'store'])->name('universities.store');
    Route::get('/universities/{university}', [UniversityController::class, 'show'])->name('universities.show');
    Route::get('/universities/{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
    Route::put('/universities/{university}', [UniversityController::class, 'update'])->name('universities.update');
    Route::delete('/universities/{university}', [UniversityController::class, 'destroy'])->name('universities.destroy');

    // Commission routes
    Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions.index');
    Route::post('/commissions/update-all', [CommissionController::class, 'updateAll'])->name('commissions.updateAll');
    Route::get('/commissions/edit', [CommissionController::class, 'edit'])->name('commissions.edit');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students-credentials', [StudentsCredentialsController::class, 'index'])->name('students_credentials.index');
    Route::get('/students-credentials/create', [StudentsCredentialsController::class, 'create'])->name('students_credentials.create');
    Route::post('/students-credentials', [StudentsCredentialsController::class, 'store'])->name('students_credentials.store');
    Route::get('/students-credentials/{id}/edit', [StudentsCredentialsController::class, 'edit'])->name('students_credentials.edit');
    Route::put('/students-credentials/{id}', [StudentsCredentialsController::class, 'update'])->name('students_credentials.update');
    Route::delete('/students-credentials/{id}', [StudentsCredentialsController::class, 'destroy'])->name('students_credentials.destroy');

    Route::resource('pak-universities', PakUniversityController::class);
});

// Include authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
