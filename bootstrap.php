<?php

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Universum\Router\Router;
use Universum\Router\Routes;
use Universum\Utils\StringBuilder;
use Universum\Utils\StringUtils;

require "vendor/autoload.php";

/// ENVIRONMENT SETUP

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/// ROUTE CONTROL

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$request = explode('/', $uri);

if($request[1] == "api")
{
    $method = StringUtils::lowerCase($method);
    $route = StringUtils::titleCase($request[2]);

    $controller = "Universum\\Controller\\Api\\{$route}Controller";

    if(!array_key_exists(3, $request))
    {
        http_response_code(400);
        exit(
            json_encode([
                "success" => false,
                "message" => "invalid route"
            ])
        );
    }
    else {
        $param = (array_splice($request, 3));

        if(!class_exists($controller)) {
            http_response_code(400);
            exit(
                json_encode([
                    "success" => false,
                    "message" => "route doesn't exist"
                ])
            );
        }

        /**
         * If request has body (aka. POST, PUT) send body as parameter
         */
        $input = file_get_contents('php://input');
        $data = call_user_func([new $controller, $method], $param[0], $param[1] ?? $input);

        http_response_code(200);
        if($data)
        {
            exit(
                json_encode($data)
            );
        }
    }
}
else {
    $router = new Router(Routes::getRoutes());
    $router->handle($method, $uri);
}
