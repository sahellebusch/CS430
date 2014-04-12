<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.11.14
 * PHP backend to insert a meeting into the DB
 */

/*
 * This is the format of the JSON object.
 *
 * {"meeting_info": [
 *    {"meeting_date": "mm/dd/yyyy"}
 *  ]}
 */
    
try {
    // Decode JSON object
    $meeting_data = json_decode(file_get_contents("php://input"), TRUE);
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare Statement
    $stmt = $db->prepare("INSERT INTO `meeting`(date) 
         VALUES (:meeting_date)");
    // Convert date joined to SQL format
    $meeting_date_SQL_format = date('Y-m-d', strtotime(str_replace('-', '/', {$meeting_data->meeting_date})));
    // Bind values
    $stmt->bindValue(':meeting_date', $meeting_date_SQL_format);
    // Execute SQL
    $stmt->execute();
        
}  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }
}

?>