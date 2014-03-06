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
            <p> fid: <input type="text" name="fid" size="30" id="fid" /></p>
            <p> fname: <input type="text" name="fname" size="30" id="fname" /></p>
            <p> ext: <input type="text" name="ext" size="30" id="ext" /></p>
            <p> dept: <input type="text" name="dept" size="30" id="dept" /></p>
            <p> rank: <input type="text" name="rank" size="30" id="rank" /></p>
            <p> salary: <input type="text" name="salary" size="30" id="salary" /></p>

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
    $fid = $_POST['fid'];  
    $fname = $_POST['fname'];
    $ext = $_POST['ext'];
    $dept = $_POST['dept'];
    $rank = $_POST['rank'];
    $salary = $_POST['salary'];
    
    try {
        
        // Connect to database
        $db = new PDO("mysql:host=mysql.truman.edu;dbname=jpf7324CS430;charset=utf8", $dbuser, $dbpass); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert form data into database
        $stmt = $db->prepare("INSERT INTO `faculty`(fid, fname, ext, dept, rank, salary) 
            VALUES (:fid, :fname, :ext, :dept, :rank, :salary)");
        $stmt->bindValue(':fid', $fid);
        $stmt->bindValue(':fname', $fname);
        $stmt->bindValue(':ext', $ext);
        $stmt->bindValue(':dept', $dept);
        $stmt->bindValue(':rank', $rank);
        $stmt->bindValue(':salary', $salary);
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