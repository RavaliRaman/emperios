<?php
 if ( ! defined( 'ABSPATH' ) ) exit;
class wpsm_servicebox {
	private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
	
	private function __construct() {
		add_action('admin_enqueue_scripts', array(&$this, 'wpsm_servicebox_admin_scripts'));
        if (is_admin()) {
			add_action('init', array(&$this, 'wpsm_servicebox_register_cpt'), 1);
			add_action('add_meta_boxes', array(&$this, 'wpsm_servicebox_meta_boxes_group'));
			add_action('admin_init', array(&$this, 'wpsm_servicebox_meta_boxes_group'), 1);
			add_action('save_post', array(&$this, 'add_servicebox_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'servicebox_settings_meta_box_save'), 9, 1);
		}
    }
	
	// admin scripts
	public function wpsm_servicebox_admin_scripts(){
		if(get_post_type()=="wpsm_servicebox_r"){
			
			wp_enqueue_media();
			wp_enqueue_script('jquery-ui-datepicker');
			//color-picker css n js
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wpsm_service_b-color-pic', wpshopmart_service_box_directory_url.'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
			 wp_enqueue_style('wpsm_service_b-panel-style', wpshopmart_service_box_directory_url.'assets/css/panel-style.css');
			  
			 wp_enqueue_style('wpsm_service_b_remodal-css', wpshopmart_service_box_directory_url .'assets/modal/remodal.css');
			wp_enqueue_style('wpsm_service_b_remodal-default-theme-css', wpshopmart_service_box_directory_url .'assets/modal/remodal-default-theme.css');
			 
			  
			//font awesome css
			wp_enqueue_style('wpsm_service_b-font-awesome', wpshopmart_service_box_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
			wp_enqueue_style('wpsm_service_b_bootstrap', wpshopmart_service_box_directory_url.'assets/css/bootstrap.css');
			wp_enqueue_style('wpsm_service_b_font-awesome-picker', wpshopmart_service_box_directory_url.'assets/css/fontawesome-iconpicker.css');
			wp_enqueue_style('faq_jquery-css', wpshopmart_service_box_directory_url .'assets/css/ac_jquery-ui.css');
			
			//line editor
			wp_enqueue_style('wpsm_service_b_line-edtor', wpshopmart_service_box_directory_url.'assets/css/jquery-linedtextarea.css');
			wp_enqueue_script( 'wpsm_service_b-line-edit-js', wpshopmart_service_box_directory_url.'assets/js/jquery-linedtextarea.js');
			
			wp_enqueue_script( 'wpsm_service_b-bootstrap-js', wpshopmart_service_box_directory_url.'assets/js/bootstrap.js');
			
			//tooltip
			wp_enqueue_style('wpsm_service_b_tooltip', wpshopmart_service_box_directory_url.'assets/tooltip/darktooltip.css');
			wp_enqueue_script( 'wpsm_service_b-tooltip-js', wpshopmart_service_box_directory_url.'assets/tooltip/jquery.darktooltip.js');
			// settings
			wp_enqueue_style('wpsm_service_b_settings-css', wpshopmart_service_box_directory_url.'assets/css/settings.css');
			wp_enqueue_script('wpsm_service_b_font-icon-picker-js', wpshopmart_service_box_directory_url.'assets/js/fontawesome-iconpicker.js',array('jquery'));
			wp_enqueue_script('wpsm_service_b_call-icon-picker-js', wpshopmart_service_box_directory_url.'assets/js/call-icon-picker.js',array('jquery'), false, true);
			wp_enqueue_script('wpsm_service_b_remodal-min-js',wpshopmart_service_box_directory_url.'assets/modal/remodal.min.js',array('jquery'), false, true);
	
		
			}
	}
	
	public function wpsm_servicebox_register_cpt(){
		require_once('cpt-reg.php');
		add_filter( 'manage_edit-wpsm_servicebox_r_columns', array(&$this, 'wpsm_servicebox_r_panels_columns' )) ;
		add_action( 'manage_wpsm_servicebox_r_posts_custom_column', array(&$this, 'wpsm_servicebox_r_manage_columns' ), 10, 2 );
	}
	
	function wpsm_servicebox_r_panels_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'ServiceBox' ),
            'shortcode' => __( 'ServiceBox Shortcode' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }

    function wpsm_servicebox_r_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input style="width:225px" type="text" value="[WPSM_SERVICEBOX id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }
	
	// metaboxes
	public function wpsm_servicebox_meta_boxes_group(){
		add_meta_box('add_wpsm_service_b_design', __('Select Design', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_add_servicebox_design_function'), 'wpsm_servicebox_r', 'normal', 'low' );
		add_meta_box('add_wpsm_service_b', __('Add Service Box Panel', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_add_servicebox_meta_box_function'), 'wpsm_servicebox_r', 'normal', 'low' );
		add_meta_box ('wpsm_service_b_shortcode', __('Service Box Shortcode', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_pic_servicebox_shortcode'), 'wpsm_servicebox_r', 'normal', 'low');
		add_meta_box('wpsm_service_b_support', __('Get Support', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_add_servicebox_support_function'), 'wpsm_servicebox_r', 'side', 'low');
		
		add_meta_box('wpsm_service_b_rateus', __('Rate Us If You Like This Plugin', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_add_servicebox_rateus_meta_box_function'), 'wpsm_servicebox_r', 'side', 'low');
		add_meta_box('wpsm_service_b_setting', __('Service Box Settings', wpshopmart_service_box_text_domain), array(&$this, 'wpsm_add_servicebox_setting_meta_box_function'), 'wpsm_servicebox_r', 'side', 'low');
		
	}
	
	public function wpsm_add_servicebox_design_function(){
		require_once('design.php');
	}
	
	public function wpsm_add_servicebox_meta_box_function($post){
		require_once('add-service-box.php');
	}
	
	public function wpsm_pic_servicebox_shortcode(){
		require_once('custom-css.php');
	
	}
	
	
	public function wpsm_add_servicebox_setting_meta_box_function($post){
		require_once('settings.php');
	}
	
	public function add_servicebox_meta_box_save($PostID) {
		require('data-post/servicebox-save-data.php');
    }
	
	public function servicebox_settings_meta_box_save($PostID){
		require('data-post/servicebox-settings-save-data.php');
	}
	
	public function wpsm_add_servicebox_rateus_meta_box_function(){
		
		?>
		<style>
		#wpsm_service_b_rateus{
			background:#dd3333;
			text-align:center
			}
			#wpsm_service_b_rateus .hndle , #wpsm_service_b_rateus .handlediv{
			display:none;
			}
			#wpsm_service_b_rateus h1{
			    color: #fff;
				border-bottom: 1px dashed rgba(255, 255, 255,0.9);
				padding-bottom: 10px;
			}
			 #wpsm_service_b_rateus h3 {
			color:#fff;
			font-size:15px;
			}
			#wpsm_service_b_rateus .button-hero{
			display:block;
			text-align:center;
			margin-bottom:15px;
			background:#fff !important;
			color:#000 !important;
			box-shadow:none;
			text-shadow:none;
			font-weight:600;
			font-size:18px;
			border:0px;
			}
			.wpsm-rate-us{
			text-align:center;
			}
			.wpsm-rate-us span.dashicons {
				width: 40px;
				height: 40px;
				font-size:20px;
				color:#fff !important;
			}
			.wpsm-rate-us span.dashicons-star-filled:before {
				content: "\f155";
				font-size: 40px;
			}
		</style>
		   <h1>Rate Us </h1>
			<h3>Show us some love, If you like our product then please give us some valuable feedback on wordpress</h3>
			<a href="https://wordpress.org/support/plugin/service-box/reviews/?filter=5" target="_blank" class="button button-primary button-hero ">RATE HERE</a>
			<a class="wpsm-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="https://wordpress.org/support/plugin/service-box/reviews/?filter=5" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
			<?php
	}
	
	public function wpsm_add_servicebox_support_function(){
		?>
		<style>
		#wpsm_service_b_support{
			background:##fff;
			text-align:center
			}
			#wpsm_service_b_support .hndle , #wpsm_service_b_support .handlediv{
			display:none;
			}
			#wpsm_service_b_support h1{
			    color: #fff;
				border-bottom: 1px dashed rgba(255, 255, 255,0.9);
				padding-bottom: 10px;
			}
			 
			#wpsm_service_b_support .button-hero{
			display:block;
			text-align:center;
			background:#1e73be !important;
			color:#fff !important;
			box-shadow:none;
			text-shadow:none;
			font-weight:600;
			font-size:18px;
			border:0px;
			}
		</style>	
		<a href="https://wordpress.org/support/plugin/service-box/" target="_blank" class="button button-primary button-hero ">Need Help Get Support</a>
			
			<?php 
	}
	
}
global $wpsm_servicebox;
$wpsm_servicebox = wpsm_servicebox::forge();

 ?>