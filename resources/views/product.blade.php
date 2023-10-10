@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
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
                <small class="text-muted">4.5
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                </small>
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
                        <small class="text-muted">4.5
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                      </small>
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
                        <small class="text-muted">${{$product->price}} aaa</small>
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

<footer class="bg-dark text-center text-white">

            <div class="container-fluid p-4 pb-0">
            
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-facebook-f"></i
                ></a>
        
                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-twitter"></i
                ></a>
        
                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-google"></i
                ></a>
        
                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-instagram"></i
                ></a>
        
                <!-- Linkedin -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-linkedin-in"></i
                ></a>
        
                <!-- Github -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-github"></i
                ></a>
            </section>
            <!-- Section: Social media -->
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-white text-decoration-none" href="#">Tania Sultana</a>

            <p class="float-right">
              <a href="#">Back to top</a>
            </p>
            </div>
        </footer>
</div>
@endsection