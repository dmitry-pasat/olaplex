<?php

class Model_Content extends \Orm\Model
{

    const CAT_ID = 5;
    const SERVICE_ID = 94;

    protected static $_table_name = 'content';

    protected static $_properties = array(
        'id',
        'parent_id',
        'title',
        'description',
        'sort_num',
        'locked',
        'icon',
        'key',
        'type',
    );

    protected static $_has_many = array(
        'children' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Content',
            'key_to'   => 'parent_id',
        ),
    );

    protected static $_has_one = array(
        'parent' => array(
            'model_to' => 'Model_Content',
            'key_from' => 'parent_id',
            'key_to'   => 'id',
        ),
    );

    protected static $_observers = array(
        'Orm\\Observer_Self'      => array(
            'events' => array('before_save'),
        ),
        'Orm\Observer_Validation' => array(
            'events' => array('before_save'),
        ),
        'Orm\Observer_Typing'     => array(
            'events' => array('before_save', 'after_save', 'after_load'),
        ),
    );

    public static function getByKey($key, $orderBy = 'title', $sort = 'asc')
    {
        $parent = self::query()->where('key', $key)->get_one();
        return self::query()->where('parent_id', $parent->id)->order_by($orderBy, $sort)->get();
    }

    public static function getCategoryOptions()
    {
        $options = array();
        foreach (self::getCategories() as $item) {
            $options[$item->id] = $item->title;
        }
        return $options;
    }

    public function getSeoTitle()
    {
        return str_replace(array(" ", "&"), array("", "_"), strtolower($this->title));
    }

    public function getCategoryUrl()
    {
        return "/category/{$this->id}/{$this->getSeoTitle()}";
    }

    public function _event_before_save()
    {
        foreach (self::$_properties as $key => $value) {
            $key = gettype($key) != "string" ? $value : $key;
            if (empty($this->{$key})) $this->{$key} = null;
        }
    }

    public function getId()
    {
        return str_replace(' ', '-', strtolower($this->title));
    }


    public static function validate($factory)
    {
        $val = Validation::forge($factory);

        $val->add_field('title', 'Title', 'required|max_length[255]');

        switch ($factory) {
            case "create":
                break;
            case "edit":
                break;
        }

        return $val;
    }

}