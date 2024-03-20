<?php

use PhpParser\JsonDecoder;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Auxi\Utiles\Utileria;
use Raiz\Controllers\SocioController;


$app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);


// ---- RUTAS PARA TRABAJAR CON EL CONTROLADOR ---- // 
// --------------- CRUD SIMPLE -------------------- //
// ************************************************ //
// ---------- Listar todos los Registros ---------- //

$app->get('/apiv1/socios', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(SocioController::listar(), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

//  ****** ------ Buscar por Id ------- ************* //

$app->get('/apiv1/socios/{id}', function (Request $req, Response $res, array $args) {
   
    $payload = Json_Encode(SocioController::encontrarUno($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Crear nuevo regitro ---- //

$app->post('/apiv1/socios/nuevo', function (Request $req, Response $response, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(SocioController::crear($request), JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response;
});

// ---- Modificar registro existente ---- //
$app->put('/apiv1/socios/{id}', function (Request $req, Response $res, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(SocioController::actualizar($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/socios/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(SocioController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});


