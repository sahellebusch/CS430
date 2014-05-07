<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.11.14
 * PHP backend to retrieve previous 15 'meetings' in student senate
 */

include "../db_connection.php";

    try {
 
    $connect = new db_connection();
    $db = $connect->connect();

    $stmt = $db ->prepare("SELECT * FROM  `meeting` GROUP BY DATE LIMIT 0 , 15");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>