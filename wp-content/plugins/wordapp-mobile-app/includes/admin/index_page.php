<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';


$activate = '';
$url = "http://52.27.101.150/mobrock/app/activateJson.php";
$activate = json_decode(wp_remote_retrieve_body(wp_remote_get($url)),true);
if(!isset($_REQUEST['email'])) $_REQUEST['email'] ='';
if(!isset($_GET['quick'])) $_GET['quick'] ='';
if(!isset($_GET['noThanks'])) $_GET['noThanks'] ='';
if(!isset($activate['homeVideo'])) $activate['homeVideo'] ='';
if(!isset($_REQUEST['email'])) $_REQUEST['email']='';
if(!isset($_REQUEST['activenewsletter'])) $_REQUEST['activenewsletter']='';
if(!isset($_REQUEST['mobilesite'])) $_REQUEST['mobilesite']='';


if($_GET['quick'] == "1" && $_GET['noThanks'] =="1"){
	update_option( 'wordapp_firstCreation', '1' );
}
else if($_GET['quick'] == "1"){

		$url64 = base64_encode(get_bloginfo('url'));
		$email64 = base64_encode($_REQUEST['email']);
		$newsletter = base64_encode($_REQUEST['activenewsletter']);
		echo '<img src="http://52.27.101.150/mobrock/app/activatePixel.php?user='.$email64.'&url='.$url64.'&longUrl=&news='.$newsletter.'&format=json">';

		update_option( 'wordapp_firstVisit', '1' );
		if(!isset($_REQUEST['appName'])) $_REQUEST['appName'] ='';
		if(!isset($_POST['appThemeSelected'])) $_POST['appThemeSelected'] ='';
		if(!isset($_POST['appThemeLocal'])) $_POST['appThemeLocal'] ='';
		if(!isset($_POST['appThemeLocal'])) $_POST['appThemeLocal'] ='';
		if($_POST['appThemeSelected'] == "2015") $_POST['appThemeSelected'] = '';


			if (strpos($_POST['appThemeSelected'], '|') !== false) {

			list($themeSelected, $themeType) = explode('|', sanitize_text_field($_POST['appThemeSelected']));
			
			
			}else{
				$themeSelected = $_POST['appThemeSelected'];
				$themeType ='';
			}
			if($themeSelected == 'MyiOS'){

			/* install new themes here */

			include WORDAPP_DIR.'/themes/wordappjqmobileMyiOS/install.php';

			/* end install new themes here */
		}else if($_POST['appThemeLocal'] == 'remote'){
				/* Remote themes */

				$path_temp = get_theme_root();
				$new_theme = $path_temp.'/'.sanitize_text_field($_POST['appThemeSelected']);

				if (file_exists($new_theme)) {

				}else{
					$url = urldecode(sanitize_text_field($_POST['appThemeRemoteURL']));

					$response = wp_remote_get($url);
					$zip = $response['body'];
					// Create the name of the file and the declare the directory and path
					$file_temp = WORDAPP_DIR."/zip/".sanitize_text_field($_POST['appThemeSelected']).".zip";

					// Now use the standard PHP file functions
					$fp = fopen($file_temp, "w");
					fwrite($fp, $zip);
					fclose($fp);

					WP_Filesystem();

					$unzipfile = unzip_file( $file_temp, $path_temp.'/');

					if ( $unzipfile ) {
						echo 'Theme installed successfully !';

						rename($new_theme.'-master',$new_theme);
						unlink($file_temp);
					} else {
						echo 'There was an error unzipping the app theme.';
					}
				}


				$myOptionsGet = get_option('WordApp_options');

				foreach($myOptionsGet as $option => $value) {
					//echo $option . " => " . $value . "<br />";
					$myOptions[$option] = $value;
				}
				$myOptions['theme'] = 'MyTheme';
				$myOptions['mythemeName'] = sanitize_text_field($_POST['appThemeSelected']);
				$myOptions['Color'] = '#1e73be';
				$myOptions['style'] = 'page';
				$myOptions['Title'] = sanitize_text_field($_REQUEST['appName']);
				$myOptions['appName'] = sanitize_text_field($_REQUEST['appName']);
				$myOptions['local'] = 'remote';


				update_option('WordApp_options', $myOptions);
				

			}

		else{

			$myOptionsGet = get_option('WordApp_options');
			if($myOptionsGet == ""){}
			else{
				foreach($myOptionsGet as $option => $value) {
					//echo $option . " => " . $value . "<br />";
					$myOptions[$option] = $value;
				}
			}

			if($_POST['appThemeSelected'] == 'MyTheme'){

				$theme_data = wp_get_theme();
				$themename =  $theme_data->get( 'TextDomain' );
				$myOptions['mythemeName'] = $themename;



			}
			$myOptions['appName'] = $_REQUEST['appName'];
			$myOptions['Title'] = sanitize_text_field($_REQUEST['appName']);
			$myOptions['theme'] = sanitize_text_field($_POST['appThemeSelected']);
			$myOptions['Color'] = '#1e73be';
			$myOptions['style'] = 'tiles';
			$myOptions['local'] = 'local';


			update_option('WordApp_options', $myOptions);

			$myOptions2Get = get_option('WordApp_menu');
			if($myOptions2Get == ""){}
			else{
				foreach($myOptions2Get as $option => $value) {
					//echo $option . " => " . $value . "<br />";
					$myOptions2[$option] = $value;
				}
			}

			$myOptions2['side'] = 'on';

			if($_POST['appThemeSelected'] == 'MyTheme'){
				$myOptions2['side'] = 'on';
				$myOptions2['top'] = 'on';
				$myOptions2['bottom'] = 'on';
				$myOptions2['activebars'] = 'on';
				$myOptions2['barstyle'] = 'Awesome';
				$myOptions2['activehelper'] = 'on';

			}

			update_option('WordApp_menu', $myOptions2);
			
			

			
			$myOptionsGA = get_option('WordApp_ga');
			if($myOptionsGA == ""){}
			else{
				foreach($myOptionsGA as $option => $value) {
					//echo $option . " => " . $value . "<br />";
					$myOptionsGA2[$option] = $value;
				}
			}

			
			$myOptionsGA2['mobilesite'] = $_REQUEST['mobilesite'];
			
			$myOptionsGA2['plugin_rm'][] = 'autoptimize/autoptimize.php';
			update_option('WordApp_ga', $myOptionsGA2);
		}
		update_option( 'wordapp_firstCreation', '1' );
?>

 <div class="updated" id="" style="">
			<div>
				<b><?php _e('Install successful','wordapp-mobile-app');?></b>
		 <br>
				<?php _e('Thank you for using','wordapp-mobile-app');?>
				<?php echo APPNAME_FRIENDLY; ?>,  <?php _e('we hope you enjoy using our plugin.','wordapp-mobile-app');?>
			  	 <?php _e('If you continue using','wordapp-mobile-app');?>  <?php echo APPNAME_FRIENDLY; ?>  <?php _e('you agree to our','wordapp-mobile-app');?> <a href="http://app-developers.biz/terms-conditions/" > <?php _e('terms of service.','wordapp-mobile-app');?></a>
				<br /><?php _e('Thank you for supporting our plugin.','wordapp-mobile-app');?>
				<div style="float: right;">
				<small><a href="#"><?php _e('Hide','wordapp-mobile-app');?></a> </small>
				</div>
			</div>
		</div>
<?php
	}
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Welcome to ').APPNAME_FRIENDLY; ?></span></h3>

						<div class="inside">


