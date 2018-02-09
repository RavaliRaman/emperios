<?php 
/**
 * WP_Portfolio Theme Customizer support
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 */
?>
<?php
/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since WP_Portfolio 1.0
 *
 */
function wp_portfolio_textarea_register($wp_customize){
	class WP_Portfolio_Customize_WP_Portfolio_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
			<a title="<?php esc_attr_e( 'Donate', 'wp-portfolio' ); ?>" href="<?php echo esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=BRLCCUGP2ACYN' ); ?>" target="_blank">
			<?php _e( 'Donate', 'wp-portfolio' ); ?>
			</a>
			<a title="<?php esc_attr_e( 'Review WP Portfolio', 'wp-portfolio' ); ?>" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/wp-portfolio' ); ?>" target="_blank">
			<?php _e( 'Rate WP Portfolio', 'wp-portfolio' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/theme-instruction/wp-portfolio/' ); ?>" title="<?php esc_attr_e( 'WP Portfolio Theme Instructions', 'wp-portfolio' ); ?>" target="_blank">
			<?php _e( 'Theme Instructions', 'wp-portfolio' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'wp-portfolio' ); ?>" target="_blank">
			<?php _e( 'Support Forum', 'wp-portfolio' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/preview/wp-portfolio/' ); ?>" title="<?php esc_attr_e( 'WP Portfolio Demo', 'wp-portfolio' ); ?>" target="_blank">
			<?php _e( 'View Demo', 'wp-portfolio' ); ?>
			</a>
		<?php
		}
	}
	class WP_Portfolio_Customize_Category_Control extends WP_Customize_Control {
		/**
		* The type of customize control being rendered.
		*/
		public $type = 'multiple-select';
		/**
		* Displays the multiple select on the customize screen.
		*/
		public function render_content() {
		global $options, $array_of_default_settings;
		$options = wp_parse_args(  get_option( 'wp_portfolio_theme_options', array() ),  wp_portfolio_get_option_defaults());
		$categories = get_categories(); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
				<?php
					foreach ( $categories as $category) :?>
						<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options[ 'wp_portfolio_categories' ]) ) { echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		<?php 
		}
	}
}

function wp_portfolio_customize_register($wp_customize){
	$wp_customize->add_panel( 'wp_portfolio_theme_options', array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'title'          => __('WP Portfolio Theme Options', 'wp-portfolio')
	));
