<?php
/**
 * 1元购活动控制器
 *
 * @package  app
 * @extends  Controller
 */
namespace admin;

class Controller_Marketing_Luck extends Controller_BaseController
{
    public function before(){
        parent::before();

        \View::set_global(['controller_name' => '1元购活动管理']);
    }

    public function action_index(){
        $params = array(
            'title' => "1元购活动管理",
            'menu' => 'vote',
            'action_name' => '1元购活动列表'
        );

        $account = \Session::get('WXAccount', false);

        $items = \Model_MarketingLuckOne::query()
            ->related(['parent']);
        if($account){
            $items->where([
                'parent.seller_id' => $account->seller_id,
                'parent.account_id' => $account->id
            ]);
        }

        $params['items'] = $items->get();

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/marketing/luck/index");
    }

    public function action_save($id = 0){

        $market = \Model_Marketing::find($id);

        if(\Input::method() == 'POST'){
            $account = \Session::get('WXAccount');
            $msg = ['status' => 'err', 'msg' => '', 'errcode' => 10];
            $data = \Input::post();
            $data['start_at'] = isset($data['start_at']) && $data['start_at'] ? strtotime($data['start_at']) : 0;
            $data['end_at'] = isset($data['end_at']) && $data['end_at'] ? strtotime($data['end_at']) : 0;
            $data['account_id'] = $account->id;
            $data['seller_id'] = $account->seller_id;
            $data['type'] = 'LUCK_ONE';

            if( ! $market){
                $market = \Model_Marketing::forge();
            }
            $market->set($data);
            $market->luck = \Model_MarketingLuckOne::forge($data);

            if($market->save()){
                
                $msg = ['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $market->luck->to_array()];
            }

            if(\Input::is_ajax()){
                die(json_encode($msg));
            }
            \Session::set_flash('msg', $msg);
        }

        $params['item'] = $market ? $market->luck : false;

        \View::set_global($params);
        $this->template->content = \View::forge("{$this->theme}/marketing/luck/details");
    }
    
}
