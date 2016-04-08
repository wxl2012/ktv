<?php

class Model_Category extends \Orm\Model_Nestedset {

    protected static $_table_name = 'categories';

    protected static $_primary_key = array('id');


    protected static $_tree = array(
        'left_field' => 'lft',
        'right_field' => 'rgt',
        'tree_field' => 'tree',
        'title_field' => 'name',
    );

    /**
     * @var array	defined observers
     */
    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'property' => 'created_at',
            'mysql_timestamp' => false,
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'property' => 'updated_at',
            'mysql_timestamp' => false,
        )
    );

    /**
     * @var array	has_many relationships
     */
    protected static $_has_many = array(
        'rooms' => array(
            'model_to' => 'Model_Room',
            'key_from' => 'id',
            'key_to'   => 'category_id'
        )
    );
}
