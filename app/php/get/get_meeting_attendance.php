<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.21.14
 * PHP backend to retrieve a meeting's attendence record by specific date
 */

// Decode JSON object, exit if NULL
$meeting_date = json_decode(file_get_contents("php://input"), TRUE);
if($meeting_date == NULL) {
    exit("null json object passed");
}

if(validateDate($meeting_date) {
    try {
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL 
    $stmt = $pdo->prepare("SELECT last_name, first_name, date, present FROM person, event, attendance_event 
        WHERE person.p_id = attendance_event.p_id AND attendance_event.e_id = event.e_id AND date = :meeting_date");
    
    // Bind meeting date
    $stmt->bindValue(':meeting_date', $meeting_date);

    // Execute
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    } catch(PDOException $e) {  
        echo 'error: ' . $e->getMessage();
    }
} else{
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

?>