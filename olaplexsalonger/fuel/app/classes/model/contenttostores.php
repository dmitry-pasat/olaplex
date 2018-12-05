<?php

class Model_ContentToStores extends \Orm\Model
{

    protected static $_table_name = 'content_to_stores';

    protected static $_properties = array(
        'id',
        'content_id',
        'content_parent_id',
        'store_id',
    );

    protected static $_has_one = array(
        'store'         => array(
            'model_to' => 'Model_Store',
            'key_from' => 'store_id',
            'key_to'   => 'id',
        ),
        'content'       => array(
            'model_to' => 'Model_Content',
            'key_from' => 'content_id',
            'key_to'   => 'id',
        ),
        'parentContent' => array(
            'model_to' => 'Model_Content',
            'key_from' => 'parent_content_id',
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

    public static function deleteByStoreId($id)
    {
        DB::delete(self::$_table_name)->where('store_id', $id)->execute();
    }

    public static function insertByStoreId($content, $id, $deleteExisting = true)
    {
        if($deleteExisting) self::deleteByStoreId($id);
        foreach($content as $cId){
            $item = Model_Content::find($cId);
            if(!$item) continue;
            $model = self::forge(array(
                'store_id' => $id,
                'content_id' => $cId,
                'content_parent_id' => $item->parent_id,
            ));
            $model->save();
        }
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

    }

}