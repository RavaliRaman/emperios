<?php
/**
 * Displays the 404 error page of the theme.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
<?php get_header(); ?>
	<div id="primary">
		<div id="main">
			<div class="entry-main">
				<div class="entry-content">
					<header class="entry-header">
						<h1 class="entry-title">
							<?php _e('Error 404-Page NOT Found', 'wp-portfolio'); ?>
						</h1>
					</header>
					<p>
						<?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wp-portfolio'); ?>
					</p>
					<h3>
						<?php _e('This might be because:', 'wp-portfolio'); ?>
					</h3>
					<p>
						<?php _e('You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'wp-portfolio'); ?>
					</p>
					<h3>
						<?php _e('Please try the following instead:', 'wp-portfolio'); ?>
					</h3>
					<p>
						<?php _e('Check for a mis-typed URL error, then press the refresh button on your browser.', 'wp-portfolio'); ?>
					</p>
				</div> <!-- .entry-content --> 
			</div><!-- .entry-main -->
		</div><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php	get_footer(); ?>