<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordAppjqmobile
 */

$data = (array)get_option( 'WordApp_options' );
$varSlideshow = (array)get_option( 'WordApp_slideshow' );
    
 if(!isset($data['style'])) $data['style']='';
 if(!isset($varSlideshow['onoff'])) $varSlideshow['onoff']=''; 

	if($data['style'] == "page" && (isset($_GET['WordApp_launch']) && $_GET['WordApp_launch'] == '1') || (isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_GET['WordApp_mobile_site'])  && $_GET['WordApp_mobile_site'] === 'mobile')) {
		//echo "hello";
	//exit;
		//echo "hello";
		$wpost_type = get_post_type($data['page_id']);
		//print_r($wpost_type);
		
		if($_GET['WordApp_demo'] == '1'){
			$extra ="&WordApp_demo=1";
		}
		if($wpost_type == 'page'){
			 $url = site_url("/").'?p='.$data['page_id'].''.$extra;
		}else if($wpost_type == 'post'){
			 $url = site_url("/").'?p='.$data['page_id'].''.$extra;
		}else{
		$postname = get_post( $data['page_id'] ,ARRAY_A) ;
			
			  $url = site_url("/").'?'.$wpost_type.'='.$postname['post_name'].''.$extra;
		
		}
		
		$my_url =$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
		//echo site_url("/");
		//echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  .' '. get_post_permalink( $data['page_id']  ).''.$extra;
		
			if($url == $my_url)	{
			//echo get_permalink($post->post_parent);
		}else{
		//wp_redirect($url); 
		//exit; 	
				
			}
	
	}

get_header(); ?>

<div class="">
 <?php
	
	
	if($varSlideshow['onoff'] =="on"){
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
		  }
?>
		  
<div  class="widget-area" role="complementary">	<?php
	
 dynamic_sidebar( 'wordapp-mobile-sidebar-header' ); 
			?>
</div>
	
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php 
			if($data['style'] == 'list'){
			echo '<ul data-role="listview" data-inset="true">';
			}
			?>
	
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
			<?php 
			if($data['style'] == 'list'){
			echo '</ul>';
			}
			?>
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
	

	
	



	<?php
	$varGA = (array)get_option( 'WordApp_ga' );
			if(!isset($_GET['WordApp_demo'])) $_GET['WordApp_demo'] = "";
			if(!isset($varGA['powered'])) $varGA['powered'] ='';


	if($_GET['WordApp_demo'] != '1' && $varGA['powered'] != 'off'){
	?>
	<hr>
	<center><a href="https://wordpress.org/plugins/wordapp-mobile-app/" target="_blank" class="poweredBy">WordApp </a><a href="http://app-developers.biz/" target="_blank" class="poweredBy">convert wordpress to mobile app & site</a>
	</center>
	<?php
	}
	?>

</div>
<script>
	     var beforeChangeFunc = function(slider,index) {
//hide cation before the slider changes slides
$('.slide__caption').hide();
};

var afterChangeFunc = function(slider,index) {
//fades the caption in
$('.slide__caption').fadeIn('slow');
};

$('.images').slick({
    //slick options,
    dots: false,
         autoplay: true,
        infinite: true,
        slide: 'div',
        speed: 300,
    onBeforeChange: function(slider,index){
        beforeChangeFunc(index)
    },
    onAfterChange: function(slider,index){
        afterChangeFunc(index)
    },                      
});
	</script>
<?php get_footer(); ?>
