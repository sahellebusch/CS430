<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.12.14
 * PHP backend to retrieve a person using 'p_id' in student senate
 */
 
// Decode JSON
$person_id = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_id)) {
    exit("null json object passed");
}

try {
    $p_id = $person_id['p_id'];
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare SQL Statement
    $stmt = $pdo->prepare("DELETE FROM person WHERE p_id = :p_id");
    // Bind Values
    $stmt->bindValue(':p_id', $p_id);
    // Execute SQL Statement
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $success = true;
    echo $success;
        
}  catch(PDOException $e) {
    $failure = false;
    echo 'error: ' . $e->getMessage();   
    echo $failure;
}

?>