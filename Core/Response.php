<?php

namespace MVC\Core;

class Response
{
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        # code...
        header('Location: '. $url);
    }
}