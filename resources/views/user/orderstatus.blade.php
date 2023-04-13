@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Check Order Status</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Status</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="container">
    
        <b>Enter Your Order Id</b>
        <br>
       <form action="{{route('searchorder')}}" method="post">
<div class="input-group mb-3">
  @csrf
  <input type="text" class="form-control" name="order_id" required placeholder="Order Tracking Id" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="input-group-text" id="basic-addon2">Search</button>
  </div>
</div>
   </form>
        <p><b>YOUR ORDER DETAILS :</b></p>
        <br>
        @if(isset($order_search))
            
        
        <table class="table table-striped"  id="dataTable">
          <thead>
            <tr>
              
              <th scope="col">Customer Name</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Customer Phone Num</th>
              
              <th scope="col">Total Price</th>
              <th scope="col">Payment Process</th>
              
              <th scope="col">Order Status</th>
              
            </tr>
          </thead>
          <tbody>
          
            <tr>
              <td>{{$order_search->first_name}}</td>
              <td>{{$order_search->email}}</td>
              <td>{{$order_search->number}}</td>
              
              <td>{{$order_search->product_price_subtotal}}</td>
              <td>{{$order_search->payment_process}}</td>
              <td>{{$order_search->status}}
            </tr>     
       
           
            
          </tbody>
        </table>
        @else
        
        <center><b>No Any Record Found</b></center>
        @endif

      </div>

@endsection
