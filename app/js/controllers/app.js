/*
Author: John Foley
Date: 4.2.14
This web app handles logistics for Truman State Student Government
*/

/*global angular */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope, $http ) {
    
    $scope.status = "Good so far";
    
    $scope.url = '../../php/search.php'; 
    
    $scope.persons = somePeople($http);
    
    function somePeople($http) {
        return [{"name":"John", "age":21},
        {"name":"Sean", "age":22}];
        
        /*
        $http.get($scope.url)
            .then(function(result) {
                return result.data;
            });
        */
    }
    
});