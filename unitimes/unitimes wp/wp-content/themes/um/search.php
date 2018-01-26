<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="referrer" content="always">
	<meta name="robots" content="index, follow">
	
	<title>
		<?php echo _e('搜索','um');?>
	</title>
	
	<meta name="title" content="UNITIMES news">
	<meta name="description" content="">
	<meta name="keywords" content="">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css">
	<!-- font-awesome-->
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	
	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css">
	<!-- jQuery -->
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
</head>
<body class="v-enableBrandingButtons">

<div class="gtco-loader"></div>

<div id="page">
	
	<div class="metabar u-clearfix u-boxShadowBottomThinLighter u-textColorDarker u-fixed u-backgroundTransparentWhiteDarkest u-xs-sizeFullViewportWidth">
		<div class="metabar-inner u-marginAuto u-maxWidth1000 u-flexCenter u-justifyContentSpaceBetween u-paddingLeft20 u-paddingRight20 u-height65 u-xs-height56">
			<div class="metabar-block u-flex1 u-flexCenter">
				<a href="/" class="link u-flex">
					<img class="logoimg" src="<?php bloginfo('template_url'); ?>/images/icon/logo_black.svg" height="25px">
				</a>
			</div>
			<div class="metabar-block u-flex0 u-flexCenter">
				<div class="u-alignMiddle u-inlineBlock u-verticalAlignTop u-height65 u-xs-height56">
					<div class="u-alignBlock">
						<div class="buttonSet buttonSet--wide u-lineHeightInherit">
							<a class="button button--primary button--dark button--withChrome u-accentColor--buttonDark is-inSiteNavBar"
							   href="<?php echo get_lang_url(); ?>">
								<?php get_lang_text();?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="metabar-inner metabar-mb u-marginAuto u-maxWidth1000">
			<div class="head_clik"></div>
			<div class="metabar-mbbox">
				<!--导航选中时 添加class link--mbda -->
				<nav role="navigation" class="metabar-block metabar-block--below u-overflowHiddenY u-height40">
					<?php require_once (__DIR__) . "/nav.php"; ?>
				</nav>
			</div>
			
			<div class="right_col">
				<div class="search-item">
					<?php get_search_form();?>
				</div>
				<div class="login-actions">
                    <!-- 用户头像 -->
					<?php require_once(__DIR__) . "/userinfo.php" ?>
                </div>
			</div>
		
		</div>
	</div>
	<div class="metabar metabar--spacer u-tintBgColor u-height105 u-xs-height95"></div>
	
	<div id="gtco-maine">
		
		<div class="container special_list special_cn u-maxWidth1000">
			
			<div class="row cards-box">
				<div class="position"><?php um_search_query(); ?></div>
				
                <?php if(have_posts()):?>
                    <!--列表-->
                    <?php while(have_posts()): the_post();
                        $post = get_post();
                        
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 animate-box card-box">
                        <a href="<?php echo get_permalink();?>"
                           class="fh5co-project-item image-popup">
                            <figure>
                                <div class="overlay item-center">
                                    <p class="card-intro">
                                        <?php the_post_desc();?>
                                    </p>
                                </div>
                                <img src="<?php the_post_thumbnail_url();?>" class="img-responsive">
                            
                            </figure>
                            <div class="fh5co-text">
                                <h2 class="content-two-line">
                                    <?php the_title();?>
                                </h2>
                                <div class="post-time"><?php echo um_get_date();?></div>
                                <div class="post-stat">
                                    <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                                    <span class="post-review"><?php echo $post->comment_count;?></span>
                                </div>
                            </div>
                            <div class="post-forum">
                                <span onclick="window.open('<?php echo get_category_link($post->post_category[0])?>','_self')"><?php echo get_cat_name($post->post_category[0]);?></span>
                            </div>
                        </a>
                        
                    </div>
                    
                    <?php endwhile;?>
                    <script>
						function sm() {
							var b_h = $(window).height();
							var c_h =b_h-229;
							$('.cards-box').css('min-height',c_h+'px');
						};
						sm();
						$(window).resize(function() { 
							sm();
						});
					</script>
                    
                    <!--列表end-->
                <?php else:?>
                
                <div class="search_mull"><?php _e('抱歉，没有搜索到相关的内容!','um')?></div>
				<script>
					function sm() {
						var b_h = $(window).height();
						var c_h =b_h-229;
						$('.search_mull').css('min-height',c_h+'px');
					};
					sm();
					$(window).resize(function() { 
						sm();
					});
				</script>
                <?php endif;?>
			
			</div>
		</div>
	</div>
    
    <?php
    get_footer();
    ?>


<!-- jQuery Easing -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!-- Modernizr JS -->
<script src="<?php bloginfo('template_url'); ?>/js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/js/respond.min.js"></script>
<![endif]-->
<!-- Waypoints -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.waypoints.min.js"></script>
<!-- Stellar -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.stellar.min.js"></script>
<!-- Main -->
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

</body>
</html>

