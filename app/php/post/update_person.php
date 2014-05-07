<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.21.14
 * PHP backend to update a person into the DB
 */

include "../db_connection.php";

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

    if(validatePhone($phone) && validateBanner($banner) && validateDate($date_joined)) {
        // Everything is valid; connect, convert, bind and execute.
        try{
            $connect = new db_connection();
            $db = $connect->connect();
            
            // Prepare Statement
            $stmt = $db->prepare("UPDATE person SET username = :username, banner = :banner, phone = :phone, date_joined = :date_joined,                                                   first_name = :first_name, last_name = :last_name WHERE p_id = :p_id");

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
    
// Function to validate date_joined.
function validateDate($date_joined) {
    if((preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date_joined))) {
        list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
        return (checkdate( $m, $d, $y ) and $y <= date('Y'));
    } else {
        // wrong format, convert to correct format
        $date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
        list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
        return (checkdate( $m, $d, $y ) and $y <= date('Y'));
        }
}

// Validates banner is no longer than 10 ints long.
function validateBanner($banner) {
    return(strlen($banner) <= 10);
}

// Validates phone number.
function validatePhone($phone) {
    //eliminate every char except 0-9
    $justNums = preg_replace("/[^0-9]/", '', $phone);
    return((strlen($justNums) <= 10));
}

?>