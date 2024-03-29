<?php

use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// create a route to app.blade.php with url '/'
Route::get('/', function () {
    return view('layouts/app');
})->middleware('auth');
// Route::get('/', [ProductController::class, 'index'])->name('product.index');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
