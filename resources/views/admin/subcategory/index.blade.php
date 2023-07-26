@extends('admin.layouts.main')
@section('content')

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SubCategory Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">SubCategory Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category Tables</h6>
                  @if(Session::has('message')) 
                  <div class="alert alert-success" id="temp">
                      {{Session::get('message')}}</div>
                  @endif
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($subcategories)>0)
                    @foreach($subcategories as $key => $subcategory)
                      <tr>
                        <td><a href="#">{{$key+1}}</a></td>
                        <td>{{$subcategory->name}}</td>
                        <td>{{$subcategory->category->name}}</td>
                        <td><a href="{{route('subcategory.edit',[$subcategory->id])}}"><button class="btn btn-primary">Edit</button></a></td>
                        <td>
                          <form action="{{route('subcategory.destroy',
                            [$subcategory->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn 
                            btn-danger">Delete</button>

                          </form>
                        </td>
                       
                      </tr>  
                      @endforeach
                      @else
                      <td>No subcategory created yet</td>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <script>
            setTimeout(()=>{
              document.getElementById('temp').remove()

            },2000);
          </script>
@endsection