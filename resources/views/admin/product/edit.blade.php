@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
    </div>

    <div class="row justify-content-center">
      @if(Session::has('message'))
        <div class="alert alert-success">
          {{Session::get('message')}}
        </div>

      @endif

      <div class="col-lg-10">
        <form action="{{route('product.update',[$product->id])}}" method="POST" enctype="multipart/form-data">@csrf
          {{method_field('PUT')}}
              <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
                </div>
                <div class="card-body">
                    <div class="form-group"> 
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id="" aria-describedby=""
                        placeholder="Enter name of product" value="{{$product->name}}">
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                    
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" id="" class="form-control @error('description') is-invalid @enderror ">
                        {!!$product->description!!}
                      </textarea>
                       @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                      
                    </div>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror  " id="customFile" name="image">
                        <label class="custom-file-label  " for="customFile">Choose file</label>
                       <center> <img src="{{Storage::url($product->image)}}" width="100"></center>
                            @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                       
                    </div>

                      <div class="form-group"> 
                      <label for="">Price($)</label>
                      <input type="text" name="price" class="form-control @error('price') is-invalid @enderror " id="" aria-describedby="" value="{{$product->price}}" 
                        >
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                    
                    </div>

                    <div class="form-group">
                <label for="">Additional information</label>
                <textarea name="additional_info" id="summernote1" class="
                form-control @error('additional_info') is-invalid @enderror">
                {!!$product->additional_info!!}
              
              </textarea>
                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                    <div class="form-group">
                <div class="custom-file">
                <label id="xyz">Choose Category</label>
                <select name="category" onchange="getResults(event)" class="form-control @error('category') is-invalid @enderror">
                    <option class ="categoryList" value="">select</option>

                    @foreach(App\Models\Category::all() as $category)
                    @if($category->id == $product->category_id)
                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                     <option value="{{$category->id}}">{{$category->name}}</option>
                     @endif
                    @endforeach
                </select>
                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                
            </div><br><br>
            <div class="form-group">
               
                <label id="xyz">Choose Subcategory</label>
                <select name="subcategory" id="subcategory" class="form-control @error('category') is-invalid @enderror">
                @foreach(App\Models\Subcategory::all() as $subcategory)
                    @if($subcategory->id == $product->subcategory_id)
                    <option value="{{$subcategory->id}}" selected>{{$subcategory->name}}</option>
                    @elseif($subcategory->category->id == $product->category_id)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endif
                    @endforeach

                </select>
                
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript">

                function getResults(evt){
                    
                    var cat_id =evt.target.value;
                    console.log(cat_id);
                    var url = "http://127.0.0.1:8000/category/"+cat_id;
                    $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    success: function(res)
                    {
                        // amusing res = {"3":"home","4":"home duplex"}; 
                        var html = "";
                        html += "<option value=\"\">Select</option>";
                        $.each(res, function (key, value) {
                            html += "<option value="+key+">"+value+"</option>";
                        });
                        $("#subcategory").html(html);
                    }
                });
                }



            //     setInterval(function () {
            //         $('.categoryList').on('click', function(){
            //     var cat_id = $(this).attr('value');

            //     var url = "http://127.0.0.1:8000/category/"+cat_id;
            //     console.log(url);
           
            //     });
            // },500);



                
                </script>
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                 
                </div>
              </div>
            </form>

          </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection