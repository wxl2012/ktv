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

        if($this->getNotOpenidAllowed()){
            return;
        }

        if( ! \Auth::check() && \Uri::segment(2) != 'login'){
            \Response::redirect('/manager/login');
        }
        
        $account = \Session::get('WXAccount', false);
        $employee = \Session::get('employee', false);
        
        if( ! $employee){
            $employee = \Model_Employee::query()
                ->where([
                    'user_id' => \Auth::get_user()->id,
                    'seller_id' => $account->seller_id
                ])
                ->get_one();
            if( ! $employee){
                \Session::set_flash('msg', ['status' => 'err', 'msg' => '您无权使用该功能!', 'title' => '非法请求']);
                return $this->show_message();
            }
            \Session::set('employee', $employee);
        }

    }

}
