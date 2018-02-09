<!DOCTYPE html>
<!-- add a class to the html tag if the site is being viewed in IE, to allow for any big fixes -->
<!--[if lt IE 8]><html class="ie7"><![endif]-->
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><html><![endif]-->
<!--[if !IE]><html><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() ?>/css/jquery.mobile.flatui.css" />
 	
	<title>
	<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?>
</title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
<?php //wp_head(); 
	?>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
	
});
jQuery("a[href^='http']:not([href*='" + document.domain + "'])").each(function () {
	jQuery(this).attr("target", "_blank");
});
	</script>
<script src="<?php echo  get_template_directory_uri() ?>/js/jquery.mobile-1.4.0-rc.1.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() ?>/slick/slick.css" />
    <script src="<?php echo  get_template_directory_uri() ?>/slick/slick.min.js"></script>

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
		$( "#rating-button").removeClass( "ui-btn" );
    },1);      
});
</script>
<?php 
		
		
				wp_head();
		
	?>
</head>

<body <?php body_class(); ?>> 

  <div data-role="page">

   
	<?php 
			include 'leftsidebar.php';
			//get_sidebar(); 
		
	include 'sidebar.php';
	?>	
    <div data-role="header" data-position="fixed" class="ios7" data-tap-toggle="false">
      <a data-iconpos="notext" href="#mypanel" data-role="button" class="ios7-header-button" data-icon="bars"></a>
		
      	<h1 role="heading" class="topText"><?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="height:20px">';
}
?></h1>
      <a data-iconpos="notext" href="#mypanelRight" data-role="button" class="ios7-header-button ui-icon-shop" data-icon="shop"></a>
   <div data-role="navbar"><center>
	   <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<input type="search" name="s" id="s" class="searchBar" style="padding-left: 23px;font-size: 12px;"  value="<?php echo get_search_query(); ?>" placeholder=""> </center>
	   </form>
	   </div><!-- /navbar -->
	  </div>

    <div data-role="content" role="main" >
	<?php
if ( is_front_page() ) {
	
$data = (array)get_option( 'WordApp_options' );
$varSlideshow = (array)get_option( 'WordApp_slideshow' );
    
 if(!isset($data['style'])) $data['style']='';
 if(!isset($varSlideshow['onoff'])) $varSlideshow['onoff']=''; 

get_header(); ?>

<div class="">
 <?php
		
	if($varSlideshow['onoff'] =="on"){
	/* 
	?>
     <div class="slider images" style="margin: 0 auto; max-width: 740px">
		 
	<?php	  
		  
  if(isset($varSlideshow['one']) && $varSlideshow['one'] !== "") {
	  
	  echo '<div><div class="image"><img data-lazy="'.$varSlideshow["one"].'"/></div></div>';
  }	
	if(isset($varSlideshow['two']) && $varSlideshow['two'] !== "") {
	  
	  echo '<div><div class="image"><img data-lazy="'.$varSlideshow['two'].'"/></div></div>';
  }	
	if(isset($varSlideshow['three']) && $varSlideshow['three'] !== "") {
	  
	  echo '<div><div class="image"><img data-lazy="'.$varSlideshow['three'].'"/></div></div>';
  }	
	if(isset($varSlideshow['four']) && $varSlideshow['four'] !== "") {
	  
	  echo '<div><div class="image"><img data-lazy="'.$varSlideshow['four'].'"/></div></div>';
  }	
	if(isset($varSlideshow['five']) && $varSlideshow['five'] !== "") {
	  
	  echo '<div><div class="image"><img data-lazy="'.$varSlideshow['five'].'"/></div></div>';
  }	
		 ?>
          
        </div>
    
    
<?php 
		  */
?>
		  
<div  class="widget-area" role="complementary">	<?php
	
 dynamic_sidebar( 'wordapp-mobile-sidebar-header' ); 
			?>
</div>
	 <div class="slider images" style="margin: 0 auto; max-width: 740px">
	
	<?php
		$term = get_term_by( 'id',  $varSlideshow['wooCat'], 'product_cat', 'ARRAY_A' );
		 $args = array( 'post_type' => 'product', 'posts_per_page' => 5, 'product_cat' => $term['name'], 
					   'meta_key' => '_thumbnail_id',
					   'orderby' => 'rand',
					   'meta_query' => array(
       					 array( 'key' => '_thumbnail_id'), //Show only posts with featured images
   						 ));
       
	query_posts($args);
	
		?>	
	<!-- loop for slider -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		 if ( has_post_thumbnail() ) {
		?>



		<div><div class="image">
			<a href="<?php the_permalink(); ?>">
			<img data-lazy="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>"/>
		
		<h2 class="slide__caption" href="<?php the_permalink(); ?>">
			<?php echo get_the_title(); ?>
		</h2>
			</a>
	</div></div>
		 <?php 
		 }
	endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; 
	
	wp_reset_query();
		
		?>
</div>
		<?php
	} 

}
/*


	<header role="banner">
	
		<div class="site-name half left">			
			<!-- site name and description - site name is inside a div element on all pages execpt the front page and/or main blog page, where it is in a h1 element -->
			<h1 id="site-title">
				<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo apply_filters( 'WordApp_sitetitle', get_bloginfo( 'name' ) ); ?></a>
			</h1>
			<h2 id="site-description"><?php echo apply_filters( 'WordApp_sitedescription', get_bloginfo( 'description' ) ); ?></h2>
		</div>
		
		<div class="half right">
			<!-- This area is by default in the top right of the header. It contains contact details and is also where you might add social media or RSS links -->
		
			<?php
			// action hook for any content placed inside the right hand header, including the widget area.
			do_action ( 'WordApp_in_header' );
			?>
		</div> <!-- .half right -->
		
		
	</header>

<div class="navwrapper"><!-- for full width styling -->	
	<!-- full width navigation menu - delete nav element if using top navigation -->
	<nav class="menu main">
		<div class="skip-link screen-reader-text"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'tutsplus' ); ?></a></div>
		<?php wp_nav_menu( array( 'container_class' => 'main-nav', 'theme_location' => 'primary' ) ); ?>

	</nav><!-- .main -->
</div><!-- .navwrapper-->

	<div class="main">
	
		<?php if ( is_page_template( 'page-full-width.php' ) ) {
			
			echo '<div id ="content" class="full-width">';
		
		} else {
			
			echo '<div id="content" class="two-thirds left">';
		} ?>
		
			<?php
			// action hook for any content placed before the content, including the widget area
			do_action ( 'WordApp_before_content' );
			
	*/
	?>