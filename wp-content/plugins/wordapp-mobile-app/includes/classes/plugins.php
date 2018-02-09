<?php
class WordAppClass_org_plugins   {

	/* Registering the Widgets */
	public function __construct() {

	}


	function WordApp_remove_plugin( $plugin )
	{
		/* if ( isset( $plugin->remove_plugin[ $name ] ) && $plugin->remove_plugin[ $name ]  ) {
			if ( $name == 'jetpack' ) {
				//Removing plugins on mobile
				remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
				remove_filter( 'post_flair', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
				remove_filter( 'wp_footer', array( 'Jetpack_Likes', 'likes_master' ) );
				remove_action( 'init', array( 'Jetpack_Likes', 'action_init' ) );
				remove_filter( 'the_content', 'sharing_display', 19 );
				remove_filter( 'the_excerpt', 'sharing_display', 19 );
				add_filter( 'option_sharedaddy_disable_resources', array($this, 'wordapp_return_false') );
				add_filter( 'sharing_show', array($this,'wordapp_return_false') );

			}
	}
	*/
	}

	function WordApp_rm_plugins( )
		{ /*
		global $wp_filter;
		$plugins = (array)get_option( 'WordApp_ga' );
 		$plugins = $plugins['plugin_rm'];
		//echo "<h1>plugin<h1>";
		foreach($plugins as $plugin){
			echo '--'.$plugin;
			//remove_filter( 'before_init', $plugin, 1999);
		}
		$this->do_disabling('json_prepare_post');

	}

	public function do_disabling($tag=false) {
			 global $wp_filter;

		echo "wordapp";
			if ($tag) {
			    	$hook[$tag]=$wp_filter[$tag];
			       	if (!is_array($hook[$tag])) {
			   			echo "Nothing found for '$tag' hook";
			  		return;
			  		}
				 }
			 	else {
					  $hook=$wp_filter;
					  ksort($hook);
				}
				 echo '<pre>';
		print_r($hook);
			 		foreach($hook as $tag => $priority){
			 			 echo "<br />&gt;&gt;&gt;&gt;&gt;t<strong>$tag</strong><br />";
			 			 ksort($priority);
			 				 foreach($priority as $priority => $function){
			  						echo $priority;
			  						foreach($function as $name => $properties) echo "t$name<br />";
			 				 }
			 		}
			 echo '</pre>';
			 return;
			 */

	}
	function wordapp_return_false() {
		return false;
	}

}//END

?>