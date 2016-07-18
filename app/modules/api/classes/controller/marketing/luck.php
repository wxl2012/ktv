<?php
/**
 * 一元购活动控制器
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

class Controller_Marketing_Luck extends Controller_Marketing {

    public function before(){
        parent::before();
    }
    public function action_index(){}

    /**
     * 获取1元购活动列表
     */
    public function action_list(){
        $result = \Model_MarketingLuckOne::query()
            ->related(['parent', 'goods'])
            ->where([
                'parent.is_deleted' => 0,
                'open_at' => 0
            ])
            ->where(
                'total', '>', 'balance'
            )
            ->get();

        $msg = [
            'status' => 'succ',
            'msg' => '',
            'errcode' => 0,
            'data' => $result
        ];
        $this->response($msg, 200);
    }

    /**
     * 获取某活动的参与记录
     * @param int $marketing_id
     */
    public function action_records($marketing_id = 0){

        $where = [];

        if(\Input::get('user_id', false)){
            $where['user_id'] = \Input::get('user_id');
        }

        if(\Input::get('openid', false)){
            $where['openid'] = \Input::get('openid');
        }

        $result = \Model_MarketingRecord::query()
            ->where([
                'marketing_id' => $marketing_id
            ]);

        if($where){
            $result->and_where_open()
                ->or_where($where)
                ->and_where_close();
        }

        //分页查询
        $count = $result->count();
        $config = array(
            'pagination_url' => "/api/order/dish/list.json",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 50),
            'uri_segment'    => 'start',
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn' . (\Input::is_ajax() ? '_ajax' : '')
        );

        $pagination = new \Pagination($config);

        $result->order_by(['created_at' => 'desc', 'id' => 'desc']);
        $data = $result
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        $msg = [
            'status' => 'succ',
            'msg' => '',
            'errcode' => 0,
            'data' => $data,
            'total_count' => $count
        ];
        $this->response($msg, 200);
    }
}
