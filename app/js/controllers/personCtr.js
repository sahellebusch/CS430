/*
Author: John Foley
Date: 4.2.14
Controller to show senators from the database `persons` table
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("personCtr", function( $scope, $http ) {
    
    // PHP file that AJAX is calling
    $scope.url = 'app/php/examples/json_example.php'; 
    
    // The actual place the model uses to hold the data
    $scope.persons = getPeople($http);
    
    // Function for AJAX calls
    // Don't keep this, make it a service and use the service
    function getPeople($http) {
        /*
        return [{"name":"John", "age":21},
        {"name":"Sean", "age":22}];
        */
        
        
        $http.get($scope.url)
        .then(function(result) {
            
            // Place data into scope
            $scope.persons = result.data;

        });

        
    }
    
});