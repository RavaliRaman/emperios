<?php

require get_template_directory() . '/inc/excerpts.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/widget-post.php';


add_action('after_setup_theme', 'wp_profile_theme_setup');
if (!function_exists( 'wp_profile_theme_setup' ) ) {
	function wp_profile_theme_setup(){
		load_theme_textdomain('wp-profile', get_template_directory() . '/languages');		

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background') ;
		add_theme_support( "title-tag" );
		/* Set image sizes*/	
		add_image_size( 'wp-profile-widget-post-thumb',  70, 70, true );
		add_image_size( 'wp-profile-post-thumb',  400, '200' , true );
		add_image_size( 'wp-profile-small-thumb',  130, 135 , true );
		add_image_size( 'wp-profile-medium-thumb',  350, 300 , true );
		add_image_size( 'wp-profile-feature-image',  800, 350, true );
		add_image_size( 'wp-profile-large-image',  800, 689, true );
		// register navigation menus
		register_nav_menus(
			array(
			'primary-menu'=>__('Primary Menu', 'wp-profile')
		));
	}
}



if (!function_exists( 'wp_profile_menu' ) ){
	function wp_profile_menu() {	
		require get_template_directory() . '/inc/wp-profile-menu.php';	
	}
}


if (!function_exists( 'wp_profile_content_width' ) ) :
	function wp_profile_content_width() {
		global $content_width;
		if (!isset($content_width))
			$content_width = 550; /* pixels */
	}
endif;
add_action( 'after_setup_theme', 'wp_profile_content_width' );

/**
 * Enqueue scripts & styles
 */
if (!function_exists( 'wp_profile_custom_scripts' ) ) :
	function wp_profile_custom_scripts() {
		global $wp_scripts;
		wp_enqueue_script( 'wp_profile_responsive_js', get_template_directory_uri() . '/js/responsive.js', array( 'jquery' ) );	
		wp_enqueue_script( 'wp_profile_navigation_js', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ) );		
		wp_enqueue_script( 'wp_profile_ie', get_template_directory_uri() . "/js/html5shiv.js");
    	$wp_scripts->add_data( 'wp_profile_ie', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'wp_profile_ie-responsive', get_template_directory_uri() . "/js/ie-responsive.js");
    	$wp_scripts->add_data( 'wp_profile_ie-responsive', 'conditional', 'lt IE 9' );
		wp_enqueue_style( 'wp_profile_responsive', get_template_directory_uri() .'/css/responsive.css', array(), false ,'screen' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.css' );
		wp_enqueue_style( 'wp_profile_style', get_stylesheet_uri() );
		wp_enqueue_style('wp_profile_googleFonts', '//fonts.googleapis.com/css?family=Lato');
		wp_enqueue_script( 'wp_profile_navigation_js', get_template_directory_uri() . '/js/navigation.js' );

	}
endif;
add_action('wp_enqueue_scripts', 'wp_profile_custom_scripts');

function wp_profile_admin_custom_scripts() {
	wp_enqueue_script( 'wp_profile_front_end_js', get_stylesheet_directory_uri() . '/js/admin-custom.js', array('jquery'), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'wp_profile_admin_custom_scripts' );

if (!function_exists( 'wp_profile_enqueue_comment_reply' ) ) :
	function wp_profile_enqueue_comment_reply() {
		wp_enqueue_script( 'comment-reply' );
	 }
endif;
add_action( 'comment_form_before', 'wp_profile_enqueue_comment_reply' );


// Register widgetized area and update sidebar with default widgets
function wp_profile_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Homepage Sidebar', 'wp-profile' ),
		'id' => 'defaul-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4><div class="arrow-right"></div></div>',
		'class' => 'clearfix'
	) );
	
	register_sidebar( array(
		'name' => __( 'Post Sidebar', 'wp-profile' ),
		'id' => 'post-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4><div class="arrow-right"></div></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'wp-profile' ),
		'id' => 'page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4><div class="arrow-right"></div></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Archives Sidebar', 'wp-profile' ),
		'id' => 'archives-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4><div class="arrow-right"></div></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Banner Widget', 'wp-profile' ),
		'description' => 'Enter your banner code into this text widget.',
		'id' => 'top-right-widget',
		'before_widget' => '<div id="top-widget">',
		'after_widget' => "</div>",
		'before_title' => '',
		'after_title' => '',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer One', 'wp-profile' ),
		'id' => 'footer-one-widget',
		'before_widget' => '<div id="footer-one" class="footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Two', 'wp-profile' ),
		'id' => 'footer-two-widget',
		'before_widget' => '<div id="footer-two" class="footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Three', 'wp-profile' ),
		'id' => 'footer-three-widget',
		'before_widget' => '<div id="footer-three" class="footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );	

	
}
add_action( 'widgets_init', 'wp_profile_widgets_init' );


//====================================Breadcrumbs=============================================================================================
function wp_profile_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> / </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> / </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> / </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $profile_act = get_post_ancestors( $post->ID );
                $title = esc_attr(get_the_title());
                foreach ( $profile_act as $profile_inherit ) {
                    $output = '<li><a href="'.esc_url(get_permalink($profile_inherit)).'" title="'.esc_attr(get_the_title($profile_inherit)).'">'.get_the_title($profile_inherit).'</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }
    }
    echo '</ul>';
}
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

?>
