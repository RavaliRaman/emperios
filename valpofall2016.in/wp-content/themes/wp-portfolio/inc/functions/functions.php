<?php
/**
 * WP_Portfolio functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
/****************************************************************************************/
add_action('wp_enqueue_scripts', 'wp_portfolio_scripts_styles_method');
/**
 * Register jquery scripts
 */
function wp_portfolio_scripts_styles_method() {
	/**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style('wp_portfolio_style', get_stylesheet_uri());
	// Load the html5 shiv.
	wp_enqueue_script( 'wp-portfolio-html5', get_template_directory_uri() . '/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'wp-portfolio-html5', 'conditional', 'lt IE 9' );
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	/**
	 * Enqueue Scripts js file.
	 */
	wp_enqueue_script('wp-portfolio-scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), false, true);
}
/****************************************************************************************/
function wp_portfolio_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'wp_portfolio_add_editor_styles' );
/****************************************************************************************/
add_filter('wp_page_menu', 'wp_portfolio_wp_page_menu');
/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function wp_portfolio_wp_page_menu($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass   = $matches[1];
	$replace    = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup;
}
/****************************************************************************************/
add_filter('excerpt_length', 'wp_portfolio_excerpt_length');
/**
 * Sets the post excerpt length to 50 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function wp_portfolio_excerpt_length($length) {
	return 50;// this will return 50 words in the excerpt
}
add_filter('excerpt_more', 'wp_portfolio_continue_reading');
/**
 * Returns a "Continue Reading" link for excerpts
 */
function wp_portfolio_continue_reading() {
	return '&hellip; ';
}
/****************************************************************************************/
add_action('wp_head', 'wp_portfolio_internal_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function wp_portfolio_internal_css() {
	global $wp_portfolio_settings,$array_of_default_settings;
	$wp_portfolio_settings = wp_parse_args(  get_option( 'wp_portfolio_theme_settings', array() ),  wp_portfolio_get_option_defaults() );
	$custom_css = $wp_portfolio_settings['wp_portfolio_css_settings'];
	if (!empty($custom_css) ){
		$wp_portfolio_internal_css = '<!-- '.get_bloginfo('name').' Custom CSS Styles -->'."\n";
		$wp_portfolio_internal_css .= '<style type="text/css" media="screen">'."\n";
		$wp_portfolio_internal_css .= $custom_css."\n";
		$wp_portfolio_internal_css .= '</style>'."\n";
	}
	if (isset($wp_portfolio_internal_css)) {
		echo $wp_portfolio_internal_css;
	}
}
/****************************************************************************************/
add_action('pre_get_posts', 'wp_portfolio_alter_home');
/**
 * Alter the query for the main loop in home page
 *
 * @uses pre_get_posts hook
 */
function wp_portfolio_alter_home($query) {
	global $wp_portfolio_settings,$array_of_default_settings;
	$wp_portfolio_settings = wp_parse_args(  get_option( 'wp_portfolio_theme_settings', array() ),  wp_portfolio_get_option_defaults() );
	$wp_portfolio_disable_setting = $wp_portfolio_settings['wp_portfolio_disable_setting'];
	if ( $wp_portfolio_disable_setting == 0 ) {
		$catID = $wp_portfolio_settings['wp_portfolio_categories'];
			if ( is_array( $catID ) && !in_array( '0', $catID ) ) {
				if( $query->is_main_query() && $query->is_home() ) {
					$query->query_vars['category__in'] = $wp_portfolio_settings['wp_portfolio_categories'];
				}
			}
	}
}
/****************************************************************************************/
add_filter('wp_page_menu', 'wp_portfolio_wp_page_menu_filter');
/**
 * @uses wp_page_menu filter hook
 */
if (!function_exists('wp_portfolio_wp_page_menu_filter')) {
	function wp_portfolio_wp_page_menu_filter($text) {
		$replace = array(
			'current_page_item' => 'current-menu-item',
		);
		$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
}
/****************************************************************************************/
add_filter('body_class', 'wp_portfolio_body_class');
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function wp_portfolio_body_class($classes) {
	global $wp_portfolio_settings,$array_of_default_settings;
	$wp_portfolio_settings = wp_parse_args(  get_option( 'wp_portfolio_theme_settings', array() ),  wp_portfolio_get_option_defaults() );
	$site_layout = $wp_portfolio_settings['wp_portfolio_design_layout'];
	if ($site_layout =='off') {

		$classes[] = 'narrow-layout';
	}
	return $classes;
}
?>
