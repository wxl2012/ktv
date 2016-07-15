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
        $reply = false;

        $px = substr($this->data->Content, 0, 1);
        $no = intval(substr($this->data->Content, 1));

        if(strpos($this->data->Content, '命运') !== false){
            $reply = new \handler\mp\action\text\ReplyFateImage();
        }else if($this->data->Content == '微信价值'){
            $reply = new \handler\mp\action\text\ReplyValuationImage();
        }else if(intval($this->data->Content) > 0 ||
                (($px >= 'a' && $px <= 'z') || ($px >= 'A' && $px <= 'Z')) && $no > 0){
            $reply = new \handler\mp\action\text\ReplyVote();
        }else if(strpos($this->data->Content, '查询') !== false){
            $reply = new \handler\mp\action\text\ReplyVoteNum();
        }else{
            $response = new \handler\mp\Response($this->account, $this->data);
            $response->text('回复选手编号如"209"进行投票。回复“查询+编号”如“查询209”,查询其他选手成绩。');
            die('success');
        }
        
        $reply->setWechat($this->wechat);
        $reply->setAccount($this->account);
        $reply->setPostData($this->data);
        $reply->handle();
    }

    protected function reply_text($content){
        $response = new \handler\mp\Response($this->account, $this->data);
        $response->text($content);
    }
}