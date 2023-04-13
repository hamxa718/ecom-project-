@extends('layouts.admin')

@section('content')
<div class="jumbotron">
  @if(isset($category))
  <h4>Edit Category Form</h4>
  <div class="container">
 @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
    
      <form method="post" action="{{route('categoryUpdate',$category->id)}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Category Name</label>
            <input type="name" class="form-control" name="category_name" value="{{$category->category_name}}" placeholder="Enter Category name">
           
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Category Title</label>
            <input type="name" class="form-control" id="exampleInputPassword1" value="{{$category->category_title}}" name="category_title" placeholder="Enter Category Title">
          
          </div>
          <div class="form-group">
              <div class="form-outline">
                  <label class="form-label" for="textAreaExample">Category Description</label>
                  <textarea class="form-control" id="textAreaExample1"  name="category_descrip" rows="4">{{$category->category_descrip}}</textarea>
                  
                </div>
            </div>
            
            <div class="row">
              <table class="table table-bordered">
                  <tr>
                      
                      <th>Select Image</th>
                  </tr>
                  <tbody>
                      <tr>
                          <td>
                              <img src="{{asset('uploads/category/'.$category->image)}}" alt="" id="img_0" style="height: 150px;width: 150px;">
                          </td>
                          <td>
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input"  name="image" id="gallery_0"   accept="image/*">
                                      <label class="custom-file-label" for="category-image">Choose file</label>
                                  </div>
                                  {!! $errors->first('product_image_first', '<p class="help-block">:message</p>') !!}
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
  
  </div>
  @else
<h4>Add Category Form</h4>
 @if (count($errors) > 0)
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
   <br>
<div class="container">
  
    <form method="POST" action="{{route('category_submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Category Name</label>
          <input type="text" class="form-control" value="{{old('category_name')}}" name="category_name" placeholder="Enter Category name">
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Category Title</label>
          <input type="text" class="form-control" id="exampleInputPassword1" value="{{old('category_title')}}" name="category_title" placeholder="Enter Category Title">
          
        </div>
        <div class="form-group">
            <div class="form-outline">
                <label class="form-label" for="textAreaExample">Category Description</label>
                <textarea class="form-control" id="textAreaExample1"  name="category_descrip" rows="4">{{old('category_descrip')}}</textarea>
               
              </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Product Image</label>
            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
          </div>
      
          
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

</div>
@endif
</div>


@endsection
