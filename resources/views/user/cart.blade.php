@extends('layouts.user')
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Cart</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
      
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <div style="background-color: #d4edda;position:fixed;top: 20px;right: 20px;" class="" id="msg"></div>
      <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
      
        <div class="row">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <!-- CART TABLE-->
            <div class="table-responsive mb-4">
              <table class="table text-nowrap">
                <thead class="bg-light">
                  <tr>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Quantity</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                  </tr>
                </thead>
               
                <tbody class="border-0" id="bodyData">
                 
                 
                </tbody>
              </table>
            </div>
            <!-- CART NAV-->
            <div class="bg-light px-4 py-3">
              <div class="row align-items-center text-center">
                <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="{{route('deleteCart')}}">Clear All Cart</a></div>
                @if(Gloudemans\Shoppingcart\Facades\Cart::content()->count() == null)
                    <b>Your Dont Have Any Item In Cart</b>
                 @else 
                <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="{{route('checkOut')}}">Procceed to checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
                @endif
              </div>
            </div>
          </div>
          <!-- ORDER TOTAL-->
          
        </div>
      </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    fetchcart();
    function fetchcart(){
      
      $.ajax({
        type: "get",
        url: "cartdata",
        dataType: "json",
        success: function(response){
          // console.log(response);
        $.each(response.allcart, function(key, item) {
          $('#bodyData').append('<tr><th class="ps-0 py-3 border-0" scope="row"><div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="#">'+item.name+'</a></strong></div></div></th><td class="p-3 align-middle border-0"><p class="mb-0 small">'+item.price+'</p</td><td class="p-3 align-middle border-0"><div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span><div class="quantity"><a class="dec-btn p-0 qtydecrease" data="'+item.rowId+'" ><i class="fas fa-caret-left"></i></a><input class="form-control form-control-sm border-0 shadow-0 p-0 bg-white" disabled type="number" min="0" value="'+item.qty+'"/><a class="inc-btn p-0 qtyincrease" data="'+item.rowId+'" > <i class="fas fa-caret-right"></i></a></div></div></td><td class="p-3 align-middle border-0"><p class="mb-0 small total_amount">'+item.price * item.qty+'</p></td><td class="p-3 align-middle border-0"><a class="reset-anchor" href="deleteCartItem/'+item.rowId+'"><i class="fas fa-trash-alt small text-muted"></i></a></td></tr>')
        
        });
        }

      });
    }
  

  $(document).on("click", ".qtydecrease", function(){
    
     var dataId = $(this).attr("data");
     var input = $(this).parent().find('input');
     
  var total = $(this).parent().parent().parent().next().find('.total_amount');
  $.ajax({
           method:'get',
             url: "{{route('cartQuantityDecrease')}}",
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
             data: {
              
                 dataId:dataId,
                 
             },
             success: function(data) {
          // console.log(data.status);
          if(data.status == 1){
            
            input.val(data.qty);
            $('#msg').html(data).fadeIn('slow');
            
            total.text(data.total);
            $('#msg').html("  Cart Item Quantity Decrease Successfully ").fadeIn('slow') //also show a success message 
            $('#msg').delay(1000).fadeOut('slow');
    
          }
          else{

          }
        }
         });
});


  $(document).on("click", ".qtyincrease", function(){

  var dataId = $(this).attr("data");
  console.log(dataId);
  var input = $(this).parent().find('input');
  var total = $(this).parent().parent().parent().next().find('.total_amount');
  // console.log(total);
  $.ajax({
           method:'get',
             url: "{{route('cartQuantityIncrease')}}",
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
             data: {
              
                 dataId:dataId,
                 
             },
             success: function(data) {
              if(data.status == 1){
                
                input.val(data.qty);
                $('#msg').html(data).fadeIn('slow');
                total.text(data.total);
                $('#msg').html("  Cart Item Quantity Increase Successfully ").fadeIn('slow') //also show a success message 
            $('#msg').delay(1000).fadeOut('slow');
          }
          else{

          }
          
        }
         }); 
  
    });
  });
  
</script>

@endsection
