<?php
namespace App;
class Router {
    protected $routes = [];

    public function add(string $method, string $uri, string $controller): void {
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function dispatch(string $uri, string $method): void {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && ($route['method'] === $method || $route['method'] === 'ANY')) {
                [$class, $function] = explode('@', $route['controller']);
                $controller = new $class();
                $controller->$function();
                return;
            }
        }

        echo "404 Not Found";
    }
}
