<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Slider;
use App\Models\Review;
class FrontProductListController extends Controller
{
    public function index(){
		$products =  Product::latest()->limit(9)->get();
    	$randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
    	$randomActiveProductIds=[];
    	foreach($randomActiveProducts as $product){
    		array_push($randomActiveProductIds,$product->id);
    	}
    	$randomItemProducts = Product::whereNotIn('id',$randomActiveProductIds)->limit(3)->get();
        $sliders = Slider::get();

      
    	return view('product',compact('products','randomItemProducts','randomActiveProducts','sliders'));
    }

    public function show($id){
        $product = Product::find($id);
        $ratings = Review::where('product_id','=',$id)->get();;

        $ave_rating = 0;
        $cou = 0;
        foreach($ratings as $rating){
            $ave_rating+=$rating->rating;
            $cou+=1;
        }
        if($cou && $ave_rating){
            $ave_rating = $ave_rating/$cou;
        }
        // dd($ave_rating);

        $productFromSameCategories = Product::inRandomOrder()
            ->where('category_id',$product->category_id)
            ->where('id','!=',$product->id)
            ->limit(3)
            ->get();

        return view('show',compact('product','productFromSameCategories','ave_rating'));
    }

    public function allProduct($name,Request $request){
      
        $category  = Category::where('slug',$name)->first();
        $categoryId = $category->id;
        $filterSubCategories = [];
        if($request->subcategory){
            $products = $this->filterProducts($request);
            $filterSubCategories = $this->getSubcategoriesId($request);
        }elseif($request->min||$request->max){
            $products = $this->filterByPrice($request);

        }else{
            $products = Product::where('category_id',$category->id)->get();
        }
            $subcategories = Subcategory::where('category_id',$category->id)->get();
            $slug = $name;

        return view('category',compact('products','subcategories','slug','categoryId'));
    }

    public function filterProducts(Request $request){
        $subId =[];
        $subcategory = Subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        $products = Product::whereIn('subcategory_id',$subId)->get();
        return $products;

    }
    public function getSubcategoriesId(Request $request){
        $subId =[];
        $subcategory = Subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
    
        return $subId;

    }

    public function filterByPrice(Request $request){
        $categoryId = $request->categoryId;
        $product = Product::whereBetween('price',[$request->min,$request->max ])->where('category_id',$categoryId)->get();
        return $product;
    }

    public function moreProducts(Request $request){
        if($request->search){
            $products = Product::where('name','like','%'.$request->search.'%')
            ->orWhere('description','like','%'.$request->search.'%')
            ->orWhere('additional_info','like','%'.$request->search.'%')

            ->paginate(50);
            return view('all-product',compact('products'));
        }

        $products  =Product::latest()->paginate(50);
        return view('all-product',compact('products'));
       
    }





  
}
