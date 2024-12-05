<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::orderBy('id', 'DESC')->get();
        return response()->json(['products'=>$products]);
    }

    public function showProduct($id){
        $product = Product::find($id);
        return response()->json(['product'=>$product]);
    }
}
