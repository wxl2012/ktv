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
 * 商户管理基础控制器
 *
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

abstract class Controller_BaseController extends \Controller_BaseController
{
    public $template = 'default/template';
    public $theme = 'default';

    public function before(){
        parent::before();
    }

}