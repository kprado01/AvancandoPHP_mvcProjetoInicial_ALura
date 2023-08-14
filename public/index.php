<?php

require '../vendor/autoload.php';

// fazer log de todas as requisições

$rotas = require __DIR__ . '/../config/routes.php';
$caminho = $_SERVER['PATH_INFO'];

if(!array_key_exists($caminho, $rotas)){
    http_response_code(404);
    exit();
}

session_start();

$ehRotaDeLogin = stripos($caminho, 'login');

if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false) {
    header('Location: /login');
    exit();
}

$controller = new $rotas[$caminho]();
$controller->processaRequisicao();