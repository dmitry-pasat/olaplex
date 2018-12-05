<?php

class Controller_Base extends Controller
{

    public $template = "locator/template";
    public $theme = 'default';

    public function before()
    {
        parent::before();
        Common::setTheme($this);
    }

    public function after($response)
    {
        if (empty($response) or !$response instanceof Response) {
            $response = \Response::forge(\Theme::instance()->render());
        }
        return parent::after($response);
    }

}