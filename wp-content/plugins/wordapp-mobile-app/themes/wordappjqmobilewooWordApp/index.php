<?php // the index template file - the default template file WordPress uses to display content ?>

<?php
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
		wp_redirect($url); 
		exit; 	
				
			}
	
	}
?>
<?php get_header(); ?>
				
			 <?php get_template_part( 'loop' ); ?>
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>