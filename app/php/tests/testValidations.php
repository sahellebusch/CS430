<?php 
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
        $this->assertFalse($this->val->validateBanner('aft156'));
    }
    
    public function testValidateBannerBigNumber() {
         $this->assertFalse($this->val->validateBanner(123456789123)); 
    }
    
    //////////// Test date validation method ////////////
    public function testValidateDateGoodDate() {
        $this->assertTrue($this->val->validateDate(2014-02-02));
    }
    
    public function testValidateDateBadDay() {
       $this->assertFalse($this->val->validateDate(2014-02-100));
    }
    
    public function testValidateDateBadMonth() {
       $this->assertFalse($this->val->validateDate(2014-100-02));
    }
    
    public function testValidateDateBadYear() {
       $this->assertFalse($this->val->validateDate(2000000-02-02));
    }
    
    //////////// Test date validation method ////////////
    public function testValidatePhoneGoodNumber() {
        $this->assertTrue($this->val->validatePhone(123-456-7890));
    }
    
    public function testValidatePhoneTooManyDigits() {
        $this->assertFalse($this->val->validatePhone(1234567890123456));
    }
    
    public function tearDown() {
        unset($this->val);
    }
    
}









?>