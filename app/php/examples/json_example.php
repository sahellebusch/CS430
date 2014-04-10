<!--
Author: Sean Hellebusch
Date: 4.10.14
PHP Backend test to retrieve all 'persons' in student senate
-->


<?php

    try {
 
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $pdo = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM person");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
        
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

?>