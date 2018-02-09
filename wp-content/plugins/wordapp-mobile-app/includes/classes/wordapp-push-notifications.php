<?php
class WordAppClass_push_notifications   {

	/* Registering the Widgets */
	public function __construct() {
		add_filter( 'manage_edit-wa_pns_columns', array($this, 'wa_pns_columns' )) ;
		
		add_action( 'manage_wa_pns_posts_custom_column', array($this, 'wa_pns_manage_columns'), 10, 2 );
		
		add_filter( 'manage_edit-wa_pns_messages_columns', array($this, 'wa_pns_messages_columns' )) ;
		
		add_action( 'manage_wa_pns_messages_posts_custom_column', array($this, 'wa_pns_messages_manage_columns'), 10, 2 );
		

		
		add_action( 'add_meta_boxes', array($this, 'wa_pn_add_metaboxes') );

		add_action('save_post', array($this,'wa_pn_save_meta'), 1, 2); // save the custom fields

		add_action('save_post', array($this,'wa_pn_message_save_meta'), 1, 2); // save the custom fields
		add_action('publish_post', array($this,'wordapp_updated_send_push'), 10, 2); // save the custom fields

		
		
		add_action( 'init', array($this,'wordapp_custom_post_status'));

	}

function wordapp_custom_post_status(){
	
}


function wa_add_pn_send() {
	
	
if ( 
    ! isset( $_POST['wa_push_nonce'] ) 
    || ! wp_verify_nonce( $_POST['wa_push_nonce'], 'wa_pn_nonce' ) 
) {

   print 'Sorry, your nonce did not verify.';
   exit;

} else {

    $title = sanitize_text_field($_POST['message']);
    $content =  '';
	$wadate =  sanitize_text_field($_POST['datetime24']);
	
	if(!isset($wadate)){
		$wadate = date('Y-m-d H:i:s');
	}
	
  $page =  array(
        'post_title'        => $title,
        'post_content'      => $content,
        'post_status'       => 'publish',
        'post_type' => 'wa_pns_messages',
        'post_date'  => $wadate, 
		'post_date_gmt'  => $wadate, 
        'post_author'       => '1'
		);

        // Page doesn't exist, so lets add it
      echo   $post_id = wp_insert_post( $page );


	  add_post_meta($post_id, '_wapn_message', 'no');
        
         
	$args = array( 'post_type' => 'wa_pns' );
	 $post_ids = get_posts(array(
        $args, //Your arguments
        'post_type'        => 'wa_pns',
        'posts_per_page'=> -1,
        'fields'        => 'ids', // Only get post IDs
    ));
    
    
	 $jsonTitles = json_encode($post_ids, false);
     
     add_post_meta($post_id, '_wapn_message_users', $jsonTitles);

	 add_post_meta($post_id, '_wapn_message_users_count', count($post_ids));
	
   // process form data
}
	
	
}



function wa_add_pn() {
    $results = '';
 
    $title = base64_encode(sanitize_text_field($_POST['apftitle']));
    $content =  sanitize_text_field($_POST['apfcontents']);
	$post_id = 0;
	$page_exists = get_page_by_title( $title, OBJECT, 'wa_pns');

     $page =  array(
        'post_title'        => $title,
        'post_content'      => $content,
        'post_status'       => 'publish',
        'post_type' => 'wa_pns',
        'post_author'       => '1'
		);

    if( $page_exists == null ) {
        // Page doesn't exist, so lets add it
        $post_id = wp_insert_post( $page );
        
        add_post_meta($post_id, '_wapn', $content, false);
        
    } else {
        // Page already exists
        
    }

	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
  	update_user_meta( $user_id, 'wordapp_push_device_token', $title);
	    	
	}
		    
    if ( $post_id != 0 )
    {
        $results = '*Post Added';
    }
    else {
        $results = '*Error occurred while adding the post';
    }
    // Return the String
    die($results);
}

	
	// Register Custom Post Type
