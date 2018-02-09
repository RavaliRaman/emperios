<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Push notifications','wordapp-mobile-app'); ?></span></h3>



						<div class="inside">
<?php

$varGA = (array)get_option( 'WordApp_ga' );
settings_fields( 'WordApp_main_ga' );
if(!isset($varGA['apiLogin'])) $varGA['apiLogin']='';
if(!isset($varGA['apiKey'])) $varGA['apiKey']='';
$urli = "http://52.27.101.150/mobrock/app/pn.php?login=".$varGA['apiLogin']."&apiKey=".$varGA['apiKey']."&longUrl=&format=json";
if(json_decode(wp_remote_retrieve_body(wp_remote_get($urli)))->pn == "false"){
?>
									<h2 style="text-align: center;">
										<?php echo __('Increase customer engagement thanks to push notifications !','wordapp-mobile-app'); ?>
									</h2>
							<img src="<?php echo plugins_url(APPNAME.'/images/push.png'); ?>" style="width:100%">
							<p><?php _e('Push notifications connect directly to your app\'s users. Keep them happy and engaged with app updates, promotions, and more sent directly to their device.','wordapp-mobile-app'); ?></p>

							<center><h3><?php _e('Give your app a voice thanks to push notifications','wordapp-mobile-app'); ?></h3>


<table class="widefat" width="30%" style="  width: 36%;">
	<thead>
	<tr>
		<th class="row-title"><?php echo __( 'Push Notifications','WordApp' ); ?></th>

	</tr>
	</thead>
	<tbody>
	<tr>
		<td class="row-title"><?php echo __( 'Unlimited push notifications','WordApp' ); ?></td>

	</tr>
	<tr class="alternate">
		<td class="row-title"><?php echo __( 'Schedule push notes','WordApp' ); ?></td>

	</tr>
	<tr>
		<td class="row-title"><?php echo __( 'Earn Money with Admob','WordApp' ); ?></td>

	</tr>

	<tr>
		<td class="row-title"><?php echo __( 'Mobile Website','wordapp-mobile-app'); ?></td>

	</tr>
		<tr>
		<td class="row-title"><?php echo __( 'iOS App','wordapp-mobile-app'); ?></td>

	</tr>
		<tr>
		<td class="row-title"><?php echo __( 'Android App','wordapp-mobile-app'); ?></td>

	</tr>
	</tbody>
	<tfoot>
	<tr>
		<th class="row-title" style="color:green"><center><?php echo __( 'Upgrade Today only $2.99/mo','WordApp' ); ?></center></th>

	</tr>
	</tfoot>
</table>
								<input type="hidden" name="user" id="user"  value="<?php echo get_bloginfo('url') ?>">
							<a href="./admin.php?page=WordAppGoPro" class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" ><?php _e('Activate Push Notifications','wordapp-mobile-app'); ?></a>
							</center>

							<center><h2>- OR -</h2>
							Follow me on YouTube we giveaway free Push notification credits every week.<br />
							
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
							</center>
							<?php


}else{

?>

							<p class="message_invite"><?php echo __('Simply send out a message to all your app users in one go! Fill-out the form below and press send, our servers will take care of the rest.','wordapp-mobile-app'); ?></p>

							<center>
								<h2><?php _e('Send a push notifcation','wordapp-mobile-app'); ?></h2>
								<input type="hidden" value="<?php echo $varGA['apiLogin']?>" name="apiLogin" id="apiLogin">
								<input type="hidden" value="<?php echo $varGA['apiKey']?>" name="apiKey" id="apiKey">
								<?php wp_nonce_field( 'wa_pn_nonce', 'wa_push_nonce' ); ?>

							<textarea id="txtCount" name="" cols="80" rows="10" placeholder="Your message" style="max-width:70%;"></textarea><br>
								<div><span id="counter"></span><font color="red"> <?php _e('characters left','wordapp-mobile-app'); ?></font></div>
		<p>
		<label>Schedule Sending :</label>
		<input type="text" id="datetime24" data-format="YYYY-MM-DD HH:mm" data-template="DD / MM / YYYY     HH : mm" name="datetime" value="<?php echo date('Y-m-d H:i'); ?>">
		</p>



								<input class="button-primary" type="button" id="sendPush" name="send"  style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="<?php _e('Send','wordapp-mobile-app'); ?>">
							</center>

							<?php
}
?>
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
							<p><h3><?php _e('Push notification demo','wordapp-mobile-app');?> </h3>
							 <?php
$varColor = (array) get_option('WordApp_options');
$varMenu = (array) get_option('WordApp_menu');
$varStructure = (array) get_option('WordApp_structure');

if (!isset($varColor['Title'])) {
	$varColor['Title'] = 'App Name';
}
if (!isset($varStructure['icon'])) {
	$varStructure['icon'] = '//vannes.villeetvous.com/wp-content/uploads/sites/2/2015/07/icon-76@2x.png';
}

?>


<div class="notification_text_header"><?php echo $varColor['Title']; ?></div>
<div class="notification_text_text" id="notification_text_text">Your text here....</div>
<div class="notification_text_icon"><img src="<?php echo $varStructure['icon']; ?>" width="100%"></div>

								<img src="<?php echo WORDAPP_DIR_URL; ?>/images/notification_blank.png" style="width:259px">

							</p>

<style>
.notification_text_header {
    position: absolute;
    top: 220px;
    left: 73px;
    font-size: 10px;
    font-weight: bold;
    color: #fff;
}
.notification_text_text {
    position: absolute;
    top: 235px;
    left: 74px;
    font-size: 9px;
    color: #fff;
    width: 197px;
    height: 45px;
    overflow: hidden;
}
.notification_text_icon {
    position: absolute;
    top: 225px;
    left: 45px;
    font-size: 11px;
    width: 20px;
}
</style>

<p><h3><?php _e('Get tips & tricks subscribe below','wordapp-mobile-app');?> </h3>
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