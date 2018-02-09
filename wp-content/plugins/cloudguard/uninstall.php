<?php

// If uninstall not called from WordPress exit.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) || !WP_UNINSTALL_PLUGIN || dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) ) ) {
    status_header(404);
    exit;
}

//cloudguard_flush_htacess();

delete_option('cloudguard_options');
delete_option('cloudguard_blocked_attempts');
delete_option('cloudguard_nag');