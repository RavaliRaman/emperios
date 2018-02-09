<?php

/**
 * Initialize the admin settings
 *
 * @action admin_init
 */
function snapshot_settings_admin_init(){
	$settings = SiteOrigin_Settings::single();

	$settings->add_section( 'general', __('General', 'snapshot') );
	$settings->add_section( 'appearance', __('Appearance', 'snapshot') );
	$settings->add_section( 'posts', __('Posts', 'snapshot') );
	$settings->add_section( 'slider', __('Slider', 'snapshot') );
	$settings->add_section( 'social', __('Social', 'snapshot') );
	$settings->add_section( 'messages', __('Text', 'snapshot') );

	// General Stuff
	
	$settings->add_field('general', 'search', 'checkbox', __('Search in Menu', 'snapshot'), array(
		'description' => __('Display a search link in your menu that slides out a big beautiful search bar.', 'snapshot')
	));
	$settings->add_field('general', 'search_menu_text', 'text', __('Search Menu Text', 'snapshot'), array(
		'description' => __('The text that is displayed in the menu bar for the search.', 'snapshot')
	));
	$settings->add_field('general', 'latest_posts', 'text', __('Latest Posts Title', 'snapshot'));
	$settings->add_field('general', 'copyright', 'text', __('Copyright Message', 'snapshot'));

	$settings->add_teaser( 'general', 'attribution', 'checkbox', __( 'SiteOrigin Attribution', 'snapshot' ), array(
		'description' => __( "Hide SiteOrigin attribution in your footer.", 'snapshot' )
	) );

	// Appearance Stuff

	$settings->add_field('appearance', 'link', 'color', __('Link Color', 'snapshot'));
	
	$settings->add_field('appearance', 'style', 'select', __('Style', 'snapshot'), array(
		'options' => array(
			'light' => __('Light', 'snapshot'),
			'dark' => __('Dark', 'snapshot'),
		),
		'description' => __('Choose the style of your site.', 'snapshot'),
	));
	
	// Posts stuff
	
	$settings->add_field('posts', 'clickable_thumbnails', 'checkbox', __('Clickable Thumbnails', 'snapshot'), array(
		'description' => __('Make the entire post thumbnail clickable on the home page and post archive pages.', 'snapshot')
	));

	$settings->add_field('posts', 'sidebar_images', 'checkbox', __('Sidebar Images', 'snapshot'), array(
		'description' => __('Show or hide the post thumbnails down the right sidebar.', 'snapshot')
	));
	
	$settings->add_field('posts', 'video_autoplay', 'checkbox', __('Video: Autoplay', 'snapshot'), array(
		'description' => __('Automatically start playing post videos', 'snapshot'),
	));

	$settings->add_field('posts', 'video_hide_related', 'checkbox', __('Video: Hide Related', 'snapshot'), array(
		'description' => __('Hides related videos after YouTube videos stop playing.', 'snapshot'),
	));

	$settings->add_field('posts', 'video_default_hd', 'checkbox', __('Video: Default to HD', 'snapshot'), array(
		'description' => __('YouTube has depreciated forced HD embeds. Vimeo HD can be set within Vimeo itself..', 'snapshot'),
	));

	// The slider section
	
	$settings->add_field('slider', 'enabled', 'checkbox', __('Home Page Slider', 'snapshot'), array());
	$settings->add_field('slider', 'speed', 'number', __('Transition Delay', 'snapshot'), array(
		'description' => __('Number of milliseconds a photo is displayed for.', 'snapshot')
	));
	$settings->add_field('slider', 'transition', 'number', __('Transition Speed', 'snapshot'), array(
		'description' => __('How many milliseconds the transition takes.', 'snapshot'),
	));
	$settings->add_field('slider', 'post_count', 'number', __('Post Count', 'snapshot'), array(
		'description' => __('The number of posts displayed on your home page slider.', 'snapshot'),
	));

	$settings->add_field('slider', 'scale_height', 'checkbox', __('Scale Home Page Slider Height', 'snapshot'), array(
		'description' => __('Automatically scale the height of the home slider to match each image.', 'snapshot'),
	));
	
	$settings->add_field('slider', 'posts', 'select', __('Posts Order', 'snapshot'), array(
		'options' => array(
			'date' => __('Post Date', 'snapshot'),
			'modified' => __('Modified Date', 'snapshot'),
			'rand' => __('Random', 'snapshot'),
			'comment_count' => __('By Comment Count', 'snapshot'),
		),
		'description' => __('How Snapshot chooses your home page slides.', 'snapshot'),
	));

	$settings->add_field('slider', 'category', __('Posts Category', 'snapshot'), array(
		'options' => snapshot_settings_get_category_options(),
		'description' => __('Choose which posts are displayed on your home page slider.', 'snapshot')
	));

	// Social and sharing

	$settings->add_teaser( 'social', 'ajax', 'checkbox', __( 'Ajax Comments', 'snapshot' ), array(
		'description' => __( "Keep the conversation flowing with Ajax comments.", 'snapshot' )
	) );

	$settings->add_field('social', 'display_share', 'checkbox', __('Share Buttons', 'snapshot'), array(
		'label' => __('Show share buttons next to posts', 'snapshot')
	));
	$settings->add_field( 'social', 'twitter', 'text', __('Twitter Username', 'snapshot'), array('validator' => 'twitter') );
	$settings->add_field( 'social', 'recommend', 'checkbox', __('Recommend SiteOrigin', 'snapshot' ), array(
		'label' => __( 'Yes', 'snapshot' ),
		'description' => __( "Recommends your's and SiteOrigin's Twitter accounts after someone tweets your post.", 'snapshot' )
	));

	// Site messages
	
	$settings->add_field('messages', '404', 'textarea', __('Error 404 Message', 'snapshot'));
	$settings->add_field('messages', 'no_results', 'textarea', __('No Search Results', 'snapshot'));
}
add_action('siteorigin_settings_init', 'snapshot_settings_admin_init');

