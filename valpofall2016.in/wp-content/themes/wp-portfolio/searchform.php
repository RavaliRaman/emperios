<?php
/**
 * Displays the searchform of the theme.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form clearfix">
		<label class="assistive-text"> <?php _e( 'Search', 'wp-portfolio' ); ?> </label>
		<input type="search" placeholder="<?php esc_attr_e( 'Search', 'wp-portfolio' ); ?>" class="s field" name="s">
	</form><!-- .search-form -->
