<?php
/**
 * Displays the footer section of the theme.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
			<?php
			/**
			 * wp_portfolio_before_footer hook
			 */
			do_action('wp_portfolio_before_footer');
			?>
			<footer id="colophon" class="site-footer clearfix" role="contentinfo">
				<?php
				/**
				 * wp_portfolio_footer hook
				 *
				 * HOOKED_FUNCTION_NAME PRIORITY
				 * wp_portfolio_open_siteinfo_div 20
				 * wp_portfolio_socialnetworks 25
				 * wp_portfolio_footer_info 30
				 * wp_portfolio_close_siteinfo_div 40
				 * wp_portfolio_backtotop_html 45
				 */
				do_action('wp_portfolio_footer');
				?>
			</footer><!-- #colophon -->
		</div><!-- #page -->
		<?php
		/**
		 * wp_portfolio_after hook
		 */
		do_action('wp_portfolio_after');
		wp_footer(); ?>
	</body>
</html>