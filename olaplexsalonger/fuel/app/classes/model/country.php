<?php

class Model_Country extends \Orm\Model
{

    protected static $_table_name = 'countries';

    protected static $_properties = array(
        'id'           => array(
            'data_type'  => 'int',
            'label'      => 'Id',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 99999,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'iso2'         => array(
            'data_type'  => 'string',
            'label'      => 'Iso2',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 2,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 2,
            ),
        ),
        'short_name'   => array(
            'data_type'  => 'varchar',
            'label'      => 'Short name',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 80,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 80,
            ),
        ),
        'long_name'    => array(
            'data_type'  => 'varchar',
            'label'      => 'Long name',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 80,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 80,
            ),
        ),
        'iso3'         => array(
            'data_type'  => 'string',
            'label'      => 'Iso3',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 3,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 3,
            ),
        ),
        'numcode'      => array(
            'data_type'  => 'varchar',
            'label'      => 'Numcode',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 6,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 6,
            ),
        ),
        'un_member'    => array(
            'data_type'  => 'varchar',
            'label'      => 'Un member',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 12,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 12,
            ),
        ),
        'calling_code' => array(
            'data_type'  => 'varchar',
            'label'      => 'Calling code',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 8,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 8,
            ),
        ),
        'cctld'        => array(
            'data_type'  => 'varchar',
            'label'      => 'Cctld',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 5,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 5,
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
    );

    public static function getOptions()
    {
        $list = array();
        foreach (self::query()->order_by('short_name')->get() as $item) {
            $list[$item->iso2] = $item->long_name;
        }
        return $list;
    }

}