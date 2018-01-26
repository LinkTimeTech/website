<!DOCTYPE html>
<html>
<?php
while(have_posts()):the_post();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <meta name="robots" content="index, follow">
    
    <title><?php the_title();?></title>
    
    <meta name="title" content="UNITIMES">
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
    
    <div class="metabar u-clearfix  u-boxShadowBottomThinLighter u-textColorDarker u-fixed u-backgroundTransparentWhiteDarkest u-xs-sizeFullViewportWidth">
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
    
    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(<?php echo get_option('about_image_url'); ?>);"
            data-stellar-background-ratio="1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <!--<span class="date-post">24 / 9 / 2017</span>-->
                            <h1 class="mb30">
                                <?php echo um_get_about_message();?>
                            </h1>
                            <h2></h2>
                            <!--<p><a href="#" class="text-link">阅读全文</a></p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div id="gtco-main" style="background-color: #fff">
        <div class="container u-maxWidth1000">
            <div class="row row-pb-md">
                <div class="col-md-12">
                    <div class="postArticle-content" data-scroll="native">
                        <section class="section section--body section--first" style="padding-top: 0">
                            <div class="section-content">
                                <?php
                                the_content();
                                ?>
                            </div>
                        </section>
                    </div>
                
                
                </div>
            </div>
            <div class="row"></div>
        </div>
    </div>
    
    
    <footer id="gtco-footer" class="article-foot" role="contentinfo">
        <div class="container">
            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <div class="copyrighttxt u-textColorNormal">&copy; UNITIMES. All Rights Reserved.</div>
                </div>
            </div>
        
        </div>
    </footer>
</div>
<?php
endwhile;
?>
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>


<!-- jQuery Easing -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
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

