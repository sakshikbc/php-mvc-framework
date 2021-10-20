<?php

namespace MVC\App\Controllers;

use MVC\Core\Request;
use MVC\Core\Controller;
use MVC\App\Models\RegisterModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModal = new RegisterModel();

        if ($request->isPost()) {
            $registerModal->loadData($request->getBody());
            if($registerModal->validate() && $registerModal->register()) {
                return "Success";
            }
            // var_dump($registerModal->errors);

            return $this->render('register', [
                'model' => $registerModal
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModal
        ]);
    }
}