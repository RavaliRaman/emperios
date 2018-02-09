<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
<?php
if ( class_exists( 'WooCommerce' ) && is_woocommerce()){
	echo '</div><div id="secondary">';
	// Calling Sidebar
	if ( is_active_sidebar( 'wp_portfolio_sidebar' ) ) :
		dynamic_sidebar( 'wp_portfolio_sidebar' );
	endif;
	echo '</div>';
}elseif( !class_exists( 'WooCommerce' )){
	if ( is_active_sidebar( 'wp_portfolio_sidebar' ) ) :
		dynamic_sidebar( 'wp_portfolio_sidebar' );
	endif;
}elseif( class_exists( 'WooCommerce' ) && !is_woocommerce()){
	if ( is_active_sidebar( 'wp_portfolio_sidebar' ) ) :
		dynamic_sidebar( 'wp_portfolio_sidebar' );
	endif;
}
?>
