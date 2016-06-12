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

    public function action_upload(){
        \Config::load('global');

        $msg = array('status' => 'err', 'msg' => '文件上传失败!', 'errcode' => 10);

        $path = \handler\common\UploadHandler::get_upload_path(\Input::get('module', 4), \Input::post('path'));

        $config = array(
            'path' => "{$path['root_directory']}/{$path['path']}"
        );

        //检测文件目录是否存在
        if( ! file_exists($config['path'])){
            if( ! \handler\common\UploadHandler::create_directory($path['root_directory'], $path['path'])){
                die(json_encode(array('status' => 'err', 'msg' => '文件目录不存在，无法存储文件!', 'errcode' => 10001)));
            }
        }

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
            $url = "{$path['url']}{$file['saved_as']}";

            $data = array(
                'user_id' => \Auth::check() ? \Auth::get_user()->id : 0,
                'seller_id' => \Session::get('seller')->id,
                'file_name' => $file['saved_as'],
                'type' => \Input::post('type', 'image'),
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
