<?php

namespace MVC\Core\Form;

use MVC\Core\Model;

class Field
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
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        # code...
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                <input type="%s" class="form-control %s" name="%s" value="%s">
                <div class="invalid-feedback" style="display:block">
                %s
                </div>
            </div>',
            $this->attribute,
            $this->type,
            $this->model->hasError(($this->attribute) ? ' is-invalid' : ''),
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)

        );
    }


    public function passwordField()
    {
        # code...
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

}