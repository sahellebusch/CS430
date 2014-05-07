<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.24.14
 * PHP backend to retrieve a meeting's 
 * attendence record by specific meeting id
 */

include "../db_connection.php";

// Decode JSON object, exit if NULL
$m_id = json_decode(file_get_contents("php://input"), TRUE);
if(empty($m_id)) {
    exit("null json object passed");
}

try {
    // Connect to DB
    $connect = new db_connection();
    $db = $connect->connect();

    // Prepare SQL 
    $stmt = $db ->prepare("SELECT last_name, first_name, present FROM person, attendance_meeting WHERE person.p_id = attendance_meeting.p_id AND attendance_meeting.m_id = :m_id");
    
    // Bind meeting date
    $stmt->bindValue(':m_id', $m_id);

    // Execute
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
} catch(PDOException $e) {  
    echo 'error: ' . $e->getMessage();
    $failure = false;
    echo $failure;
}

?>