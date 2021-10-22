<?php

namespace MVC\Core;

use MVC\Core\Application;
use MVC\Core\Middlewares\BaseMiddleware;

class Controller
{
    public $layout = "main";
    public $action = "";
    /**
     * 
     *
     * @var MVC\Core\Middlewares\BaseMiddleware[]
     */
    protected $middlewares = [];

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware; 
    }

    /**
     * Get the value of middlewares
     *
     * @return  MVC\Core\Middlewares\BaseMiddleware[]
     */ 
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}