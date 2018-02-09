<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
/****************************************************************************************/
add_action('widgets_init', 'wp_portfolio_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function wp_portfolio_widgets_init()
{
	// Registering sidebar
	register_sidebar(array(
		'name' => __('Sidebar', 'wp-portfolio') ,
		'id' => 'wp_portfolio_sidebar',
		'description' => __('Shows widgets at Sidebar.', 'wp-portfolio') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
} ?>