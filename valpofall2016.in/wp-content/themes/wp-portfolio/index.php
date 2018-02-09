<?php
/**
 * Displays the index section of the theme.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
<?php get_header(); ?>
	<?php
		/** 
		 * wp_portfolio_before_main_container hook
		 */
		do_action( 'wp_portfolio_before_main_container' );
		/** 
		 * wp_portfolio_main_container hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * wp_portfolio_content 10
		 */
		do_action( 'wp_portfolio_main_container' );
		/** 
		 * wp_portfolio_after_main_container hook
		 */
		do_action( 'wp_portfolio_after_main_container' );
	?>
<?php get_footer(); ?>
