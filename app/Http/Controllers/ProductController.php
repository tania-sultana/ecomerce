<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
      
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required|min:3',
            'image'=>'required|mimes:jpeg,png',
            'price'=>'required|numeric',
            'additional_info'=>'required',
            'category'=>'required',
            'subcategory'=>'required'
         ]);
         $image = $request->file('image')->store('public/files');
         Product::create([
            'name'=> $request->name,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'additional_info'=>$request->additional_info,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory
         ]);
         return redirect('/product')->with('message','Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $filename = $product->image;
        if($request->file('image')){
            $image = $request->file('image')->store('public/files');
            Storage::delete($filename);
            $filename = $image;
        }
        $product->name= $request->name;
        $product->description= $request->description;
        $product->image=$filename;
        $product->price=$request->price;
        $product->additional_info = $request->additional_info;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        
        $product->save();
        
        return redirect('/product')->with('message','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $product = Product::find($id);
            $filename = $product->image;
            $product->delete();
            Storage::delete($filename);
            return redirect()->back()->with('message','Product deleted successfully');
            
        }
    }
    }


