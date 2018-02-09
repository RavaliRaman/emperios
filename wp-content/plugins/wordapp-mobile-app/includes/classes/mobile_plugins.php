<?php
class WordAppClass_mobile_plugin   {

	/* Registering the Widgets */
	public function __construct() {

	}


	function wordapp_comstom_posts() {
		/*add_theme_support( 'post-thumbnails' );
		register_post_type( 'wordapp_plugins', array(
				'labels' => array(
					'name' => 'Active Plugins',
					'singular_name' => 'Plugin',
					'add_new_item' => 'Add new mobile plugin',
					'all_items ' => 'My mobile plugins',
					'name_admin_bar' => 'Mobile Plugins'
				),
				'show_in_admin_bar' => false,
				'exclude_from_search' => true,
				'description' => 'Active Mobile app plugins',
				'public' => true,
				'show_in_menu' => 'WordApp',
				'supports' => array( 'title'),
				'capability_type'     => 'post',

				'capabilities' => array(
					'create_posts' => true,
					'map_meta_cap'        => true,
					'delete_posts' => true,
				)
			));
			*/
				}


	function wordapp_addCustomImportButton()
	{
		global $current_screen,$wa_cron;
		if(!isset($_GET['force'] )) $_GET['force'] ='';
//if(!$_GET['force']){$_GET['force'] == '';}
		// Not our post type, exit earlier
		// You can remove this if condition if you don't have any specific post type to restrict to.
		if ('wa_pns' == $current_screen->post_type || 'wa_pns_messages' == $current_screen->post_type) {
			
		}else {
			
			return;
		}

?>
        <script type="text/javascript">
            jQuery(document).ready( function($)
            {
                jQuery(jQuery(".page-title-action")[0]).hide();
                jQuery(jQuery(".page-title-action")[0]).text('Force Send!');
                jQuery(jQuery(".page-title-action")[0]).attr("href", window.location.href + "&force=1");
				jQuery(jQuery(".page-title-action")[0]).show();
				
            });
        </script>
          <div class="notice notice-success is-dismissible">
        <p><?php _e( 'It is very important to backup your push notification users. <a href="http://app-developers.biz/backup-push-notification-users/" target="_blank">Backup Now!</a>', 'wordapp-mobile-app' ); ?></p>
    </div>
    <?php
	    
	    if($_GET['force'] == '1'){
		    
			//require_once WORDAPP_DIR.'/includes/classes/wordapp-cron.php';
			//$wa_cron = new WordAppClass_cron();
		    do_action('wa_task_hook');
		    
		    //
		   // jQuery(jQuery(".page-title-action")[0]).text('Sent!');
		    
	    }
	}
}//END

?>