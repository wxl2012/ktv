<?php

/**
 * 微信公众平台推送的文本消息处理类
 *
 * 投票,使用redis存储数据
 *
 * @package    Fuel
 * @version    1.7
 * @author     Ray zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */
namespace handler\mp\action\text;

class ReplyVoteRedis extends \handler\mp\action\Text {

    /**
     * 处理请求
     */
    public function handle(){

        $keyword = (string)$this->data->Content;

        //被投人数据
        $candidateKey = md5("candidate_{$this->data->Content}");
        try{
            $candidate = \Cache::get($candidateKey);
        }catch (\CacheNotFoundException $e){
            $this->reply_text('抱歉，该编号的选手不存在，回复“查询+编号”如“查询209”,查询其他选手成绩。');
        }

        //活动数据
        $key = "marketing_{$candidate['marketing']}";
        try{
            $marketing = \Cache::get($key);
        }catch (\CacheNotFoundException $e){
            $this->reply_text('抱歉，该编号的选手已被封禁。');
        }

        //投票记录
        $openid = (string)$this->data->FromUserName;
        $key = md5("record_{$openid}_{$candidate['marketing']}");

        $record = [
            'openid' => $openid,
            'marketing' => $candidate['marketing'],
            'total_num' => 0,
            'candidates' => ''
        ];

        try{
            $record = \Cache::get($key);
        }catch (\CacheNotFoundException $e){
            \Cache::set($key, $record);
        }

        //投票合法性检测
        if($marketing['start_at'] > time() || $marketing['end_at'] < time()){
            $this->reply_text('抱歉，该编号的选手不在开放时间段，该选手总票数为:' . $candidate['total_gain']);
        }else if($record && isset($marketing['involved_total_num']) && $marketing['involved_total_num']){
            if(isset($marketing['involved_total_num']) && $marketing['involved_total_num'] && $marketing['involved_total_num'] <= $record['total_num']){
                $this->reply_text("您最多只能投{$marketing['involved_total_num']}次票，回复“查询+编号”如“查询209”,查询其他选手成绩。");
            }
        }

        $record['total_num'] += 1;
        $record['candidates'] .= "{$keyword},";
        \Cache::set($key, $record);

        //投票成功
        $candidate['total_gain'] += 1;
        \Cache::set($candidateKey, $candidate);

        $this->reply_text("投票成功，{$keyword}号选手{$candidate['name']}票数加1，总票数为{$candidate['total_gain']}票!\n\n回复“查询+编号”如“查询209”,查询其他选手成绩。");
    }
}