@extends('layouts.admin')
@section('content')

<h4>View Category</h4>
   <br>
<div class="container">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    
    <table class="table table-striped"  id="dataTable">
        <thead>
          <tr>
            
            <th scope="col">Category Name</th>
            <th scope="col">Category Title</th>
            <th scope="col">Category Description</th>
            <th scope="col">Category Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($category as $cat)
          <tr>
            <td>{{$cat->category_name}}</td>
            <td>{{$cat->category_title}}</td>
            <td>{{$cat->category_descrip}}</td>
            <td><img width="100" height="50" src="{{asset('uploads/category/'.$cat->image)}}"
              class="attachment-thumbnail size-thumbnail" alt=""></td>
            
            <td><a href="{{route('editcategory',$cat->id)}}" class="btn btn-primary">Edit </a>
              <a href="{{route('deletecategory',$cat->id)}}" class="btn btn-danger">Delete </a></td>
          </tr>     
          @endforeach
         
          
        </tbody>
      </table>


</div>

@endsection

