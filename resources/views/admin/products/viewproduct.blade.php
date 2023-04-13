@extends('layouts.admin')
@section('content')

<h4>View Product</h4>
   <br>
<div class="container">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    
    <table class="table table-striped"  id="dataTable">
        <thead>
          <tr>
            
            <th scope="col">Product Name</th>
            <th scope="col">Product Type</th>
            
            <th scope="col">Product Price</th>
            <th scope="col">Product Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($product as $prod)
          <tr>
            <td>{{$prod->product_name}}</td>
            <td>{{$prod->category_type}}</td>
            
            <td>{{$prod->price}}</td>
            <td><img width="100" height="50" src="{{asset('uploads/products/'.$prod->image)}}"
               class="attachment-thumbnail size-thumbnail" alt=""></td>
            
            <td><a href="{{route('editProduct',$prod->id)}}" class="btn btn-primary">Edit </a>
              <a href="{{route('deleteProduct',$prod->id)}}" class="btn btn-danger">Delete </a></td>
          </tr>     
          @endforeach
         
          
        </tbody>
      </table>


</div>

@endsection

