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
 * 默认控制器
 *
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

class Controller_Home extends Controller_BaseController
{

    /**
     * 商家中心
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        
        $seller = \Session::get('seller', false);
        if( ! $seller){
            \Session::set_flash('msg', ['msg' => '您无权操作该功能！', 'title' => '非法请求', 'status' => 'err']);
            return $this->show_message();
        }

        $params = [
            'title' => '管理中心',
            'seller' => $seller
        ];

        $params['reserver_count'] = \Model_RoomReserve::query()
            ->where([
                'seller_id' => $seller->id
            ])
            ->where('status', '<>', 'NONE')
            ->count();
        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/index");
    }

    public function action_login(){

        if(\Input::method() == 'POST'){
            $msg = ['status' => 'err', 'msg' => '用户名或密码错误！', 'errcode' => 10];
            if(\Auth::login()){
                $employee = \Model_Employee::query()
                    ->where([
                        'user_id' => \Auth::get_user()->id
                    ])
                    ->get_one();
                \Session::set('employee', $employee);
                \Session::set('seller', $employee->seller);
                $msg = ['status' => 'succ', 'msg' => 'ok', 'errcode' => 0];
            }

            die(json_encode($msg));
        }
        $this->template->content = \View::forge("{$this->theme}/login");
    }
}
