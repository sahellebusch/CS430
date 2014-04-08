/* global app */

app.factory('personAjax', function($http) {

    
    //return the promise directly.
    var ex = {};

    ex.name = ['john', 'sean'];

    return ex;
});