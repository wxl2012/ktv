<?php

class Model_Attachment extends \Orm\Model {

    protected static $_table_name = 'attachments';

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
        ),
        'Orm\\Observer_Typing' => array(
            'events' => array('after_load', 'before_save', 'after_save'),
        ),
        'Orm\\Observer_Self' => array(
            'events' => array('before_insert', 'before_update'),
            'property' => 'user_id',
        ),
    );

    /**
     * @var array	has_many relationships
     */
    protected static $_has_many = array(
        'roomquote' => array(
            'model_to' => 'Model_RoomGallery',
            'key_from' => 'id',
            'key_to'   => 'parent_id',
            'cascade_delete' => true,
        )
    );

    /**
     * before_insert observer event method
     */
    public function _event_before_insert()
    {
        // assign the user id that lasted updated this record
        //$this->user_id = 0;
    }

    /**
     * before_update observer event method
     */
    public function _event_before_update()
    {
        $this->_event_before_insert();
    }
}
