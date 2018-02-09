<?php
/*
Plugin Name: WordApp MU
Plugin URI: http://app-developers.biz/
Version: v1.0
Author: Davidd Anthony
Description: Helper plugin for WordApp
 */

if (file_exists(ABSPATH . "wp-content/plugins/wordapp-mobile-app/")) {

	include ABSPATH . "wp-content/plugins/wordapp-mobile-app/WordApp.php";

	/**
	 * MU Helper class
	 */
	class WordAppMU {
		/**
		 * Disable any selected plugins
		 */
		function disablePlugins($pluginList) {

			if (is_admin()) return $pluginList; // only deactivate on front end

			global $wordapp_mobile;

			$options = (array)get_option( 'WordApp_ga' );

			if( (isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || ((isset($_COOKIE['WordApp_mobile_site']) && $_COOKIE['WordApp_mobile_site'] == 'mobile') &&  $options['mobilesite'] == "on") || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true) || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'mobile'))  {

				if (isset($options['plugin_rm']) && $options['plugin_rm']) {

					foreach ($options['plugin_rm'] as $plugin) {
						if (in_array($plugin, $pluginList)) {
							unset($pluginList[array_search($plugin, $pluginList)]);
						}
					}
				}
			}
			return $pluginList;

		}


	}
	$WordAppMU = new WordAppMU();

	add_filter('option_active_plugins', array($WordAppMU, 'disablePlugins'), 10, 1);

}