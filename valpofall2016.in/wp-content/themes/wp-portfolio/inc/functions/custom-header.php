<?php
/**
 * Implements a custom header for portfolio.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
add_action( 'after_setup_theme', 'wp_portfolio_custom_header_setup' );
/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses wp_portfolio_admin_header_style() to style wp-admin form.
 * @uses wp_portfolio_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since WP_Portfolio 1.0
 */
function wp_portfolio_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '',
		'default-image'          => '',
		// Set height and width, with a maximum value for the width.
		'height'                 => apply_filters( 'wp_portfolio_header_image_height', 300 ),
		'width'                  => apply_filters( 'wp_portfolio_header_image_width', 1170 ),
		'max-width'              => 2000,		// for backend custom header
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
		// Random image rotation off by default.
		'random-default'         => false,
		// No Header Text Feature
		'header-text'				 => false,
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => '',
		'admin-head-callback'    => 'wp_portfolio_admin_header_style',
		'admin-preview-callback' => 'wp_portfolio_admin_header_image',
	);
	add_theme_support( 'custom-header', $args );
}
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since WP_Portfolio 1.0
 */
function wp_portfolio_admin_header_style() { ?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg img {
			max-width: <?php echo get_theme_support( 'custom-header', 'max-width' );
		?>px;
		}
	</style>
	<?php
}
/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since WP_Portfolio 1.0
 */
function wp_portfolio_admin_header_image() { ?>
	<div id="headimg">
		<?php $wp_portfolio_header_image = get_header_image();
			if ( ! empty( $wp_portfolio_header_image ) ) : ?>
				<img src="<?php echo esc_url( $wp_portfolio_header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
	<?php endif; ?>
	</div>
<?php 
} ?>
