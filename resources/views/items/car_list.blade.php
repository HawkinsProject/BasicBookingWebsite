@extends('layouts.master')

@section('title')
  Cars Available
@endsection

@section('content')
<div class="m">
  <h1>Cars Available</h1>
  <p>
    @if($items) 
      @foreach($items as $item)
        <p><a href="{{url("car_detail/$item->id")}}"><label style="color: black;">{{htmlspecialchars($item->rego)}}</label></a></p>
      @endforeach
    @else
      No item found
    @endif
</div>

  @include('layouts.carListFooter')
@endsection


