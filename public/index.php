<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require(DIRNAME(__FILE__) . '../../vendor/autoload.php');

require(DIRNAME(__FILE__) . '../../controller/class.weatherController.php');

$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
    

    $response->getBody()->write('Give me your location');

    return $response;
});

$app->get('/weather/city/{location}', function (Request $request, Response $response) {
    
    $weatherController = new weatherController();

    $location = $request->getAttribute('location');
    $weatherReturn = $weatherController->returnResponseByLocation($location);
    $response->getBody()->write(
        $weatherReturn['openWeatherResponse']
        . '<br>' .
        $weatherReturn['darkSkyResponse'] 
        .   '<br>' 
        .   '<span>
                <a href="https://darksky.net/poweredby/">Powered by Dark Sky</a>
            </span>'
    );

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