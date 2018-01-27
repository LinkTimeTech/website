<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="referrer" content="always">
	<meta name="robots" content="index, follow">
	
	<title>
		<?php the_title(); ?>
	</title>
	<?php
		while(have_posts()): the_post();
		$post = get_post();
		$current_post_id = $post->ID;
		// the_excerpt();die;
		$user = get_user_by('ID',$post->post_author);
		//echo "<pre>";
		//print_r($comments);
		////die;
		//print_r($post);
	?>
	<meta name="title" content="Unitimes">
	<meta name="referrer" content="always">
	<meta name="description" content="<?php the_post_desc(64);?>">
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="@Unitimes" />
	<meta name="twitter:creator" content="@Unitimes" />
	<meta name="twitter:title" content="<?php the_title();?>" />
	<meta name="twitter:url" content="<?php the_permalink();?>" />
	<meta name="twitter:description" content="<?php the_post_desc(64);?>" />
	<meta name="twitter:image" content="<?php the_post_thumbnail_url();?>" />
	<?php
		$url = get_the_post_thumbnail_url();
		list($width,$height) = getimagesize($url);
	?>
	<meta name="twitter:image:width" content="<?php echo $width;?>" />
	<meta name="twitter:image:height" content="<?php echo $height;?>" />
	<meta name="keywords" content="">
    <style>
        .aligncenter .wp-caption-text{
            text-align: center;
            color: #8e8a8a;
            font-size: 14px;
        }
        .alignright .wp-caption-text{
            text-align: right;
            color: #8e8a8a;
            font-size: 14px;
        }
        .alignleft .wp-caption-text{
            text-align: left;
            color: #8e8a8a;
            font-size: 14px;
        }
        .alignnone .wp-caption-text{
            display: none;
        }
    </style>
	<!-- jQuery -->
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/article-font.css">
 	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/article.css">
</head>

