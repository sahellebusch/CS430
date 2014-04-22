<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.22.14
 * PHP backend to insert a meeting into the DB
 */
    
// Decode JSON object, exit if NULL
$meeting_data = json_decode(file_get_contents("php://input"), TRUE);
if($person_data == NULL) {
    exit("null json object passed");
}

// Unpack JSON object
$meeting_date = $meeting_data['date'];
$meeting_type = $meeting_data['type'];

if(validateDate($meeting_date)) {
    try {
        // Database login
        $dbuser = 'jpf7324';
        $dbpass = 'oxaetoht';
        
        // Connect to DB
        $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare Statement
        $stmt = $db->prepare("INSERT INTO `meeting`(date, type) 
         VALUES (:meeting_date, :meeting_type)");
        
        // Bind values (convert any if necessary)
        $stmt->bindValue(':meeting_type', $meeting_date);
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
        
} else {
    $failure = FALSE;
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