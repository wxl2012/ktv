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
        $params = [
            'title' => '数据统计'
        ];

        $sql = "SELECT FROM_UNIXTIME(created_at, '%Y-%m-%d') AS date, SUM(original_fee) AS total_fee FROM orders GROUP BY FROM_UNIXTIME(created_at, '%Y-%m-%d')";

        $result = \DB::query($sql)
            ->where()
            ->execute()
            ->as_array();

        $sql = "SELECT FROM_UNIXTIME(begin_at, '%Y-%m-%d') AS date, COUNT(*) FROM rooms_reserves GROUP BY FROM_UNIXTIME(begin_at, '%Y-%m-%d')";
        var_dump($result);die();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/report/index");
    }

}