<body class="browser-chrome os-mac is-withMagicUnderlines v-glyph v-glyph--m2 v-enableBrandingButtons is-js postShowScreen">
<div class="site-main surface-container">
	<div class="surface">
		<div class="screenContent surface-content">
			<div class="metabar u-clearfix  u-boxShadowBottomThinLighter u-textColorDarker u-fixed u-backgroundTransparentWhiteDarkest u-xs-sizeFullViewportWidth u-tintBgColor u-tintSpectrum">
				<div class="metabar-inner u-marginAuto u-maxWidth960 u-flexCenter u-justifyContentSpaceBetween u-paddingLeft20 u-paddingRight20 u-height65 u-xs-height56">
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
				<div class="metabar-inner metabar-mb u-marginAuto" style="max-width:1015px !important;">
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
            <style type="text/css">
			.jiathis_style_32x32 .jtico{ display:none !important; background:0 !important;}
			.post_topshare_wrap li a span{ display:none !important; opacity:0; background:0 !important;}
			</style>
			
			<main role="main">
				<div class="u-maxWidth1000 u-marginAuto">
					<div class="position"><a href="/"><?php echo _e('首页','um');?></a> > <a href="<?php echo get_category_link($post->post_category[0])?>"><?php echo get_cat_name($post->post_category[0]);?></a> > <?php echo _e('正文','um');?></div>
				</div>
				<?php 
					$twitter = "https://twitter.com/intent/tweet";
					$params = array(
						'text' => get_the_title(),
						'url' => get_the_permalink(),
					);
					$twitter .= "?" . http_build_query($params);
				?>
				<article
					class="u-minHeight100vhOffset65 u-overflowHidden postArticle postArticle--full is-withAccentColors"
					lang="cn" data-scroll="native">
					<header class="container u-maxWidth740">
						<div class="post_topshare_wrap jiathis_style_32x32">
							<ul class="share_ul">
                                <li class="ptw_like <?php get_like_status(); ?>" data-id="<?php the_ID(); ?>"
                                    data-action="ding"><a href="javascript:"></a></li>
                                    <li class="ptw_wx"><a class="jiathis_button_weixin"></a></li>
                                    <li class="ptw_wb"><a class="jiathis_button_tsina"></a></li>
                                    <li class="ptw_tw "><a  target="_blank" href="<?php echo $twitter;?>"></a></li>
                                    <li class="ptw_fb"><a class="jiathis_button_fb"></a></li>
                                    <li class="ptw_in"><a class="jiathis_button_linkedin"></a></li>
                                
							</ul>
						</div>
						<div class="uiScale uiScale-ui--regular uiScale-caption--regular postMetaHeader u-paddingBottom10 row">
							<div class="col u-size12of12">
								<div class="uiScale uiScale-ui--regular uiScale-caption--regular postMetaLockup postMetaLockup--authorWithBio u-flexCenter">
									<div class="u-flex0">
										<!--<a class="link avatar u-baseColor&#45;&#45;link ui-linkSubtle" href="#">-->
										<!--<img src="--><?php //bloginfo('template_url'); ?><!--/images/xue.jpg" width="50px" height="50px" class="avatar-image">-->
                                        <?php echo um_get_avatar($post->post_author,50);?>
										<!--</a>-->
									</div>
									<div class="u-flex1 u-paddingLeft15 u-overflowHidden">
										<div class="u-lineHeightTightest u-xs-fontSize11 u-paddingBottom7">
											<?php echo get_the_author_meta('display_name',$post->post_author);?>
										</div>
										<div class="ui-caption postMetaInline">
											<time><?php
                                                    echo date('Y.m.d',strtotime($post->post_date));
                                                ?></time>
											<!--<span class="middotDivider u-fontSize12"></span>-->
											<!--<span class="readingTime"title="3 min read"></span>-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</header>
					<div class="postArticle-content" data-scroll="native">
						<section class="section section--body section--first">
							<div class="section-content">
								<div class="section-inner sectionLayout--insetColumn se_<?php echo get_locale();?>">
									<h1 class="graf graf--h3 graf--leading graf--title">
										<?php the_title();?>
									</h1>
									<div class="blog-content" style="font-size: 17px!important;">
                                        <?php the_content();?>
                                        
                                    </div>
									
									
								</div>
							</div>
						</section>
						<!--<section name="5e3a"class="section section&#45;&#45;body section&#45;&#45;last"></section>-->
					</div>
					<footer class="u-paddingTop30">
						<div class="container u-maxWidth740">
							<div class="row">
								<div class="col u-size12of12">
									<div class="u-paddingBottom30" style="position: relative;">
                                        <?php if($post->tags_input):?>
										<ul class="tags tags--postTags tags--borderless">
											<?php echo _e('标签','um');?>：
                                            <?php
                                                $format = '<li><a href="%s" class="link u-baseColor--link ui-linkSubtle">%s</a></li>';
                                                $tags = get_the_tags($post->ID);
                                                // print_r($tags);
                                                foreach($tags as $tag){
                                                    echo sprintf($format,get_tag_link($tag),$tag->name);
                                                }
                                            ?>
											
										</ul>
                                        <?php endif;?>
                                        <div class="bott_btnbox jiathis_style_32x32">
                                            <ul class="share_ul">
                                                <li class="ptw_like <?php get_like_status(); ?>" data-action="ding"
                                                    data-id="<?php the_ID(); ?>"><span
                                                            id="like_num"><?php echo (int)get_post_meta(get_the_ID(), 'bigfa_ding', true); ?></span><a
                                                            href="javascript:"></a></li>
                                                <li class="ptw_wx"><div><a class="jiathis_button_weixin"></a></div></li>
                                                <li class="ptw_wb"><a class="jiathis_button_tsina"></a></li>
                                                <li class="ptw_tw "><a target="_blank" href="<?php echo $twitter;?>"></a></li>
                                                <li class="ptw_fb"><a class="jiathis_button_fb"></a></li>
                                                <li class="ptw_in"><a class="jiathis_button_linkedin"></a></li>

                                            </ul>
                                        </div>
									</div>
									
								</div>
							</div>
       
							<div class="post_comment">
								<div class="post_com_tit"> <?php _e('文章评论','um');?></div>
                                <?php if(!is_user_logged_in()):?>
                                    <div class="post_com_user"><a id="post_log_btn"
                                                                  href="javascript:"><?php echo _e('登录', 'um'); ?></a> <?php echo _e('后参与评论', 'um'); ?>
                                    </div>
                                <?php else:?>
								<div class="post_com_text">
									<form action="<?php bloginfo('url');?>/wp-admin/admin-ajax.php" class="js-ajax-form" onsubmit="return false;" method="post">
                                        <input type="hidden" name="action" value="comment_post">
										<textarea name="comment" placeholder="<?php echo _e('发表你的看法……','um');?>" class="J-cnt-box"></textarea>
                                        <input type="hidden" name="comment_post_ID" value="<?php the_ID()?>" id="comment_post_ID">
                                        <input type="hidden" name="comment_parent" id="comment_parent" value="<?php echo $post->post_parent; ?>">
                                        <?php if(um_comments_open()):?>
										<input value="<?php echo _e('评论','um');?>" class="J-text-btn js-ajax-submit"  type="submit">
                                        <?php else:?>
                                        <input value="<?php echo _e('评论','um');?>" class="J-text-btn" type="button" onclick="alert('<?php _e('您无法此操作','um');?>')">
                                        <?php endif;?>
									</form>
								</div>
                                <?php endif;?>
								<div class="tie-newest">
									<div class="tie-list">
										<?php
										if ( comments_open() || get_comments_number() ) :
                                            comments_template();
										endif;
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="streamItem new_streamItem view_cn streamItem--placementCardGrid">
							<div class="u-clearfix u-backgroundGrayLightest">
								<div class="row u-marginAuto u-maxWidth1000 u-paddingBottom20">
									<div class="tit">
										<?php echo _e('相关文章','um');?>
									</div>
                                    <?php

                                    wp_reset_query();
                                    query_posts(array('posts_per_page' => 3,"order"=>'desc'));
                                    while(have_posts()):the_post();
                                    $cat = get_the_category();
                                    $post = get_post();
                                    ?>
									<div class="col u-padding8 u-xs-size12of12 u-size4of12">
										<div class="uiScale uiScale-ui--small uiScale-caption--regular u-height280 u-sizeFullWidth u-backgroundWhite u-borderCardBorder u-boxShadow u-borderBox u-borderRadius4"
											 data-scroll="native">
											<a class="link link--noUnderline u-baseColor--link ui-linkSubtle"
											   href="<?php the_permalink($post); ?>">
												<div class="u-backgroundCover u-backgroundColorGrayLight u-height100 u-sizeFullWidth u-borderBottomLight u-borderRadiusTop4"
													 style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
											</a>
											<div class="u-padding15 u-borderBox u-flexColumn u-height180">
												<a class="link link--noUnderline u-flex1 u-baseColor--link ui-linkSubtle"
												   href="<?php the_permalink($post); ?>">
													<div class="ui-caption postMetaInline u-noWrapWithEllipsis u-marginBottom7"
														 style="font-size:15px !important;">
                                                        <!--a href="<?php echo get_category_link($cat[0]->term_id);?>"></a--><?php echo ($cat[0]->name); ?>
													</div>
													<div class="ui-heading ui-clamp2 u-textColorDarkest u-contentSansBold u-maxHeight2LineHeightTighter u-lineClamp2 u-textOverflowEllipsis u-letterSpacingTight u-paddingBottom2"
														 style="font-size: 17px !important;">
														<?php the_title();?>
													</div>
												</a>
												<div class="u-paddingTop10 u-flex0 u-flexCenter">
													<div class="u-flex1 u-minWidth0 u-marginRight10">
														<div class="u-flexCenter">
															<div class="postMetaInline-avatar u-flex0">
                                                                <?php echo um_get_avatar($post->post_author,32);?>
																<!--<a class="link avatar u-baseColor&#45;&#45;link ui-linkSubtle" href="#">-->
																<!--<img src="--><?php //echo um_get_avatar_url(); ?><!--"-->
																	 <!--class="avatar-image u-size36x36">-->
																<!--</a>-->
															</div>
															<div class="postMetaInline postMetaInline-authorLockup u-flex1 u-noWrapWithEllipsis u-xs-fontSize10">
																<!--<a class="link link link&#45;&#45;darken link&#45;&#45;darker u-baseColor&#45;&#45;link ui-linkSubtle" href="#">-->
																<?php echo get_the_author();?>
																<!--</a>-->
																<div class="u-fontSize12 u-baseColor--textNormal u-textColorNormal">
																	<time><?php echo um_get_date();?></time>
																	<!--<span class="readingTime u-textColorNormal" title="1 min read"></span>-->
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="post-stat">
												<span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
												<span class="post-review"><?php echo get_post()->comment_count;?></span>
											</div>
										</div>
									</div>
                                    <?php endwhile;?>
									
								</div>
								<div class="row u-marginAuto u-maxWidth1000 u-paddingBottom20">
									<div class="tit">
										<?php echo _e('热门推荐','um');
                                        //$post = get_posts(array(
                                        //    'numberposts' => 3,
                                        //    'meta_key' => 'hot',
                                        //    'meta_value' => 0,
                                        //));
										?>
									</div>
                                    <?php
                                    wp_reset_query();
                                    query_posts(array('posts_per_page' => 3,"meta_key"=>'hot','meta_value'=>1));
                                    while(have_posts()):the_post();
                                    $cat = get_the_category();
                                    $post = get_post();
                                    ?>
									<div class="col u-padding8 u-xs-size12of12 u-size4of12">
										<div class="uiScale uiScale-ui--small uiScale-caption--regular u-height280 u-sizeFullWidth u-backgroundWhite u-borderCardBorder u-boxShadow u-borderBox u-borderRadius4"
											 data-scroll="native">
											<a class="link link--noUnderline u-baseColor--link ui-linkSubtle"
											   href="<?php the_permalink($post);?>" >
												<div class="u-backgroundCover u-backgroundColorGrayLight u-height100 u-sizeFullWidth u-borderBottomLight u-borderRadiusTop4"
													 style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
											</a>
											<div class="u-padding15 u-borderBox u-flexColumn u-height180">
												<a class="link link--noUnderline u-flex1 u-baseColor--link ui-linkSubtle"
												   href="<?php the_permalink($post); ?>">
													<div class="ui-caption postMetaInline u-noWrapWithEllipsis u-marginBottom7"
														 style="font-size:15px !important;">
                                                        <!--a href="<?php echo get_category_link($cat[0]->term_id);?>"></a--><?php echo ($cat[0]->name); ?>
													</div>
													<div class="ui-heading ui-clamp2 u-textColorDarkest u-contentSansBold u-maxHeight2LineHeightTighter u-lineClamp2 u-textOverflowEllipsis u-letterSpacingTight u-paddingBottom2"
														 style="font-size: 17px !important;">
														<?php the_title();?>
													</div>
												</a>
												<div class="u-paddingTop10 u-flex0 u-flexCenter">
													<div class="u-flex1 u-minWidth0 u-marginRight10">
														<div class="u-flexCenter">
															<div class="postMetaInline-avatar u-flex0">
																<!--<a class="link avatar u-baseColor&#45;&#45;link ui-linkSubtle" href="#">-->
																<!--<img src="--><?php //bloginfo('template_url'); ?><!--/images/xue.jpg"-->
																	 <!--class="avatar-image u-size36x36">-->
                                                                <?php echo um_get_avatar($post->post_author,32);?>
																<!--</a>-->
															</div>
															<div class="postMetaInline postMetaInline-authorLockup u-flex1 u-noWrapWithEllipsis u-xs-fontSize10">
																<!--<a class="link link link&#45;&#45;darken link&#45;&#45;darker u-baseColor&#45;&#45;link ui-linkSubtle" href="#">-->
																<?php echo get_the_author();?>
																<!--</a>-->
																<div class="u-fontSize12 u-baseColor--textNormal u-textColorNormal">
																	<time><?php echo um_get_date();?></time>
																	<!--<span class="readingTime u-textColorNormal" title="1 min read"></span>-->
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="post-stat">
												<span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
												<span class="post-review"><?php echo get_post()->comment_count;?></span>
											</div>
										</div>
									</div>
                                    <?php endwhile;?>
								</div>
								<div class="u-textAlignCenter">&copy; UNITIMES. All
									Rights Reserved.
								</div>
							</div>
						</div>
					</footer>
				</article>
			</main>
			<?php break; endwhile;
			?>
		</div>
	</div>
