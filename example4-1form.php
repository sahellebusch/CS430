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
            <p> FNAME: <input type="text" name="fname" size="30" id="FNAME" /></p>
            <p> SALARY: <input type="text" name="salary" size="30" id="SALARY" /></p>


        <input type="hidden" name="stage" value="process">
        <input type="submit" value="Submit"><input type="reset" value="Clear"></form>

        </div> <!-- end .content -->
END;

}

function process_form() {
    
    // Database login
    $dbuser = 'root';
    $dbpass = 'root';
    
    // Grab information from the form
    $fname = $_POST['fname'];  
    $salary = $_POST['salary'];
    
    try {
        
        // Connect to database
        $db = new PDO("mysql:host=localhost;dbname=CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert form data into database
        $stmt = $db->prepare("INSERT INTO `example4.1`(FNAME, SALARY) VALUES (:FNAME, :SALARY)");
        $stmt->bindValue(':FNAME', $fname);
        $stmt->bindValue(':SALARY', $salary);
        $stmt->execute();
        
    } catch(PDOException $e) {
        
        echo 'error: ' . $e->getMessage();   
        
    }

}

//main program

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
	process_form();
} else {
	print_form();
}
?>