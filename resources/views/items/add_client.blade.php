<!-- client design form for adding a client -->
@extends('layouts.master')
@section('title')
  Add Client
@endsection


  
@section('content')

<div class="center">
  <h1>Client Details</h1>

  <form method="post" action="{{url("add_item_action")}}">
    {{csrf_field()}}
    <p>
    <label>Name:</label><br>
    <input type="text" name="fullName" id="fullName">
    </p>
    <p>
    <label>Age:</label><br>
    <input type="text" name="age" id="age">
    </p>
    <p>
    <label>DOB:</label><br>
    <input type="text" name="dob" id="dob">
    </p>

    <p>
    <label>License No:</label><br>
    <input type="text" name="licenseNO" id="licenseNO">
    </p>
    <p>
    <label>License Type:</label><br>
    <input type="text" name="licenseType" id="licenseType">
    </p>

  <th>
  <input class='but' type="submit" name="Confirm Booking" value="Confirm Booking"><br>
  <p></p>
  </form>
</div>

@endsection

