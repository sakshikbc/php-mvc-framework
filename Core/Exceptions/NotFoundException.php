<?php

namespace MVC\Core\Exceptions;

class NotFoundException extends \Exception
{
    protected $message = 'File Not Found';

    protected $code = 404;

    
}