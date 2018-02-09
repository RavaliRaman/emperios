<?php  include dirname( __FILE__ ) . '/inc/mobile-header.php'; ?>
		
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single-wordapp_mobile_pages' ); ?>

			
		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	

<?php  include dirname( __FILE__ ) . '/inc/mobile-footer.php'; ?>