/********************WP_Portfolio Upgrade ******************************************/
	$wp_customize->add_section('wp_portfolio_upgrade', array(
		'title'					=> __('WP Portfolio Support', 'wp-portfolio'),
		'description'			=> __('Hey! Buy us a beer and we shall come with new features and update. ','wp-portfolio'),
		'priority'				=> 500,
	));
	$wp_customize->add_setting( 'wp_portfolio_theme_settings[wp_portfolio_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new WP_Portfolio_Customize_WP_Portfolio_upgrade(
		$wp_customize,
		'wp_portfolio_upgrade',
			array(
				'label'					=> __('WP_Portfolio Upgrade','wp-portfolio'),
				'section'				=> 'wp_portfolio_upgrade',
				'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_upgrade]',
			)
		)
	);
	/********************Site Layout ******************************************/
	$wp_customize->add_section('wp_portfolio_design_layout', array(
		'title'					=> __('Site Layout', 'wp-portfolio'),
		'priority'				=> 100,
		'panel'					=>'wp_portfolio_theme_options'
	));
	$wp_customize->add_setting('wp_portfolio_theme_settings[wp_portfolio_design_layout]', array(
		'default'				=> 'on',
		'sanitize_callback'	=> 'wp_portfolio_sanitize_choices',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('wp_portfolio_theme_settings[wp_portfolio_design_layout]', array(
		'section'				=> 'wp_portfolio_design_layout',
		'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_design_layout]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'on'					=> __('Wide Layout','wp-portfolio'),
			'off'					=> __('Narrow Layout','wp-portfolio'),
		),
	));
/********************Custom Header ******************************************/
	$wp_customize->add_section('custom_header_setting', array(
		'title'					=> __('Header Options', 'wp-portfolio'),
		'priority'				=> 110,
		'panel'					=>'wp_portfolio_theme_options'
	));
	$wp_customize->add_setting('wp_portfolio_theme_settings[wp_portfolio_header_settings]', array(
		'default'				=> 'header_text',
		'sanitize_callback'	=> 'wp_portfolio_sanitize_choices',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('wp_portfolio_theme_settings[wp_portfolio_header_settings]', array(
		'label'					=> __('Display', 'wp-portfolio'),
		'section'				=> 'custom_header_setting',
		'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_header_settings]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
			'choices'			=> array(
			'header_text'		=> __('Header Text Only','wp-portfolio'),
			'header_logo'		=> __('Header Logo Only','wp-portfolio'),
			'disable_both'		=> __('Disable Both','wp-portfolio'),
			),
	));

	/********************WP_Portfolio Layout******************************************/
	$wp_customize->add_section( 'wp_portfolio_post_layout', array(
		'title'					=> __('Post Layout View', 'wp-portfolio'),
		'priority'				=> 115,
		'panel'					=>'wp_portfolio_theme_options'
	));
	$wp_customize->add_setting( 'wp_portfolio_theme_settings[wp_portfolio_post_layout]', array(
		'default'				=> 'wp_portfolio_layout',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_portfolio_sanitize_choices'
	));
	$wp_customize->add_control( 'wp_portfolio_theme_settings[wp_portfolio_post_layout]', array(
		'section'				=> 'wp_portfolio_post_layout',
				'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_post_layout]',
				'type'					=> 'radio',
				'checked'				=> 'checked',
					'choices'			=> array(
					'wp_portfolio_layout'		=> __('Grid View','wp-portfolio'),
					'blog_layout'		=> __('list View','wp-portfolio'),
					),
	));
/********************Custom Css ******************************************/
	$wp_customize->add_section( 'wp_portfolio_custom_css', array(
		'title'					=> __('Custom CSS', 'wp-portfolio'),
		'description'			=> __('This CSS will overwrite the CSS of style.css file.','wp-portfolio'),
		'priority'				=> 120,
		'panel'					=>'wp_portfolio_theme_options'
	));
	$wp_customize->add_setting( 'wp_portfolio_theme_settings[wp_portfolio_css_settings]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control( 'wp_portfolio_css_settings', array(
		'section'				=> 'wp_portfolio_custom_css',
				'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_css_settings]',
				'type'					=> 'textarea'
	));
/********************Home Page Blog Category Setting ******************************************/
	$wp_customize->add_section(
		'wp_portfolio_category_section', array(
		'title' 						=> __('Home Page Blog Category Setting','wp-portfolio'),
		'description'				=> __('Only posts that belong to the categories selected here will be displayed on the front page. ( You may select multiple categories by holding down the CTRL key. ) ','wp-portfolio'),
		'priority'					=> 130,
		'panel'					=>'wp_portfolio_theme_options'
	));
	$wp_customize->add_setting( 'wp_portfolio_theme_settings[wp_portfolio_categories]', array(
		'default'					=>array(),
		'sanitize_callback'		=> 'prefix_sanitize_category',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control(
		new WP_Portfolio_Customize_Category_Control(
		$wp_customize,
			'wp_portfolio_theme_settings[wp_portfolio_categories]',
			array(
			'label'					=> __('Front page posts categories','wp-portfolio'),
			'section'				=> 'wp_portfolio_category_section',
			'settings'				=> 'wp_portfolio_theme_settings[wp_portfolio_categories]',
			'type'					=> 'multiple-select',
			)
		)
	);
	$wp_customize->add_setting( 'wp_portfolio_theme_settings[wp_portfolio_disable_setting]', array(
		'default'					=> 0,
		'sanitize_callback'		=> 'wp_portfolio_sanitize_checkbox',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'wp_portfolio_disable_setting', array(
		'label'						=> __('Check to Default Settings ( Uncheck to show effect on front page )', 'wp-portfolio'),
		'section'					=> 'wp_portfolio_category_section',
		'settings'					=> 'wp_portfolio_theme_settings[wp_portfolio_disable_setting]',
		'type'						=> 'checkbox',
	));
}
/********************Sanitize the values ******************************************/
function wp_portfolio_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
function wp_portfolio_sanitize_checkbox( $input) {
    return absint($input);
}
function prefix_sanitize_category( $input ) {
	if ( $input != '' ) { 
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					); 
		
		$categories = ( get_categories( $args ) );

		$category_list 	=	array();
		
		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    } 
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}
function wp_portfolio_customize_styles_upgrade( $input ) { ?>
	<style type="text/css">
		#customize-theme-controls #accordion-section-wp_portfolio_upgrade a {
			padding: 10px 8px;
			display: block;
			border-bottom: 1px solid #eee;
			color: #555;
		}
		#customize-theme-controls #accordion-section-wp_portfolio_upgrade a:hover {
			color: #222;
			background-color: #f5f5f5;
		}
	</style>
<?php }
add_action('customize_register', 'wp_portfolio_textarea_register');
add_action('customize_register', 'wp_portfolio_customize_register');
add_action( 'customize_controls_print_styles', 'wp_portfolio_customize_styles_upgrade');
?>
