<?php
class WordAppClass_cron   {

	/* Registering the Widgets */
	public function __construct() {
		add_filter('cron_schedules', array($this, 'wa_cron_schedules'));

	}

	function wa_cron_schedules($schedules){
		if(!isset($schedules["2min"])){
			$schedules["2min"] = array(
				'interval' => 2*60,
				'display' => __('Once every 2 minutes'));
		}
		if(!isset($schedules["5min"])){
			$schedules["5min"] = array(
				'interval' => 5*60,
				'display' => __('Once every 5 minutes'));
		}
		if(!isset($schedules["30min"])){
			$schedules["30min"] = array(
				'interval' => 30*60,
				'display' => __('Once every 30 minutes'));
		}
		if(!isset($schedules["10min"])){
			$schedules["10min"] = array(
				'interval' => 10*60,
				'display' => __('Once every 10 minutes'));
		}
		if(!isset($schedules["20min"])){
			$schedules["20min"] = array(
				'interval' => 20*60,
				'display' => __('Once every 20 minutes'));
		}
		return $schedules;
	}


	function wordapp_task_function() {
		
		$varGA = (array)get_option( 'WordApp_ga' );
settings_fields( 'WordApp_main_ga' );
if(!isset($varGA['apiDomain'])) $varGA['apiDomain'] ='';
if(!isset($varGA['ioscert'])) $varGA['ioscert'] ='';
if(!isset($varGA['pushLimit'])) $varGA['pushLimit'] ='';


if(!isset($varGA['apiDomain'])) $varGA['apiDomain'] ='';

if (!isset($varStructure['fullappname'])) {
		$varStructure['fullappname'] = $varGA['apiDomain'];
	}
	
	
$pushName = $varStructure['fullappname'];


		$q2 = get_posts(array(
				'post_type' => 'wa_pns_messages',
				'posts_per_page' => '20',
				'meta_query' => array(
					array(
						'key' => '_wapn_message',
						'value' => 'no',
						'compare' => 'LIKE'
					)
				)
			));
			
			
			
		$post_ids = array();
		foreach( $q2 as $item ) {
			
		
			
			$post_id = $item->ID;
			$message =  base64_encode($item->post_title);
			$post_meta = get_post_meta( $item->ID, '_wapn_message_users',true);
			
			
			$users = json_decode($post_meta,true);
			$url = 'http://c-m-s.mobi/androidPush.php';
			$u = 0;
			foreach ($users as $value) {
				
				
				array_splice($users, array_search($value, $users ), 1);
				
				$uuid = get_the_title( $value );
				$device_type = get_post_meta( $value, '_wapn',true);
				$device_key = get_post_meta( $value, '_wapn_key',true);
				
				 $response = wp_remote_post(
            $url,
            array(
                'body' => array(
                    'regid'   => $uuid,
                    'message'     => $message,
                    'type'     => $device_type,
                    'key'     => $device_key,
                    'appID'     => $pushName,
                    'user_URL'    => base64_encode(get_site_url()),
                    'ioscert'     => $varGA['ioscert']
                )
            )
        );
			

if ( is_wp_error( $response ) ) {
	//error_log( 'No longer registered' );
				
} else {
	//error_log( 'http://c-m-s.mobi/androidPush.php?regid='.$uuid.'&message=' . base64_encode($item->post_title) );
	
}

$u++;

if($u == $varGA['pushLimit']){	
break;
}	
			
} // END OF FOR EACH
			
			$users = json_encode($users);
			update_post_meta($item->ID, '_wapn_message_users', $users);		
			
			if($users == '[]'){
				update_post_meta($item->ID, '_wapn_message', 'yes');	
			}

		}


		// wp_mail( 'dave@app-developers.biz', 'Automatic email', 'Automatic scheduled email from WordPress.');
	}

}//END

?>