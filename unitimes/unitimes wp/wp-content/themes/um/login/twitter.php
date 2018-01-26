<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 13:23
 */

require_once( __DIR__ . '/../../../../wp-load.php' );
require_once(__DIR__ . "/class/CommonLogin.php");
require_once(__DIR__ . "/class/TwitterLogin.php");
$model =  new TwitterLogin();
if(array_key_exists('oauth_verifier',$_GET)){
    if($model->get_user_profile($_GET['oauth_verifier'])){
        wp_redirect('/');
    }else{
        echo "<script>alert(_e('授权登陆失败'))</script>";
    }
}else if(array_key_exists('error',$_GET)){
    wp_redirect('/wp-login.php');
    die;
}else{
    $model->get_authorization_code();
}
?>