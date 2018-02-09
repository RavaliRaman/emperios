<?php
update_option( 'wordapp_firstCreation', '1' );

?>
<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-1">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

<div style="" class="inside" id="hiddenModalContentClive">
					<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
					<center><h2 style="font-family:'Open Sans'"><?php _e('Our famous 3 step install','wordapp-mobile-app'); ?></h2></center>
<div class="progress">
  <div class="circle active">
    <span class="label">1</span>
    <span class="title"><?php _e('Name','wordapp-mobile-app'); ?></span>
  </div>
  <span class="bar done"></span>
  <div class="circle">
    <span class="label">2</span>
    <span class="title"><?php _e('Theme','wordapp-mobile-app'); ?></span>
  </div>
  <span class="bar half"></span>
  <div class="circle ">
    <span class="label">3</span>
    <span class="title"><?php _e('Install','wordapp-mobile-app'); ?></span>
  </div>

</div>
		<div style="width: 98%;padding-top: 3px; margin-bottom: 8px;height: 100%;overflow-x: hidden;overflow-y: scroll;">
					<form method="post" action="admin.php?page=WordApp&quick=1">
					<div style="clear:both"></div>
					<br /><center>


						<table width="90%" padding="12px" style="text-align:center">
							<tr>
								<td width="70%">


										<div id="appName">

									<h3><?php _e('Give your app a name','wordapp-mobile-app'); ?></h3>
										<input type="text" value="" id="appNameInput" name="appName"  placeholder="<?php _e('Your app name','wordapp-mobile-app'); ?>" style="width: 90%;height: 61px;font-size: 26px;text-align: center;">
											<br><br><?php _e('Only A-Z charecters.','wordapp-mobile-app'); ?>
										<br><br>	<hr>
										<p><?php _e('Note: This may overwrite any previous WordApp configurations. If you are upgrading you can click "No thanks" below.','wordapp-mobile-app'); ?></p>
											<div style="clear:both"></div>
												<br><br><br>
											<p class="submit" style="margin:5px"><a href="admin.php?page=WordApp&quick=1&noThanks=1" type="submit" name="submit" id="noThanks" class="button button-primary" value="No Thanks" style="float: left;background-color: red;">No Thanks</a>


										<input type="submit" name="submit" id="submitStepOne" class="button button-primary" value="Next step »" style="float: right;"></p>
										</div>


								<div id="appTheme" style="display:none">


									<div style="width: 98%;padding-top: 3px; margin-bottom: 8px;height: 380px;overflow-x: hidden;overflow-y: scroll;">
								<?php

//$myOptionsGet = get_option('WordApp_options');

// $request = wp_remote_get(WORDAPP_DIR_URL.'themes/themes.php');
include WORDAPP_DIR.'/themes/themes.php';


?>

	<div id="poststuff">

<div id="the-table" >
	<center><h1><?php _e('Is your site responsive?','wordapp-mobile-app');?></h1>
	<h3><?php _e('Or is your site mobile friendly?','wordapp-mobile-app');?></h3>
	</center>
<table width="100%">
	<tr>
		<td width="50%">
			<input type="submit" name="submit" id="submitStepTwoNo" class=" submitStepTwoNo button button-primary" value="<?php _e('NO','wordapp-mobile-app');?>" style="    height: 100px;width: 229px;font-size: 61px;background: red;border-color: red;margin: 20px;">

		</td>
		<td width="50%">
			<input type="submit" name="submit" id="submitStepTwoYes" class=" submitStepTwoYes button button-primary" value="<?php _e('YES','wordapp-mobile-app');?>" style="    height: 100px;width: 229px;font-size: 61px;background: green;border-color: green;margin: 20px;">


		</td>

	</tr>
	<tr>
		<td colspan="2">
			<a href="#" class="submitStepTwoNo">I'm not sure?</a>
		</td>
	</tr>
</table>

</div>
		<div id="the-list" style="display:none;">

		<?php
