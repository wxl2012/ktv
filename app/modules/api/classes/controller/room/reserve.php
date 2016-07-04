<?php
/**
 * 预约控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace api;

class Controller_room_Reserve extends Controller_BaseController {

    public function before(){
        parent::before();
    }

    /**
     * 预约默认方法
     */
    public function action_index(){

    }

    /**
     * 预约列表
     */
    public function action_list(){
        $items = \Model_RoomReserve::query()
            ->related('order')
            ->where('is_deleted', 0);

        //订单创建时间
        if(\Input::get('begin', false) && \Input::get('end', false)){
            $items->where('created_at', 'BETWEEN', [\Input::get('begin'), \Input::get('end')]);
        }

        //其它条件
        $where = ['is_deleted' => 0];
        if(\Input::get('seller_id', false)){
            $where['order.from_id'] = \Input::get('seller_id');
        }
        //新数据
        if(\Input::get('last_id', false)){
            $items->where('id', '>', \Input::get('last_id'));
        }
        $items->where($where);

        //排序条件
        $sort = ['created_at' => 'desc', 'id' => 'desc'];
        $filed = \Input::get('sort_filed', false);
        if($filed){
            $sort = ["{$filed}" => \Input::get('sort_value')];
        }
        $items->order_by($sort);

        $count = $items->count();
        $config = array(
            'pagination_url' => "/api/order/reserve",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn_ajax'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = [
            'total_pages' => $pagination->total_pages,
            'total_items' => $pagination->total_items,
            'uri_segment' => $pagination->uri_segment,
            'pagination_url' => $pagination->pagination_url,
            'current_page' => $pagination->calculated_page
        ];
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        foreach ($params['items'] as $item){
            $item->order;
            $item->room->category;
        }

        $this->response(['status' => 'succ', 'msg' => '', 'data' => $params], 200);
    }

    /**
     * 按日期分组统计实收金额
     */
    public function action_statistics_count_date(){
        //获取参数
        $begin_at = \Input::get('begin_at');
        $end_at = \Input::get('end_at');
        $seller_id = \Input::get('seller_id', false);

        if( ! $seller_id){
            return $this->response(['status' => 'err', 'msg' => '缺少必要参数', 'errcode' => 10]);
        }

        //默认为过去7天数据统计
        $begin_at = $begin_at ? $begin_at : date('Y-m-d', strtotime("-8 day"));
        $end_at = $end_at ? $end_at : date('Y-m-d', strtotime("-1 day"));

        //转换为时间戳
        $begin_at = strtotime(date('Y-m-d 00:00:00', strtotime($begin_at)));
        $end_at = strtotime(date('Y-m-d 23:59:59', strtotime($end_at)));

        $sql = <<<sql
SELECT 
  FROM_UNIXTIME(begin_at, '%Y-%m-%d') AS date, COUNT(*) 
FROM 
  rooms_reserves
WHERE
  begin_at BETWEEN {$begin_at} AND {$end_at}
  AND seller_id = {$seller_id}
GROUP BY FROM_UNIXTIME(begin_at, '%Y-%m-%d')
sql;

        $result = \DB::query($sql)
            ->execute()
            ->as_array();

        $this->response(['status' => 'succ', 'msg' => '', 'data' => $result]);
    }

    /**
     * 保存预订
     */
    public function action_save(){

        $id = \Input::get('id');

        $reserve = false;
        if($id){
            $reserve = \Model_RoomReserve::find($id);
        }


        if(\Input::method() == 'POST'){
            $data = \Input::post();

            if( ! $reserve){
                $reserve = \Model_RoomReserve::forge();
            }

            $reserve->begin_at = strtotime("{$data['date']} {$data['time']}:00");

            $reserve->set($data);
            //$reserve->remark = "{$data['date']} {$data['time']}";


            if($reserve->save()){
                $msg = ['status' => 'succ', 'msg' => '', 'data' => $reserve->to_array(), 'errcode' => 0];
            }else{
                $msg = ['status' => 'err', 'msg' => '操作失败', 'errcode' => 20];
            }
            $this->response($msg, 200);
        }
    }

    /**
     * 获取可预订房间数
     */
    public function action_get_rooms(){

        if(\Input::method() == 'POST'){
            $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
            $data = \Input::post();
            if(! (isset($data['date']) && $data['date'])
                || ! (isset($data['room_id']) && $data['room_id'])){
                $msg['msg'] = '缺少必要参数';
                die(json_encode($msg));
            }

            $room = \Model_Room::find($data['room_id']);
            if(! $room){
                $msg['msg'] = '参数不合法';
                die(json_encode($msg));
            }

            $rooms = \Model_RoomReserve::getReserveCount($data['room_id'], $data['date']);

            $msg['status'] = 'succ';
            $msg['data'] = $room->total - $rooms;
            die(json_encode($msg));
        }
    }
}
