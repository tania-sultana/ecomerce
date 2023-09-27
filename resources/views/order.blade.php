@extends('layouts.app')

@section('content')

 <div class="container">
 	
 	<div class="row justify-content-center">
 		<div class="col-md-8">
 			@foreach($carts as $cart)
			@if($cart['cart'])
 			<div class="card mb-3">
 				<div class="card-body">
					
					@foreach($cart['cart']->items as $item)
					<span class="float-right">
						<img src="{{Storage::url($item['image'])}}" width="100">
					</span>

					<p>Name:{{$item['name']}}</p>
					<p>Price:{{$item['price']}}</p>
					<p>Qty:{{$item['qty']}}</p>

					@endforeach
 					
 				</div>

 			</div>
			 <p>
 				<button type="button" class="btm btn-info" style="color: #fff;">
 					<span class="" style="color: green;">
 						Order Status: {{$cart['status']}}
 					</span>
 				</button>
 			</p>
 			<p>
 				<button type="button" class="btm btn-info" style="color: #fff;">
 					<span class="" style="color: green;">
 						Total price: $ {{$cart['cart']->totalPrice}}
 					</span>
 				</button>
 			</p>
			 
 			<hr>
			@endif
 			@endforeach
 		</div>
 	</div>
 	


 </div>

 @endsection