</div>
<div class="surface-scrollOverlay"></div>

</body>
<?php wp_comment_form_unfiltered_html_nonce();?>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.flexText.js"></script>
<!--点击回复动态创建回复块-->
<script type="text/javascript">
    $(document).on('click','.pl-hf',function(){
        var btn = $(this);
        //获取回复人的名字
        var fhName = $(this).parents('.date-dz-right').parents('.date-dz').siblings('.pl-text').find('.comment-size-name').html();
        //回复@
        var reply = '<?php _e("回复",'um');?>';
        var fhN = reply+'@'+fhName;
        var fhHtml = '<div class="hf-con pull-left"><form action="<?php bloginfo('url');?>/wp-admin/admin-ajax.php" onsubmit="return false" method="post" class="js-ajax-form"><input type="hidden" name="action" value="comment_post"> <textarea class="content comment-input hf-input" placeholder="'+fhN+'" onkeyup="keyUP(this)" name="comment"></textarea> <div class="hf-pl"><input type="hidden" name="comment_post_ID" value="<?php echo $current_post_id;?>"/><input type="hidden" name="comment_parent" value="'+btn.data('pid')+'"/><input value="<?php echo _e('评论','um');?>" class="hf-pl_btn js-ajax-submit" type="submit"><?php um_nonce();?></form></div></div>';
        //显示回复
        if($(this).is('.hf-con-block')){
            $(this).parents('.date-dz-right').parents('.date-dz').append(fhHtml);
            $(this).removeClass('hf-con-block');
            $('.content').flexText();
            $(this).parents('.date-dz-right').siblings('.hf-con').find('.pre').css('display','none');
            //input框自动聚焦
            // $(this).parents('.date-dz-right').siblings('.hf-con').find('.hf-input').val('').focus().val(fhN);
        }else {
            $(this).addClass('hf-con-block');
            $(this).parents('.date-dz-right').siblings('.hf-con').remove();
        }
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109516558-1"></script>
<script>        window.dataLayer = window.dataLayer || [];
    
    function gtag() {
        dataLayer.push(arguments);
    }
    
    gtag('js', new Date());
    gtag('config', 'UA-109516558-1');
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?dc9c3afdb0d4ee781a538922a7c9aaa9";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();    </script>

<script type="text/javascript">
    $(function(){
        // 监听滚动事件
        $(window).scroll(function(){
            // 获得div的高度
            var h = $(".post_comment").offset().top -300;
            if($(this).scrollTop()>h){
                // 滚动到指定位置
                $(".post_topshare_wrap").hide();
            } else {
                $(".post_topshare_wrap").show();
            }
        });
    })
</script>
<script type="text/javascript">
    $(function(){
        $(document).on("click",".js-ajax-submit",function(){
            var btn = $(this),
            post = false;
            
            if(btn.hasClass('hf-pl_btn')){
                var form = btn.parent().parent();
            }else{
                var form = btn.parent();
                post = true;
            }
            var url = form.attr('action'),
                method = form.attr('method'),
                data = form.serialize();
            $.ajax({
                type:method,
                url: url,
                data: data,
                success:function(res){
                    if(res.code == 0){
                        alert(res.desc);
                        return;
                    }
                    $(".tie-list").empty().html(res.html);
                    //if(post){
                    //    $(".tie-newest").prepend(res.html);
                    //    form.find('textarea[name=comment]').val('');
                    //}else{
                    //    var tgt = $("div[data-common-id="+res.id+"]");
                    //    console.log(tgt.get(0))
                    //    if(tgt.length){
                    //        $(res.html).insertAfter(tgt);
                    //        tgt.insertAfter(res.html);
                    //        //tgt.remove();
                    //    }
                    //}
                    console.log(res);
                }
            })
        });
        $.fn.postLike = function() {
            if (false) {
                alert("<?php _e('您已赞过本博客','um');?>");
                return false;
            } else {
                var id = $(this).data("id"),
                    action = $(this).data('action'),
                    rateHolder = $('#like_num');
                var ajax_data = {
                    action: "bigfa_like",
                    um_id: id,
                    um_action: action
                };
                $.post("/wp-admin/admin-ajax.php", ajax_data, function(data) {
                    if(typeof data == 'string'){
                        data = JSON.parse(data)
                    }
                    if(data.code == 1){
                        var like_btn = $(".ptw_like");
                        if(like_btn.hasClass('done')){
                            like_btn.removeClass('done')
                        }else{
                            like_btn.addClass('done');
                        }
                        $(rateHolder).html(data.data);
                    }else{
                        alert(data.msg);
                    }
                });
                return false;
            }
        };
        $.fn.commentLike = function() {
            if (false) {
                alert("<?php _e('您已赞过本评论','um');?>");
                return false;
            } else {
                var id = $(this).data("comment-id"),
                    action = $(this).data('action'),
                btn = this;
                var ajax_data = {
                    action: "bigfa_like",
                    um_id: id,
                    um_action: action
                };
                $.post("<?php bloginfo('url');?>/wp-admin/admin-ajax.php", ajax_data, function(data) {
                    if(typeof data == 'string'){
                        data = JSON.parse(data)
                    }
                    if(data.code == 1){
                        $(btn).addClass('done');
                        $(btn).html(data.data);
                    }else{
                        alert(data.msg);
                    }
                    
                });
                return false;
            }
        };
        $(document).on("click", ".ptw_like", function() {
            $(this).postLike();
        });
        $(document).on("click",".comment-like",function(){
            $(this).commentLike();
        })

        // $("#ptw_wx_l,#ptw_wx_b").click(function() {
        //     $("#ptw_wx_menu").show(0);
        // });
        // $(".ptw_wx_hide").click(function() {
        //     $("#ptw_wx_menu").hide(0);
        // });
    });
    $('#post_log_btn').click(function() {
       $('#userinfo_btn').trigger('click');
    });
</script>

</html>