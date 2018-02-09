<?php

class WordAppClass_themes  {

	/*--  JSON RETURN --*/
	public function __construct() {
		$wordapp_themes = true;
	}



	public function wordapp_customizer_text( $translated_text ) {
		switch ( $translated_text ) {
		case 'Save &amp; Publish':
			return __( 'Save App Design', 'wordapp-mobile-app' );
		case 'You are previewing %s':
			$notice = '<p>'. __( 'You are previewing the app-only theme: ', 'wordapp-mobile-app' ) .'</p>';
			// This is the theme title, do not remove
			$notice .= '<p>%s</p>';
			// Fair Warning on non-app-theme settings
			$notice .= sprintf( '<span class="file-error">%s</span> ', __( 'WARNING:', 'wordapp-mobile-app' ) );
			$notice .= sprintf( __( 'Settings with an asterisk (%s) are not specific to the app-only theme, and will effect your desktop theme.', 'wordapp-mobile-app' ), '<span class="file-error">*</span>' );
			$notice = sprintf( '<p>%s</p>', $notice );
			return $notice;
		}
		return $translated_text;
	}


	/*--  JSON RETURN --*/
	function WordAppClass_themes() {


		return true;
	}


	function wordapp_wp_download_theme() {

		return true;
	}
	/*--  /JSON RETURN-- */
}
