/*
Author: John Foley
Date: 4.2.14
Controller to show senators from the database `persons` table
*/

/*global angular, console */

// Define the module for the app
var app = angular.module("stugovapp", []);

// Name: personCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
app.controller("personCtr", function( $scope, personAjax ) {
    
    // Call the service personAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then( function( result ) {
        $scope.persons = result.data;
    });
    
    
});