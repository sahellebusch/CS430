<?php

/*
 * Author: John Foley
 * Date: 3.2.14
 * Made to help enter information into the database for homework set #2, CS430 at Truman State
 */

// Error reporting
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

// First define functions
function print_form() {
    echo <<<END
    <div class="content">
    <form action="$_SERVER[PHP_SELF]" method="post">
            <p> crsnbr: <input type="text" name="crsnbr" size="30" id="crsnbr" /></p>
            <p> sid: <input type="text" name="sid" size="30" id="sid" /></p>
            <p> grade: <input type="text" name="grade" size="30" id="grade" /></p>

        <input type="hidden" name="stage" value="process">
        <input type="submit" value="Submit"><input type="reset" value="Clear"></form>

        </div> <!-- end .content -->
END;

}

function process_form() {
    
    // Database login
    $dbuser = 'jpf7324';
    $dbpass = 'oxaetoht';
    
    // Grab information from the form
    $crsnbr = $_POST['crsnbr'];  
    $sid = $_POST['sid'];
    $grade = $_POST['grade'];
    
    try {
        
        // Connect to database
        $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert form data into database
        $stmt = $db->prepare("INSERT INTO `crsenrl` (crsnbr, sid, grade) 
            VALUES (:crsnbr, :sid, :grade)");
        $stmt->bindValue(':crsnbr', $crsnbr);
        $stmt->bindValue(':sid', $sid);
        $stmt->bindValue(':grade', $grade);
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