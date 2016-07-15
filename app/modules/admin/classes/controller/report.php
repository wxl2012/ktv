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
 * 报表控制器
 *
 * 报表相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_Report extends Controller_BaseController
{

    /**
     * 报表数据
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $date = \Input::get('date', '7');

        $begin = \Input::get('begin', date('Y-m-d 00:00:00'));
        $end = \Input::get('end', date('Y-m-d 23:59:59'));

        switch ($date){
            case '7':
                $begin = \Input::get('begin', date('Y-m-d 00:00:00', strtotime('-8 day')));
                break;
            case '15':
                $begin = \Input::get('begin', date('Y-m-d 00:00:00', strtotime('-16 day')));
                break;
            case '30':
                $begin = \Input::get('begin', date('Y-m-d 00:00:00', strtotime('-31 day')));
                break;
            case '3m':
                $begin = \Input::get('begin', date('Y-m-d 00:00:00', strtotime('-3 month')));
                break;
        }


        $begin = strtotime($begin);
        $end = strtotime($end);

        $params['items'] = \Model_Order::get_fee_group($begin, $end);

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/report/dashboard");
    }

}
