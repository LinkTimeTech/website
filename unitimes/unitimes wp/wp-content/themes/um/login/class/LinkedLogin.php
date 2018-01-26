<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 13:31
 */

class LinkedLogin extends CommonLogin {
	private $baseHost = "https://www.linkedin.com/uas/oauth2";
	private $redirect_uri = '';
	private $config = ['client_id'=>'81w5i2n6fy1svs','client_key'=>'Hk09ABAAcei03NBt'];
	public $access_token = '';
	private $suffix = 'linked';
	public function __construct() {
		parent::__construct();
		$this->redirect_uri = get_bloginfo('url') . '/wp-content/themes/um/login/linked.php';
	}
	public function get_authorization_code(){
		$uri = 'authorization';
		$params = [
			'response_type' => 'code',
			'client_id' => $this->config['client_id'],
			'redirect_uri' => $this->redirect_uri,
			'state'=>'get_code_status',
			'scope' => 'r_basicprofile,r_emailaddress',
		];
		$format = '%s/%s?%s';
		$url = sprintf($format,$this->baseHost,$uri,http_build_query($params));
		header('Location:'.$url);die;
	}
	
	private function get_access_token($code){
		// $this->access_token = 'AQXJyAhL5MbrPH3XKsLGi9hm-S5xAlbKc8l6hgnar8m3E_9XNxSmL17sPcAeUh5TUw17FzL9g42eIIcET8hNeft1r320lF6gmu0KyW5X4cpcttCVkL4ZG7HiVY4l3zFP42RjQ13MAoTkpDCINnL2Ut3ujK75x8D3vteir-JU1La358Hb7usN2JKo-eDdc2BHMCbTBvxRKVmKpxiZAft-5nbq_f9sQ5XG4Qpn7MlD5sjMIS1OCDXTpzzbxRdei7MM4aKFsuvEZCXgI-mjSi2pmzUlo2x7ZrejjKZGxm2kHkeYpJJWOMRzl_XsG6rJrtARggiEhetX6c3_UPl4VXttrxi8W-ld0A';
		if($this->access_token){
			return true;
		}
		$params = [
			'code'=>$code,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $this->redirect_uri,
			'client_id' => $this->config['client_id'],
			'client_secret' => $this->config['client_key'],
		];
		ksort($params);
		$url = 'https://www.linkedin.com/oauth/v2/accessToken';
		$header = ['Content-Type: application/x-www-form-urlencoded'];
		$res = $this->doRestCall($url,http_build_query($params),'POST',$header);
		if(!array_key_exists('access_token',$res)){
			return false;
		}
		$this->access_token = $res['access_token'];
		return true;
	}
	
	public function get_user_profile($code){
		if(!$this->get_access_token($code)){
			return false;
		}
		$url = "https://api.linkedin.com/v1/people/~:(id,picture-url,first-name,last-name,headline)?format=json";
		$header = [
			'Connection: Keep-Alive',
			'Authorization: Bearer '.$this->access_token
		];
		$res = $this->doRestCall($url,[],'GET',$header);
		
		if(array_key_exists('id',$res)){
			$username = $res['id'] . "_" . $this->suffix;
			$user_id = $user_id = $this->wp_login($username);
			if(!is_wp_error($user_id)){
				$update_data = [
					'ID' => $user_id,
					'display_name' => $res['firstName'] . $res['lastName'],
				];
				$update_data['user_nicename'] = $update_data['display_name'];
				$this->update_avatar($user_id,$res['pictureUrl']);
				
				return wp_update_user($update_data);
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
}