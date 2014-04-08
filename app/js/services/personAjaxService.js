app.factory('personAjax', function($http) {
   return {
        getPerson: function() {
             //return the promise directly.
             return $http.get($scope.url)
            .then(function(result) {

                // Place data into scope
                $scope.persons = result.result;

            });
   };
});