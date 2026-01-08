<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

$map = [
    'plataformas' => 'PlataformasController',
    'idiomas'     => 'IdiomasController',
    'actores'     => 'ActoresController',
    'directores'  => 'DirectoresController',
    'series'      => 'SeriesController',
];

if (!isset($map[$controller])) {
    die("Controller no válido");
}

$controllerClass = $map[$controller];
$controllerFile  = __DIR__ . "/controllers/$controllerClass.php";

require_once $controllerFile;

$obj = new $controllerClass();

if (!method_exists($obj, $action)) {
    die("Action no válida");
}

$obj->$action();
