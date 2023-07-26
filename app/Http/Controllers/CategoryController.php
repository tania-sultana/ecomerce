<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.  
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg'
        ]);
        $image = $request->file('image')->store('public/files');
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name), 
            'description'=>$request->description,
            'image'=>$image
            
        ]);
        
        return redirect('/category')->with('message','Category created successfully');
        
        

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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $image = $category->image;
        if($request->file('image')){
            $image = $request->file('image')->store('public/files');
            Storage::delete($category->image);
        }
        $category->name= $request->name;
        $category->description= $request->description;
        $category->image=$image;
        $category->save();
        return redirect('/category')->with('message','Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $filaname = $category->image;
        $category->delete();
        Storage::delete($filaname);
        return redirect()->back()->with('message','Category deleted successfully');
        
    }
}
