<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.24.14
 * PHP backend to retrieve a meeting's attendence record by specific date
 */

// Decode JSON object, exit if NULL
$m_id = json_decode(file_get_contents("php://input"), TRUE);
if(empty($m_id)) {
exit("null json object passed");
}

try {
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL 
    $stmt = $pdo->prepare("SELECT last_name, first_name, present FROM person, m_id 
WHERE person.p_id = attendance_meeting.p_id AND attendance_meeting.m_id = :m_id");
    
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