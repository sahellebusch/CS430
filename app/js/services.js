/*
Author: John Foley
Date: 4.9.14
Written to access senators from the database backend
*/


/* global stugovApp, console*/

// Factory that uses $http dependency
// Name: personAjax
// Last Modified: 4.9.14
// Parms/Dependencies: $http
// Returns json of Senator information
stugovApp.factory('personAjax', function( $http ) {
    
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

// Factory that returns page list
// Name: navAjax
// Last Modified: 4.10.14
// Parms/Dependencies: $http
// Returns json of nav information
stugovApp.factory('navAjax', function( $http ) {
    
    return {
            
        // Function to return person JSON
        getNav : function() {
            
            // PHP file that AJAX is calling
            var url = 'app/json/navList.json'; 
            
            // Return results up the line
            return $http.get(url);
            
        }
        
    };
});