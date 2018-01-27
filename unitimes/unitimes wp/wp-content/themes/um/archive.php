<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
	global $paged;
	$ret = array('code'=>0,'data'=>'','page'=>$paged);
    $map = array(
        'paged' => $paged,
        'cat' => get_query_var('cat'),
        'meta_key' => 'hot5',
        'meta_value' => 1,
        'meta_compare' => '!='
    );
    query_posts($map);
	if(have_posts()){
		$dom = new DOMDocument('1.0','UTF-8');
		while(have_posts()){
			the_post();
			$post = get_post();
			$body = $dom->createElement('div');
			$body->setAttribute('class','col-lg-4 col-md-4 col-sm-6 animate-box card-box fadeInUp animated-fast');
			$a = $dom->createElement('a');
			$a->setAttribute('href',get_the_permalink($post->ID));
			$a->setAttribute('class','fh5co-project-item image-popup');
			$figure = $dom->createElement('figure');
			$figure_div = $dom->createElement('div');
			$figure_div->setAttribute('class','overlay item-center');
			$card_inter = $dom->createElement('div',the_post_desc(32,false));
			$card_inter->setAttribute('class','card-intro');
			$figure_div->appendChild($card_inter);
			$figure_img = $dom->createElement('img');
			$figure_img->setAttribute('src',get_the_post_thumbnail_url($post->ID,'full'));
			$figure_img->setAttribute('class','img-responsive');
			$figure->appendChild($figure_div);
			$figure->appendChild($figure_img);
			$a->appendChild($figure);
			$text_div = $dom->createElement('div');
			$text_div->setAttribute('class','fh5co-text');
			$h = $dom->createElement('h2',get_the_title());
			$h->setAttribute('class','content-two-line');
			$text_div->appendChild($h);
			$post_time = $dom->createElement('div',um_get_date());
			$post_time->setAttribute('class','post-time');
			$text_div->appendChild($post_time);
			$post_stat = $dom->createElement('div');
			$post_stat->setAttribute('class','post-stat');
			$span_like = $dom->createElement('span',(int)get_post_meta($post->ID,'bigfa_ding',true));
			$span_like->setAttribute('class','post-like');
			$post_stat->appendChild($span_like);
			$span_review = $dom->createElement('span',$post->comment_count);
			$span_review->setAttribute('class','post-review');
			$post_stat->appendChild($span_review);
			$text_div->appendChild($post_stat);
			$a->appendChild($text_div);
			$body->appendChild($a);
			$dom->appendChild($body);
		}
		$ret['data'] = $dom->saveHTML();
		$ret['next_page'] = um_get_next_posts_page_link($post->max_num_pages);
		$ret['map'] = $map;
	}else{
		$ret['code'] = 1;
		$ret['desc'] = _e('没有更多相关文章');
	}
	wp_reset_query();
	header('Content-Type:application/json;charset=utf8');
	die(json_encode($ret));
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <meta name="robots" content="index, follow">
    
    <title>
        <?php echo get_cat_name($_GET['cat'])?>
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
	<style type="text/css">
	.container{ padding:0 22px;}
	</style>
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
        
        <div class="container u-maxWidth1000">
            
            <div class="row cards-box">
                <div class="cl">
                <!--置顶-->
                <?php
                    $map = array(
                        'posts_per_page' => 2,
                        'meta_key' => 'hot5',
                        'meta_value' => 1,
                        'cat' => get_query_var('cat'),
                    );
                    query_posts($map);
                    while(have_posts()): the_post();
                    $post = get_post();
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 animate-box animate_cn card-box-md">
                    <a href="<?php the_permalink();?>"
                       class="fh5co-project-item image-popup">
                        <figure>
                            <div class="overlay item-center">
                                <div class="card-intro">
                                    <?php the_post_desc(32); ?>
                                </div>
                            </div>
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive">
                        
                        </figure>
                        <div class="fh5co-text">
                            <h2 class="content-two-line">
                                <?php the_title();?>
                            </h2>
                            <div class="post-time">
                                <?php echo um_get_date();?>
                            </div>
                            <div class="post-stat">
                                <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                                <span class="post-review">
                                    <?php echo $post->comment_count;?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    endwhile;
                ?>
                <!--end-->
                
                </div>
                
                
                
                
                
                <div id="view-list">
                <!--列表-->
                <?php
				$i = 1;
                wp_reset_query();
                $map = array(
                    'paged' => 1,
                    'cat' => get_query_var('cat'),
                    'meta_key' => 'hot5',
                    'meta_value' => 1,
                    'meta_compare' => '!='
                );
                query_posts($map);
                if(have_posts()):
                while(have_posts()): the_post();
                $post = get_post();
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 animate-box card-box 
				<?php 
				if ($i < '7')
				{echo 'fadeInUp animated-fast';}
				?>
                ">
                    <a href="<?php the_permalink(); ?>"
                       class="fh5co-project-item image-popup">
                        <figure>
                            <div class="overlay item-center">
                                <div class="card-intro">
                                    <?php the_post_desc();?>
                                </div>
                            </div>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-responsive">
                        
                        </figure>
                        <div class="fh5co-text">
                            <h2 class="content-two-line">
                                <?php the_title();?>
                            </h2>
                            <div class="post-time"><?php echo um_get_date();?></div>
                            <div class="post-stat">
                                <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                                <span class="post-review">
                                    <?php echo $post->comment_count;?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <?php
					$i ++;
                    endwhile;
                ?>
                <script>
						function sm() {
							var b_h = $(window).height();
							var c_h =b_h-229;
							$('.cards-box').css('min-height',c_h+'px');
                        }

                        sm();
						$(window).resize(function() { 
							sm();
						});
					</script>
                <?php else:?>

                    <div class="search_mull"><?php _e('抱歉，还没有内容！','um')?></div>
                    
                <?php endif;?>
                <!--列表end-->
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
    get_footer();
    ?>

<script>
	function sm() {
		var b_h = $(window).height();
		var c_h =b_h-229;
		$('.search_mull').css('min-height',c_h+'px');
    }

    sm();
	$(window).resize(function() {
		sm();
	});
</script>
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
<div class="hide" id="ajax_request_url" data-cat="<?php echo $_GET['cat'];?>" url="<?php echo um_get_next_posts_page_link();?>">

</div>
<script>
    $(function(){
        var isLoad = false;
        $(window).scroll(function (){
            
            var ScrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
            var url = $("#ajax_request_url").attr('url');
            var cat = $("#ajax_request_url").data('cat');
            var isScrollDone = $(document).scrollTop() >= $(document).height() - $(window).height();
            if(isLoad === false && ScrollBottom < 200){
                isLoad = true;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {posts_per_page: 18,cat: cat},
                    success: function(ret){
                        console.log(typeof ret);
                        if(ret.code === 0){
                            $("#view-list").append(ret.data);
                            setTimeout(function(){
                                $("#ajax_request_url").attr('url',ret['next_page']);
                                isLoad = false;
                            },100)
                        }
                    }
                });
            }
        });
    })
</script>

</body>
</html>

