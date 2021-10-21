<?php

namespace MVC\App\Models;

use MVC\Core\DbModel;
use MVC\Core\Model;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 2;

    public $firstname = ""; 
    public $lastname = "";
    public $email = "";
    public $password = "";
    public $status = self::STATUS_INACTIVE;
    public $confirmPassword = "";

    public function tableName() : string
    {
        return 'users';
        # code...
    }

    public function attributes() : array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
        # code...
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
        // echo "Creeating New User";
    }

    public function rules() : array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class,
                'attribute' => 'email'
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' =>20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

}