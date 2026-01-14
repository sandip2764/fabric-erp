<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Billing\BillingDashboardController;
use App\Http\Controllers\Pos\PosDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Stock\StockDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:stock'])->group(function () {
    Route::get('/stock/dashboard', [StockDashboardController::class, 'index'])
        ->name('stock.dashboard');
});

Route::middleware(['auth', 'role:billing'])->group(function () {
    Route::get('/billing/dashboard', [BillingDashboardController::class, 'index'])
        ->name('billing.dashboard');
});

Route::middleware(['auth', 'role:pos'])->group(function () {
    Route::get('/pos/dashboard', [PosDashboardController::class, 'index'])
        ->name('pos.dashboard');
});




require __DIR__.'/auth.php';
