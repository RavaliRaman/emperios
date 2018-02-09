<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordAppjqmobile
 */

		$data = (array)get_option( 'WordApp_options' );
    	$varColor = (array)get_option( 'WordApp_options' );
    	$varGA = (array)get_option( 'WordApp_ga' ); // Settings page
     	$varMenu = (array)get_option( 'WordApp_menu' );
     	$varStructure = (array)get_option( 'WordApp_structure' );
	  	$varSlideshow = (array)get_option( 'WordApp_slideshow' );
     
 
	include( dirname( __FILE__ ) . '/inc/config.php' );

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	
	<script type="text/javascript">
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
});
jQuery("a[href^='http']:not([href*='" + document.domain + "'])").each(function () {
	jQuery(this).attr("target", "_blank");
});
	</script>	
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">

		$(window).bind('beforeunload', function(){
   
    var interval = setInterval(function(){
        $.mobile.loading('show');
        clearInterval(interval);
    },1);    
});

$(document).on('pageshow', '[data-role="page"]', function(){  
    var interval = setInterval(function(){
        $.mobile.loading('hide');
        clearInterval(interval);
    },1);      
});
</script>

	<link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() ?>/slick/slick.css" />
    <script src="<?php echo  get_template_directory_uri() ?>/slick/slick.min.js"></script>

	
</head>

<body <?php body_class(); ?>>
	<div data-role="page" id="" <?php jqmobileWordApp('body');?>>
		<div data-role="header"<?php jqmobileWordApp('header');?>  data-position="fixed" class="ios7" data-tap-toggle="false">
		<?php 
			if($varMenu['side'] == "on"){ 
		?>
				<a data-iconpos="notext" href="#mypanel" data-role="button" data-icon="bars" class="ios7-header-button topBtn"></a>
		<?php
			}
		?>
			
			<h1 role="heading" class="topText"><?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="height:20px">';
}
?></h1>
			<a data-iconpos="notext" href="#mypanelRight" data-role="button" data-icon="grid" title="widgets"  class="ios7-header-button topBtn"></a>
		
		
		
		<?php

    if($varMenu['menuTop'] !== "" && $varMenu['top'] == "on" ) {
    echo ' <div data-role="navbar"><ul>';
		
		
		$menu_items = wp_get_nav_menu_items($varMenu['menuTop']);

	$menu_list ='';
	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	}
	echo $menu_list;
		
		
    echo "</ul></div>";
    }
   ?>
		
		</div>
 
	<?php 
		if($varMenu['side'] == "on"){
			include 'leftsidebar.php';
			//get_sidebar(); 
		}
		get_sidebar(); 
	?>		
		
		<div data-role="content">
