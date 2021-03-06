<?php

/**
 * 包房预约记录数据模型
 *
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_RoomReserve extends \Orm\Model
{

    /**
     * @var  string  table name to overwrite assumption
     */
    protected static $_table_name = 'rooms_reserves';

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
    );

    protected static $_belongs_to = array(
        'seller' => array(
            'model_to' => 'Model_Seller',
            'key_from' => 'seller_id',
            'key_to'   => 'id',
        ),
        'room' => array(
            'model_to' => 'Model_Room',
            'key_from' => 'room_id',
            'key_to'   => 'id',
        ),
        'order' => array(
            'model_to' => 'Model_Order',
            'key_from' => 'order_id',
            'key_to'   => 'id',
        )
    );

    public static $_maps = [
        'week' => [
            '0' => '星期日',
            '1' => '星期一',
            '2' => '星期二',
            '3' => '星期三',
            '4' => '星期四',
            '5' => '星期五',
            '6' => '星期六',
        ],
        'status' => [
            'NONE' => '未付款',
            'TIMEOUT' => '预订支付超时',
            'SUCCESS' => '支付成功',
            'USED' => '已使用'
        ],
        'label' => [
            'NONE' => 'warning',
            'TIMEOUT' => 'danger',
            'SUCCESS' => 'success',
            'USED' => 'primary'
        ]
    ];

    /**
     * 检查是否可预订包间
     * 
     * @param $room_id  包间
     * @param $date     预订日期
     * @return bool|string
     */
    public static function isReserve($room_id, $date){
        $room = \Model_Room::find($room_id);
        if(! $room){
            return '包间不存在';
        }

        $count = \Model_RoomReserve::getReserveCount($room_id, $date);
        if($room->total < $count){
            return '无空包可订';
        }

        return true;
    }

    /**
     * 获取某包间在某时间段的预订数量
     *
     * @param $room_id  房间ID
     * @param $date     预订时间
     * @return mixed
     */
    public static function getReserveCount($room_id, $date){
        $count = \Model_RoomReserve::query()
            ->where([
                'room_id' => $room_id
            ])
            ->where('begin_at', 'BETWEEN', [strtotime($date), strtotime("{$date} 23:59:59")])
            ->count();

        return $count;
    }
}
