<?php
/**
 * WordApp - Home Page class
 * - over write homepage settings
 */

class WordAppHomePage {


	/**
	 * constructor - sets up actions & filters
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {


	}

	/**
	 * filter get_option( 'page_on_front' )
	 *
	 * @access public
	 * @return void
	 */
	public function wordappfilterOption($value) {
		// only check if is mobile

		$options = (array)get_option( 'WordApp_ga' );
		if( (isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || ((isset($_COOKIE['WordApp_mobile_site']) && $_COOKIE['WordApp_mobile_site'] == 'mobile') &&  $options['mobilesite'] == "on") || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true) || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'mobile'))  {

			$varPage = (array)get_option( 'WordApp_options' );
			if (!isset($varPage['page_id'])) {
			$varPage['page_id'] = '';
			}
			// if mobile home page is set, replace page_on_front with tablet home page
			if ($varPage['style'] == 'page') {
				$value = $varPage['page_id'];
			}
			return $value;
		}


	}
	public function wordappfilter_show_on_front($value) {

		$options = (array)get_option( 'WordApp_ga' );
		if( (isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || ((isset($_COOKIE['WordApp_mobile_site']) && $_COOKIE['WordApp_mobile_site'] == 'mobile') &&  $options['mobilesite'] == "on") || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true) || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'mobile'))  {
			$varPage = (array)get_option( 'WordApp_options' );

			if ($varPage['style'] == 'page') {
				$value = 'page';
			}
			return $value;
		}


	}


	function wordapp_template_redirect() {
		global $post;
		$thePostID = $post->ID;

		$varColor = (array)get_option( 'WordApp_options' );
		$frontpage_id = get_option('page_on_front');

		if(!isset($varColor['style'])) $varColor['style'] ='';
	
		if (strpos($varColor['theme'], '|') !== false) {

				list($themeSelected, $themeType) = explode('|', $varColor['theme']);
			
			
			}else{
				$themeSelected = $varColor['theme'];
			}

		
		if(!isset($_GET['red'])) $_GET['red'] ='';
		//if( ! is_front_page() ){ return;}
		$varPage = (array)get_option( 'WordApp_options' );
		if(!isset($varPage['style']))  $varPage['style'] ='';

		if($_GET['red'] =="1"){
			return;
		}elseif((is_front_page() || is_home()) && $varPage['style'] == 'page') {
			
			if (!isset($varPage['page_id'])) {
			$varPage['page_id'] = '';
			}
			$value = $varPage['page_id'];
			$mr_url= get_permalink($value)."?red=1&p=".$varPage['page_id']."&WordApp_launch=1&".$_SERVER['QUERY_STRING'];

			header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate"); //from amclin
			wp_redirect( $mr_url );
			exit;
		}
		else{
			/*
			$varPage = (array)get_option( 'WordApp_options' );
			$value = $varPage['page_id'];
			$mr_url= get_permalink($value)."?red=1&p=".$varPage['page_id']."&WordApp_launch=1&".$_SERVER['QUERY_STRING'];

			header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate"); //from amclin
			wp_redirect( $mr_url );
			exit;
			*/
		}


	}
	/**
	 * mobileHomePage_show_on_front_filter function.
	 *
	 * @access public
	 * @param mixed $value
	 * @return void
	 */


}