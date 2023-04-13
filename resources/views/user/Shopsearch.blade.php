@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Shop Search</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <br>
      
      <div class="container">
        <div class="col-lg-6 mb-2 mb-lg-0">
          <p class="text-sm text-muted mb-0">Showing {{count($product)}} results</p>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        
      <br>
      <div class="row">
        @forelse ($product as $pro)
      

        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="product text-center">
            <div class="position-relative mb-3">
              <div class="badge text-white bg-"></div><a class="d-block" href="#"><img class="img-fluid w-100" src="{{asset('uploads/products/'.$pro->image)}}" alt="..."></a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                  @if(Auth::check())
                  @if (Auth::user()->role_id == 0)
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-primary" href="{{route('shopdetails',$pro->id)}}" >View Product</a></li>
                  
                  
                  @elseif($cart->where('id',$pro->id)->count())
                  
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-danger" >Already In Cart</a></li>
                  @else
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{route('addToCart',$pro->id)}}">Add to cart</a></li>
                  @endif
                  @else
                  @if($cart->where('id',$pro->id)->count())
                  
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-danger" >Already In Cart</a></li>
                  @else
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{route('addToCart',$pro->id)}}">Add to cart</a></li>
                  @endif
                  @endif
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="{{route('shopdetails',$pro->id)}}">{{$pro->product_name}}</a></h6>
            <p class="small text-muted">${{$pro->price}}</p>
          </div>
        </div>

        @empty
        <b>This Item is not available</b>
        @endforelse
       
      </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center justify-content-lg-end">
            
        {!! $product->links() !!}
          </ul>
        </nav>
      </div>

@endsection
