/* global angular, console*/

/* Primary app js file
 * Author: John Foley
 * Date: 4.9.14
 * Last Modified: 4.9.14
 */

// Primary app initilization
var stugovApp = angular.module('stugovApp', [
    'ngRoute',
    'stugovControllers'
]);

// Configure routing for each partial page
stugovApp.config(['$scope', '$routeProvider', 'personAjax',
  function ($scope, $routeProvider, personAjax) {
        $routeProvider
            .when('/index', {
                templateUrl: 'app/js/partials/front.html',
                controller: 'frontCtr'
            })
            .when('/person', {
                templateUrl: 'app/js/partials/person.html',
                controller: 'personCtr'
            })
            .when('/person/:pid', {
                templateUrl: 'app/js/partials/personDetail.html',
                controller: 'personDetailCtr'
            })
            .when('/person/edit/:pid', {
                templateUrl: 'app/js/partials/personDetailEdit.html',
                controller: 'personDetailEditCtr'
            })
            .when('/meetings', {
                templateUrl: 'app/js/partials/meeting.html',
                controller: 'meetingCtr'
            })
            .otherwise({
                redirectTo: '/index'
            });
}]);