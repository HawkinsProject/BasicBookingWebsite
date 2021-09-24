@extends('layouts.master')

@section('title')
  Clients
@endsection


@section('content') 
<div class="m">
  <h1>Client List</h1>
  <p></p>
    @if($items) 
      @foreach($items as $item)
        <a href="{{url("/client_details/$item->id")}}"><label style="color: black;">{{$item->fullName}}</label></a><br>
        <p></p>
      @endforeach
    @else
      No item found
    @endif
</div>
@endsection