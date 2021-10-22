<?php

namespace MVC\Core\Form;

use MVC\Core\Model;

class Field extends BaseField
{
    public const TYPE_TEXT = "text";
    public const TYPE_PASSWORD = "password";
    public const TYPE_NUMBER = "number";

    public $type;
    public Model $model;
    public string $attribute;
    

    /**
     * Class constructor.
     */
    public function __construct(Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    

    public function passwordField()
    {
        # code...
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('
        <input type="%s" class="form-control %s" name="%s" value="%s">
        ', 
        $this->type,
        $this->model->hasError(($this->attribute) ? ' is-invalid' : ''),
        $this->attribute,
        $this->model->{$this->attribute});
    }
}