/* global angular*/

/* Primary app js file
 * Author: John Foley
 * Date: 4.9.14
 * Last Modified: 4.9.14
*/

var stugovApp = angular.module('stugovApp', [
    'ngRoute',
    'stugovControllers'
]);

stugovApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider
    .when('/index', {
        templateUrl: 'app/js/partials/pageList.html',
        controller: 'indexCtrl'
      })
    .when('/person', {
        templateUrl: 'app/js/partials/personList.html',
        controller: 'personCtrl'
    })
    .otherwise({
        redirectTo: '/index'
      });
  }]);