<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Auxi\Utiles\Utileria;
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
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(GeneroController::crear($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Modificar registro existente ---- //
$app->put('/apiv1/generos/{id}', function (Request $req, Response $res, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(GeneroController::actualizar($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/generos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(GeneroController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});
