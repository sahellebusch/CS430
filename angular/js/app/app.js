/*
Author: John Foley
Date: 4.2.14
This web app handles logistics for Truman State Student Government
*/

/*global angular */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope ) {
    $scope.persons = [
        {"name":"john", "age":21},
        {"name":"sean", "age":22}];
    
});