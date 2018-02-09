<?php
/**
 * Displays the header section of the theme.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset');?>" />
	<?php
	/**
	 * wp_portfolio_view_port hook
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 *
	 */
	do_action('wp_portfolio_view_port'); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
	<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<?php
				/**
				 * wp_portfolio_header hook
				 *
				 * HOOKED_FUNCTION_NAME PRIORITY
				 *
				 * wp_portfolio_headercontent_details 10
				 */
				do_action('wp_portfolio_header');
			?>