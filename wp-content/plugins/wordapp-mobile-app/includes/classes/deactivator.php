<?php

class WordAppClass_deactivator  {
	var $hooks_to_find;
	var $files_to_scan;
	/*--  JSON RETURN --*/
	public function __construct() {
		$this->folder_to_scan = '';
		$this->hooks_to_find = array('action', 'filter');
		$this->files_to_scan = array();
		$this->actions_found = array();
		$this->filters_found = array();
		$this->custom_actions_found = array();
		$this->custom_filters_found = array();

		$this->pattern_actions = '/add_action(.*?);/i';
		$this->pattern_filters = '/add_filter(.*?);/i';
		$this->pattern_custom_actions = '/do_action(.*?);/i';
		$this->pattern_custom_filters = '/apply_filters(.*?);/i';
	}
	function WordApp_deactivate_plugins(){
		global $wp_filter;
		$varGA = (array)get_option( 'WordApp_ga' );

		$plugin_whitelist = array(  'hello', 'akismet', 'wordapp-mobile-app', 'woocommerce', 'buddypress', 'bbpress'  ) ;

		if(!isset($varGA['plugin_rm'])) $varGA['plugin_rm'] ="";
		if($varGA['plugin_rm'] == ""){

		}else{
			if( (isset($_GET['WordApp_demo']) && $_GET['WordApp_demo'] == '1') || ((isset($_COOKIE['WordApp_mobile_site']) && $_COOKIE['WordApp_mobile_site'] == 'mobile') &&  $varGA['mobilesite'] == "on") || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true) || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'mobile'))  {

				$hook=$wp_filter;


				ksort($hook);

				foreach($varGA['plugin_rm'] as $currentVal => $currentP){
					$currentPlug = $currentP;

					//if ( is_plugin_active(''.$currentPlug.'/index.php') ) {
					//     deactivate_plugins( $currentPlug.'/index.php', true );

					//     }
					/*Search in index here*/

					//echo  WordApp_get_files( WP_PLUGIN_DIR. '.php' );

					$this->files_to_scan =  $this->get_files( '*.php', GLOB_MARK, WP_PLUGIN_DIR.'/'.$currentPlug .'/');

					if ( count( $this->files_to_scan ) ) {

						foreach ( $this->files_to_scan as $f ) {
							//echo $f.'<br>';
							$handle = fopen( $f, "r" );

							if ( filesize( $f ) > 0 ) {

								$contents = fread( $handle, filesize( $f ) );

								fclose( $handle );

								if ( ( is_array( $this->hooks_to_find ) && in_array( 'action', $this->hooks_to_find ) ) || ( count( $this->hooks_to_find ) == 0 ) ) {

									// Scan for functions added to any actions.
									preg_replace_callback( $this->pattern_actions, array( &$this, 'find_actions' ), $contents );
									//'<pre>'.print_r($this->actions_found).'</pre><br>';
									ksort( $this->actions_found );

								} // End IF Statement

								if ( ( is_array( $this->hooks_to_find ) && in_array( 'filter', $this->hooks_to_find ) ) || ( count( $this->hooks_to_find ) == 0 ) ) {

									// Scan for functions added to any filters.
									preg_replace_callback( $this->pattern_filters, array( &$this, 'find_filters' ), $contents );

									ksort( $this->filters_found );

								} // End IF Statement

								if ( ( is_array( $this->hooks_to_find ) && in_array( 'custom_action', $this->hooks_to_find ) ) || ( count( $this->hooks_to_find ) == 0 ) ) {

									// Scan for functions added to any custom actions.
									preg_replace_callback( $this->pattern_custom_actions, array( &$this, 'find_custom_actions' ), $contents );

									ksort( $this->custom_actions_found );

								} // End IF Statement

								if ( ( is_array( $this->hooks_to_find ) && in_array( 'custom_filter', $this->hooks_to_find ) ) || ( count( $this->hooks_to_find ) == 0 ) ) {

									// Scan for functions added to any custom filters.
									preg_replace_callback( $this->pattern_custom_filters, array( &$this, 'find_custom_filters' ), $contents );

									ksort( $this->custom_filters_found );

								} // End IF Statement

							} // End IF Statement

						} // End FOREACH Loop

					}




					$regex_filter_action_to_match = "/^".$currentPlug."/i";
					foreach($hook as $tag => $priority){

						if ( !preg_match($regex_filter_action_to_match, $tag) ) continue;

						ksort($priority);
						foreach($priority as $priority => $function){

							foreach($function as $name => $properties) {

								if ( function_exists($name) ){
									$func = new ReflectionFunction($name);
									$filename = $func->getFileName();
									$start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
									$path_info = pathinfo($filename);

									if($priority ==""):
										remove_action( $tag, $name);
									else:
										remove_action( $tag, $name, $priority);
									endif;

								}else{
									if($priority ==""):
										remove_filter( $tag, $name);
									else:
										remove_filter( $tag, $name, $priority);
									endif;

								}
								//remove_action( 'init', array( 'Jetpack_Likes', 'action_init' ) );
							}
						}
					}
				}
			}

		}
	}




	function get_files ( $pattern, $flags = 0, $path = '' ) {

		if ( ! $path && ( $dir = dirname( $pattern ) ) != '.' ) {

			if ($dir == '\\' || $dir == '/') { $dir = ''; } // End IF Statement

			return $this->get_files(basename( $pattern ), $flags, $dir . '/' );

		} // End IF Statement

		$paths = glob( $path . '*', GLOB_ONLYDIR | GLOB_NOSORT );
		$files = glob( $path . $pattern, $flags );

		foreach ( $paths as $p ) {

			$files = array_merge( $files, $this->get_files( $pattern, $flags, $p . '/' ) );

		} // End FOREACH Loop

		return $files;

	} // End get_files()


	function find_actions ( $matches ) {

		$this->process_regex( $matches, 'actions_found' );

	} // End find_actions()

	function find_filters ( $matches ) {

		$this->process_regex( $matches, 'filters_found' );

	} // End find_filters()

	function find_custom_actions ( $matches ) {

		$this->process_regex( $matches, 'custom_actions_found', true );

	} // End find_custom_actions()

	function find_custom_filters ( $matches ) {

		$this->process_regex( $matches, 'custom_filters_found', true );

	} // End find_custom_filters()

	function process_regex ( $matches, $array, $is_custom = false ) {
		//print_r($array);
		//do remove statements here

		$tag = str_replace("add_action(", "",$matches[0]);
		$tag = str_replace("add_filter(", "",$tag);
		$tag = str_replace("add_action(", "",$matches[0]);

		$tag = str_replace(");", "",$tag);


		if ( $array == 'filters_found' ){

			//remove_filter($tag);

			/*
					if($priority ==""):
					echo "remove_action( $tag, $name)";
					else:
					echo "remove_action( $tag, $name, $priority)";
					endif;
					*/
		}
		elseif($array == 'actions_found'){

			//remove_action( $tag );



		}


	} // End process_regex()



}
?>