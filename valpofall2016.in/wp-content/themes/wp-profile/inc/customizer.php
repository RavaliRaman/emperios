<?php
/**
 * WP Profile Theme Customizer
 *
 * @package WP Profile
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_profile_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wp_profile_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_profile_customize_preview_js() {
	wp_enqueue_script( 'wp_profile_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wp_profile_customize_preview_js' );


/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if (!function_exists( 'wp_profile_theme_customizer' ) ) :
	function wp_profile_theme_customizer( $wp_customize ) {
		
		/* logo option */
		$wp_customize->add_section( 'wp_profile_logo_section' , array(
			'title'       => __( 'Site Logo', 'wp-profile' ),
			'priority'    => 19,
			'description' => __( 'Upload a logo to replace the default site name in the header', 'wp-profile' ),
		) );
		
		$wp_customize->add_setting( 'wp_profile_logo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wp_profile_logo', array(
			'label'    => __( 'Choose your logo (ideal width is 100-300px and ideal height is 40-100px)', 'wp-profile' ),
			'section'  => 'wp_profile_logo_section',
			'settings' => 'wp_profile_logo',
		) ) );
		
		/* Profile Featured */
		class WP_Customize_custom_Control extends WP_Customize_Control {
		 
			public function render_content() {
				switch( $this->type ) {
					
					case 'textarea':
						?>
						<label>
                            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
                        </label>
						<?php
						break;
					case 'dropdown-pages':
						$dropdown = wp_dropdown_pages(
							array(
								'name'              => '_customize-dropdown-pages-' . $this->id,
								'echo'              => 0,
								'show_option_none'  => __( '&mdash; Select &mdash;', 'wp-profile' ),
								'option_none_value' => '0',
								'selected'          => $this->value(),
							)
						);
			 
						$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
			 
						printf(
							'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
							$this->label,
							$dropdown
						);
						break;
				}
			}
		}
		function wp_profile_sanitize_text_field( $str ) {
			return sanitize_text_field( $str );
		}
		
		function wp_profile_sanitize_textarea( $text ) {
			return esc_textarea( $text );
		}
		$wp_customize->add_panel( 'wp_profile_featured_panel', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => 'Home Page Features',
			'description'    => '',
		) );
		
		$wp_customize->add_section( 'wp_profile_featured_section' , array(
			'title'       => __( 'Profile', 'wp-profile' ),
			'priority'    => 20,
			'description' => __( '', 'wp-profile' ),
			'panel'  => 'wp_profile_featured_panel',
		) );
		
		$wp_customize->add_setting('wp_profile_display', array(
			'default'        => 0,
			'sanitize_callback' => 'wp_profile_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('display_profile', array(
			'settings' => 'wp_profile_display',
			'label'    => __('Display Profile', 'wp-profile'),
			'section'  => 'wp_profile_featured_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting( 'wp_profile_featured_photo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wp_profile_featured_photo', array(
			'label'    => __( 'Choose your profile photo (ideal width is 272px and ideal height is 272px)', 'wp-profile' ),
			'section'  => 'wp_profile_featured_section',
			'settings' => 'wp_profile_featured_photo',
			'priority'    => 22,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_name', array (
			'default' => __('Profile Name','wp-profile'),
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'wp_profile_name', array(
               'label'      => __( 'Enter Profile Name', 'wp-profile' ),
               'section'    => 'wp_profile_featured_section',
               'settings'   => 'wp_profile_name',
			   'type'   	=> 	'text',
			   'priority'    => 23
			   )
		));
		
		$wp_customize->add_setting( 'wp_profile_short_description', array (
			'default' => __('Profile Name','wp-profile'),
			'sanitize_callback' => 'wp_profile_sanitize_textarea'
			
		));
		
		$wp_customize->add_control(new WP_Customize_custom_Control($wp_customize, 'wp_profile_short_description', array(
               'label'      => __( 'Profile short description', 'wp-profile' ),
               'section'    => 'wp_profile_featured_section',
               'settings'   => 'wp_profile_short_description',
			   'type'   	=> 	'textarea',
			   'priority'    => 24
			   )
		));
		
		$wp_customize->add_setting( 'wp_profile_featured_background', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wp_profile_featured_background', array(
			'label'    => __( 'Choose your profile background', 'wp-profile' ),
			'section'  => 'wp_profile_featured_section',
			'settings' => 'wp_profile_featured_background',
			'priority'    => 24,
		) ) );
		
		// About me page
		$wp_customize->add_section( 'wp_profile_content_section' , array(
			'title'       => __( 'Main Content', 'wp-profile' ),
			'priority'    => 20,
			'description' => __( '', 'wp-profile' ),
			'panel'  => 'wp_profile_featured_panel',
		) );	
		
		
		$wp_customize->add_setting( 'wp_profile_content_background_color', array (
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_profile_content_background_color', array(
			'label'    => __( 'Content background color', 'wp-profile' ),
			'section'  => 'wp_profile_content_section',
			'settings' => 'wp_profile_content_background_color',
			'priority' => 24,
		) ) );
		
		// Display Link
		$wp_customize->add_section( 'wp_profile_link_section' , array(
			'title'       => __( 'Featured Links', 'wp-profile' ),
			'priority'    => 20,
			'description' => __( '', 'wp-profile' ),
			'panel'  => 'wp_profile_featured_panel',
		) );
		
		$wp_customize->add_setting('wp_profile_display_links', array(
			'default'        => 0,
			'sanitize_callback' => 'wp_profile_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('wp_profile_display_links', array(
			'settings' => 'wp_profile_display_links',
			'label'    => __('Display Profile', 'wp-profile'),
			'section'  => 'wp_profile_link_section',
			'type'     => 'checkbox',
			'priority' => 25,
		));
		
		
		$wp_customize->add_setting( 'wp_profile_resume_text', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control( 'wp_profile_resume_text', array(
			'type'     => 'text',
			'priority' => 25,
			'description' => __('Featured Link #1 Text', 'wp-profile'),
			'section'  => 'wp_profile_link_section',
			'label'    => 'Featured Links',
		) );
		
		$wp_customize->add_setting( 'wp_profile_resume_url', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control( 'wp_profile_resume_url', array(
			'type'     => 'url',
			'priority' => 25,
			'description' => __('Featured Link #1 URL', 'wp-profile'),
			'section'  => 'wp_profile_link_section',
		) );
		
		$wp_customize->add_setting( 'wp_profile_portfolio_text', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_portfolio_text', array(
			   'description' => __('Featured Link #2 text', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
			   'type'   	=> 	'text',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_portfolio_url', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_portfolio_url', array(
			   'description' => __('Featured Link #2 URL', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
               'settings'   => 'wp_profile_portfolio_url',
			   'type'   	=> 	'url',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_blog_text', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_blog_text', array(
			   'description' => __('Featured Link #3 Text', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
			   'type'   	=> 	'text',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_blog_url', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_blog_url', array(
			   'description' => __('Featured Link #3 URL', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
			   'type'   	=> 	'url',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_contact_text', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_contact_text', array(
			   'description' => __('Featured Link #4 Text', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
			   'type'   	=> 	'text',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_contact_url', array (
			'default' => '',
			'sanitize_callback' => 'wp_profile_sanitize_text_field'
		));
		
		$wp_customize->add_control('wp_profile_contact_url', array(
			   'description' => __('Featured Link #4 URL', 'wp-profile'),
               'section'    => 'wp_profile_link_section',
			   'type'   	=> 	'url',
			   'priority'    => 25
		));
		
		$wp_customize->add_setting( 'wp_profile_featured_links_background', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wp_profile_featured_links_background', array(
			'label'    => __( 'Choose your featured links background', 'wp-profile' ),
			'section'  => 'wp_profile_link_section',
			'settings' => 'wp_profile_featured_links_background',
			'priority'    => 25,
		) ) );
		
		/* social media option */
		$wp_customize->add_section( 'wp_profile_social_section' , array(
			'title'       => __( 'Social Media', 'wp-profile' ),
			'priority'    => 25,
			'description' => __( 'Optional social media buttons in the header', 'wp-profile' ),
		) );
		
		$wp_customize->add_setting( 'wp_profile_facebook', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_facebook', array(
			'label'    => __( 'Enter your Facebook url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_facebook',
			'priority'    => 26,
		) ) );
	
		$wp_customize->add_setting( 'wp_profile_twitter', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_twitter', array(
			'label'    => __( 'Enter your Twitter url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_twitter',
			'priority'    => 27,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_gplus', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_gplus', array(
			'label'    => __( 'Enter your Google Plus url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_gplus',
			'priority'    => 28,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_linkedin', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_linkedin', array(
			'label'    => __( 'Enter your LinkedIn url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_linkedin',
			'priority'    => 29,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_pinterest', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_pinterest', array(
			'label'    => __( 'Enter your Pinterest url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_pinterest',
			'priority'    => 30,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_youtube', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_youtube', array(
			'label'    => __( 'Enter your YouTube url', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_youtube',
			'priority'    => 31,
		) ) );
		
		$wp_customize->add_setting( 'wp_profile_email', array (			
			'sanitize_callback' => 'sanitize_email',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wp_profile_email', array(
			'label'    => __( 'Enter your email address', 'wp-profile' ),
			'section'  => 'wp_profile_social_section',
			'settings' => 'wp_profile_email',
			'priority'    => 32,
		) ) );
		
		/* color theme */
		$wp_customize->add_setting( 'wp_profile_primary_theme_color', array (
			'default' => '#c2973c',
			'sanitize_callback' => 'sanitize_hex_color',
			'priority' => 33,
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_profile_primary_theme_color', array(
			'label'    => __( 'Primary Theme Color Option', 'wp-profile' ),
			'section'  => 'colors',
			'settings' => 'wp_profile_primary_theme_color',
			'priority' => 34,
		) ) );	
		
		// author bio in posts option 
		$wp_customize->add_section( 'wp_profile_author_bio_section' , array(
			'title'       => __( 'Display Author Bio', 'wp-profile' ),
			'priority'    => 36,
			'description' => __( 'Option to show/hide the author bio in the posts.', 'wp-profile' ),
		) );
		
		$wp_customize->add_setting( 'wp_profile_author_bio', array (
			'default'        => 0,
			'sanitize_callback' => 'wp_profile_sanitize_checkbox',
		) );
		
		 $wp_customize->add_control('author_bio', array(
			'settings' => 'wp_profile_author_bio',
			'label' => __('Show the author bio in posts?', 'wp-profile'),
			'section' => 'wp_profile_author_bio_section',
			'type' => 'checkbox',
			'priority'    => 37,
		));		
		
		
	}
endif;

add_action('customize_register', 'wp_profile_theme_customizer');

/**
 * Sanitize integer input
 */
if (!function_exists( 'wp_profile_sanitize_integer' ) ) :
	function wp_profile_sanitize_integer( $input ) {		
		return absint($input);
	}
endif;

/**
 * Sanitize checkbox
 */
if (!function_exists( 'wp_profile_sanitize_checkbox' ) ) :
	function wp_profile_sanitize_checkbox( $input ) {
		if ( $input != 1 ) {
			return 0;
		} else {
			return 1;
		}
	}
endif;

/**
* Apply Color Scheme
*/
if (!function_exists( 'wp_profile_apply_color' ) ) :
  function wp_profile_apply_color() {
	?>
	<style id="color-settings">
	<?php if ( get_theme_mod('wp_profile_primary_theme_color') ) : ?>
	.pagination .fa, .main-navigation li:hover > a, li.current-menu-item a, li.current_page_item, .social-media ul li:hover, #read-more span:hover, #featured-post #read-more :hover, #respond #submit,
.post-content form input[type=submit], .post-content form input[type=button], .main-navigation ul ul a, #footer #calendar_wrap thead tr{
		background:<?php echo esc_html(get_theme_mod('wp_profile_primary_theme_color')); ?>;
		}
		.entry-header, .menu-container, .profile-main-image, #read-more span, #featured-post #read-more a, h2.comments-title, #footer, #footer-widget{border-color:<?php echo get_theme_mod('wp_profile_primary_theme_color'); ?>;}
		aside.widget_recent_comments ul li:before, aside.widget_archive ul li:before, aside.widget_categories ul li:before, aside.widget_meta ul li:before{
			border-color:transparent transparent transparent <?php echo esc_html(get_theme_mod('wp_profile_primary_theme_color')); ?>;
			}
		a, .logo a, .tag-container a:hover, a:hover .fa-clock-o, a:hover .fa-comments-o, .navbar-default .navbar-nav > li > a, .main-navigation a, .home-profile-about h1, h1.entry-title a, #featured-post h1.title a, a.comment-reply-link, cite.fn, cite.fn a, aside ul li a, .widget-title h4, .footer-widget a, .main-navigation ul ul a:hover,  aside ul li, #calendar_wrap td a {color:<?php echo esc_html(get_theme_mod('wp_profile_primary_theme_color')); ?>;}
	<?php endif; ?>
	
	<?php  if( get_theme_mod('wp_profile_featured_background') ){ ?>
			body.home{
				background-image:url(<?php echo esc_url(get_theme_mod('wp_profile_featured_background')); ?>);
			}
	<?php }?>
	<?php  if( get_theme_mod('wp_profile_content_background_color') ){ ?>
			.home-content{
				background-color:<?php echo esc_html(get_theme_mod('wp_profile_content_background_color')); ?>;
			}
	<?php }?>
	<?php  if( get_theme_mod('wp_profile_featured_links_background') ){ ?>
			.home-profile-services, .entry-header{
				background-image:url(<?php echo esc_url(get_theme_mod('wp_profile_featured_links_background')); ?>);
			}
	<?php }?>
	
	</style>
	<?php	  

  }
endif;
add_action( 'wp_head', 'wp_profile_apply_color' );