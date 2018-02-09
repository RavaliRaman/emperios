<?php
include 'main-header.php';

?>
<body class="animsition-overlay" data-animsition-overlay="true"  ng-controller="myCtrlWordApp">
	
<div class="container">
		<?php
include 'main-menus.php';
?>
	
	 <nav class="bar bar-nav headerTop">
		 	<a class="iconWordAppColor iconWordApp menu-button" href="#" id="open-button"  style="    background-color: rgba(255, 255, 255, 0.52); padding: 6px;"><i class="wordappFA fa fa-bars fa-fw "></i></a>
     
			<h1 role="heading" class="topText title"></h1>
    </nav>
	<?php /*
    <div class="bar bar-standard bar-header-secondary">
      <form>
        <input type="search" placeholder="Search">
      </form>
    </div>
*/
	?>
<div class="content content-wrap " id="fullContent" >
	  <div id="fullContentBotom">
	  <?php
if($data['logo'] == ""){
echo get_bloginfo('name'); 
}else{
echo '<img src="'.esc_url($data['logo']).'" style="height:40px">';
}
?></center>
	</div>

	
	<div class="main-gallery js-flickity"  data-flickity-options='{ "cellAlign": "center", "contain": true, "prevNextButtons": true }' style="bottom: 10px;height: 42%;width: 100%;position: absolute; z-index: 99;">
  <div class="gallery-cell" style="width: 100%; padding: 1pc;   text-align: center;">
	<table width="99%" style="    text-align: center;"><tr>
		<?php
		if($varMenu['menuBottom'] !== "" && $varMenu['bottom'] == "on" ) {
 
	
		$menu_items = wp_get_nav_menu_items($varMenu['menuBottom']);

	$i =0;
	$u =0;
	$t =0;
	foreach ( $menu_items as $key => $menu_item ) {
   
		
		if($menu_item->object == "custom"){
        	$thedddURL = $menu_item->url;
        	//$target = 'rel="external" target="_blank"';
       }
       	else{
       		$thedddURL = $menu_item->url;
       		$target = "";
       }
		  	if(!isset($varMenu['bottomIcon'][$i])) $varMenu['bottomIcon'][$i]='';
       ?>
       <td width="33%"><br>
				 
				 <div class="icon-wrapper">	<a class="tab-item" href="<?php echo $thedddURL; ?>" <?php echo $target; ?> ><i class="fa fa-<?php echo $varMenu['bottomIcon'][$i]; ?> custom-icon"><span class="fix-editor">&nbsp;</span></i>
					 <span class="tab-label wordappFAText"><?php echo $menu_item->title; ?></span></a>
				 </div>
    		
			</td>
     <?php
		   	$i++;
				$u++;
				$t++;
			if($u == "3"){
				echo "</tr><tr>";
			}
		
		if($u == "6"){
			echo '</tr></table></div><div class="gallery-cell" style="width: 100%; padding: 1pc;   text-align: center;"><table width="60%" style="    text-align: center;"><tr>';
			$u = 0;
		}
    }
  
	}
			?>
		</tr></table>
		</div>
		
		
</div>
	  <div  class="widget-area" role="complementary">	<?php
	
 dynamic_sidebar( 'wordapp-mobile-sidebar-header' ); 
			?>
</div>
	
</div>	
<style>
	.bar-header-secondary {
    top: 54px;
}
	.headerTop{
		padding-top: 17px;
    bottom: 17px;
    margin-bottom: 45px;
		background-color:transparent!important;
	}
	.bar {
    height: 64px;
		background-color: transparent!important;
		border-color: transparent!important;
	}
	.content {
		background-color: transparent!important;
	}
	
#fullContentBotom {
    margin: auto;
    width: 100%;
    margin-top: 166px;
    height: 94px;
    padding: 20px;
    text-align: center;
    background-color: #ffffff;
	  border-top: 9px double <?php echo $data['ColorText']; ?>;
	  border-bottom: 9px double <?php echo $data['ColorText']; ?>;
}

	.content-area{  padding:5px; padding-top: 27px; padding-bottom: 27px;}
	.entry-content, .entry-summary {
    margin: 0.0em 0 0;
}
	.content {
    padding-top: 64px!important;
		 padding-bottom: 77px;
}
	
	.custom-icon {
  font-size:22px;
  background:<?php echo $data['ColorText']; ?>;
  
  padding:5px;
  -webkit-border-radius:15%;
  -moz-border-radius:15%;
  -o-border-radius:15%;
  border-radius:15%;
  border:0px solid #fff;
  color:#fff;
	box-shadow: 0 1px 10px rgba(0, 0, 0, 0.46);
  text-align:center;
  display:table-cell;
  vertical-align:middle;
  width:40px;
  height:40px;
  -moz-transition:.5s;
  -webkit-transition:.5s;
  -o-transition:.5s;
  transition:.5s;
}
.custom-icon:hover {
  background:rgba(0,0,0,0.6);
}
.fix-editor {
  display:none;
}
.icon-wrapper {
  display:inline-block;
}
	.flickity-page-dots{
		display:none;
	}
	</style>

	
	
	
	
