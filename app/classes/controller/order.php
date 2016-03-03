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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Order extends Controller_BaseController
{

    public $template = 'template';
    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        return Response::forge(View::forge('welcome/index'));
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
