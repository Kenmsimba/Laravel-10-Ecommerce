<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {   
        $products= Product::orderBy('created_at', 'DESC')->paginate(12); // paginate(number of products in one page)
        return view('shop',['products'=>$products]);
    }
}
