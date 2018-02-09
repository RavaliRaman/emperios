<?php
/**
 * Adds footer structures.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 * @license http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link http://themehorse.com/themes/wp-portfolio
 */
/****************************************************************************************/
add_action( 'wp_portfolio_footer', 'wp_portfolio_open_siteinfo_div', 20 );
/**
 * Opens the site generator div.
 */
function wp_portfolio_open_siteinfo_div() { ?>
	<div class="site-info clearfix">
<?php }
/****************************************************************************************/
add_action( 'wp_portfolio_footer', 'wp_portfolio_socialnetworks', 25 );
/**
 * This function for social links display on footer
 *
 */
function wp_portfolio_socialnetworks(){
	if ( has_nav_menu( 'social' ) ) : ?>
		<div class="social-profiles clearfix">
		<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' 	=> 'social',
						'container' 		=> '',
						'depth'          	=> 1,
						'items_wrap'      => '<ul>%3$s</ul>',
						'link_before'    	=> '<span class="screen-reader-text">',
						'link_after'     	=> '</span>',
					) );
				?>
		</div><!-- .social-profiles -->
	<?php endif;
}
/****************************************************************************************/
add_action( 'wp_portfolio_footer', 'wp_portfolio_footer_info', 30 );
/**
 * function to show the footer info, copyright information
 */
function wp_portfolio_footer_info() {      
	$output = '<div class="copyright">'.wp_portfolio_site_link().' ' .__( 'Copyright &copy;', 'wp-portfolio' ).' '.wp_portfolio_the_year().' ' . ' ' .wp_portfolio_themehorse_link().' | '.' ' .wp_portfolio_wp_link() .'</div><!-- .copyright -->';
	echo $output;
}
/****************************************************************************************/
add_action( 'wp_portfolio_footer', 'wp_portfolio_close_siteinfo_div', 40 );
/**
 * Shows the back to top icon to go to top.
 */
function wp_portfolio_close_siteinfo_div() { ?>
	</div><!-- .site-info -->
<?php }
/****************************************************************************************/
add_action( 'wp_portfolio_footer', 'wp_portfolio_backtotop_html', 45 );
/**
 * Shows the back to top icon to go to top.
 */
function wp_portfolio_backtotop_html() { ?>
	<div class="back-to-top"><a title="<?php _e('Go to Top', 'wp-portfolio');?>" href="#masthead"></a></div><!-- .back-to-top -->
<?php } ?>
