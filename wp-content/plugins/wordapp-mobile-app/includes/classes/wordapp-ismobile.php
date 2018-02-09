<?php

class WordAppClass_ismobile  {

	/*--  JSON RETURN --*/
	public function __construct() {
		$wordapp_wp_is_mobile = true;
	}

	/*--  JSON RETURN --*/
	function WordApp_is_mobile() {

		$re = false;

		if(!isset($_GET['WordApp_mobile_site'])) $_GET['WordApp_mobile_site'] = "";
		if(!isset($_GET['WordApp_demo'])) $_GET['WordApp_demo'] = "";
		if(!isset($_GET['WordApp_mobile_app'])) $_GET['WordApp_mobile_app'] = "";

		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

		if ((isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app' ) || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true)){

			$re =  true;

		}else{

			$re = false;

		}
		return $re;
	}


	function wordapp_wp_is_mobile() {

		$is_mobile = false;


		if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
			$is_mobile = false;
		} elseif (
			strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
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
	/*--  /JSON RETURN-- */
}
