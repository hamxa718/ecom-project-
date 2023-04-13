<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Validator;
use Gloudemans\Shoppingcart\Facades\Cart;


class categoryController extends Controller
{
    public function index()
    {
        $category = category::all()->take(4);
        $product = product::all()->take(8);
        $cart = Cart::content();
        
        return view('user.index',compact('category','product','cart'));
    }

}