function snapshot_settings_get_category_options(){
	$category_options = array(
		0 => __('All', 'snapshot'),
	);
	$cats = get_categories();
	if(!empty($cats)){
		foreach(get_categories() as $cat){
			$category_options[$cat->term_id] = $cat->name;
		}
	}

	return $category_options;
}

/**
 * Set up the default settings
 * @param $defaults
 * @return array
 *
 * @filter siteorigin_theme_default_settings
 */
function snapshot_settings_default($defaults){
	$defaults['general_search'] = true;
	$defaults['general_search_menu_text'] = __('Search', 'snapshot');
	$defaults['general_latest_posts'] = __('Latest Posts', 'snapshot');
	$defaults['general_copyright'] = __('Copyright &copy; {sitename} {year}', 'snapshot');
	$defaults['general_attribution'] = false;

	$defaults['appearance_style'] = 'light';
	$defaults['appearance_link'] = '#dc5c3b';
	
	$defaults['posts_clickable_thumbnails'] = false;
	$defaults['posts_sidebar_images'] = true;
	$defaults['posts_video_autoplay'] = false;
	$defaults['posts_video_hide_related'] = false;
	$defaults['posts_video_default_hd'] = false;

	$defaults['slider_enabled'] = true;
	$defaults['slider_speed'] = 7500;
	$defaults['slider_transition'] = 500;
	$defaults['slider_post_count'] = 5;
	$defaults['slider_scale_height'] = false;
	$defaults['slider_posts'] = 'date';
	$defaults['slider_category'] = 'date';

	$defaults['social_ajax'] = true;
	$defaults['social_display_share'] = true;
	$defaults['social_recommend'] = false;
	$defaults['social_twitter'] = '';

	$defaults['messages_404'] = '';
	$defaults['messages_no_results'] = '';

	return $defaults;
}
add_filter('siteorigin_settings_defaults', 'snapshot_settings_default');

function snapshot_about_page_setup( $about ){
	$about[ 'description' ] = __( 'Snapshot is a beautiful theme for showing off your photography.', 'snapshot' );

	$about[ 'sections' ] = array(
		'free',
		'support',
		'page-builder',
		'github',
	);

	return $about;
}
add_filter( 'siteorigin_about_page', 'snapshot_about_page_setup' );