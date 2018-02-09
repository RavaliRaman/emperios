<?php
/**
 * Declare WooCommerce support.
 */
function dara_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'dara_woocommerce_support' );

/**
 * Change a class on the content area.
 */
function dara_woocommerce_content_class() {

	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$additional_class = 'full-width';
	} else {
		$additional_class = 'normal-width';
	}

	return $additional_class;
}
