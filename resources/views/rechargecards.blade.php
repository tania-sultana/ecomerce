@extends('layouts.app')

@section('content')

<div class="px-4" style="width: 50%; margin:auto">
    <h1>
        Recharge Chards
    </h1>
    <ul class="list-group">
    @foreach($cards as $card)
    <li style="font-size:25px" class="list-group-item d-flex justify-content-between align-items-center">
        {{$card->card_number}}
        <span class="badge badge-primary badge-pill" style="color:chartreuse; font-size:25px">
        {{$card->amount}}
        </span>
    </li>
    @endforeach
    
    </ul>
</div>

@endsection