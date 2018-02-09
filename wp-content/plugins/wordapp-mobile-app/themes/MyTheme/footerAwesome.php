<?php

include dirname(__FILE__).'/inc/config.php';

/*
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordAppjqmobile
 */
include WORDAPP_DIR.'/includes/config.php';
?>

<div  class="widget-area" role="complementary">	<?php

dynamic_sidebar('wordapp-mobile-sidebar-footer');
?>
</div>
			</div>
			<!-- Your main site content here. -->
		</div>

<?php
$varMenu = (array) get_option('WordApp_menu');

$varCss = (array) get_option('WordApp_css');
$varColor = (array) get_option('WordApp_options');
$varGA = (array) get_option('WordApp_ga');

$varAdMob = (array) get_option('WordApp_admob');

if(!isset($varAdMob['admobActive'])) $varAdMob['admobActive'] ='';
if(!isset($varAdMob['AndroidBanner'])) $varAdMob['AndroidBanner'] ='';
if(!isset($varAdMob['AndroidInterstitial'])) $varAdMob['AndroidInterstitial'] ='';
if(!isset($varAdMob['iOSBanner'])) $varAdMob['iOSBanner'] ='';
if(!isset($varAdMob['iOSInterstitial'])) $varAdMob['iOSInterstitial'] ='';
if(!isset($varAdMob['admobType'])) $varAdMob['admobType'] ='';

if(!isset($varGA['wadebug'])) $varGA['wadebug'] ='';
if (!isset($varGA['powered'])) {
	$varGA['powered'] = '';
}

if (!isset($varColor['Title'])) {
	$varColor['Title'] = '';
}

if (!isset($varColor['Color'])) {
	$varColor['Color'] = '';
}
if (!isset($varColor['logo'])) {
	$varColor['logo'] = '';
}
if (!isset($varColor['style'])) {
	$varColor['style'] = '';
}
if (!isset($varColor['page_id'])) {
	$varColor['page_id'] = '';
}
if (!isset($varMenu['side'])) {
	$varMenu['side'] = '';
}
if (!isset($varMenu['top'])) {
	$varMenu['top'] = '';
}
if (!isset($varMenu['menu'])) {
	$varMenu['menu'] = '';
}
if (!isset($varMenu['menuTop'])) {
	$varMenu['menuTop'] = '';
}
if (!isset($varMenu['bottom'])) {
	$varMenu['bottom'] = '';
}
if (!isset($varMenu['menuBottom'])) {
	$varMenu['menuBottom'] = '';
}
if (!isset($varMenu['menuTop'])) {
	$varMenu['menuTop'] = '';
}

if(!isset ($varCss)) {
$varCss = array (
    "javascript"=>"",
    "css"=>""
);
}
if (!isset($_GET['WordApp_demo'])) {
	$_GET['WordApp_demo'] = '';
}
if (!isset($varColor['ColorText'])) {
	$varColor['ColorText'] = '#ffffff';
}
if (!isset($varColor['ColorTextHHH'])) {
	$varColor['ColorTextHHH'] = '';
}
if (!isset($varColor['ColorTextP'])) {
	$varColor['ColorTextP'] = '';
}
if (!isset($varColor['ColorTextFont'])) {
	$varColor['ColorTextFont'] = '';
}
if (!isset($varColor['ColorTextFontHHH'])) {
	$varColor['ColorTextFontHHH'] = '';
}
if (!isset($varColor['ColorTextFontP'])) {
	$varColor['ColorTextFontP'] = '';
}
if (!isset($varGA['apiDomain'])) {
	$varGA['apiDomain'] = '';
}
if (!isset($varMenu['bottomIcon'])) {
$varMenu['bottomIcon'] = '';
}

if (!isset($varGA['loadingtxt'])) {
	$varGA['loadingtxt'] = 'Loading...';
}

if(!isset($wamenu['activebars'])) $wamenu['activebars']='';
if(!isset($wamenu['top'])) $wamenu['top']='';
$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad = stripos($_SERVER['HTTP_USER_AGENT'], 'iPad');
$Android = stripos($_SERVER['HTTP_USER_AGENT'], 'Android');
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');

if ((isset($_GET['WordApp_mobile_app'])  && $_GET['WordApp_mobile_app'] === 'app') || (isset($_COOKIE['WordApp_mobile_app']) && $_COOKIE['WordApp_mobile_app'] == true)) {

	//do something with this information
	if ($iPod || $iPhone || $iPad) {
		$devCordova = 'ios';
		//browser reported as an iPhone/iPod touch -- do something here
	} elseif ($Android) {
		$devCordova = 'android';
		//browser reported as an Android device -- do something here
	} else {
		$devCordova = 'webOS';
	}
} else {
	$devCordova = 'webOS';
}

