@extends('layouts.user')
@section('content')
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Checkout</h1>
        </div>
        <div class="col-lg-6 text-lg-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
              <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
              
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
    <!-- BILLING ADDRESS-->
    <h2 class="h5 text-uppercase mb-4">Billing details</h2>
    <div class="row">
      <div class="col-lg-8">
        <form action="{{route('placeorder')}}" method="post">
          @csrf
          <div class="row gy-3">
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="firstName">First name </label>
              <input class="form-control form-control-lg" type="text" name="firstName" value="{{$getUser->name ??''}}" id="firstName" placeholder="Enter your first name">
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="lastName">Last name </label>
              <input class="form-control form-control-lg" type="text" name="lastName" id="lastName" placeholder="Enter your last name">
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="email">Email address </label>
              <input class="form-control form-control-lg" type="email" name="email" value="{{$getUser->email ?? ''}}" id="email" placeholder="e.g. Jason@example.com">
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="phone">Phone number </label>
              <input class="form-control form-control-lg" type="number"  id="phone" name="phone" placeholder="e.g 245354745">
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="company">Company name (optional) </label>
              <input class="form-control form-control-lg" type="text" name="company" id="company" placeholder="Your company name">
            </div>
            <div class="col-lg-6 form-group">
              <label class="form-label text-sm text-uppercase" for="country">Country</label>
              <input class="form-control form-control-lg" type="text" name="Country" id="Country" placeholder="Your Country name">
              </select>
            </div>
            <div class="col-lg-12">
              <label class="form-label text-sm text-uppercase" for="address">Address line 1 </label>
              <input class="form-control form-control-lg" type="text" name="address_first" id="address" placeholder="House number and street name">
            </div>
            <div class="col-lg-12">
              <label class="form-label text-sm text-uppercase" for="addressalt">Address line 2 </label>
              <input class="form-control form-control-lg" type="text" name="address_second" id="addressalt" placeholder="Apartment, Suite, Unit, etc (optional)">
            </div>
            <div class="col-lg-6">
              <label class="form-label text-sm text-uppercase" for="city">Town/City </label>
              <input class="form-control form-control-lg" type="text" name="city" id="city">
            </div>
            
            <div class="col-lg-6">
             
            </div>
            
            <div class="col-lg-6">
              
            <input class="form-control form-control-lg" type="hidden" name="product_subtotal" id="state2" value="{{$totalcart}}">
              <button class="btn btn-link text-dark p-0 shadow-0" type="button" data-bs-toggle="collapse" data-bs-target="#alternateAddress">
                <div class="form-check">
                  
                  <input class="form-check-input first" id="alternateAddressCheckbox" type="radio" name="payment_process" value="cash">
                  <label class="form-check-label second" for="alternateAddressCheckbox">Payment On Delivery</label>
                  <br>
                  <input class="form-check-input" id="alternateAddressCheckbox" type="radio" name="payment_process" value="stripe">
                  <label class="form-check-label" for="alternateAddressCheckbox">Payment With Stripe</label>
                </div>
              </button>
            </div>
            
            <div class="col-lg-12 form-group">
              <button class="btn btn-dark" type="submit">Place order</button>
            </div>
          </div>
        </form>
      </div>
      <!-- ORDER SUMMARY-->
      <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4">Your order</h5>
            <ul class="list-unstyled mb-0">
              @foreach($allcart as $cart)
              <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">{{$cart->name}}</strong><span class="text-muted small">${{$cart->total}}</span></li>
               
              @endforeach 
              <li class="border-bottom my-2"></li>
                   
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span>{{$totalcart}}</span></li>
                     </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


@endsection
