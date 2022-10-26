<?php

namespace App\Http\Controllers;

use App\Contracts\CurServiceInteface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CurrencyService;

class StoreController extends Controller
{
    public function __construct()
    {
        // $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        // session()->put('test', 'ololo');
        // session()->push('test2', '123456');
        // dump(session()->all());
        // $this->service->getRate();

        $products = Product::query()->where('active', 1)->limit(20)->with('category')->get();
        $categories = Category::withCount('products')->get();
        return view('site.store', compact('products', 'categories'));
    }

    public function product(Request $request, $category_id, $product_id){
        $product = Product::where('active', 1)
        ->where('category_id', $category_id)
        ->where('id', $product_id)
        ->first();
        return view('site.product', compact('product'));
    }
}

