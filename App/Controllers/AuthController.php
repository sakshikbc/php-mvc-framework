<?php

namespace MVC\App\Controllers;

use MVC\Core\Controller;
use MVC\Core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return "Handling Register Data";
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}