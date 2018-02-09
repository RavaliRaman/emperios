jQuery(document).ready(function($){
	if (jQuery('input[name="display_page_link"]').length) {
		if ( jQuery('input[name="display_page_link"]:checked').val() == 'oui' ) {
			jQuery('#link_page_id').removeClass('hidden');
		}
		jQuery('input[name="display_page_link"]').change(function() {
			if ( $(this).val() == 'oui' ) {
				jQuery('#link_page_id').removeClass('hidden');
			} else {
				jQuery('#link_page_id').addClass('hidden');
			}
		});
	}
});