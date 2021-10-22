<?php

namespace MVC\Core;

use MVC\Core\Request;
use MVC\Core\Response;
use MVC\App\Controllers\SiteController;


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
            return $this->renderView("_404");
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
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

    public function renderView($view, $params = [])
    {
        $layoutContent =  $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller ) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        };
        // var_dump($name);
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    protected function renderContent($viewContent)
    {
        $layoutContent =  $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    
}