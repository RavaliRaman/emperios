<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Settings ').APPNAME; ?></span></h3>

						<div class="inside">

							<form method="post" action="options.php">
<?php
$varGA = (array)get_option( 'WordApp_admob' );
settings_fields( 'WordApp_main_admob' );

if(!isset($varGA['admobActive'])) $varGA['admobActive'] ='';
if(!isset($varGA['AndroidBanner'])) $varGA['AndroidBanner'] ='';
if(!isset($varGA['AndroidInterstitial'])) $varGA['AndroidInterstitial'] ='';
if(!isset($varGA['iOSBanner'])) $varGA['iOSBanner'] ='';
if(!isset($varGA['iOSInterstitial'])) $varGA['iOSInterstitial'] ='';
if(!isset($varGA['powered'])) $varGA['powered'] ='';
if(!isset($varGA['chatHide'])) $varGA['chatHide'] ='';
if(!isset($varGA['plugin_rm'])) $varGA['plugin_rm'] ='';
if(!isset($varGA['androidURL'])) $varGA['androidURL'] ='';
if(!isset($varGA['iOSURL'])) $varGA['iOSURL'] ='';
if(!isset($varGA['wphead'])) $varGA['wphead'] ='';
if(!isset($varGA['admobType'] )) $varGA['admobType']  ='';
if(!isset($_GET['resetPages'])) $_GET['resetPages'] ='';

?>
				
				<center><img src="<?php  echo  WORDAPP_DIR_URL; ?>/images/admob-mediation.png"></center>
			<h3><?php _e('How does it work?','wordapp-mobile-app'); ?></h3>	
				
<ul>
<li><b><?php _e('Start earning money today.','wordapp-mobile-app'); ?></b> <br><?php _e('Earn money immediately! Enter your AdMob IDs below and start earning money from your app today.','wordapp-mobile-app'); ?></li>
	<li><b><?php _e('How much money can I make?','wordapp-mobile-app'); ?></b> <br><?php _e('Earnings will depend on a number of factors. The two key factors are the type of ads and the CPM of ads appearing with your app.','wordapp-mobile-app'); ?></li>
	<li><b><?php _e('What is the Ad Share?','wordapp-mobile-app'); ?></b> <br><?php _e('If you are using the free version of WordApp the earnings are shared with WordApp by rotating, your ads will show 50% of the time. If you are a premium user you will get 100% of the earnings or even turn the ads off','wordapp-mobile-app'); ?></li>
	<li><b><?php _e('Ads are not showing?','wordapp-mobile-app'); ?></b> <br><?php _e('If you have less than 100 installs, your ads may not yet show.','wordapp-mobile-app'); ?></li>

		<li><b><?php _e('Will this work for all apps?','wordapp-mobile-app'); ?></b> <br><?php _e('Yes, but if your app was generated before November 24th, 2016 you will need to update your app.','wordapp-mobile-app'); ?></li>
</ul>
		
				
				
				
				<h3><?php _e('Earn money from your app','wordapp-mobile-app'); ?></h3>

	<hr>
								  <p>

       <label for="WordApp_admob[admobActive]"><?php echo __('Ads? ','wordapp-mobile-app' ); ?></label> <input type="radio" name="WordApp_admob[admobActive]" id="admobActiveOff" value="" <?php echo ($varGA['admobActive'] == '' ? 'checked' : '')?>><?php echo __('on','wordapp-mobile-app'); ?>

<?php
if (get_option('WordApp_pro') == 'on') {

?>
		<input type="radio" name="WordApp_admob[admobActive]" id="admobActiveOn" value="offAdmob" <?php echo ($varGA['admobActive'] == 'offAdmob' ? 'checked' : '')?>><?php echo __('off','wordapp-mobile-app'); ?>
      <?php
}else{
	?>
	<font color="grey"> <?php echo __('Remove ads (PRO only)','wordapp-mobile-app'); ?>
			<a href="http://app-developers.biz/wordapp-specials/"><?php echo __('Upgrade','wordapp-mobile-app'); ?></a></font> 
	<?php
	
}
?>
			<br />   </p>
			
			<p>

       <label for="WordApp_admob[admobType]"><?php echo __('Ads Type? ','wordapp-mobile-app' ); ?></label> 
       
       <input type="radio" name="WordApp_admob[admobType]" id="admobType" value="" <?php echo ($varGA['admobType'] == '' ? 'checked' : '')?>> <?php echo __('Banners','wordapp-mobile-app'); ?>
       <input type="radio" name="WordApp_admob[admobType]" id="admobTypeOne" value="1" <?php echo ($varGA['admobType'] == '1' ? 'checked' : '')?>> <?php echo __('Interstitial','wordapp-mobile-app'); ?> 
       
       <input type="radio" name="WordApp_admob[admobType]" id="admobTypeTwo" value="2" <?php echo ($varGA['admobType'] == '2' ? 'checked' : '')?>> <?php echo __('Both','wordapp-mobile-app'); ?>

     
			<br />   </p>
	<h3><?php _e('AdMob Advertising','wordapp-mobile-app'); ?></h3>

	<hr>
	<?php echo __('Add your AdMob IDs here and earn money from your app. Get your app for free and earn money thanks to the advertising.','wordapp-mobile-app'); ?>
								
 <br/><a href="https://apps.admob.com/admob/signup" target="_blank"><?php echo __('Signup for an admob account here','wordapp-mobile-app' ); ?></a>
 	<p>  	<label for="WordApp_admob[AndroidBanner]"><?php echo __('Admob Banner - Android','wordapp-mobile-app' ); ?></label>
 	<input type="text" id="WordAppGA_GA" name="WordApp_admob[AndroidBanner]"  placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX" value="<?php echo $varGA['AndroidBanner']; ?>"/></p>

 	<p>  	<label for="WordApp_admob[AndroidInterstitial]"><?php echo __('Admob Interstitial - Android','wordapp-mobile-app' ); ?></label>
 	<input type="text" id="WordAppGA_GA" name="WordApp_admob[AndroidInterstitial]"  placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX" value="<?php echo $varGA['AndroidInterstitial']; ?>"/></p>

 	<p>  	<label for="WordApp_admob[iOSBanner]"><?php echo __('Admob Banner - iOS','wordapp-mobile-app' ); ?></label>
 	<input type="text" id="WordAppGA_GA" name="WordApp_admob[iOSBanner]"  placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX" value="<?php echo $varGA['iOSBanner']; ?>"/></p>

 	<p>  	<label for="WordApp_admob[AndroidInterstitial]"><?php echo __('Admob Interstitial - iOS','wordapp-mobile-app' ); ?></label>
 	<input type="text" id="WordAppGA_GA" name="WordApp_admob[iOSInterstitial]"  placeholder="ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX" value="<?php echo $varGA['iOSInterstitial']; ?>"/></p>


	<?php submit_button(); ?>


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


						<div class="inside">
							<p>
							 <?php include plugin_dir_path( __FILE__ ).'more_info.php'; ?>
							</p>
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

<style>
	.message_invite{
		font-family: "Open Sans","lucida grande","Segoe UI",arial,verdana,"lucida sans unicode",tahoma,sans-serif;
  		font-size: 13px;
  		color: #3d464d;
  		font-weight: normal;
		text-align: center;
	}

	</style>