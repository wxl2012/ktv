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

abstract class Controller_BaseController extends \Controller_BaseController
{
    public $template = 'super/template';
    public $theme = 'super';

    public function before(){
        parent::before();

        \Auth::force_login(1);
    }

}
