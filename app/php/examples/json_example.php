<?php
if(!isset($_GET['data'])) {
    header('400 bad request');
    exit;
}
else {
    try {
 
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    //Connect to DB
    $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO `person`(username, banner, phone, date_joined, first_name, last_name) 
             VALUES (:username, :banner, :phone, :date_joined, :first_name, :last_name)");
        $stmt->bindValue(':username', 'TEST');
        $stmt->bindValue(':banner', 123456789);
        $stmt->bindValue(':phone', 1234567987);
        $stmt->bindValue(':date_joined', 2014-02-02);
        $stmt->bindValue(':first_name', 'TOMMY');
        $stmt->bindValue(':last_name', 'TESTER');
        $stmt->execute();
    }  catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }
}





////Get and convert
//if(isset($_POST['data'])) {
//    //Get
//    $JSON = $_POST['data'];
//    $jsonData = json_decode($JSON);
//    var_dump($jsonData);
//    //Manipulate (increment age)
//    $JSON[0][1].age++;
//    var_dump($JSON);
//}
////Convert to JSON and give back
//echo json_encode($jsonData);
?>