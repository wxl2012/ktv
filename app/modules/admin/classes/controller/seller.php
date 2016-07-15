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
 * 商户控制器
 *
 * 商户相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_Seller extends Controller_BaseController
{

    /**
     * 商家列表
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $items = \Model_Seller::query()
            ->where('is_deleted', 0);

        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/admin/seller",
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
        $this->template->content = \View::forge("{$this->theme}/seller/index");
    }

    /**
     * 保存商家
     *
     * @access  public
     * @return  Response
     */
    public function action_save($id = 0)
    {
        $params = [];

        if(\Input::method() == 'POST'){

            $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];

            $data = \Input::post();

            if(! \Security::check_token()){
                $msg = ['status' => 'err', 'msg' => 'token失效或重复提交！', 'errcode' => 10];
            }else{
                $seller = \Model_Seller::find($id);
                if( ! $seller){
                    $seller = \Model_Seller::forge();
                }

                $seller->set($data);
                if($seller->save()){
                    \Session::set('seller', $seller);
                    $msg['status'] = 'succ';
                    $msg['msg'] = '操作成功';
                }
            }

            if(\Input::is_ajax()){
                die(json_encode($msg));
            }

            \Session::set_flash('msg', $msg);
        }

        $params['seller'] = \Model_Seller::find($id);
        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/seller/details");
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
