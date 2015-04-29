portfolioApp.controller('ContatoController', ['$scope', '$http',
    function ContatoController($scope, $http) {
        $scope.contato = {};

        $http.get('webservice/?page=contato').
                success(function(data) {
                    $scope.contato = data;
                }).
                error(function(data, status, headers, config) {
                    alert("Erro ao listar!");
                });

        $scope.sendInput = function(form) {
            console.log(form.$valid)
            if (form.$valid) {
                $http.post('webservice/?page=contato', $scope.inputContato).
                        success(function(data) {
                            alert_open("Enviado com sucesso.");
                            $scope.inputContato = "";
                        }).
                        error(function(data, status, headers, config) {
                            alert("Erro ao enviar!");
                        });
            }

        };
    }]);