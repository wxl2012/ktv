<?php
/**
 * 活动订单控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

/**
 * 本控制器主要用于：
 * 1.
 * @package  app
 * @extends  Controller
 */

namespace api;

class Controller_Order_Marketing extends Controller_Order {

    public function before(){
        parent::before();
        //\Session::set('seller', \Model_Seller::find(1));
    }

    public function action_create(){
        if(\Input::method() == 'POST'){
            $msg = [
                'msg' => '',
                'errcode' => 0,
                'status' => 'succ'
            ];
            //检测必要的订单信息

            $data = \Input::post();
            $data['order_type'] = 'MARKET';
            //生成订单明细
            $details = [];
            foreach($data['marketings'] as $item){
                $marketing = \Model_Marketing::find($item['id']);
                $detail = [
                    'goods_id' => $marketing->id,
                    'price' => $item['price'],
                    'num' => $item['num']
                ];
                array_push($details, $detail);
            }
            $this->load_details($details);

            if(isset($data['coupons'])){
                //生成优惠信息
                $this->load_preferential($data['coupons']);
            }

            if( ! $this->save($data)){
                $msg = [
                    'msg' => $this->result_message,
                    'errcode' => 20,
                    'status' => 'err'
                ];
            }

            $msg['data'] = $this->order;

            $this->response($msg, 200);
        }
    }

    /**
     * 判断是否有未付款订单
     */
    public function action_exists(){
        $msg = ['status' => 'succ', 'msg' => '', 'errcode' => 0];
        $status = \Model_Order::exists(\Input::get('buyer_id'), 'MARKET');
        if($status){
            $msg = ['status' => 'err', 'msg' => '您有未完成的订单，请先处理未完成的订单！', 'errcode' => 0];
        }
        $this->response($msg, 200);
    }
}
