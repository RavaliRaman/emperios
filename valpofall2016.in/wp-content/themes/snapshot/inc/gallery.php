<?php

/**
 * Intercept the gallery shortcode when type=slider
 * 
 * @param $contents
 * @param $attr
 * @return string
 */
function snapshot_slider_gallery($contents, $attr){
	if(empty($attr['type']) || $attr['type'] != 'slider') return $contents;

	global $post;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	/**
	 * @var $order
	 * @var $orderby
	 * @var $id
	 * @var $itemtag
	 * @var $icontag
	 * @var $captiontag
	 * @var $size
	 * @var $include
	 * @var $exclude
	 * @var $wp_default
	 * @var $target_blank
	 */
	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'include'    => '',
		'exclude'    => '',
		'wp_default'    => false,
		'target_blank' => false,
	), $attr));

	// This gallery has requested to use the WordPress default gallery
	if($wp_default) return $contents;

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}
	elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}
	else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) ) return '';
	
	global $snapshot_gallery_slider_attachments;
	$snapshot_gallery_slider_attachments = $attachments;
	
	ob_start();
	get_template_part('slider', 'gallery');
	$contents = ob_get_clean();
	return $contents;
}
add_filter('post_gallery', 'snapshot_slider_gallery', 10, 2);

/**
 * Add the type slider to the gallery widget.
 * @param $types
 * @return mixed
 */
function snapshot_slider_gallery_type($types){
	$types['slider'] = __('Slider', 'snapshot');
	return $types;
}
add_filter('siteorigin_gallery_types', 'snapshot_slider_gallery_type');

/**
 * Change the gallery widget default type to slider.
 * @return string
 */
function snapshot_slider_gallery_default_type(){
	return 'slider';
}
add_filter('siteorigin_gallery_default_type', 'snapshot_slider_gallery_default_type');