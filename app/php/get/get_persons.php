<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.10.14
 * PHP backend to retrieve all 'persons' in student senate
 */

include "../db_connection.php";

    try {
 
    $connect = new db_connection();
    $db = $connect->connect();


    $stmt = $db->prepare("SELECT * FROM person");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>