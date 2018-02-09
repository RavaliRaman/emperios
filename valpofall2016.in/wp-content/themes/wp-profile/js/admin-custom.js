jQuery(document).ready(function($) {
	
	// hide page is current about me option is not static page
	var current_option_selected = $( 'select[data-customize-setting-link="wp_profile_about_me_option"]' ).val();
	if( 'latest-posts' == current_option_selected ) {
		$("li#customize-control-wp_profile_about_me").css({'display':'none'});
	}
	
	$('select[data-customize-setting-link="wp_profile_about_me_option"]').live('change', function(){
			
		var profile_option = $(this).val();
		//console.log( profile_option );
		
		if( 'static-page' == profile_option ) {
			$("li#customize-control-wp_profile_about_me").css({'display':'block'});
		} else {
			$("li#customize-control-wp_profile_about_me").css({'display':'none'});
		}
		
	});
	
});