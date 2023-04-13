@extends('layouts.admin')
@section('content')

<h4>All Orders Product</h4>
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
            <th scope="col">Product Quantity </th>
            <th scope="col">Product Price</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($all_products as $pro)
          <tr>
            <td>{{$pro->name}}</td>
            <td>{{$pro->qty}}</td>
            <td>{{$pro->price}}</td>
            
         
          </tr> 
          
          @endforeach
         
           
        </tbody>
      </table>
      <div class="row">
      <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4"> Total Price of This Order</h5>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">{{ $all_order->product_price_subtotal  }}</span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>{{ $all_order->product_price_subtotal }}</span></li>
              <li class="border-bottom my-2"></li>
                
             
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

