<?php

/*
 * Author: Sean Hellebusch
 * Date: 5.6.14
 * PHP backend to insert a person into the DB
 */

include "../class_files/pdo_connection.php";
include "../class_files/validations.php";
// Decode JSON object, exit if NULL
$person_data = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_data)) {
    exit("null json object passed");
}

$connect = new pdo_connection();
$validate = new validations();

// Unpack json object.
$banner          = $person_data['banner'];
$phone           = $person_data['phone'];
$first_name      = $person_data['first_name'];
$last_name       = $person_data['last_name'];
$date_joined     = $person_data['date_joined'];
$username        = $person_data['username'];

 if($validate->validatePhone($phone) 
    && $validate->validateBanner($banner) 
    && $validate->validateDate($date_joined)) {
     
        // Everything is valid; connect, convert, bind and execute.
        try {    
            $pdo = $connect->connect();
            // Prepare Statement
            $stmt = $pdo->prepare("INSERT INTO `person`(username, banner, phone, date_joined, first_name, last_name) VALUES (:username, :banner, :phone, :date_joined, :first_name, :last_name)");
            
            // Bind values (convert any if necessary)
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':banner', (int)$banner);
            $stmt->bindValue(':phone', $phone);
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