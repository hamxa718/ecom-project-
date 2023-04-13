<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class cartController extends Controller
{
    public function addtocart($id)
    {
        $product = product::find($id);
        // dd($product);
        $cart = Cart::add(['id' => $product->id, 'name' => $product->product_name, 'qty' => 1, 'price' => $product->price, 'weight' => 0]);
      
        return back()->with('success','Cart Added Successfully');
    }
    public function cartdata()
    {
        
        $allcart = Cart::content();
        // dd($allcart);
        $totalcart = Cart::priceTotal();
        
        // $product = product::where('id',$allcart->id)->get();
        return response()->json(['allcart'=>$allcart]);
   
    }
    public function cartShow()
    { 
        return view('user.cart');
    }

    public function deleteCartItem($rowId)
    {
        try {
            $allcart = Cart::remove($rowId);
            return back()->with('success','Cart Item Deleted Successfully');
        } catch (\Throwable $e) {
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
       
       
        
    }
    public function deleteCart()
    {
        
        Cart::destroy();
        return redirect('shop')->with('delete','Cart Deleted Successfully');
        
    }

    public function cartQuantityIncrease(Request $request)
    {
        
       $cartincrease = Cart::get($request->dataId);
       $qty = $cartincrease->qty + 1;
       $total = $cartincrease->price*$qty;
       Cart::update($request->dataId,$qty);
       return response()->json(['status' => ' 1' ,'qty'=>$qty,'total'=>$total]);
    //    return back()->with('success','Cart Item Quantity Increase Successfully');
        
    }
    public function cartQuantityDecrease(Request $request)
    {
        
        $cartincrease = Cart::get($request->dataId);
        if($cartincrease->qty == 1){
        }
        else{
            $qty = $cartincrease->qty -1;
            $total = $cartincrease->price*$qty;
        }
        Cart::update($request->dataId,$qty);
       return response()->json(['status' => ' 1','qty'=>$qty,'total'=>$total ]);
        
    }

}
