<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __invoke()
    {
        //select * from products where active = 1 and category_id = 1 order by desc
        $latestProducts = Product::query()
        // ->select(['id', 'name', 'image'])
        ->where('active', 1)
        ->limit(10)
        ->latest()
        // ->orderBy('id', 'desc')
        // ->where('id', '>', 10)
        // ->where([
        //     ['id', '>', '10'],
        //     ['active', 1]
        // ])
        // ->orWhere('id', '>', 5)
        ->get();

        return view('site.index', compact('latestProducts'));
    }
}
