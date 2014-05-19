<?php

/*
 * Author: Sean Hellebusch
 * Date: 5.19.14
 * PHP class to abstract data validations
 */

class Validator {

    // Function to validate date_joined.
    function validateDate($date_joined) {
        if((preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date_joined))) {
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
            return (checkdate( $m, $d, $y ) && ($y >= date('Y') - 2) && ($y <= date('Y')));
        } else {
            // wrong format, convert to correct format
            $date_joined = date('Y-m-d', strtotime(str_replace('-', '/', $date_joined)));
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date_joined );
            return (checkdate( $m, $d, $y ) && ($y >= date('Y') - 2) && ($y <= date('Y')));
            }
    }

    // Validates banner is no longer than 10 ints long.
    function validateBanner($banner) {
        return(is_int($banner) 
               && !(strlen($banner) == 0) 
               && strlen($banner) <= 10);
    }

    
    function validatePhone($phone) {
        //eliminate every char except 0-9
        $phone = $justNums = str_replace('-', '', $phone);
        return((strlen($phone) == 10) or (strlen($phone) == 7));
    }
    
}

?>