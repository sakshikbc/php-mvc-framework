<?php

namespace MVC\App\Models;

use MVC\Core\Application;
use MVC\Core\Model;

class LoginForm extends Model
{

    public $email = '';
    public $password = '';

    public function rules() :array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];        
    }

    public function labels() :array
    {
        return [
            'email' => 'Your Email',
            'password' => 'YOur Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if(!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }

        if(!password_verify($this->password, $user->password)) {
            // echo password_verify($this->password, $user->password);
            $this->addError('password', 'Password is Incorrect');
            return false;
        }
        var_dump($user);

        Application::$app->login($user);
    }

    
}