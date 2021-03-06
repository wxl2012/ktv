<?php
/**
 *
 * @package    Fuel
 * @version    1.7
 * @author     王晓雷 zyr.wxl@gmail.com
 * @license    MIT License
 * @copyright  2015 PMonkey Team
 * @link       http://mnzone.cn
 */

/**
 * 基础控制器
 *
 * 主要用于实现必要公共功能
 *
 * @package  app
 * @extends  Controller
 */
abstract class Controller_BaseController extends \Fuel\Core\Controller_Template
{
	public $template = 'template';
	protected $SESSION_WXACCOUNT_KEY = 'WXAccount';
	protected $SESSION_SELLER_KEY = 'seller';
	protected $SESSION_WECHAT_KEY = 'wechat';

	public function before(){
		parent::before();
		
		$this->load_wx_account();

		$this->load_seller();

		$this->load_wechat();
	}

	protected function token(){
		\Session::set('access_token', 'MGE3MTYyYjIzODYzNjY5NDRiYzE2NTUwM2U2ZGQ5ODI=');
	}

	/**
	 * 加载微信信息
	 */
	protected function load_wechat(){

		$ua = \Input::user_agent();

		if( ! preg_match('/MicroMessenger/i', $ua)){
			//不是微信浏览器,无需进行相关操作
			return;
		}

		//是否需要获取openid
		$flag = $this->getNotOpenidAllowed();
		if($flag){
			return;
		}

		if(! \Session::get('wechat', false) && ! \Input::get('openid', false)){
			//获取到openid之后跳转的参数列表
			//$params = \handler\mp\UrlTool::createLinkstring(\Input::get());
			//本站域名
			$baseUrl = \Config::get('base_url');
			$url = $baseUrl . \Input::server('REQUEST_URI');
			$toUrl = urlencode($url);
			$callback = "{$baseUrl}wxapi/oauth2_callback?to_url={$toUrl}";
			$account = \Session::get('WXAccount', \Model_WXAccount::find(1));
			$url = \handler\mp\Tool::createOauthUrlForCode($account->app_id, $callback);
			\Response::redirect($url);
		}else if( ! \Session::get('wechat', false)){
			$wxopenid = \Model_WechatOpenid::query()
				->where(['openid' => \Input::get('openid')])
				->get_one();
			if( ! $wxopenid){
				\Session::set_flash('msg', ['status' => 'err', 'msg' => '未找到您的微信信息,无法确认您的身份! 系统无法为您提供服务!', 'title' => '拒绝服务']);
				return $this->show_message();
			}
			\Session::set('wechat', $wxopenid->wechat);
			\Session::set('OpenID', $wxopenid);
			\Auth::force_login($wxopenid->wechat->user_id);
		}else if( ! \Auth::check() && \Session::get('wechat')->user_id){
			\Auth::force_login(\Session::get('wechat')->user_id);
		}

		$account = \Session::get($this->SESSION_WXACCOUNT_KEY, false);
		if( ! $account && ! \Input::get('account_id', false)){
			$account = \Session::get('OpenID')->account;
			\Session::set($this->SESSION_WXACCOUNT_KEY, $account);
			$this->load_seller($account->seller_id);
		}
	}

	/**
	 * 加载微信公众号
	 */
	protected function load_wx_account(){
		if( ! \Input::get('account_id', false)){
			return;
		}
		$account = \Session::get($this->SESSION_WXACCOUNT_KEY, false);
		if($account && $account->id == \Input::get('account_id')){
			return;
		}

		$account = \Model_WXAccount::find(\Input::get('account_id'));
		\Session::set($this->SESSION_WXACCOUNT_KEY, $account);
		$this->load_seller($account->seller_id);
	}

	/**
	 * 加载商户信息
	 */
	protected function load_seller($id = 0){
		if(! $id && ! \Input::get('seller_id', false)){
			return;
		}else if(\Input::get('seller_id', false)){
			$id = \Input::get('seller_id');
		}
		$seller = \Session::get($this->SESSION_SELLER_KEY, false);
		if($seller && $seller->id == $id){
			return;
		}

		$seller = \Model_Seller::find($id);
		\Session::set($this->SESSION_SELLER_KEY, $seller);
	}

	/**
	 * 加载推荐人信息
	 */
	protected function load_share_user(){
		if( ! \Input::get('share_user_id', false)){
			return;
		}

		$employee = \Session::get('employee', false);
		if($employee && $employee->user_id == \Input::get('share_user_id', false)){
			return;
		}

		$employee = \Model_User::find(\Input::get('share_user_id'));
		\Session::set('employee', $employee);
	}

	/**
	 * 允许没有openid下的访问列表
	 *
	 * @return array
	 */
	protected function getNotOpenidAllowed(){
		$allowed = [
			[
				'module' => 'order',
				'controller' => 'home',
				'actions' => ['save_wxpay_qrcode']
			],
			[
				'module' => 'wxapi',
				'controller' => 'oauth2_callback',
				'actions' => []
			],
			[
				'module' => 'manager',
				'controller' => 'login',
				'actions' => []
			]
		];
		foreach($allowed as $item){
			if(($item['module'] && $item['module'] == \Uri::segment(1, ''))
				&& ($item['controller'] && $item['controller'] == \Uri::segment(2, ''))
				&& ( ! $item['actions'] || in_array(\Uri::segment(3, ''), $item['actions']))){
				return true;
			}
		}
		return false;
	}


	protected function show_message(){
		return \Response::forge(\View::forge('message/moblie'));
	}
}
