<?php
/**
 * 一元购控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace marketing;

class Controller_Luck_One extends Controller_BaseController {

    public $theme = 'default';
    public $template = 'default/template';

    public function before(){
        parent::before();
    }

    /**
     * 一元购首页
     */
    public function action_index(){

        $params = [];

        \View::set_global($params);

        $this->template->content = \View::forge("{$this->theme}/one/index");
    }

    /**
     * 一元购活动列表
     */
    public function action_list(){

        $params = [];

        \View::set_global($params);

        $this->template->content = \View::forge("{$this->theme}/one/list");
    }

    /**
     * 活动详情
     *
     * @param $id 活动ID
     */
    public function action_view($id = 0){

        $params = [];

        $params['item'] = \Model_Marketing::find($id);

        $msg = false;
        if( ! $params['item']){
            $msg = ['msg' => '活动不存在', 'title' => '活动异常'];
        }else if($params['item']->is_deleted){
            $msg = ['msg' => '活动已删除', 'title' => '活动异常'];
        }

        if($msg){
            \Session::set_flash('msg', $msg);
            return $this->show_message();
        }

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/one/view");
    }

    /**
     * 揭晓历史
     */
    public function action_history(){

        $params = [];

        \View::set_global($params);

        $this->template->content = \View::forge("{$this->theme}/one/history");
    }
}
