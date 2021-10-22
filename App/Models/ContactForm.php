<?php

namespace MVC\App\Models;

use MVC\Core\Model;

class ContactForm extends Model
{
    public $subject = '';
    public $body = '';
    public $email  = '';

    public function rules() : array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels() : array
    {
        return [
            'subject' => 'Enter Your Subject',
            'email' => 'Enter Your Email',
            'body' => 'Enter Your Message',
        ];
    }

    public function send()
    {
        # code...
        return true;
    }

}