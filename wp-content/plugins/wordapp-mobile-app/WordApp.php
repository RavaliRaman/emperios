<?php
/*
  Plugin Name: WordApp - Wordpress to Mobile App plugin for WooCommerce & BuddyPress
  Plugin URI: http://App-developers.biz
  Description: Mobile app plugin Convert your wordpress site/blog to mobile app works  WooCommerce  & BuddyPress
  Version:2.0.3
  Author:App-Developers.biz
  Author URI: http://app-developers.biz/
  License: GPLv3
  Text Domain: wordapp-mobile-app
  Domain Path: /languages
  Copyright: Mobile Rockstar & App-Developers
*/
define('WordAppVersion', '2.0.3');
define('DEBUG_WORDAPP', false);
define( 'WP_FS__DEV_MODE', false );


function wordapp_wma_fs() {
    global $wordapp_wma_fs;

    if ( ! isset( $wordapp_wma_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

   $wordapp_wma_fs = fs_dynamic_init(array(
				'id' => '243',
				'slug' => 'wordapp-mobile-app',
				'public_key' => 'pk_ff754d803e7557f8b445ecaefa914',
				'is_premium' => false,
				'has_addons' => false,
				'has_paid_plans' => false,
				'menu' => array(
					'slug' => 'WordApp',
					'contact' => false,
					'support' => false,
					'account' => false,
				),
			));

     }

    return $wordapp_wma_fs;
}

// Init Freemius.
wordapp_wma_fs();
// Signal that SDK was initiated.
do_action( 'wordapp_wma_fs_loaded' );

    function wordapp_wma_fs_custom_connect_message_on_update(
        $message,
        $user_first_name,
        $plugin_title,
        $user_login,
        $site_link,
        $freemius_link
    ) {
        return sprintf(
            __fs( 'hey-x' ) . '<br>' .
            __( 'Please help us improve %2$s! If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', 'wordapp-mobile-app' ),
            $user_first_name,
            '<b>' . 'WordApp' . '</b>',
            '<b>' . $user_login . '</b>',
            $site_link,
            '<a href="http://app-developers.biz">WordApp</a>'
        );
    }

    wordapp_wma_fs()->add_filter('connect_message_on_update', 'wordapp_wma_fs_custom_connect_message_on_update', 10, 6);


define('APPNAME', 'wordapp-mobile-app');
define('APPNAME_FRIENDLY', 'WordApp');
define('PLUGIN_URL', 'http://mobile-rockstar.com/app/main/app.php');
define('VIMEO_VIDEO', 'WordApp');
define('MAINURL', 'admin.php?page=WordApp');
define('DEFAULT_WordApp_THEME', 'wordappjqmobile');
define('WORDAPP_DIR', dirname(__FILE__));
define('WORDAPP_DIR_URL', plugins_url('/', __FILE__));

require_once WORDAPP_DIR.'/includes/classes/widgets.php';
require_once WORDAPP_DIR.'/includes/classes/create_json.php';
require_once WORDAPP_DIR.'/includes/classes/front_end_widgets.php';
require_once WORDAPP_DIR.'/includes/classes/front_end_widgets_pn.php';
require_once WORDAPP_DIR.'/includes/classes/mobile_pages.php';
require_once WORDAPP_DIR.'/includes/classes/mobile_plugins.php';
require_once WORDAPP_DIR.'/includes/classes/wordapp-homepage.php';
require_once WORDAPP_DIR.'/includes/classes/wordapp-shortcode.php';

require_once WORDAPP_DIR.'/includes/classes/wordapp-ismobile.php';
require_once WORDAPP_DIR.'/includes/classes/wordapp-themes.php';
require_once WORDAPP_DIR.'/includes/classes/wordapp-push-notifications.php';
require_once WORDAPP_DIR.'/includes/classes/wordapp-cron.php';

$widgets = new WordAppClass_widgets();  // include the custom posts and meta boxes
$createJson = new WordAppClass_json();
$mobilePlugin = new WordAppClass_mobile_plugin();
$mobileHomepage = new WordAppHomePage();
$mobilePages = new WordAppClass_mobile_pages();
$mobileShortcode = new WordAppShortcode();
$wa_is_mobile = new WordAppClass_ismobile();
$wa_theme = new WordAppClass_themes();
$wa_pns = new WordAppClass_push_notifications();
$wa_cron = new WordAppClass_cron();
//$wordappWidget = new WordApp_widget;
//$orgPlugins = new WordAppClass_org_plugins;
class WordAppClass
{
	private static $class = null;

	public function __construct()
	{
		// actions
		global $widgets,$createJson,$orgPlugins, $mobilePlugin,$mobileHomepage,$mobilePages,$mobileShortcode,$wa_is_mobile,$wa_theme,$wa_pns,$wa_cron;
		//$this->WordApp_mobile_detect();

		$this->init();

		add_action('init', array($this, 'init'), 1);
		$varGA = (array) get_option('WordApp_ga');
		if(!isset($varGA['waCronValue'])) $varGA['waCronValue'] ='2min';
		/*- actions & filters -*/
		if ( ! wp_next_scheduled(  'wa_task_hook')  ) {
			wp_schedule_event( time(), $varGA['waCronValue'],  'wa_task_hook' );
		}



		add_action( 'wa_task_hook', array($wa_cron, 'wordapp_task_function') );



		add_action('wp_enqueue_scripts', array($this, 'wordapp_enqueue_custom_scripts'));

		add_action('admin_enqueue_scripts', array($this, 'WordApp_add_color_picker'));
		add_action('wp_head', array($this, 'wordapp_add_my_script'), 8);
		add_action('wp_footer', array($this, 'WordApp_inc_push_notes'), 99);
		add_action('wp_head', array($this, 'WordApp_inc_header'), 99);
		add_filter('json_prepare_post',  array($this, 'api_to_wordapp'), 10, 3);
		add_action('admin_menu',  array($this, 'register_WordApp_menu'), 9);
		add_action('admin_init',  array($this, 'WordAppSettingValues'));
		add_action('init', array($createJson, 'WordApp_produce_my_json'));
		add_action('init', array($widgets, 'WordApp_register_widget'));
		add_action('init', array($mobilePlugin, 'wordapp_comstom_posts'));
		add_action('init', array($mobilePages, 'wordapp_mobile_pages'));

		add_action( 'init', array($wa_pns, 'wordapp_push_notifications'));

		add_action('plugins_loaded', array($this, 'WordApp_mobile_detect'));
		add_filter('init', array($this, 'WordApp_change_theme_root'));
		add_action('admin_head-edit.php', array($mobilePlugin, 'wordapp_addCustomImportButton'));
		add_action('init', array($mobileShortcode, 'wordapp_get_shortcode'));
		// Mobile home
		add_filter( 'gettext', array( $wa_theme, 'wordapp_customizer_text' ) );
		// Mobile home
		// add_filter('option_page_on_front', array($this, 'filterOption'));
		// add_filter('option_show_on_front', array($this, 'filter_show_on_front'));

		if (!isset($_GET['WordApp_launch'])) {
			$_GET['WordApp_launch'] = '';
		}
		
				

		$varColor = (array) get_option('WordApp_options');
		$varSettings = (array) get_option('WordApp_ga');
		if(!isset($varColor['style'])){ $varColor['style'] ='';}


		if (($this->wordapp_wp_is_mobile() && $varColor['style'] == 'page' && $varSettings['mobilesite'] == 'on') || $_GET['WordApp_launch'] == '1') {
			/* Display and echo mobile specific stuff here */
			//add_filter('option_page_on_front', array($mobileHomepage, 'wordappfilterOption'));
			//add_filter('option_show_on_front', array($mobileHomepage, 'wordappfilter_show_on_front'));
			add_action('template_redirect', array($mobileHomepage, 'wordapp_template_redirect')); //fix from amclin
		}

		add_action('switch_theme', array($this, 'wordapp_check_theme_dependencies'), 10, 2);
		add_action('after_switch_theme', array($this, 'wordapp_check_theme_dependencies'), 10, 2);


		/*---PNS---*/

		add_action( 'wp_ajax_nopriv_wa_add_pn', array($wa_pns, 'wa_add_pn') );
		add_action( 'wp_ajax_wa_add_pn', array($wa_pns, 'wa_add_pn') );
		
		
		add_action( 'wp_ajax_nopriv_wa_add_pn_send', array($wa_pns, 'wa_add_pn_send') );
		add_action( 'wp_ajax_wa_add_pn_send', array($wa_pns, 'wa_add_pn_send') );

		/*-- SHORTCODE --*/

		add_shortcode('wordApp_is_mobile', array($mobileShortcode, 'wordapp_shortcode_is_mobile'));
		add_shortcode('wordApp_googlemap', array($mobileShortcode, 'wordapp_googleMapShortcode'));
		add_shortcode('wordApp_qrcode', array($mobileShortcode, 'wordapp_qrcodeReaderShortcode'));
		add_shortcode('wordApp_socialshare', array($mobileShortcode, 'wordapp_socialShareShortcode'));
		add_shortcode('wordApp_ratemyapp', array($mobileShortcode, 'wordApp_rateMyApp'));


		add_shortcode('wordApp_contact_form', array($mobileShortcode, 'wordapp_contact_shortcode'));

		add_shortcode('wordApp_tel', array($mobileShortcode, 'wordapp_phone_shortcode'));

		add_action('plugins_loaded', array($this, 'wordapp_load_plugin_textdomain'));

		/*-- / SHORTCODE --*/

		/*- WP REST API -*/
		//$this->include_wp_rest_api();

		/*-- Theme switch for mobile sites --*/
	}

	public function init()
	{
	}
	public function wordapp_check_theme_dependencies($oldtheme_name, $oldtheme)
	{
	}


	public function wordapp_load_plugin_textdomain()
	{
		load_plugin_textdomain('wordapp-mobile-app', false, basename(dirname(__FILE__)).'/languages/');
	}
	public function WordApp_mobile_detect()
	{
		global $id, $wpdb,$wp_query,$wa_is_mobile,$wp_scripts,$wp_styles;
		if (!isset($_GET['WordApp_mobile_site'])) {
			$_GET['WordApp_mobile_site'] = '';
		}
		if (!isset($_GET['WordApp_demo'])) {
			$_GET['WordApp_demo'] = '';
		}
		if (!isset($_GET['WordApp_mobile_app'])) {
			$_GET['WordApp_mobile_app'] = '';
		}

		if (!class_exists('wa_Mobile_Detect')) {
			require plugin_dir_path(__FILE__).'third/Mobile_Detect.php';
			$detect = new wa_Mobile_Detect();
			$is_mobile = $detect->isMobile();
			$is_tab = $detect->isTablet();
		}

		$varGA = (array) get_option('WordApp_ga');

		if (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'desktop') {
			setcookie('WordApp_mobile_site', 'desktop', time() + 3600 * 6, '/');
			$_COOKIE['WordApp_mobile_site'] = 'desktop';
		}

		if (isset($is_mobile) && $is_mobile == true && !$is_tab && ($_GET['WordApp_mobile_site'] == 'mobile' || $_GET['WordApp_mobile_site'] == '')) {
			setcookie('WordApp_mobile_site', 'mobile', time() + 3600 * 6, '/');
			$_COOKIE['WordApp_mobile_site'] = 'mobile';
		}

		if (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') {
			setcookie('WordApp_mobile_app', true, time() + 3600 * 6, '/');
			$_COOKIE['WordApp_mobile_app'] = true;
		}
		if (isset($_GET['WordApp_goodbye_mobile'])  &&  $_GET['WordApp_goodbye_mobile'] === '1') {
			setcookie('WordApp_mobile_app', true, time() - 100, '/');
			unset($_COOKIE['WordApp_mobile_app']);
		}

		if((isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || ((isset($_COOKIE['WordApp_mobile_site']) && $_COOKIE['WordApp_mobile_site'] == 'mobile') &&  $varGA['mobilesite'] == "on") || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true))  {

			$varColor = (array) get_option('WordApp_options');

			if (!isset($varColor['theme'])) {
				$varColor['theme'] = '';
			}

			$varHomePages = get_option('wordapp_mobile_pages_home');
			//$post = get_post($post_id);

			//echo $varColor['theme'] .' - '.$varHomePages ." == ".$post_ID;

			// echo $slug[0];
			if (strpos($varColor['theme'], '|') !== false) {

				list($themeSelected, $themeType) = explode('|', $varColor['theme']);
			
			
			}else{
				$themeSelected = $varColor['theme'];
			}

			if ($themeSelected == 'MyiOS') {
				$mobile_home = $this->wa_get_the_post_id();

				/* Dequeue Theme CSS */


			}

			if ($themeSelected == 'MyiOS' && $varHomePages == $mobile_home) {
				add_action('template_include', array($this, 'WordApp_MyiOSTheme'), 100);
			}

			elseif ($varColor['theme'] == 'MyTheme') {
				$theme_data = wp_get_theme();
				$themename =  $theme_data->get( 'TextDomain' );
				
				if($themename == ''){
					$themename = basename(get_stylesheet_directory_uri());
				}
				$list = array(' ', '%20', '+');
				$varColor['mythemeName'] = str_replace($list,'-',$varColor['mythemeName']);
				$themename = str_replace($list,'-',$themename);
				if($varColor['mythemeName'] == ''){
					
					$varColor['mythemeName'] = $themename;
				}
				if($varColor['mythemeName'] == $themename){

				}else{

					add_filter('template', array($this, 'WordApp_mytheme_change_theme'), 99);
					add_filter('stylesheet', array($this, 'WordApp_mytheme_change_theme'), 99);
				}
			} elseif ($varColor['theme'] != 'MyiOS') {





				add_filter('theme_root', array($this, 'WordApp_change_theme_root'), 99);
				add_filter('stylesheet_directory_uri', array($this, 'WordApp_change_theme_root_css_uri'), 99);
				add_filter('template_directory_uri', array($this, 'WordApp_change_theme_root_uri'), 99);
				add_filter('template', array($this, 'WordApp_fxn_change_theme'), 99);
				add_filter('stylesheet', array($this, 'WordApp_fxn_change_theme'), 99);


			} else {
				//add_filter( 'current_theme', array( $this, 'WordApp_mytheme_change_theme' ),99 );
				add_filter('theme_root', array($this, 'WordApp_change_theme_root'), 99);
				add_filter('stylesheet_directory_uri', array($this, 'WordApp_change_theme_root_css_uri'), 99);
				add_filter('template_directory_uri', array($this, 'WordApp_change_theme_root_uri'), 99);
				add_filter('template', array($this, 'WordApp_fxn_change_theme'), 99);
				add_filter('stylesheet', array($this, 'WordApp_fxn_change_theme'), 99);
			}
			show_admin_bar(false);
		}
	}
	public function wa_get_the_post_id()
	{
		global $wpdb;
		if (!isset($_GET['wordapp_mobile_pages'])) {
			$_GET['wordapp_mobile_pages'] = '';
		}
		if ($_GET['wordapp_mobile_pages'] == '') {
			$link = explode('?', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$link = str_replace(home_url('/'), '', $link[0]);

			if (($len = strlen($link)) > 0 && $link[$len - 1] == '/') {
				$link = substr($link, 0, -1);
			}
			$link = explode('/', $link);
			$slug = end($link);
		} else {
			$slug = sanitize_text_field($_GET['wordapp_mobile_pages']);
		}
		$sql = "
      SELECT
         ID
      FROM
         $wpdb->posts
      WHERE
        post_name = '".$slug."'
   ";

		return $wpdb->get_var($sql);
	}

	public function WordApp_get_slugs()
	{
		$link = explode('?', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$link = str_replace(home_url('/'), '', $link[0]);

		return  $link;
		/*url_to_postid( $url );

        if ( ( $len = strlen( $link ) ) > 0 && $link[$len - 1] == '/' ) {
            $link = substr( $link, 0, -1 );
    }

             $link = explode( '/', $link );

        return end($link);

        */
	}

	public function WordApp_MyiOSTheme()
	{
		return WORDAPP_DIR.'/themes/wordappjqmobileMyiOS/mainPage.php';
		exit;
	}

	public function WordApp_change_theme_root()
	{
		return plugin_dir_path(__FILE__).'themes';
	}

	public function WordApp_change_theme_root_uri()
	{
		$varColor = (array) get_option('WordApp_options');

		if (!isset($varColor['theme'])) {
			$varColor['theme'] = '';
		}
		$pieces = explode('|', $varColor['theme']);

		// $varColor['theme'];
		// Return the new theme root uri
		if (!isset($varColor['theme'])) {
			$varColor['theme'] = '';
		}
		$pieces = '';
		if ($varColor['theme'] == '') {
			return plugins_url('themes/wordappjqmobile', __FILE__);
		} else {
			$pieces = explode('|', $varColor['theme']);

			return plugins_url('themes/wordappjqmobile'.$pieces[0], __FILE__);
		}
	}
	public function WordApp_change_theme_root_css_uri()
	{
		// Return the new theme root uri
		$varColor = (array) get_option('WordApp_options');
		if (!isset($varColor['theme'])) {
			$varColor['theme'] = '';
		}
		$pieces = '';

		if ($varColor['theme'] == '') {
			return plugins_url('themes/wordappjqmobile', __FILE__);
		} else {
			$pieces = explode('|', $varColor['theme']);

			return plugins_url('themes/wordappjqmobile'.$pieces[0], __FILE__);
		}
	}

	public function WordApp_fxn_change_theme($theme)
	{
		// Return the new theme root uri
		$varColor = (array) get_option('WordApp_options');
		if (!isset($varColor['theme'])) {
			$varColor['theme'] = '';
		}
		$pieces = '';

		if ($varColor['theme'] == '') {
			$theme = DEFAULT_WordApp_THEME;
		} else {
			$pieces = explode('|', $varColor['theme']);
			$theme = DEFAULT_WordApp_THEME.$pieces[0];
		}

		return $theme;
	}

	public function WordApp_mytheme_change_theme($theme)
	{
		// Return the new theme root uri
		$varColor = (array) get_option('WordApp_options');
		if (!isset($varColor['mythemeName'])) {
			$varColor['mythemeName'] = '';
		}
		$pieces = '';

		$theme = $varColor['mythemeName'];

		return $theme;
	}

	/* ----  Admin Pages ------ */
	public function WordAppHomepage()
	{
		include plugin_dir_path(__FILE__).'includes/admin/index_page.php';
	}

	public function WordAppGetStarted()
	{
		include plugin_dir_path(__FILE__).'includes/admin/start.php';
	}

	public function WordAppBuilder()
	{
		include plugin_dir_path(__FILE__).'includes/admin/home.php';
	}

	public function WordAppPN()
	{
		include plugin_dir_path(__FILE__).'includes/admin/push_notes.php';
	}

	public function WordAppStats()
	{
		include plugin_dir_path(__FILE__).'includes/admin/stats.php';

	}

	public function WordAppSettings()
	{
		global $orgPlugins;
		include plugin_dir_path(__FILE__).'includes/admin/settings.php';
	}

	public function WordAppMoreDownloads()
	{
		include plugin_dir_path(__FILE__).'includes/admin/more_downloads.php';
	}

	public function WordAppMarketing()
	{
		include plugin_dir_path(__FILE__).'includes/admin/marketing_gear.php';
	}

	public function WordAppiBeacon()
	{
		include plugin_dir_path(__FILE__).'includes/admin/iBeacon.php';
	}

	public function WordAppCrowd()
	{
		include plugin_dir_path(__FILE__).'includes/admin/the_crowd.php';
	}

	public function WordAppPluginsAndThemes()
	{
		include plugin_dir_path(__FILE__).'includes/admin/plugins.php';
	}
	public function WordAppVideos()
	{
		include plugin_dir_path(__FILE__).'includes/admin/videos.php';
	}
	public function WordAppCss()
	{
		include plugin_dir_path(__FILE__).'includes/admin/css_editor.php';
	}

	public function WordAppGoPro()
	{

		include plugin_dir_path(__FILE__).'includes/admin/pro.php';


	}
	public function WordAppAdMob()
	{

		include plugin_dir_path(__FILE__).'includes/admin/admob.php';


	}
	/* ----  /Admin Pages ------ */

	/* -- Registering forms --*/
	public function WordAppSettingValues()
	{
		add_settings_section('WordApp_main', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppColor', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main');
		register_setting('WordApp_main', 'WordApp_options');

		add_settings_section('WordApp_main_ga', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppGA', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_ga');
		register_setting('WordApp_main_ga', 'WordApp_ga');

		add_settings_section('WordApp_main_admob', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppAdMob', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_admob');
		register_setting('WordApp_main_admob', 'WordApp_admob');


		add_settings_section('WordApp_main_ibeacon', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppibeacon', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_ibeacon');
		register_setting('WordApp_main_ibeacon', 'WordApp_ibeacon');

		add_settings_section('WordApp_main_menu', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppMenu', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_menu');
		register_setting('WordApp_main_menu', 'WordApp_menu');

		add_settings_section('WordApp_main_structure', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppStucutre', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_structure');
		register_setting('WordApp_main_structure', 'WordApp_structure');

		add_settings_section('WordApp_main_slideshow', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppSlideshow', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_slideshow');
		register_setting('WordApp_main_slideshow', 'WordApp_slideshow');

		add_settings_section('WordApp_main_css', 'Main Settings', 'plugin_section_text', 'WordApp');
		add_settings_field('WordAppCss', 'Theme Toolbar Color', 'WordAppColor_display', 'WordApp', 'WordApp_main_css');
		register_setting('WordApp_main_css', 'WordApp_css');
	}
	public function plugin_section_text()
		{ //TO RENAME
		echo '<p>Main description of this section here.</p>';
	}

	public function WordAppColor_display()
		{ //TO RENAME
		//$options = get_option('WordAppColor');
		//echo "<input id='WordAppColor' name='WordAppColor' size='40' type='text' value='".$options."' />";
	}

	public function plugin_options_validate($input)
		{ //RENAME
		$newinput['text_string'] = trim($input['text_string']);
		if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
			$newinput['text_string'] = '';
		}

		return $newinput;
	}

	/* -- /Registering Forms -- */

	/* ----  Admin Menu ------ */

	public function register_WordApp_menu()
	{
		$page_title = 'WordApp';
		$menu_title = 'WordApp';
		$capability = 'activate_plugins';
		$menu_slug = 'WordApp';
		$function = 'WordAppHomepage';

		//update_option( 'wordapp_firstCreation', '' );
		$GLOBALS['my_page'] = array();

		if (get_option('wordapp_firstCreation') == '') {
			$GLOBALS['my_page'][] = add_menu_page(__('Getting Started', 'wordapp-mobile-app'), $menu_title, $capability, $menu_slug, array($this, 'WordAppGetStarted'), plugins_url(APPNAME.'/images/app20x20.png'), 66);
			$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Quick install', 'wordapp-mobile-app'), __('Quick Install', 'wordapp-mobile-app'), $capability, 'WordAppGetStarted', array($this, 'WordAppGetStarted'));
		} else {
			$GLOBALS['my_page'][] = add_menu_page(__('Getting Started', 'wordapp-mobile-app'), $menu_title, $capability, $menu_slug, array($this, $function), plugins_url(APPNAME.'/images/app20x20.png'), 66);
		}
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('App Builder', 'wordapp-mobile-app'), __('App Builder', 'wordapp-mobile-app'), $capability, 'WordAppBuilder', array($this, 'WordAppBuilder'));
			
	
		if (get_option('WordApp_pro') == 'on') {

			$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Monetize Your App', 'wordapp-mobile-app'), ''.__('Monetize Your App', 'wordapp-mobile-app').'', $capability, 'WordAppAdMob', array($this, 'WordAppAdMob'));
	
	$GLOBALS['my_page_appbuilder'][] = add_submenu_page($menu_slug, __('Beacons', 'wordapp-mobile-app'), __('Beacons', 'wordapp-mobile-app'), $capability, 'WordAppiBeacon', array($this, 'WordAppiBeacon'));

		} else {
			
					$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Go Premium', 'wordapp-mobile-app'), '<span style="color: #ff5a00;">'.__('Go Premium', 'wordapp-mobile-app').'</span>', $capability, 'WordAppGoPro', array($this, 'WordAppGoPro'));


			$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Monetize Your App', 'wordapp-mobile-app'), ''.__('Monetize Your App', 'wordapp-mobile-app').'', $capability, 'WordAppAdMob', array($this, 'WordAppAdMob'));

	
		}
		$GLOBALS['my_page'][] = add_submenu_page('WordAppSettings', __('The Crowd', 'wordapp-mobile-app'), __('The Crowd', 'wordapp-mobile-app'), $capability, 'WordAppCrowd', array($this, 'WordAppCrowd'));
		
		 $GLOBALS['my_page'][] = add_submenu_page('WordAppSettings', __('Tell a friend', 'wordapp-mobile-app'), __('Tell a friend', 'wordapp-mobile-app'), $capability, 'WordAppMoreDownloads', array($this, 'WordAppMoreDownloads'));
		
		
		
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Themes', 'wordapp-mobile-app'), __('Themes', 'wordapp-mobile-app'), $capability, 'WordAppPluginsAndThemes', array($this, 'WordAppPluginsAndThemes'));
		
		$GLOBALS['my_page'][] =  add_submenu_page( $menu_slug, __('Stats'), __('Stats'), $capability, 'WordAppStats', array($this, 'WordAppStats') ); // USING GA until find a better solution

		
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Video Tutorials', 'wordapp-mobile-app'), __('Video Tutorials', 'wordapp-mobile-app'), $capability, 'WordAppVideos', array($this, 'WordAppVideos'));
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Marketing Gear', 'wordapp-mobile-app'), __('Marketing Gear', 'wordapp-mobile-app'), $capability, 'WordAppMarketing', array($this, 'WordAppMarketing'));
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Code Editors', 'wordapp-mobile-app'), __('Code Editors', 'wordapp-mobile-app'), $capability, 'WordAppCss', array($this, 'WordAppCss'));
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Settings', 'wordapp-mobile-app'), __('Settings', 'wordapp-mobile-app'), $capability, 'WordAppSettings', array($this, 'WordAppSettings'));
		
		$GLOBALS['my_page'][] = add_submenu_page($menu_slug, __('Send a Push Notification', 'wordapp-mobile-app'), __('Send a Push Notification', 'wordapp-mobile-app'), $capability, 'WordAppPN', array($this, 'WordAppPN'));
		
		}
	/* ----  /Admin Menu ------ */

	/* ---Adding WP REST API --- */
	public function api_to_wordapp($_post, $post, $context)
	{
	}

	public function include_wordApp_rest_api()
	{
	}

	/* -- /Adding WP REST API --- */

	/* ------------------
* IMPORT CSS & EXTRA LIBS
------------------- */

	public function wordapp_wp_is_mobile()
	{
		static $is_mobile;

		if (isset($is_mobile)) {
			return $is_mobile;
		}

		if (empty($_SERVER['HTTP_USER_AGENT'])) {
			$is_mobile = false;
		} elseif (
			strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
			$is_mobile = true;
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
			$is_mobile = true;
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
			$is_mobile = false;
		} else {
			$is_mobile = false;
		}

		return $is_mobile;
	}
	public function wordapp_add_my_script()
	{
		$varGA = (array) get_option('WordApp_ga');
		if (!isset($varGA['apiLogin'])) {
			$varGA['apiLogin'] = '';
		}
?>

	<script type="text/javascript">
	var appid = '<?php echo $varGA['apiLogin'];?>';
	</script>

<?php

	}
	/* --- INCLUDING JS for PUSH--- */

	public function WordApp_inc_push_notes($hook)
	{
		//echo $_SERVER['HTTP_USER_AGENT'];
		global $wa_is_mobile;
		$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
		$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
		$iPad = stripos($_SERVER['HTTP_USER_AGENT'], 'iPad');
		$Android = stripos($_SERVER['HTTP_USER_AGENT'], 'Android');
		$webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');

		if ($wa_is_mobile->WordApp_is_mobile()) {
			//do something with this information
			$varColor = (array) get_option('WordApp_options');
			$varGA = (array) get_option('WordApp_ga');
			$varMenu = (array) get_option('WordApp_menu');
			if (!isset($varGA['apiDomain'])) {
				$varGA['apiDomain'] = '';
			}
			if ($varColor['theme'] == 'MyTheme') {
				if($varMenu['barstyle'] == '' || $varMenu['barstyle'] == 'Default'){
					include plugin_dir_path(__FILE__).'themes/MyTheme/footer.php';
				}else{
					include plugin_dir_path(__FILE__).'themes/MyTheme/footer'.$varMenu['barstyle'].'.php';
				}

			}
		}
	}

	public function WordApp_inc_header($hook)
	{
		global $wa_is_mobile;
		if ($wa_is_mobile->WordApp_is_mobile()) {
			$varColor = (array) get_option('WordApp_options');
			$varGA = (array) get_option('WordApp_ga');
			$wamenu = (array) get_option('WordApp_menu');
			if (!isset($varGA['apiDomain'])) {
				$varGA['apiDomain'] = '';
			}
			if (!isset($wamenu['barstyle'])) {
				$wamenu['barstyle']  = '';
			}
			if ($varColor['theme'] == 'MyTheme') {
				if($wamenu['barstyle'] == '' || $wamenu['barstyle'] == 'Default'){
					include plugin_dir_path(__FILE__).'themes/MyTheme/header.php';
				}else{
					include plugin_dir_path(__FILE__).'themes/MyTheme/header'.$wamenu['barstyle'].'.php';
				}

			}
		}
	}

	public function wordapp_enqueue_custom_scripts()
	{
global $wa_is_mobile;
		//wp_register_script('googlemaps', ('https://maps.google.com/maps/api/js?sensor=false'), false, null, true);
		//wp_enqueue_script('googlemaps');
		
	if ($wa_is_mobile->WordApp_is_mobile()) {

		wp_register_script('wordapp_quickclick', WORDAPP_DIR_URL.'/themes/MyTheme/js/touche.js');
					
		wp_enqueue_script('wordapp_quickclick');
	}
	
		//if
		$date = date('YmdHsi');
		
		


		wp_enqueue_script('wapns', WORDAPP_DIR_URL.'js/ajax.js?date='.$date, array('jquery'));
		wp_localize_script( 'wapns', 'wapnsajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		

	}

	/* --- INCLUDING JS for PUSH--- */
	/* -- Color Picker --*/
	public function WordApp_add_color_picker($hook)
	{
		wp_enqueue_media();
		if(isset($GLOBALS['my_page'])){
			if (in_array($hook, $GLOBALS['my_page'])) {
				if ($_GET['page'] == 'WordAppCss') {
					wp_register_script('wordapp_codemirror', plugins_url('codemirror/lib/codemirror.js', __FILE__));
					wp_register_style('wordapp_codemirror', plugins_url('codemirror/lib/codemirror.css', __FILE__));

					wp_register_style('wordapp_cm_blackboard', plugins_url('codemirror/theme/blackboard.css', __FILE__));

					wp_register_script('wordapp_cm_css', plugins_url('codemirror/css/css.js', __FILE__));
				}
				
				if ($_GET['page'] == 'WordAppStats') {
					wp_register_script('wordapp_codestats', "https://www.gstatic.com/charts/loader.js");
					
				}
				if ($_GET['page'] == 'WordAppPN') {
					wp_register_script('custom_wordapp_js_tel', plugins_url('js/intlTelInput.min.js', __FILE__));
			wp_localize_script('custom_wordapp_js_tel', 'custom_wordapp_js_tel', array('pluginsUrl' => plugins_url('js/utils.js', __FILE__)));
wp_enqueue_script('custom_wordapp_js_tel');
					
				}

				

			}
			
			
			wp_register_style('custom_wordapp_tel',  plugins_url('css/intlTelInput.css', __FILE__), false, '1.0.0');

			wp_register_style('custom_wordapp_admin_css',  plugins_url('css/style.css', __FILE__), false, '1.0.0');
			wp_register_style('custom_wordapp_admin_messenger',  plugins_url('css/messenger.css', __FILE__), false, '1.0.0');


			wp_register_style('wordapp_css_fonts', plugins_url('css/fontselect.css', __FILE__));
			wp_register_script('wordapp_css_font', plugins_url('js/jquery.fontselect.min.js', __FILE__));
			wp_register_script('wordapp_bubble', plugins_url('js/kc_fab.js', __FILE__), array('jquery'));


			wp_register_script('wordapp_toastr', plugins_url('js/toastr.js', __FILE__));
			wp_register_script('wordapp_toastramaran', plugins_url('js/jquery.amaran.min.js', __FILE__));
			wp_register_script('wordapp_toastramaran', plugins_url('js/jquery.amaran.min.js', __FILE__));
			wp_register_script('wordapp_combodate', plugins_url('js/combodate.js', __FILE__));
			wp_register_script('wordapp_moment', plugins_url('js/moment.js', __FILE__));
			wp_register_style('wordapp_toastrcss', plugins_url('css/toastr.css', __FILE__));
			wp_register_style('wordapp_toastrcssamaran', plugins_url('css/amaran.min.css', __FILE__));
			wp_register_script('wordapp_cookie', plugins_url('js/jquery.cookie.js', __FILE__));

			wp_register_style('custom_wordapp_css_switch',  plugins_url('css/switchery.min.css', __FILE__), false, '1.0.0');
			wp_register_script('custom_wordapp_js_switch', plugins_url('js/switchery.min.js', __FILE__));
			
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('jquery');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_style('custom_wordapp_admin_messenger');
			wp_enqueue_style('custom_wordapp_tel');
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_script('wordapp_codemirror');
			wp_enqueue_script('wordapp_codestats');
			
			wp_enqueue_script('wordapp_bubble');
			wp_enqueue_style('wordapp_codemirror');

			wp_enqueue_style('wordapp_cm_blackboard');

			wp_enqueue_script('wordapp_cm_css');

			wp_enqueue_script('cpa_custom_js', plugins_url('js/scripts.js?'.date('YmdHsi').'', __FILE__), array('jquery', 'wp-color-picker', 'media-upload', 'thickbox'), '', true);

			wp_localize_script( 'cpa_custom_js', 'wapnsajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


			wp_enqueue_script('wordapp_custom_js',  plugins_url('js/jquery.simplyCountable.js', __FILE__), array('jquery'), '', true);
			wp_enqueue_script('wordapp_custom_js',  plugins_url('js/jquery.simplyCountable.js', __FILE__), array('jquery'), '', true);

			wp_enqueue_style('custom_wordapp_admin_css');

			wp_enqueue_script('wordapp_css_font');
			wp_enqueue_style('wordapp_css_fonts');
			wp_enqueue_script('wordapp_cookie');
			wp_enqueue_script('wordapp_toastr');
			wp_enqueue_script('wordapp_toastramaran');
			wp_enqueue_script('wordapp_combodate');
			wp_enqueue_script('wordapp_moment');
			wp_enqueue_style('wordapp_toastrcss');
			wp_enqueue_style('wordapp_toastrcssamaran');

			wp_enqueue_style('custom_wordapp_css_switch');
			wp_enqueue_script('custom_wordapp_js_switch');
		}
	}

	public function WordApp_options_enqueue_scripts()
	{
	}

	/* -- /Color Picker --*/

	/* --- Preparing WordApp --- */

	public function WordApp_activatePlugin()
	{
		if ( ! wp_next_scheduled(  'wa_task_hook')  ) {
			wp_schedule_event( time(), '5min',  'wa_task_hook' );
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, '5.0', '<')) {
			exit(sprintf('WordApp requires PHP 5.0 or higher. You’re still on %s.', PHP_VERSION));
		}

		// check WordApp folder name existence - we need that for MU compatibility
		if (basename(dirname(__FILE__)) !== APPNAME) {
			exit(__('The plugin must be installed to wp-content/plugins/wordapp-mobile-app - to help this, please ensure that the zip file you are installing is called wordapp-mobile-app.zip, or rename the folder via FTP', 'WordApp'));
		}

		if (!file_exists(ABSPATH.'wp-content/mu-plugins/')) {
			mkdir(ABSPATH.'wp-content/mu-plugins/');
		}

		if (file_exists(ABSPATH.'wp-content/mu-plugins/wordapp-mobile-appMU.php')) {
			unlink(ABSPATH.'wp-content/mu-plugins/wordapp-mobile-appMU.php');
		}

		if (file_exists(WP_PLUGIN_DIR.'/'.plugin_basename(dirname(__FILE__)).'/includes/classes/wordapp-mobile-appMU.php')) {
			copy(WP_PLUGIN_DIR.'/'.plugin_basename(dirname(__FILE__)).'/includes/classes/wordapp-mobile-appMU.php', ABSPATH.'wp-content/mu-plugins/wordapp-mobile-appMU.php');
		}
		$wordappversion = get_option('WordApp_plugin_version');
		if($wordappversion == '1.0'){

		}
		else{

			$theme_data = wp_get_theme();
			$themename =  $theme_data->get( 'TextDomain' );
			$myOptions['mythemeName'] = $themename;
			$myOptions['theme'] = 'MyTheme';
			$myOptions['Color'] = '#1e73be';
			$myOptions['style'] = '';
			$myOptions['local'] = 'local';

			$myOptions2['side'] = 'on';
			$myOptions2['top'] = 'on';
			$myOptions2['bottom'] = 'on';
			$myOptions2['activebars'] = 'on';
			$myOptions2['barstyle'] = 'Awesome';
			$myOptions2['activehelper'] = 'on';



			update_option('WordApp_options', $myOptions);

			update_option('WordApp_menu', $myOptions2);
			update_option( 'wordapp_firstCreation', '' );
		}
		update_option('WordApp_plugin_version', '1.0');
	}

	/**
	 * Plugin deactivation.
	 */
	public function WordApp_deactivatePlugin()
	{
		if (file_exists(ABSPATH.'wp-content/mu-plugins/wordapp-mobile-appMU.php')) {
			@unlink(ABSPATH.'wp-content/mu-plugins/wordapp-mobile-appMU.php');
		}
	}
}//END CLASS

function wordapp_register_widgets()
{
	register_widget('WordApp_widget');
	register_widget('WordAppPN_widget');
}

add_action('widgets_init', 'wordapp_register_widgets');

function WordAppClass()
{
	global $WordAppClass;

	if (!isset($WordAppClass)) {
		$WordAppClass = new WordAppClass();
	}

	return $WordAppClass;
}

/* ---- / Widgets ------ */
/*--- Install Hook ----*/
//register_activation_hook( __FILE__, array('WordAppClass', 'WordApp_activate') );

// initialize

if (class_exists('WordAppClass')) {
	$wordapp_mobile = new WordAppClass();
	// Activation
	register_activation_hook(__FILE__, array(&$wordapp_mobile, 'WordApp_activatePlugin'));
	register_deactivation_hook(__FILE__, array(&$wordapp_mobile, 'WordApp_deactivatePlugin'));
}
