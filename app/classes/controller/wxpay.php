<?php
/**
 * 基于FuelPHP的微信第三方程序库
 *
 * @package    Fuel
 * @version    1.7
 * @author     Ray zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */

/**
 * 微信支付控制器
 *
 * 主要实现红包发放功能
 *
 * @package  app
 * @extends  Controller
 */
class Controller_WXPay extends Controller_BaseController
{
	public function before(){
    	parent::before();
    }

    public function action_index(){

        $msg = false;

        if( ! \Input::get('account_id', false) && ! \Session::get('WXAccount', false)){
            $msg = ['status' => 'err', 'msg' => '无效的公众号', 'errcode' => 10, 'title' => '错误'];
        }else if(! \Input::get('openid', false) && ! \Session::get('OpenID', false)){
            $msg = ['status' => 'err', 'msg' => '无效的微信号', 'errcode' => 20, 'title' => '错误'];
        }else if( ! \Input::get('order_id', false)) {
            $msg = ['status' => 'err', 'msg' => '缺少必要参数:订单ID', 'errcode' => 30, 'title' => '错误'];
        }

        if($msg){
            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
            \Session::set_flash('msg', $msg);
            return \Response::forge(\View::forge('message/moblie'));
        }

        $account = \Session::get('WXAccount', \Model_WXAccount::find(\Input::get('account_id', 1)));
        $openid = \Input::get('openid', false) ? \Input::get('openid') :  \Session::get('OpenID', false)->openid;
        $order = \Model_Order::find(\Input::get('order_id'));

        //查询收款帐户
        $access = \Model_AccessConfig::query()
            ->where('access_type', 'wxpay')
            ->where('seller_id', $order->from_id)
            ->where('enable', 'ENABLE')
            ->get_one();

        $result = \handler\mp\Tool::wxpay_order($account, $order, $access, $openid);

        $params = array(
            'appId' => $account->app_id,
            'timeStamp' => strval(time()),
            'nonceStr' => \Str::random('alnum', 16),
            'package' => "prepay_id={$result['prepay_id']}",
            'signType' => "MD5"
        );

        $params['paySign'] = \handler\mp\Tool::getWxPaySign($params, $access->access_key);
        $params['to_url'] = "/order/pay_status";

        if(\Input::is_ajax()){
           die(json_encode(['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $params]));
        }

        return \Response::forge(\View::forge('pay/wxpay', $params));
    }

}
