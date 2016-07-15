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

class ReplyVoteNumRedis extends \handler\mp\action\Text {

    /**
     * 处理请求
     */
    public function handle(){
        $keyword = str_replace('查询', '', $this->data->Content);
        //被投人数据
        $candidateKey = md5("candidate_{$keyword}");
        try{
            $candidate = \Cache::get($candidateKey);
        }catch (\CacheNotFoundException $e){
            $this->reply_text('抱歉，该选手不存在！');
        }

        $base_url = \Config::get('base_url');
        $this->reply_text("<a href='{$base_url}marketing/vote/rank?id={$candidate['marketing']}'>点击查看</a>");
    }
}