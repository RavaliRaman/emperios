<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_shortcode( 'WPSM_SERVICEBOX', 'WPSM_SERVICEBOX_ShortCode' );
function WPSM_SERVICEBOX_ShortCode( $Id ) {
	ob_start();	
	if(!isset($Id['id'])) 
	 {
		$WPSM_SERVICE_ID = "";
	 } 
	else 
	{
		$WPSM_SERVICE_ID = $Id['id'];
	}
	require("content.php"); 
	wp_reset_query();
    return ob_get_clean();
}
?>