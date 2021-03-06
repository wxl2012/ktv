<?php
/**
 * 一元夺宝活动数据模型
 *
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_MarketingLuckOne extends \Orm\Model
{

    /**
     * @var  string  table name to overwrite assumption
     */
    protected static $_table_name = 'marketing_lucks';

    protected static $_primary_key = array('id');

    /**
     * @var array	defined observers
     */
    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'property' => 'created_at',
            'mysql_timestamp' => false
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'property' => 'updated_at',
            'mysql_timestamp' => false
        ),
        'Orm\\Observer_Self' => array(
            'events' => array('before_insert', 'before_update'),
            'property' => 'user_id'
        ),
    );

    protected static $_has_one = array(
        'parent' => array(
            'model_to' => 'Model_Marketing',
            'key_from' => 'marketing_id',
            'key_to'   => 'id'
        )
    );

    protected static $_belongs_to = [
        'goods' => [
            'model_to' => 'Model_Room',
            'key_from' => 'goods_id',
            'key_to'   => 'id'
        ],
        'win_user' =>[
            'model_to' => 'Model_People',
            'key_from' => 'win_user_id',
            'key_to'   => 'user_id'
        ]
    ];
}
