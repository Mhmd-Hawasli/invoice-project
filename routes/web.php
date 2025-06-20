<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceDetailController;



Route::get('/testlogin', function () {
    return "SectionControll";
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/sections', SectionController::class);
    Route::get('/sections/{id}/getProducts', [SectionController::class, 'getProducts']);
    Route::resource('/products', ProductController::class);
    Route::get('/invoices/{invoice:invoice_number}/details', [InvoiceDetailController::class, 'show']);
});

require __DIR__ . '/auth.php';
