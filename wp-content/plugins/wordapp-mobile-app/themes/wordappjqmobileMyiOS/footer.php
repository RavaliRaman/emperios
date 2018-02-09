<?php

	include( dirname( __FILE__ ) . '/inc/config.php' );

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordAppjqmobile
 */

?>
<div  class="widget-area" role="complementary">	<?php

 dynamic_sidebar( 'wordapp-mobile-sidebar-footer' );
			?>
</div>
			</div>



<?php
$varMenu = (array)get_option( 'WordApp_menu' );

$varCss = (array)get_option( 'WordApp_css' );
$data = (array)get_option( 'WordApp_options' );
$varGA = (array)get_option( 'WordApp_ga' );

$varAdMob = (array) get_option('WordApp_admob');

if(!isset($varAdMob['admobActive'])) $varAdMob['admobActive'] ='';
if(!isset($varAdMob['AndroidBanner'])) $varAdMob['AndroidBanner'] ='';
if(!isset($varAdMob['AndroidInterstitial'])) $varAdMob['AndroidInterstitial'] ='';
if(!isset($varAdMob['iOSBanner'])) $varAdMob['iOSBanner'] ='';
if(!isset($varAdMob['iOSInterstitial'])) $varAdMob['iOSInterstitial'] ='';

			if(!isset($data['Title'])) $varColor['Title']='';
			if(!isset($data['Color'])) $data['Color']='';
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

 echo '<div data-role="footer" data-position="fixed"  data-tap-toggle="false">';
	if($_GET['WordApp_demo'] != '1' && $varGA['powered'] != "off"){
		?>

<?php

	}
  if($varMenu['menuBottom'] !== "" && $varMenu['bottom'] == "on" ) {
 echo '<div data-role="navbar" data-iconpos="top"><ul>';

		$menu_items = wp_get_nav_menu_items($varMenu['menuBottom']);

	$i =0;
	foreach ( (array) $menu_items as $key => $menu_item ) {


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

       <li data-filtertext="wai-aria voiceover accessibility screen reader">
							<a class="bottomBar" href="<?php echo $thedddURL; ?>" <?php echo $target; ?> data-icon="<?php echo $varMenu['bottomIcon'][$i]; ?>"><?php echo $menu_item->title; ?></a>
						</li>
     <?php
		   $i++;
    }
    echo "</ul></div>";
    }
   ?>
   </div>


			<?php wp_footer();


    	?>
		</div>



<style>
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFont']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFontHHH']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $data['ColorTextFontP']; ?>);
.bar {
    height: 71px;
    padding-top: 21px;
	 background-color: <?php echo $data['Color']; ?>;

	}
	.content {
    padding-top: 90px!important;
		padding-bottom: 90px!important;
    padding-left: 10px!important;
		padding-right: 10px!important;
	}
	.backBtn {
		margin-left:0px!important;
		padding-left: 16px!important;
    padding-right: 16px!important;
		height: 37px;
		box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.0), inset 0 2px 5px rgba(0, 0, 0, 0.0);
	}

.ui-bar-a,.ui-btn, .ui-page-theme-a .ui-bar-inherit, html .ui-bar-a .ui-bar-inherit, html .ui-body-a .ui-bar-inherit, html body .ui-group-theme-a .ui-bar-inherit {
  background-color: <?php echo $data['Color']; ?>;
  border-color: #ddd;
  color: #333;
  text-shadow: 0 1px 0 #eee;
  font-weight: 700;
  color: $txtColor!important;
}
.ui-btn {
	 background-color: <?php echo $data['Color']; ?>!important;

}
.topHeaderColored{
	 background-color: <?php echo $data['Color']; ?>!important;

}

	.ui-bar-inherit {
    background: <?php echo $data['Color']; ?>!important;
    border-color: <?php echo $data['Color']; ?>!important;
    color: #fff;
    font-weight: bold;
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
	  font-family: '<?php echo str_replace('+',' ',$data['ColorTextFontHHH']); ?>', Helvetica, Arial, serif!important;

  }

p{
  color: <?php echo $data['ColorTextP']; ?>!important;
	  font-family: '<?php echo str_replace('+',' ',$data['ColorTextFontP']); ?>', Helvetica, Arial, serif!important;

  }
.ui-content {
  border-width: 0;
  overflow: visible;
  overflow-x: hidden;
  padding: 0.3em;
}
<?php
		if(isset($varCss['css'])){
		echo $varCss['css'];
		}
	?>

</style>
<?php
if(!isset($_GET['WordApp_demo_dave']) && $_GET['WordApp_demo'] == '1'){
	?>
<script>
jQuery(document).ready(function(){

	/* DISABLE ALL CLICKS FOR DEMO */

	$('a').on('click.myDisable', function(e) {e.preventDefault(); alert('Click disabled! This is just a demo. To see the full app in action please click on the red button above.'); return false; });

	/* DISABLE ALL CLICKS FOR DEMO */

});
</script>

<?php

}
?>



<?php



$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");


if((isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app' ) ||(isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true))  {

//do something with this information
if( $iPod || $iPhone || $iPad){
$devCordova = "ios";
   //browser reported as an iPhone/iPod touch -- do something here
}
else if($Android){
$devCordova = "android";
    //browser reported as an Android device -- do something here
}
else{
$devCordova = "webOS";

}
}else{
	$devCordova = "webOS";
}

?>

<script>
var appName = "<?php echo $varGA['apiDomain']; ?>";


var admobActive = "<?php echo $varAdMob['admobActive']; ?>";
var AndroidBanner = "<?php echo $varAdMob['AndroidBanner']; ?>";
var AndroidInterstitial = "<?php echo $varAdMob['AndroidInterstitial']; ?>";
var iOSBanner = "<?php echo $varAdMob['iOSBanner']; ?>";
var iOSInterstitial = "<?php echo $varAdMob['iOSInterstitial']; ?>";
</script>
<script type="text/javascript">
if(typeof jQuery == 'undefined')
{ document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></'+'script>'); }
</script>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>




<script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/iosOverlay.js"></script>
  <script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/spin.min.js"></script>

           <script type="text/javascript" src="https://aws.app-developers.biz/cordova/<?php echo $devCordova; ?>/cordova.js?<?php echo date('Ymdhsi')?>"></script>
           <script type="text/javascript" src="https://aws.app-developers.biz/cordova/<?php echo $devCordova; ?>/js/index<?php echo ($varGA['wadebug'] == 'on' ? 'Debug' : '')?>.js?<?php echo date('Ymdhsi')?>"></script>

        <script type="text/javascript">
            app.initialize();


        </script>
        
 
<?php
if (isset($varCss['javascript'])) {
	echo '<script type="text/javascript"> ';
	echo $varCss['javascript'];
	echo '</script>';
}
?>
 
</body>
</html>
