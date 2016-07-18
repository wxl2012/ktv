<?php
/**
 * 活动控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace api;

abstract class Controller_Marketing extends Controller_BaseController {

    protected $order = false;

    public function before(){
        parent::before();
    }
}
