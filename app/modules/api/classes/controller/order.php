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

    protected $order = false;

    public function before(){
        parent::before();
    }

    /**
     * 生成订单号
     */
    protected function generate_order_no(){
        //日期+地区码+用户ID
        /*$areas = [
            '11' => '北京市',
            '12' => '天津市',
            '13' => '河北省'
        ];*/
        $areas = [
            '11' => 100000,
            '12' => 300000,
            '13' => 300001
        ];
        $date = date('YmdHis');
        $user_id = \Auth::check() ? \Auth::get_user()->id : '00000';
        return "{$date}{$areas['11']}{$user_id}";
    }

    /**
     * 保存订单
     * @param $data 订单数据
     */
    protected function save($data){
        if( ! $this->order){
            $this->order = \Model_Order::forge();
        }

        $this->order->set($data);

        if( ! $this->order->order_no){
            $this->order->order_no = $this->generate_order_no();
        }
        if( ! $this->order->buyer_id){
            $this->order->buyer_id = \Auth::check() ? \Auth::get_user()->id : 0;
        }
        if( ! $this->order->from_id){
            $this->order->from_id = \Session::get('seller', false) ? \Session::get('seller')->id : 0;
        }
        if( ! $this->order->order_status){
            $this->order->order_status = 'WAIT_PAYMENT';
        }

        $this->original_fee = $this->order->total_fee - $this->order->preferential_fee;

        //保存订单
        if( ! $this->order->save()){
            return false;
        }

        //发送下单成功模板消息
        $params = [
            'first' => [
                'value' => '订单支付成功',
                'color' => '#D02090',
            ],
            'keyword1' => [
                'value' => $this->order->order_no,
                'color' => '#D02090',
            ],
            'keyword2' => [
                'value' => $this->order->order_name,
                'color' => '#D02090',
            ],
            'keyword3' => [
                'value' => $this->order->total_fee,
                'color' => '#D02090',
            ],
            'remark' => [
                'value' => '',
                'color' => '#D02090'
            ]
        ];
        $this->sendMsgTemplate('tQ46mymM617VOKpNv6rbg5hBQpXIle8EC64n-ozbSSw', $params, '');

        //清理购物车
        foreach($this->order->details as $item){
            $trolley = \Model_Trolley::query()
                ->where('goods_id', $item->id)
                ->get_one();

            if( ! $trolley){
                continue;
            }

            $trolley->delete();
        }

        return true;
    }

    /**
     * 修改订单状态
     *
     * @param $id       订单ID
     * @param $status   需要修改的状态
     */
    protected function change_order_status($id, $status){
        $order = \Model_Order::find($id);
        if( ! $order){
            $this->msg['msg'] = '无效的订单';
            return $this->response($this->msg);
        }

        switch ($status){
            case 'BUYER_CANCEL':
                if($this->user->id != $order->buyer_id){
                    $this->msg['msg'] = '您没有该项功能操作权限!';
                    return $this->response($this->msg);
                }
                $order->order_status = 'BUYER_CANCEL';
                $order->closed_at = time();
                break;
            case 'SELLER_CANCEL':
                if($this->seller->id != $order->from_id){
                    $this->msg['msg'] = '您没有该项功能操作权限!';
                    return $this->response($this->msg);
                }
                $order->order_status = 'SELLER_CANCEL';
                $order->closed_at = time();
                break;
        }

        if( ! $order->save()){
            $this->msg['msg'] = '操作失败！原因：数据持久化时发生异常。';
            return $this->response($this->msg);
        }

        $this->msg['status'] = 'succ';
        $this->msg['msg'] = '操作成功';
        $this->msg['errcode'] = 0;
        $this->response($this->msg);
    }

    /**
     * 填充detail数据
     */
    protected function load_details($data){
        if( ! $this->order){
            $this->order = \Model_Order::forge();
        }
        $this->order->details = [];

        $fee = 0;
        foreach($data as $item){
            array_push($this->order->details, \Model_OrderDetail::forge($item));
            $fee += intval($item['num']) * floatval($item['price']);
        }
        $this->order->total_fee = $fee;
        $this->order->original_fee = $fee;
    }

    /**
     * 添加优惠信息
     */
    protected function load_preferential($data){
        if( ! $this->order){
            $this->order = \Model_Order::forge();
        }
        $this->order->preferentials = [];

        $fee = 0;
        foreach($data as $item){
            array_push($this->order->preferentials, \Model_OrderPreferential::forge($item));
            $fee += $item->fee;
        }
        $this->order->preferential_fee = $fee;
        $this->order->original_fee = $this->order->total_fee - $this->order->preferential_fee;
    }

    /**
     * 发货
     *
     * @param $id
     */
    protected function delivery($id){

        $this->order = \Model_Order::find($id);
        $this->order->order_status = 'DELIVERY';
        $this->order->save();

        //发送发货模板消息
        $params = [
            'first' => [
                'value' => '订单已发货!',
                'color' => '#D02090',
            ],
            'keyword1' => [
                'value' => $this->order->order_no,
                'color' => '#D02090',
            ],
            'keyword2' => [
                'value' => $this->order->total_fee,
                'color' => '#D02090',
            ],
            'keyword3' => [
                'value' => $this->order->order_name,
                'color' => '#D02090',
            ],
            'keyword4' => [
                'value' => $this->order->remark1,
                'color' => '#D02090',
            ],
            'keyword5' => [
                'value' => '服务员',
                'color' => '#D02090',
            ],
            'remark' => [
                'value' => '点击查看订单已使用状态',
                'color' => '#D02090'
            ]
        ];
        $this->sendMsgTemplate('kulOjNg1PT5gxUMZM6VV9GwjWCBdkw_xShlgPjzFM34', $params, 'http://ticket.wangxiaolei.cn');
    }

    /**
     * 订单分红操作
     */
    protected function cashback(){
        if( ! isset($this->order->seller->auto_cashback) || ! $this->order->seller->auto_cashback){
            $this->result_message = '订单非自动分红操作';
            return false;
        }else if($this->order->cashback_status){
            $this->result_message = '请勿重复分红操作';
            return false;
        }

        $rule = \Model_CashbackRule::find($this->order->seller->cashback_default_rule);
        if( ! $rule){
            $this->result_message = '订单分红失败,未找到分红规则';
            return false;
        }else if( ! $rule->items){
            $this->result_message = '未找到具体分红规则明细';
            return false;
        }

        $total_rate = 0;
        $rules = [];
        foreach ($rule->items as $item) {
            $rules[$item->depth] = $item->rate;
            $total_rate += $item->rate;
        }

        if($total_rate > 100){
            $this->result_message = '分红规则超出允许的最大比例!';
            return false;
        }

        //待分配金额
        $fee = $this->order->original_fee * ($rule->fee_rate / 100);

        //获取所有待分配会员列表
        $members = \Model_MemberRecommendRelation::parentMember($this->order->buyer_id);
        foreach($members as $member){
            //按各级别所得分额分配利润
            $item = \Model_OrderProfitShare::forge([
                'order_id' => $this->order->id,
                'user_id' => $member->master_id,
                'member_id' => $member->id,
                'total_fee' => $fee * ($rules[$member->depth] / 100),
            ]);
            $item->save();
        }

        $this->order->cashback_status = 1;
        return $this->order->save();
    }

    /**
     * 发送模板消息
     *
     * @param $no           订单号
     * @param $title        订单标题
     * @param $total_fee    订单金额
     * @param $url          订单链接
     * @return bool
     */
    protected function sendMsgTemplate($tmpl_id, $params, $url){
        $seller = \Session::get('seller', false);
        if( ! $seller
            || (isset($seller->is_send_template_msg) && ! $seller->is_send_template_msg)){
            $this->result_message = '商户未设置发送微信模板消息!';
            return false;
        }

        $account = \Session::get('WXAccount', false);
        $to_openid = $this->order->buyer_openid;

        $tmpl = new \handler\mp\TemplateMsg($account, $to_openid, $tmpl_id, $url);
        $result = $tmpl->send($params);
        if($result->errcode != 0){
            $this->result_message = '消息发送失败!';
            return false;
        }
        return true;
    }

    /**
     * 发送短信消息
     */
    protected function sendMsgSms(){

    }

    /**
     * 发送App通知消息
     */
    protected function sendAppSms(){

    }

    /**
     * 删除订单
     *
     * @param $id 订单ID
     */
    public function action_delete($id = 0){
        $order = \Model_Order::find($id);
        if( ! $order){
            $this->msg['msg'] = '无效的订单';
            return $this->response($this->msg, 200);
        }

        if($order->is_deleted == 1){
            $this->msg['msg'] = '请勿重复删除订单';
            return $this->response($this->msg, 200);
        }

        $order->is_deleted = 1;

        if( ! $order->save()){
            $this->msg['msg'] = '删除订单失败！原因：数据持久化时发生异常。';
            return $this->response($this->msg, 200);
        }

        $this->msg['status'] = 'succ';
        $this->msg['msg'] = '操作成功';
        $this->msg['errcode'] = 0;
        $this->response($this->msg, 200);
    }

    /**
     * 关闭订单
     * @param int $id 订单ID
     */
    public function action_closed($id = 0, $status = 'buyer_cancel'){
        $this->change_order_status($id, strtoupper($status));
    }

    /**
     * 读取订单列表
     * @return object
     */
    public function action_list(){
        $items = \Model_Order::query()
            ->where([
                'is_deleted' => 0,
            ]);

        $date_span = [];
        $date = \Input::get('timespan', 'day7');
        switch ($date){
            case 'day7':
                $date_span = [
                    strtotime(date('Y-m-d 00:00:00', strtotime("-8 day"))),
                    strtotime(date('Y-m-d 23:59:59', strtotime("-1 day")))
                ];
                break;
            case 'day30':
                $date_span = [
                    strtotime(date('Y-m-d 00:00:00', strtotime("-31 day"))),
                    strtotime(date('Y-m-d 23:59:59', strtotime("-1 day")))
                ];
                break;
            case 'month3':
                $date_span = [
                    strtotime(date('Y-m-01 00:00:00', strtotime("-3 month"))),
                    strtotime(date('Y-m-d 23:59:59', strtotime("-1 day")))
                ];
                break;
            case 'month6':
                $date_span = [
                    strtotime(date('Y-m-01 00:00:00', strtotime("-6 month"))),
                    strtotime(date('Y-m-d 23:59:59', strtotime("-1 day")))
                ];
                break;
            case 'year1':
                $date_span = [
                    strtotime(date('Y-01-01 00:00:00')),
                    strtotime(date('Y-m-d 23:59:59', strtotime("-1 day")))
                ];
                break;
        }
        $items->where('created_at', 'BETWEEN', $date_span);


        if($this->seller){
            $items->where('from_id', $this->seller->id);
        }else if($this->user){
            $items->where('buyer_id', $this->user->id);
        }

        //分页查询
        $count = $items->count();
        $config = array(
            'pagination_url' => "/api/order/dish/list.json",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 10),
            'uri_segment'    => 'start',
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn' . (\Input::is_ajax() ? '_ajax' : '')
        );

        $pagination = new \Pagination($config);

        $items->order_by(['created_at' => 'desc', 'id' => 'desc']);
        $list = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        foreach ($list as $key => $item){
            $list[$key]->items = [];
            $list[$key]->order_status_label = \Model_Order::$_maps['status'][$item->order_status];
            $list[$key]->order_status_class = \Model_Order::$_maps['labels'][$item->order_status];
            foreach ($item->details as $detail){
                $detail->goods->title;
                array_push($list[$key]->items, $detail);
            }
        }

        return $this->response(['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $list, 'total_page' => $pagination->__get('total_pages'), 'current_page' => $pagination->__get('current_page') ? $pagination->__get('current_page') : 1], 200);
    }

    /**
     * 获取订单详情
     * @param int $id 订单ID
     */
    public function action_get($id = 0){
        $msg = [
            'status' => 'err',
            'errcode' => 10,
            'msg' => ''
        ];

        $order = \Model_Order::find($id);

        if( ! $order){
            $msg['msg'] = '无效的订单';
            return $this->response($msg, 200);
        }

        foreach ($order->details as $detail){
            $detail->goods->category;
        }

        $msg = [
            'status' => 'succ',
            'errcode' => 0,
            'msg' => '',
            'data' => $order
        ];
        $this->response($msg, 200);
    }

    /**
     * 按日期分组统计实收金额
     */
    public function action_statistics_group_date(){
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
  FROM_UNIXTIME(created_at, '%Y-%m-%d') AS date, SUM(original_fee) AS total_fee 
FROM 
  orders
WHERE
  created_at BETWEEN {$begin_at} AND {$end_at}
  AND from_id = {$seller_id}
GROUP BY FROM_UNIXTIME(created_at, '%Y-%m-%d')
sql;

        $result = \DB::query($sql)
            ->execute()
            ->as_array();

        $this->response(['status' => 'succ', 'msg' => '', 'data' => $result]);
    }


}
