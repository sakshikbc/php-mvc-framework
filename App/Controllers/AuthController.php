<?php

namespace MVC\App\Controllers;

use MVC\Core\Request;
use MVC\Core\Response;
use MVC\App\Models\User;
use MVC\Core\Controller;
use MVC\Core\Application;
use MVC\App\Models\LoginForm;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if($user->validate() && $user->save()) {
                
                Application::$app->session->setFlash('success', 'Thanks For Registering');
                Application::$app->response->redirect('/');
            }
            // var_dump($user->errors);

            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}