<?php

namespace MVC\Core\Middlewares;

use MVC\Core\Application;
use MVC\Core\Exceptions\ForBiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public $actions = [];

    /**
     * Class constructor.
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()) {
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions )) {
                throw new ForBiddenException();
            }
        }
    }
}