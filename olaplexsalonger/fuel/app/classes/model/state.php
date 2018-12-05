<?php

class Model_State extends \Orm\Model
{

    protected static $_table_name = 'states';

    protected static $_properties = array(
        'name'       => array(
            'data_type'  => 'varchar',
            'label'      => 'Name',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 20,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 20,
            ),
        ),
        'short_name' => array(
            'data_type'  => 'varchar',
            'label'      => 'Short name',
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
    );

    protected static $_observers = array(
        'Orm\Observer_Validation' => array(
            'events' => array('before_save'),
        ),
        'Orm\Observer_Typing'     => array(
            'events' => array('before_save', 'after_save', 'after_load'),
        ),
    );

}