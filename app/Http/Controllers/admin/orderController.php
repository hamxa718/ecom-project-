<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_product;
use App\Models\order;


class orderController extends Controller
{
    public function allorder()
    {
        $allorder = order::all();
      
        return view('admin.orders.allorders',compact('allorder'));
    }
    public function allorderproducts($id)
    {
        $all_products = order_product::where('order_id',$id)->get();
        $all_order = order::where('id',$id)->first();
        
        
        return view('admin.orders.allordersproduct',compact('all_products','all_order'));
        
    }
    public function dashboard()
    {
        // $all_products = order_product::where('order_id',$id)->get();
        $all_order = order::count();
        $all_orders = order::select('product_price_subtotal')->get();
        $total_sum = array();
        foreach($all_orders as $all){
            $myprice = $all->product_price_subtotal;
            $total_sum[] = (str_replace(',', '', $myprice));
            
        }
     
       $all_price =  array_sum($total_sum );
        $all_order_approve = order::where('status','approved')->count();
        $all_order_pending = order::where('status','pending')->count();
        
        return view('admin.home',compact('all_order','all_price','all_order_approve','all_order_pending'));
        
    }
}
