<?php

/*
 * Author: Sean Hellebusch
 * Date: 4.2.14
 * Enter information about a new person in studet senate database.
 */

// Error reporting
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

// First define functions
function print_form() {
    echo <<<END
    <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    </head>
    <div class="content">
    <form action="$_SERVER[PHP_SELF]" method="post">
            <p> Username: <input type="text" name="username" size="10" id="username" /></p>
            <p> Banner ID: <input type="text" name="banner" size="30" id="banner" /></p>
            <p> Phone: <input type="text" name="phone" size="30" id="phone" /></p>
            <p> Date Joined: <input type="text" name="date_joined" size="30" id="datepicker" /></p>
            <p> First Name: <input type="text" name="first_name" size="30" id="first_name" /></p>
            <p> Last Name: <input type="text" name="last_name" size="30" id="last_name" /></p>

        <input type="hidden" name="stage" value="process">
        <input type="submit" value="Submit"><input type="reset" value="Clear"></form>
        <script>
          $(function() {
            $( "#datepicker" ).datepicker();
          });
        </script>
        </div> <!-- end .content -->
END;

}

function process_form() {
    
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    // Grab information from the form
    $username = $_POST['username'];  
    $banner = $_POST['banner'];
    $phone = $_POST['phone'];
    //$date_joined = $_POST['date_joined'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
	$date_joined = $_POST['date_joined'];
	// Convert date to MySQL DATE format
	$date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
    
	try {
        
        // Connect to database
        $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert form data into database
        $stmt = $db->prepare("INSERT INTO `person`(username, banner, phone, date_joined, first_name, last_name) 
             VALUES (:username, :banner, :phone, :date_joined, :first_name, :last_name)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':banner', $banner);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':date_joined', $date_joined);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->execute();
        
    } catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }
    
    print_form();

}

//main program

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
	process_form();
} else {
	print_form();
}
?>