<?php


if(!isset($_GET['quick'])) $_GET['quick'] ='';
if($_GET['quick'] =="1"):

	else:
?>
		   		<div style="" id="hiddenModalContentClive">
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
										<input type="text" value="" id="appNameInput" name="appName"  placeholder="Your app name" style="width: 90%;height: 61px;font-size: 26px;text-align: center;">
											<br><br><?php _e('Only A-Z charecters.','wordapp-mobile-app'); ?>
										<br><br>	<hr>
										<p><?php _e('Note: This may overwrite any previous WordApp configurations. If you are upgrading you can click "No thanks" below.','wordapp-mobile-app'); ?></p>
											<div style="clear:both"></div>
												<br><br><br>
											<p class="submit" style="margin:5px"><a href="admin.php?page=WordApp&quick=1&noThanks=1" type="submit" name="submit" id="noThanks" class="button button-primary" value="<?php _e('No Thanks','wordapp-mobile-app'); ?>" style="float: left;background-color: red;"><?php _e('No Thanks','wordapp-mobile-app'); ?></a>


										<input type="submit" name="submit" id="submitStepOne" class="button button-primary" value="<?php _e('Next step','wordapp-mobile-app'); ?> »" style="float: right;"></p>
										</div>


								<div id="appTheme" style="display:none">


									<div style="width: 98%;padding-top: 3px; margin-bottom: 8px;height: 380px;overflow-x: hidden;overflow-y: scroll;">
								<?php
$request = wp_remote_get(WORDAPP_DIR_URL.'themes/themes.php');

$postas = json_decode(wp_remote_retrieve_body( $request ),true);

?>

	<div id="poststuff">

		<div id="the-list">

		<?php
foreach ($postas as $posta) {
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
?>
<div class="plugin-card plugin-card-akismet">
			<div class="plugin-card-top wordapp-theme-card-top">
				<span class="theme-icon"><img src="<?php echo WORDAPP_DIR_URL; ?>/themes/<?php echo $posta['thumbnail_small']; ?>"></span>


			</div>
			<div class="plugin-card-bottom">

				<div class="column-updated">
				<a href="?page=WordAppPluginsAndThemes&install=1&id=<?php echo $posta['id']; ?>" class=" install-now button install-startup"  aria-label="Install Now" data-name="<?php echo $posta['name']; ?>" id="install-<?php echo $posta['id']; ?>"><?php _e('Install Now','wordapp-mobile-app'); ?></a>
				</div>

				<div class="column-downloaded">
					<cite><h4 class="h4install"><?php echo $posta['title']; ?></h4></cite>
								</div>
			</div>
		</div>

<?php
}
?>

			</div>
</div> <!-- .wrap -->

									</div>
									<p class="submit">
									<input name="appThemeSelected" id="appThemeSelected" value="" type="hidden">
										<a href="#"     class="cancelReturn" style="float: left;"><?php _e('Back','wordapp-mobile-app'); ?></a>
										<input type="submit" name="submit" id="submitStepTwo" class="button button-primary" value="<?php _e('Next step','wordapp-mobile-app'); ?> »"  style="float: right;margin-right:30px"></p>
										</div>


									<div id="thirdStep" style="display:none">


										<table width="100%">
											<tr>
											<td>
												<h3><?php _e('Your information','wordapp-mobile-app'); ?></h3>
												<br>
												<p><b><?php _e('App Name','wordapp-mobile-app'); ?> :</b> <span id="nameChoosen"></span></p>
												<p><b><?php _e('Theme Chosen','wordapp-mobile-app'); ?> : <span id="themeChoosen"></span></b> </p>
												<p class="submit"> <input type="submit" name="submit" id="submit" class="button button-primary" value="- <?php _e('SUBMIT','wordapp-mobile-app'); ?> -">
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
<br><br>
<br><br><br><br><br><br><br>
</div>

		   <style>
		   #hiddenModalContentClive{
			display: none!important
			}
			</style>
		   <script type='text/javascript'>
   						window.onload=function(){tb_show("Start building your app WordApp", "#TB_inline?inlineId=hiddenModalContentClive&height=750&width=790&modal=false", false);
						     document.getElementById("appName").focus();
												 //$("#TB_window").width('440px');

						   }
			</script>
	<?php
endif;
?>	