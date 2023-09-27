@extends('layouts.app')

@section('content')

    <form class="flex" style="padding:0px 351px;" method="post" action="{{url('/recharge-done')}}">
        @csrf    
        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" class="form-control" name="card_number" id="card_number" aria-describedby="Chard Number">
            <div id="emailHelp" class="form-text">It is one time recharge card. Can be used only one</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  @endsection