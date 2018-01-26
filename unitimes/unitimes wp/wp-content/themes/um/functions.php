<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function um_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/um
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'um' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'um' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'um-featured-image', 2000, 1200, true );
	
	add_image_size( 'um-thumbnail-avatar', 100, 100, true );
	
	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'um' ),
		'social' => __( 'Social Links Menu', 'um' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
	
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', um_fonts_url() ) );
	
	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			
			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),
			
			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),
		
		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),
		
		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'um' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'um' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'um' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),
		
		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		
		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),
		
		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'um' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			
			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'um' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);
	
	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'um_starter_content', $starter_content );
	
	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'um_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function um_content_width() {
	
	$content_width = $GLOBALS['content_width'];
	
	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );
	
	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( um_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}
	
	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}
	
	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'um_content_width', $content_width );
}
add_action( 'template_redirect', 'um_content_width', 0 );

/**
 * Register custom fonts.
 */
function um_fonts_url() {
	$fonts_url = '';
	
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'um' );
	
	if ( 'off' !== $libre_franklin ) {
		$font_families = array();
		
		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	
	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function um_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'um-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	
	return $urls;
}
add_filter( 'wp_resource_hints', 'um_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function um_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'um' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'um' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'um' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'um' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'um' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'um' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'um_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function um_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	
	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'um' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'um_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function um_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'um_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function um_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'um_pingback_header' );

/**
 * Display custom color CSS.
 */
function um_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}
	
	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
	?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo um_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'um_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function um_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'um-fonts', um_fonts_url(), array(), null );
	
	// Theme stylesheet.
	wp_enqueue_style( 'um-style', get_stylesheet_uri() );
	
	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'um-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'um-style' ), '1.0' );
	}
	
	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'um-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'um-style' ), '1.0' );
		wp_style_add_data( 'um-ie9', 'conditional', 'IE 9' );
	}
	
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'um-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'um-style' ), '1.0' );
	wp_style_add_data( 'um-ie8', 'conditional', 'lt IE 9' );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script( 'um-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
	
	$um_l10n = array(
		'quote'          => um_get_svg( array( 'icon' => 'quote-right' ) ),
	);
	
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'um-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$um_l10n['expand']         = __( 'Expand child menu', 'um' );
		$um_l10n['collapse']       = __( 'Collapse child menu', 'um' );
		$um_l10n['icon']           = um_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}
	
	wp_enqueue_script( 'um-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );
	
	wp_localize_script( 'um-skip-link-focus-fix', 'umScreenReaderText', $um_l10n );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'um_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function um_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];
	
	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}
	
	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}
	
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'um_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function um_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'um_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function um_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}
	
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'um_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function um_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'um_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function um_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';
	
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'um_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );


function get_home_zhuanti($query){
    if($query->is_home() && $query->is_main_query()){
        $query->set('posts_per_page',1);
        $query->set('orderby',"desc");
    }
}
add_action('get_home_zhuanti','get_home_zhuanti',0);

function the_post_desc($length = 0, $echo=true){
    if($length == 0){
        $length = 64;
    }
    $content = get_post()->post_excerpt;
    if(get_locale() == 'en_US'){
        $length *= 2;
    }
    if(!empty($content)){
	    $content = strip_tags($content);
        if(mb_strlen($content) > $length){
	        $content = mb_substr($content,0,$length) . '...';
        }
    }else{
	    $content = get_the_content();
	    if(mb_strlen($content) < $length){
		    $content = strip_tags($content);
	    }else{
		    $content = mb_substr(strip_tags($content),0,$length) . "...";
	    }
    }
    if($echo){
        echo $content;
    }else{
	    return $content;
    }
    
}

