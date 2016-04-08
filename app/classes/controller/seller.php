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
 * 商户控制器
 *
 * 商户列表 商户详情 商户预订
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Seller extends Controller_BaseController
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
        $items = \Model_Seller::query()
            ->where(['is_deleted' => 0]);

        $items->order_by(array('created_at' => 'desc', 'id' => 'desc'));

        $count = $items->count();
        $config = array(
            'pagination_url' => "/seller",
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
     * 商户详情
     *
     * @access  public
     * @return  Response
     */
    public function action_view($id = 0)
    {
        $params = [
            'item' => \Model_Seller::find($id)
        ];

        \View::set_global($params);
        $this->template->content = \View::forge('seller/view');
    }
}
