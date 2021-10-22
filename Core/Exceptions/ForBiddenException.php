<?php

namespace MVC\Core\Exceptions;

class ForBiddenException extends \Exception
{
    protected $message = 'You Don\'t have permission to access this page';

    protected $code = 403;

    
}