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
 * 微信公众号控制器
 *
 * 包房相关处理方法
 *
 * @package  app
 * @extends  Controller
 */

namespace admin;

class Controller_WXAccount extends Controller_BaseController
{

    /**
     * 公众号列表
     */
    public function action_index(){
        $account = \Model_WXAccount::query();
        if(\Session::get('seller')){
            $account->where(['seller_id' => \Session::get('seller')->id]);
        }
        $items = $account->get();
        if(count($items) < 2){
            \Response::redirect('/admin/wxaccount/save/' . (count($items) < 1 ? 0 : current($items)->id));
        }

        $params['items'] = $items;

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/mp/account/index");
    }

    /**
     * 公众号详情信息
     *
     * @access  public
     * @return  Response
     */
    public function action_save($id = 0)
    {
        $params = array(
            'title' => '公众号详情——微信公众号管理',
            'menu' => 'wxaccount-details',
        );

        $account = false;
        if($id){
            $account = \Model_WXAccount::find($id);
        }

        if(\Input::method() == 'POST'){
            $data = \Input::post();

            if(! \Security::check_token()){
                $msg = ['status' => 'err', 'msg' => 'token失效或重复提交！', 'errcode' => 10];
            }else{
                if( ! $account){
                    $data['seller_id'] = \Session::get('seller')->id;
                    $account = \Model_Room::forge($data);
                }

                $account->set($data);

                if($account->save()){
                    $msg = array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0);
                }else{
                    $msg = array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20);
                }
            }


            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
            \Session::set_flash('msg', $msg);
        }

        $params['item'] = $account;

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/mp/account/details");
    }

    public function action_wxpay($id = 0){

        $item = \Model_AccessConfig::query()
            ->where(['seller_id' => \Session::get('seller')->id, 'access_type' => 'wxpay'])
            ->get_one();

        if(\Input::method() == 'POST'){
            $data = \Input::post();

            if(! \Security::check_token()){
                $msg = ['status' => 'err', 'msg' => 'token失效或重复提交！', 'errcode' => 10];
            }else{
                if(! $item){
                    $item = \Model_AccessConfig::forge();
                }
                $item->set($data);

                if($item->save()){
                    $msg = array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0);
                }else{
                    $msg = array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20);
                }
            }

            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
            \Session::set_flash('msg', $msg);
        }

        $params['item'] = $item;

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/mp/account/wxpay");
    }
}
