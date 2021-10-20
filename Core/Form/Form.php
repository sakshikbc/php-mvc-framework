<?php

namespace MVC\Core\Form;

use MVC\Core\Model;
use MVC\Core\Form\Field;

class Form
{

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
        # code...
    }

    public static function end()
    {
        echo '</form>';
        # code...
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
        # code...
    }
}