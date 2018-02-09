<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" name="s" id="s" value="<?php _e('Search here..', 'wp-profile'); ?>" onfocus='if (this.value == "<?php _e('Search here..', 'wp-profile'); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e('Search here..', 'wp-profile'); ?>"; }' />
	<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-button.png" value="" id="search-button">
</form>