<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/27
 * Time: 21:06
 */
require_once(__DIR__ . '/Facebook/autoload.php');
class FaceBookLogin extends CommonLogin {
    private $config = array(
        'appid' => '164181350996841',
        'appkey' => '0170218877e314048172d264af942a58',
    );
    private $redirect_uri = '';
    public function __construct() {
        $this->redirect_uri = get_bloginfo('url') . '/wp-content/themes/um/login/fb.php';
    }
    
    public function get_authorization_code() {
        $fb = new Facebook\Facebook(array(
            'app_id' => $this->config['appid'],
            'app_secret' => $this->config['appkey'],
            'default_graph_version' => 'v2.2',
        ));
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email','public_profile'];
        $loginUrl = $helper->getLoginUrl($this->redirect_uri, $permissions);
        return wp_redirect($loginUrl);
    }
    private function get_access_token($code){
    
    }
    public function get_user_profile($code) {
        $fb = new Facebook\Facebook(array(
            'app_id' => $this->config['appid'],
            'app_secret' => $this->config['appkey'],
            'default_graph_version' => 'v2.2',
        ));
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // echo "!23";
            wp_redirect('/');
            exit();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // var_dump($_SESSION);
            // echo $e->getMessage();
            wp_redirect('/');
            exit;
        }
        $access_token = $accessToken->getValue();
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=id,name,picture',$access_token);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            // echo 'Graph returned an error: ' . $e->getMessage();
            wp_redirect('/');
            exit;
            
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            // echo 'Facebook SDK returned an error: ' . $e->getMessage();
            wp_redirect('/');
            exit;
        }
        $user = json_decode($response->getGraphUser());
        $user_id = $this->wp_login($user->id);
        if(!is_wp_error($user_id)){
            $update_data = [
                'ID' => $user_id,
                'display_name' => $user->name,
                'user_nicename' => $user->name,
            ];
            $this->update_avatar($user_id,$user->picture->url);
            return wp_update_user($update_data);
        }else{
            return false;
        }
    }
    public function get_appid(){
        return $this->config['appid'];
    }
}