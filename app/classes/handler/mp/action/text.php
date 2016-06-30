<?php

/**
 * 微信公众平台推送的文本消息处理类
 *
 * @package    Fuel
 * @version    1.7
 * @author     Ray zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */
namespace handler\mp\action;

class Text extends Base {

    function __construct($argument = false)
    {
        # code...
    }

    /**
     * 处理请求
     */
    public function handle(){
        if(strpos($this->data->content, 'bind') !== false){
            $this->bind_employee();
        }
    }

    /**
     * 创建职员
     */
    private function bind_employee(){
        $key = str_replace('bind ', '', $this->data->content);
        $data = false;
        try{
            $data = \Cache::get("bind_employee_{$key}");
        }catch (\CacheNotFoundException $e){
            $this->reply_text('不存在的或错误的绑定编号！');
        }

        
        $data = unserialize($data);
        $count = \Model_Employee::query()
            ->where([
                'seller_id' => $data['seller_id']
            ])
            ->count();
        
        if($count > 0){
            $this->reply_text('您已绑定过其它商户管理员！不能再次绑定其它商户。如需绑定请联系管理员！');
        }

        $employee = \Model_Employee::forge($data);
        $employee->save();
        $this->reply_text('恭喜您！绑定成功！');
    }
}