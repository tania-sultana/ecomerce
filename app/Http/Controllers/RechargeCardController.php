<?php

namespace App\Http\Controllers;

use App\Models\RechargeCard;
use App\Models\User;
use Illuminate\Http\Request;

function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

class RechargeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = RechargeCard::all();
        return view('rechargecards',compact('cards'));
    }

    public function recharge_done(Request $request)
    {
        $card = RechargeCard::where("card_number",$request->card_number)->firstOrFail();
        $user_balance =auth()->user()->account_balance;
        User::where('id', auth()->user()->id)->update(array('account_balance' => $user_balance + $card->amount));
        $card->delete();
        return redirect("/");
    }
    public function recharge(Request $request)
    {
        return view('recharge');
    }

    /**
     * Show the form for creating a new resource.
     */
    

    public function create()
    {
        $card_number = generateRandomString();
        
        return view('admin.card_generate',compact('card_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'card_number'=>'required',
            'amount'=>'required',
        ]);
        
        RechargeCard::create([
            'card_number'=> $request->card_number,
            'amount'=>$request->amount,
        ]);
        
        return redirect('/money-card/create')->with('message','Card created successfully');
    }    
}


