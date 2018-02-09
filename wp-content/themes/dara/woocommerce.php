<?php
/**
 * The default template for displaying WooCommerce pages.
 *
 * @package Dara
 */

get_header();
?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<div class="hero without-featured-image">
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		</div>
	<?php endif; ?>
		<div id="primary" class="content-area <?php echo esc_attr( dara_woocommerce_content_class() ); ?>">
			<main id="main" class="site-main" role="main">

				<?php
					if ( is_singular( 'product' ) ) {

						while ( have_posts() ) : the_post();
							wc_get_template_part( 'content', 'single-product' );
						endwhile;

					} else {

						do_action( 'woocommerce_archive_description' );

						if ( have_posts() ) {
							do_action('woocommerce_before_shop_loop');
							woocommerce_product_loop_start();
							woocommerce_product_subcategories();

							while ( have_posts() ) : the_post();
								wc_get_template_part( 'content', 'product' );
							endwhile;

							woocommerce_product_loop_end();
							do_action('woocommerce_after_shop_loop');

						} elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {

							wc_get_template( 'loop/no-products-found.php' );

						}

					}
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php
	if ( ! is_shop() && ! is_product_category() && ! is_product_tag() ) {
		get_sidebar();
	}
?>

<?php get_footer(); ?>
