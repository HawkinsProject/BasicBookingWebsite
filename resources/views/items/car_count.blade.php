@extends('layouts.master')

@section('title')
  Car Popularity
@endsection

@section('content') 
<div class="center">
<h1>Car Popularity Rating</h1>
<h6>Rated by current booking frequency</h6>
  <?php
    
    $count = null;
    $carCount = [];
    for($y = 0; $y < sizeof($cars); $y++)
    {
        $count = 0;
        for ($x = 0; $x < sizeof($bookings); $x++) {
            if($bookings[$x]->vehicleId== $cars[$y]->id)
            {
                $count+=1;
            }
        }
        $convert = strval($count);
        $entry = $convert . "    " . $cars[$y]->model;
        array_push($carCount, $entry);
        //$carCount =[$count => $cars[$y]->model];
    }
    rsort($carCount);
    foreach($carCount as $value)
    {
      echo $value . "<br>";
    }
  ?>
  </div>
  
  
@endsection