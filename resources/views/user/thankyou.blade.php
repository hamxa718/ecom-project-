@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Thankyou For Your Shopping</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thankyou</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <br>
      <div class="container">
        {{-- @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }} --}}
        @if(isset($order_tracking_id_stripe))
        <div class="alert alert-success">
          Payment Received, Thanks you for using our services.
        </div>
        
        <p> You can check you order status or details by your order tracking id. </p>
        <p><b>YOUR TRACKING ID : </b> {{$order_tracking_id_stripe}}</p>
        
        <a href="{{route('downloadorderid',$order_tracking_id_stripe)}}" class="btn btn-info">Download Your Order Id</a>
        
    </div>
    
    @else
        <b>Your Payment Method Is On Delivery</b>
        <br>
        <p> You can check you order status or details by your order tracking id. </p>
        <p><b>YOUR TRACKING ID : </b> {{$order_tracking_id}}</p>
        <a href="{{route('downloadorderid',$order_tracking_id)}}" class="btn btn-info">Download Your Order Id</a>
        @endif
        <br>
      </div>

@endsection
