<?php
/**
 * WordAppjqmobile functions and definitions
 *
 * @package WordAppjqmobile
 */

add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {
$widgets = get_option('sidebars_widgets');

foreach ($widgets as $widget => $widget_val) {
	if($widget == 'wp_inactive_widgets' || $widget ==  'array_version'){
		
	}else{
		
		register_sidebar(
		array(
			'id' => $widget,
			'name' => __( 'Primary' ),
			'description' => __( 'A short description of the sidebar.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	}
		
	}
			//echo $widget."".$widget_id;

	/* Register the 'primary' sidebar. */
	

	/* Repeat register_sidebar() code for additional sidebars. */
}
     
 		
require( dirname( __FILE__ ) . '/inc/classes.php' );

$content_width = 600;
add_theme_support( 'automatic-feed-links' );


function jqmobile_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'default',
		'mobile_layout' => 'content-sidebar',
		'ui' => array()
	);

	return apply_filters( 'jqmobile_default_theme_options', $default_theme_options );
}

function jqmobile_mobile_entities() {
	$layout_options = array(
		'body' => array(
			'label' => __( 'Body', 'jqmobile' ),
			'default' => 'c'
		),
		'header' => array(
			'label' => __( 'Header', 'jqmobile' ),
			'default' => 'a'
		),
		'footer' => array(
			'label' => __( 'Footer', 'jqmobile' ),
			'default' => 'a'
		),
		'post' => array(
			'label' => __( 'Post Teaser', 'jqmobile' ),
			'default' => 'c'
		),
		'sticky' => array(
			'label' => __( 'Sticky Post', 'jqmobile' ),
			'default' => 'b'
		),
		'widget' => array(
			'label' => __( 'Widget', 'jqmobile' ),
			'default' => 'c'
		),
		'widget_content' => array(
			'label' => __( 'Widget Content', 'jqmobile' ),
			'default' => 'c'
		),
		'comment' => array(
			'label' => __( 'Comments', 'jqmobile' ),
			'default' => 'c'
		),
		'form_comment' => array(
			'label' => __( 'Comment Form', 'jqmobile' ),
			'default' => 'c'
		),
	);

	return apply_filters( 'jqmobile_mobile_layouts', $layout_options );
}

function jqmobile_get_theme_options() {;
	return get_option( 'jqmobile_theme_options', jqmobile_get_default_theme_options() );
}

function jqmobile_get_ui($key = '') {
	static $ui_options;

	if (!is_array($ui_options)) {
		$options = jqmobile_get_theme_options();
		$ui_options = $options['ui'];
	}
	return isset($ui_options[$key]) ? $ui_options[$key] : '';
}

function jqmobileWordApp($key = '') {

	$data = jqmobile_get_ui($key);
	if ($data) {
		echo ' data-theme="'.$data.'"';
	}
}

function jquerymobile_enquee_script() {
	wp_enqueue_script('theme-script', get_stylesheet_directory_uri().'/script.js', array('jquery'));
	//wp_enqueue_script('jquerymobile', get_stylesheet_directory_uri().'/jquerymobile/jquery.mobile-1.0.min.js', array('jquery'), '1.0');
}
add_action('wp_enqueue_scripts', 'jquerymobile_enquee_script');

function jquerymobile_enquee_style() {
   // wp_enqueue_style('jquerymobile', get_stylesheet_directory_uri().'/jquerymobile/jquery.mobile.structure-1.0.min.css', false, '1.0');
    wp_enqueue_style('custom', get_stylesheet_directory_uri().'/custom.css', false);
}
add_action('wp_print_styles', 'jquerymobile_enquee_style');

function jquerymobile_widgets_init() {
	register_sidebar(array(
		'name' => 'Sidebar Widgets',
		'id'   => 'sidebar',
		'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s"  data-role="collapsible" data-theme="'.jqmobile_get_ui('widget').'">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}

add_action ( 'widgets_init', 'jquerymobile_widgets_init' );

add_filter('next_posts_link_attributes', 'jquerymobile_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'jquerymobile_prev_posts_link_attributes');

function jquerymobile_next_posts_link_attributes(){
	return 'data-role="button" data-icon="arrow-l"';
}
function jquerymobile_prev_posts_link_attributes(){
	return 'data-role="button" data-icon="arrow-r"';
}

add_filter('next_comments_link_attributes', 'jquerymobile_next_comments_link_attributes');
add_filter('previous_comments_link_attributes', 'jquerymobile_previous_comments_link_attributes');

function jquerymobile_next_comments_link_attributes(){
	return 'data-role="button" data-icon="arrow-r"';
}
function jquerymobile_previous_comments_link_attributes(){
	return 'data-role="button" data-icon="arrow-l"';
}

add_filter('widget_categories_args', 'jquerymobile_widget_categories_args');
add_filter('widget_links_args', 'jquerymobile_widget_links_args');

add_filter('widget_archives_args', 'jquerymobile_widget_archive_args');

function jquerymobile_widget_archive_args($args) {
	$args['show_post_count'] = false;
	return $args;
}

function jquerymobile_widget_categories_args($args) {
	$args['walker'] = new Theme_Walker_Category;
	return $args;
}

function jquerymobile_widget_links_args($args) {
	$args['show_updated'] = false;
	$args['show_description'] = false;
	$args['show_rating'] = false;
	return $args;
}

add_filter('widget_title', 'jquerymobile_widget_title', 10, 3);
function jquerymobile_widget_title($title, $instance = null, $id = null) {

	$title = trim($title, " \xA0");
	$default_title = ucfirst($id);

	switch($id) {
		case 'pages':
			$default_title = __( 'Pages', 'jquerymobile' );
			break;
		case 'text':
			$default_title = __( 'Text', 'jquerymobile' );
			break;
		case 'search':
			$default_title = __( 'Search', 'jquerymobile' );
			break;
		case 'tag_cloud':
			$default_title = __( 'Tag cloud', 'jquerymobile' );
			break;
		case 'recent-posts':
			$default_title = __( 'Recent posts', 'jquerymobile' );
			break;
		case 'meta':
			$default_title = __( 'Meta', 'jquerymobile' );
			break;
		case 'categories':
			$default_title = __( 'Categories', 'jquerymobile' );
			break;
		case 'archives':
			$default_title = __( 'Archives', 'jquerymobile' );
			break;
		case 'calendar':
			$default_title = __( 'Calendar', 'jquerymobile' );
			break;
		case 'nav_menu':
			$default_title = __( 'Custom menu', 'jquerymobile' );
			break;
	}
	return $title ? $title : $default_title;
}

function jquerymobile_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'jquerymobile' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'jquerymobile' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php jqmobileWordApp('comment');?>>
		<div id="comment-<?php comment_ID(); ?>" class="comment vcard ui-link-inherit">
				<?php
					$avatar_size = 60;

					echo get_avatar( $comment, $avatar_size );
				?>
				<div class="ui-li-heading">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'jquerymobile' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><span title="%2$s">%3$s</span></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'jquerymobile' ), get_comment_date( 'Y/m/d' ), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'jquerymobile' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jquerymobile' ); ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'jquerymobile' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
if ( ! function_exists( 'wordappjqmobile_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wordappjqmobile_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WordAppjqmobile, use a find and replace
	 * to change 'wordappjqmobile' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wordappjqmobile', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'wordappjqmobile' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wordappjqmobile_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wordappjqmobile_setup
add_action( 'after_setup_theme', 'wordappjqmobile_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordappjqmobile_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wordappjqmobile_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordappjqmobile_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wordappjqmobile_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wordappjqmobile' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wordappjqmobile_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wordappjqmobile_scripts() {
	wp_enqueue_style( 'wordappjqmobile-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wordappjqmobile-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wordappjqmobile-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wordappjqmobile_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
