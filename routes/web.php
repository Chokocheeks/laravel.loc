<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MyController;
// use App\Http\Controllers\Admin\product\ProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StoreController;
use App\Http\Middleware\MyMiddleware;
use App\Mail\FirstMail;
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
use Illuminate\Support\Facades\Mail;

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
//currency-convert
Route::get('currency', function (Request $request){
   
    $responce = Http::get('https://www.nbrb.by/api/exrates/currencies');
    $currencies = $responce->collect()->keyBy('Cur_Abbreviation');
    
    return view('currency', compact('currencies'));
});
Route::post('currency', function (Request $request){
    $query = ['pereodicity' => 0];
    $responce = Http::get('https://www.nbrb.by/api/exrates/rates', $query);
    dd($responce->collect()->keyBy('Cur_Abbreviation'));
    
});


//weather
Route::get('/weather', function(Request $request){
    $query = [
        // 'key' => '79d1b317825f43db8af163400220510',
        'key' => env('WEATHER_AOI_KEY'),
        'q' => 'Minsk',
        'dt' => '1989-08-31'
    ];
    $client = Http::baseUrl('http://api.weatherapi.com/v1');
    $responce = $client->get('/current.json', $query);
    dump($responce['current']['temp_c'].' in '.$responce['location']['region']);
    dd($responce->json());
});

// Route::get('/giphy',function(Request $request){
//     $query = [
//         'api_key' => 'QktM1VYRUFP5y7Y5fRp4ynMqxlbeTVGf',
//         'limit' => '25',
//         'rating' => 'g'
//     ];
//     $responce = Http::get('https://api.giphy.com/v1/gifs/trending', $query);
//     // dd($responce->json());
//     foreach($responce->collect(['data']) as $gif){
//         echo "<video autoplay loop src='{$gif['embed_url']}'></>";
//     }
// });

// Route::get('/giphy',function(Request $request){
//     $query = [
//         'lang' => 'ru',
//         'type' => 'json'
//     ];
//     $responce = Http::get('https://evilinsult.com/generate_insult.php', $query);
//     dd($responce->json());
    
// });

// Route::get('/giphy',function(Request $request){
//     $query = [
//         'lang' => 'ru',
//         'type' => 'json'
//     ];
//     $responce = Http::get('https://evilinsult.com/generate_insult.php', $query);
//     dd($responce->json());
    
// });

// Route::get('/giphy',function(Request $request){
//     $mail = new FirstMail('hello mail');
//     Mail::send($mail);
    
// });

Route::get('/day', function(Request $request){
    
    $responce = Http::get('https://favqs.com/api/qotd');
    $quote = [$responce->json()][0]['quote'];
    // dd($responce->json());
    return view('day', compact('quote'));
});

Route::get('advice', function(Request $request){
    $responce = Http::get('https://api.adviceslip.com/advice');
    $advice = [$responce->json()][0]['slip']["advice"];
    // dd($advice);
    return view('advice', compact('advice'));
});

// Route::get('/minion', function(Request $request){
//     $query = [
//         'text' => 'maybe'
//     ];
//     $responce = Http::post('https://api.funtranslations.com/translate/minion.json', $query);
//     dump($_POST);
//     $text = $responce->json();
//     dd($text);
//     return view('minion', compact('quote'));
// });


// Route::get('/giphy', function(){
//     // $responce = Http::get('https://favqs.com/api/qotd');
//     // $quote = [$responce->json()][0]['quote']['body'];

//     Http::post('https://api.tlgr.org/bot5779101922:AAGWPvloaakYSGTXUP3wnl9Dr9EDy_mxY80/sendMessage', [
//         'chat_id' => -1001788886139,
//         'message' => 'hi'
//     ]);
// });
