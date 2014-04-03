/*
Author: John Foley
Date: 4.2.14
This web app handles logistics for Truman State Student Government
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope, $http ) {
    
    $scope.status = "Good so far";
    
    $scope.url = 'app/php/examples/json_example.php'; 
    
    $scope.persons = somePeople($http);
    
    function somePeople($http) {
        /*
        return [{"name":"John", "age":21},
        {"name":"Sean", "age":22}];
        */
        
        
        $http.get($scope.url)
        .then(function(result) {
            console.log(result.data[0].username);
            $scope.persons = result.data;

        });

        
    }
    
});