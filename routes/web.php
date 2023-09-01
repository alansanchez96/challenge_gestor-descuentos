<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;

Route::get('/', fn () => view('welcome'));

Route::middleware('auth')->group(function () {
    Route::get('/profile',      [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',    [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::controller(DiscountController::class)->middleware('auth')->group(function () {
    Route::get('/discounts',                'index')->name('discount.index');
    Route::delete('/discounts/{discount}',  'destroy')->name('discount.destroy');
    Route::get('/create-discounts',         'create')->name('discount.create');
    Route::post('/create-discounts',        'store')->name('discount.store');
});
