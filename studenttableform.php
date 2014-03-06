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
            <p> sid: <input type="text" name="sid" size="30" id="sid" /></p>
            <p> sname: <input type="text" name="sname" size="30" id="sname" /></p>
            <p> sex: <input type="text" name="sex" size="30" id="sex" /></p>
            <p> major: <input type="text" name="major" size="30" id="major" /></p>
            <p> gpa: <input type="text" name="gpa" size="30" id="gpa" /></p>

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
    $sid = $_POST['sid'];  
    $sname = $_POST['sname'];
    $sex = $_POST['sex'];
    $major = $_POST['major'];
    $gpa = $_POST['gpa'];
    
    try {
        
        // Connect to database
        $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert form data into database
        $stmt = $db->prepare("INSERT INTO `student`(sid, sname, sex, major, gpa) 
            VALUES (:sid, :sname, :sex, :major, :gpa)");
        $stmt->bindValue(':sid', $sid);
        $stmt->bindValue(':sname', $sname);
        $stmt->bindValue(':sex', $sex);
        $stmt->bindValue(':major', $major);
        $stmt->bindValue(':gpa', $gpa);
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