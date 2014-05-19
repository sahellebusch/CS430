<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.11.14
 * PHP backend to retrieve previous 15 'meetings' in student senate
 */

include "../class_files/pdo_connection.php";

    try {
 
    $connect = new pdo_connection();
    $pdo = $connect->connect();

    $stmt = $pdo ->prepare("SELECT * FROM  `meeting` GROUP BY DATE LIMIT 0 , 15");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>