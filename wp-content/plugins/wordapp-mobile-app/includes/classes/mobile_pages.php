<?php
class WordAppClass_mobile_pages   {

	/* Registering the Widgets */
	public function __construct() {

	}


	function wordapp_mobile_pages() {
		add_theme_support( 'post-thumbnails' );
		register_post_type( 'wordapp_mobile_pages', array(
				'labels' => array(
					'name' => 'Mobile Pages',
					'singular_name' => 'Mobile Page',
					'add_new_item' => 'Add new mobile page',
					'all_items ' => 'My mobile pages',
					'name_admin_bar' => 'Mobile Pages'
				),
				'show_in_admin_bar' => true,
				'exclude_from_search' => false,
				'description' => 'Active Mobile pages',
				'public' => true,
				'supports' => array( 'title','editor','thumbnail','tags'),
				'taxonomies' => array('post_tag'),
				'capability_type'     => 'page',
				'public' => true,
				'hierarchical' => false,
				'_builtin' => false,
				'rewrite' => array('slug' => 'wordapp_mobile_pages','with_front' => FALSE)
			));
		flush_rewrite_rules();
	}

	/*
 function wordapp_addCustomImportButton()
{
    global $current_screen;

    // Not our post type, exit earlier
    // You can remove this if condition if you don't have any specific post type to restrict to.
    if ('wordapp_mobile_pages' != $current_screen->post_type) {
        return;
    }

    ?>
        <script type="text/javascript">
            jQuery(document).ready( function($)
            {
                jQuery(jQuery(".add-new-h2")[0]).html("Add New Plugin");
				jQuery(jQuery(".add-new-h2")[0]).attr("href","admin.php?page=WordAppPluginsAndThemes");
            });
        </script>
    <?php
}	*/
}//END

?>