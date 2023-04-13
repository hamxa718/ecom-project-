<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Gloudemans\Shoppingcart\Facades\Cart;

class productController extends Controller
{
    public function shopsProduct()
    {
        $count =product::count();
        $product = product::paginate(8);
        $category = category::all();
        $cart = Cart::content();
        
        return view('user.shop',compact('product','category','cart','count'));
    }
    public function shopsDetails($id)
    {
        
        $product = product::find($id);
        // dd($product);
        // $category = category::all();
       $category = category::where('id',$product->category_id)->first();
       $cart = Cart::content();
        return view('user.shopdetails',compact('product','category','cart'));
    }


public function categoriesShop($id)
    {
        
       $product = product::where('category_id',$id)->paginate(8);
        $category = category::find($id);
        $cart = Cart::content();
       
        return view('user.categories',compact('product','category','cart'));
    }

    public function shopsearch(Request $request)
    {
       
        $product = product::where('product_name', 'LIKE', "%{$request->shop_search}%")->paginate(8);
        // dd($count);
        $cart = Cart::content();
        return view('user.Shopsearch',compact('product','cart'));
    }
}