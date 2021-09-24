@extends('layouts.master')

@section('title')
  Clients
@endsection

@section('content') 

<form method="post" action="{{url("book_item_action")}}">
  {{csrf_field()}}
  <div class="center">
    <h1>Make a Booking</h1>
    <label>Select a Car:</label><br>
    <select name="carId">
      @foreach($cars as $car)
        <option value = "{{$car->id}}">{{$car->model}} {{$car->rego}}</option>
      @endforeach
    </select>
    <p></p>
    <label>Select a Client:</label><br>
    <select name="clientId">
      @foreach($clients as $client)
        <option value = "{{$client->id}}">{{$client->fullName}}</option>
      @endforeach
    </select>
    <p></p>
    <label>Pick Up Date: </label><br>
    <input type="date" name="startDate" id="startDate" min="" onfocus="this.min=new Date().toISOString().split('T')[0]"> 
    <p></p>
    <label>Drop Off Date: </label><br>
    <input class="min_T" type="date" name="endDate" id="endDate" min="" onfocus="this.min=new Date(new Date().getTime()+(1*24*60*60*1000)).toISOString().split('T')[0]">
    <p></p>
  <input class="but" type="submit" value="Book Car">
</div>

</form>
@endsection
<script>
  $(function () {
    $('#startDate').datetimepicker();
 });
</script>
<script>
  $(function () {
    $('#endDate').datetimepicker();

 });
</script>