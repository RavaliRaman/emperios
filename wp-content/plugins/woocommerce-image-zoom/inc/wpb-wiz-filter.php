<?php 

/**
 * Woocommerce Image Zoom
 * By WPbean
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Custom array unshift function 
 */

if( !function_exists('wpb_wiz_unshift') ){
	function wpb_wiz_unshift($array, $var) {
	  array_unshift($array, $var);
	  return $array;
	}
}


/**
 * Apply the modifired images area for Zoom plugin
 */


function wpb_wiz_apply_modified_images() {

	global $woocommerce;

	if ( $woocommerce->version >= '3.0' ){
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		add_action( 'woocommerce_before_single_product_summary', 'wpb_aiz_single_images', 20 );
	}else{
		add_filter( 'woocommerce_single_product_image_html', 'wpb_aiz_get_single_images' );
	}
}
add_action('template_redirect', 'wpb_wiz_apply_modified_images', 20);



/**
 * Get Modified images for zoom
 */

function wpb_aiz_get_single_images(){
	global $post, $woocommerce, $product;

	if( has_post_thumbnail() ){

		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title' 			=> $image_title,
			'data-zoom-image' 	=> $image_link,
			'class' 			=> 'wpb-wiz-main-image',
			) );

		if ( $woocommerce->version >= '3.0' ){
			$attachment_count = count( $product->get_gallery_image_ids() );
		}else{
			$attachment_count = count( $product->get_gallery_attachment_ids() );
		}

		if ( $attachment_count > 0 ) {
			$gallery = '[product-gallery]';
		} else {
			$gallery = '';
		}

		if ( $woocommerce->version >= '3.0' ){
			return sprintf( '<div class="images"><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>%s</div>', $image_link, $image_title, $image, wpb_wiz_product_gallery_images() );

		}else{
			return sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image );
		}
	
	} else {

		if ( $woocommerce->version >= '3.0' ){
			return sprintf( '<div class="images"><img src="%s" alt="%s" /></div>', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-image-zoom' ) );
		}else{
			return sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-image-zoom' ) );
		}

	}
}


/**
 * echo Get Modified images for zoom
 */

function wpb_aiz_single_images(){
	echo wpb_aiz_get_single_images();
}


/**
 * Product gallery images
 */

function wpb_wiz_product_gallery_images(){
	global $woocommerce, $product, $post;

	if ( $woocommerce->version >= '3.0' ){
		$attachments = $product->get_gallery_image_ids();
	}else{
		$attachments = $product->get_gallery_attachment_ids();
	}

	if ( $attachments ) {
		$loop 		= 0;
		$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	}

	$attachment_count = count( $attachments );

	if ( $attachment_count > 0 ){
		
		ob_start();
		?>
			<div id="wpb_wiz_gallery" class="thumbnails <?php echo esc_attr( 'columns-' . $columns ) ; ?>">

				<?php
					if( has_post_thumbnail( get_the_id() ) ):
					$product_feature_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				?>
				<a class="wpb-wiz-hidden" href="#" data-image="" data-zoom-image="<?php echo esc_url( $product_feature_img[0] ) ; ?>"></a> 
				<?php endif; ?>

				<?php 

		    		foreach ( $attachments as $attachment ) {

		    			$classes = array( 'wpb-woo-zoom' );
		    			$classes = apply_filters('wpb_wim_gallery_image_link_class', $classes);

						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = 'first';

						if ( ( $loop + 1 ) % $columns == 0 )
							$classes[] = 'last';

		    			$attachment_resized = wp_get_attachment_image_src( $attachment, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
		    			$attachment_full = wp_get_attachment_image_src( $attachment, 'full' );
		    			?>
		    				<a class="<?php echo esc_attr( implode( ' ', $classes ) ) ; ?>" href="#" data-image="<?php echo esc_url( $attachment_resized[0] ); ?>" data-zoom-image="<?php echo esc_url( $attachment_full[0] ) ; ?>"> 
		    					<img src="<?php echo esc_url( $attachment_resized[0] ); ?>" /> 
		    				</a> 
		    			<?php

		    			$loop++;
		    		}
			    ?>

			</div>
		<?php

		return ob_get_clean();
	}
}