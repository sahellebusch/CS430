<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.21.14
 * PHP backend to update a person into the DB
 */

include "../pdo_connection.php";
include "../validations.php";

// Decode JSON object, exit if NULL
$person_data = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_data)) {
    exit("null json object passed");
}

// Unpack json object.
$pid             = (int) $person_data['p_id'];
$banner          = $person_data['banner'];
$phone           = $person_data['phone'];
$unexcused_total = (int) $person_data['unexcused_total'];
$excused_total   = (int) $person_data['excused_total'];  
$first_name      = $person_data['first_name'];
$last_name       = $person_data['last_name'];
$date_joined     = $person_data['date_joined'];
$username        = $person_data['username'];

$validate = new validations();
if($validate->validatePhone($phone) 
   && $validate->validateBanner($banner) 
   && $validate->validateDate($date_joined)) {
    // Everything is valid; connect, convert, bind and execute.
    try{
        
        $connect = new pdo_connection();
        $pdo = $connect->connect();

        // Prepare Statement
        $stmt = $pdo->prepare("UPDATE person SET username = :username, banner = :banner, phone = :phone, date_joined = :date_joined, first_name = :first_name, last_name = :last_name WHERE p_id = :p_id");

        $banner = (int) $banner;
        $phone  = (int) $phone;
        $stmt->bindValue(':banner', $banner);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':p_id', $pid);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->bindValue(':date_joined', $date_joined);
        // Execute SQL
        $stmt->execute();
        // Report Success
        $success = TRUE;
        echo $success;
    } catch(PDOException $e) {

    // Report failure
    $failure = FALSE;
    echo $failure;
    // Report error
    echo 'error: ' . $e->getMessage();   

    }    
} else {
    $failure = false;
    echo $failure;
    die;
}
    
?>