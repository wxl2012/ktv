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
     * 设置主题
     *
     * @access  public
     * @return  Response
     */
    public function action_setting_theme()
    {
        if(\Input::method() == 'POST'){
            $user = \Auth::get_user();
            $user->default_theme = \Input::post('theme', '');
            $user->save();

        }
    }

    public function action_login(){

        if(\Auth::check()){
            \Response::redirect('/admin');
        }

        if(\Input::method() == 'POST'){
            $msg = ['status' => 'err', 'msg' => '表单验证错误', 'errcode' => 10];

            $val = \Validation::forge('MyRules');
            $val->add_callable('MyRules');
            $val->add_field('username', '用户名', 'required|trim');
            $val->add_field('password', '密码', 'required|trim');

            $flag = $val->run();
            if ($flag){
                if( ! \Auth::login()){
                    $msg = ['status' => 'err', 'msg' => '密码错误', 'errcode' => 10];
                }else{
                    $employee = \Model_Employee::query()
                        ->where('user_id', \Auth::get_user()->id)
                        ->get_one();
                    if(! $employee){
                        $msg['msg'] = '非法登录';
                    }else{
                        \Session::set('employee', $employee);
                        \Session::set('seller', $employee->seller);
                        \Response::redirect('/admin/home');
                    }
                }
            }else{
                foreach ($val->error() as $key => $value) {
                    $errors[$key] = (string)$value;
                }
                $msg['data'] = $errors;
            }
            \Session::set_flash('msg', $msg);
        }

        return \Response::forge(\View::forge('super/login'));
    }

    public function action_logout(){
        \Auth::logout();
        \Session::destroy();
        \Response::redirect('/admin/home/login');
    }
}
