<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Order extends Controller_BaseController
{

    public $template = 'template';
    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        return Response::forge(View::forge('welcome/index'));
    }

    /**
     * 确认支付
     *
     * @param int $id 预订ID
     * @access  public
     * @return  Response
     */
    public function action_pay_confirm($id = 0)
    {
        if( ! $id){
            die('param is inval');
        }

        $reserve = \Model_RoomReserve::find($id);

        if(\Input::method() == 'POST'){
            $data = \Input::post();

            if( ! Security::check_token()){
                die(json_encode(['status' => 'err', 'msg' => '请勿重复提交订单!', 'errcode' => 10]));
            }

            $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
            $order = \Model_Order::forge($data);
            $order->order_no = "{$reserve->id}" . time();
            $order->buyer_id = \Auth::check() ? \Auth::get_user()->id : 0;
            $order->details = [
                \Model_OrderDetail::forge([
                    'goods_id' => $id,
                    'num' => 1,
                    'price' => $data['original_fee']
                ])
            ];
            if($order->save()){
                $this->notice_buyer();
                $this->notice_seller();
                $msg = ['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $order->to_array()];
            }

            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
        }


        $params = [
            'reserve' => $reserve
        ];
        \View::set_global($params);
        $this->template->content = \View::forge('pay/pay_confirm');
    }

    /**
     * 发起支付
     *
     * @param int $id 订单ID
     */
    public function action_pay($id = 0){
        if( ! $id){
            die('param is inval');
        }


        if(\Input::method() == 'POST'){
            $msg = ['status' => 'err', 'msg' => '找不到对象', 'errcode' => 0];

            $reserve = \Model_RoomReserve::find($id);

            if($reserve->order){
                $msg = ['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $reserve->order->to_array()];
            }

            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
        }

        $order = \Model_Order::find($id);
        $params = [
            'reserve' => current($order->details)->reserve
        ];

        \View::set_global($params);
        $this->template->content = \View::forge('pay/pay_confirm');
    }

    /**
     * 支付状态显示
     *
     * @param int $id 订单ID
     * @access  public
     * @return  Response
     */
    public function action_pay_status($id = 0)
    {
        $order = \Model_Order::find($id);
        if( ! $order){
            die('order not found');
        }

        $params = [
            'order' => $order
        ];
        \View::set_global($params);
        $this->template->content = \View::forge('pay/pay_status');
    }

    /**
     * 通知商家
     */
    private function notice_seller(){
        //微信模板通知
        //短信消息通知
    }

    /**
     * 通知买家
     */
    private function notice_buyer(){
        //微信模板通知
        //短信消息通知
    }

    /**
     * 分润
     */
    private function share_profit(){

    }


}
