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
        $params = [
            'total' => 100,
            'month' => 100,
            'week' => 50,
            'today' => 32
        ];

        $params['today'] = \Model_Order::get_fee(strtotime(date('Y-m-d h:i:s')), time());
        $params['week'] = \Model_Order::get_fee(strtotime(date('Y-m-d 00:00:00', strtotime('-8 day'))), time());
        $params['month'] = \Model_Order::get_fee(strtotime(date('Y-m-01 00:00:00')), time());
        $params['total'] = \Model_Order::get_fee(strtotime('2016-01-01 00:00:00'), time());

        \View::set_global($params);
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
            if(\Auth::login()){

                if(\Auth::get_user()->username == 'admin'){
                    \Response::redirect('/admin');
                }

                $employee = \Model_Employee::query()
                    ->where('parent_id', \Auth::get_user()->id)
                    ->where('is_deleted', 0)
                    ->get_one();
                if( ! $employee){
                    \Session::set_flash('msg', ['status' => 'err', 'msg' => '非法登录,多次尝试登录,您的帐户将被封锁!', 'title' => '警告', 'sub_title' => '非法登录', 'icon' => 'exclamation-circle', 'color' => '#d9534f']);
                    return $this->not_login_alert();
                }

                // 保存会话信息: 当前登录人员的身份、所属商户、微信公众号信息
                \Session::set('seller', $employee->seller);
                \Session::set('people', $employee->people);
                \Session::set('employee', $employee);


                // 查询当前商户默认公众号信息
                $accounts = \Model_WXAccount::query()
                    ->where(['seller_id' => $employee->seller->id])
                    ->get();
                $account = false;
                if(count($accounts) > 1){
                    foreach ($accounts as $item) {
                        if($account->is_default == 1){
                            $account = $item;
                            break;
                        }
                    }
                }else{
                    $account = current($accounts);
                }

                \Session::set('WXAccount', $account);

                //获取API访问令牌
                $result = \handler\common\UrlTool::request(\Config::get('base_url') . 'api/token.json?user_id=' . \Auth::get_user()->id);
                $token = json_decode($result->body);
                \Session::set('access_token', $token->access_token);

                $redirect = "/admin";
                if(isset($data['to_url'])){
                    $redirect = $data['to_url'];
                }
                \Response::redirect($redirect);
            }
            \Session::set_flash('msg', array('status' => 'err', 'msg' => '登录失败', 'errcode' => 20));
        }

        return \Response::forge(\View::forge('super/login'));
    }

    public function action_logout(){
        \Auth::logout();
        \Session::destroy();
        \Response::redirect('/admin/home/login');
    }
}
