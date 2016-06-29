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
 * 预订控制器
 *
 * 预订相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

class Controller_Reserve extends Controller_BaseController
{

    /**
     * 预订列表
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $params = [
            'title' => '预订管理'
        ];

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/reserve/index");
    }

    /**
     * 预约支付
     * @param $id 预约ID
     */
    public function action_pay($id){
        $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
        $reserver = \Model_RoomReserve::find($id);
        if( ! $reserver){
            $msg['msg'] = '预约不存在';
            die(json_encode($msg));
        }

        $reserver->status = 'SUCCESS';
        if( ! $reserver->save()){
            $msg['msg'] = '操作失败';
            die(json_encode($msg));
        }
        die(json_encode(['status' => 'succ', 'msg' => '操作成功', 'errcode' => 0]));
    }

    /**
     * 删除预约
     * @param $id 预约ID
     */
    public function action_delete($id){
        $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
        $reserver = \Model_RoomReserve::find($id);
        if( ! $reserver){
            $msg['msg'] = '预约不存在';
            die(json_encode($msg));
        }

        if( ! $reserver->delete()){
            $msg['msg'] = '操作失败';
            die(json_encode($msg));
        }
        die(json_encode(['status' => 'succ', 'msg' => '操作成功', 'errcode' => 0]));
    }

    /**
     * 使用预约
     *
     * @param $id 预约ID
     */
    public function action_use($id){
        $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
        $reserver = \Model_RoomReserve::find($id);
        if( ! $reserver){
            $msg['msg'] = '预约不存在';
            die(json_encode($msg));
        }

        $reserver->status = 'USED';
        if( ! $reserver->save()){
            $msg['msg'] = '操作失败';
            die(json_encode($msg));
        }
        die(json_encode(['status' => 'succ', 'msg' => '操作成功', 'errcode' => 0]));
    }

    /**
     * 取消预约
     *
     * @param $id 预约ID
     */
    public function action_cancel($id){
        $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
        $reserver = \Model_RoomReserve::find($id);
        if( ! $reserver){
            $msg['msg'] = '预约不存在';
            die(json_encode($msg));
        }

        $reserver->is_deleted = 1;
        if( ! $reserver->save()){
            $msg['msg'] = '操作失败';
            die(json_encode($msg));
        }
        die(json_encode(['status' => 'succ', 'msg' => '操作成功', 'errcode' => 0]));
    }

    /**
     * 保存订单信息
     *
     * @access  public
     * @return  Response
     */
    public function action_save()
    {
        $params = array(
            'title' => '新增预约',
            'menu' => 'goods-details',
        );

        $params['rooms'] = \Model_Room::query()->where(['seller_id' => \Session::get('seller')->id])->get();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/reserve/details");
    }

    /**
     * 支付状态显示
     *
     * @access  public
     * @return  Response
     */
    public function action_category()
    {
        $this->template->content = \View::forge("{$this->theme}/room/category");
    }
}
