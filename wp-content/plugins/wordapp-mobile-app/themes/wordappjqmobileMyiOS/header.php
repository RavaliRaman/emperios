<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordAppjqmobile
 */

add_theme_support( 'woocommerce' );
			$data = (array)get_option( 'WordApp_options' );
    	$varColor = (array)get_option( 'WordApp_options' );
    	$varGA = (array)get_option( 'WordApp_ga' ); // Settings page
     	$varMenu = (array)get_option( 'WordApp_menu' );
     	$varStructure = (array)get_option( 'WordApp_structure' );
	  	$varSlideshow = (array)get_option( 'WordApp_slideshow' );
     
 
			include( dirname( __FILE__ ) . '/inc/config.php' );

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>  ng-app="WordApp">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=0" />
	<?php if (is_search()): ?><meta name="robots" content="noindex, nofollow" /><?php endif; ?>
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript">
		var ui_widget_content = '<?php echo jqmobile_get_ui('widget_content'); ?>';
		var ui_form_comment = '<?php echo jqmobile_get_ui('form_comment'); ?>';
	</script>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" type="text/css" />
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/demo.css">
	
  <link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/ratchet.css">
	<link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/menu_bubble.css">
	<link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/animsition.min.css">

	
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/jquery.backstretch.min.js"></script>
  <script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/animsition.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() ?>/slick/slick.css" />
  <script src="<?php echo  get_template_directory_uri() ?>/slick/slick.min.js"></script>

	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body  <?php body_class(); ?>  ng-controller="myCtrlWordApp">
<header class="bar bar-nav">
 <button class="btn btn-link btn-nav pull-left backBtn" onclick="javascript:location.href='<?php echo esc_url(wp_get_referer()); ?>';return false;">
    <i class="iconWordAppColor wordappFA fa fa-angle-left fa-2x" ></i>
  </button>
  	<h1 class="title topText"><?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="height:20px">';
}
?>

</h1>

	
	
	<button class="btn btn-link btn-nav pull-right backBtn" onclick="javascript:location.href='<?php echo esc_url( home_url( '/' ) );  ?>?WordApp_mobile_app=app&WordApp_launch=1';return false;">
    <i class="iconWordAppColor wordappFA fa fa-home fa-2x" ></i>
	
  </button>
	
</header>
	
	
		
		
		<div data-role="content" class="content" >
