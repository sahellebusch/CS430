/*
Author: John Foley
Date: 4.2.14
Controller to show senators from the database `persons` table
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("personCtr", function( $scope, personAjax ) {
    
    
    
    /*
    // The actual place the model uses to hold the data
    personAjax.getPerson().then(function(data) {
            $scope.persons = data;
        });
        */
    
    // maybe with or without paranthesis
    personAjax.getPerson().then( function( result ) {
        $scope.persons = result.data;
    });
    
    
});

app.factory('personAjax', function( $http ) {
    
    return {
            
        getPerson : function() {
            
            // PHP file that AJAX is calling
            var url = 'app/php/examples/json_example.php'; 
            
            return $http.get('app/php/examples/json_example.php');
            
        }
        
    };
});