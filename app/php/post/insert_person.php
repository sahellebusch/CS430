<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.21.14
 * PHP backend to insert a person into the DB
 */

// Decode JSON object, exit if NULL
$person_data = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_data)) {
    exit("null json object passed");
}

// Unpack json object.
$banner          = $person_data['banner'];
$phone           = $person_data['phone'];
$first_name      = $person_data['first_name'];
$last_name       = $person_data['last_name'];
$date_joined     = $person_data['date_joined'];
$username        = $person_data['username'];

 if(validatePhone($phone) && validateBanner($banner) && validateDate($date_joined)) {
        // Everything is valid; connect, convert, bind and execute.
        try {

            // Database login
            $dbuser = 'jpf7324';
            $dbpass = 'oxaetoht';
            // Connect to DB
            $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare Statement
            $stmt = $db->prepare("INSERT INTO `person`(username, banner, phone, date_joined, first_name, last_name) 
                 VALUES (:username, :banner, :phone, :date_joined, :first_name, :last_name)");
            
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