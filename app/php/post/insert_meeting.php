<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.22.14
 * PHP backend to insert a meeting into the DB
 */
  
include "../db_connection.php";
include "../validations.php";

// Decode JSON object, exit if NULL
$meeting_data = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_data)) {
    exit("null json object passed");
}

// Unpack JSON object
$meeting_date = $meeting_data[0]["date"];
$meeting_type = $meeting_data[0]["type"];

// Create validator 
$validate = new validations();
if($vlidations->validateDate($meeting_date)) {
    try {
        
        $connect = new db_connection();
        $db = $connect->connect();

        
        // Prepare Statement
        $stmt = $db->prepare("INSERT INTO `meeting`(date, type) 
         VALUES (:meeting_date, :meeting_type)");
        
        // Bind values (convert any if necessary)
        $stmt->bindValue(':meeting_date', $meeting_date);
        $stmt->bindValue(':meeting_type', $meeting_type);
        
        // Execute and report success
        $stmt->execute();
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
    $failure = FALSE;
    echo $failure;
    die;
}

?>