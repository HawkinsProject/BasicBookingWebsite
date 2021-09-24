<?php

use Illuminate\Support\Facades\Route;

//display all cars on car_list page
Route::get('/', function () {
    $sql = "select * from car";
    $items = DB::select($sql);
    return view('items.car_list')->with('items', $items);
    
});

//display all clients on client list page
Route::get('client_list', function () {
    $sql = "select * from client";
    $items = DB::select($sql);
    return view('items.client_list')->with('items', $items);
    
});

//grabbing individual car details for selected car
Route::get('car_detail/{id}', function($id){
    $item = get_item($id);
    $list = get_bookings($id);
    return view('items.car_detail')->with('item', $item)->with('list', $list);
    
});

//grabbing individual client details for selected client
Route::get('client_details/{id}', function($id){
    $item = get_client($id);
    return view('items.client_details')->with('item', $item);
    
});
//route link for customer registration on navbar
Route::get('add_client', function(){
    return view("items.add_client");
});

//this route grabs all cars and clients and pushes them to an
//array to send to the make a booking page
Route::get('booking', function(){
    $sql = "select * from car";
    $cars = DB::select($sql);
    $sql = "select * from client";
    $clients = DB::select($sql);
    return view("items.booking")->with("cars", $cars)->with("clients", $clients);
});

//route that deletes a client with the delete_item function
Route::get('delete_item/{id}', function($id){
    $sql = "select * from client";
    $items = DB::select($sql);
    delete_item($id);
    return view("items.client_list")->with('items', $items);
});

//route that updates a clients details
Route::get('update_client/{id}', function($id){
    $item = get_client($id);
    return view("items.update_client")->with('item', $item);
});

//route that sends all bookings made to the return vehicle page
Route::get('return_vehicle', function(){
    $sql = "select * from bookings";
    $bookings = DB::select($sql);
    $sql = "select * from bookings";
    $clients = DB::select($sql);
    return view("items.return_vehicle")->with('bookings', $bookings)->with('clients',$clients);
});

//this function sends the bookings and car entries to the car_count page
Route::get('car_count', function(){
    $sql = "select * from bookings";
    $bookings = DB::select($sql);
    $sql = "select * from car";
    $cars = DB::select($sql);
    return view("items.car_count")->with('bookings', $bookings)->with('cars', $cars);
});

//this function sends the bookings and car entries to the car_time page
Route::get('car_time', function(){
    $sql = "select * from bookings";
    $bookings = DB::select($sql);
    $sql = "select * from car";
    $cars = DB::select($sql);
    return view("items.car_time")->with('bookings', $bookings)->with('cars', $cars);
});

//post function to add a new client and to call the add_client
//function to insert into database with input validation
Route::post('add_item_action', function(){
    
    $fullName = request('fullName');
    $age = request('age');
    if(!is_numeric($age))
    {
        echo "Please enter a numeric value for age";
        exit;
    }
    elseif($age < 17 || $age > 99)
    {
        echo "Age must be between 17 and 99";
        exit;
    }
    $dob = request('dob');
    $licenseNO = request('licenseNO');
    $licenseType = request('licenseType');

    if(empty($fullName) || empty($age) || empty($dob) || empty($licenseNO) || empty($licenseType))
    {
        echo "No fields can be empty.";
        exit;
    }
    $id = add_client($fullName, $age, $dob, $licenseNO, $licenseType);
    if($id){
        return redirect(url("client_list"));
    }
    else{
        die("Error while adding item.");
    }
});

//updates a clients information in the database with input validation
Route::post('update_item_action', function(){
    $id = request('id');
    $fullName = request('fullName');
    $age = request('age');
    if(!is_numeric($age))
    {
        echo "Please enter a numeric value for age";
        exit;
    }
    elseif($age < 17 || $age > 99)
    {
        echo "Age must be between 17 and 99";
        exit;
    }
    $dob = request('dob');
    $licenseNO = request('licenseNO');
    $licenseType = request('licenseType');

    if(empty($fullName) || empty($age) || empty($dob) || empty($licenseNO) || empty($licenseType))
    {
        echo "No fields can be empty.";
        exit;
    }
    update_client($id, $fullName, $age, $dob, $licenseNO, $licenseType);
    if($id){
        return redirect(url("client_details/$id"));
    }
    else{
        die("Error while adding item.");
    }
    
});

