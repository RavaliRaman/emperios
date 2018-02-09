<?php
if($_GET['WordApp_demo'] == "1"){

	show_admin_bar( false );
}

include WORDAPP_DIR.'/includes/config.php';
?>
<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/css/iosOverlay.css">
  <link rel="stylesheet" href="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/css/prettify.css">
<link rel='stylesheet'   href='<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/slidebars/awesome.css' type='text/css' media='all' />

<?php
$varColor = (array) get_option('WordApp_options');
if (!isset($varColor['ColorText']) || $varColor['ColorText'] == "") {
	$varColor['ColorText'] = '#ffffff';
}
if($wamenu['activebars']  == "on"):
	if($wamenu['top'] == 'on'):

?>
		<div class="fixed-nav-bar" style="min-height:60px">
			<?php
		if($wamenu['side'] == "on"){
	?>

			<div class="leftbtn"><a href="#" class="sb-toggle-left" style="color: <?php echo $varColor['ColorText']; ?>;"><i class="fa fa-<?php echo $wamenu['lsideicon'] == '' ? 'bars' : $wamenu['lsideicon']  ?>" aria-hidden="true"></i></a></div>
			
			<?php
		}
	?>

			<h1 role="heading" class="topText ui-title" aria-level="1"><?php
		
		if(!isset($varColor['background'])) $varColor['background']='';
		if(!isset($varColor['logo'])) $varColor['logo']='';
		
		if($varColor['logo'] == ""){
			echo get_bloginfo('name');
		}else{
		echo '<img src="'.esc_url($varColor['logo']).'" style="height:20px">';
	}
?></h1>


	<?php
		if($wamenu['rside'] == "on"){
	?>

<div class="rightbtn" style=""><a href="#" class="sb-toggle-right" style="color: <?php echo $varColor['ColorText']; ?>;"><i class="fa fa-<?php echo $wamenu['rsideicon'] == '' ? 'bars' : $wamenu['rsideicon']  ?>" aria-hidden="true"></i></a></div>
	<?php
		}
	?>

</div>




		<div class="sb-slidebar sb-left">
			<!-- Your left Slidebar content. -->

			<?php
$varMenu = (array)get_option( 'WordApp_menu' );
$data = (array)get_option( 'WordApp_options' );
if(!isset($varMenu['menu'])) $varMenu['menu'] ='';
if(!isset($data['logo'])) $data['logo'] ='';
if(!isset($varMenu['rside'])) $varMenu['rside']='';
if(!isset($varMenu['menuRight'])) $varMenu['menuRight']='';
?>

			 <p><img src="<?php echo esc_url($data['logo']) ?>" style="max-width:90%;padding:5px"></p>

	<?php
if($varMenu['side'] == "on"  && $varMenu['menu'] !== "" ){
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
			
			<?php
				
				
if($varMenu['rside'] == "on" && $varMenu['menuRight'] !== "" ){
	$menu_items = wp_get_nav_menu_items($varMenu['menuRight']);

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
			<div  class="widget-area" role="complementary">	
					<?php
	
						dynamic_sidebar( 'wordapp-mobile-sidebar-right' ); 
					?>
			</div>	<!-- Your right Slidebar content. -->
		</div>


<div id="sb-site">
	<?php
endif;
endif;
?>
