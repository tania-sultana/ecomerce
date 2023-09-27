@extends('admin.layouts.main')

@section('content')

    <form class="flex" style="padding:0px 351px;" method="post" action="{{url('/money-card/store')}}">
        @csrf    
        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" disabled value="{{$card_number}}" class="form-control" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">It is one time recharge card. Can be used only one</div>
        </div>
        <input type="text" hidden value="{{$card_number}}" class="form-control" name="card_number" id="card_number" aria-describedby="emailHelp">
        <div class="mb-3">
            <label for="amount" class="form-label">Card Amount</label>
            <input type="number" class="form-control" id="amount" name="amount">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  @endsection