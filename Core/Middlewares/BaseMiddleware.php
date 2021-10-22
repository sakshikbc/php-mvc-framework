<?php

namespace MVC\Core\Middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}