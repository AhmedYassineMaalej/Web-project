<?php
namespace App;

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller) {
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function dispatch($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                [$class, $function] = explode('@', $route['controller']); //like split in python
                $controller = new $class();
                return $controller->$function();
            }
        }

        echo "404 Not Found";
    }
}