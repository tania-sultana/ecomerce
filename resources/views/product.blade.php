@extends('layouts.app')

@section('content')
<div class="container">
    <main role="main">

    <div class="container">

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  @if(count($sliders)>0)
    @foreach($sliders as $key=> $slider)
    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
      <img src="{{Storage::url($slider->image)}}" class="d-block w-100" style="height: 24rem; overflow:hidden;" alt="...">
      
    </div>
    @endforeach
  @endif
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



</div>

  <div class="container">
  <h2>Category</h2>
  @foreach(App\Models\Category::all() as $cat)
      <a href="{{route('product.list',[$cat->slug])}}"> <button class="btn btn-secondary mx-1">{{$cat->name}}</button></a>
  @endforeach

  <div class="album py-5 bg-light">
    <div class="container">
        <h2>Products</h2>

      <div class="row">
      
      @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{Storage::url($product->image)}}" height="200" style="width: 100%">
            <div class="card-body">
                <p><b>{{$product->name}}</b></p>
              <p class="card-text">
                  {{ strip_tags($product->description) }}
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
    <center>
      <a href="{{route('more.product')}}"><button class="btn btn-success">More Product</button>
      </a>
    </center>
  
    
   
    </div>

  <div class="jumbotron">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="row">
                @foreach($randomActiveProducts as $product)
                <div class="col-4">
                            <div class="card mb-4 shadow-sm">
                    <img src="{{Storage::url($product->image)}}" height="200" style="width: 100%">
                    <div class="card-body">
                        <p><b>{{$product->name}}</b></p>
                    <p class="card-text">
                        {{strip_tags(Str::limit($product->description,120))}}

                        {{strip_tags(Str::limit($product->additional_info,120))}}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-success">View</button>
                    <a href="">
                    <a href="{{route('add.cart',[$product->id])}}">  <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                    </a>
                        </div>
                        <small class="text-muted">&#2547; &nbsp; {{$product->price}}</small>
                    </div>
                    </div>
                </div>
                </div>
                @endforeach
                
            </div>
            </div>
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-item">
            <div class="row">
              @foreach($randomItemProducts as $product)

                <div class="col-4">
                  <div class="card mb-4 shadow-sm">
                    <img src="{{Storage::url($product->image)}}" height="200" style="width: 100%">
                    <div class="card-body">
                        <p><b>{{$product->name}}</b></p>
                    <p class="card-text">
                        {{strip_tags(Str::limit($product->description,120))}}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <a href="{{route('product.view',[$product->id])}}">  <button type="button" class="btn btn-sm btn-outline-success">View</button></a>
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
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
        
    </div>
  </div>
</div>




</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="/docs/4.4/getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>
</div>
@endsection