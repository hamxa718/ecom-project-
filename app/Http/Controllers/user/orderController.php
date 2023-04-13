<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\order_product;
use App\Models\order;
use Auth;
use App\User;
use File;
use Validator;


class orderController extends Controller
{
    public function index()
    {
        $totalcart = Cart::priceTotal();
        $allcart = Cart::content();
        if(isset(Auth::user()->id)){
            $getUser = User::where('id',Auth::user()->id)->first();
           
       
            return view('user.checkout',compact('totalcart','allcart','getUser'));
        }
        
        
        
        return view('user.checkout',compact('totalcart','allcart'));
    }
    public function placeorder(Request $request)
    {
            
     
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:25',
                'lastName' => 'required|string|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:25',
                'email' => 'required',
                'phone' => 'required|max:15',
                'address_first' => 'required|max:256',
                
                'city' => 'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
                'Country' => 'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
                'payment_process' => 'required',
            ]);
    
    
    // Return the message
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }

    
            

            // 'manufacturer' => 'required',
        
        
        $order_subtotal = 0;
        // dd( $request->input('product_subtotal'));
        $timestamp = mt_rand(1, time());
        
        $request->session()->put('user_id', Auth::user()->id ??'');
        $request->session()->put('firstName', $request->input('firstName'));
        $request->session()->put('order_tracking_id',"BTPD".$timestamp);
        
        $request->session()->put('lastName',$request->input('lastName'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('phone', $request->input('phone'));
        $request->session()->put('company', $request->input('company'));
        $request->session()->put('address_first', $request->input('address_first'));
        $request->session()->put('address_second', $request->input('address_second'));
        $request->session()->put('city', $request->input('city'));
        $request->session()->put('Country', $request->input('Country'));
        $request->session()->put('product_subtotal', $request->input('product_subtotal'));
        $request->session()->put('payment_process', $request->input('payment_process'));
        $order_subtotal =  $request->session()->get('product_subtotal');  
        $order_email =  $request->session()->get('email');
        $order_tracking_id =  $request->session()->get('order_tracking_id');


        if($request->payment_process == 'cash'){
            $order = new order;
            $order->user_id = Auth::user()->id ??'';
            
            $order->first_name = $request->input('firstName');
            $order->order_tracking_id = "BTPD".$timestamp;
            
            $order->last_name = $request->input('lastName');
            $order->email = $request->input('email');
            $order->number = $request->input('phone');
            $order->company_name = $request->input('company');
            $order->address_first = $request->input('address_first');
            $order->address_second = $request->input('address_second');
            $order->city = $request->input('city');
            $order->country = $request->input('Country');
            $order->product_price_subtotal = $request->input('product_subtotal');
            $order->payment_process = $request->input('payment_process');
            $order->status = 'pending';
            $order->save();
            $order_payment = $order->payment_process;
            $orderid = $order->id;
            $order_subtotal = $order->product_price_subtotal;
          
            $order_email = $order->email;
            $order_tracking_id = $order->order_tracking_id;
            $allcart = Cart::content();
    
            foreach($allcart as $product){
                order_product::create([
                    'order_id' => $orderid,
                    'product_id' => $product->id,
                    'qty' => $product->qty,
                    'name' => $product->name,
                    'price' => $product->price,
                    'weight' => $product->weight,
                    
                ]);
            }
            Cart::destroy();
            
            return view('user.thankyou',compact('order_tracking_id'));

        }
        else{
           
            \Stripe\Stripe::setApiKey('sk_test_51L6BbmHh7DA7fp0JBVYZphgLBNOStcNsdKyockhG7OdGCpfL8eBETqsN3XniEjRPGFuc8C272ORCR1YsFcKi2clz00ilFXOFCW');
            
       
            //$amount_all = cleanNumber($order_subtotal);
            $myNumber = (str_replace(',', '', $order_subtotal));
            
            // dump(gettype($amount_all));
            // dd(gettype($amount_all));
            $amount =(int)100* $myNumber;
            
            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Stripe Test Payment',
                'amount' => $amount,
                'currency' => 'USD',
                'description' => $order_email,
                'payment_method_types' => ['card'],
            ]);
            $intent = $payment_intent->client_secret;
    
            return view('user.stripemethod',compact('intent','order_tracking_id'));
        }
 
   
    
        // return view('user.checkout');
    }
    
    

    public function afterPayment(Request $request)
    {
        $order = new order;
        $order->user_id = Auth::user()->id ??'';
        
        $order->first_name = $request->session()->get('firstName');
        $order->order_tracking_id = $request->session()->get('order_tracking_id');
        
        $order->last_name = $request->session()->get('lastName');
        $order->email = $request->session()->get('email');
        $order->number = $request->session()->get('phone');
        $order->company_name = $request->session()->get('company');
        $order->address_first = $request->session()->get('address_first');
        $order->address_second = $request->session()->get('address_second');
        $order->city = $request->session()->get('city');
        $order->country = $request->session()->get('Country');
        $order->product_price_subtotal = $request->session()->get('product_subtotal');
        $order->payment_process = $request->session()->get('payment_process');
        $order->status = 'pending';
        $order->save();
        $order_payment = $order->payment_process;
        $orderid = $order->id;
        $order_subtotal = $order->product_price_subtotal;
      
        $order_email = $order->email;
        $order_tracking_id_stripe = $order->order_tracking_id;
        $allcart = Cart::content();

        foreach($allcart as $product){
            order_product::create([
                'order_id' => $orderid,
                'product_id' => $product->id,
                'qty' => $product->qty,
                'name' => $product->name,
                'price' => $product->price,
                'weight' => $product->weight,
                
            ]);
        }
        Cart::destroy();
        return view('user.thankyou',compact('order_tracking_id_stripe'));
    }
    public function orderstatuspage()
    {   
        return view('user.orderstatus');
        

    }
    public function searchorder(Request $request)
    {   
        $order_search = order::where('order_tracking_id',$request->order_id)->first();
        return view('user.orderstatus',compact('order_search'));
        

    }
    public function statuschange(Request $request)
    {   
        $statuschange = order::where('id',$request->dataId)->update(['status' => $request->value]);
        return response()->json(['status' => ' 1' ]);
        
        

    }

    public function myorders($id)
    {   
       
        $myorders = order::where('user_id',$id)->get();
      
        return view('user.myorders',compact('myorders'));

    }

    public function downloadorderid($id)
    {   
       
        $data = json_encode(['Your Order Id Is :',$id]);
  
        $fileName = 'Boutique Order Id.txt';
        $fileStorePath = public_path($fileName);
  
        File::put($fileStorePath, $data);
 
        return response()->download($fileStorePath);

    }


}
