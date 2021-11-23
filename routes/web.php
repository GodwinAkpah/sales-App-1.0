<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('orders', OrderController::class);


Route::resource('products', ProductController::class);
Route::post('search', 'ProductController@search')->name('search');
// Route::get('search', [ProductController::class, 'search'])->name('search');

Route::post('autocomplete', [ProductController::class, 'autocomplete'])->name('autocomplete');

Route::resource('/suppliers', 'SupplierController');
//Route::resource('/users', 'UserController');
Route::resource('users', UserController::class);
Route::resource('/companies', 'CompanyController');
Route::resource('/transactions', 'TransactionController');
