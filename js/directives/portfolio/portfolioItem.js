'use strict';

portfolioApp.directive('portfolioItem', function() {
    return {
        restrict: 'E',
        replace: true,
        templateUrl: '/templates/directives/portfolio/portfolioItem.html'
    };
});