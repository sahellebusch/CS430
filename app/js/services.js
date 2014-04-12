/*
Author: John Foley
Date: 4.9.14
Written to access senators from the database backend
*/


/* global stugovApp, console*/

// Factory that uses $http dependency
// Name: personAjax
// Last Modified: 4.9.14
// Parms/Dependencies: $http
// Returns json of Senator information
stugovApp.factory('personAjax', function ($http) {

    return {

        // Function to return person JSON
        getPerson: function () {

            // PHP file that AJAX is calling
            var url = 'app/php/get/get_persons.php';

            // Return results up the line
            return $http.get(url);

        }

    };
});

// Factory that returns a person's info
// Name: personDetailAjax
// Last Modified: 4.11.14
// Parms/Dependencies: $http
// Returns json of person information
stugovApp.factory('personDetailAjax', function ($http) {

    return {

        // Function to return person JSON
        getPerson: function () {

            // PHP file that AJAX is calling
            var url = 'app/json/mockperson.json';

            // Return results up the line
            return $http.get(url);

        }

    };
});