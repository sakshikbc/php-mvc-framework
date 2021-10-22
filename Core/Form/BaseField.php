<?php

namespace MVC\Core\Form;

use MVC\Core\Model;

abstract class BaseField
{

    public Model $model;
    public string $attribute;
    abstract public function renderInput() : string;

    /**
     * Class constructor.
     */
    public function __construct(Model $model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        # code...
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback" style="display:block">
                %s
                </div>
            </div>',
            $this->model->getLabel($this->attribute) ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)

        );
    }

}