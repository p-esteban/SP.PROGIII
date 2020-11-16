<?php

use App\Controllers\UsuarioController;
use App\Controllers\MateriaController;
use App\Controllers\InscripcionController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Config\Database;
use App\Middlewares\JsonMiddleware;
use App\Middlewares\AuthMiddleware;



require __DIR__ . '/../vendor/autoload.php';


$conn = new Database;
$app = AppFactory::create();
$app->setBasePath('/SP.PROGIII/skeleton/public'); /// aca hay que corregir


//$app->post('/singIn',)


$app->group('/users', function (RouteCollectorProxy $group) {

    $group->get('[/]', UsuarioController::class . ":getAll")
    ->add(new AuthMiddleware(['admin']));
    $group->get('/{id}', UsuarioController::class . ":getOne")
    ->add(new AuthMiddleware(['user','admin']));
    
    //$group->get('[/]', UsuarioController::class . ":login");
    
    $group->post('[/]', UsuarioController::class . ":addOne");
    
    $group->post('/login', UsuarioController::class . ":login");

   // $group->put('/{id}', UsuarioController::class . ":update");

    $group->delete('/{id}', UsuarioController::class . ":deleteOne");

})->add(new JsonMiddleware());
$app->group('/login', function (RouteCollectorProxy $group) {
    $group->post('[/]', UsuarioController::class . ":login");
})->add(new JsonMiddleware());
$app->group('/materia', function (RouteCollectorProxy $group) {
    $group->post('[/]', MateriaController::class . ":addOne")->add(new AuthMiddleware(['admin']));
})->add(new JsonMiddleware());

$app->group('/inscripcion', function (RouteCollectorProxy $group) {
    $group->post('/{id}', InscripcionController::class . ":addOne")->add(new AuthMiddleware(['alumno']));
})->add(new JsonMiddleware());


//$app->addBodyParsingMiddleware();
$app->run();
