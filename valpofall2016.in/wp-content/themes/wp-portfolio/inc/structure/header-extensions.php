<?php
/**
 * Adds header structures.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 * @license http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link http://themehorse.com/themes/portfolio
 */
/****************************************************************************************/
add_action('wp_portfolio_view_port', 'wp_portfolio_viewport', 5);
/**
 * Add meta tags.
 */
function wp_portfolio_viewport() { ?>
		<meta name="viewport" content="width=device-width">
<?php
}
/****************************************************************************************/
add_action('wp_portfolio_header', 'wp_portfolio_headercontent_details', 10);
/**
 * Shows Header content details
 *
 * Shows the site logo, title, description, searchbar, social icons and many more
 */
function wp_portfolio_headercontent_details() { ?>
<header id="masthead" class="site-header" role="banner">
	<?php global $wp_portfolio_settings;
		$wp_portfolio_settings = wp_parse_args(  get_option( 'wp_portfolio_theme_settings', array() ),  wp_portfolio_get_option_defaults() );
			$header_display = $wp_portfolio_settings['wp_portfolio_header_settings'];
			if ($header_display != 'disable_both' && $header_display == 'header_text') { ?>
			<section id="site-logo" class="clearfix">
			<?php if(is_single() || !is_home()){ ?>
				<h2 id="site-title"> 
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a> 
				</h2><!-- #site-title -->
				<?php } else { ?>
				<h1 id="site-title"> 
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a> 
				</h1><!-- #site-title -->
				<?php }
				$site_description = get_bloginfo( 'description', 'display' );
				if($site_description){?>
					<h2 id="site-description"><?php bloginfo('description');?> </h2>
				<?php } ?>
			</section><!-- #site-logo -->
				<?php
			}	elseif ($header_display != 'disable_both' && $header_display == 'header_logo') {
				?>
					<?php wp_portfolio_the_custom_logo();?><!-- #site-logo -->
			<?php }?>
			<button class="menu-toggle"><?php _e('Responsive Menu', 'wp-portfolio' ); ?></button>
			<?php  
			if (has_nav_menu('primary')) {// if there is nav menu then content displayed from nav menu else from pages ?>
			<?php $args = array(
						'theme_location' => 'primary',
						'container'      => '',
						'items_wrap'     => '<ul class="nav-menu">%3$s</ul>',
					); ?>
				<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
					<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
				</nav><!-- #access -->
		<?php } else {// extract the content from page menu only ?>
			<section class="hgroup-right">
				<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
					<?php	wp_page_menu(array('menu_class' => 'nav-menu')); ?>
				</nav><!-- #access -->
			</section>
			<?php	} ?>
</header><!-- #masthead -->
<div id="content">
	<?php
		$wp_portfolio_header_image = get_header_image();
		if (!empty($wp_portfolio_header_image)):?>
			<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($wp_portfolio_header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> 
			</a>
		<?php endif;
			if (!is_home()){
				if (('' != wp_portfolio_header_title()) || function_exists('bcn_display_list')) {
					if(is_single() && function_exists('bcn_display_list')){
						if (function_exists('wp_portfolio_breadcrumb')) { ?>
						<div class="page-title-wrap clearfix">
								<?php	wp_portfolio_breadcrumb();
						} ?>
						</div><!-- .page-title-wrap -->
					<?php }
					elseif(is_single() && !function_exists('bcn_display_list')){
					}else{ ?>
						<div class="page-title-wrap clearfix">
								<h1 class="page-title"><?php echo wp_portfolio_header_title();?></h1><!-- .page-title -->
							<?php
								if (function_exists('wp_portfolio_breadcrumb')) {
									wp_portfolio_breadcrumb();
								}
							?>
						</div><!-- .page-title-wrap -->
					<?php }
				}
			} ?>
<?php }
/****************************************************************************************/
if (!function_exists('wp_portfolio_breadcrumb')):
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function wp_portfolio_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}
endif;
/****************************************************************************************/
if (!function_exists('wp_portfolio_header_title')):
/**
 * Show the title in header
 *
 * @since WP_Portfolio 1.0
 */
function wp_portfolio_header_title() {
	if (is_archive()) {
		if( class_exists( 'WooCommerce' ) && is_woocommerce()){
			$wp_portfolio_header_title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		}else{
			$wp_portfolio_header_title = single_cat_title('', FALSE);
		}
	} elseif (is_home()){
		$wp_portfolio_header_title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$wp_portfolio_header_title = __('Page NOT Found', 'wp-portfolio');
	} elseif (is_search()) {
		$wp_portfolio_header_title = __('Search Results', 'wp-portfolio');
	} elseif (is_page_template()) {
		$wp_portfolio_header_title = get_the_title();
	} else {
		$wp_portfolio_header_title = get_the_title();
	}
	return $wp_portfolio_header_title;
}
endif;
?>
