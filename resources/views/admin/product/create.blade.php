@extends('admin.layouts.main')
@section('content')
    <div class="flex">
    <div class="d-sm-flex align-items-center 
    justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-3 text-gray-800">Product</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </div>

    <div class="row justify-content-center mb-4">
        @if(Session::has('message')) 
        <div class="alert alert-success">
            {{Session::get('message')}}</div>
            @endif

        <div class="col-lg-10">
            <form action="{{route('product.store')}}" method="POST"
            enctype="multipart/form-data">@csrf
            <div class="card mb-6">
                <div class="card-header py-3 d-flex d-flex-row
                align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Create Product</h6>
               </div>
               <div class="card-body">
               <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="
                form-control @error('name') is-invalid @enderror" id="" aria-describedby=""
                placeholder="Enter name of product">
                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="summernote" class="
                form-control @error('description') is-invalid @enderror"></textarea>
                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
    
            <div class="form-group">
                <div class="custom-file">
                <label class="custom-file-label" for="customFile" id="xyz">Choose file</label>
                <input type="file"
                name="image"
                class="custom-file-input @error('image') 
                is-invalid @enderror" id="customFile" name="image">
                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div><br><br>

          
               <div class="form-group">
                <label for="">Price</label>
                <input type="number" name="price" class="
                form-control @error('name') is-invalid @enderror" id="" aria-describedby="">
                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>

            <div class="form-group">
                <label for="">Additional information</label>
                <textarea name="additional_info" id="summernote1" class="
                form-control @error('additional_info') is-invalid @enderror"></textarea>
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
                     <option value="{{$category->id}}">{{$category->name}}</option>
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
                    <option value="">select</option>

                </select>
                
            </div>
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

            <button type="submit" class="btn mt-4  btn-primary">
            Submit</button>
            </div>
          </div>
        </form>
       <script>
        function upload_img(){
            var fileName = document.getElementById('customFile').files[0].name; 
            document.getElementById('xyz').innerHTML = fileName;

        }
       
        setInterval(upload_img,1000);
        </script>
            
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>jquery
<script type="text/javascript">
    $("document").ready(function(){

    });
    @endsection