<?php

/*
 * Author: Sean Hellebusch
 * Date: 5.6.14
 * PHP class to abstract data validations
 */

class Validator {

    // Function to validate date_joined.
    function validateDate($date_joined) {
        if((preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date_joined))) {
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
            return (checkdate( $m, $d, $y ) and $y <= date('Y'));
        } else {
            // wrong format, convert to correct format
            $date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
            return (checkdate( $m, $d, $y ) and $y <= date('Y'));
            }
    }

    // Validates banner is no longer than 10 ints long.
    function validateBanner($banner) {
        return(strlen($banner) <= 10);
    }

    // Validates phone number
    function validatePhone($phone) {
    $numbersOnly = ereg_replace("[^0-9]", "", $phone);
    $numberOfDigits = strlen($numbersOnly);
    if ($numberOfDigits == 7 or $numberOfDigits == 10) {
        return true;
    } else {
        return false;
    }
} 
    
}

?>