app.factory('SlpService', function($resource, $http, $q) {

    var getSlpOutcomes = function(studentId, skillDescriptorId) {
        var deferred = $q.defer();

        $resource('api/index.php/slpOutcomes/:param', {param:'@param'})
            .query({param:studentId + '|' + skillDescriptorId}, function(slpOutcomes){
                deferred.resolve(slpOutcomes);
            });

        return deferred.promise;
    };

    var postSlpOutcome = function(jsonData) {
        return  $http({
            method:  'PUT',
            url:     'api/index.php/slpOutcome',
            data:    jsonData
        });

    };

    var deleteSlpDocument = function(jsonData) {
        return $http({
            method:  'DELETE',
            url:     'api/index.php/slpDocument',
            data:    jsonData
        });
    };

    return {
        getCurrentDate: function() {
            return getCurrentDate();
        },
        getSlpOutcomes: function(studentId, skillDescriptorId) {
            return getSlpOutcomes(studentId, skillDescriptorId);
        },
        postSlpOutcome: function(jsonData) {
            return postSlpOutcome(jsonData);
        },
        postSlpComment: function(jsonData) {
            return postSlpComment(jsonData);
        },
        postFuture: function(jsonData) {
            return postFuture(jsonData);
        },
        deleteSlpDocument: function(jsonData) {
            return deleteSlpDocument(jsonData);
        }
    }
});
