app.directive('myHref', function() {
    return {
        restrict: 'AE',
        link: function($scope, element, attrs) {
            var docPath = 'uploads/' + $scope.slpOutcome.actualId + '.' + $scope.slpOutcome.outcome.split('.').pop();
            element.attr("href", docPath);
        }
    }
});