foreach ($data as $posta) {
	if(!isset($posta['title'])) $posta['title'] ='';
	if(!isset($posta['name'])) $posta['name'] ='';
	if(!isset($posta['thumbnail_small'])) $posta['thumbnail_small'] ='';
	if(!isset($posta['price'])) $posta['price'] ='';
	if(!isset($posta['description'])) $posta['description'] ='';
	if(!isset($posta['updated'])) $posta['updated'] ='';
	if(!isset($posta['user_url'])) $posta['user_url'] ='';
	if(!isset($posta['user_name'])) $posta['user_name'] ='';
	if(!isset($posta['compatibility'])) $posta['compatibility'] ='';
	if(!isset($posta['id'])) $posta['id'] ='';
	if(!isset($posta['local'])) $posta['local'] ='';

	if($posta['local'] != 'pro'){
?>
<div class="plugin-card plugin-card-akismet">
			<div class="plugin-card-top wordapp-theme-card-top">
				<span class="theme-icon"><img src="<?php echo $posta['thumbnail_small']; ?>"></span>


			</div>
			<div class="plugin-card-bottom">

				<div class="column-updated">
				<a href="?page=WordAppPluginsAndThemes&install=1&id=<?php echo $posta['id']; ?>" class=" install-now button install-startup"  aria-label="Install Now" data-name="<?php echo $posta['name']; ?>" data-url="<?php echo urlencode($posta['url']); ?>" data-local="<?php echo $posta['local']; ?>" id="install-<?php echo $posta['id']; ?>"><?php if($posta['local'] == 'remote'){ _e('Download & Install Now','wordapp-mobile-app');} else{ _e('Install Now','wordapp-mobile-app');} ?></a>
				</div>

				<div class="column-downloaded">
					<cite><h4 class="h4install"><?php echo $posta['title']; ?></h4></cite>
								</div>
			</div>
		</div>

<?php
	}
}
?>

			</div>
</div> <!-- .wrap -->

									</div>
									<p class="submit">
									<input name="appThemeSelected" id="appThemeSelected" value="" type="hidden">
									<input name="appThemeLocal" id="appThemeLocal" value="" type="hidden">
									<input name="appThemeRemoteURL" id="appThemeRemoteURL" value="" type="hidden">
										<a href="#"     class="cancelReturn" style="float: left;"><?php _e('Back','wordapp-mobile-app'); ?></a>
										<input type="submit" name="submit" id="submitStepTwo" class="button button-primary" value="<?php _e('Next Step','wordapp-mobile-app'); ?> »"  style="float: right;margin-right:30px"></p>
										</div>


									<div id="thirdStep" style="display:none">


										<table width="100%">
											<tr>
											<td>
												<h3><?php _e('Your information','wordapp-mobile-app'); ?></h3>
												<br>
												<p><b><?php _e('App Name','wordapp-mobile-app'); ?> :</b> <span id="nameChoosen"></span></p>
												<p><b><?php _e('Theme Chosen','wordapp-mobile-app'); ?> : <span id="themeChoosen"></span></b> </p>
												<p><b><?php _e('I would like to build : ','wordapp-mobile-app'); ?> :
												<select name="mobilesite">
													<option value="on"><?php _e('Mobile app & Mobile site','wordapp-mobile-app'); ?></option>
													<option value=""><?php _e('Mobile app only','wordapp-mobile-app'); ?></option>

												</select>
												</b> </p>

												<p class="submit">

													<input name="email" placeholder="<?php _e('Email address','wordapp-mobile-app'); ?>" style="width: 80%;height: 51px;font-size: 20px;text-align: center;"><br />
													<br>
			   										<input type="checkbox" name="activenewsletter" class="js-switch"  id="activenewsletter" value="on"  /> <b><?php _e('Recommended','wordapp-mobile-app'); ?></b> <?php _e('Receive updates via email.','wordapp-mobile-app'); ?>
													<br>
					<br /><input type="submit" name="submit" id="submit" class="button button-primary" value="- <?php _e('SUBMIT','wordapp-mobile-app'); ?> -">
												<p><?php _e('Become a reseller (Unlimited apps)','wordapp-mobile-app'); ?> <a href="https://app-developers.biz/agencies/"  target="_blank"><?php _e('More information','wordapp-mobile-app'); ?></a></p>
												<br><br>
												<p><?php _e('Please note by pressing submit you will be sending some information to the WordApp so that we can generate your app.','wordapp-mobile-app'); ?> <br /> <?php _e('What information is sent? Your Blog URL & the email address above.','wordapp-mobile-app'); ?></p>

												</td>
											<td><img src="<?php echo WORDAPP_DIR_URL; ?>/images/clive/clive1.png" /> </td>
											</tr>
										</table>
										<br />
										<a href="#" class="cancelReturn">- <?php _e('Cancel back to start','wordapp-mobile-app'); ?> - </a>
										</p>
									</div>

								</td>

							</tr>
						</table>
					</center>
</form>
</div>

</div>
</div>


				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->

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

		