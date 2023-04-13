@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Payment With Stripe</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment With Stripe</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <br>
      <div class="container">
      
        @php
        $stripe_key = 'pk_test_51L6BbmHh7DA7fp0Jmuouwc2S6BYw0nxzU7DQ1ReEbtzSxgZ9noLLm2tQKpvTSHVsbkem8FzrNuFG54WThtLTwB8X00Es15AMHg';
        @endphp
        <div class="container" style="margin-top:10%;margin-bottom:10%">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="">
                        <p>Stripe Payment</p>
                    </div>
                    <div class="card">
                        <form action="{{route('stripeAfterCheckout')}}"  method="post" id="payment-form">
                            @csrf                    
                            <div class="form-group">
                                <div class="card-header">
                                    <label for="card-element">
                                        Enter your credit card information
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    <input type="hidden" name="plan" value="" />
                                    <input type="hidden" name="order_tracking_id" value="{{$order_tracking_id}}" />
                                </div>
                            </div>
                            <div class="card-footer">
                              <button
                              id="card-button"
                              name="pay"
                              value="1"
                              class="btn btn-dark"
                              type="submit"
                              data-secret="{{$intent}}"
                              > Pay </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <script src="https://js.stripe.com/v3/"></script>
  <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        
        const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        
        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
        
        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        
        // Handle form submission.
        var form = document.getElementById('payment-form');
        
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    form.submit();
                }
            });
        });
    </script>
@endsection

