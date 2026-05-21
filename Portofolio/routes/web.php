<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use Illuminate\Support\Facades\Route;

// Ganti route '/' dengan PortfolioController
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// Route untuk admin (dengan middleware auth)
Route::post('/toggle-edit', [PortfolioController::class, 'toggleEdit'])->middleware('auth')->name('toggle.edit');
Route::post('/update-portfolio', [PortfolioController::class, 'updatePortfolio'])->middleware('auth')->name('update.portfolio');
Route::post('/reset-portfolio', [PortfolioController::class, 'resetPortfolio'])->middleware('auth')->name('reset.portfolio');
Route::post('/import-default', [PortfolioController::class, 'importDefaultData'])->middleware('auth')->name('import.default');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user && ($user->email === 'admin@example.com' || $user->role === 'admin')) {
        return redirect()->route('admin.portfolios.index');
    }

    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('admin/portfolios', AdminPortfolioController::class)
        ->except(['create', 'store'])
        ->names('admin.portfolios');
});

require __DIR__.'/auth.php';
