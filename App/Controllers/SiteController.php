<?php

namespace MVC\App\Controllers;

use MVC\Core\Application;
use MVC\Core\Controller;
use MVC\Core\Request;

class SiteController extends Controller
{
    public function handleContact(Request $request)
    {
        // $body = Application::$app->request->getBody();
        $body = $request->getBody();
        var_dump($body);
        return "Handling";
    }

    public function contact()
    {
        return $this->render('contact');
        // return Application::$app->router->renderView('contact');
        // return \view('contact');
    }

    public function home()
    {
        $params = [
            'name' => "Sakshi Kbc"
        ];
        return $this->render('home', $params);
        // return Application::$app->router->renderView('home', $params);
        // return \view('contact');
    }


    
}