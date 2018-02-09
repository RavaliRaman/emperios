<?php

$varCss = (array)get_option( 'WordApp_css' );
		if(!isset($varCss['css'])) $varCss['css']='';
?>
<style>
	<?php
			echo $varCss['css'];
	?>
	</style>
<script>
jQuery(document).ready(function(){
    jQuery(".loadingDiv").remove();
});
</script>
<style>
	body {
  background: url(<?php echo $data['background']; ?>?1) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.wordappFAText{
	color:<?php echo $data['ColorText']; ?>;
  font-size: 10px;
   }
	.iconWordAppColor{
		color: <?php echo $data['ColorText']; ?>;
	}
	.iconWordAppColor:visited{
		color: <?php echo $data['ColorText']; ?>;
	}
	.bar{
			background-color: <?php echo $data['Color']; ?>;
	}
	.menu{ left: 0px;}
</style>
		<script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/classie.js"></script>
		<script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/main4.js"></script>
		<script src="<?php echo WORDAPP_DIR_URL ; ?>/themes/wordappjqmobileMyiOS/js/main.js"></script>

<?php

if(!isset($varGA['apiDomain'])) $varGA['apiDomain']='';
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

</script>

	<script type="text/javascript">
if(typeof jQuery == 'undefined')
{ document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></'+'script>'); }
</script>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>



<script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/iosOverlay.js"></script>
  <script src="<?php echo  WORDAPP_DIR_URL; ?>themes/MyTheme/js/spin.min.js"></script>

           <script type="text/javascript" src="https://s3.amazonaws.com/cordovajs/ng-cordova/cordova/<?php echo $devCordova; ?>/cordova.js?<?php echo date('Ymdhsi')?>"></script>
           <script type="text/javascript" src="https://s3.amazonaws.com/cordovajs/ng-cordova/cordova/<?php echo $devCordova; ?>/js/index.js?<?php echo date('Ymdhsi')?>"></script>

        <script type="text/javascript">
            app.initialize();


        </script>

</body>
</html>
