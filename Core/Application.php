<?php

// require 'Router.php';
namespace MVC\Core;

use MVC\Core\Router;
use MVC\Core\Request;
use MVC\Core\Response;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public static $ROOT_DIR;

    /**
     * Class constructor.
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        self::$app = $this;
        $this->router = new Router($this->request, $this->response);
    }


    public function run()
    {
        echo $this->router->resolve();
    }




    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }
}

