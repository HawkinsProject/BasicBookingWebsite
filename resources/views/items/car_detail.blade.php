@extends('layouts.master')

@section('title')
  Details
@endsection

@section('content') 
<div class="center"> 
  <h1> Car Details</h1>
  <h3><label>{{htmlspecialchars($item->model)}}</label></h3>
  <table>
    <tr>
      <th>
        <label>Colour:</label>
      </th>
      <td>
      <label>{{htmlspecialchars($item->colour)}} </label>
      </td>
    </tr>
    <tr>
      <th>
        <label>Year:</label>
      </th>
      <td>
      <label>{{htmlspecialchars($item->year)}}</label>
      </td>
    </tr>
    <tr>
      <th>
        <label>Rego:</label>
      </th>
      <td>
      <label>{{htmlspecialchars($item->rego)}}</label>
      </td>
    </tr>
    <tr>
      <th>
        <label>Odometer:</label>
      </th>
      <td>
      <label>{{htmlspecialchars($item->odometer)}}</label>
      </td>
    </tr>
</table>
  <p></p>
  <p></p>
  <h1>Current Bookings</h1>
  @if($list)
    @foreach($list as $value)
    <h3><label>{{htmlspecialchars($value->fullName)}}</label></h3>
    <table>
      <tr>
        <th>
          <label>License No:</label>
        </th>
        <td>
        <label>{{htmlspecialchars($value->licenseNO)}}</label>
        </td>
      </tr>
      <tr>
        <th>
          <label>Booking Start Date:</label>
        </th>
        <td>
        <label>{{htmlspecialchars($value->startDate)}}</label>
        </td>
      </tr>
      <tr>
        <th>
          <label>Booking End Date:</label>
        </th>
        <td>
        <label>{{htmlspecialchars($value->endDate)}}</label>
        </td>
      </tr>
    </table>
    @endforeach
  @else
    No bookings for this vehicle.
  @endif
</div>
@endsection