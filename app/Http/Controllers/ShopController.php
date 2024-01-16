<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {   
        $page = $request->query("page");
        $size = $request->query("size");
        if(!$page)
            $page = 1;
        if(!$size)
            $size = 12;
        $order = $request->query("order");
        if(!$order)
            $order = -1;
        $o_column = "";
        $o_order = "";
        switch($order)
        {
            case 1:
                $o_column = "created_at";
                $o_order = "DESC";
                break;

            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;

            case 3:
                $o_column = "regular_price";
                $o_order = "ASC";
                break;

            case 4:
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
        }

        $products= Product::orderBy($o_column,$o_order)->orderBy('created_at', 'DESC')->paginate($size); // paginate(number of products in one page)  make sure you start ordering by o_column and 0_order since laravel runs commands in the order they are given.
        return view('shop',['products'=>$products, 'page'=>$page, 'size'=>$size, 'order'=>$order]);
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $rproducts = Product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(8);  //related products, not same to the same product, display 8 items
        return view ('details',['product'=>$product,'rproducts'=>$rproducts]);
    }
}
