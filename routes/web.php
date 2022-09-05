<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MyController;
use App\Http\Controllers\Admin\product\ProductController;
use App\Models\Category;
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

Route::get('/', function () {
    $category = Category::all();
    dump($category);
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->group(function(){
    // Categories
    Route::get('/', [\App\Http\Controllers\Admin\MyController::class, 'index'])
    ->name('categories.index');
    Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    
    Route::post('/categories/create', [CategoryController::class, 'store']);
    
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    
    Route::put('/categories/{category}/update', [CategoryController::class, 'update']);
    
    Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete']);

    Route::resource('categories', CategoryController::class)
    ->except(['show']);

    // Product
    // Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});