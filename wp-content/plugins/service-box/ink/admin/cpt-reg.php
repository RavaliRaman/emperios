<?php
 if ( ! defined( 'ABSPATH' ) ) exit;
$labels = array(
				'name'                => _x( 'Service Box', 'Service Box', wpshopmart_service_box_text_domain ),
				'singular_name'       => _x( 'Service Box', 'Service Box', wpshopmart_service_box_text_domain ),
				'menu_name'           => __( 'Service Box', wpshopmart_service_box_text_domain ),
				'parent_item_colon'   => __( 'Parent Item:', wpshopmart_service_box_text_domain ),
				'all_items'           => __( 'All Service Box', wpshopmart_service_box_text_domain ),
				'view_item'           => __( 'View Service Box', wpshopmart_service_box_text_domain ),
				'add_new_item'        => __( 'Add New Service Box', wpshopmart_service_box_text_domain ),
				'add_new'             => __( 'Add New Service Box', wpshopmart_service_box_text_domain ),
				'edit_item'           => __( 'Edit Service Box', wpshopmart_service_box_text_domain ),
				'update_item'         => __( 'Update Service Box', wpshopmart_service_box_text_domain ),
				'search_items'        => __( 'Search Service Box', wpshopmart_service_box_text_domain ),
				'not_found'           => __( 'No Service Box Found', wpshopmart_service_box_text_domain ),
				'not_found_in_trash'  => __( 'No Service Box found in Trash', wpshopmart_service_box_text_domain ),
			);
			$args = array(
				'label'               => __( 'Service Box Panels', wpshopmart_service_box_text_domain ),
				'description'         => __( 'Service Box Panels', wpshopmart_service_box_text_domain ),
				'labels'              => $labels,
				'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', '', ),
				//'taxonomies'          => array( 'category', 'post_tag' ),
				 'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-admin-tools',
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
			);
			register_post_type( 'wpsm_servicebox_r', $args );
			
 ?>