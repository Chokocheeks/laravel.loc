<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        // session()->put('test', 'ololo');
        // session()->push('test2', '123456');
        // dump(session()->all());


        $products = Product::query()->where('active', 1)->limit(20)->with('category')->get();
        $categories = Category::withCount('products')->get();
        return view('site.store', compact('products', 'categories'));
    }
}