function get_lang_text(){
    $langs = array('zh_CN'=>'EN','en_US'=>'中文');
    $lang = get_locale();
    if(!array_key_exists($lang,$langs)){
        echo '中文';
    }else{
        echo $langs[$lang];
    }
}
function get_lang_url(){
    //  源 => 目标
    $langs = array('zh_CN'=>'en','en_US'=>'zh');
    $lang = get_locale() ;
    $url = $_SERVER['path'];
    parse_str($_SERVER['QUERY_STRING'],$query);
    if(!array_key_exists($lang,$langs)){
        $query['lang'] = 'zh';
    }else{
        $query['lang'] = $langs[$lang];
    }
    return sprintf('%s?%s',$url,http_build_query($query));
}
function get_qrcode(){
    global $qrcodetag;
    $url = $qrcodetag->currentUrl();
    echo $qrcodetag->getQrcodeUrl($url,'125','UTF-8','L','4','version');
}
function create_comment_template($comments,$dom,$pid=0){
    if(empty($comments)){
        $comments = get_comments(array('post_id'=>get_the_ID(),'parent'=>$pid,'meta_key'=>'comment-like',
            'orderby'=>'meta_value_num','order'=>'DESC'));
    }
    foreach($comments as $comment){
        $maindiv = $dom->createElement('div');
        if(is_user_logged_in()){
            $class = "comment-show single-tie";
        }else{
            $class = "single-tie";
        }
        $maindiv->setAttribute('class',$class);
        $maindiv->setAttribute('data-common-id',$comment->comment_ID);
        if(!is_user_logged_in()){
            $maindiv->setAttribute('onclick',"javascript:$('#userinfo_btn').click();");
        }
        $maindiv->appendChild(get_phtot_template($dom,$comment));
        $maindiv->appendChild(get_body_template($dom,$comment));
        $dom->appendChild($maindiv);
    }
    return $dom->saveHtml();
}
function get_body_template($dom,$comment){
    if(get_locale() == 'zh_CN'){
        $d = 'm月d日 H:i';
    }else{
        $d = 'M d H:i';
    }
    //$dom = new DOMDocument('1.0','UTF-8');
    $body_div = $dom->createElement('div');
    $body_div->setAttribute('class','bdy-inner');
    $auther_div = $dom->createElement('div');
    $auther_div->setAttribute('class','tie-author');
    $auther_name = $dom->createElement('a',get_comment_author($comment->comment_ID));
    $auther_name->setAttribute('class','name comment-size-name');
    $auther_name->setAttribute('href','javascript:;');
    $date_span = $dom->createElement('span',get_comment_date($d,$comment->comment_ID));
    $date_span->setAttribute('class','name-desp');
    $pl_text = $dom->createElement('div');
    $pl_text->setAttribute('class','pl-text');
    $pl_text->appendChild($auther_name);
    $pl_text->appendChild($date_span);
    $auther_div->appendChild($pl_text);
    $like_div = $dom->createElement('div');
    $like_div->setAttribute('class','date-dz post-stat');
    $like_child = $dom->createElement('div');
    $like_child->setAttribute('class','date-dz-right');
    $like_span = $dom->createElement('span',(int)get_comment_meta($comment->comment_ID,'comment-like',true));
    $like_span->setAttribute('data-action','comment-ding');
    $like_span->setAttribute('data-comment-id',$comment->comment_ID);
    $class = ['post-like','comment-like'];
    array_push($class,get_common_like_status($comment->comment_ID));
    $like_span->setAttribute('class',join(' ',$class));
    $like_child->appendChild($like_span);
    $comment_count = $dom->createElement('a',(int)get_comment_meta($comment->comment_ID,'comment_count',true));
    if(um_comments_open()){
        $comment_count->setAttribute('href','javascript:;');
        $comment_count->setAttribute('class','post-review date-dz-pl pl-hf hf-con-block pull-left');
    }else{
        $comment_count->setAttribute('href','javascript:alert(\''. __('您无法此操作','um') .'\');');
        $comment_count->setAttribute('class','post-review date-dz-pl  hf-con-block pull-left');
    }
    $comment_count->setAttribute('data-post-id',$comment->comment_post_ID);
    $comment_count->setAttribute('data-pid',$comment->comment_ID);
    $like_child->appendChild($comment_count);
    $like_div->appendChild($like_child);
    $auther_div->appendChild($like_div);
    $content_div = $dom->createElement('div',$comment->comment_content);
    $content_div->setAttribute('class','tie-cnt');
    $body_div->appendChild($auther_div);
    $body_div->appendChild($content_div);
    $children = $comment->get_children(array('meta_key'=>'comment-like','orderby'=>'meta_value_num'));
    if($children){
        $reply_div = $dom->createElement('div');
        $reply_div->setAttribute('class','tie-reply');
        foreach($children as $child){
            $reply_div->appendChild(get_body_template($dom,$child));
        }
        $body_div->appendChild($reply_div);
    }
    return $body_div;
}

