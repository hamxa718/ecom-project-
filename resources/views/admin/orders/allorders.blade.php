@extends('layouts.admin')
@section('content')

<h4>All Orders</h4>
   <br>
   
<div class="container">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div style="background-color: #d4edda " class="" id="msg"></div>
    <br>
    <table class="table table-striped"  id="dataTable">
        <thead>
          <tr>
            
            <th scope="col">Order Id</th>
            <th scope="col">Customer Email</th>
            <th scope="col">Customer Phone Num</th>
            
            <th scope="col">Total Price</th>
            <th scope="col">Payment Process</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($allorder as $order)
          <tr>
            <td>{{$order->order_tracking_id}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->number}}</td>
           
            <td>{{$order->product_price_subtotal}}</td>
            <td>{{$order->payment_process}}</td>
            <td><select class="btn btn-mini statuschange" data-id="{{$order->id}}" aria-label="Disabled select example" >
              
              @if($order->status == 'pending')
              
                <option value="{{$order->status}}">{{$order->status}}</option>
                <option value="canceled" >cancel</option>
                <option value="shipped">shipped</option>
                <option value="approved">approved</option>
                @endif
                @if($order->status == 'canceled')
                <option value="{{$order->status}}">{{$order->status}}</option>
                <option value="pending">pending</option>
                <option value="shipped">shipped</option>
                <option value="approved">approved</option>
                @endif
                @if($order->status == 'shipped')
                <option value="{{$order->status}}">{{$order->status}}</option>
                <option value="canceled">cancel</option>
                <option value="pending">pending</option>
                <option value="approved">approved</option>
                @endif
                @if($order->status == 'approved')
                <option value="{{$order->status}}">{{$order->status}}</option>
                
                @endif
            </select></td>
            <td><a href="{{route('viewOrderProduct',$order->id)}}" class="btn btn-primary">View Order Products </a>
          </tr>     
          @endforeach
         
          
        </tbody>
      </table>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(function(){
 $('.statuschange').on('change', function(){
     var value = $(this).val();
     var dataId = $(this).attr("data-id");
    //  console.log(dataId);
     $.ajax({
           method:'get',
             url: "{{url('/statuschange')}}",
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
             data: {
                 value: value,
                 dataId:dataId,
                 
             },
             success: function(data) {
          // console.log(data.status);
          if(data.status == 1){
            $('#msg').html(data).fadeIn('slow');
     $('#msg').html("  Status Updated Successfully  ").fadeIn('slow') //also show a success message 
     $('#msg').delay(1000).fadeOut('slow');
     location.reload();
          }
          else{

          }
        }
         });
        
    });
});

</script>
@endsection

