<?php
return [
    #rotas publicas
    '/' => ['HomeController', 'index'],
    '/login' => ['HomeController', 'login'],
    '/post_login' => ['AuthController', 'login'],
    '/post_register' => ['AuthController', 'register'],
    '/register' => ['HomeController', 'register'],
    '/logout' => ['AuthController', 'logout'],

    #rotas privadas
    '/dashboard' => [
        'controller' => 'DashboardController',
        'action' => 'index',
        'auth' => true
    ],

    '/logout' => [
        'controller' => 'AuthController',
        'action' => 'logout',
        'auth' => true
    ],

];
