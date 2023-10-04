<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Controllers\AutorController;
use Raiz\Aux\Utiles\Prueba\Utileria;


// ---- RUTAS PARA TRABAJAR CON EL CONTROLADOR ---- // 
// --------------- CRUD SIMPLE -------------------- //
// ************************************************ //
// ---------- Listar todos los Registros ---------- //

$app->get('/apiv1/autores', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(AutorController::listar(), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

//  ****** ------ Buscar por Id ------- ************* //

$app->get('/apiv1/autores/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(AutorController::encontrarUno($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Crear nuevo regitro ---- //

$app->post('/apiv1/autores/nuevo', function (Request $request, Response $res, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(AutorController::crear($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Modificar registro existente ---- //
$app->put('/apiv1/autores/{id}', function (Request $request, Response $res, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(AutorController::actualizar($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/autores/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(AutorController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});
