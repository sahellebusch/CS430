<?php 

/*
 * Author: Sean Hellebusch
 * Date: 5.19.14
 * phpUnit test class for Validator
 */

require_once "../class_files/Validator.php";
    
class TestValidations extends PHPUnit_framework_TestCase {
    
    public $val;
    
    public function setUp() {
        $this->val = new Validator();   
    }
    
    //////////// Test banner validation method ////////////
    public function testValidateBannerGoodNumber() {
        $this->assertTrue($this->val->validateBanner(1234567890));
    }
    
    public function testValidateBannerNonNumber() {
        $this->assertFalse($this->val->validateBanner('123zzz456'));
    }
    
    public function testValidateBannerBigNumber() {
         $this->assertFalse($this->val->validateBanner(123456789123)); 
    }
    
    //////////// Test date validation method ////////////
    public function testValidateDateGoodDateSQLFormat() {
        $this->assertTrue($this->val->validateDate('2014-02-02'));
    }
    
    public function testValidateDateGoodDateNonSQLFormat() {
        $this->assertTrue($this->val->validateDate('02-02-2014'));
    }
    
    public function testValidateDateBadDaySQLFormat() {
       $this->assertFalse($this->val->validateDate('2014-02-38'));
    }
    
    public function testValidateDateBadDayNonSQLFormat() {
        $this->assertFalse($this->val->validateDate('38-02-2014'));
    }
    
    public function testValidateDateBadMonthSQLFormat() {
       $this->assertFalse($this->val->validateDate('2014-38-02'));
    }
    
    public function testValidateBadMonthNonSQLFormat() {
        $this->assertFalse($this->val->validateDate('02-38-2014'));
    }
    
    public function testValidateDateBadYear() {
       $this->assertFalse($this->val->validateDate('2000000-02-02'));
    }
    
    //////////// Test date validation method ////////////
    public function testValidatePhoneGoodNumberWithHyphens10Digits() {
        $this->assertTrue($this->val->validatePhone('111-111-1111'));
    }
    
    public function testValidatePhoneGoodNumberNoHyphens10Digits() {
        $this->assertTrue($this->val->validatePhone(1234567890));
    }
    
    public function testValidatePhoneGoodNumberWithHyphens7Digits() {
        $this->assertTrue($this->val->validatePhone('111-1111'));
    }
    
    public function testValidatePhoneGoodNumberNoHyphens7Digits() {
        $this->assertTrue($this->val->validatePhone(1234567));
    }
    
    public function testValidatePhoneTooManyDigitsWithHyphens() {
        $this->assertFalse($this->val->validatePhone('123-456-7890123456789'));
    }
    
    
    public function testValidatePhoneTooManyDigitsNoHyphens() {
        $this->assertFalse($this->val->validatePhone(1234567890123456789));
    }
    
    public function tearDown() {
        unset($this->val);
    }
    
}









?>