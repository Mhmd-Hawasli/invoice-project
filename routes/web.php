<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/testlogin', function ()
{
    return "SectionControll";
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');




Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/invoice', InvoiceController::class);
    Route::resource('/sections', SectionController::class);
    Route::resource('/products', ProductController::class);
});

require __DIR__ . '/auth.php';
