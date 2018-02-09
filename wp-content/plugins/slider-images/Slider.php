<?php	/*
		Plugin name: Slider Images
		Plugin URI: http://www.rich-web.esy.es/slider-image
		Description: Slider image plugin is fully responsive. Your photos with our slider effects will be perfectly.
		Version: 1.2.6
		Author: richteam
		Author URI: http://www.rich-web.esy.es/
		License: http://www.gnu.org/licenses/gpl-2.0.html
	*/
	add_action('widgets_init', function() {
	 	register_widget('Rich_Web_Photo_Slider');
	});
	require_once(dirname(__FILE__) . '/Rich-Web-Slider-Widget.php');
 	require_once(dirname(__FILE__) . '/Rich-Web-Slider-Ajax.php');
	require_once(dirname(__FILE__) . '/Rich-Web-Slider-Shortcode.php');

	add_action('wp_enqueue_scripts','Rich_Web_Slider_Style');
	function Rich_Web_Slider_Style(){
		wp_register_style('Rich_Web_Photo_Slider', plugins_url('/Style/Rich-Web-Slider-Widget.css',__FILE__));
		wp_enqueue_style('Rich_Web_Photo_Slider');	
		wp_register_script('Rich_Web_Photo_Slider',plugins_url('/Scripts/Rich-Web-Slider-Widget.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_register_script('Rich_Web_Photo_Slider2',plugins_url('/Scripts/jquery.easing.1.2.js',__FILE__));
		wp_register_script('Rich_Web_Photo_Slider3',plugins_url('/Scripts/jquery.anythingslider.min.js',__FILE__));
		wp_register_script('Rich_Web_Photo_Slider4',plugins_url('/Scripts/jquery.colorbox-min.js',__FILE__));
		wp_localize_script('Rich_Web_Photo_Slider', 'object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('Rich_Web_Photo_Slider');
		wp_enqueue_script('Rich_Web_Photo_Slider2');
		wp_enqueue_script('Rich_Web_Photo_Slider3');
		wp_enqueue_script('Rich_Web_Photo_Slider4');
		wp_enqueue_script("jquery");
		
		wp_register_style( 'fontawesomeSl-css', plugins_url('/Style/richwebicons.css', __FILE__)); 
   		wp_enqueue_style( 'fontawesomeSl-css' );	
	}
	add_action("admin_menu", 'Rich_Web_Slider_Admin_Menu' );
	function Rich_Web_Slider_Admin_Menu() 
	{
		$complete_url = wp_nonce_url( $bare_url, 'edit-menu_'.$comment_id, 'Rich_Web_PSlider_Nonce' );
		add_menu_page('Rich-Web Slider Admin' . $complete_url,'Photo Slider','manage_options','Rich-Web Slider Admin' . $complete_url,'Manage_Rich_Web_Slider_Admin',plugins_url('/Images/admin.png',__FILE__));
 		add_submenu_page( 'Rich-Web Slider Admin' . $complete_url, 'Rich-Web Slider Admin', 'Slider Manager', 'manage_options', 'Rich-Web Slider Admin' . $complete_url, 'Manage_Rich_Web_Slider_Admin');
		add_submenu_page( 'Rich-Web Slider Admin' . $complete_url, 'Rich-Web Slider General', 'Slider Options', 'manage_options', 'Rich-Web Slider General' . $complete_url, 'Manage_Rich_Web_Slider_General');
		add_submenu_page( 'Rich-Web Slider Admin' . $complete_url, 'Rich-Web Slider Products', 'Our Products', 'manage_options', 'Rich-Web Slider Products', 'Manage_Rich_Web_Slider_Products');
	}
	function Manage_Rich_Web_Slider_Admin()
	{
		require_once('Rich-Web-Slider-Admin.php');
		require_once('Style/Rich-Web-Slider-Admin.css.php');
	}
	function Manage_Rich_Web_Slider_General()
	{
		require_once('Rich-Web-Slider-General.php');
		require_once('Scripts/Rich-Web-Slider-General.js.php');
		require_once('Style/Rich-Web-Slider-General.css.php');
	}
	function Manage_Rich_Web_Slider_Products()
	{
		require_once(dirname(__FILE__) . '/Rich-Web-Products.php');
	}
	add_action('admin_init', function() {
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		
		wp_register_script('Rich_Web_Photo_Slider', plugins_url('Scripts/Rich-Web-Slider-Admin.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('Rich_Web_Photo_Slider', 'object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script('Rich_Web_Photo_Slider');

		wp_register_style( 'fontawesomeSl-css', plugins_url('/Style/richwebicons.css', __FILE__)); 
   		wp_enqueue_style( 'fontawesomeSl-css' );	
	});
	register_activation_hook(__FILE__,'Ric_Web_Slider_wp_activate');
	function Ric_Web_Slider_wp_activate()
	{
		require_once('Rich-Web-Slider-Install.php');
	}
	function Rich_Web_Photo_Slider_Color() {

	    wp_enqueue_script(
	        'alpha-color-picker',
	        plugins_url('/Scripts/alpha-color-picker.js', __FILE__),	       
	        array( 'jquery', 'wp-color-picker' ), // You must include these here.
	        null,
	        true
	    );
	    wp_enqueue_style(
	        'alpha-color-picker',
	        plugins_url('/Style/alpha-color-picker.css', __FILE__),
	        array( 'wp-color-picker' ) // You must include these here.
	    );
	}
	add_action( 'admin_enqueue_scripts', 'Rich_Web_Photo_Slider_Color' );
?>
