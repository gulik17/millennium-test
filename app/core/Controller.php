<?php

namespace app\core;

abstract class Controller
{
    public array $route;
    public View $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
}
