<?php
/**
 * 包房控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace api;

class Controller_Room extends Controller_BaseController {

    public function before(){
        parent::before();
    }

    /**
     * 获取支付方式
     */
    public function action_dates(){
        $items = \Model_RoomReserve::query()
            ->where('room_id', \Input::get('id', 0))
            ->where('begin_at', '>', time())
            ->where('status', 'IN', ['SUCCESS', 'NONE'])
            ->get();

        $data = ['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $items];
        $this->response($data, 200);
    }
}
