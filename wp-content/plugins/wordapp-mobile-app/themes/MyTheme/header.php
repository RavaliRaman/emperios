<?php
if($_GET['WordApp_demo'] == "1"){

	show_admin_bar( false );
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 

  <link rel="stylesheet" href="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/css/iosOverlay.css">
  <link rel="stylesheet" href="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/css/prettify.css">
  <link rel='stylesheet'   href='<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/slidebars/slidebars.css' type='text/css' media='all' />

<?php
$varColor = (array) get_option('WordApp_options');


if(!isset($varColor['background'])) $varColor['background']='';
if(!isset($varColor['logo'])) $varColor['logo']='';
if(!isset($wamenu['activebars'])) $wamenu['activebars']='';
if(!isset($wamenu['top'])) $wamenu['top']='';

if($wamenu['activebars']  == "on"):
	if($wamenu['top'] == 'on'):



?>
		<div class="fixed-nav-bar" style="min-height:60px">
			<div class="leftbtn"><a href="d" class="sb-toggle-left"><img src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/slidebars/3lines.png"></a></div>
			<h1 role="heading" class="topText ui-title" aria-level="1"><?php
	if($varColor['logo'] == ""){
		echo get_bloginfo('name');
	}else{
	echo '<img src="'.esc_url($varColor['logo']).'" style="height:20px">';
}
?></h1></div>




		<div class="sb-slidebar sb-left">
			<!-- Your left Slidebar content. -->

			<?php
$varMenu = (array)get_option( 'WordApp_menu' );
$data = (array)get_option( 'WordApp_options' );
if(!isset($varMenu['menu'])) $varMenu['menu'] ='';
if(!isset($data['logo'])) $data['logo'] ='';
include WORDAPP_DIR.'/includes/config.php';

?>

			 <p><img src="<?php echo esc_url($data['logo']) ?>" style="max-width:90%;padding:5px"></p>
	<div id="widget-search" class="widget widget_search"  data-role="">

			<?php get_search_form(); ?>
		</div>
	<?php
if($varMenu['side'] == "on"){
	$menu_items = wp_get_nav_menu_items($varMenu['menu']);

	$menu_list = '<ul data-role="listview"  style="" class="nav-search" >';

	foreach ( (array) $menu_items as $key => $menu_item ) {
			if ( isset($menu_item->title)){ 
			$title = $menu_item->title; }else{ $title = ''; }
		if ( isset($menu_item->url) ){ 
			$url = $menu_item->url;; }else{ $url = ''; }
		
		$menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '</ul>';

	echo $menu_list;
}
?>
	<div  class="widget-area" role="complementary">	<?php

dynamic_sidebar( 'wordapp-mobile-sidebar-left' );
?>
</div>
		</div>

		<div class="sb-slidebar sb-right">
			<!-- Your right Slidebar content. -->
		</div>


<div id="sb-site">
	<?php
endif;
endif;
?>
