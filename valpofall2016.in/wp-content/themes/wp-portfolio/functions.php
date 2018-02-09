<?php
/**
 * WP_Portfolio defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
	add_action('after_setup_theme', 'wp_portfolio_setup');
	/**
	 * This content width is based on the theme structure and style.
	 */
	function wp_portfolio_setup()
	{
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 770;
		}
	}
		add_action('wp_portfolio_init', 'wp_portfolio_constants', 10);
		/**
		 * This function defines the WP_Portfolio theme constants
		 *
		 * @since 1.0
		 */
	function wp_portfolio_constants()
	{
		/** Define Directory Location Constants */
		define('WP_PORTFOLIO_PARENT_DIR', get_template_directory());
		define('WP_PORTFOLIO_CHILD_DIR', get_stylesheet_directory());
		define('WP_PORTFOLIO_INC_DIR', WP_PORTFOLIO_PARENT_DIR . '/inc');
		define('WP_PORTFOLIO_JS_DIR', WP_PORTFOLIO_PARENT_DIR . '/js');
		define('WP_PORTFOLIO_FUNCTIONS_DIR', WP_PORTFOLIO_INC_DIR . '/functions');
		define('WP_PORTFOLIO_SHORTCODES_DIR', WP_PORTFOLIO_INC_DIR . '/footer-info');
		define('WP_PORTFOLIO_STRUCTURE_DIR', WP_PORTFOLIO_INC_DIR . '/structure');
		if (!defined('WP_PORTFOLIO_LANGUAGES_DIR'))
		/** So we can define with a child theme */ {
			define('WP_PORTFOLIO_LANGUAGES_DIR', WP_PORTFOLIO_PARENT_DIR . '/languages');
		}
		define('WP_PORTFOLIO_WIDGETS_DIR', WP_PORTFOLIO_INC_DIR . '/widgets');
	}
		add_action('wp_portfolio_init', 'wp_portfolio_load_files', 15);
		/**
		 * Loading the included files.
		 *
		 * @since 1.0
		 */
	function wp_portfolio_load_files()
	{
		/**
		 * wp_portfolio_add_files hook
		 *
		 * Adding other addtional files if needed.
		 */
		do_action('wp_portfolio_add_files');
		/** Load functions */
		require_once (WP_PORTFOLIO_FUNCTIONS_DIR . '/i18n.php');

		require_once (WP_PORTFOLIO_FUNCTIONS_DIR . '/custom-header.php');

		require_once (WP_PORTFOLIO_FUNCTIONS_DIR . '/functions.php');

		require_once (WP_PORTFOLIO_FUNCTIONS_DIR . '/customizer.php');

		/** Load Footer Info */
		require_once (WP_PORTFOLIO_SHORTCODES_DIR . '/wp-portfolio-footer-info.php');

		/** Load Structure */
		require_once (WP_PORTFOLIO_STRUCTURE_DIR . '/header-extensions.php');

		require_once (WP_PORTFOLIO_STRUCTURE_DIR . '/footer-extensions.php');

		require_once (WP_PORTFOLIO_STRUCTURE_DIR . '/content-extensions.php');

		/** Load Widgets and Widgetized Area */
		require_once (WP_PORTFOLIO_WIDGETS_DIR . '/wp-portfolio-widgets.php');

	}
	add_action('wp_portfolio_init', 'wp_portfolio_core_functionality', 20);
	/**
	 * Adding the core functionality of WordPess.
	 *
	 * @since 1.0
	 */
	function wp_portfolio_core_functionality()
	{
		/**
		 * wp_portfolio_add_functionality hook
		 *
		 * Adding other addtional functionality if needed.
		 */
		do_action('wp_portfolio_add_functionality');
		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');
		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support('title-tag');
		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support('post-thumbnails');
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(array(
			'primary' => __('Primary Navigation', 'wp-portfolio') ,
			'social' => __('Social Navigation', 'wp-portfolio') ,
		));
		/* 
		* Enable support for custom logo. 
		* 
		*/ 
		add_theme_support( 'custom-logo', array( 
			'height'      => 100, 
			'width'       => 260, 
			'flex-height' => true,
			'flex-width' => true,
		) );
		// Indicate widget sidebars can use selective refresh in the Customizer. 
		add_theme_support( 'customize-selective-refresh-widgets' );
		/**
		 * This theme supports custom background color and image
		 */
		add_theme_support('custom-background');
	}
		/**
		 * wp_portfolio_init hook
		 *
		 * Hooking some functions of functions.php file to this action hook.
		 */
		do_action('wp_portfolio_init');
	function wp_portfolio_get_featured_posts()
	{
		/**
		 * Filter the featured posts to return in WP_Portfolio.
		 * @param array|bool $posts Array of featured posts, otherwise false.
		 */
		return apply_filters('wp_portfolio_get_featured_posts', array());
	}
		/**
		 * A helper conditional function that returns a boolean value.
		 * @return bool Whether there are featured posts.
		 */
	function wp_portfolio_has_featured_posts()
	{
		return !is_paged() && (bool)wp_portfolio_get_featured_posts();
	}
function wp_portfolio_get_option_defaults() {
	global $array_of_default_settings;
	$array_of_default_settings = array(
		'wp_portfolio_header_settings' => 'header_text',
		'wp_portfolio_css_settings' => '',
		'wp_portfolio_categories'	=>array(),
		'wp_portfolio_disable_setting'	=>0,
		'wp_portfolio_post_layout' => 'wp_portfolio_layout',
		'wp_portfolio_design_layout' =>'on'
	);
	return apply_filters( 'wp_portfolio_get_option_defaults', $array_of_default_settings );
}
add_action( 'after_setup_theme', 'wp_portfolio_woocommerce_support' );
function wp_portfolio_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_action('woocommerce_before_main_content', 'wp_portfolio_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wp_portfolio_wrapper_end', 10);
function wp_portfolio_wrapper_start() { echo '<div id="primary"> <div id="main"><div class="entry-main"> <div class="entry-content">'; }

function wp_portfolio_wrapper_end() { echo '</div></div></div></div>'; }


if ( ! function_exists( 'wp_portfolio_the_custom_logo' ) ) : 
	/** 
	 * Displays the optional custom logo. 
	 * 
	 * Does nothing if the custom logo is not available. 
	 */ 
	function wp_portfolio_the_custom_logo() { 
	    if ( function_exists( 'the_custom_logo' ) ) { 
	        the_custom_logo(); 
	    } 
	} 
endif; 
?>