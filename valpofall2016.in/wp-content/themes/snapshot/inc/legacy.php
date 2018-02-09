<?php

function snapshot_add_legacy_settings_page(){
	add_theme_page(
		__( 'Theme Settings', 'snapshot' ),
		__( 'Theme Settings', 'snapshot' ),
		'manage_options',
		'snapshot-legacy-settings',
		'snapshot_legacy_settings_page'
	);
}
add_action( 'admin_menu', 'snapshot_add_legacy_settings_page' );

function snapshot_legacy_settings_page(){
	?>
	<div class="wrap">
		<h2><?php _e( 'Snapshot Settings Have Moved', 'snapshot' ) ?></h2>
		<p>
			<?php _e( 'Our theme settings now take advantage of the WordPress customizer.', 'snapshot' ); ?>
			<?php _e( 'Navigate to <strong>Appearance > Customize > Theme Settings</strong> to access theme settings.', 'snapshot' ); ?>
		</p>
	</div>
	<?php
}

if( !function_exists( 'siteorigin_settings_add_field' ) ) {
	function siteorigin_settings_add_field( $section, $id, $type, $label = null, $args = array(), $after = false ){
		SiteOrigin_Settings::single()->add_field( $section, $id, $type, $label, $args, $after);
	}
}

if( !function_exists( 'siteorigin_settings_add_section' ) ) {
	function siteorigin_settings_add_section( $id, $title, $after = false ){
		SiteOrigin_Settings::single()->add_section( $id, $title, $after );
	}
}