function get_phtot_template($dom,$comment){
    //$dom = new DOMDocument('1.0','UTF-8');
    $phodiv = $dom->createElement('div');
    $phodiv->setAttribute('class','photo');
    $default_photo = $dom->createElement('div');
    $default_photo->setAttribute('class','default-photo');
    $img = $dom->createElement('img');
    $avatar = um_get_avatar_url($comment->user_id);
    $img->setAttribute('src',$avatar);
    $default_photo->appendChild($img);
    $phodiv->appendChild($default_photo);
    return $phodiv;
}
add_action('wp_ajax_comment_post','um_comment_post');
function um_comment_post(){
    header('Content-type:application/json');
    nocache_headers();
    
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
    if(is_wp_error($comment)){
        $ret = array(
            'code' => 0,
            'desc' => $comment->get_error_message(),
            'post-id' => get_the_ID(),
        );
        die(json_encode($ret));
    }
    $count = get_comment_meta($comment->comment_parent,'comment_count',true);
    if(empty($count)){
        $count = 1;
    }else{
        $count ++;
    }
    update_comment_meta($comment->comment_parent,'comment_count',$count);
    update_comment_meta($comment->comment_ID,'comment-like',0);
    $user = wp_get_current_user();
    do_action( 'set_comment_cookies', $comment, $user );
    $dom = new \DOMDocument('1.0','utf8');
    $comments = get_comments(array('post_id'=>$_POST['comment_post_ID'],'parent'=>0,'meta_key'=>'comment-like',
        'orderby'=>'meta_value_num','order'=>'DESC'));
    $GLOBALS['comment'] = $comment;
    $res = create_comment_template($comments,$dom);
    $ret = array(
        'id' => $comment->comment_ID,
        'html' => $res,
        'code' => 1,
        'post-id' => get_the_ID(),
    );
    die(json_encode($ret));
}

function um_parent_comment($comment_id){
    $comment = get_comment($comment_id);
    if($comment->comment_parent){
        $comment = um_parent_comment($comment->comment_parent);
    }
    return $comment;
}

add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    header('Content-type:application/json');
    $ret = array(
        'code' => 1,
        'msg' => '',
        'data'=>'',
    );
    if(!is_user_logged_in()){
        $ret['code'] = 0;
        $ret['msg'] = __('请登录后进行此操作','um');
        die(json_encode($ret));
    }
    if(!um_comments_open() ){
        $ret['code'] = 0;
        $ret['msg'] = __('您无法进行此操作','um');
        die(json_encode($ret));
    }
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $ding_status = get_post_meta($id,'ding_status',true);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            $bigfa_raters = 1;
            $ding_status[get_current_user_id()] = 1;
        }else {
            if($ding_status[get_current_user_id()]){
                $bigfa_raters--;
                $ding_status[get_current_user_id()] = 0;
            }else{
                $bigfa_raters++;
                $ding_status[get_current_user_id()] = 1;
            }
        }
        update_post_meta($id, 'bigfa_ding', $bigfa_raters);
        update_post_meta($id,'ding_status',$ding_status);
        $ret['data'] = (int)get_post_meta($id,'bigfa_ding',true);
        die(json_encode($ret));
    }else if($action == 'comment-ding'){
	    $bigfa_raters = get_comment_meta($id,'comment-like',true);
	    $ding_status = get_comment_meta($id,'common-like-status',true);
	    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            $bigfa_raters = 1;
	    }else {
            $bigfa_raters++;
	    }
	    $user_id = get_current_user_id();
	    if($ding_status[$user_id]){
	        $ret['msg'] = __('您已赞过本评论','um');
	        $ret['code'] = 0;
	        die(json_encode($ret));
        }
        update_comment_meta($id, 'comment-like', $bigfa_raters);
	    $ding_status[$user_id] = 1;
	    update_comment_meta($id,'common-like-status',$ding_status);
        $ret['data'] = (int)get_comment_meta($id,'comment-like',true);
        die(json_encode($ret));
    }
    die;
}
function get_common_like_status($id){
    if(!is_user_logged_in()){
        echo '';
        return;
    }
	$user_id = get_current_user_id();
	$like_status = get_comment_meta($id,'common-like-status',true);
	if(empty($like_status)){
	    return '';
    }
	if($like_status && array_key_exists($user_id,$like_status)){
		return 'done';
	}else{
		return '';
	}
}
function get_like_status(){
    if(!is_user_logged_in()){
        echo '';
        return;
    }
    $user_id = get_current_user_id();
    $id = get_the_ID();
    $ding_status = get_post_meta($id,'ding_status',true);
    if($ding_status && $ding_status[$user_id]){
        echo 'done';
    }else{
        echo '';
    }
}

