portfolioApp.controller('SobreController', ['$scope', '$http',
    function SobreController($scope, $http) {
        $scope.sobre = {descricao: ""};

        $http.get('webservice/?page=sobre').
                success(function(data) {
                    $scope.sobre.descricao = data.descricao;
                }).
                error(function(data, status, headers, config) {
                    alert("Erro ao listar!");
                });
    }]);