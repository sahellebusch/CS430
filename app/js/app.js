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
                controller: 'personDetailEditCtr',
                resolve: function () {
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
                }
            })
            .when('/meetings', {
    templateUrl: 'app/js/partials/meeting.html',
    controller: 'meetingCtr'
})
            .otherwise({
    redirectTo: '/index'
});
}]);