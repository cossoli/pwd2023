<?php


use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require __DIR__.'/../vendor/autoload.php';

/// *** ---- CREAMOS LA INSTANCIA DE SLIM ---- *** ///

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// ----- Agregar las Rutas de cada Controlador ------ //

require_once('../rutas/librosRoutes.php');
require_once('../rutas/socioRoutes.php');
require_once('../rutas/autoresRoutes.php');
require_once('../rutas/categoriasRoutes.php');
require_once('../rutas/generosRoutes.php');
require_once('../rutas/editorialesRoutes.php');
require_once('../rutas/prestamosRoutes.php');

$app->run(); 
