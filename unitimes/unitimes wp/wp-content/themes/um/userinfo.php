<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/24
 * Time: 9:34
 */

global $current_user;
//p($current_user);
?>
<a class="switch_btn" href="<?php echo get_lang_url(); ?>"><?php get_lang_text();?></a>
<?php if(is_user_logged_in()):?>
<div class="head_user">
	<div class="user_img">
		<a href=""><?php echo um_get_avatar(); ?></a>
	</div>
	<span class="user_i"></span>
	<div class="user_menu">
		<ul>
			<li class="user_name"><a href=""><?php echo (wp_get_current_user()->display_name);?></a></li>
			<?php if( current_user_can( 'level_7' ) ):
				// check_user_role();
				?>
				<li><a href="/wp-admin"><?php _e('管理网站','um');?></a></li>
			<?php
			endif; ?>
			<?php if(current_user_can('level_1')): ?>
			<li><a href="/wp-admin/post-new.php"><?php _e('发表文章','um');?></a></li>
			<?php endif; ?>
			<li class="um_do"><a href="/wp-login.php?action=logout&redirect_to=/"><?php  _e('退出','um');?></a></li>
		</ul>
	</div>
</div>
<?php else:?>
<div class="head_user hu_mull">
	<div class="user_img">
		<a href=""><?php echo get_avatar(get_current_user_id());?></a>
	</div>
</div>
    <a id="userinfo_btn" href="javascript:"><?php _e('登录', 'um') ?></a>
<?php endif;?>


<!--登录弹窗-->
<script type="text/javascript">
	function uimenu() {
		var height = $(window).height();
		var width = $(window).width();
		var s_height= $('#userinfo_menu').outerHeight(true);
		var s_width= $('#userinfo_menu').outerWidth(true);
		var top =(height-s_height)/2;
		var left =(width-s_width)/2;
		$('#userinfo_menu').css('left',left+'px');
		$('#userinfo_menu').animate({'top':top+'px'},1000)
    }

    uimenu();
	$('#userinfo_btn').click(function(){
		var umHtml = '<div class="userinfo_layer"></div><div id="userinfo_menu" class="userinfo_menu"><div class="userinfo_main"><div class="userinfo_tit <?php echo get_locale();?>"></div><div class="userinfo_nav"><ul><li class="un_1 hide" style="display:none;"><a href=""><?php _e('微信登录','um');?></a></li><li class="un_2 hide" style="display:none;"><a href=""><?php _e('微博登录','um');?></a></li><li class="un_3 fb-login-button"><a  target="_top"  href="/wp-content/themes/um/login/fb.php"><?php _e('登录<span>Facebook</span>','um');?></a></li><li class="un_4"><a href="/wp-content/themes/um/login/twitter.php"><?php echo _e('登录<span>Twitter</span>','um');?></a></li><li class="un_5"><a href="/wp-content/themes/um/login/linked.php"><?php _e('登录<span>Linkedin</span>','um');?></a></li></ul></div></div><div class="userinfo_bg"></div><div class="userinfo_hide">X</div></div>';
		$(document.body).append(umHtml);
		uimenu();
		$(window).resize(function() { 
			uimenu();
		});
		$('.userinfo_hide,.userinfo_layer').click(function(){
			$('#userinfo_menu,.userinfo_layer').remove();
		});
	})
	
</script>
<!--登录弹窗end-->

<script type="text/javascript">
    //(function(d, s, id){
    //    var js, fjs = d.getElementsByTagName(s)[0];
    //    if (d.getElementById(id)) {return;}
    //    js = d.createElement(s); js.id = id;
    //    js.src = "https://connect.facebook.net/<?php //echo get_locale();?>///sdk.js";
    //    fjs.parentNode.insertBefore(js, fjs);
    //}(document, 'script', 'facebook-jssdk'));
    //window.fbAsyncInit = function() {
    //    FB.init({
    //        appId      : '164181350996841',
    //        cookie     : true,
    //        xfbml      : true,
    //        version    : 'v2.8'
    //    });
    //    FB.AppEvents.logPageView();
    //};
    $(function(){
    
        
        
    });
    // function checkLoginState() {
    //     FB.getLoginStatus(function(response) {
    //         statusChangeCallback(response);
    //     });
    // }
    // function fblogin(){
    //     FB.api('/me',function(response){
    //         console.log("获取用户信息",response)
    //     })
    // }
    // function statusChangeCallback(response) {
    //     console.log('statusChangeCallback');
    //     if(response.status != 'connected'){
    //         FB.login(fblogin,{scope: 'public_profile,email'});
    //     }else{
    //         fblogin();
    //     }
    //
    // }
    $(".head_clik").click(function() {
        $(".metabar-mbbox,.login-actions").slideToggle("slow", "linear");
    });
</script>
<script type="text/javascript">
function twonav() {
		var t_nav= $('.metabar-twonav').outerWidth(true);
		var t_menu= $('.metabar-twonavmenu').outerWidth(true);
		var left = 0 - ((t_menu-t_nav+19.5)/2);
		$('.metabar-twonavmenu').animate({'left':left+'px'})
}

twonav();
</script>