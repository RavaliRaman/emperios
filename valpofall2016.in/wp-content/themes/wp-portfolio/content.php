<?php
/**
 * This file displays content
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
	<?php
	/**
	 * wp_portfolio_before_primary
	 */
	do_action('wp_portfolio_before_primary');
	?>
	<div id="primary">
	<?php
	/**
	 * wp_portfolio_before_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * wp_portfolio_loop_before 10
	 */
	do_action('wp_portfolio_before_loop_content');
	/**
	 * wp_portfolio_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * wp_portfolio_theloop 10
	 */
	do_action('wp_portfolio_loop_content');
	/**
	 * wp_portfolio_after_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * wp_portfolio_next_previous 5
	 * wp_portfolio_loop_after 10
	 */
	do_action('wp_portfolio_after_loop_content');
	?>
	</div><!-- #primary -->
	<?php if ( class_exists( 'WooCommerce' ) && is_woocommerce()){

		}else{ ?>
	</div><!-- #content -->
	<?php }
	/**
	 * wp_portfolio_after_primary
	 */
	do_action('wp_portfolio_after_primary');
	?>
	<div id="secondary">
	  <?php get_sidebar(); ?>
	</div><!-- #secondary -->