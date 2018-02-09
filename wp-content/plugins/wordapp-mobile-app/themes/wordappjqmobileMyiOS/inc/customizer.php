<?php
/**
 * AppBuilder2016 Theme Customizer.
 *
 * @package AppBuilder2016
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wordappjqmobile_customize_register( $wp_customize ) {
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	/*
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor2' )->transport = 'postMessage';
	*/

$wp_customize->add_section( 'title_tagline', array(
     'title'    => __( 'App Title & Names2' ),
     'priority' => 0,
) );
	
$wp_customize->add_section( 'nav_menus', array(
     'title'    => __( 'Nav' ),
     'priority' => 10,
) );
	$wp_customize->remove_control('site_icon');
	$wp_customize->remove_control('blogdescription');
	
	//$wp_customize->remove_section('title_tagline');
	
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('static_front_page');
	
}
add_action( 'customize_register', 'wordappjqmobile_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wordappjqmobile_customize_preview_js() {
	wp_enqueue_script( 'wordappjqmobile_customizer', get_template_directory_uri() . '/js/customizer.js?'.date('Ymdhsi'), array( 'customize-preview' ), '20130508', true );

}
add_action( 'customize_preview_init', 'wordappjqmobile_customize_preview_js' );





function wordappjqmobile_customize_registered($wp_customize){
    	
	
	
	  //  =============================
    //  = Menus               =
    //  =============================
	
	$menus = wp_get_nav_menus();
	$menuArray = array();
	foreach ( $menus as $menu ){
		
		$menuArray[$menu->term_id] = $menu->name;
	}
	
	 $wp_customize->add_section('WordApp_main_menu', array(
        'title'    => __('App Menuss', 'wordappjqmobile'),
        'description' => '',
        'priority' => 2,
    ));
	
	
	
	$wp_customize->add_setting('WordApp_menu[side]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
	$wp_customize->add_control(
	'WordAppMenuOnOff', 
	array(
		'label'    => __( 'Side Menu :', 'wordappjqmobile' ),
		'section'  => 'WordApp_main_menu',
		'settings' => 'WordApp_menu[side]',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'on',
			'' => 'off',
		),
	)
);
	
	 $wp_customize->add_setting('WordApp_menu[menu]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));

	
    $wp_customize->add_control('WordAppMenu', array(
        'label'      => __('', 'wordappjqmobile'),
        'section'    => 'WordApp_main_menu',
        'settings'   => 'WordApp_menu[menu]',
				'type'    => 'select',
				'choices' => $menuArray
    ));
	
	
	
	
	/* Top */
	
	
	$wp_customize->add_setting('WordApp_menu[top]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
	$wp_customize->add_control(
	'WordAppMenuTopOnOff', 
	array(
		'label'    => __( 'Top Menu :', 'wordappjqmobile' ),
		'section'  => 'WordApp_main_menu',
		'settings' => 'WordApp_menu[top]',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'on',
			'' => 'off',
		),
	)
);
	
	 $wp_customize->add_setting('WordApp_menu[menuTop]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));

	
    $wp_customize->add_control('WordAppMenuTop', array(
        'label'      => __('', 'wordappjqmobile'),
        'section'    => 'WordApp_main_menu',
        'settings'   => 'WordApp_menu[menuTop]',
				'type'    => 'select',
				'choices' => $menuArray
    ));
	
	
	
	/**/
	
	
	$wp_customize->add_setting('WordApp_menu[bottom]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
	$wp_customize->add_control(
	'WordAppMenuBottomOnOff', 
	array(
		'label'    => __( 'Bottom Menu :', 'wordappjqmobile' ),
		'section'  => 'WordApp_main_menu',
		'settings' => 'WordApp_menu[bottom]',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'on',
			'' => 'off',
		),
	)
);
	
	 $wp_customize->add_setting('WordApp_menu[menuBottom]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));

	
    $wp_customize->add_control('WordAppMenuBottom', array(
        'label'      => __('', 'wordappjqmobile'),
			  'description' => __('The bottom menu comes with icons which can be added or changed on the WordApp plugin <a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Preview Icons</a>','wordappjqmobile'),
        'section'    => 'WordApp_main_menu',
        'settings'   => 'WordApp_menu[menuBottom]',
				'type'    => 'select',
				'choices' => $menuArray
    ));
	
	
		  //  =============================
    //  = Design               =
    //  =============================
	
    $wp_customize->add_section('WordApp_main', array(
        'title'    => __('Design settings', 'wordappjqmobile'),
        'description' => '',
        'priority' => 1,
    ));
 
	
	
		
    $wp_customize->add_setting('WordApp_options[Color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Color', array(
        'label'    => __('App Toolbar Color', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[Color]',
    )));
	
	
    $wp_customize->add_setting('WordApp_options[ColorText]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'ColorText', array(
        'label'    => __('App header font & icon color', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[ColorText]',
    )));
	
	
	
	  $wp_customize->add_setting('WordApp_options[logo]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Header logo', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[logo]',
    )));
	
	
	
	  $wp_customize->add_setting('WordApp_options[background]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
	
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'WordApp_options[background]', array(
        'label'    => __('App Background', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[background]',
    )));
	
	
	
	
    $wp_customize->add_setting('WordApp_options[backgroundColor]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
	
	 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'backgroundColor', array(
        'label'    => __('Background Color', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[backgroundColor]',
    )));
	
	
	
	
	
	
    $wp_customize->add_setting('WordApp_options[backgroundColorSideBars]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
	
	 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'backgroundColorSideBars', array(
        'label'    => __('Background Color (Side Bars)', 'wordappjqmobile'),
        'section'  => 'WordApp_main',
        'settings' => 'WordApp_options[backgroundColorSideBars]',
    )));
	
	/*
    $wp_customize->add_section('WordApp_main_ga', array(
        'title'    => __('Color Scheme', 'wordappjqmobile'),
        'description' => '',
        'priority' => 120,
    ));
 
	
	
    $wp_customize->add_section('WordApp_main_menu', array(
        'title'    => __('App Menus', 'wordappjqmobile'),
        'description' => '',
        'priority' => 120,
    ));
	
    $wp_customize->add_section('WordApp_main_structure', array(
        'title'    => __('Color Scheme', 'wordappjqmobile'),
        'description' => '',
        'priority' => 120,
    ));
	
	
    $wp_customize->add_section('WordApp_main_structure', array(
        'title'    => __('Color Scheme', 'wordappjqmobile'),
        'description' => '',
        'priority' => 120,
    ));
	
	
	*/
	
	/*
 
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('WordApp_options[background]', array(
        'default'        => 'Arse!',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('WordApp_options[background]', array(
        'label'      => __('Text Test', 'themename'),
        'section'    => 'WordApp_main',
        'settings'   => 'WordApp_options[background]',
    ));
		
		*/
 
    //  =============================
    //  = Radio Input               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[color_scheme]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('themename_color_scheme', array(
        'label'      => __('Color Scheme', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'themename_theme_options[color_scheme]',
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
 
    //  =============================
    //  = Checkbox                  =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[checkbox_test]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
 
    $wp_customize->add_control('display_header_text', array(
        'settings' => 'themename_theme_options[checkbox_test]',
        'label'    => __('Display Header Text'),
        'section'  => 'themename_color_scheme',
        'type'     => 'checkbox',
    ));
 
 
    //  =============================
    //  = Select Box                =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[header_select]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'themename_theme_options[header_select]',
        'label'   => 'Select Something:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
 
 
    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test]', array(
        'default'           => 'image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'label'    => __('Image Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[image_upload_test]',
    )));
 
    //  =============================
    //  = File Upload               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[upload_test]', array(
        'default'           => 'arse',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
        'label'    => __('Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[upload_test]',
    )));
 
 
    //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[link_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[link_color]',
    )));
 
 
    //  =============================
    //  = Page Dropdown             =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[page_test]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('themename_page_test', array(
        'label'      => __('Page Test', 'themename'),
        'section'    => 'themename_color_scheme',
        'type'    => 'dropdown-pages',
        'settings'   => 'themename_theme_options[page_test]',
    ));

    // =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
 
	$wp_customize->add_setting('_s_f_slide_cat', array(
		'default'        => $default
	));
	$wp_customize->add_control( 'cat_select_box', array(
		'settings' => '_s_f_slide_cat',
		'label'   => 'Select Category:',
		'section'  => '_s_f_home_slider',
		'type'    => 'select',
		'choices' => $cats,
	));
}
 
add_action('customize_register', 'wordappjqmobile_customize_registered');
