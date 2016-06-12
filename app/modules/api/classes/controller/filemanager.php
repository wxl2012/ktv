<?php
/**
 * 文件管理控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

namespace api;

class Controller_FileManager extends Controller_BaseController {

    public function before(){
        parent::before();
    }

    /**
     * 所有图片
     */
    public function action_images(){
        $items = \Model_Attachment::query()
            ->where(['seller_id' => $this->seller->id, 'type' => 'image']);

        $count = $items->count();
        $config = array(
            'pagination_url' => "/api/filemanager/images",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn'
        );

        $pagination = new \Pagination($config);
        $params = ['status' => 'succ', 'msg' => 'ok', 'errcode' => 0];
        $params['pagination'] = $pagination;
        $params['data'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        $this->response($params, 200);
    }

    public function action_upload($type = 'image'){

        $msg = array('status' => 'err', 'msg' => '文件上传失败!', 'errcode' => 10);

        $path = '/uploads/images/';
        $config = array(
            'path' => DOCROOT . $path,
            'randomize' => true,
            'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
        );

        \Upload::process($config);

        if( ! \Upload::is_valid()){
            $msg['errdata'] = array();
            foreach (\Upload::get_errors() as $key => $value) {
                array_push($msg['errdata'], $value['errors']);
            }
            die(json_encode($msg));
        }

        \Upload::save();

        $urls = array();
        foreach(\Upload::get_files() as $file) {
            //$url = "{$path['url']}{$file['saved_as']}";
            $url = "{$path}{$file['saved_as']}";
            $data = array(
                'user_id' => \Auth::check() ? \Auth::get_user()->id : 0,
                'seller_id' => \Session::get('seller')->id,
                'file_name' => $file['saved_as'],
                'type' => $file['type'],
                'mimetype' => $file['mimetype'],
                'extension' => $file['extension'],
                'url' => $url
            );
            $attachment = \Model_Attachment::forge($data);
            $attachment->save();
            array_push($urls, $attachment->to_array());
        }

        $msg = array('status' => 'succ', 'msg' => '文件上传成功!', 'data' => $urls, 'errcode' => 0);
        die(json_encode($msg));
    }
}
