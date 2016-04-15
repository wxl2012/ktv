<?php
/**
 * 订单控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace api;

class Controller_Order extends Controller_BaseController {

    public function before(){
        parent::before();
    }

    /**
     * 订单
     */
    public function action_index(){

    }

    /**
     * 我的订单列表
     */
    public function action_list(){
        $items = \Model_Order::query()
            ->related(['details', 'details.goods']);

        //订单创建时间
        if(\Input::get('begin', false) && \Input::get('end', false)){
            $items->where('created_at', 'BETWEEN', [\Input::get('begin'), \Input::get('end')]);
        }

        //其它条件
        $where = ['is_deleted' => 0];
        if(\Input::get('seller_id', false)){
            $where['seller_id'] = \Input::get('seller_id');
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
            'pagination_url' => "/api/order/list",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn_ajax'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = $pagination;
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        foreach ($params['items'] as $item){
            $item->details;
            if($item->details){
                current($item->details)->goods;
            }
        }

        $this->response(['status' => 'succ', 'msg' => '', 'data' => $params], 200);
    }
}
