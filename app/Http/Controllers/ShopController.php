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

    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $rproducts = Product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(8);  //related products, not same to the same product, display 8 items
        return view ('details',['product'=>$product,'rproducts'=>$rproducts]);
    }
}
