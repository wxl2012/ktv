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
 * 微信公众号控制器
 *
 * 包房相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_WXAccount extends Controller_BaseController
{

    /**
     * 查询预订信息
     */
    public function action_wxpay(){

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
     * 保存包房信息
     *
     * @access  public
     * @return  Response
     */
    public function action_save($id = 0)
    {
        $params = array(
            'title' => '包房详情——包房管理',
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
}
