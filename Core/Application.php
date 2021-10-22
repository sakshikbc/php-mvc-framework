<?php

// require 'Router.php';
namespace MVC\Core;

use MVC\Core\Router;
use MVC\Core\Request;
use MVC\Core\Session;
use MVC\Core\Database;
use MVC\Core\Response;
use MVC\Core\View;

class Application
{
    public $layout = 'main';

    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $db;
    public ?DbModel $user;
    public Session $session;
    public View $view;
    public static $ROOT_DIR;
    public string $userClass;

    /**
     * Class constructor.
     */
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        self::$app = $this;
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->session = new Session();
        $this->view = new View();

        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue ]);
        } else {
            $this->user = null;
        }
        
    }


    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e){
            $this->response->setStatusCode(403);
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
        # code...
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

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
        // $this->response->redirect('/');
    }
}

