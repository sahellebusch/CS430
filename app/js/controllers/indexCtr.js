/*
Author: John Foley
Date: 4.2.14
Controller for index page. Lists page options and routing.
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope, $http ) {
    
    $scope.pages = [
        {"pageName":"Home", "address":"index.html"},
        {"pageName":"Senators", "address":"person.html"}
    ];
});