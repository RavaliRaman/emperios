<div class="loadingDiv" style="width:100%;height:100%">
	<div class='containerLoading'>
  <div class='loader'>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--text'></div>
  </div>
</div>
	</div>
	
<style>
	.loadingDiv{
		position: absolute;
    width: 100%;
    height: 100%;
    background-color: white;
    z-index: 9999;
    background: #fff;
    left: 0;
    top: 0;
	}
.containerLoading {
  height: 100vh;
  width: 100vw;
  font-family: Helvetica;
}

.loader {
  height: 20px;
  width: 250px;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.loader--dot {
  animation-name: loader;
  animation-timing-function: ease-in-out;
  animation-duration: 3s;
  animation-iteration-count: infinite;
  height: 20px;
  width: 20px;
  border-radius: 100%;
  background-color: black;
  position: absolute;
  border: 2px solid white;
}
.loader--dot:first-child {
  background-color: #8cc759;
  animation-delay: 0.5s;
}
.loader--dot:nth-child(2) {
  background-color: #8c6daf;
  animation-delay: 0.4s;
}
.loader--dot:nth-child(3) {
  background-color: #ef5d74;
  animation-delay: 0.3s;
}
.loader--dot:nth-child(4) {
  background-color: #f9a74b;
  animation-delay: 0.2s;
}
.loader--dot:nth-child(5) {
  background-color: #60beeb;
  animation-delay: 0.1s;
}
.loader--dot:nth-child(6) {
  background-color: #fbef5a;
  animation-delay: 0s;
}
.loader--text {
  position: absolute;
  top: 200%;
  left: 0;
  right: 0;
  width: 4rem;
  margin: auto;
}
.loader--text:after {
  content: "";
  font-weight: bold;
  animation-name: loading-text;
  animation-duration: 3s;
  animation-iteration-count: infinite;
}

@keyframes loader {
  15% {
    transform: translateX(0);
  }
  45% {
    transform: translateX(230px);
  }
  65% {
    transform: translateX(230px);
  }
  95% {
    transform: translateX(0);
  }
}

	</style>

<div class="menu-wrap-bottom">
				<nav class="menu-bottom" style="padding: 18px;">
					
					<h1 class="topText"><center><?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="max-width: 90%;max-height: 35px;">';
}
						?></center></h1>
					<div class="" style="width:100%;overflow-y: scroll; height: 90%;" >
					<ul  class="table-view" >
					<?php
					

					$menu_items = wp_get_nav_menu_items($varMenu['menuBottom']);

							$i =0;
							foreach ( $menu_items as $key => $menu_item ) {


								if($menu_item->object == "custom"){
											$thedddURL = $menu_item->url;
											$target = 'rel="external" target="_blank"';
									 }
										else{
											$thedddURL = $menu_item->url;
											$target = "";
									 }

									 ?>

											<li class="table-view-cell"><a class="navigate-right" href="<?php echo $thedddURL; ?>" <?php echo $target; ?> >

												<?php echo $menu_item->title; ?>

												</a></li>

								 <?php
									 $i++;
								}

							?>
						
						</ul>
					</div>
			</div>
	<div class="menu-wrap">
					
				<nav class="menu" style="overflow-y: scroll; height: 99vh;" >
					<div id="" >
					
					<h1 class="topText"><center><?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="max-width: 90%;max-height: 35px;">';
}
						?></center></h1>
					<br>
					
					
	<div id="widget-search" class="widget widget_search"  data-role="">
			
			<?php get_search_form(); ?><br><br>
		</div>
	<?php 
if($varMenu['side'] == "on"){
	$menu_items = wp_get_nav_menu_items($varMenu['menu']);

	$menu_list = '<ul  class="table-view" >';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li class="table-view-cell"><a class="navigate-right" href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '</ul>';
 
echo $menu_list;
}
	?>
	<div  class="widget-area" role="complementary">	<?php
	
 dynamic_sidebar( 'wordapp-mobile-sidebar-left' ); 
			?>
</div>
		
	
					<?php 
			$varGA = (array)get_option( 'WordApp_ga' );
			if(!isset($_GET['WordApp_demo'])) $_GET['WordApp_demo'] = "";
			if(!isset($varGA['powered'])) $varGA['powered'] ='';


	if($_GET['WordApp_demo'] != '1' && $varGA['powered'] != 'off'){
	?>

	<hr>
	<center><a href="http://app-developers.biz/wordapp/" target="_blank" class="poweredBy">WordApp convert wordpress to mobile app</a>
	</center>
	<?php
	}
						?></div>
						
				</nav>
				<button class="close-button" onclick="" id="close-button">Close Menu</button>
				<div class="morph-shape" id="morph-shape" data-morph-open="M-7.312,0H15c0,0,66,113.339,66,399.5C81,664.006,15,800,15,800H-7.312V0z;M-7.312,0H100c0,0,0,113.839,0,400c0,264.506,0,400,0,400H-7.312V0z">
					<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
						<path d="M-7.312,0H0c0,0,0,113.839,0,400c0,264.506,0,400,0,400h-7.312V0z"/>
					</svg>
				</div>
			</div>
			
<script>	jQuery(document).ready(function($) {		
jQuery('.close-button').click(function(e) {
	jQuery('.menu-wrap').fadeOut();
}); 
jQuery('.iconWordAppColor').click(function(e) {
	jQuery('.menu-wrap').fadeIn();
}); 



});
</script>