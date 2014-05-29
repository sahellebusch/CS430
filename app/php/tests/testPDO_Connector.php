<?php

require_once "../class_files/PDO_Connector.php";

class TestPDO_Connector extends PHPUnit_framework_TestCase{

    public $pdo;
    
    public function testPDO_Connector() {
        $pdo = new PDO_Connnector();
        $this->assertInstanceOf(PDO, $pdo);
    }

}

?>