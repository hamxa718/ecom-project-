@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">My Orders</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="container">
        
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
         
          @forelse ($myorders as $myorder)
     
            <tr>
              <td>{{$myorder->first_name}}</td>
              <td>{{$myorder->email}}</td>
              <td>{{$myorder->number}}</td>
              
              <td>{{$myorder->product_price_subtotal}}</td>
              <td>{{$myorder->payment_process}}</td>
              <td>{{$myorder->status}}
            </tr> 
            @empty
            <tr>
            <td colspan="8" style="text-align: center;">No Record Found</td>  
            </tr>    
       @endforelse
      
          </tbody>
        </table>
        

      </div>

@endsection
