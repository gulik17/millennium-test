<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    protected array $params = [];

    function __construct()
    {
        $routes_array = require 'app/config/routes.php';
        foreach ($routes_array as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add(string $route, array $params): void
    {
        $route = "#^{$route}$#";
        $this->routes[$route] = $params;
    }

    public function match(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(): void
    {
        if (!$this->match()) {
            View::errorCode(404);
        }
        $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
        if (!class_exists($path)) {
            View::errorCode(404);
        }
        $action = $this->params['action'].'Action';
        if (!method_exists($path, $action)) {
            View::errorCode(404);
        }
        $controller = new $path($this->params);
        $controller->$action();
    }

}
