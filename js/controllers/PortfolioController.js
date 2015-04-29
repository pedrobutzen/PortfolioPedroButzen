portfolioApp.controller('PortfolioController', ['$scope', '$http', '$filter', '$route',
    function PortfolioController($scope, $http, $filter, $route) {
        $http.get('webservice/?page=portfolio&&id=' + $route.current.locals.portfolioId).
                success(function(data) {
                    $scope.item = data;
                }).
                error(function(data, status, headers, config) {
                    alert("Erro ao listar!");
                });
    }]);