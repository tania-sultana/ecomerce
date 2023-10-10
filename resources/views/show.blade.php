@extends('layouts.app')

@section('content')


<div class="container">
<div class="card">
    <div class="row">
        <aside class="col-sm-5 border-right">
            <section class="gallery-wrap"> 
            <div class="img-big-wrap">
              <div> <a href="#">
                <img src="{{Storage::url($product->image)}}"  width="450" ></a>
              </div>
            </div> 
            
            </section> 
        </aside>



        <aside class="col-sm-7">
            <section class="card-body p-5">
                <h3 class="title mb-3">{{$product->name}}</h3>

<p class="price-detail-wrap"> 
    <span class="price h3 text-danger"> 
        <span class="currency">US $</span>{{$product->price}}
    </span> 
     
</p> <!-- price-detail-wrap .// -->
  <h3>Description</h3>
  <p>{!!$product->description!!} </p>
  <h3>Additional information</h3>
  <p>{!!$product->additional_info!!} </p>

  

  
  

      @for ($i = 0; $i < 5; $i++)
      @if (floor($ave_rating) - $i >= 1)
      <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
      @elseif ($ave_rating - $i > 0)
      <svg class="align-center" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 0c-12.2 .1-23.3 7-28.6 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3L288 439.8V0zM429.9 512c1.1 .1 2.1 .1 3.2 0h-3.2z"/></svg>
      @else
      <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
      @endif
    @endfor

    <hr>
    
    <a href="{{route('add.cart',[$product->id])}}" class="btn btn-lg btn-outline-primary text-uppercase">  Add to cart </a>

  

</section> 
        </aside> 

    </div> 
</div> 
@if(count($productFromSameCategories)>0)
<div class="jumbotron">
    <h3>You may like </h3>

      <div class="row">
      
      @foreach($productFromSameCategories as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{Storage::url($product->image)}}" height="200" style="width: 100%">

        

            <div class="card-body">
                <p><b>{{$product->name}}</b></p>
              <p class="card-text">
                  {{strip_tags(Str::limit($product->description,120))}}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                 <a href="{{route('product.view',[$product->id])}}"> <button type="button" class="btn btn-sm btn-outline-success">View</button>
                 </a>
                 <a href="{{route('add.cart',[$product->id])}}"> <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                </div>
                <small class="text-muted">${{$product->price}}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

</div>

@endif

</div>


@endsection




