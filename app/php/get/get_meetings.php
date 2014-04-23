<?php
/*
 * Author: Sean Hellebusch
 * Date: 4.11.14
 * PHP backend to retrieve previous 15 'meetings' in student senate
 */

    try {
 
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM  `meeting` GROUP BY DATE LIMIT 0 , 15");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>