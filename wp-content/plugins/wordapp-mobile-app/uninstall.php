<?php
// If unistall not called from WordPress exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
// Delete option from options table
delete_option( 'PLUGIN_NAME_OPTIONS' );
delete_option( 'WordApp_options' );
delete_option( 'WordApp_menu' );
delete_option( 'WordApp_structure' );
delete_option( 'WordApp_slideshow' );
delete_option( 'WordApp_ga' );
delete_option( 'wordapp_firstVisit' );
delete_option( 'wordapp_firstCreation' );
delete_option( 'WordApp_pro' );

//wordapp_firstVisit
//wordapp_firstCreation
// Remove any additional options and custom tables.
?>