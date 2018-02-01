<?php
/* 	Simplify Theme's Functions
	Copyright: 2012-2016, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
   

// Load the D5 Framework Optios Page
	
	require_once ( trailingslashit(get_template_directory()) . 'inc/customize.php' );
	
	function simplify_about_page() { 
	add_theme_page( 'D5 Creation Themes', 'D5 Creation Themes', 'edit_theme_options', 'd5-themes', 'simplify_d5_themes' );
	add_theme_page( 'SIMPLIFY Options', 'SIMPLIFY Options', 'edit_theme_options', 'theme-about', 'simplify_theme_about' ); 
	}
	add_action('admin_menu', 'simplify_about_page');
	function simplify_d5_themes() {  require_once ( trailingslashit(get_template_directory()) . 'inc/d5-themes.php' ); }
	function simplify_theme_about() {  require_once ( trailingslashit(get_template_directory()) . 'inc/theme-about.php' ); }


	add_theme_support( "title-tag" );


	add_theme_support( "title-tag" ); 

	function simplify_setup() {
	load_theme_textdomain( 'simplify', get_template_directory() . '/languages' );	
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 600;
	
// 	Tell WordPress for the Feed Link
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array( 'main-menu' => __('Main Menu', 'simplify') ) );
	
// 	This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)

	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
		
		
// 	WordPress 3.4 Custom Background Support	
	$simplify_custom_background = array( 'default-color' => 'ffffff', );
	add_theme_support( 'custom-background', $simplify_custom_background );
	
// 	WordPress 3.4 Custom Header Support				
	$simplify_custom_header = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 90,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => 'AAAAAA',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $simplify_custom_header );
	}
	add_action( 'after_setup_theme', 'simplify_setup' );

// 	Functions for adding script
	function simplify_enqueue_scripts() { 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' );  }
	wp_enqueue_style('simplify-style', get_stylesheet_uri(), false );
	wp_enqueue_script( 'simplify-menu-style', get_template_directory_uri(). '/js/menu.js', array( 'jquery' ) );
	wp_register_style('simplify-gfonts1', '//fonts.googleapis.com/css?family=Poiret+One', false );
	wp_register_style('simplify-gfonts2', '//fonts.googleapis.com/css?family=Anaheim', false );
	wp_enqueue_style('simplify-gfonts1');
	wp_enqueue_style('simplify-gfonts2');
	wp_enqueue_script( 'simplify-html5', get_template_directory_uri().'/js/html5.js');
    wp_script_add_data( 'simplify-html5', 'conditional', 'lt IE 9' );
	if ( esc_url(simplify_get_option('slide-image', get_template_directory_uri() . '/images/slide-image/slide-image2.jpg')) != '' || esc_url(simplify_get_option('extra-image', get_template_directory_uri() . '/images/slide-image/slide-image3.jpg')) != '' ) :
	wp_enqueue_script( 'simplify-slider', get_template_directory_uri(). '/js/jqFancyTransitions.1.8.min.js', array( 'jquery' ) );
	endif;
	if ( esc_html(simplify_get_option('responsive', '0')) == '1' ) : wp_enqueue_style('simplify-responsive', get_template_directory_uri(). '/style-responsive.css' ); endif;
	}
	add_action( 'wp_enqueue_scripts', 'simplify_enqueue_scripts' );
	
// 	Functions for adding script to Admin Area
	function simplify_admin_style() { wp_enqueue_style( 'simplify_admin_css', get_template_directory_uri() . '/inc/admin-style.css', false ); }
	add_action( 'admin_enqueue_scripts', 'simplify_admin_style' );
	
//	function tied to the excerpt_more filter hook.
	function simplify_excerpt_length( $Length ) {
	global $simplifyExcerptLength;
	if ($simplifyExcerptLength) {
    return $simplifyExcerptLength;
	} else {
    return 50; //default value
    } }
	add_filter( 'excerpt_length', 'simplify_excerpt_length', 999 );
	
	function simplify_not_found() { ?>
	
		<h1 class="arc-post-title"><?php echo __('Sorry, we could not find anything that matched...', 'simplify'); ?></h1>
		<h3 class="arc-src"><span><?php echo __('You Can Try the Search...', 'simplify'); ?></span></h3>
		<?php get_search_form(); ?>
		<p><a href="<?php echo home_url(); ?>" title="<?php __('Browse the Home Page', 'simplify') ?>"><?php echo __('&laquo; Or Return to the Home Page', 'simplify'); ?></a></p><br />
		<h2 class="post-title-color"><?php echo __('You can also Visit the Following. These are the Featured Contents', 'simplify'); ?></h2>
		<div class="content-ver-sep"></div><br />
		<?php get_template_part( 'featured-box' ); 
	
	}
	
	function simplify_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">Read More...</a>';
	}
	add_filter('excerpt_more', 'simplify_excerpt_more');
	
	// Content Type Showing
	function simplify_content() { the_content('<span class="read-more">'.__('Read More...', 'simplify').'</span>'); }
	function simplify_creditline() { echo '<span class="credit">| Simplify '.__('Theme by: ', 'simplify').'<a href="'. esc_url('http://d5creation.com') .'" target="_blank"><img  src="' . get_template_directory_uri() . '/images/d5logofooter.png" /> D5 Creation</a> | '.__('Powered by: ', 'simplify').'<a href="http://wordpress.org" target="_blank">WordPress</a></span>'; }
	
//	Registers the Widgets and Sidebars for the site
	function simplify_widgets_init() {

	register_sidebar( array(
		'name' => __('Primary Sidebar','simplify'), 
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  __('Secondary Sidebar', 'simplify'),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	 
	register_sidebar( array(
		'name' => __('Footer Area One', 'simplify'),
		'id' => 'sidebar-3',
		'description' => 'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	    
	register_sidebar( array(
		'name' => __('Footer Area Two', 'simplify'),
		'id' => 'sidebar-4',
		'description' => 'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Footer Area Three','simplify'),
		'id' => 'sidebar-5',
		'description' => 'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' =>  __('Footer Area Four', 'simplify'),
		'id' => 'sidebar-6',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	}
	add_action( 'widgets_init', 'simplify_widgets_init' );
	
	
	add_filter('the_title', 'simplify_title');
	function simplify_title($title) {
        if ( '' == $title ) {
            return '(Untitled)';
        } else {
            return $title;
        }
    }
	
//	Remove WordPress Custom Header Support for the theme Simplify
//	remove_theme_support('custom-header');