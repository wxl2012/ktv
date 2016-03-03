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
 * 后台管理默认控制器
 *
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_Home extends Controller_BaseController
{

    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $this->template->content = \View::forge('super/dashboard');
    }

    /**
     * 确认支付
     *
     * @access  public
     * @return  Response
     */
    public function action_404()
    {
        $this->template->content = \View::forge('super/public/404');
    }
}
