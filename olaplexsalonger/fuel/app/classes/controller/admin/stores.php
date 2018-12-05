<?php

class Controller_Admin_Stores extends Controller_Admin
{

    public $breadcrumbs = array(
        'Stores' => 'admin/stores',
    );

    public function before()
    {
        parent::before();
        $this->template->navName = "stores";
        $this->template->breadcrumbs = $this->breadcrumbs;
    }

    public function action_index()
    {
        if (Input::method() == 'POST') {
            Upload::process(array(
                'path'          => DOCROOT . 'uploads',
                'randomize'     => true,
                'ext_whitelist' => array('csv'),
            ));

            if (Upload::is_valid()) {
                Upload::save();
                $file = Upload::get_files('csv_file');
                $filePath = "{$file['saved_to']}{$file['saved_as']}";
                if (($handle = fopen($filePath, "rb")) !== false) {
                    $columns = array();
                    $saved = $failed = 0;
                    while (($data = fgetcsv($handle)) !== false) {
                        if (empty($columns)) {
                            $columns = $data;
                            continue;
                        }
                        $model = Model_Store::forge();
                        foreach ($data as $key => $value) {
                            $model->set($columns[$key], $value);
                        }
                        if ($model->save()) {
                            $saved++;
                            continue;
                        }
                        $failed++;
                    }
                    fclose($handle);
                    Session::set_flash('success', "Imported {$saved}, Failed to Import {$failed}");
                } else {
                    Session::set_flash('error', 'Cannot open saved CSV file. Please check file permissions.');
                }
            }
        }

        $sTime = time();
        $data = Common::getPagination(Uri::create('admin/stores/index'), Model_Store::forge());
        $data['time'] = number_format(time() - $sTime, 2);

        $this->template->set_global('title', "Manage Stores");
        $this->template->set_global('icon', "map-marker");

        $this->template->content = $this->theme->view('stores/index', $data);

        $url = Input::protocol() . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        Session::set('redirect_url', $url);

    }

    public function action_create()
    {

        if (Input::method() == 'POST') {
            if (!Common::isDemo()) {
                $data = Input::post();
                unset($data['content']);
                $model = Model_Store::forge($data);

                Upload::process(array(
                    'path'          => DOCROOT . 'images',
                    'randomize'     => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                ));

                if(Upload::is_valid()){
                    Upload::save();
                    $model->image = Upload::get_files('image');
                }

                $model->save();

                $content = Input::post('content');
                if(is_array($content)){
                    Model_ContentToStores::insertByStoreId($content, $model->id);
                }

                Response::redirect(Session::get('redirect_url', 'admin/stores'));
            } else {
                Session::set_flash('error', e('Saving disabled in online demo.'));
            }
        }

        $this->breadcrumbs[] = 'Create';
        $this->template->set_global('breadcrumbs', $this->breadcrumbs);
        $this->template->set_global('title', 'Manage Stores');
        $this->template->set_global('icon', "map-marker");

        $this->template->content = $this->theme->view('stores/create', array(
            '_form' => $this->theme->view('stores/_form'),
        ));

    }

    public function action_edit($id = null)
    {
        $model = Model_Store::find($id);
        if (!$model) throw new HttpNotFoundException;

        if (Input::method() == 'POST') {
            if (!Common::isDemo()) {
                $oldImage = $model->image;
                $data = Input::post();
                unset($data['content']);
                $model->set($data);

                Upload::process(array(
                    'path'          => DOCROOT . 'images',
                    'randomize'     => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                ));

                if(Upload::is_valid()){
                    Upload::save();
                    $model->image = Upload::get_files('image');
                    $model->image = Uri::base(false) . "/images/{$model->image['saved_as']}";
                    //@unlink(DOCROOT."images/{$oldImage}");
                }
                $model->save();

                $content = Input::post('content');
                if(is_array($content)){
                    Model_ContentToStores::insertByStoreId($content, $model->id);
                }


                Response::redirect(Session::get('redirect_url', 'admin/stores'));
            } else {
                Session::set_flash('error', e('Saving disabled in online demo.'));
            }
        }

        $this->breadcrumbs[] = 'Edit';
        $this->template->set_global('breadcrumbs', $this->breadcrumbs);
        $this->template->set_global('title', 'Manage Stores');
        $this->template->set_global('icon', "map-marker");
        $this->template->set_global('model', $model);

        $this->template->content = $this->theme->view('stores/edit', array(
            '_form' => $this->theme->view('stores/_form'),
        ));

    }

    public function action_delete($id)
    {
        if (Common::isDemo()) {
            Session::set_flash('error', e('Deleting is disabled in online demo'));
            Response::redirect(Session::get('redirect_url', 'admin/stores'));
        }

        if ($store = Model_Store::find($id)) {
            $store->delete();
            Session::set_flash('success', e('Deleted store #' . $id));
        } else {
            Session::set_flash('error', e('Could store #' . $id));
        }

        Response::redirect(Session::get('redirect_url', 'admin/stores'));

    }


}