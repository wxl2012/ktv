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
 * 默认控制器
 *
 *
 * @package  app
 * @extends  Controller
 */

namespace manager;

class Controller_Home extends Controller_BaseController
{

    /**
     * 商家中心
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        
        $seller = \Session::get('seller', false);
        if( ! $seller){
            \Session::set_flash('msg', ['msg' => '您无权操作该功能！', 'title' => '非法请求', 'status' => 'err']);
            return $this->show_message();
        }

        $params = [
            'title' => '管理中心',
            'seller' => $seller
        ];

        $params['reserver_count'] = \Model_RoomReserve::query()->count();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/index");
    }
}
