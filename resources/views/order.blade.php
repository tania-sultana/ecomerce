@extends('layouts.app')

@section('content')

@push('styles')
<style>
div.stars {
    display: inline-block;
  }
  
  input.star { display: none; }
  
  label.star {
    float: right;
    padding: 10px;
    font-size: 20px;
    color: 
  #444;
    transition: all .2s;
  }
  
  input.star:checked ~ label.star:before {
    content: '★';
    color: 
  #e74c3c;
    transition: all .25s;
  }
  
  input.star-5:checked ~ label.star:before {
    color: 
  #e74c3c;
    text-shadow: 0 0 5px 
  #7f8c8d;
  }
  
  input.star-1:checked ~ label.star:before { color: 
  #F62; }
  
  label.star:hover { transform: rotate(-15deg) scale(1.3); }
  
  label.star:before {
    content: '☆';
    font-family: FontAwesome;
  }
  
  
  .horline > li:not(:last-child):after {
      content: " |";
  }
  .horline > li {
    font-weight: bold;
    color: 
  #ff7e1a;
  
  }
	</style>

@endpush
<script>
let curr_id = null;
function setval(val){
	curr_id=val;
}

</script>

 	<div class="row justify-content-center">
 		<div class="col-md-8">
 			@foreach($carts as $cart)
			@if($cart['cart'])
 			<div class="card mb-3">
 				<div class="card-body">
					
					@foreach($cart['cart']->items as $item)
					

					<div class="container d-flex justify-content-between align-center">
					<span class="float-right">
						<img src="{{Storage::url($item['image'])}}" width="100">
					</span>
								<!-- Button trigger modal -->
							<button onclick="setval({{$item['id']}})" type="button" class="btn btn-primary" style="height: 3rem;" data-bs-toggle="modal" data-bs-target="#reviewModal">
							review
							</button>

							<!-- Modal -->
							
						</div>





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
 	
	 <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="reviewModalLabel">Modal title</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				
			<form action="{{url('review')}}" method="POST" id="rating" name="rating">
				@csrf
				
				<div class="form-group">
					<div class="col-sm-12">
						<input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
						<label class="star star-5" for="star-5"></label>
						<input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
						<label class="star star-4" for="star-4"></label>
						<input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
						<label class="star star-3" for="star-3"></label>
						<input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
						<label class="star star-2" for="star-2"></label>
						<input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
						<label class="star star-1" for="star-1"></label>
					</div>
				</div>
				<div class="mt-3">
					<textarea placeholder="Write your review" value="I am here bro" class="form-control" id="review" name="review" rows="3"></textarea>
				</div>
				<input hidden type="number" name="product_id" id="product_id">
				
			</form>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button onclick="submit()" type="button" class="btn btn-primary">Post</button>
		</div>
	</div>
</div>
</div>


<script> 
	function submit() {
		document.getElementById('product_id').value = curr_id;
		let form = document.getElementById("rating");
		form.submit();
	} 
</script>


 </div>

 @endsection