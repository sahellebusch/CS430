<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.15.14
 * PHP backend to update a person into the DB
 */

try {
    // Decode JSON object
    $person_data = json_decode(file_get_contents("php://input"), TRUE);
    
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    // Connect to DB
    $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare Statement
    $stmt = $db->prepare("UPDATE person SET username = :username, banner = :banner, phone = :phone, date_joined = :date_joined,                                 first_name = :first_name, last_name = :last_name WHERE p_id = :p_id");
    
    // Decode and convert necessary vars to correct type
    $person_data = json_decode(file_get_contents("php://input"), TRUE);
    $pid = (int) $person_data['p_id'];
    $banner = (int) $person_data['banner'];
    $phone = (int) $person_data['phone'];
    $unexcused_total = (int) $person_data['unexcused_total'];
    $excused_total = (int) $person_data['excused_total'];    

    // Check to see if date is in correct format, bind.
    // If not, convert to correct format and bind.
    $date_joined = $person_data['date_joined'];
    if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date_joined)) {
        if(validateDate($date_joined)) {
        } else {
            echo false;
            die;
        }
    } else {
        $date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
        if(validateDate($date_joined)){
        } else {
            echo false;
            die;
        }
    }
    
    // Bind values
    $stmt->bindValue(':banner', $banner);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':p_id', $pid);
    $stmt->bindValue(':username', $person_data['username']);
    $stmt->bindValue(':first_name', $person_data['first_name']);
    $stmt->bindValue(':last_name', $person_data['last_name']);
    $stmt->bindValue(':date_joined', $date_joined);
    
    // Execute SQL
    $stmt->execute();
    // Report Success
    $success = TRUE;
    echo $success;
    
}  catch(PDOException $e) {
    
        // Report failure
        $failure = FALSE;
        echo $failure;
        // Report error
        echo 'error: ' . $e->getMessage();   
        
    }

    // Function to validate the date.
    function validateDate($date)
    {
        list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );    
        return (checkdate( $m, $d, $y ) and $y <= date('Y'));
    }
?>