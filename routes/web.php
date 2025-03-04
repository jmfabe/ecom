<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', [ProductController::class, 'index'])->name('products.index'); // Show product list

Route::middleware('auth')->group(function () {
    Route::get('/products/{id}/buy', [ProductController::class, 'buy'])->name('products.buy'); // Show buy page for product
Route::post('/products/charge', [ProductController::class, 'charge'])->name('products.charge'); // Handle Stripe payment
});
require __DIR__.'/auth.php';
