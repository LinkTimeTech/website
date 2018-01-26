<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 16:44
 */

class WechatLogin extends CommonLogin {
	private $config = [
		'appid' => '',
		'appkey' => '',
	];
	private $access_token = '';
	private $openid = '';
	private $redirect_uri = 'http://www.bannerchina.com/wp-content/themes/um/login/wechat.php';
	public function __construct() {
		parent::__construct();
	}
	
	public function get_authorization_code(){
		$params = [
			'response_type' => 'code',
			'scope' => 'snsapi_login',
			'redirect_uri' => $this->redirect_uri,
			'appid' => $this->config['appid'],
			'state' => 'wechat_status',
		];
		$host = "https://open.weixin.qq.com/connect/qrconnect?".http_build_query($params);
		wp_redirect($host);die;
	}
	
	private function get_access_token($code){
		if($this->access_token){
			return true;
		}
		$host = "https://api.weixin.qq.com/sns/oauth2/access_token?";
		$params = [
			'grant_type' =>  'authorization_code',
			'code'=>$code,
			'appid' => $this->config['appid'],
			'secret' => $this->config['appkey'],
		];
		$host .= http_build_query($params);
		$res = $this->doRestCall($host,[],'GET');
		if(empty($res)){
			return false;
		}
		if(!array_key_exists('access_token',$res)){
			return false;
		}
		$this->access_token = $res['access_token'];
		$this->openid = $res['unionid'];
		return true;
	}
	
	public function get_user_profile($code){
		$this->get_access_token($code);
		$host = "https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s";
		$host = sprintf($host,$this->access_token,$this->openid);
		$res = $this->doRestCall($host,[],'GET');
		if(!array_key_exists('errcode',$res)){
			$username = $this->openid;
			$user_id = $user_id = $this->wp_login($username);
			if(!is_wp_error($user_id)){
				$update_data = [
					'ID' => $user_id,
					'display_name' => $res['nickname'],
				];
				$this->update_avatar($user_id,$res['headimgurl']);
				return wp_update_user($update_data);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}