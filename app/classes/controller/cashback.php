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
class Controller_Cashback extends Controller_BaseController
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
        $this->template->content = View::forge('cashback/dashboard');
    }


    /**
     * 注册成为推荐人
     *
     * @access  public
     * @return  Response
     */
    public function action_register()
    {
        $this->template->content = \View::forge('employee/register');
    }

    /**
     * 我推荐的会员
     *
     * @access  public
     * @return  Response
     */
    public function action_members(){
        $this->template->content = \View::forge('employee/members');
    }

    /**
     * 通过我的链接预订的订单
     *
     * @access  public
     * @return  Response
     */
    public function action_orders(){
        $this->template->content = \View::forge('employee/orders');
    }
}
