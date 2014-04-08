/*
Author: John Foley
Date: 4.2.14
Controller to show senators from the database `persons` table
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("personCtr", function( $scope, personAjax ) {
    
    // PHP file that AJAX is calling
    $scope.url = 'app/php/examples/json_example.php'; 
    
    // The actual place the model uses to hold the data
    personAjax.getPerson().then(function(data) {
            $scope.persons = data;
        });
    
    
});