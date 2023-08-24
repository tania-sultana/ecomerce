@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
    </div>
    <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <h6 class="ml-4 mt-4 font-weight-bold text-primary">Data Tables</h6>
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
          
                  <div class="d-flex flex-column">
                  <label for="number_of_pages" class="form-label">Number of Pages</label>
                  <input type="number" class="form-control" name="number_of_pages" id="number_of_pages" value="10">
                  </div>
                  
                    <form class="d-flex flex-row"  action="#" method="post">
                    <div class="d-flex flex-column">
                    <label for="filter_data" class="form-label">Search</label>
                    <input type="text" class="form-control" name="filter_data" id="filter_data">
                    </div>
                    <input type="button" class="btn btn-primary mx-2 mt-4" value="Search">
                  </form>
                  
                </div>
                <h6 class="ml-4 font-weight-bold text-primary">Products</h6>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Additional_info</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th></th>
                        <th></th>
                        
                      </tr>
                    </thead>
                    
                    <tbody>
                      @if(count($products)>0)
                      @foreach($products as $product)
                      <tr>
                        <td>
                          <img src="{{Storage::url($product->image)}}" width="100">
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{!!  $product->description !!}</td>
                        <td>{!!$product->additional_info!!}</td>
                        <td>${{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>
                          <a href="{{route('product.edit',[$product->id])}}">
                              <button class="btn btn-primary">Edit</button>
                          </a>
                        </td>
                        <td>
                           <form action="{{route('product.destroy',[$product->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                            
                          </form>
                        </td>

                         
                      </tr>
                      @endforeach
                      @else
                      <td>No any product</td>
                      @endif
                    

                    </tbody>
                  </table>


                  <nav aria-label="..." class="d-flex justify-content-center">
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    </ul>
                  </nav>




                </div>
              </div>
            </div>

 @endsection