// Register Custom Post Type
// Register Custom Post Type
function wordapp_push_notifications() {

	$labels = array(
		'name'                  => _x( 'PN Users', 'Post Type General Name', 'wordapp-mobile-app' ),
		'singular_name'         => _x( 'PN Users', 'Post Type Singular Name', 'wordapp-mobile-app' ),
		'menu_name'             => __( 'PN Users', 'wordapp-mobile-app' ),
		'name_admin_bar'        => __( 'PN User', 'wordapp-mobile-app' ),
		'archives'              => __( 'Item Archives', 'wordapp-mobile-app' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wordapp-mobile-app' ),
		'all_items'             => __( 'PN Users', 'wordapp-mobile-app' ),
		'add_new_item'          => __( 'Add New Item', 'wordapp-mobile-app' ),
		'add_new'               => __( 'Add New', 'wordapp-mobile-app' ),
		'new_item'              => __( 'New Item', 'wordapp-mobile-app' ),
		'edit_item'             => __( 'Edit Item', 'wordapp-mobile-app' ),
		'update_item'           => __( 'Update Item', 'wordapp-mobile-app' ),
		'view_item'             => __( 'View Item', 'wordapp-mobile-app' ),
		'search_items'          => __( 'Search Item', 'wordapp-mobile-app' ),
		'not_found'             => __( 'Not found', 'wordapp-mobile-app' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wordapp-mobile-app' ),
		'featured_image'        => __( 'Featured Image', 'wordapp-mobile-app' ),
		'set_featured_image'    => __( 'Set featured image', 'wordapp-mobile-app' ),
		'remove_featured_image' => __( 'Remove featured image', 'wordapp-mobile-app' ),
		'use_featured_image'    => __( 'Use as featured image', 'wordapp-mobile-app' ),
		'insert_into_item'      => __( 'Insert into item', 'wordapp-mobile-app' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wordapp-mobile-app' ),
		'items_list'            => __( 'Items list', 'wordapp-mobile-app' ),
		'items_list_navigation' => __( 'Items list navigation', 'wordapp-mobile-app' ),
		'filter_items_list'     => __( 'Filter items list', 'wordapp-mobile-app' ),
	);
	$args = array(
		'label'                 => __( 'PN Users', 'wordapp-mobile-app' ),
		'description'           => __( 'Push Notification subscribers', 'wordapp-mobile-app' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'taxonomies'            => array( 'Android', 'iOS' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_in_admin_bar' => false,
		'exclude_from_search' => true,
		'show_in_menu' => 'WordApp',

		'show_ui'               => true,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'wa_pns', $args );
	
	
		$labelsz = array(
		'name'                  => _x( 'PN Messages', 'Post Type General Name', 'wordapp-mobile-app' ),
		'singular_name'         => _x( 'PN Messages', 'Post Type Singular Name', 'wordapp-mobile-app' ),
		'menu_name'             => __( 'PN Messages', 'wordapp-mobile-app' ),
		'name_admin_bar'        => __( 'PN User', 'wordapp-mobile-app' ),
		'archives'              => __( 'Item Archives', 'wordapp-mobile-app' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wordapp-mobile-app' ),
		'all_items'             => __( 'PN Messages', 'wordapp-mobile-app' ),
		'add_new_item'          => __( 'Add New Item', 'wordapp-mobile-app' ),
		'add_new'               => __( 'Add New', 'wordapp-mobile-app' ),
		'new_item'              => __( 'New Item', 'wordapp-mobile-app' ),
		'edit_item'             => __( 'Edit Item', 'wordapp-mobile-app' ),
		'update_item'           => __( 'Update Item', 'wordapp-mobile-app' ),
		'view_item'             => __( 'View Item', 'wordapp-mobile-app' ),
		'search_items'          => __( 'Search Item', 'wordapp-mobile-app' ),
		'not_found'             => __( 'Not found', 'wordapp-mobile-app' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wordapp-mobile-app' ),
		'featured_image'        => __( 'Featured Image', 'wordapp-mobile-app' ),
		'set_featured_image'    => __( 'Set featured image', 'wordapp-mobile-app' ),
		'remove_featured_image' => __( 'Remove featured image', 'wordapp-mobile-app' ),
		'use_featured_image'    => __( 'Use as featured image', 'wordapp-mobile-app' ),
		'insert_into_item'      => __( 'Insert into item', 'wordapp-mobile-app' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wordapp-mobile-app' ),
		'items_list'            => __( 'Items list', 'wordapp-mobile-app' ),
		'items_list_navigation' => __( 'Items list navigation', 'wordapp-mobile-app' ),
		'filter_items_list'     => __( 'Filter items list', 'wordapp-mobile-app' ),
	);
	$argsz = array(
		'label'                 => __( 'PN Messages', 'wordapp-mobile-app' ),
		'description'           => __( 'Push Notification messages', 'wordapp-mobile-app' ),
		'labels'                => $labelsz,
		'supports'              => array( 'title', ),
		'taxonomies'            => array( 'Android', 'iOS' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_in_admin_bar' => false,
		'exclude_from_search' => true,
		'show_in_menu' => 'WordApp',
		'show_ui'               => true,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'wa_pns_messages', $argsz );

}

function wa_pn_add_metaboxes() {
	add_meta_box('wordapp_updated_send_push_meta', 'Send a Push ?', array($this, 'wordapp_updated_send_push_meta'), 'post', 'side', 'default');

	add_meta_box('wa_pn_type', 'Push Attributes', array($this, 'wa_pn_type'), 'wa_pns', 'normal', 'default');
	add_meta_box('wa_pn_message', 'Push Attributes', array($this, 'wa_pn_message'), 'wa_pns_messages', 'normal', 'default');



}

/* JSON */
function wa_pn_type() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="meta_noncename" id="meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$value = get_post_meta($post->ID, '_wapn', true);
	$valuesent = get_post_meta($post->ID, '_wapn_sent', true);
	$valuekey = get_post_meta($post->ID, '_wapn_key', true);
	// Echo out the field
	echo '<p><label>'.__('Smartphone type :','wordapp-mobile-plugin').' </label><br><input type="text" name="_wapn"  class="widefat" value="'.$value.'"></p>';
	echo '<p><label>'.__('Push Sent?','wordapp-mobile-plugin').' </label><br><input type="text" name="_wapn_sent"  class="widefat" value="'.$valuesent.'"></p>';

echo '<p><label>'.__('Push Key :','wordapp-mobile-plugin').' </label><br><input type="text" name="_wapn_key"  class="widefat" value="'.$valuekey.'"></p>';
}

function wa_pn_message() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="meta_noncename" id="meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$value = get_post_meta($post->ID, '_wapn_message', true);
	$valueusers = get_post_meta($post->ID, '_wapn_message_users', true);
	$valueuserscount = get_post_meta($post->ID, '_wapn_message_users_count', true);

	// Echo out the field
	echo '<p><label>'.__('Message Sent? ','wordapp-mobile-plugin').' </label><br><input type="text" name="_wapn_message"  class="widefat" value="'.$value.'"></p>';
	echo '<p><label>'.__('Total Sending ','wordapp-mobile-plugin').' </label><br><input type="text" name="_wapn_message_users_count"  class="widefat" value="'.$valueuserscount.'"></p>';
	echo '<p><label>'.__('Send to: ','wordapp-mobile-plugin').' </label><br><textarea type="text" name="_wapn_message_users"  class="widefat" >'.$valueusers.'</textarea></p>';
}



function wa_pns_messages_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'message' => __( 'Message' ),
		'sent' => __( 'Sent?' ),
		'date' => __( 'Date' )
	);

	return $columns;
}


function wa_pns_messages_manage_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		
		case 'message':
		
		echo get_the_title($post_id);
		break;
		case 'sent' :

			
				/* Join the terms, separating them with a comma. */
				$count = count(json_decode(get_post_meta($post_id, '_wapn_message_users', true),true));
				$total =  esc_html(get_post_meta($post_id, '_wapn_message_users_count', true));
				echo $total-$count;
				echo ' / '.$total;
			

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}



function wa_pns_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'uuid' => __( 'UUID' ),
		'phone' => __( 'Phone' ),
		'date' => __( 'Date' )
	);

	return $columns;
}


function wa_pns_manage_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		
		
		case 'uuid':
		
		$uu = get_the_title($post_id);
		echo substr($uu, 0, 50).'...';
		break;

		/* If displaying the 'genre' column. */
		case 'phone' :

			
				/* Join the terms, separating them with a comma. */
				echo esc_html(get_post_meta($post_id, '_wapn', true));
			

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}


/* ON SAVE SEND PUSH */


function wordapp_updated_send_push_meta() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="meta_noncename" id="meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$value = get_post_meta($post->ID, '_wapn_message', true);
	$valueusers = get_post_meta($post->ID, '_wapn_message_users', true);
	$valueuserscount = get_post_meta($post->ID, '_wapn_message_users_count', true);
	if (get_option('WordApp_pro') == 'on') {
	// Echo out the field
	echo '<p><input type="checkbox" name="_wapn_message_send"  class="widefat" value="YES"> '.__('Send a push notification to your mobile app?','wordapp-mobile-app').'</p>';
	}else{
		
		echo '<p>'.__('Send a push notification to your mobile app?','wordapp-mobile-app').' <a href="./admin.php?page=WordAppGoPro">'.__('(upgrade) ','wordapp-mobile-app').'</a></p>';
	}
}


