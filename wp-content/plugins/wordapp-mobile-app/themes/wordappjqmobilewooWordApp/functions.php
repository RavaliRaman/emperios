<?php
// activate google fonts
function WordApp_add_google_fonts() {
	wp_register_style( 'googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300');
	wp_enqueue_style( 'googleFonts');
}
add_action( 'wp_enqueue_scripts', 'WordApp_add_google_fonts' );

// include for widgets
include( TEMPLATEPATH . '/includes/widgets.php' );

// register navigation menu
function WordApp_register_theme_menu() {
	register_nav_menu( 'primary', 'Main Navigation Menu' );
}
add_action( 'init', 'WordApp_register_theme_menu' );

// add theme support for featured images
function WordApp_theme_support() {
	add_theme_support( 'post-thumbnails' ); 
}
add_action( 'after_setup_theme', 'WordApp_theme_support' );


// colophon - activated via the WordApp_after_footer hook
if ( ! function_exists( 'WordApp_colophon' ) ) {
	function WordApp_colophon() { ?>
	

	<?php		
	}

}
add_action( 'WordApp_after_footer', 'WordApp_colophon' );

// woocommerce support
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function WordApp_theme_wrapper_start() {
  echo '<div class="main">';
}
add_action('woocommerce_before_main_content', 'WordApp_theme_wrapper_start', 10);

function WordApp_theme_wrapper_end() {
  echo '</div>';
}
add_action('woocommerce_after_main_content', 'WordApp_theme_wrapper_end', 10);

add_theme_support( 'woocommerce' );

// home page header
function WordApp_cat_image_links() {  }

function WordApp_main_shop_before_content() {
	if( is_shop() && !is_search() ) {
		WordApp_cat_image_links();
	}
}
add_action( 'woocommerce_before_main_content', 'WordApp_main_shop_before_content' );

// featured products in sidebar
function WordApp_sidebar_products() {
	
	// query arguments
	$args = array(
		'post_type' => 'product',
		'product_tag' => 'Featured',
	);
	
	// run the loop
	$query = new WP_query ( $args );
	if ( $query->have_posts() ) { ?>
		<aside class="featured-products">
			<h3>Featured Products</h3>
			
			<ul>
				<?php while ( $query->have_posts() ) : $query->the_post(); /* start the loop */ ?>
			 
				<li id="post-<?php the_ID(); ?>" <?php post_class( 'half left' ); ?>>
				
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail', array(
								'class' => 'left',
								'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt ))
							) ); ?>
						</a>
					<?php } ?>
					
					<a class="featured-product-text" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>
			 		 
				<?php endwhile; /* end the loop*/ ?>
		 	
			</ul>
				
		</aside>
		
		<?php rewind_posts(); ?>
	
	<?php }
	
}
add_action( 'WordApp_sidebar', 'WordApp_sidebar_products', 15 );

// category pages - image
function WordApp_product_cats_before_content() {
if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img src="' . $image . '" alt="' . trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )) . '" class="product-cat-image" />';
		}
	}
}
add_action( 'woocommerce_archive_description', 'WordApp_product_cats_before_content', 5 );

function woocommerce_template_loop_product_thumbnail() {

	if( is_product()) {
		echo woocommerce_get_product_thumbnail( 'thumbnail' );
	}
	else {
		echo woocommerce_get_product_thumbnail();		
	}
}

// checkout customization
function WordApp_checkout_text() { ?>
	<p>Thanks for shopping with us. Please complete your details below.</p>
<?php }
add_action( 'woocommerce_before_checkout_form', 'WordApp_checkout_text', 5 );
?>