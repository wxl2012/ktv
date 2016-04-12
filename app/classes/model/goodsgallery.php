<?php
/**
 * 商品图库数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_GoodsGallery extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'goods_galleries';

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

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'attachment' => array(
			'model_to' => 'Model_Attachment',
			'key_from' => 'attachment_id',
			'key_to'   => 'id',
		),
		'goods' => array(
			'model_to' => 'Model_Goods',
			'key_from' => 'goods_id',
			'key_to'   => 'id'
		),
	);
}
