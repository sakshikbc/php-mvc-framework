<?php

namespace MVC\Core;

use MVC\Core\Application;

class Render
{
    public static function view($view)
    {
        return (new static)->renderView($view);
    }

    public function renderView($view)
    {
        $layoutContent =  $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}