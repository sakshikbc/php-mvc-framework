<?php

namespace MVC\Core\Form;

class TextAreaField extends BaseField
{
    public function renderInput() : string
    {
        return sprintf('
            <textarea class="form-control %s" name="%s">%s</textarea>',
            $this->model->hasError(($this->attribute) ? ' is-invalid' : ''),
            $this->attribute,
            $this->model->{$this->attribute}
        );
        # code...
    }
}