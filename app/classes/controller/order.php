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
     * @param int $id
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
            if($order->save()){
                $msg = ['status' => 'succ', 'msg' => '', 'errcode' => 0];
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
     * 支付状态显示
     *
     * @access  public
     * @return  Response
     */
    public function action_pay_status()
    {
        $this->template->content = \View::forge('pay/pay_status');
    }
}
