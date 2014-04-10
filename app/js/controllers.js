
/*
Author: John Foley
Date: 4.2.14
Controller for index page. Lists page options and routing.
*/

/*global angular, console */

// Define the module for the app
var stugovControllers = angular.module("stugovControllers", []);

// Name: indexCtr
// Last Modified: 4.9.14
// Controller for the front (index) page
stugovControllers.controller("indexCtr", function( $scope, $http ) {
    
    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    $scope.pages = [
        {"pageName":"Home", "address":"index.html"},
        {"pageName":"Senators", "address":"person.html"}
    ];
});

// Name: personCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("personCtr", function( $scope, personAjax ) {
    
    // Call the service personAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then( function( result ) {
        console.log(result.data);
        $scope.persons = result.data;  
    });
    
    
});