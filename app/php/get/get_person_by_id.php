<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.12.14
 * PHP backend to retrieve a person using 'p_id' in student senate
 */

    try {
 
    // Decode JSON
    $person_id = json_decode(file_get_contents("php://input"), TRUE);   
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare SQL Statement
    $stmt = $pdo->prepare("SELECT first_name, last_name, username, banner, phone, date_joined, unexcused_total, excused_total 
        FROM person WHERE p_id = :p_id");
    // Bind Values
    $stmt->bindValue(':p_id', $person_id['p_id']);
    // Execute SQL Statement
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>