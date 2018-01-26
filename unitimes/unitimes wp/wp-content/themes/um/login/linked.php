<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 13:23
 */

require_once( __DIR__ . '/../../../../wp-load.php' );
require_once(__DIR__) . "/class/CommonLogin.php";
require_once(__DIR__) . "/class/LinkedLogin.php";
$model =  new LinkedLogin();
if(array_key_exists('code',$_GET)){
	if($model->get_user_profile($_GET['code'])){
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