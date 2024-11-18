<?php

namespace app\core;

class View
{
    public string $path;
    public array $route;
    public string $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = "{$route['controller']}/{$route['action']}";
    }

    public function render(string $title, array $vars = []): void
    {
        if (!file_exists("app/views/{$this->path}.php")) {
            echo 'View not found: '.$this->path;
        }
        extract($vars);
        ob_start();
        require "app/views/{$this->path}.php";
        $content = ob_get_clean();
        require "app/views/layouts/{$this->layout}.php";
    }

    public function redirect($url): void
    {
        header("location: $url");
    }

    public static function errorCode($code): void
    {
        http_response_code($code);
        require "app/views/errors/{$code}.php";
    }
}
