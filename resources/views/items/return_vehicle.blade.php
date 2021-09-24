@extends('layouts.master')
@section('title')
  Add Client
@endsection

@section('content')
  <h1>Return Vehicle</h1>
  <form method="post" action="{{url("delete_booking_action")}}">
    {{csrf_field()}}
    <label>Select booking Id:</booking><br>
    
    <select name="carId" id="carId">
    <option value="" selected>Select an ID</option>
    @foreach($bookings as $booking)
      <option value = "{{$booking->id}}">{{$booking->id}}</option>
    @endforeach
  </select>
   
  <p></p>
  <input class="but" type="submit" value="Return Vehicle"><br>
  </form>
@endsection