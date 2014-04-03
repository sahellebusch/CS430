
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
}





//$pdo=new PDO("mysql:dbname=database;host=127.0.0.1","user","password");
//$statement=$pdo->prepare("SELECT * FROM table");
//$statement->execute();
//$results=$statement->fetchAll(PDO::FETCH_ASSOC);
//$json=json_encode($results);

//Get and convert
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