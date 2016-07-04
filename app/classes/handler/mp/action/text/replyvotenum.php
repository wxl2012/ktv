<?php

/**
 * 微信公众平台推送的文本消息处理类
 *
 * 投票
 *
 * @package    Fuel
 * @version    1.7
 * @author     Ray zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */
namespace handler\mp\action\text;

class ReplyVoteNum extends \handler\mp\action\Text {

    public function handle(){
        $keyword = str_replace('查询', '', $this->data->Content);

        $key = "marketing_spans_{$this->account->id}";
        try{
            $spans = \Cache::get($key);
            $result = unserialize($spans);
        }catch (\CacheNotFoundException $e){
            $sql = "SELECT marketing_id, no, keyword FROM marketing_votes_candidates WHERE account_id = {$this->account->id}";
            $result = \DB::query($sql)->execute()->as_array();
            \Cache::set($key, serialize($result), 60 * 30);
        }

        foreach ($result as $key => $value) {
            if(in_array($keyword, [$value['no'], $value['keyword']])){
                $base_url = \Config::get('base_url');
                $this->reply_text("<a href='{$base_url}marketing/vote/rank?id={$value['marketing_id']}&no={$keyword}'>点击查看</a>");
            }
        }

        $this->reply_text('抱歉，该选手不存在！');
    }
}