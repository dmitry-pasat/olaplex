<?php

class Controller_Admin_Content extends Controller_Admin
{

    public $breadcrumbs = array(
        'Page Content' => 'admin/settings',
    );

    public function before()
    {
        parent::before();
        $this->template->navName = "content";
        $this->template->breadcrumbs = $this->breadcrumbs;
    }

    public function action_index()
    {
        $this->breadcrumbs[] = 'Manage';
        $this->template->set_global('breadcrumbs', $this->breadcrumbs);

        $data['settings'] = Model_Setting::query()->group_by('group')->order_by('group', 'asc')->get();

        $parent = Model_Content::find(Input::get('parent_id', 0));
        if ($parent) {
            $this->template->set_global('parent', $parent);
            //$this->template->navName = $parent->key;
            $this->template->navName = "content";
            $pages = Model_Content::query()->where('parent_id', $parent->id)->order_by('sort_num', 'asc')->get();
        } else {
            $pages = Model_Content::query()->where('parent_id', 'IS', DB::expr("NULL"))->get();
        }
        $this->template->set_global('pages', $pages);


        $this->template->set_global('title', 'Manage ' . ($parent ? $parent->title : "Page Content"));
        $this->template->set_global('icon', $parent ? $parent->icon : "cogs");

        $this->template->content = $this->theme->view('content/index', $data);

    }

    public function action_create()
    {
        $parent = Model_Content::find(Input::get('parent_id', Input::post('parent_id',0)));
        $this->template->set_global('parent', $parent, false);

        $val = Model_Content::validate('create');

        if(Input::method() == 'POST' && Common::isDemo()){
            Session::set_flash('error', e('Saving disabled in online demo.'));
        }

        $filePath = $error = null;
        if(Input::method() == 'POST' && $parent && $parent->type == "image" && !Common::isDemo()){

            Upload::process(array(
                'path' => DOCROOT . 'assets/img',
                'randomize' => true,
                'ext_whitelist' => array('img','jpg','jpeg','gif','png'),
            ));
            if(Upload::is_valid()){
                Upload::save();
                $file = Upload::get_files('value');
                $filePath = "/assets/img/" . $file['saved_as'];
            }else{
                $error = true;
                Session::set_flash('error', Upload::get_errors('value'));
            }
        }

        if ($val->run() && !$error && !Common::isDemo()) {

            $model = Model_Content::forge(Input::post());

            if($filePath){
                $model->description = $filePath;
            }

            if ($model->save()) {
                Session::set_flash('success', "New Content Created!");
                Response::redirect('admin/content/?parent_id=' . Input::post('parent_id'));
            } else {
                Session::set_flash('error', 'Could not save content.');
            }
        } else{
            if (Input::method() == 'POST' && !Common::isDemo()) {
                $model = Model_Content::forge(Input::post());
                Session::set_flash('error', Common::getErrorStr($val->error()));
            }

            $this->template->set_global('model', isset($model) ? $model : null, false);
        }

        $this->template->set_global('title', 'Manage ' . ($parent ? $parent->title : "Page Content"));
        $this->template->set_global('icon', $parent ? $parent->icon : "cogs");
        $this->template->content = $this->theme->view('content/create', array(
            '_form' => $this->theme->view('content/_form', array(
                    'icons' => $this->theme->view('content/icons'),
                )),
        ));

    }


    public function action_edit($id)
    {
        $model = Model_Content::find($id);

        $val = Model_Content::validate('edit');

        if(Input::method() == 'POST' && Common::isDemo()){
            Session::set_flash('error', e('Saving disabled in online demo.'));
        }

        $filePath = $error = null;
        if(Input::method() == 'POST' && $model->parent->type == "image" && !Common::isDemo()){
            Upload::process(array(
                'path' => DOCROOT . 'assets/img',
                'randomize' => true,
                'ext_whitelist' => array('img','jpg','jpeg','gif','png'),
            ));
            if(Upload::is_valid()){
                Upload::save();
                $file = Upload::get_files('value');
                $filePath = "/assets/img/" . $file['saved_as'];
            }else{
                var_dump(Upload::get_errors('value')); die();
                Session::set_flash('error', Upload::get_errors('value'));
            }
        }

        if ($val->run() && !Common::isDemo()) {

            $model->set(Input::post());

            if($filePath){
                $model->description = $filePath;
            }

            if ($model->save()) {
                Session::set_flash('success', "Content Updated!");
                Response::redirect('admin/content/?parent_id=' . $model->parent_id);
            } else {
                Session::set_flash('error', e('Could not update content #' . $id));
            }
        } else {
            if (Input::method() == 'POST' && !Common::isDemo()) {
                $model->set(Input::post());
                Session::set_flash('error', Common::getErrorStr($val->error()));
            }

        }

        $this->template->set_global('model', $model, false);
        $this->template->set_global('parent', $model->parent, false);

        $this->template->set_global('title', 'Manage ' . ($model->parent ? $model->parent->title : "Page Content"));
        $this->template->set_global('icon', $model->parent ? $model->parent->icon : "cogs");
        $this->template->content = $this->theme->view('content/create', array(
            '_form' => $this->theme->view('content/_form', array(
                    'icons' => $this->theme->view('content/icons'),
            )),
        ));

    }

    public function action_delete($id = null)
    {
        if(Common::isDemo()){
            Session::set_flash('error', e('Deleting disabled in online demo.'));
            Response::redirect('admin/content');
        }

        if ($model = Model_Content::find($id)) {
            $parentId = $model->parent_id;
            DB::delete('content')->where('id', $id)->execute();
            Session::set_flash('success', e('Deleted  #' . $id));
            Response::redirect('admin/content/?parent_id=' . $parentId);
        } else {
            Session::set_flash('error', e('Could not delete  #' . $id));
            Response::redirect('admin/content');
        }


    }


}