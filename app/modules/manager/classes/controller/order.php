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
 * 订单控制器
 *
 * 订单相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

class Controller_Order extends Controller_BaseController
{

    /**
     * 订单列表
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $params = [
            'title' => '订单管理'
        ];

        $items = \Model_Order::query()
            ->where('is_deleted', 0)
            ->where('from_id', \Session::get('seller')->id);

        $data = \Input::get();
        foreach ($data as $k => $v){
            if( ! $v){
                continue;
            }
            $items->where($k, $v);
        }
        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/admin/order",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = $pagination;
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/reserve/index");
    }

    /**
     * 查询预订信息
     */
    public function action_reserve(){

        $params = [
            '预订管理'
        ];

        $items = \Model_RoomReserve::query()
            ->where(['is_deleted' => 0]);

        if(\Session::get('seller', false)){
            $items->where('seller_id', \Session::get('seller')->id);
        }
        if(\Input::get('status', false)){
            $items->where('status', \Input::get('status'));
        }

        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/admin/room/reserve",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = $pagination;
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/room/reserve");
    }

    /**
     * 修改预订状态
     * @throws \Exception
     */
    public function action_change_reserve_status(){
        if(\Input::method() == 'POST'){
            $data = \Input::post();

            $reserve = \Model_RoomReserve::find($data['id']);
            $reserve->status = $data['status'];
            if($reserve->save()){
                die(json_encode(['status' => 'succ', 'msg' => '操作成功', 'errcode' => 0]));
            }
        }
    }

    /**
     * 保存订单信息
     *
     * @access  public
     * @return  Response
     */
    public function action_save($id = 0)
    {
        $params = array(
            'title' => '订单详情——订单管理',
            'menu' => 'goods-details',
        );

        $room = false;
        if($id){
            $room = \Model_Room::find($id);
        }

        if(\Input::method() == 'POST'){
            $data = \Input::post();
            $data['published_at'] = isset($data['published_at']) && $data['published_at'] ? strtotime($data['published_at']) : 0;
            $data['expire_at'] = isset($data['expire_at']) && $data['expire_at'] ? strtotime($data['expire_at']) : 0;

            if($room){
                $room->set($data);
            }else{

                $data['seller_id'] = \Session::get('seller')->id;
                $room = \Model_Room::forge($data);
                $room->galleries = array();
                foreach (explode(',', $data['images']) as $key => $value) {
                    array_push($room->galleries, \Model_RoomGallery::forge(array('attachment_id' => $value)));
                }
            }


            if($room->save()){
                $msg = array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0);
            }else{
                $msg = array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20);
            }
            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
            \Session::set_flash('msg', $msg);
        }

        if($room){
            $params['item'] = $room;
        }else if(\Input::get('id', false)){
            $params['item'] = \Model_Room::find(\Input::get('id'));
        }

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/room/details");
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
