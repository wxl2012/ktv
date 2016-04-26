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

    public function action_notice(){
        //获取微信支付服务器提供的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $result = \handler\common\Tool::xmlToArray($xml);

        //获取商户的支付配置信息
        $trade = \Model_OrderTrade::query()
            ->where('out_trade_no', $result['out_trade_no'])
            ->get_one();

        if( ! $trade){
            die('trade empty');
        }

        //订单交易对象
        $trade->response_msg = json_encode($result);
        $trade->return_trade_no = $result['transaction_id'];
        $trade->real_money = $result['total_fee'] / 100;
        $trade->updated_at = time();

        //订单对象
        $order = $trade->order;

        //支付配置
        $access = \Model_AccessConfig::query()
            ->where('access_type', 'wxpay')
            ->where('seller_id', $order->from_id)
            ->where('enable', 'ENABLE')
            ->get_one();

        //检验签名
        $tmpSign = $result;
        unset($tmpSign['sign']);
        $sign = handler\mp\Tool::getWxPaySign($tmpSign, $access->access_key);

        $params = array(
            'return_code' => 'SUCCESS'
        );
        if($result['sign'] != $sign){
            $order->order_status = 'PAYMENT_ERROR';
            $trade->return_status = 'ERROR';
            $params = array(
                'return_code' => 'FAIL',
                'return_msg' => '签名失败'
            );
        }else if($order->order_status == 'WAIT_PAYMENT'){
            $order->paid_fee += $result['total_fee'] / 100;
            $order->pay_at = time();
            if($order->paid_fee >= $order->original_money){
                $order->order_status = 'PAYMENT_SUCCESS';
            }
            $trade->return_status = 'SUCCESS';
            $trade->return_trade_no = $result['transaction_id'];
            $trade->response_msg = json_encode($result);
        }
        if($order->save() && $order->remark == 'qrcode'){
            \Model_Order::delivery($order->id);
        }
        $trade->save();

        $data = \handler\common\Tool::arrayToXml($params);
        die($data);
    }
}
