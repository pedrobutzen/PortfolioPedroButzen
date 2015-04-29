portfolioApp.config(
        function($routeProvider, $locationProvider) {
            $routeProvider.
                    when('/',
                            {
                                redirectTo: '/sobre'
                            })
                    .when('/sobre',
                            {
                                title: 'Sobre | Pedro Butzen',
                                templateUrl: 'templates/Sobre.html',
                                controller: 'SobreController'
                            })
                    .when('/portfolio',
                            {
                                title: 'Portfolio | Pedro Butzen',
                                templateUrl: 'templates/Portfolio.html',
                                controller: 'PortfolioListController'
                            })
                    .when('/portfolio/:portfolioId',
                            {
                                title: 'Portfolio | Pedro Butzen',
                                templateUrl: 'templates/PortfolioDetalhes.html',
                                controller: 'PortfolioController',
                                resolve: {
                                    portfolioId: function($route) {
                                        return $route.current.pathParams.portfolioId;
                                    }
                                }
                            })
                    .when('/contato',
                            {
                                title: 'Contato | Pedro Butzen',
                                templateUrl: 'templates/Contato.html',
                                controller: 'ContatoController'
                            })
                    .otherwise({redirectTo: '/sobre'});
            //$locationProvider.html5Mode(true);
        }
);