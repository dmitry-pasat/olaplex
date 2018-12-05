<?php

class Controller_Admin extends Controller_BaseAdmin
{

    public $template = "template";
    public $theme = 'admin';

    public function action_login()
    {
        if (Model_User::isAdmin()) Response::redirect('admin/stores');

        if (Input::post()) {
            if (Auth::login()) {
                Response::redirect('admin/stores');
            } else {
                $this->template->set_global('login_error', 'Fail');
            }
        }
        $this->template->set('title', 'Sign In');
        $this->template->set('content', $this->theme->view('login'));
    }

    public function action_logout()
    {
        Auth::logout();
        Response::redirect('admin');
    }

    public function action_index()
    {
        Response::redirect('admin/stores');
    }

}
