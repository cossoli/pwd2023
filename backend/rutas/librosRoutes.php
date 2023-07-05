<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Controllers\LibroController;



// ---- RUTAS PARA TRABAJAR CON EL CONTROLADOR ---- // 
// --------------- CRUD SIMPLE -------------------- //
// ************************************************ //
// ---------- Listar todos los Registros ---------- //

$app->get('/apiv1/libros', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(LibroController::listar(), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

//  ****** ------ Buscar por Id ------- ************* //

$app->get('/apiv1/libros/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(LibroController::encontrarUno($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Crear nuevo regitro ---- //

$app->post('/apiv1/libros/nuevo', function (Request $req, Response $res, array $args) {
    var_dump($req->getQueryParams());
    $payload = Json_Encode(LibroController::crear($req->getQueryParams()), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Modificar registro existente ---- //
$app->put('/apiv1/libros/actualizar/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(LibroController::actualizar($req->getQueryParams()), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

$app->put('/apiv1/libros/{id}/actualizarestado', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(LibroController::actualizar($req->getQueryParams()), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/libros/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(LibroController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});
