<?php

class Controller_Admin_Users extends Controller_Admin
{

    public $breadcrumbs = array(
        'Users' => 'admin/users',
    );

    public function before()
    {
        parent::before();
        $this->template->navName = "users";
        $this->template->breadcrumbs = $this->breadcrumbs;
    }

    public function action_index()
    {

        $data = Common::getPagination(Uri::create('admin/users/index'), Model_User::forge());

        $this->template->set_global('title', 'Manage Users');
        $this->template->set_global('icon', "group");
        $this->template->content = $this->theme->view('users/index', $data);

    }

    public function action_create()
    {
        $val = Model_User::validate('create');

        if (!$val->run()) {
            Session::set_flash('error', Common::getErrorStr($val->error()));
        } else {
            if (!Common::isDemo()) {
                try {
                    $id = Auth::create_user($val->validated('email'), $val->validated('password'), $val->validated('email'), Model_User::USER_GROUP_ADMIN);
                    $user = Model_User::find($id);
                    $user->first_name = $val->validated('first_name');
                    $user->last_name = $val->validated('last_name');
                    $user->save();

                    //auth create
                    Session::set_flash('success', "New User Created!");
                    Response::redirect('admin/users');

                } catch (Exception $e) {
                    Session::set_flash('error', e("Could not create user. {$e->getMessage()}"));
                }
            } else {
                Session::set_flash('error', e('Saving disabled in online demo.'));
            }
        }

        $this->template->set_global('title', 'Manage Users');
        $this->template->set_global('icon', "group");

        $this->template->content = $this->theme->view('users/create', array(
            '_form' => $this->theme->view('users/_form'),
        ));

    }

    public function action_edit($id = null)
    {
        $user = Model_User::find($id);
        $val = Model_User::validate('edit');

        if (!$val->run()) {
            Session::set_flash('error', Common::getErrorStr($val->error()));
        } else {
            if (!Common::isDemo()) {
                try {
                    $data = array('email' => Input::post('email'), 'group' => 100);
                    if (Input::post('old_password') != "") {
                        $data['old_password'] = Input::post('old_password');
                        $data['password'] = Input::post('password');
                    }
                    Auth::update_user($data, $user->username);

                    $user = Model_User::find($id);
                    $user->set(array(
                        'first_name' => ucfirst(Input::post('first_name')),
                        'last_name'  => ucfirst(Input::post('last_name')),
                    ));
                    $user->save();

                    Session::set_flash('success', "User profile #{$user->id} updated.");
                    Response::redirect('admin/users');

                } catch (Exception $e) {
                    Session::set_flash('error', e("Could Not Update User #{$user->id}. {$e->getMessage()}"));
                }
            } else {
                Session::set_flash('error', e('Saving disabled in online demo.'));
            }
        }

        if (Input::method() == 'POST') {
            $user->group = $val->validated('group');
            $user->email = $val->validated('email');
        }
        $this->template->set_global('user', $user, false);

        $this->template->set_global('title', 'Update User');
        $this->template->set_global('icon', "group");

        $this->template->content = $this->theme->view('users/edit', array(
            '_form' => $this->theme->view('users/_form'),
        ));

    }

    public function action_delete($id)
    {
        if(Common::isDemo()){
            Session::set_flash('error', e('Deleting is disable in online demo'));
            Response::redirect('admin/users');
        }

        if ($id == 1) Response::redirect('admin/users');

        if ($user = Model_User::find($id)) {
            $user->delete();
            Session::set_flash('success', e('Deleted user #' . $id));
        } else {
            Session::set_flash('error', e('Could not delete user #' . $id));
        }

        Response::redirect('admin/users');

    }


}