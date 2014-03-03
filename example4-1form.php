<?php

/*
 * Author: John Foley
 * Date: 3.2.14
 * Made to help enter information into the database for homework set #2, CS430 at Truman State
 */

// Display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// First define functions
function print_form() {
    echo <<<END
    <div class="content">
    <form action="$_SERVER[PHP_SELF]" method="post">
            <p> FNAME: <input type="text" name="FNAME" size="30" id="FNAME" /></p>
            <p> SALARY: <input type="text" name="SALARY" size="30" id="SALARY" /></p>


        <input type="hidden" name="stage" value="process">
        <input type="submit" value="Submit"><input type="reset" value="Clear"></form>

        </div> <!-- end .content -->

    END;

}
/*
function process_form() {
    
    // Database login
    $dbuser = "root";
    $dbpass = "root";
    
    // Connect to database
    $db = new PDO('mysql:host=localhost;dbname=CS430;charset=utf8', $dbuser, $dbpass, 
                  array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
    
    // Grab information from the form
    $FNAME = $_POST["FNAME"];
    $SALARY = $_POST["SALARY"];
    
    // Insert form data into database
    $stmt = $db->prepare("INSERT INTO Example4.1(FNAME, SALARY) VALUES (:FNAME, :SALARY)");
    $stmt->bindValue(:FNAME, $FNAME);
    $stmt->bindValue(:SALARY, $SALARY);
    $stmt->execute();

}
*/
// Main program

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
    process_form();
} else {
    print_form();
}


?>