function wordapp_updated_send_push( $post_id ) {		

if(!isset($_POST['meta_noncename'])){$_POST['meta_noncename'] = '';}
	if ( !wp_verify_nonce( $_POST['meta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}	
	
	if($_POST['_wapn_message_send'] == 'YES'){
	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) ){
		$prefix = __('UPDATED:','wordapp-mobile-app');
	}else{
		$prefix = __('NEW:','wordapp-mobile-app');

	}
		$title = $prefix.' '.get_the_title( $post_id );
		$post_url = get_permalink( $post_id );
		$results = '';
	
	


  //  $title = sanitize_text_field($_POST['_wapn_send']);
	//$content =  sanitize_text_field($_POST['apfcontents']);
	//$wadate =  sanitize_text_field($_POST['datetime24']);
	
	if(!isset($wadate)){
		$wadate = date('Y-m-d H:i:s');
	}
	
  $page =  array(
        'post_title'        => $title,
        'post_content'      => $post_url,
        'post_status'       => 'publish',
        'post_type' => 'wa_pns_messages', 
        'post_author'       => '1'
		);

        // Page doesn't exist, so lets add it
         $post_id = wp_insert_post( $page );


	  add_post_meta($post_id, '_wapn_message', 'no');
        
         
	$args = array( 'post_type' => 'wa_pns' );
	 $post_ids = get_posts(array(
        $args, //Your arguments
        'post_type'        => 'wa_pns',
        'posts_per_page'=> -1,
        'fields'        => 'ids', // Only get post IDs
    ));
    
    
	 $jsonTitles = json_encode($post_ids, false);
     
     add_post_meta($post_id, '_wapn_message_users', $jsonTitles);

	 add_post_meta($post_id, '_wapn_message_users_count', count($post_ids));
	
	}

}

/*  / ON SAVE SEND PUSH */

function wa_pn_save_meta($post_id, $post) {

	if(!isset($_POST['meta_noncename'])){$_POST['meta_noncename'] = '';}
	if ( !wp_verify_nonce( $_POST['meta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$json_meta['_wapn'] = sanitize_text_field($_POST['_wapn']);
	$json_meta['_wapn_sent'] = sanitize_text_field($_POST['_wapn_sent']);
	$json_meta['_wapn_key'] = sanitize_text_field($_POST['_wapn_key']);

	foreach ($json_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, sanitize_text_field($value) );
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, sanitize_text_field($value) );
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}


}



function wa_pn_message_save_meta($post_id, $post) {

	if(!isset($_POST['meta_noncename'])){$_POST['meta_noncename'] = '';}
	if ( !wp_verify_nonce( $_POST['meta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$json_meta['_wapn_message'] = sanitize_text_field($_POST['_wapn_message']);
	$json_meta['_wapn_message_users'] = sanitize_text_field($_POST['_wapn_message_users']);
	$json_meta['_wapn_message_users_count'] = sanitize_text_field($_POST['_wapn_message_users_count']);
	
	foreach ($json_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, sanitize_text_field($value) );
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, sanitize_text_field($value) );
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}


}

}//END

?>