function um_get_date(){
    if(get_locale() == 'zh_CN'){
        $d = 'm月d日 H:i';
    }else{
        $d = 'M d H:i';
    }
    return get_post_time($d);
}


function um_get_post_time($d=''){
    $post = get_post();
    $cat = $post->post_category;
    if(get_locale() == 'zh_CN'){
        $d = 'm月d日 H:i';
    }else{
        $d = 'M d H:i';
    }
    if(in_array(4,$cat)){
        return um_get_activity_date($d);
    }else{
        return get_post_time($d);
    }
}
function um_get_activity_date($d){
    
    $id = get_the_ID();
    $start_time =  get_post_meta($id,'um_start_time',true);
    $end_time = get_post_meta($id,'um_end_time',true);
    if(empty($start_time) || empty($end_time)){
        return get_post_time($d);
    }else{
        $format = $d;
        $start_time = mysql2date($format, $start_time, false);
        $end_time = mysql2date($format, $end_time, false);
        $start_time=apply_filters( 'get_post_time', $start_time, $format, false );
        $end_time = apply_filters( 'get_post_time', $end_time, $format, false );
        return $start_time . '-' . $end_time;
    }
    
}

function nav_select($id){
    $request_id = get_query_var('cat');
    if(empty($request_id)){
        $post = get_post();
        $request_id = $post->post_category[0];
    }
    if($id == $request_id){
        echo ' link--darker ';
    }
}
function p ($arr){
    echo "<pre>";
    print_r($arr);
}
// 后台
add_filter('manage_posts_columns', 'add_new_posts_columns');
function add_new_posts_columns($columns) {
    $new_columns = array();
    if(isset($columns['cb'])) $new_columns['cb'] = '';
    if(isset($columns['title'])) $new_columns['title'] = '';
    if(isset($columns['author'])) $new_columns['author'] = '';
    if(isset($columns['categories'])) $new_columns['categories'] = '';
    if(isset($columns['tags'])) $new_columns['tags'] = '';
    if(isset($columns['language'])) $new_columns['language'] = '';
    $new_columns['hot'] = __('推荐','um');
    return array_merge($new_columns, $columns);
}
add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);
function manage_posts_columns($column_name, $id) {
    global $post;
    switch ($column_name) {
        case 'hot':
            echo get_hot_type();
            break;
        default:
            break;
    }
}
add_filter( 'manage_users_columns', 'um_users_columns',9,3);
function um_users_columns($columns){
    $arr = array(
        'cb' => $columns['cb'],
        'username' => $columns['username'],
        'display_name' => '姓名',
        'email' => $columns['email'],
        'role' => $columns['role'],
        'posts' => $columns['posts'],
        'ban' => '拉黑',
    );
    return $arr;
}
add_filter( 'manage_users_custom_column', 'um_users_custom_columns',15,3);
function um_users_custom_columns($value,$column_name,$id){
    if($column_name == 'ban'){
        $ban = get_user_meta($id,'ban',true);
        if($ban){
            return '拉黑';
        }else{
            return '正常';
        }
    }else if($column_name == 'display_name'){
        $user = get_user_by('id',$id);
        return $user->display_name;
    }else{
        return $value;
    }
}

function get_hot_type(){
    $fields = array('hot1' => '推荐1','hot2'=>'推荐2','hot3' => '推荐3','hot4' => '推荐4','hot5' => '推荐5');
    $arr = array();
    foreach($fields as $field => $vo){
        if(get_post_meta(get_the_ID(),$field,true)){
            array_push($arr,$vo);
        }
    }
    return join(',',$arr);
}

function get_hot_home_image(){
    $id = get_the_ID();
    $home_image = get_post_meta($id,'home_image',true);
    if(empty($home_image)){
        return get_the_post_thumbnail_url($id,'full');
    }
    return wp_get_attachment_image_url($home_image,'full');
}

