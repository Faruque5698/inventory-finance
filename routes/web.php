<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\SaleController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('products/status-update/{id}',[ProductController::class, 'statusUpdate'])->name('products.update-status');
    Route::resource('products',ProductController::class);
    Route::resource('inventories',InventoryController::class);
    Route::resource('sales',SaleController::class);


});




require __DIR__.'/auth.php';
