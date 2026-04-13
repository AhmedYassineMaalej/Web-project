<?php
namespace App;
class Router {
    protected $routes = [];

    /**
    *  @param callable(): void $controller
    */
    public function add(string $method, string $uri, callable $controller): void {
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function dispatch(string $uri, string $method): void {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && ($route['method'] === $method || $route['method'] === 'ANY')) {
                $controller =  $route['controller'];
                $controller();
                return;
            }
        }

        echo "404 Not Found";
    }
}
