<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.12.14
 * PHP backend to update a person into the DB
 */

/*
 * This is the format of the JSON object.
 *
 *    {
 *     "username": "abc1234",
 *     "banner": "123456789",
 *     "phone": "132-456-7890"
 *     "date_joined: "mm/dd/yyyy",
 *     "first_name": "John",
 *     "last_name": "Doe"},
 *     "p_id: "######"
 *  ]}
 */

try {
    // Decode JSON object
    $person_data = json_decode(file_get_contents("php://input"), TRUE);
    echo var_dump($person_data);
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    // Connect to DB
    $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare Statement
    $stmt = $db->prepare("UPDATE person SET username = :username, banner = :banner, phone = :phone, date_joined = :date_joined,                         first_name = :first_name, last_name = :last_name, WHERE p_id = :p_id 
        VALUES (:p_id, :username, :banner, :phone, :date_joined, :first_name, :last_name)");
    // Check to see if date is in correct format, bind.
    // If not, convert to correct format and bind.
    $date_joined = $person_data['date_joined'];
    echo var_dump($date_joined);
    if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date_joined)){ 
        $stmt->bindValue(':date_joined', $date_joined);
    }else{ 
        $date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
        $stmt->bindValue(':date_joined', $date_joined);
    }
    // Bind values
    $stmt->bindValue(':username', $person_data['username']);
    $stmt->bindValue(':banner', (int)$person_data['banner']);
    $stmt->bindValue(':phone', (int)$person_data['phone']);
    $stmt->bindValue(':first_name', $person_data['first_name']);
    $stmt->bindValue(':last_name', $person_data['last_name']);
    $stmt->bindValue(':p_id', (int)($person_data['p_id']));
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


?>