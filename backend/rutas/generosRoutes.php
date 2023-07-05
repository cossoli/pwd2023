<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Controllers\GeneroController;



// ---- RUTAS PARA TRABAJAR CON EL CONTROLADOR ---- // 
// --------------- CRUD SIMPLE -------------------- //
// ************************************************ //
// ---------- Listar todos los Registros ---------- //

$app->get('/apiv1/generos', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(GeneroController::listar(), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

//  ****** ------ Buscar por Id ------- ************* //

$app->get('/apiv1/generos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(GeneroController::encontrarUno($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Crear nuevo regitro ---- //

$app->post('/apiv1/generos/nuevo', function (Request $req, Response $res, array $args) {
    var_dump($req->getQueryParams());
    $payload = Json_Encode(GeneroController::crear($req->getQueryParams()), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Modificar registro existente ---- //
$app->put('/apiv1/generos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(GeneroController::actualizar($req->getQueryParams()), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/generos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(GeneroController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});
