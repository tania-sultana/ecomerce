<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Mail\Sendmail;
class CartController extends Controller
{
    public function addToCart(Product $product){
    	if(session()->has('cart')){
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = new Cart();
    	}
    	$cart->add($product);


    	session()->put('cart',$cart);
    	notify()->success('Product added to cart!');
        return redirect()->back();

    }

    public function showCart(){
    	if(session()->has('cart')){
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = null;
    	}
    	return view('cart',compact('cart'));
    }

    public function updateCart(Request $request, Product $product){
    	$request->validate([
    		'qty'=>'required|numeric|min:1'
    	]);

    	$cart  = new Cart(session()->get('cart'));
    	$cart->updateQty($product->id,$request->qty);
    	session()->put('cart',$cart);
    	notify()->success(' Cart updated!');
        return redirect()->back();

    }

    public function removeCart(Product $product){
    	$cart = new Cart(session()->get('cart'));
    	$cart->remove($product->id);
    	if($cart->totalQty<=0){
    		session()->forget('cart');
    	}else{
    		session()->put('cart',$cart);
    		

    	}
    	notify()->success(' Cart updated!');
            return redirect()->back();
    }

    public function checkout($amount){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }  
        return view('checkout',compact('amount','cart'));
    }

    public function charge(Request $request){

        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        } 
      //  \Mail::to(auth()->user()->email)->send(new Sendmail($cart));
        $user_balance =auth()->user()->account_balance;

        if($user_balance >= $request->amount){
            auth()->user()->orders()->create([

                'cart'=>serialize(session()->get('cart'))
            ]);

            session()->forget('cart');
            notify()->success('Transaction completed!');
            User::where('id', auth()->user()->id)->update(array('account_balance' => $user_balance - $request->amount));
            
            
            return redirect()->to('/');

        }else{
            return redirect()->back();
        }

    }
    //for loggedin user
    public function order(){
        $orders = auth()->user()->orders;
        
        $carts =$orders->transform(function($cart,$key){
            return array(
                "id" => $key,
                "cart" => unserialize($cart->cart),
                "status" => $cart->status
            );
        });
        // dd($carts);
        return view('order',compact('carts'));

    }

    //for admin
    public function userOrder(){
        $orders = Order::latest()->get();
        return view('admin.order.index',compact('orders'));
    }
    public function viewUserOrder($userid,$orderid){
        $user = User::find($userid);
        $orders = $user->orders->where('id',$orderid);
        $carts =$orders->transform(function($cart,$key){
            return array(
                "orderid" => $cart->id,
                "cart" => unserialize($cart->cart),
                "status" => $cart->status
            );
        });
        // dd($carts);
        return view('admin.order.show',compact('carts'));
    }

    public function confirmOrder($order_id){
        // dd("hellow");
        Order::where('id', $order_id)->update(array('status' => "Delivered"));

        return redirect('/orders');
    }
}
