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

class ReplyVote extends \handler\mp\action\Text {

    /**
     * 处理请求
     */
    public function handle(){

        $candidate = \Model_MarketingVoteCandidate::query()
            ->where('account_id', $this->account->id)
            ->and_where_open()
            ->where('no', $this->data->Content)
            ->or_where('keyword', $this->data->Content)
            ->and_where_close()
            ->get_one();

        if( ! $candidate){
            $this->reply_text('抱歉，该编号的选手不存在，回复“查询+编号”如“查询209”,查询其他选手成绩。');
        }

        //获取活动信息
        $key = "marketing_{$candidate->marketing_id}";
        try{
            $market = \Cache::get($key);
            $market = unserialize($market);
        }catch (\CacheNotFoundException $e){
            $market = $candidate->marketing;
            $market->limit;
            \Cache::set($key, serialize($market), 60 * 30);
        }

        if($market->start_at > time() || $market->end_at < time()){
            $this->reply_text('抱歉，该编号的选手不在开放时间段，该选手总票数为:' . $candidate->total_gain);
        }

        $statistic = \Model_MarketingRecordStatistic::query()
            ->where(['openid' => $this->data->FromUserName, 'marketing_id' => $market->id])
            ->get_one();

        if($statistic && $market->limit){
            if($market->limit->involved_total_num && $market->limit->involved_total_num <= $statistic->total_num){
                $this->reply_text("您最多只能投{$market->limit->involved_total_num}次票，回复“查询+编号”如“查询209”,查询其他选手成绩。");
            }
        }

        # 新增参与明细
        $record = \Model_MarketingRecord::forge([
            'openid' => $this->data->FromUserName,
            'marketing_id' => $market->id,
            'target_id' => $candidate->id,
            'updated_at' => time()
        ]);
        $record->save();

        $candidate->total_gain += 1;
        $candidate->save();

        $this->reply_text("投票成功，{$candidate->no}号选手{$candidate->title}票数加1，总票数为{$candidate->total_gain}票!\n\n回复“查询+编号”如“查询209”,查询其他选手成绩。");
    }
}