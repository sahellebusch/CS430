/*
Author: John Foley
Date: 4.9.14
Written to access senators from the database backend
    written in PHP
*/


/* global app */

// Factory that uses $http dependency
// Name: personAjax
// Last Modified: 4.9.14
// Parms/Dependencies: $http
// Returns json of Senator information
app.factory('personAjax', function( $http ) {
    
    return {
            
        // Function to return person JSON
        getPerson : function() {
            
            // PHP file that AJAX is calling
            var url = 'app/php/examples/json_example.php'; 
            
            // Return results up the line
            return $http.get(url);
            
        }
        
    };
});