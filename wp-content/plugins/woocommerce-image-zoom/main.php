<?php
/**
 * Plugin Name:       WooCommerce Image Zoom
 * Plugin URI:        http://wpbean.com/plugins/
 * Description:       Highly customizable product image zoom plugin for Woocommerce Store. 
 * Version:           1.02.4
 * Author:            wpbean
 * Author URI:        http://wpbean.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-image-zoom
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * Localization
 */

if( !function_exists('wpb_wiz_textdomain') ){
	function wpb_wiz_textdomain() {
		load_plugin_textdomain( 'woocommerce-image-zoom', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'wpb_wiz_textdomain' );


/**
 * Enqueue Scripts
 */

if( !function_exists('wpb_wiz_adding_scripts') ){
	function wpb_wiz_adding_scripts() {
		if( is_singular( 'product' ) ){
			wp_enqueue_style( 'wpb-wiz-fancybox-css',  plugins_url( '/assets/css/jquery.fancybox.css', __FILE__ ), array(), '2.1.5' );
			wp_enqueue_script('wpb-wiz-fancybox', plugins_url( '/assets/js/jquery.fancybox.pack.js', __FILE__ ), array('jquery'), '2.1.5', false);
			wp_enqueue_script('wpb-wiz-elevatezoom', plugins_url('assets/js/jquery.elevateZoom-3.0.8.min.js', __FILE__),array('jquery'),'3.0.8', false);
			wp_enqueue_script('wpb-wiz-plugin-main', plugins_url('assets/js/main.js', __FILE__),array('jquery'),'1.0', true);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'wpb_wiz_adding_scripts' );


/**
 * Require Files
 */

require_once dirname( __FILE__ ) . '/inc/wpb-wiz-filter.php';
require_once dirname( __FILE__ ) . '/admin/class.settings-api.php';
require_once dirname( __FILE__ ) . '/admin/plugin-settings.php';


/**
 * Disable zoom in Mobile
 */

if( !function_exists('wpb_wiz_disable_in_mobile') ){
	function wpb_wiz_disable_in_mobile(){
		if( wp_is_mobile() && wpb_wiz_get_option( 'wpb_wiz_disable_zoom_mobile', 'wpb_general_settings', 'off' ) == 'on' ){
			remove_action( 'wp_enqueue_scripts', 'wpb_wiz_adding_scripts' );
		}
	}
}
add_action( 'init', 'wpb_wiz_disable_in_mobile' );