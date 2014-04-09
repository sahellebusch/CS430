/*
Author: John Foley
Date: 4.2.14
Controller for index page. Lists page options and routing.
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

// Name: indexCtr
// Last Modified: 4.9.14
// Controller for the front (index) page
app.controller("indexCtr", function( $scope, $http ) {
    
    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    $scope.pages = [
        {"pageName":"Home", "address":"index.html"},
        {"pageName":"Senators", "address":"person.html"}
    ];
});