portfolioApp.controller('PortfolioListController', ['$scope', '$http', '$filter',
    function PortfolioListController($scope, $http, $filter) {
        $scope.portfolio = {descricao: "", itens: {}};

        $http.get('webservice/?page=portfolio').
                success(function(data) {
                    $scope.portfolio.descricao = data.descricao;
                }).
                error(function(data, status, headers, config) {
                    alert("Erro ao listar!");
                });
        $http.get('webservice/').
                success(function(data) {
                    $scope.portfolio.itens = data;
                }).
                error(function(data, status, headers, config) {
                    alert("Erro ao listar!");
                });
    }]);