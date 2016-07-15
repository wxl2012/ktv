<?php
/**
 * 微信公众平台推送的取消关注事件消息处理类
 *
 * @package    Fuel
 * @version    1.7
 * @author     Ray zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */
namespace handler\mp\action\event;

class UnSubscribe extends \handler\mp\action\Event {

    function __construct($argument = false)
    {
        # code...
    }

    function handle(){


        $items = \Model_Marketing::query()->where(['account_id' => $this->account->id])->get();
        foreach ($items as $item){
            $recordKey = md5("record_{$this->data->FromUserName}_{$item->id}");
            try{
                $record = \Cache::get($recordKey);

                if(isset($record['candidates']) && $record['candidates']){
                    $candidates = explode(',', $record['candidates']);
                    foreach ($candidates as $candidate){
                        $key = md5("candidate_{$candidate}");
                        $candidateItem = \Cache::get($key);
                        $candidateItem['total_gain'] -= 1;
                        \Cache::set($key, $candidateItem);
                    }

                    $record['candidates'] = '';
                    \Cache::set($recordKey, $record);
                }
            }catch (\CacheNotFoundException $e){
                continue;
            }
        }


        $where = [
            'openid' => $this->data->FromUserName,
        ];
        $result = \DB::delete("marketing_records")
            ->where($where)
            ->execute();

    }

}