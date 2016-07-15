<?php
/**
 * 订单数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_Order extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'orders';

	protected static $_primary_key = array('id');

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'buyer' => array(
			'model_to' => 'Model_People',
			'key_from' => 'buyer_id',
			'key_to'   => 'parent_id',
		),
		'seller' => array(
			'model_to' => 'Model_Seller',
			'key_from' => 'from_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
		'payment' => array(
			'model_to' => 'Model_Bank',
			'key_from' => 'payment_id',
			'key_to'   => 'id'
		),
	);

	/**
	 * @var array	has_many relationships
	 */
	protected static $_has_many = array(
		'details' => array(
			'model_to' => 'Model_OrderDetail',
			'key_from' => 'id',
			'key_to'   => 'order_id',
		),
		/*'trades' => array(
			'model_to' => 'Model_OrderTrade',
			'key_from' => 'id',
			'key_to'   => 'order_id',
		)*/
	);

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
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load', 'before_save', 'after_save')
		),
		'Orm\\Observer_Self' => array(
			'events' => array('before_insert'),
			'property' => 'user_id'
		),
	);

	public static $_maps = array(
		'type' => array(
			'NONE' => '无类型',
			'SELL' => '销售单',
			'PURCHASE' => '进货单',
			'DELIVER' => '出库单',
			'STORAGE' => '入库单',
			'RETURNED' => '退货单',
			'BARTER' => '换货单',
			'INVOICE' => '发货单',
			'BOOK' => '预约单',
			'REFUND' => '退款',
			'RECHARGE' => '充值',
			'TAKEAWAY' => '外卖单',
		),
		'status' => array(
			'NONE' => '无状态',
			'WAIT_PAYMENT' => '待支付',
			'PAYMENT_ERROR' => '支付失败',
			'PAYMENT_SUCCESS' => '支付完成',
			'SELLER_CANCEL' => '商户取消',
			'USER_CANCEL' => '用户取消',
			'WAIT_SURE' => '待确认',
			'SURE' => '确认',
			'WAIT_SHIPPED' => '待发货',
            'SHIPPED' => '已发货',
            'FORRECEIVABLES' =>  '待收款',
            'REFUNDMENT' =>  '退款中',
			'RECEIVED' => '已签收',
			'CHECKED' => '核对完成',
			'SYSTEM_STOP' => '系统中止',
			'FINISH' => '已完成',
			'BUYER_CANCEL' => '买家取消',
			'SELLER_WAIT_SURE' => '待商户确认',
			'BUYER_WAIT_SURE','待买家确认',
			'BUYER_RECEIVED' => '购买已收货',
			'SECTION_FINISH' => '部分完成',
			'SECTION_WAIT_SURE' => '部分待确认'
		),
		'payment' => array(
			'NONE' => '未指定',
			'alipay' => '支付宝',
			'tenpay' => '财付通',
			'bank' => '网银',
			'paypal' => '贝宝(Paypal)',
			'card' => '游戏点卡/手机充值卡',
			'balance' => '会员帐户余额',
			'offline' => '现金',
			'peerpay' => '代付'
		),
		'labels' => array(
			'NONE' => 'default',
			'WAIT_PAYMENT' => 'warning',
			'PAYMENT_ERROR' => 'danger',
			'PAYMENT_SUCCESS' => 'success',
			'SELLER_CANCEL' => 'danger',
			'USER_CANCEL' => 'danger',
			'WAIT_SURE' => 'warning',
			'SURE' => 'info',
			'WAIT_SHIPPED' => 'warning',
			'SHIPPED' => 'info',
			'FORRECEIVABLES' =>  'warning',
			'REFUNDMENT' =>  'danger',
			'RECEIVED' => 'primary',
			'CHECKED' => 'primary',
			'SYSTEM_STOP' => 'danger',
			'FINISH' => 'success'
		)
	);

	/**
	 * before_insert observer event method
	 */
	public function _event_before_insert()
	{
		// assign the user id that lasted updated this record
		if(! $this->user_id){
			$this->user_id = ($this->user_id = \Auth::get_user_id()) ? $this->user_id[1] : 0;
		}
		
	}

	/**
	 * before_update observer event method
	 */
	public function _event_before_update()
	{
		$this->_event_before_insert();
	}

	/**
	 * 统计某时间实际收入金额
	 *
	 * @param $begin 开始时间
	 * @param $end	结束时间
	 */
	public static function get_fee($begin, $end){
		$sql = <<<sql
SELECT SUM(original_fee) AS fee FROM orders
 WHERE created_at BETWEEN {$begin} AND {$end}
 	AND order_status IN('PAYMENT_SUCCESS', 'FINISH')
sql;
		$result = \DB::query($sql)->execute()->as_array();
		return current($result)['fee'];
	}

	/**
	 * 分组统计某时段实际收入金额
	 *
	 * @param $begin 开始时间
	 * @param $end	结束时间
	 */
	public static function get_fee_group($begin, $end){
		$beginAt = date('Y-m-d H:i:s', $begin);
		$endAt = date('Y-m-d H:i:s', $end);
		$sql = <<<sql
SELECT o.from_id, s.name, 
	'{$beginAt} - {$endAt}' AS `span`,
	SUM(total_fee) AS total_fee, 
	SUM(original_fee) AS original_fee, 
	SUM(preferential_fee) AS preferential_fee
 FROM orders AS o 
 	LEFT JOIN sellers AS s ON o.from_id = s.id
 WHERE o.created_at BETWEEN {$begin} AND {$end}
 	AND order_status IN('PAYMENT_SUCCESS', 'FINISH')
 GROUP BY from_id
sql;

		$result = \DB::query($sql)->execute()->as_array();
		return $result;
	}
}