if ($_GET['WordApp_demo'] != '1' && $varGA['powered'] != 'off') {
?>
<center><a href="http://app-developers.biz/" target="_blank" class="poweredBy">WordApp convert wordpress to mobile app</a>
	</center>
<?php

}

if ($varMenu['activebars']  == 'on'):

	if ($varMenu['menuBottom'] !== '' && $varMenu['bottom'] == 'on') {
?>
	<div class="wordapp-footer">
		<ul class="ui-navbar" style="min-height: 45px;">

	<?php
		$menu_items = wp_get_nav_menu_items($varMenu['menuBottom']);

		$i = 0;
		
		foreach ((array) $menu_items as $key => $menu_item) {
			if ($menu_item->object == 'custom') {
				$thedddURL = $menu_item->url;
				$target = 'rel="external" target="_blank"';
			} else {
				$thedddURL = $menu_item->url;
				$target = '';
			}
			if (!isset($varMenu['bottomIcon'][$i])) {
			$varMenu['bottomIcon'][$i] = '';
			}

?>

       <li data-filtertext="wai-aria voiceover accessibility screen reader" class="ui-block-a">
							<a class="barColors bottomBar " href="<?php echo $thedddURL;
			?>" <?php echo $target;
			?> data-icon="<?php echo $varMenu['bottomIcon'][$i];
			?>">

								<i class="fa fa-<?php echo $varMenu['bottomIcon'][$i];?> fa-2x barColors" aria-hidden="true"></i>

								<br /><?php echo $menu_item->title;
			?></a>
						</li>
     <?php
			++$i;
			
			if($i == 4){
				break;
			}
		}
		/*

                <li data-filtertext="" class="ui-block-a">
                                        <a class="" href="http://52.27.101.150/dev/wordpress/checkout/" data-icon="shop"><img src="slidebars/3lines.png"><br />Checkout</a>
                                    </li>

                   <li data-filtertext="" class="ui-block-a">
                                        <a class="" href="http://52.27.101.150/dev/wordpress/cart/" data-icon="plus"><img src="slidebars/3lines.png"><br />Cart</a>
                                    </li>

                   <li data-filtertext="" class="ui-block-a">
                                        <a class="bottomBar ui-link ui-btn ui-icon-arrow-u-l ui-btn-icon-top" href="http://52.27.101.150/dev/wordpress/" data-icon="arrow-u-l"><img src="slidebars/3lines.png"><br />Shop</a>
                                    </li>

                   <li class="ui-block-a">
                                        <a class="bottomBar ui-link ui-btn ui-icon-search ui-btn-icon-top" href="http://52.27.101.150/dev/wordpress/visual/" data-icon="search"><img src="slidebars/3lines.png"><br />visual</a>
                                    </li>
            */
?>
     	</ul>
	</div>

	<?php

	}
endif;
?>


 <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=<?php echo $varColor['ColorTextFont']; ?>">
<style>
<?php
	
	if(!isset($varColor['background'])) $varColor['background']='';
		if(!isset($varColor['logo'])) $varColor['logo']='';
		
