<?php
/**
 * 基于Fuelphp的后台管理系统
 *
 * @package    admin
 * @version    1.7
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2015 - 2016 Pmonkey Development Team
 * @link       http://wangxiaolei.cn
 */

/**
 * 订单控制器
 *
 * 订单相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_Order extends Controller_BaseController
{

    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $this->template->content = \View::forge('super/order/index');
    }

    /**
     * 预订订单
     *
     * @access  public
     * @return  Response
     */
    public function action_reserve()
    {
        /*$items = \Model_Order::query()
            ->where(['is_deleted' => 0, 'order_type' => 'RESERVE']);

        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/admin/room",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = $pagination;
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();*/

        $params['items'] = [];
        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/order/reserve/index");
    }

    /**
     * 确认支付
     *
     * @access  public
     * @return  Response
     */
    public function action_pay_confirm()
    {
        $this->template->content = \View::forge('pay/pay_confirm');
    }

    /**
     * 支付状态显示
     *
     * @access  public
     * @return  Response
     */
    public function action_pay_status()
    {
        $this->template->content = \View::forge('pay/pay_status');
    }
}
