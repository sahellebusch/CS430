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
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    // Connect to DB
    $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare Statement
    $stmt = $db->prepare("UPDATE person SET username = :username banner = :banner phone = :phone date_joined = :date_joined                         first_name = :first_name last_name = :last_name WHERE p_id = :p_id 
        VALUES (:p_id, :username, :banner, :phone, :date_joined, :first_name, :last_name)");
    // Convert date joined to SQL format
    $date_joined_SQL_format = date('Y-m-d', strtotime(str_replace('-', '/', $person_data[3]['date_joined'])));
    // Bind values
    $stmt->bindValue(':username', $person_data[0]['username']);
    $stmt->bindValue(':banner', $person_data[1]['banner']);
    $stmt->bindValue(':phone', $person_data[2]['phone']);
    $stmt->bindValue(':first_name', $person_data[4]['first_name']);
    $stmt->bindValue(':last_name', $person_data[5]['last_name']);
    $stmt->bindValue(':date_joined', $date_joined_SQL_format);
    $stmt->bindValue(':p_id', $person_data[6]['p_id'];
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