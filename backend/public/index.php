<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
header('Access-Control-Allow-Origin: http://192.168.20.25:8080');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Allow: GET, POST, PUT, DELETE, OPTIONS");

//header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");

// This middleware will append the response header Access-Control-Allow-Methods with all allowed methods

// The RoutingMiddleware should be added after our CORS middleware so routing is performed first
$app->addRoutingMiddleware();


// ----- Agregar las Rutas de cada Controlador ------ //

require_once('../rutas/librosRoutes.php');
require_once('../rutas/socioRoutes.php');
require_once('../rutas/autoresRoutes.php');
require_once('../rutas/categoriasRoutes.php');
require_once('../rutas/generosRoutes.php');
require_once('../rutas/editorialesRoutes.php');
require_once('../rutas/prestamosRoutes.php');

$app->run(); 