function um_nonce(){
	$post_id = get_the_ID();
	if ( current_user_can( 'unfiltered_html' ) ) {
		wp_nonce_field( 'unfiltered-html-comment_' . $post_id, '_wp_unfiltered_html_comment', false );
	}
}

function um_get_avatar($user_id = 0,$size=96){
    if(empty($user_id)){
        $user_id = get_current_user_id();
    }
    $avatar = get_user_meta($user_id,'wp_user_avatar',true);
    if(empty($avatar)) {
        return get_avatar($user_id,$size);
    }else{
        $h = '<img alt="" src="'.$avatar.'" srcset="'.$avatar.'" class="avatar-image avatar avatar-96 photo avatar-default" height="'.$size.'" width="'.$size.'">';
        return $h;
    }
}
function um_get_avatar_url($user_id = 0){
    if(empty($user_id)){
        $user_id = get_current_user_id();
    }
    $avatar = get_user_meta($user_id,'wp_user_avatar',true);
    if(empty($avatar)){
        $avatar = get_bloginfo('template_url') . "/images/icon_user.png";
    }
    return $avatar;
}

function um_search_query(){
    if(is_search()){
       echo _e('搜索','um');
       echo  '&nbsp;>&nbsp;';
       if(have_posts()){
           echo $_GET['s'];
       }else{
           _e('无搜索结果','um');
       };
    }else if(is_tag()){
	    echo _e('标签','um');
	    echo  '&nbsp;>&nbsp;';
	    single_tag_title();
    }
}
function um_get_next_posts_page_link($max_page=0){
	global $paged,$wp_query;
	// $url = bloginfo('template_url');
	if ( !is_single() && !is_search() ) {
		if ( !$paged )
			$paged = 1;
		$nextpage = intval($paged) + 1;
		if ( !$max_page || $max_page >= $nextpage )
			return get_pagenum_link($nextpage,false);
	}
}

function custum_fontfamily($initArray){
    $initArray['font_formats'] = '微软雅黑=微软雅黑;宋体=宋体;黑体=黑体;仿宋=仿宋;楷体=楷体;隶书=隶书;幼圆=幼圆;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'custum_fontfamily');

function custom_fontsize($init){
    $init['fontsize_formats'] = "8px 10px 12px 13px 14px 15px 16px 17px 18px 19px 20px 24px 28px 32px 36px 48px 60px 72px 96px";
    return $init;
}
add_filter('tiny_mce_before_init', 'custom_fontsize');


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
    update_user_meta( $user_id, 'ban', $_POST['ban'] );
}

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields($user){
    $ban = (int)get_user_meta($user->ID,'ban',true);
    $level = (int)get_user_meta($user->ID,'wp_user_level',true);
    if($level == 0||true):
    ?>
    <table class="form-table">
        <tr>
            <th>拉黑</th>
            <td>
                <input type="radio" name="ban" <?php if($ban){echo 'checked';} ?> id="ban_yes" value="1">
                <label for="ban_yes">是</label>
                <input type="radio" name="ban"  <?php if($ban == 0){echo 'checked';} ?> id="ban_no" value="0">
                <label for="ban_no">否</label>
            </td>
        </tr>
    </table>
<?php
endif;
}


function um_comments_open(){
    $user_id = get_current_user_id();
    $level = (int)get_user_meta($user_id,'wp_user_level',true);
    $ban = (int)get_user_meta($user_id,'ban',true);
    if($level == 0 && $ban == 1){
        return false;
    }
    return true;
}
function um_get_index_message(){
    $lang = get_locale();
    $lang = substr($lang,0,2);
    $option = 'index_message_'.$lang;
    return get_option($option);
}
function um_get_about_message(){
    $lang = get_locale();
    $lang = substr($lang,0,2);
    $option = 'about_image_font_'.$lang;
    return get_option($option);
}
function um_get_index_dy_message($index=0){
    $lang = get_locale();
    $lang = substr($lang,0,2);
    $option = 'index_dy_message_'.$lang;
    $options = get_option($option);
    $options = explode(',',$options);
    return $options[0];
}
if(is_admin()){
    require_once(__DIR__ . "/admin_function.php");
    $role = get_role('author');
    $role->add_cap('manage_categories');
}
``

?>




