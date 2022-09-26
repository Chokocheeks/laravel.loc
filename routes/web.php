<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MyController;
// use App\Http\Controllers\Admin\product\ProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StoreController;
use App\Http\Middleware\MyMiddleware;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

 Route::get('/', SiteController::class);
 Route::get('/catalog', StoreController::class);
// Route::get('/', function () {
    
//     // Storage::temporaryUrl('1.txt', now()->addMinutes(5));
//     // Storage::disk('app/public')->put('1.txt', 'olololo');
//     // Storage::url('aviator.txt');
    
// // Route::get('any_file', function(){
// //     return Storage::download('1.txt');
// // });

//     // $category = Category::all();
//     // dump($category);
//     // return view('welcome');
// }

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware('auth')->group(function(){
    // Categories
    Route::get('/', [\App\Http\Controllers\Admin\MyController::class, 'index'])->withoutMiddleware('auth');
    // Route::resource('categories', CategoryController::class)
    // ->except(['show']);
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'articles' => ArticleController::class
    ]);





    // Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index']);
    // Route::get('/categories/create', [CategoryController::class, 'create']);
    
    // Route::post('/categories/create', [CategoryController::class, 'store']);
    
    // Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    
    // Route::put('/categories/{category}/update', [CategoryController::class, 'update']);
    
    // Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete']);

    // Product
    // Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});
