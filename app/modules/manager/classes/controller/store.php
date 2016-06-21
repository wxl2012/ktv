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
 * 数据报表控制器
 *
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

class Controller_Store extends Controller_BaseController
{

    /**
     * 店铺列表
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $params = [
            'title' => '店铺管理'
        ];

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/reserve/index");
    }

    /**
     * 保存店铺信息
     *
     * @access  public
     * @return  Response
     */
    public function action_save($id = 0)
    {
        $params = array(
            'title' => '店铺详情——店铺管理',
            'menu' => 'store-details',
        );

        if(\Input::method() == 'POST'){
            $data = \Input::post();
            $seller = \Session::get('seller');
            $seller->set($data);

            if($seller->save()){
                \Session::set('seller', $seller);
                die(json_encode(['status' => 'succ', 'errcode' => 0, 'msg' => '操作成功']));
            }
            die(json_encode(['status' => 'err', 'errcode' => 10, 'msg' => '操作失败']));
        }

        $params['seller'] = \Session::get('seller');
        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/store/details");
    }

}