//creates a booking for a car and completes the booking validation
//to avoid overlapping booking
Route::post('book_item_action', function(){
    $carId = request('carId');
    $clientId = request('clientId');
    $startDate= request('startDate');
    $endDate= request('endDate');
    $sepValue = explode("-", $startDate);
    $sepValue2 = explode("-", $endDate);
    $inputStartDay = $sepValue[2];
    $inputEndDay = $sepValue2[2];
    if(empty($carId) || empty($clientId) || empty($startDate) || empty($endDate))
    {
        echo "No fields can be empty";
        exit;
    }
    $sql = "select * from bookings";
    $bookings = DB::select($sql);
    
   
    for($x = 0; $x < sizeof($bookings); $x++){
        $check = strval($bookings[$x]->vehicleId);
        if($carId == $check)
        {
            
            $sepStart = explode("-",$bookings[$x]->startDate);
            $sepEnd = explode("-", $bookings[$x]->endDate);
            $startDay = $sepStart[2];
            $endDay = $sepEnd[2];
            
            if($startDay == $inputStartDay || $inputStartDay <= $endDay)
            {
                echo "Choose a different date as this car is unavailable until " . $bookings[$x]->endDate;
                exit;
            }
            elseif($endDay== $inputEndDay || $inputEndDay <= $endDay)
            {
                echo "Choose a different date as this car is unavailable until " . $bookings[$x]->endDate;
                exit;
            }
            else{
                continue;
            }

        }
    }
    $id = add_booking($carId, $clientId, $startDate, $endDate);
    if($id){
        
        return redirect(url("/"));
    }
    else{
        die("Error while adding item.");
    }
    
});

//deletes a booking
Route::post('delete_booking_action', function(){
    $carId = request('carId');
    delete_booking($carId);
    return redirect(url("/"));

});

//database function to insert new client into client database
function add_client($fullName, $age, $dob, $licenseNO, $licenseType){
    $sql = "insert into client(fullName, age, dob, licenseNO, licenseType) values (?, ?, ?, ?, ?)";
    DB::insert($sql, array($fullName, $age, $dob, $licenseNO, $licenseType));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

//function that is called to add a booking into database
function add_booking($carId, $clientId, $startDate, $endDate){
    $sql = "insert into bookings(vehicleId, custId, startDate, endDate) values (?, ?, ?, ?)";
    DB::insert($sql, array($carId, $clientId, $startDate, $endDate));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

//function that grabs all lines from the car database
function get_item($id){
    $sql = "select * from car where id=?";
    $items = DB::select($sql, array($id));
    if(count($items)!= 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $items = $items[0];
    return $items;
}

//function that grabs all lines from the client database
function get_client($id){
    $sql = "select * from client where id=?";
    $items = DB::select($sql, array($id));
    if(count($items)!= 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $items = $items[0];
    return $items;
}

//function that grabs the startDate, endDate, from the bookings database
//and the fullName and licenseNo fields from the client database.
function get_bookings($id){
    $sql = "select bookings.startDate, bookings.endDate, client.fullName, client.licenseNo from bookings, client where vehicleId=? and bookings.custId = client.Id";
    $bookings = DB::select($sql, array($id));
    return $bookings;
}


//function to update a current row of the client database
function update_client($id, $fullName, $age, $dob, $licenseNO, $licenseType){
    $sql = "update client set fullName =?, age=?, dob=?, licenseNO=?, licenseType=? where id=?";
    DB::update($sql, array($fullName, $age, $dob, $licenseNO, $licenseType, $id));
}

//function to delete a client
function delete_item($id){
    $sql = "delete from client where id=?";
    DB::delete($sql, array($id));
}

//function to delete a booking
function delete_booking($id){
    $sql = "delete from bookings where id=?";
    DB::delete($sql, array($id));
}

