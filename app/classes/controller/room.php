<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * 包房控制器
 *
 * 包房列表 包房详情 包房预订
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Room extends Controller_BaseController
{

    public $template = 'template';
    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $items = \Model_Room::query()
            ->where(['is_deleted' => 0]);

        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/room",
            'total_items'    => $count,
            'per_page'       => \Input::get('count', 15),
            'uri_segment'    => "start",
            'show_first'     => true,
            'show_last'      => true,
            'name'           => 'bootstrap3_cn'
        );

        $pagination = new \Pagination($config);
        $params['pagination'] = $pagination;
        $params['items'] = $items
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        \View::set_global($params);

        $this->template->content = \View::forge('room/index');
    }

    /**
     * KTV包房详情
     *
     * @access  public
     * @return  Response
     */
    public function action_view($id = 0)
    {
        $room = \Model_Room::find($id);

        $params = [
            'item' => $room,
        ];

        \View::set_global($params);
        $this->template->content = \View::forge('room/view');
    }

    /**
     * 包房预订
     *
     * @access  public
     * @return  Response
     */
    public function action_reserve()
    {
        $params['sellers'] = \Model_Seller::query()
            ->where(['is_deleted' => 0, 'status' => 'OPEN'])
            ->get();

        \View::set_global($params);
        $this->template->content = \View::forge('room/reserve');
    }

    /**
     * 根据商家ID获取包房列表
     *
     * @param int $id 商户ID
     */
    public function action_rooms($id = 0){

        $tableRoom = \DB::table_prefix('rooms');
        $tableCategory = \DB::table_prefix('categories');


        $sql = "SELECT c.id, c.name FROM {$tableRoom} AS r LEFT JOIN {$tableCategory} AS c ON r.category_id = c.id WHERE r.seller_id = {$id} AND is_deleted = 0 GROUP BY category_id";
        $result = \DB::query($sql)->execute()->as_array();
        $rooms = \Model_Room::query()
            ->where(['is_deleted' => 0, 'seller_id' => $id])
            ->get();

        $items = [];
        foreach($rooms as $room){
            array_push($items, $room->to_array());
        }

        die(json_encode(['status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $items, 'cats' => $result]));
    }

    /**
     * The 404 action for the application.
     *
     * @access  public
     * @return  Response
     */
    public function action_404()
    {

        return Response::forge(Presenter::forge('welcome/404'), 404);
    }
}
