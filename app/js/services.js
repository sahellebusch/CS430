/*
Author: John Foley
Date: 4.9.14
Written to access senators from the database backend
*/


/* global stugovApp, console*/



//*****************************************PERSON************************************


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

// Factory that gives info to php to insert person
// Name: insPersonAjax
// Last Modified: 4.15.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('insertPersonAjax', function ($http) {

    return {

        // Function to return person JSON
        insertPerson: function (info) {

            // PHP file that AJAX is calling
            var url = 'app/php/post/insert_person.php';

            // Return results up the line
            return $http.post(url, info);

        }

    };
});

// Factory that gives info to php to update person
// Name: updatePersonAjax
// Last Modified: 4.15.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('updatePersonAjax', function ($http) {

    return {

        // Function to return person JSON
        updatePerson: function (info) {

            // PHP file that AJAX is calling
            var url = 'app/php/post/update_person.php';

            // Return results up the line
            return $http.post(url, info);

        }

    };
});

// Factory that deletes a person record
// Name: deletePersonAjax
// Last Modified: 4.28.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('deletePersonAjax', function ($http) {

    return {

        // Function to return person JSON
        deletePerson: function (info) {

            // PHP file that AJAX is calling
            var url = 'app/php/post/delete_person.php';

            // Return results up the line
            return $http.post(url, info);

        }

    };
});

//*************************************MEETING*************************************


// Factory that gives info to php to insert a new meeting
// Name: insertMeetingAjax
// Last Modified: 4.15.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('insertMeetingAjax', function ($http) {

    return {

        // Function to return person JSON
        insertMeeting: function (type, date) {

            var info = [{
                "type": type,
                "date": date
            }];

            // PHP file that AJAX is calling
            var url = 'app/php/post/insert_meeting.php';

            // Return results up the line
            return $http.post(url, info);

        }

    };
});

// Factory that gives the meetings from the db
// Name: meetingsAjax
// Last Modified: 4.23.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('meetingsAjax', function ($http) {

    return {

        // Function to return person JSON
        getMeetings: function () {

            // PHP file that AJAX is calling
            var url = 'app/php/get/get_meetings.php';

            // Return results up the line
            return $http.post(url);

        }

    };
});

// Factory that gives info to php to update meeting
// Name: updateMeetingAjax
// Last Modified: 4.23.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('updateMeetingAjax', function ($http) {

    return {

        // Function to return person JSON
        updateMeeting: function (info) {

            // PHP file that AJAX is calling
            var url = 'app/php/post/update_meeting.php';

            // Return results up the line
            return $http.post(url, info);

        }

    };
});

//*****************************ATTENDANCE*******************************



// Factory that gives attendance for a meeting
// Name: meetingAttendanceAjax
// Last Modified: 4.24.14
// Parms/Dependencies: $http
// Returns boolean for success or failure
stugovApp.factory('meetingAttendanceAjax', function ($http) {

    return {

        // Function to return person JSON
        getMeetingAttendance: function (mid) {

            // PHP file that AJAX is calling
            var url = 'app/php/get/get_meeting_attendance.php';

            // Return results up the line
            return $http.post(url, mid);

        }

    };
});
