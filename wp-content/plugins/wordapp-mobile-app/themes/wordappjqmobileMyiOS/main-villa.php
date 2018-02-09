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
echo '<img src="'.esc_url($data['logo']).'" style="height:40px;max-width:170px">';
}
?></center>
	</div>

	
	<div class="gallery-cell" style="width: 100%;
    padding: 1pc;
    text-align: center;
    position: absolute;
    bottom: 31px;">
	<table width="50%"  cellspacing="1" cellpadding="1" style=" float: right;
    bottom: 90px;
    position: absolute;
    right: 0px;   border-spacing: 2px;border-collapse: separate;"><tr>
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
       <td width="100%"><br>
				 
				 <div class="icon-wrapper">
					 
					 <a class="tab-item" href="<?php echo $thedddURL; ?>" <?php echo $target; ?> >
					 
					 <table width="100%">
						 <tr>
							 
						<td  ><span class="tab-label wordappFAText"><?php echo $menu_item->title; ?></span></td>
						 <td width="25%" style="align-content:center"><center><i class="fa fa-<?php echo $varMenu['bottomIcon'][$i]; ?> custom-icon" style="vertical-align: middle;"><span class="fix-editor">&nbsp;</span></i></center></td>
						
						 </tr>
						 
					 </table>
					 </a>
				 </div>
    		
			</td>
     <?php
		   	$i++;
				$u++;
				$t++;
					echo "</tr><tr>";
		
		
		if($u == "5"){
			echo '';
			$u = 0;
			break;
		}
    }
  
	}
			?>
		</tr></table>
	
		
		
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
		position: fixed;
    top: 0px;
    margin: auto;
    width: 100%;
    margin-top: 0px;
    height: 74px;
    padding: 20px;
    text-align: center;
    background: <?php echo $data['Color']; ?>;
    z-index: 2;
	opacity: 0.6;
	
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
	font-size: 25x;
  padding:5px;
 	color:<?php echo $data['ColorText']; ?>;
	background:#fff;
  text-align:center;
  display:table-cell;
  border-radius:50px;
  width:30px;
  height:30px;

}
.icon-wrapper:hover {
  background:rgba(0,0,0,0.6);
}
.fix-editor {
  display:none;
}
.icon-wrapper {
		background:<?php echo $data['ColorText']; ?>;
  	display:inline-block;
	  border: 0px solid #ccc; 
   	width:100%;
    margin-bottom: -14px;
		overflow:hidden;
	  padding: 3px;
    opacity: .6;
    height: 40px;
	 text-align: left;
	border-radius:0px;
	
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
  font-size: 15px!important;
    color:#fff!important;
		text-align: left;
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
