<?php

namespace MVC\Core;

use MVC\Core\Request;
use MVC\Core\Response;
use MVC\App\Controllers\SiteController;
use MVC\Core\Exceptions\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;

    protected $routes = [];
    protected $params = [];

    /**
     * Class constructor.
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback == false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if(is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if(is_array($callback)) {
            // $callback[0] = new $callback[0]();
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                # code...
                $middleware->execute();
            }

        }

        // return call_user_func([SiteController::class, 'handleContact']);
        return call_user_func($callback, $this->request, $this->response);
        
    }

    
}