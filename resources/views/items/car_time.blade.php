@extends('layouts.master')

@section('title')
  Car Popularity
@endsection

@section('content') 
<div class="center">
<h1>Car Booking Time</h1>
<h6>Rated by total amount of current booking days</h6>
<?php
  $total = null;
  $carTotal = [];
  for($y = 0; $y < sizeof($cars); $y++)
  {
    
    $total = 0;
    for ($x = 0; $x < sizeof($bookings); $x++) 
    {
      
      if($bookings[$x]->vehicleId== $cars[$y]->id)
      {
        $separate= explode("-", $bookings[$x]->startDate);
        $pickUp = intval($separate[2]);
        $separate2= explode("-", $bookings[$x]->endDate);
        $dropOff = intval($separate2[2]);
        $total += $dropOff - $pickUp;
      }
    }
    
    $entry = strval($total);
    $final = $entry . " " . $cars[$y]->model;
    array_push($carTotal, $final);
  }
  rsort($carTotal);
  foreach($carTotal as $value)
  {
    echo $value . "<br>";
  }
?>
</div>
  
@endsection