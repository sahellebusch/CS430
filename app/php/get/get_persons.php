<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.10.14
 * PHP backend to retrieve all 'persons' in student senate
 */

include "../class_files/PDO_Connector.php";

    try {
 
    $connect = new PDO_Connector();
    $pdo = $connect->connect();


    $stmt = $pdo->prepare("SELECT * FROM person");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>