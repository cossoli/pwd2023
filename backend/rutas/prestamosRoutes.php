<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Raiz\Auxi\Utiles\Utileria;
use Raiz\Controllers\PrestamoController;




// ---- RUTAS PARA TRABAJAR CON EL CONTROLADOR ---- // 
// --------------- CRUD SIMPLE -------------------- //
// ************************************************ //
// ---------- Listar todos los Registros ---------- //

$app->get('/apiv1/prestamos', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(PrestamoController::listar(), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

//  ****** ------ Buscar por Id ------- ************* //

$app->get('/apiv1/prestamos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(PrestamoController::encontrarUno($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Crear nuevo regitro ---- //


$app->post('/apiv1/prestamos/nuevo', function (Request $req, Response $res, array $args) {
    
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(PrestamoController::crear($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});



// ---- Modificar registro existente ---- //
$app->put('/apiv1/prestamos/{id}', function (Request $req, Response $res, array $args) {
    $request = Utileria::PasarAJson(file_get_contents('php://input'));
    $payload = Json_Encode(PrestamoController::actualizar($request), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});

// ---- Borrar registro existente ---- //

$app->delete('/apiv1/prestamos/{id}', function (Request $req, Response $res, array $args) {
    $payload = Json_Encode(PrestamoController::borrar($args["id"]), JSON_PRETTY_PRINT);
    $res->getBody()->write($payload);
    return $res->withHeader("Content-Type", "application/json");
});



