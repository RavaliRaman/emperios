<?php

$data = (array)get_option( 'WordApp_options' );
    	$varColor = (array)get_option( 'WordApp_options' );
    	$varGA = (array)get_option( 'WordApp_ga' ); // Settings page
     	$varMenu = (array)get_option( 'WordApp_menu' );
     	$varStructure = (array)get_option( 'WordApp_structure' );
	  	$varSlideshow = (array)get_option( 'WordApp_slideshow' );
     
 
	include( dirname( __FILE__ ) . '/inc/config.php' );

show_admin_bar(false);
global $text_direction;
?>


<?php
$varMenu = (array)get_option( 'WordApp_menu' );

$varCss = (array)get_option( 'WordApp_css' );
$data = (array)get_option( 'WordApp_options' );
$varGA = (array)get_option( 'WordApp_ga' );

			if(!isset($data['Title'])) $varColor['Title']='';
			if(!isset($data['Color'])) $data['Color']='';
			if(!isset($data['background'])) $data['background']='';
			if(!isset($data['logo'])) $data['logo']='';
			if(!isset($data['style'])) $data['style']='';
			if(!isset($data['page_id'])) $data['page_id']='';
			if(!isset($varMenu['side'])) $varMenu['side']='';
			if(!isset($varMenu['top'])) $varMenu['top']='';
			if(!isset($varMenu['menu'])) $varMenu['menu']='';
			if(!isset($varMenu['menuTop'])) $varMenu['menuTop']='';
			if(!isset($varMenu['bottom'])) $varMenu['bottom']='';
			if(!isset($varMenu['menuBottom'])) $varMenu['menuBottom']='';
			if(!isset($varMenu['menuTop'])) $varMenu['menuTop']='';
			if(!isset($varCss['css'])) $varCss['css']='';
			if(!isset($_GET['WordApp_demo'])) $_GET['WordApp_demo'] = "";
			if(!isset($varColor['ColorText'])) $varColor['ColorText']='';
			if(!isset($varColor['ColorTextHHH'])) $varColor['ColorTextHHH']='';
			if(!isset($varColor['ColorTextP'])) $varColor['ColorTextP']='';
			if(!isset($varColor['ColorTextFont'])) $varColor['ColorTextFont']='';
			if(!isset($varColor['ColorTextFontHHH'])) $varColor['ColorTextFontHHH']='';
			if(!isset($varColor['ColorTextFontP'])) $varColor['ColorTextFontP']='';
			if(!isset($varGA['apiDomain'])) $varGA['apiDomain']='';
			if(!isset($varGA['wphead'])) $varGA['wphead']='';
 			if(!isset($varMenu['bottomIcon'])) $varMenu['bottomIcon']='';


$varGA

?>
	
<!DOCTYPE html>
<html lang="en"  ng-app="WordApp">
<head>
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="Robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="
    default-src *; 
    style-src * 'unsafe-inline'; 
    script-src * 'unsafe-inline'; 
    media-src *; img-src * data:; 
" />
	<link rel="canonical" href="<?php the_permalink(); ?>" />
	<?php 
		
		if($varGA['wphead'] == "on"):
		wp_head();
		endif;
	?>
	

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/demo.css">
	
  <link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/ratchet.css">
	<link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/menu_bubble.css">
	<link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/menu_cornermorph.css">
	<?php 
	/*
	<link rel="stylesheet" href="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/css/animsition.min.css">
	 <script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/animsition.min.js"></script>
	 */
	 ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.min.css">
	
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/jquery.backstretch.min.js"></script>
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.pkgd.min.js"></script>
	<script>
jQuery(document).ready(function(){    
	
	
    jQuery(".loadingDiv").fadeOut(300, function() { jQuery(".loadingDiv").remove(); })
});
</script>
	<script>
	
jQuery(document).ready(function(){
$("#demo").backstretch([
      <?php if($varSlideshow['one'] != ''){echo '"'.$varSlideshow['one'].'"'; } ?>
	 		<?php if($varSlideshow['two'] != ''){echo ',"'.$varSlideshow['two'].'"'; } ?>
	 		<?php if($varSlideshow['three'] != ''){echo ',"'.$varSlideshow['three'].'"'; } ?>
	 		<?php if($varSlideshow['four'] != ''){echo ',"'.$varSlideshow['four'].'"'; } ?>
	 		<?php if($varSlideshow['five'] != ''){echo ',"'.$varSlideshow['five'].'"'; } ?>
  ], {duration: 3000, fade: 750, preload: 0, centeredY: false, centeredY: false});
	 
	 });
</script>
	
	<script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/snap.svg-min.js"></script>
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
