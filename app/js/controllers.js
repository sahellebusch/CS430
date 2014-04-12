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
stugovControllers.controller("frontCtr", ['$scope',
    function ($scope) {

        // Empty

}]);

// Name: personCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("personCtr", ['$scope', 'personAjax',
    function ($scope, personAjax) {

        // Call the service personAjax and then use the returned
        // data to build the person object
        personAjax.getPerson().then(function (result) {
            console.log(result.data);
            $scope.persons = result.data;
        });
}]);

// Name: meetingCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("meetingCtr", ['$scope',
    function ($scope) {

        // Updates the variables accordingly
        $scope.update = function (type) {
            $scope.master = angular.copy(type);
        };

}]);

// Name: personDetailCtr
// Last Modified: 4.11.14
// Controller for a specific person
// Params/Dependencies: $scope, $http
// Services: personDetailAjax, navAjax
stugovControllers.controller("personDetailCtr", function ($scope, $routeParams, personAjax) {

    // Capture the person from the URL from previous page
    $scope.pid = $routeParams.pid;

    // Using a hardcoded JSON of objects, for now
    // Future plans to use database backend for this
    navAjax.getNav().then(function (result) {
        $scope.pages = result.data;
    });

    // Call the service personDetailAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then(function (result) {
        for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].p_id == $scope.pid) {
                console.log(result.data[i]);
                $scope.info = result.data[i];
            }
        }
    });
});