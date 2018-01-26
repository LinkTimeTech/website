<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/17
 * Time: 14:33
 */
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="referrer" content="always">
	<meta name="robots" content="index, follow">
	
	<title>UNITIMES</title>
	
	<meta name="title" content="UNITIMES">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="" type="text/css" media="screen" />
	<link rel="prefetch" href="<?php bloginfo('template_url'); ?>/video/ocean-wave.mp4">
	<link rel="prerender" href="<?php bloginfo('template_url'); ?>/video/ocean-wave.mp4">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css">
	<!-- font-awesome-->
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link href="<?php bloginfo('template_url'); ?>/css/video-js.min.css" rel="stylesheet">
	
	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css">
    <?php wp_head();?>
    <!-- jQuery -->
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
</head>
<body class="v-enableBrandingButtons">
<div class="page">
    <div class="metabar u-clearfix
            u-boxShadowBottomThinLighter
            u-textColorDarker u-fixed
            u-backgroundTransparentWhiteDarkest
            u-xs-sizeFullViewportWidth">
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
                    <ul class="u-textAlignLeft u-noWrap  u-paddingLeft20 u-paddingRight20 u-sm-paddingLeft20 u-sm-paddingRight20">
                        <li class="link--mbda metabar-navItem u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
                            <a class="link link--darken u-accentColor--textDarken  u-baseColor--link ui-linkSubtle"
                               href="<?php echo get_category_link(2);?>">
                                <?php echo _e('独角访谈','um');?>
                            </a>
                        </li>
                        <li class="metabar-navItem  u-uiTextMedium u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
                            <a class="link link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
                               href="<?php echo get_category_link(3);?>">
                                <?php echo _e('新闻','um');?>
                            </a>
                        </li>
                        <li class="metabar-navItem metabar-twonav metabar-<?php echo get_locale();?>  u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
                            <a class="link link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
                               href="<?php echo get_category_link(5);?>">
                                <?php echo _e('知识库','um');?>
                            </a>
                            <ol class="metabar-twonavmenu">
                                <li><a href="<?php echo get_category_link(349);?>"><?php _e('白皮书','um');?></a></li>
                                <li><a href="<?php echo get_category_link(245);?>"><?php _e('特约作者','um');?></a></li>
                                <li><a href="<?php echo get_category_link(350);?>"><?php _e('技术文章','um');?></a></li>
                                <li><a href="<?php echo get_category_link(368)?>"><?php _e('其他','um');?></a></li>
                            </ol>
                        </li>
                        <li class="metabar-navItem  u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
                            <a class="link link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
                               href="<?php echo get_category_link(4);?>">
                                <?php echo _e('活动','um');?>
                            </a>
                        </li>
                        <span class="u-borderLeft1 u-paddingLeft22 u-xs-paddingLeft12 u-baseColor--borderLight"></span>
                        <li class="metabar-navItem  is-external u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
                            <a class="link link--darken u-accentColor--textDarken link--noUnderline "
                               href="/?page_id=212">
                                <?php echo _e('独角时代','um');?>
                            </a>
                        </li>
                    </ul>
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