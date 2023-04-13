<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
class productController extends Controller
{
    public function index()
    {
        $allCategory = category::all();
        
        return view('admin.products.addproduct',compact('allCategory'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'category_name'=>'required',
            'category_type'=>'required',
            'product_name'=>'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
            'descrip'=>'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
            'price'=>'required|max:6',
            'image'=>'required|image|mimes:jpeg,png,jpg',
         ]);
        // dd($request->file('image'));
        $request->file('image');
        
        $product_image = time() . '_' . $request->file('image')->getClientOriginalName();
        
        $request->file('image')->move(public_path() . '/uploads/products/', $product_image);
        
        $product = new product;
        $product->category_id = $request->category_name;
        $product->category_type = $request->category_type;
        $product->product_name = $request->product_name;
        $product->description = $request->descrip;
        $product->price = $request->price;
        $product->image = $product_image;
        $product->save();
        return redirect('viewProduct')->with('success','Product Added Successfull');
    }
    public function allProduct()
    {
        
        $product = product::all();
        
        return view('admin.products.viewproduct',compact('product'));
    }
    public function deleteProduct($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect('viewProduct')->with('success','Product Deleted Successfull');
    }
    public function editProduct($id)
    {
        $allCategory = category::all();
        $product = product::find($id);
      
        return view('admin.products.addproduct',compact('product','allCategory'));
    }
    public function productUpdate(Request $request ,$id)
    {
        // dd($request->all());
        
       
        $this->validate($request,[
            'product_name'=>'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
            'descrip'=>'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:256',
            'price'=>'required|max:6',
            'image'=>'image|mimes:jpeg,png,jpg',
         ]);
        $product = product::find($id);
       
        $product->category_id = $request->category_name;
        $product->category_type = $request->category_type;
        $product->product_name = $request->product_name;
        $product->description = $request->descrip;
        $product->price = $request->price;
        
        if($request->image != ''){        
            $path = public_path().'/uploads/products/';
  
            //code for remove old file
            // if($product->image != ''  && $product->image != null){
            //      $file_old = $path.$product->image;
            //      unlink($file_old);
            // }
  
            //upload new file
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
  
            //for update in table
            $product->update(['image' => $filename]);
       }  
    
    else{
           $product->image = $product->image;   
    }

        $product->save();
      
        return redirect('viewProduct')->with('success','Product Updated Successfull');
    }
}
