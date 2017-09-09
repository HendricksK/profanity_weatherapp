<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once(DIRNAME(__FILE__) . '../../vendor/autoload.php');

require_once(DIRNAME(__FILE__) . '../../controller/class.weatherController.php');

$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
    

    $response->getBody()->write('Give me your location');

    return $response;
});

$app->get('/weather/city/{location}', function (Request $request, Response $response) {
    
    $weatherController = new weatherController();

    $location = $request->getAttribute('location');

    $response->getBody()->write($weatherController->returnResponseByLocation($location));

    return $response;
});

$app->get('/ping', function (Request $request, Response $response) {
    $response->getBody()->write("pong");

    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->run();