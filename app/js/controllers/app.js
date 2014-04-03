/*
Author: John Foley
Date: 4.2.14
This web app handles logistics for Truman State Student Government
*/

/*global angular */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope, $http ) {
    
    $scope.persons = [
        {"name":"john", "age":21},
        {"name":"sean", "age":22}];
    
    /*
    $scope.status = "Good so far";
    
    $scope.result = $scope.persons;
    
    // The url of the AJAX call
    $scope.url = '../../php/search.php'; 
      
    
    // The function that will be executed on button click (ng-click="insertPerson()")
    $scope.insertPerson = function() {
         
        // Create the http post request
        // the data holds the keywords
        // The request is a JSON request.
        $http.post($scope.url, { "data" : $scope.persons})
        .success(function(data, status) {
            $scope.status = status;
            $scope.data = data;
            $scope.result = data; // Show result from server in our <pre></pre> element
        })
        .error(function(data, status) {
            $scope.data = data || "Request failed";
            $scope.status = status;         
        });
    };
    */
});