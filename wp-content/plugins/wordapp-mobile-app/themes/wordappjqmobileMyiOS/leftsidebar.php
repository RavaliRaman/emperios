<?php 
	$varMenu = (array)get_option( 'WordApp_menu' );
	$data = (array)get_option( 'WordApp_options' );
    	if(!isset($varMenu['menu'])) $varMenu['menu'] ='';
		if(!isset($data['logo'])) $data['logo'] ='';

?>

<div data-role="panel" id="mypanel" data-position-fixed="false" data-display="reveal">
	 <p><img src="<?php echo esc_url($data['logo']) ?>" style="max-width:90%;padding:5px"></p>
	<div id="widget-search" class="widget widget_search"  data-role="">
			
			<?php get_search_form(); ?>
		</div>
	<?php 
if($varMenu['side'] == "on"){
	$menu_items = wp_get_nav_menu_items($varMenu['menu']);

	$menu_list = '<ul data-role="listview"  style="" class="nav-search" >';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
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