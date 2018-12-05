<?php

class Common
{

    public static function checkPostToken()
    {
        return Security::check_token();
    }

    public static function isDemo()
    {
        if(FUEL::$env == "demo"){
            return true;
        }
        return false;
    }

    public static function getErrorStr($errors, $break = ". ")
    {
        $message = "";
        foreach ($errors as $error) {
            $message .= "{$error->get_message()}{$break}";
        }
        return $message;
    }

    public static function setTheme($obj)
    {
        Config::load('theme', true, false, true);
        $config = Config::get('theme', false);
        $config['active'] = $config['fallback'] = $config[$obj->theme];
        $obj->theme = Theme::instance('_default_', $config);
        $obj->theme->active($config['active']);
        $obj->template = $obj->theme->set_template($obj->template);
        Casset::add_path('theme', "themes/{$config['active']}/");
    }

    public static function getPagination($url, $model)
    {
        $config = array(
            'pagination_url' => $url,
            'total_items'    => $model->search('default', Input::get())->count(),
            'per_page'       => 10,
            'uri_segment'    => 4,
        );

        $pagination = Pagination::forge('index', $config);
        $data['sort'] = in_array(Input::get('sort'), $model->getPropertyKeys()) ? Input::get('sort') : current($model->getPropertyKeys());
        $data['order'] = Input::get('order', 'desc');
        $data['total'] = $config['total_items'];

        $parts = explode("|", $data['sort']);
        $orderBy = array();
        foreach ($parts as $value) {
            $orderBy[$value] = $data['order'];
        }

        $data['items'] = $model->search('default', Input::get())->order_by($orderBy)->limit($pagination->per_page)->offset($pagination->offset)->get();
        $data['pagination'] = $pagination->render();
        return $data;
    }
}

