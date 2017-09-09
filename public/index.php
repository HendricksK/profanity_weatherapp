<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once(DIRNAME(__FILE__) . '../../vendor/autoload.php');

require_once(DIRNAME(__FILE__) . '../../controller/class.openWeather.php');

$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
    
    $openWeather = new openWeatherController();

    $openWeather->displayOpenWeatherAPIKey();

    $response->getBody()->write($openWeather->getWeatherDataByCity('London'));

    return $response;
});

$app->get('/weather/city/{location}', function (Request $request, Response $response) {
    
    $openWeather = new openWeatherController();

    $openWeather->displayOpenWeatherAPIKey();

    $location = $request->getAttribute('location');

    $response->getBody()->write($openWeather->getWeatherDataByCity($location));

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