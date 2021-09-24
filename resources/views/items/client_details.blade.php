@extends('layouts.master')

@section('title')
  Item List
@endsection


@section('content')  
<div class="center">
<h1> Client Details</h1>
<h3><label>{{$item->fullName}}</label></h3>
  <table>
    <tr>
      <th>
        <label>Age:</label>
      </th>
      <td>
      <label>{{$item->age}}</label>
      </td>
    </tr>
    <tr>
      <th>
        <label>DOB:</label>
      </th>
      <td>
      <label>{{$item->dob}}</label>
      </td>
    </tr>
    <tr>
      <th>
        <label>License NO:</label>
      </th>
      <td>
      <label>{{$item->licenseNO}}</label>
      </td>
    </tr>
    <tr>
      <th>
        <label>License Type:</label>
      </th>
      <td>
      <label>{{$item->licenseType}}</label>
      </td>
    </tr>
</table>
<p></p>
<a href="{{url("/delete_item/$item->id")}}"><label style="color: black;">Delete Client</label></a><br>
<a href="{{url("/update_client/$item->id")}}"><label style="color: black;">Update Client</label></a>
</div>

@endsection







