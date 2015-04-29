var portfolioApp = angular.module('portfolioApp', ['ngRoute', 'ngSanitize'])
        .config(
                function($compileProvider) {
                    //Remover o unsafe: dos links
                    $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|skype):/);
                }
        );