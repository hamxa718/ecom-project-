<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Validator;

class categoryController extends Controller
{
    public function index()
    {
        return view('admin.category.addcategory');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'=>'required|max:15|unique:categories|regex:/(([a-zA-Z]+)(\d+)?$)/u',
            'category_title'=>'required|max:15|regex:/(([a-zA-Z]+)(\d+)?$)/u',
            'category_descrip'=>'required|regex:/(([a-zA-Z]+)(\d+)?$)/u|max:15',
            'image'=>'required|image|mimes:jpeg,png,jpg',
         ]);
         $request->file('image');
        
         $category_image = time() . '_' . $request->file('image')->getClientOriginalName();
         
         $request->file('image')->move(public_path() . '/uploads/category/', $category_image);
         
        $category = new category;
        $category->category_name = $request->category_name;
        $category->category_title = $request->category_title;
        $category->	category_descrip = $request->category_descrip;
        $category->image = $category_image;
        $category->save();
        return redirect('viewCategory')->with('success','Category Added Successfull');
    }

    public function allCategory()
    {
        
        $category = category::all();
        
        return view('admin.category.viewCategory',compact('category'));
    }
    public function deleteCategory($id)
    {
        $category = category::find($id);
        $prod_cat = product::where('category_id',$id)->get();
        if($prod_cat->isEmpty()){
            $category->delete();
            return redirect('viewCategory')->with('success','Category Deleted Successfull');

        }
        else{

           
            return back()->with('error','You Cant Delete This Caetgory, there are to many products in this categroy');
     
        }
    }
    public function editCategory($id)
    {
        $category = category::find($id);
      
        return view('admin.category.addcategory',compact('category'));
    }
    public function categoryUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'category_name'=>'max:15|regex:/(([a-zA-Z]+)(\d+)?$)/u',
            'category_title'=>'max:15|regex:/(([a-zA-Z]+)(\d+)?$)/u',
            'category_descrip'=>'max:256|regex:/(([a-zA-Z]+)(\d+)?$)/u',
            'image'=>'image|mimes:jpeg,png,jpg',
         ]);
        $category = category::find($id);
        $category->category_name = $request->category_name;
        $category->category_title = $request->category_title;
        $category->category_descrip = $request->category_descrip;
        if($request->file('image')){
        
         $category_image = time() . '_' . $request->file('image')->getClientOriginalName();
         
         $request->file('image')->move(public_path() . '/uploads/category/', $category_image);
         $category->image = $category_image;
        }
        else{

            $category->image = $category->image;
        }
        $category->update();
      
        return redirect('viewCategory')->with('success','Category Updated Successfull');
    }
    
}