<div style="width:100%;height:100%;height: 400px; float: none; clear: both; margin: 2px auto;">
  <embed src="<?php echo $activate['homeVideo']; ?>?version=3&amp;hl=en_US&amp;rel=0&amp;autohide=1&amp;autoplay=0" wmode="transparent" type="application/x-shockwave-flash" width="100%" height="400px" allowfullscreen="true" title="Adobe Flash Player">
</div>
						<center>	<p><?php echo __('Welcome to ','WordApp').APPNAME_FRIENDLY.__(', Convert your wordpress site/blog in to a mobile app & mobile site within minutes','wordapp-mobile-app'); ?></p>

						<table style="width:100%;  text-align: center;">
							<tr>
								<td style="width:33%"><img src="<?php echo plugins_url(APPNAME.'/images/target.png'); ?>"><h3><?php echo __('Fast & Reliable','wordapp-mobile-app');?></h3><?php echo __('Build your mobile app within minutes. It\'s as easy as 1-2-3','wordapp-mobile-app');?></td>
								<td style="width:33%"><img src="<?php echo plugins_url(APPNAME.'/images/dev.png'); ?>"><h3><?php echo __('No programming skills.','wordapp-mobile-app');?></h3><?php echo __('No programming skills needed. You don’t need to be a computer wiz-kid to use ','WordApp').APPNAME;?></td>
								<td style="width:33%"><img src="<?php echo plugins_url(APPNAME.'/images/heart.png'); ?>"><h3><?php echo __('Our Community','wordapp-mobile-app');?></h3><?php echo __('We started as a bunch of geek and now we have an amazing app-developers.biz community.','wordapp-mobile-app');?></td>
							</tr>
							</table>
							<?php  if(get_option( 'WordApp_pro' ) == "on"):
	echo "<h1>Premium user.</h1>";
