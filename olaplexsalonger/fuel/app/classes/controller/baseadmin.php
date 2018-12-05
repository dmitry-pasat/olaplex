<?php

class Controller_BaseAdmin extends Controller
{

    public function checkAuth()
    {
        if (!Model_User::isAdmin()) {
            Model_User::logout();
        }
    }

    public function before()
    {
        parent::before();
        Common::setTheme($this);

        if (Uri::string() != "admin/login") {
            $this->checkAuth();
        }

        $this->currentUser = Model_User::getCurrent();
        View::set_global('current_user', $this->currentUser);
    }

    public function after($response)
    {
        if (empty($response) or !$response instanceof Response) {
            $response = \Response::forge(\Theme::instance()->render());
        }
        return parent::after($response);
    }

}