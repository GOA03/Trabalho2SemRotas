<?php
require "vendor/autoload.php";

use Pecee\SimpleRouter\SimpleRouter as Router;

// Verificação inicial para redirecionar baseado no estado de login.
Router::get('/', function() {
    // Se estiver autenticado, redireciona para a lista de receitas.
    if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
        require 'views/listar.view.php';
    } else { // Se não, redireciona para o login.
        require 'views/login.view.php';
    }
});

// Rotas de Login e Logout
Router::get('/login', function() {
    require 'views/login.view.php';
});
Router::post('/login', 'LoginController@authenticate');
Router::get('/logout', 'LoginController@logout');

// Rotas de Receitas
Router::get('/receitas', 'ReceitasController@listar');
Router::get('/receitas/adicionar', 'ReceitasController@adicionar');
Router::post('/receitas/adicionar', 'ReceitasController@adicionar');

Router::start();
