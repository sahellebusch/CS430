<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.28.14
 * PHP backend to delete a person by removing all
 * foreign key constraints first (no cascade constraint
 * access allowed with TSU access)
 */
 
// Decode JSON
$person_id = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_id)) {
    exit("null json object passed");
}

try {
    $p_id = $person_id;
    
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL Statements to get rid of foreign key constraints   
    // Bind Values
    $stmt = $pdo->prepare("DELETE FROM attendance_committee WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM attendance_event WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM attendance_meeting WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM committee_chair WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM person_on_a_committee WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM position_can_vote WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM vote_record WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM person WHERE p_id = :p_id");
    $stmt->bindValue(':p_id', $p_id);
    $stmt->execute();
    
    // Report success
    $success = true;
    echo $success;
        
}  catch(PDOException $e) {
    $failure = false;
    echo 'error: ' . $e->getMessage();   
    // Report failure
    echo $failure;
}

?>