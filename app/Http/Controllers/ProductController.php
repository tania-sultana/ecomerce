<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class ProductController extends Controller
{
    public function index(){
       
     }
  
     public function create(){
         return view('admin.product.create');
     }
     public function store(Request $request){
        $this->validate($request,[
           'name'=>'required',
           'description'=>'required|min:3',
           'image'=>'required|mimes:jpeg,png',
           'price'=>'required|numeric',
           'additional_info'=>'required',
           'category'=>'required'
        ]);
     }
     
     public function loadSubCategories(Request $request,$id){
      $subcategory  = Subcategory::where('category_id',$id)->pluck('name','id');
      return response()->json($subcategory);
  }
}
