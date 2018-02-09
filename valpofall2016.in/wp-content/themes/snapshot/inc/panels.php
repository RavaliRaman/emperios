<?php
/**
 * Integrates this theme with SiteOrigin panels page builder.
 */

/**
 * Adds default page layouts
 *
 * @param $layouts
 */
function snapshot_prebuilt_page_layouts($layouts){
	$layouts['home-page'] = array (
		'name' => __('Home Page', 'snapshot'),
		'widgets' =>
		array (
			0 =>
			array (
				'template' => 'loop-slider.php',
				'post_type' => 'post',
				'posts_per_page' => '5',
				'orderby' => 'rand',
				'order' => 'DESC',
				'sticky' => '',
				'additional' => '',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_PostLoop',
					'id' => '0',
					'grid' => '0',
					'cell' => '0',
				),
			),
			1 =>
			array (
				'headline' => __('Your Call To Action Text', 'snapshot'),
				'text' => __('Ask your visitor to do something','snapshot'),
				'button' => 'Action Text',
				'url' => '#',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_CTA',
					'id' => '1',
					'grid' => '0',
					'cell' => '0',
				),
			),
			2 =>
			array (
				'headline' => __('A Wonderful Title', 'snapshot'),
				'text' => 'Nam consectetur tellus sed lorem sagittis feugiat ut quis odio. Nulla porttitor sagittis massa, posuere posuere justo fringilla vel. Duis elit velit, venenatis a rutrum interdum, hendrerit at arcu. Maecenas luctus, libero porttitor rutrum elementum, lectus nunc tristique lacus, id vestibulum enim erat a tortor. Proin imperdiet erat venenatis justo molestie pretium. Aliquam ut justo felis. In a risus felis, non dapibus erat. Nulla quis sodales felis. Praesent pellentesque lectus adipiscing sem volutpat suscipit. Quisque lobortis sapien id erat posuere pulvinar. Vestibulum turpis magna, cursus quis bibendum ut, ullamcorper ut felis.',
				'url' => '',
				'icon' => '0',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_IconText',
					'id' => '2',
					'grid' => '1',
					'cell' => '0',
				),
			),
			3 =>
			array (
				'headline' => 'Another Title',
				'text' => 'Ut at sem dui. Maecenas leo sapien, imperdiet non condimentum sit amet, condimentum sed libero. Fusce quis velit felis. Nulla elementum fermentum nisl, quis fermentum erat feugiat eget. Cras odio eros, condimentum vehicula elementum at, placerat at elit. In hac habitasse platea dictumst. Duis mauris arcu, sagittis consequat posuere vitae, porttitor sodales nunc.',
				'url' => '',
				'icon' => '0',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_IconText',
					'id' => '3',
					'grid' => '1',
					'cell' => '1',
				),
			),
			4 =>
			array (
				'headline' => __('Final Headline','snapshot'),
				'text' => 'Cras et turpis erat, ac suscipit mi. Sed aliquet bibendum nulla eget malesuada. Donec tincidunt tempus mattis. Proin non urna at ligula venenatis elementum eget ac nisi. Phasellus vehicula malesuada arcu ut accumsan. Sed euismod, erat in cursus viverra, lectus ipsum laoreet orci, eget vulputate est dolor vel ante.',
				'url' => '',
				'icon' => '0',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_IconText',
					'id' => '4',
					'grid' => '1',
					'cell' => '2',
				),
			),
			5 =>
			array (
				'video' => 'http://vimeo.com/59561067',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_Video',
					'id' => '5',
					'grid' => '2',
					'cell' => '0',
				),
			),
			6 =>
			array (
				'button' => 'Video Action',
				'url' => '#',
				'align' => 'center',
				'info' =>
				array (
					'class' => 'SiteOrigin_Widgets_Button',
					'id' => '6',
					'grid' => '2',
					'cell' => '0',
				),
			),
			7 =>
			array (
				'title' => '',
				'text' => 'If you\'re using Snapshot Premium, a video should show up to the right of this text. You can easily change the video that shows up. Just edit this page, then edit the Embedded Video widget.

Nam consectetur tellus sed lorem sagittis feugiat ut quis odio. Nulla porttitor sagittis massa, posuere posuere justo fringilla vel. Duis elit velit, venenatis a rutrum interdum, hendrerit at arcu. Maecenas luctus, libero porttitor rutrum elementum, lectus nunc tristique lacus, id vestibulum enim erat a tortor. Proin imperdiet erat venenatis justo molestie pretium. Aliquam ut justo felis. In a risus felis, non dapibus erat. Nulla quis sodales felis. Praesent pellentesque lectus adipiscing sem volutpat suscipit. Quisque lobortis sapien id erat posuere pulvinar. Vestibulum turpis magna, cursus quis bibendum ut, ullamcorper ut felis.',
				'filter' => true,
				'info' =>
				array (
					'class' => 'WP_Widget_Text',
					'id' => '7',
					'grid' => '2',
					'cell' => '1',
				),
			),
		),
		'grids' =>
		array (
			0 =>
			array (
				'cells' => '1',
			),
			1 =>
			array (
				'cells' => '3',
			),
			2 =>
			array (
				'cells' => '2',
			),
		),
		'grid_cells' =>
		array (
			0 =>
			array (
				'weight' => '1',
				'grid' => '0',
			),
			1 =>
			array (
				'weight' => '0.3333333333333333',
				'grid' => '1',
			),
			2 =>
			array (
				'weight' => '0.3333333333333333',
				'grid' => '1',
			),
			3 =>
			array (
				'weight' => '0.3333333333333333',
				'grid' => '1',
			),
			4 =>
			array (
				'weight' => '0.5',
				'grid' => '2',
			),
			5 =>
			array (
				'weight' => '0.5',
				'grid' => '2',
			),
		),
	);

	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'snapshot_prebuilt_page_layouts');

function snapshot_panels_settings($settings){
	$settings['home-page'] = true;
	$settings['responsive'] = true;
	$settings['margin-bottom'] = 30;
	$settings['margin-sides'] = 30;

	return $settings;
}
add_filter('sitesiteorigin_panels_settings', 'snapshot_panels_settings');