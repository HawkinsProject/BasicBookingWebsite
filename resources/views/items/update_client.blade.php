@extends('layouts.master')
  
@section('title')
  Update Client
@endsection

@section('content')

  <form method="post" action="{{url("update_item_action")}}">
    {{csrf_field()}}
    <div class="center">
    <h1>Update Client</h1>
      <input type="hidden" name="id" value="{{$item->id}}">
      <table>
      <tr>
        <th>
          <label>Name:</label><br>
          <input type="text" name="fullName" value="{{$item->fullName}}">
        </th>
        <th>
          <label>License No:<label>
          <input type="text" name="licenseNO" value="{{$item->licenseNO}}">
        </th>
      </tr>
      <tr>
        <th>
          <label>Age:</label><br>
          <input type="text" name="age" value="{{$item->age}}">
        </th>
        <th>
          <label>License Type:<label>
          <input type="text" name="licenseType" value="{{$item->licenseType}}">
        </th>
      </tr>
      <tr>
        <th>
          <label>dob:<label>
          <input type="text" name="dob" value="{{$item->dob}}">
        </th>
      </tr>
      </table>
      <p></p>
    <input class="but" type="submit" value="Update client"><br>
    </div>
  </form>
@endsection