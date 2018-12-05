<?php

class Controller_Admin_Settings extends Controller_Admin
{

    public $breadcrumbs = array(
        'General Settings' => 'admin/settings',
    );

    public function before()
    {
        parent::before();
        $this->template->navName = "settings";
        $this->template->breadcrumbs = $this->breadcrumbs;
    }

    public function action_index()
    {
        $this->breadcrumbs[] = 'Manage';
        $this->template->set_global('breadcrumbs', $this->breadcrumbs);

        $data['settings'] = Model_Setting::query()->group_by('group')->order_by('group', 'asc')->get();


        $this->template->set_global('title', 'Manage Global Settings');
        $this->template->set_global('icon', "cogs");

        $this->template->content = $this->theme->view('settings/index', $data);

    }

    public function action_genshorturl()
    {

        $domain = Model_Domains::query()->where('url', Input::get('domain'))->get_one();
        if (!$domain) die('null');

        $url = json_encode(array(
            'price'     => Input::get('price'),
            'domain_id' => $domain->id,
        ));

        echo json_encode(array(
            'shorturl' => Model_ShortUrl::generate($url, Model_Shorturl::TYPE_REDIRECT, strtotime('+30 Days'))->getShortUrl(),
        ));
        die();
    }

    public function action_escrow()
    {
        $this->breadcrumbs[] = 'Manage';
        $this->template->set_global('breadcrumbs', $this->breadcrumbs);


        $this->template->set_global('title', 'Manage Escrow Purchase Links');
        $this->template->set_global('icon', "shield");

        $this->template->content = $this->theme->view('settings/shorturl', array());

    }


    public function action_edit($id = null)
    {
        $setting = Model_Setting::find($id);

        $val = Model_Setting::validate('edit');

        if ($val->run()) {

            if (Common::isDemo()) {
                Session::set_flash('error', e('Saving disabled in online demo.'));
                Response::redirect('admin/settings');
            }

            $setting->value = Input::post('value');

            if ($setting->save()) {
                Session::set_flash('success', e('Updated setting #' . $id));

                Response::redirect('admin/settings');
            } else {
                Session::set_flash('error', e('Could not update setting #' . $id));
            }
        } else {
            if (Input::method() == 'POST') {
                $setting->key = $val->validated('key');
                $setting->value = $val->validated('value');
                $setting->label = $val->validated('label');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('setting', $setting, false);
        }


        $this->template->set_global('title', 'Manage Global Settings');
        $this->template->set_global('icon', "cogs");
        $this->template->content = $this->theme->view('settings/edit');

    }



}