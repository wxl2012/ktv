<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The UCenter Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_UCenter extends Controller_BaseController
{

    public $template = 'template';

    public function before() {
        parent::before();
        \Auth::force_login(1);
    }
    /**
     * 订单首页
     *
     * @access  public
     * @return  Response
     */
    public function action_orders()
    {
        $params = [
            'title' => '我的订单',
        ];

        $params['items'] = \Model_Order::query()
            ->where(['buyer_id' => \Auth::get_user()->id, 'is_deleted' => 0])
            ->get();

        \View::set_global($params);
        $this->template->content = \View::forge('order/index');
    }

    /**
     * 订单详情
     *
     * @param int $id 订单ID
     */
    public function action_order($id = 0)
    {
        $params = [
            'title' => '订单详情',
        ];

        $params['item'] = \Model_Order::find($id);

        \View::set_global($params);
        $this->template->content = \View::forge('order/view');
    }
}
