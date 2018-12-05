<?php

class Model_Setting extends \Orm\Model
{

    protected static $_table_name = 'settings';

    protected static $_properties = array(
        'id'         => array(
            'data_type'  => 'int',
            'label'      => 'Id',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'key'        => array(
            'data_type'  => 'varchar',
            'label'      => 'Key',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'value'      => array(
            'data_type'  => 'text',
            'label'      => 'Value',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 65535,
                ),
            ),
            'form'       => array(
                'type' => 'textarea',
            ),
        ),
        'label'      => array(
            'data_type'  => 'varchar',
            'label'      => 'Label',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'type'       => array(
            'data_type'  => 'varchar',
            'label'      => 'Type',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'group'      => array(
            'data_type'  => 'varchar',
            'label'      => 'Group',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'created_at' => array(
            'data_type'  => 'int',
            'label'      => 'Created at',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'updated_at' => array(
            'data_type'  => 'int',
            'label'      => 'Updated at',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
    );

    protected static $_observers = array(
        'Orm\Observer_Validation' => array(
            'events' => array('before_save'),
        ),
        'Orm\Observer_Typing'     => array(
            'events' => array('before_save', 'after_save', 'after_load'),
        ),
        'Orm\Observer_CreatedAt'  => array(
            'events'          => array('before_insert'),
            'mysql_timestamp' => false,
            'property'        => 'created_at',
        ),
        'Orm\Observer_UpdatedAt'  => array(
            'events'          => array('before_save'),
            'mysql_timestamp' => false,
            'property'        => 'updated_at',
        ),
    );

    public static function getValueByKey($key)
    {
        $setting = self::query()->where('key', $key)->get_one();
        if ($setting) return $setting->value;
        return null;
    }

    public function parseValue()
    {
        switch ($this->type) {
            case "json":
                $this->value = json_decode($this->value);
                break;
        }
    }

    public static function getMapSettings()
    {
        $list = array();
        foreach (self::query()->where('group', 'Map Settings')->get() as $item) {
            $item->parseValue();
            $list[$item->key] = $item->value;
        }
        return $list;
    }

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('value', 'Value', 'required');
        return $val;
    }

}