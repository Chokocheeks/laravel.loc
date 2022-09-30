<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MyController;
// use App\Http\Controllers\Admin\product\ProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StoreController;
use App\Http\Middleware\MyMiddleware;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
 Route::get('/catalog/{category_id}/{product_id}', [StoreController::class, 'product'])->name('product_page');
 Route::get('/cart',[ CartController::class, 'getCart'])->name('cart');
 Route::post('/add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');



 Route::post('/test', function(Request $request){
    $data = $request->all();
    return response($data, 201);
    // return response()->json($data);
    return response()->setStatusCode(401);

//     $data = [
//         'name' => 'vi',
//         'lastname' => 'Skrip',
//         'child' => [
//             'boy' => 'jjjj',
//             'girl' => 'ksg'
//         ]
//         ];
//    json_encode($data);
//    dump(json_encode($data));


    
    //$product = Product::inRandomOrder()->first();
    //$category = Category::findOrFail($product->category_id);
    //$category = Category::inRandomOrder()->first();
    // $category = Category::find(1);

    // dd($category->products()->where('active', 1));
 });
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
