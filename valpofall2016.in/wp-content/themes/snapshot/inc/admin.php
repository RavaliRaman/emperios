<?php

if(!function_exists('snapshot_attachment_fields_to_edit')):
	/**
	 * Add the sidebar exclude field
	 * @param $fields
	 * @param $post
	 * @return array
	 *
	 * @filter attachment_fields_to_edit
	 */
	function snapshot_attachment_fields_to_edit($fields, $post){
		if(empty($post)) return $fields;
		$parent = get_post($post->post_parent);
		if(!empty($parent) && $parent->post_type == 'post'){
			$exclude = get_post_meta($post->ID, 'sidebar_exclude', true);
			$fields['snapshot_exclude'] = array(
				'label' => __('Sidebar Exclude', 'snapshot'),
				'input' => 'html',
				'html' => '<input name="attachments['.$post->ID.'][sidebar_exclude]" id="attachment-'.$post->ID.'-sidebar_exclude" type="checkbox" '.checked(!empty($exclude), true, false).' /> <label for="attachment-'.$post->ID.'-sidebar_exclude">'.__('Exclude', 'snapshot').'</label>',
				'value' => !empty($exclude)
			);
		}

		return $fields;
	}
endif;
add_filter('attachment_fields_to_edit', 'snapshot_attachment_fields_to_edit', 10, 2);


if(!function_exists('snapshot_attachment_save')):
	/**
	 * Save the attachment form meta.
	 * @param $post
	 * @return mixed
	 *
	 * @filter attachment_fields_to_save
	 */
	function snapshot_attachment_save($post){
		$parent = get_post($post['post_parent']);
		if(!empty($parent) && $parent->post_type == 'post' && !empty($_POST['attachments'][$post['ID']])){
			$current = get_post_meta($post['ID'], 'sidebar_exclude', true);
			$exclude = !empty($_POST['attachments'][$post['ID']]['sidebar_exclude']);
			update_post_meta($post['ID'], 'sidebar_exclude', $exclude, $current);
		}

		return $post;
	}
endif;
add_filter('attachment_fields_to_save', 'snapshot_attachment_save', 10);


if(!function_exists('snapshot_add_meta_boxes')):
/**
 * Add the relevant metaboxes.
 *
 * @action add_meta_boxes
 */
function snapshot_add_meta_boxes(){
	if( function_exists('snapshot_plus_meta_box_video_render') ) {
		add_meta_box( 'snapshot-post-video', __( 'Post Video', 'snapshot' ), 'snapshot_meta_box_render', 'post', 'side', 'default', 'video' );
	}
	add_meta_box('snapshot-post-image', __('Post Image', 'snapshot'), 'snapshot_meta_box_render', 'post', 'side', 'default', 'image');
}
endif;
add_action('add_meta_boxes', 'snapshot_add_meta_boxes');


if(!function_exists('snapshot_meta_box_video_render')) :
/**
 * Render the video meta box added in snapshot_add_meta_boxes
 */
function snapshot_meta_box_render($post, $metabox){
	switch($metabox['args']){
		case 'video' :
			if( function_exists('snapshot_plus_meta_box_video_render') ) {
				snapshot_plus_meta_box_video_render();
			}
			break;
		case 'image' :
			get_template_part('tpl/metabox', 'video');
			break;
	}
}
endif;

if(!function_exists('snapshot_save_post')):
function snapshot_save_post($post_id, $post){
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !current_user_can('edit_post', $post_id) ) return;
	if ( empty($_POST['_snapshot_nonce']) || !wp_verify_nonce($_POST['_snapshot_nonce'], 'save') )return;
	
	$image = array_map('stripslashes', $_POST['snapshot_post_image']);
	update_post_meta($post_id, 'snapshot_post_image', $image);
}
endif;
add_action('save_post', 'snapshot_save_post', 10, 2);