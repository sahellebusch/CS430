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
            $scope.persons = result.data;
        });
}]);

// Name: meetingCtr
// Last Modified: 4.9.14
// Controller for the person page
// Params/Dependencies: $scope
// Services: personAjax
stugovControllers.controller("meetingCtr", ['$scope', 'addPersonAjax',
    function ($scope, addPersonAjax) {

        // Updates the variables accordingly
        $scope.update = function (type) {
            $scope.info = [{
                    "username": type
                },
                {
                    "banner": type
                },
                {
                    "phone": type
                },
                {
                    "date_joined": type
                },
                {
                    "first_name": type
                },
                {
                    "last_name": type
                }];
            addPersonAjax.insertPerson($scope.info).then(function (result) {
                console.log(result.data);
            });
        };

}]);

// Name: personDetailCtr
// Last Modified: 4.11.14
// Controller for a specific person
// Params/Dependencies: $scope, $http
// Services: personDetailAjax
stugovControllers.controller
("personDetailCtr", ['$scope', '$routeParams', 'personAjax', function ($scope, $routeParams, personAjax) {

    // Capture the person from the URL from previous page
    $scope.pid = $routeParams.pid;

    // Call the service personDetailAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then(function (result) {
        for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].p_id == $scope.pid) {
                $scope.info = result.data[i];
            }
        }
    });
}]);

// Name: personDetailEditCtr
// Last Modified: 4.15.14
// Controller to edit a specific person
// Params/Dependencies: $scope, $http
// Services: personDetailAjax
stugovControllers.controller
("personDetailEditCtr", ['$scope', '$routeParams', 'personAjax', 'updatePersonAjax', function ($scope, $routeParams, personAjax, updatePersonAjax) {

    // Capture the person from the URL from previous page
    $scope.pid = $routeParams.pid;
    
    // Capture old data so that it's not updated while the user
    // changes information on the view
    $scope.old = $scope.info;

    // Call the service personDetailAjax and then use the returned
    // data to build the person object
    personAjax.getPerson().then(function (result) {
        for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].p_id == $scope.pid) {
                $scope.info = result.data[i];
                $scope.old = angular.copy($scope.info);
            }
        }
    });
    
    // Activation on button click to update person information
    $scope.update = function(info) {
        
        // Send new data to Ajax
        updatePersonAjax.updatePerson(angular.copy(info));
        
    };
}]);

// Name: insertPersonCtr
// Last Modified: 4.11.14
// Controller to insert a new person
// Params/Dependencies: $scope
// Services: insertPersonAjax
stugovControllers.controller
("personDetailCtr", ['$scope', 'insertPersonAjax', function ($scope, insertPersonAjax) {
    
    // Function to be called when user submits form
    $scope.update = function(formInfo) {
        
        // Copy form data 
        $scope.info = angular.copy(formInfo);
        
        // Call Ajax
        insertPersonAjax.insertPerson(angular.copy($scope.info)).then(function(result) {
        // Do something with boolean result
        });
    };
    
    

    
}]);
