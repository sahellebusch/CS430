<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.12.14
 * PHP backend to retrieve a person using 'p_id' in student senate
 */

include "../db_connection.php";

    try {
 
// Decode JSON
$person_id = json_decode(file_get_contents("php://input"), TRUE);
if(empty($person_id)) {
    exit("null json object passed");
}
try {
    $connect = new db_connection();
    $db = $connect->connect();

    // Prepare SQL Statement
    $stmt = $db->prepare("SELECT first_name, last_name, username, banner, phone, date_joined, unexcused_total,         excused_total FROM person WHERE p_id = :p_id");
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