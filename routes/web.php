<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RechargeCardController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get("/",[FrontProductListController::class,'index']);


// Route::get('/subcategories/{id}',[ProductController::class,'loadSubCategories']);




// Route::get('/index/test',function () {
//     return view('test');
    
// });

// Auth::routes(); 

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::middleware(['auth','isAdmin'])->group(function(){
//     Route::get('/dashboard',function () {
//         return view('admin.dashboard');
//     });
//     Route::resource('/category', CategoryController::class)->names("category");
//     Route::resource('/subcategory', SubcategoryController::class)->names("subcategory");
//     Route::resource('/product', ProductController::class)->names("product");
// });

/*
Route::group(['prefix'=>'auth','middleware'=>['auth',  'IsAdmin']],function(){
    Route::get('/dashboard',function () {
        return view('admin.dashboard');
    });
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::resource('product', ProductController::class);
});
*/





Route::get('/',[FrontProductListController::class,'index']);
Route::get('/products/{id}',[FrontProductListController::class,'show'])->name('product.view');

Route::get('order',[CartController::class,'order'])->name('order')->middleware('auth');

Route::get('/checkout/{amount}',[CartController::class,'checkout'])->name('cart.checkout')->middleware('auth');

Route::post('/charge',[CartController::class,'charge'])->name('cart.charge');

Route::get('/categories/{name}',[FrontProductListController::class,'allProduct'])->name('product.list');

Route::get('/addToCart/{product}',[CartController::class,'addToCart'])->name('add.cart');

Route::get('/cart',[CartController::class,'showCart'])->name('cart.show');
Route::post('/products/update/{product}',[CartController::class,'updateCart'])->name('cart.update');
Route::post('/products/remove/{product}',[CartController::class,'removeCart'])->name('cart.remove');


Auth::routes();


Route::get('/all/products',[FrontProductListController::class,'moreProducts'])->name('more.product');
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/subcatories/{id}',[ProductController::class,'loadSubCategories']);
Route::get('/recharge-cards',[RechargeCardController::class,'index'])->middleware('auth')->name('recharge-cards');
Route::get('/recharge',[RechargeCardController::class,'recharge'])->middleware('auth')->name('recharge');
Route::post('/recharge-done',[RechargeCardController::class,'recharge_done'])->middleware('auth')->name('recharge-done');

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('/category', CategoryController::class)->names("category");
    Route::resource('/subcategory', SubcategoryController::class)->names("subcategory");
    Route::resource('/product', ProductController::class)->names("product");

    Route::get('/slider/create',[SliderController::class,'create'])->name('slider.create');
	Route::get('/slider',[SliderController::class,'index'])->name('slider.index');
	Route::post('/slider',[SliderController::class,'store'])->name('slider.store');
	Route::delete('/slider/{id}',[SliderController::class,'destroy'])->name('slider.destroy');

	Route::get('/users',[UserController::class,'index'])->name('user.index');
    Route::get('/money-card/create',[RechargeCardController::class,'create'])->name('money.create');
	Route::post('/money-card/store',[RechargeCardController::class,'store'])->name('money.store');
    //orders
	Route::get('/orders',[CartController::class,'userOrder'])->name('order.index');
	Route::get('/orders/{userid}/{orderid}',[CartController::class,'viewUserOrder'])->name('user.order');
    Route::get('confirm/{order_id}',[CartController::class,'confirmOrder'])->name('user.confirm');
});