<div  class="widget-area" role="complementary">	<?php
	
 dynamic_sidebar( 'wordapp-mobile-sidebar-footer' ); 
			?>
</div>
		</div>
	</div><!-- #content -->



<?php
wp_footer(); ?>

	
  
<style>
.iconWordAppColor{
		color: <?php echo $data['Color']; ?>;
	}
	.iconWordAppColor:visited{
		color: <?php echo $data['Color']; ?>;
	}
.wordappFA {
	font-size: 23px;
  bottom: 0px;
	}
	.wordappFAText{
		color:<?php echo $data['Color']; ?>;
  font-size: 10px;
   
	}
		.menu{
			  background-color:<?php echo $data['Color']; ?>;
				
		left:-30px;
		height:100vh;
	}
	.menu-wrap{
			  background-color:<?php echo $data['Color']; ?>!important;
		
	}
	</style>

   </div>


		</div>

<style>
	@import url(https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext);
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFont']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFontHHH']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFontP']; ?>);

	h1, h2, h3, h4, h5{
	  font-family: 'Lato', sans-serif;
  }
	.flickity-page-dots {
		bottom: 0px;
	}
	.flickity-page-dots .dot {
  width: 12px;
  height: 12px;
  opacity: 1;
  background: transparent;
  border: 2px solid <?php echo $data['Color']; ?>;
}
/* fill-in selected dot */
.flickity-page-dots .dot.is-selected {
  background: <?php echo $data['Color']; ?>;
}
	.flickity-prev-next-button {
  width: 30px;
  height: 30px;
  background: transparent!important;
		-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.flickity-prev-next-button:hover {
  background: transparent!important;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
	.flickity-prev-next-button:visited  {
  background: transparent!important;
		-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
	.flickity-prev-next-button:active  {
  background: transparent!important;
		-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
		
}
/* arrow color */
.flickity-prev-next-button .arrow {
  fill: white;
}
.flickity-prev-next-button.no-svg {
  color: white;
}
/* hide disabled button */
.flickity-prev-next-button:disabled {
  display: none;
}
.ui-bar-a,.ui-btn, .ui-page-theme-a .ui-bar-inherit, html .ui-bar-a .ui-bar-inherit, html .ui-body-a .ui-bar-inherit, html body .ui-group-theme-a .ui-bar-inherit {
  color: $txtColor!important;
}
/* Get rid of the annoying outer circle on listview alt links */
.ui-li-link-alt span.ui-btn-corner-all {
  border-style: hidden;
  -webkit-box-shadow: none;
  /* Additional browser-specific box-shadow CSS should go here */
  background: transparent;
  }
.topBtn {
  background-color: transparent!important;
  border-color: #ddd;
  color: #333;
  text-shadow: 0 1px 0 #f3f3f3border-width: 0px;
  border-width: 0px!important;
  }

  img{
  max-width:100%;
  }
  .bottomBar{
    background-color: <?php echo $data['Color']; ?>!important;
 	color: white!important;
  	text-shadow: 0 0px 0 #f3f3f3!important;
  }
  .topText{
  color: <?php echo $data['ColorText']; ?>!important;
	  font-family: '<?php echo str_replace('+',' ',$data['ColorTextFont']); ?>', Helvetica, Arial, serif!important;
  
  }
	
	
h1, h2, h3, h4, h5{
  color: <?php echo $data['ColorTextHHH']; ?>!important;
	  font-family: '<?php echo str_replace('+',' ',$data['ColorTextFontHHH']); ?>', 'Lato', sans-serif!important;
  
  }
	.entry-title{
		 font-family: 'Lato', sans-serif;
  
		text-align: center;
    background-color: #F7F7F7;
    padding: 24px;
		font-size: 27px;
    overflow: hidden;
	}
p{
  color: <?php echo $data['ColorTextP']; ?>!important;
	  font-family: '<?php echo str_replace('+',' ',$data['ColorTextFontP']); ?>', Helvetica, Arial, serif!important;
  
  }	
	
	.table-view {
     margin: 0;
}
.ui-content {
  border-width: 0;
  overflow: visible;
  overflow-x: hidden;
  padding: 0.3em;
}
	.pull-left-image-featured {
    float: left;
    width: 64px;
}
<?php 
		if(isset($varCss['css'])){
		echo $varCss['css'];
		}
	?>	
	.topText{
	top: 20px
	
}
	
</style>
<?php
include 'main-footer.php';

?>
