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
use GuzzleHttp\Client;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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



 Route::get('/test', function(Request $request){
    // $client = new Client();
    // $query = [
    //     'ondate' => '2016-7-1',
    //     'periodicity'=> '1'
    // ];
    // $client = new Client([
    //     'base_uri' => 'https://www.nbrb.by/api/'
    // ]);
    // $response = $client->get('exrates/rates/145',['query' => $query]);
    // $response = $client->get('exrates/rates',['query' => $query]);

    // dd(json_decode(($response->getBody()->getContents()), true));

    // $responce = Http::
    // // accept('application/json')
    // acceptJson()
    // ->get('https://www.nbrb.by/api/exrates/rates/145?ondate=2016-7-1&periodicity=1');
    // if($responce->failed()){
    //     switch(true){
    //         case $responce->clientError();
    //             # code...
    //             break;
    //         case $responce->serverError():
    //             # code...
    //             break;
    //     }
    // }
    // dd($responce->body());


    return view('test');
 });


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

});
