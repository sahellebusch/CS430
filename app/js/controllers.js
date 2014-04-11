
/*
Author: John Foley
Date: 4.2.14
Controller for index page. Lists page options and routing.
*/

/*global angular, console*/

// Define the module for the app
var stugovControllers = angular.module("stugovControllers", []);

// Name: indexCtr
// Last Modified: 4.9.14
// Controller for the front (index) page
stugovControllers.controller("frontCtr", function( $scope, $http, navAjax ) {
    
    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    navAjax.getNav().then( function( result ) {
        $scope.pages = result.data;
    });
});

// Name: personCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("personCtr", function( $scope, personAjax, navAjax ) {
    
    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    navAjax.getNav().then( function( result ) {
        $scope.pages = result.data;
    });
    
    // Call the service personAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then( function( result ) {
        $scope.persons = result.data;  
    });
});

// Name: meetingCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("meetingCtr", function( $scope, navAjax ) {
    
    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    navAjax.getNav().then( function( result ) {
        $scope.pages = result.data;
    });
    
    // Updates the variables accordingly
    $scope.update = function(type) {
        $scope.master = angular.copy(type);
    };
      
});