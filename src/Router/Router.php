<?php

namespace Universum\Router;

use Exception;
use Throwable;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since february-2023
 * @version 1.0
 */
class Router 
{
    private array $routes = [];
    
    /**
     * @method __construct
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @method handle
     * @return void
     */
    public function handle($method, $action)
    {
        try
        {
            /** 
             * Allow only the root of the uri
             * Redirect to home if Request-URI is invalid
             */
            $action = explode('?', $action)[0]; 
            
            if(!array_key_exists($action,$this->routes[$method])) {
                header("location: /");
            }

            $request    = (object) $_REQUEST;
            $controller = $this->routes[$method][$action][0];
            $action     = $this->routes[$method][$action][1];

            $controllerNamspace = "Universum\\Controller\\{$controller}";

            if(!class_exists($controllerNamspace)) {
                throw new Exception("Controller {$controllerNamspace} doesn't exist.");
            }

            $controllerInstance = new $controllerNamspace();

            if(!method_exists($controllerNamspace, $action)) {
                throw new Exception("Method {$action} from Controller {$controllerNamspace} doesn't exist.");
            }

            echo $controllerInstance->$action($request);
        }
        catch(Throwable $e)
        {
            echo $e->getMessage();
        }
    }
}
