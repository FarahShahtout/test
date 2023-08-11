<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('layouts.new');
// });

 Route::get('/', function () {
     return view('welcome');
 });

Route::resource('categories',CategoryController::class);
 Route::resource('products',ProductController::class);
Route::resource('users',UserController::class);


// Route::get('products', function () {
//     $products=\App\Product::all();
//     return view('welcome');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Mail::to('test@laravel.com')->send(new App\Mail\DemoMail);
