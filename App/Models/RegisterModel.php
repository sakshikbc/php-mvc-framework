<?php

namespace MVC\App\Models;

use MVC\Core\Model;

class RegisterModel extends Model
{
    public $firstname = ""; 
    public $lastname = "";
    public $email = "";
    public $password = "";
    public $confirmPassword = "";

    public function register()
    {
        echo "Creeating New User";
    }

    public function rules() : array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' =>20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

}