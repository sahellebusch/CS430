<?php 

/*
 * Author: Sean Hellebusch
 * Date: 5.6.14
 * PHP class to abstract out DB connection
 */

class PDO_Connector {
    
    public function connect() {
        try {
            // Database login
            $dbuser = 'jpf7324';
            $dbpass = 'oxaetoht';
            // Connect to DB
            $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            return $db;
        } catch(PDOException $e) {
            echo 'error: ' . $e->getMessage();
        }
    }
}

?>