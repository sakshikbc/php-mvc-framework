<?php

namespace MVC\Core;

use MVC\Core\Application;

class Controller
{
    public $layout = "main";

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}