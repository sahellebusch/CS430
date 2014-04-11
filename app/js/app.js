/* global angular*/

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
stugovApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider
    .when('/index', {
        templateUrl: 'app/js/partials/pageList.html',
        controller: 'indexCtr'
      })
    .when('/person', {
        templateUrl: 'app/js/partials/personList.html',
        controller: 'personCtr'
    })
    .when('/meetings', {
        templateUrl: 'app/js/partials/meeting.html',
        controller: 'meetingCtr'
    })
    .otherwise({
        redirectTo: '/index'
      });
  }]);