?>
body {
    background-image: url("<?php echo $varColor['background']; ?>");
}
@import url(https://fonts.googleapis.com/css?family=<?php echo $varColor['ColorTextFont']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $varColor['ColorTextFontHHH']; ?>);
@import url(https://fonts.googleapis.com/css?family=<?php echo $varColor['ColorTextFontP']; ?>);

.ui-bar-a,.ui-btn, .ui-page-theme-a .ui-bar-inherit, html .ui-bar-a .ui-bar-inherit, html .ui-body-a .ui-bar-inherit, html body .ui-group-theme-a .ui-bar-inherit {
  background-color: <?php echo $varColor['Color']; ?>;
  border-color: #ddd;
  color: #333;
  text-shadow: 0 1px 0 #eee;
  font-weight: 700;
  color: $txtColor!important;
}
.barColors{
	
	color: <?php echo $varColor['ColorText']; ?>!important;
  
}
.ui-btn {
	 background-color: <?php echo $varColor['Color']; ?>!important;

}
.topHeaderColored{
	 background-color: <?php echo $varColor['Color']; ?>!important;

}
.fixed-nav-bar {
	hieght:60px;
  background-color: <?php echo $varColor['Color']; ?>!important;

}

.wordapp-footer {

  background-color: <?php echo $varColor['Color']; ?>!important;

}
	.ui-bar-inherit {
    background: <?php echo $varColor['Color']; ?>!important;
    border-color: <?php echo $varColor['Color']; ?>!important;
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
    background-color: <?php echo $varColor['Color']; ?>!important;
 	
  	text-shadow: 0 0px 0 #f3f3f3!important;
  }
	.sb-slidebar.sb-active {

    z-index: 9999;
}
	.sb-slidebar * {
    -webkit-transform: translateZ( 0px );
    padding: 5px;
}
  .topText{
  color: <?php echo $varColor['ColorText']; ?>!important;
	  font-family: '<?php echo str_replace('+', ' ', $varColor['ColorTextFont']); ?>', Helvetica, Arial, serif!important;
      font-size: 1em;
    min-height: 1.1em;
    text-align: center;
    display: block;
    margin: 0 30%;
    padding: .7em 0;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    outline: 0 !important;
    position: absolute;
    left: 0;
    right: 0;
  }
h1, h2, h3, h4, h5{
  color: <?php echo $varColor['ColorTextHHH']; ?>!important;
	  font-family: '<?php echo str_replace('+', ' ', $varColor['ColorTextFontHHH']); ?>', Helvetica, Arial, serif!important;

  }

p{
  color: <?php echo $varColor['ColorTextP']; ?>!important;
	  font-family: '<?php echo str_replace('+', ' ', $varColor['ColorTextFontP']); ?>', Helvetica, Arial, serif!important;

  }
.ui-content {
  border-width: 0;
  overflow: visible;
  overflow-x: hidden;
  padding: 0.3em;
}
<?php
if (isset($varCss['css'])) {
	echo $varCss['css'];
}
?>

</style>
<script type="text/javascript">
if(typeof jQuery == 'undefined')
{ document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></'+'script>'); }
</script>

<?php
if (!isset($_GET['WordApp_demo_dave']) && $_GET['WordApp_demo'] == '1') {
?>
<script>
jQuery(document).ready(function(){

	/* DISABLE ALL CLICKS FOR DEMO */

	jQuery('a').on('click.myDisable', function(e) {e.preventDefault(); alert('Click disabled! This is just a demo. To see the full app in action please click on the red button above.');  return false; });

	/* DISABLE ALL CLICKS FOR DEMO */

});
</script>

<?php

}
?>
<script type="text/javascript" src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/slidebars/slidebars.js"></script>

<script>
			(function($) {
				$(document).ready(function() {
					$.slidebars();
				});
			}) (jQuery);
		</script>
<script>
var appName = "<?php echo $varGA['apiDomain']; ?>";


var admobActive = "<?php echo $varAdMob['admobActive']; ?>";
var AndroidBanner = "<?php echo $varAdMob['AndroidBanner']; ?>";
var AndroidInterstitial = "<?php echo $varAdMob['AndroidInterstitial']; ?>";
var iOSBanner = "<?php echo $varAdMob['iOSBanner']; ?>";
var iOSInterstitial = "<?php echo $varAdMob['iOSInterstitial']; ?>";
var admobType = "<?php echo $varAdMob['admobType']; ?>";

var loadingtxt = "<?php echo $varGA['loadingtxt']; ?>";
</script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>



<script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/iosOverlay.js"></script>
  <script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/spin.min.js"></script>

           <script type="text/javascript" src="https://aws.app-developers.biz/cordova/<?php echo $devCordova; ?>/cordova.js?<?php echo date('Ymdhsi')?>"></script>
           <script type="text/javascript" src="https://aws.app-developers.biz/cordova/<?php echo $devCordova; ?>/js/indexMyTheme<?php echo ($varGA['wadebug'] == 'on' ? 'Debug' : '')?>.js?<?php echo date('Ymdhsi')?>"></script>

        <script type="text/javascript">
            app.initialize();


        </script>
        
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
 
 <?php


if($varMenu['activehelper']  == "on"){
?>

<style type="text/css">
.menu-search{
display:none!important;
}
#header,#main-header,#main-footer{
	display:none;
}
#footer{
	display:none;
}
.header{
	display:none;
}
.footer{
	display:none;
}
.site-header{
	display:none;
}
.site-footer{
	display:none;
}
#wpadminbar{
display:none!important;
}
</style>
<?php
}
?>