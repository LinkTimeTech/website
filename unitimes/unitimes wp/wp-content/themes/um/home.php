<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/17
 * Time: 14:12
 */


get_header();

?>

<div class="metabar metabar--spacer u-tintBgColor u-height75 u-xs-height95"></div>
<a href="javascript:">
    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url('<?php bloginfo('template_url'); ?>/images/bg01.jpg')"
            data-stellar-background-ratio="1">
        <div>
            <video id="my-player"
                   class="video-js"
                   preload="none"
                   loop
                   max-height="675px"
                   data-setup={"controls":false,"autoplay":true,"muted":true,"fluid":true}>
                <source src="<?php echo get_option('index_video_url') ?>" type="video/mp4"></source>
            </video>
        </div>

        <div class="overlay centerall">

            <h1 class="title-text u-maxWidth1000">
                <?php echo um_get_index_message();?>
                <span id="banner"></span></h1>

        </div>
        <div class="container" style="position: absolute;top: 0;width: 100%;">
            <div class="row">

                <div class="text-center display-t  center-block">
                    <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                        <!--<span class="date-post">24 / 9 / 2017</span>-->
                    </div>
                </div>

            </div>
        </div>
    </header>
</a>
<div id="gtco-main">
    <div class="container u-maxWidth1000">
        <div class="row row-pb-md">
            <div class="col-md-12">
                <ul id="gtco-post-list">
                    <?php
                    $map = array(
                        'meta_key' => 'hot1',
                        'meta_value' => 1,
                        'order' => 'desc',
                        'posts_per_page' => 1,
                        'ignore_sticky_posts' => 1,
                    );
                    query_posts($map);
                    if(have_posts()) {
                        while (have_posts()): the_post();
                            $post = get_post();
                            ?>
                            <!--头条-->
                            <li class="full entry animate-box" data-animate-effect="fadeIn">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="entry-img"
                                         style="background-image: url(<?php echo get_hot_home_image(); ?>);"></div>
                                    <div class="entry-desc">
                                        <h3>
                                            <?php
                                                the_title();
                                            ?>
                                        </h3>
                                        <?php
                                        the_post_desc(300);
                                        ?>
                                    </div>
                                </a>
                                <a href="<?php echo get_category_link(2);?>" class="post-meta"><?php echo get_cat_name($post->post_category[0]);?> <span class="date-posted">
                                        <?php
                                        echo um_get_post_time();
                                        ?>
                                    </span></a>
                                <div class="post-stat">
                                    <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                                    <span class="post-review"><?php echo $post->comment_count; ?></span>
                                </div>
                            </li>
                            <?php
                        endwhile;
                    }
                    ?>
    
                    <!--新闻列表-->
                    <?php
						$i = 1;
                        $map = array(
                            'posts_per_page' => 6,
                            'meta_key' => 'hot2',
                            'meta_value' => 1,
                            'order' => 'desc',
                            'ignore_sticky_posts' => 1,
                        );
                        query_posts($map);
                        while(have_posts()): the_post();
                        $post = get_post();
                    ?>
                    <li class="one-third one-third<?php echo $i ?> entry animate-box" data-animate-effect="fadeIn">
                        <a href="<?php the_permalink(); ?>">
                            <div class="entry-img" style="background-image: url(<?php echo get_hot_home_image(); ?>)"></div>

                            <div class="entry-desc">
                                <h3 class="infocard-title">
                                    <?php the_title();?>
                                </h3>
                                <div class="infocard-content">
                                    <?php the_post_desc(42); ?>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo get_category_link(3);?>" class="post-meta"><?php echo get_cat_name($post->post_category[0]);?>
                            <span class="date-posted">
                                <?php
                                echo um_get_post_time('Y.m.d');
                                ?>
                            </span></a>
                        <div class="post-stat">
                            <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                            <span class="post-review"><?php echo $post->comment_count; ?></span>
                        </div>
                    </li>
                    <?php
						$i++;
                        endwhile;
                        
                    ?>
                    

                    <!--新闻列表end-->
                    <?php
                    $map = array(
                        'posts_per_page' => 1,
                        'meta_key' => 'hot3',
                        'meta_value' => 1,
                        'order' => 'desc',
                        'ignore_sticky_posts' => 1,
                    );
                    query_posts($map);
                    while(have_posts()): the_post();
                    $post = get_post();
                    ?>
                    <li class="two-third entry animate-box" data-animate-effect="fadeIn">
                        <a href="<?php the_permalink(); ?>">
                            <div class="entry-img"
                                 style="background-image: url(<?php echo get_hot_home_image(); ?>)"></div>
                            <div class="entry-desc">
                                <h3 class="infocard-title">
                                    <?php the_title();?>
                                </h3>
                                <div class="infocard-content">
                                    <?php the_post_desc(64); ?>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo get_category_link(5);?>" class="post-meta"><?php echo get_cat_name($post->post_category[0]);?>
                            <span class="date-posted"><?php
                                echo um_get_post_time('Y.m.d');
                                ?></span></a>
                        <div class="post-stat">
                            <span class="post-like"><?php echo (int)get_post_meta(get_the_ID(),'bigfa_ding',true);?></span>
                            <span class="post-review"><?php echo $post->comment_count; ?></span>
                        </div>
                    </li>
                        <?php
                    endwhile;

                    $map = array(
                        'posts_per_page' => 1,
                        'meta_key' => 'hot4',
                        'meta_value' => 1,
                        'order' => 'desc',
                        'ignore_sticky_posts' => 1,
                    );
                    query_posts($map);
                    while(have_posts()): the_post();
                    $post = get_post();
                    ?>
                    <li class="one-third the-third one-third7 entry animate-box" data-animate-effect="fadeIn">
                        <a href="<?php the_permalink(); ?>">
                            <div class="entry-img"
                                 style="background-image: url(<?php echo get_hot_home_image(); ?>"></div>
                            <div class="entry-desc">
                                <h3 class="infocard-title"><?php the_title();?></h3>
                                <div class="infocard-content">
                                    <?php the_post_desc(32); ?> </div>
                            </div>
                        </a>
                        <a href="<?php echo get_category_link(4);?>" class="post-meta"><?php echo get_cat_name($post->post_category[0]);?> <span class="date-posted"><?php
                                echo um_get_post_time('Y.m.d');
                                ?></span></a>
                    </li>
                        <?php
                    endwhile;
                    ?>

                </ul>
            </div>
        </div>
        <div class="row"></div>
    </div>
</div>
<?php
get_footer();
?>

</body>
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

<script src="<?php bloginfo('template_url'); ?>/js/video.min.js"></script>

<!-- Main -->
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/theater.min.js"></script>
<script>
    var theater = theaterJS();
    $(window).load(function () {
        
        theater
            .on('type:start, erase:start', function () {
                // add a class to actor's dom element when he starts typing/erasing
                var actor = theater.getCurrentActor();
                actor.$element.classList.add('is-typing')
            })
            .on('type:end, erase:end', function () {
                // and then remove it when he's done
                var actor = theater.getCurrentActor();
                actor.$element.classList.remove('is-typing')
            });
        
        theater
            .addActor('banner');
        
        theater
            .addScene('banner: <?php echo um_get_index_dy_message(0);?>', 1500)
            .addScene('banner: <?php echo um_get_index_dy_message(1);?>', 1500)
            .addScene(theater.replay)
        
    })

</script>

	
		
		
		