else:
	echo "<h4>".__('Invite your friends and get your android app for FREE!','wordapp-mobile-app')."</h4>";
endif;
?>
<script src="https://apis.google.com/js/platform.js"></script>

<script>
  function onYtEvent(payload) {
    if (payload.eventType == 'subscribe') {
      // Add code to handle subscribe event.
    } else if (payload.eventType == 'unsubscribe') {
      // Add code to handle unsubscribe event.
    }
    if (window.console) { // for debugging only
      window.console.log('YT event: ', payload);
    }
  }
</script>

<div class="g-ytsubscribe" data-channelid="UC7NJLsf6IonOy8QI8gt5BeA" data-layout="default" data-count="default" data-onytevent="onYtEvent"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/wordapp-mobile-app/" data-text="Convert your #wordpress site in to a mobile app with #WordApp" data-via="AppDevelopersfr" data-size="large" data-hashtags="Wordpress">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<div class="fb-share-button" data-href="https://wordpress.org/plugins/wordapp-mobile-app/" data-layout="button_count"></div>
							<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=315852465241124";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<input class="button-primary" type="button" name="send"  id="goToWordApp" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Get started now!">

							</center>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h3><span><?php echo __(
	'Quick Links'
); ?></span></h3>

						<div class="inside">
							<p>
							<ul>
								<li><a href="http://app-developers.biz/"><?php echo APPNAME_FRIENDLY ?> <?php echo __('website','wordapp-mobile-app'); ?> </a></li>
								<li><a href="https://wordapp.co/forums/"><?php echo __('Mobile Marketing Community','wordapp-mobile-app'); ?> </a></li>
								<li><a href="http://wordapp.co/blog/about/"><?php echo APPNAME_FRIENDLY ?> <?php echo __('About App Developers','wordapp-mobile-app'); ?> </a></li>
								<li><a href="https://wordapp.co/changelog/"><?php echo APPNAME_FRIENDLY ?> <?php echo __('Changelog','wordapp-mobile-app'); ?> </a></li>
								<li><a href="https://wordapp.co/status/" style="color:red;"><?php echo APPNAME_FRIENDLY ?> <?php echo __('Status App Builder','wordapp-mobile-app'); ?> </a></li>

							</ul>
							</p>

						</div>

						<!-- .inside -->

					</div>
					<!-- .postbox -->
				<div class="postbox" >

						<h3><span><?php echo __(
	'Latest News'
); ?></span></h3>

						<div class="inside">

							<div style="">
<script src="https://apis.google.com/js/platform.js"></script>

<script>
  function onYtEvent(payload) {
    if (payload.eventType == 'subscribe') {
      // Add code to handle subscribe event.
    } else if (payload.eventType == 'unsubscribe') {
      // Add code to handle unsubscribe event.
    }
    if (window.console) { // for debugging only
      window.console.log('YT event: ', payload);
    }
  }
</script>

<div class="g-ytsubscribe" data-channelid="UC7NJLsf6IonOy8QI8gt5BeA" data-layout="default" data-count="default" data-onytevent="onYtEvent"></div>

							<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/wordapp-mobile-app/" data-text="Convert your #wordpress site in to a mobile app with #WordApp" data-via="AppDevelopersfr" data-size="large" data-hashtags="Wordpress">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=315852465241124";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-page" data-href="https://www.facebook.com/AppDevelopersBiz" data-width="275" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/AppDevelopersBiz"><a href="https://www.facebook.com/AppDevelopersBiz">AppDevelopersBiz</a></blockquote></div></div>
							</div>



					</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'footer.php';
?>