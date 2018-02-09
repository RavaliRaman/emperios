<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 	

class class_wcps_functions  {
	
	
    public function __construct(){

		}
		
		
		
	public function skins(){
		
		$skins = array(
		
						'flat'=> array(
										'slug'=>'flat',									
										'name'=>'Flat',
										'thumb_url'=>'',
										),		

						'zoomin'=>array(
										'slug'=>'zoomin',
										'name'=>'ZoomIn',
										'thumb_url'=>'',
										),							

						'spinleft'=>array(
										'slug'=>'spinleft',
										'name'=>'SpinLeft',
										'thumb_url'=>'',
										),

						'contentbottom'=>array(
										'slug'=>'contentbottom',
										'name'=>'ContentBottom',
										'thumb_url'=>'',
										),
																								
					
						
						);
		
		$skins = apply_filters('post_grid_filter_skins', $skins);	
		
		return $skins;
		
		}
		

		
	public function wcps_grid_items($grid_items = array()){
		
			$grid_items = array(
							'thumb'=>__('Thumbnail',wcps_textdomain),
							'title'=>__('Title',wcps_textdomain),
							'excerpt'=>__('Excerpt',wcps_textdomain),
							'category'=>__('Category',wcps_textdomain),
                            'tag'=>__('Tags',wcps_textdomain),
							'price'=>__('Price',wcps_textdomain),
							'rating'=>__('Rating',wcps_textdomain),
							'cart'=>__('Cart',wcps_textdomain),
							'sale'=>__('Sale',wcps_textdomain),
							'featured'=>__('Featured', wcps_textdomain),
                            'sku'=>__('SKU', wcps_textdomain),
							);
			return $grid_items;
		}		
		
		
		
		
		
		
		
	
}