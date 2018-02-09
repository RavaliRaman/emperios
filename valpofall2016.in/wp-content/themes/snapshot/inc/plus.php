<?php

function snapshot_plus_slider_query_args($args){
	// Add the category setting
	$cat = siteorigin_setting('slider_category');
	if(!empty($cat)){
		$args['cat'] = intval($cat);
	}

	// Add the order setting
	$args['orderby'] = siteorigin_setting('slider_posts');

	return $args;
}
add_filter('snapshot_slider_query_args', 'snapshot_plus_slider_query_args');

function snapshot_plus_search_bar(){
	get_template_part( 'tpl/searchbar' );
}

/**
 * Add the search button to the navigation menu
 *
 * @param $items
 * @param $args
 * @return string
 */
function snapshot_plus_wp_nav_menu_items($items, $args){
	if( siteorigin_setting('general_search') && $args->theme_location == 'main-menu' ){
		$items .= '<li id="main-menu-search"><a href="#">'.siteorigin_setting('general_search_menu_text').'</a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'snapshot_plus_wp_nav_menu_items', 10, 2);