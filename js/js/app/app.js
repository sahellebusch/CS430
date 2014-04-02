/*
Author: John Foley
Date: 4.2.14
This web app handles logistics for Truman State Student Government
*/

/*global angular */

// Define the module for the app
var app = angular.module("stugovapp", []);

app.controller("indexCtr", function( $scope, ajaxService ) {
    $scope.person = [
        {"name":"john", "age":"21"},
        {"name":"sean", "age":"22"}];
    
    
    
    
});

app.factory('ajaxService', function($http) {
   return {
        getFoos: function() {
             //return the promise directly.
             return $http.post('/php/examples/')
                       .then(function(result) {
                            //resolve the promise as the data
                            return result.data;
                        });
        }
   }
});

myService.getFoos().then(function(foos) {
        $scope.foos = foos;
    });