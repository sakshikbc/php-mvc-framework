<?php

namespace MVC\App\Controllers;

use MVC\Core\Request;
use MVC\Core\Controller;
use MVC\App\Models\User;
use MVC\Core\Application;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
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