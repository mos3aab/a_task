<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
// Route::get('/login',function()})->name('login');;
Route::get('/', function () {
    return view('home');
})->name('home');

//  products
Route::get('/products',[ProductController::class, 'index'])->name('products');
Route::get('/addProduct',[ProductController::class, 'create'])->name('addProduct');


//  categories
Route::get('/categories',[ CategoryController::class, 'index'])->name('categories');
Route::get('/addCategory',[CategoryController::class, 'create'])->name('addCategory');
Route::post('/addCatalog',[CategoryController::class, 'store']);
Route::get('/editCatalog/{id}',[CategoryController::class, 'edit']);
Route::post('/upadteCategory/{id}',[CategoryController::class, 'update']);
Route::get('/deleteCatalog/{id}',[CategoryController::class, 'destroy']);

