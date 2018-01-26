<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 13:32
 */
interface Login{
	public function get_user_profile($code);
	public function get_authorization_code();
}
class CommonLogin{
	protected $last_url = array();
	protected $httpinfo = [];
	public function __construct() {
	
	}
	
	/**
	 * 子类重写
	 */
	public function get_authorization_code(){}
	/**
	 * 子类重写
	 */
	public function get_user_profile($code){}
	
	protected function wp_login($username){
		$password = md5(time() . rand(0,time()));
		if(!username_exists($username)){
			$user_id = wp_create_user($username,$password);
		}else{
			$user_id = get_user_by('login',$username)->ID;
		}
		wp_set_current_user($user_id, $username);
		wp_set_auth_cookie($user_id,true);
		do_action('wp_login', $username);
		return $user_id;
	}
	
	protected function update_avatar($user_id,$url){
		return update_user_meta($user_id,'wp_user_avatar',$url);
	}
	
	
	public function doRestCall($url,$params,$method,$header=[],$format='json'){
		$ch = curl_init();
		$this->last_url[] = $url;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (strtolower($method) != 'get') {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			// curl_setopt($ch, CURLOPT_POST, true);
		}
		curl_setopt($ch, CURLOPT_TIMEOUT, 29);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
		$url_part = parse_url($url);
		if ($url_part['scheme'] == 'https') {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}
		if (!empty($header)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		$this->httpinfo = $info;
		if ($data === false ) {
			return false;
		}
		if($format == 'json'){
			return json_decode($data, true);
		}
		
		return $data;
		
	}
}