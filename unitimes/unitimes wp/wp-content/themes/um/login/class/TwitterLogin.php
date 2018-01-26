<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/26
 * Time: 12:14
 */

require_once(__DIR__ . '/twitter/autoload.php');
class TwitterLogin extends CommonLogin {
    private $config = array(
        'appkey' =>'hrSlKiov0kageZvghKvjJdx2F',
        'app_secret' => 'GhQDCgv0Es4SIrBSJwW5b8bqWyaHnhQ8VOZEyVfMFu8yxkRIho',
        'appid' => '934006875837808642',
        'token' => '934006875837808642-TUqwFaejQWxrN87pFgZjfIqhmcNRZjg',
        'token_secret' => 'Xt4BaBULzQkeeaIwvjg9HrOUenXCeLVZqpyWIZ7uDDAQq',
    );
    private $user_id = '';
    public function __construct() {
        parent::__construct();
        $this->model = new twitter\TwitterOAuth($this->config['appkey'],$this->config['app_secret']);
        
    }
    
    public function get_authorization_code(){
        $oauth = $this->model->oauth('oauth/request_token');
        if(!array_key_exists('oauth_callback_confirmed',$oauth)){
            return false;
        }
        $oauth_access = $oauth['oauth_token'];
        $params = array(
            'oauth_token' => $oauth_access,
        );
        $url = $this->model->url('oauth/authenticate',$params);
        wp_redirect($url);
        die;
    }
    
    private function get_access_token($code){
        $params = array(
            'oauth_verifier' => $code,
            'oauth_token' => $_GET['oauth_token'],
        );
        $res = $this->model->oauth('oauth/access_token',$params);
        if(array_key_exists('user_id',$res)){
            $this->user_id = $res['user_id'];
            return $res;
        }
        return false;
    }
    
    public function get_user_profile($code){
        if(!$token = $this->get_access_token($code)){
            return false;
        }
        $screen = $token['screen_name'];
        $res = $this->model->get('users/show',['user_id'=>$token['user_id'],'screen_name' => $screen]);
        if(array_key_exists('id',$res)){
            $username = $res->id ;
            $user_id = $user_id = $this->wp_login($username);
            if(!is_wp_error($user_id)){
                $update_data = [
                    'ID' => $user_id,
                    'display_name' => $res->screen_name,
                    'user_nicename' => $res->name,
                ];
                $this->update_avatar($user_id,$res->profile_image_url);
                return wp_update_user($update_data);
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }
}