<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke()
    {
        $products = Product::query()->where('active', 1)->limit(20)->get();
        return view('site.store', compact('products'));
    }
}
