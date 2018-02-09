<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';

?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Beacons','WordApp' ); ?></span></h3>

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
										<?php echo __('Increase customer engagement thanks to push notifications !'); ?>
									</h2>
							<img src="<?php echo plugins_url(APPNAME.'/images/push.png'); ?>" style="width:100%">
							<p><?php _e('Push notifications connect directly to your app\'s users. Keep them happy and engaged with app updates, promotions, and more sent directly to their device.','wordapp-mobile-app');?></p>

							<center><h3><?php _e('Give your app a voice thanks to push notifications','wordapp-mobile-app');?></h3>


<table class="widefat" width="30%" style="  width: 36%;">
	<thead>
	<tr>
		<th class="row-title"><?php echo __( 'Push Notifications' ,'wordapp-mobile-app'); ?></th>

	</tr>
	</thead>
	<tbody>
	<tr>
		<td class="row-title"><?php echo __( 'Unlimited push notifications' ,'wordapp-mobile-app'); ?></td>

	</tr>

	<tr>
		<td class="row-title"><?php echo __( 'HTML Rich windows','WordApp' ); ?></td>

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
							<?php

}
else{
?>


							<form method="post" action="options.php">
    <?php
	$variBeacon = (array)get_option( 'WordApp_ibeacon' );
	settings_fields( 'WordApp_main_ibeacon' );


?>

			<img src="<?php echo plugins_url(APPNAME.'/images/ibeacon-logo-small.png'); ?>">
	<hr>

	<table width="80%">
		<tr>
			<th><?php echo __( 'Active','WordApp' ); ?></th>
			<th><?php echo __( 'Beacon UUID','WordApp' ); ?></th>
			<th><?php echo __( 'Minor','WordApp' ); ?></th>
			<th><?php echo __( 'Major','WordApp' ); ?></th>
			<th><?php echo __( 'Message','WordApp' ); ?></th>
		</tr>
		<?php

	if(!isset($variBeacon['ACTIVE-1'])) $variBeacon['ACTIVE-1']='';
	if(!isset($variBeacon['ACTIVE-2'])) $variBeacon['ACTIVE-2']='';
	if(!isset($variBeacon['ACTIVE-3'])) $variBeacon['ACTIVE-3']='';
	if(!isset($variBeacon['ACTIVE-4'])) $variBeacon['ACTIVE-4']='';
	if(!isset($variBeacon['ACTIVE-5'])) $variBeacon['ACTIVE-5']='';
	if(!isset($variBeacon['ACTIVE-6'])) $variBeacon['ACTIVE-6']='';
	if(!isset($variBeacon['ACTIVE-7'])) $variBeacon['ACTIVE-7']='';
	if(!isset($variBeacon['ACTIVE-8'])) $variBeacon['ACTIVE-8']='';
	if(!isset($variBeacon['ACTIVE-9'])) $variBeacon['ACTIVE-9']='';
	if(!isset($variBeacon['ACTIVE-10'])) $variBeacon['ACTIVE-10']='';

	if(!isset($variBeacon['UUID-1'])) $variBeacon['UUID-1']='';
	if(!isset($variBeacon['UUID-2'])) $variBeacon['UUID-2']='';
	if(!isset($variBeacon['UUID-3'])) $variBeacon['UUID-3']='';
	if(!isset($variBeacon['UUID-4'])) $variBeacon['UUID-4']='';
	if(!isset($variBeacon['UUID-5'])) $variBeacon['UUID-5']='';
	if(!isset($variBeacon['UUID-6'])) $variBeacon['UUID-6']='';
	if(!isset($variBeacon['UUID-7'])) $variBeacon['UUID-7']='';
	if(!isset($variBeacon['UUID-8'])) $variBeacon['UUID-8']='';
	if(!isset($variBeacon['UUID-9'])) $variBeacon['UUID-9']='';
	if(!isset($variBeacon['UUID-10'])) $variBeacon['UUID-10']='';

	if(!isset($variBeacon['MINOR-1'])) $variBeacon['MINOR-1']='';
	if(!isset($variBeacon['MINOR-2'])) $variBeacon['MINOR-2']='';
	if(!isset($variBeacon['MINOR-3'])) $variBeacon['MINOR-3']='';
	if(!isset($variBeacon['MINOR-4'])) $variBeacon['MINOR-4']='';
	if(!isset($variBeacon['MINOR-5'])) $variBeacon['MINOR-5']='';
	if(!isset($variBeacon['MINOR-6'])) $variBeacon['MINOR-6']='';
	if(!isset($variBeacon['MINOR-7'])) $variBeacon['MINOR-7']='';
	if(!isset($variBeacon['MINOR-8'])) $variBeacon['MINOR-8']='';
	if(!isset($variBeacon['MINOR-9'])) $variBeacon['MINOR-9']='';
	if(!isset($variBeacon['MINOR-10'])) $variBeacon['MINOR-10']='';


	if(!isset($variBeacon['MAJOR-1'])) $variBeacon['MAJOR-1']='';
	if(!isset($variBeacon['MAJOR-2'])) $variBeacon['MAJOR-2']='';
	if(!isset($variBeacon['MAJOR-3'])) $variBeacon['MAJOR-3']='';
	if(!isset($variBeacon['MAJOR-4'])) $variBeacon['MAJOR-4']='';
	if(!isset($variBeacon['MAJOR-5'])) $variBeacon['MAJOR-5']='';
	if(!isset($variBeacon['MAJOR-6'])) $variBeacon['MAJOR-6']='';
	if(!isset($variBeacon['MAJOR-7'])) $variBeacon['MAJOR-7']='';
	if(!isset($variBeacon['MAJOR-8'])) $variBeacon['MAJOR-8']='';
	if(!isset($variBeacon['MAJOR-9'])) $variBeacon['MAJOR-9']='';
	if(!isset($variBeacon['MAJOR-10'])) $variBeacon['MAJOR-10']='';

	if(!isset($variBeacon['MESSAGE-1'])) $variBeacon['MESSAGE-1']='';
	if(!isset($variBeacon['MESSAGE-2'])) $variBeacon['MESSAGE-2']='';
	if(!isset($variBeacon['MESSAGE-3'])) $variBeacon['MESSAGE-3']='';
	if(!isset($variBeacon['MESSAGE-4'])) $variBeacon['MESSAGE-4']='';
	if(!isset($variBeacon['MESSAGE-5'])) $variBeacon['MESSAGE-5']='';
	if(!isset($variBeacon['MESSAGE-6'])) $variBeacon['MESSAGE-6']='';
	if(!isset($variBeacon['MESSAGE-7'])) $variBeacon['MESSAGE-7']='';
	if(!isset($variBeacon['MESSAGE-8'])) $variBeacon['MESSAGE-8']='';
	if(!isset($variBeacon['MESSAGE-9'])) $variBeacon['MESSAGE-9']='';
	if(!isset($variBeacon['MESSAGE-10'])) $variBeacon['MESSAGE-10']='';

?>
			<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-1]"  <?php echo ($variBeacon['ACTIVE-1'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-1]"  value="<?php echo $variBeacon['UUID-1']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-1]"  value="<?php echo $variBeacon['MINOR-1']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-1]"  value="<?php echo $variBeacon['MAJOR-1']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-1]"  value="<?php echo $variBeacon['MESSAGE-1']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-2]"  <?php echo ($variBeacon['ACTIVE-2'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-2]"  value="<?php echo $variBeacon['UUID-2']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-2]"  value="<?php echo $variBeacon['MINOR-2']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-2]"  value="<?php echo $variBeacon['MAJOR-2']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-2]"  value="<?php echo $variBeacon['MESSAGE-2']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-3]"  <?php echo ($variBeacon['ACTIVE-3'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-3]"  value="<?php echo $variBeacon['UUID-3']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-3]"  value="<?php echo $variBeacon['MINOR-3']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-3]"  value="<?php echo $variBeacon['MAJOR-3']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-3]"  value="<?php echo $variBeacon['MESSAGE-3']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-4]"  <?php echo ($variBeacon['ACTIVE-4'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-4]"  value="<?php echo $variBeacon['UUID-4']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-4]"  value="<?php echo $variBeacon['MINOR-4']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-4]"  value="<?php echo $variBeacon['MAJOR-4']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-4]"  value="<?php echo $variBeacon['MESSAGE-4']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-5]"  <?php echo ($variBeacon['ACTIVE-5'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-5]"  value="<?php echo $variBeacon['UUID-5']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-5]"  value="<?php echo $variBeacon['MINOR-5']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-5]"  value="<?php echo $variBeacon['MAJOR-5']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-5]"  value="<?php echo $variBeacon['MESSAGE-5']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-6]"  <?php echo ($variBeacon['ACTIVE-6'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-6]"  value="<?php echo $variBeacon['UUID-6']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-6]"  value="<?php echo $variBeacon['MINOR-6']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-6]"  value="<?php echo $variBeacon['MAJOR-6']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-6]"  value="<?php echo $variBeacon['MESSAGE-6']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-7]"  <?php echo ($variBeacon['ACTIVE-7'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-7]"  value="<?php echo $variBeacon['UUID-7']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-7]"  value="<?php echo $variBeacon['MINOR-7']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-7]"  value="<?php echo $variBeacon['MAJOR-7']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-7]"  value="<?php echo $variBeacon['MESSAGE-7']; ?>"/></td>
		</tr>
		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-8]"  <?php echo ($variBeacon['ACTIVE-8'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-8]"  value="<?php echo $variBeacon['UUID-8']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-8]"  value="<?php echo $variBeacon['MINOR-8']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-8]"  value="<?php echo $variBeacon['MAJOR-8']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-8]"  value="<?php echo $variBeacon['MESSAGE-8']; ?>"/></td>
		</tr>

		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-9]"  <?php echo ($variBeacon['ACTIVE-9'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-9]"  value="<?php echo $variBeacon['UUID-9']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-9]"  value="<?php echo $variBeacon['MINOR-9']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-9]"  value="<?php echo $variBeacon['MAJOR-9']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-9]"  value="<?php echo $variBeacon['MESSAGE-9']; ?>"/></td>
		</tr>

		<tr>
				<td><center><input type="checkbox" value="on" name="WordApp_ibeacon[ACTIVE-10]"  <?php echo ($variBeacon['ACTIVE-10'] == 'on' ? 'checked' : '')?> ></center></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[UUID-10]"  value="<?php echo $variBeacon['UUID-10']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MINOR-10]"  value="<?php echo $variBeacon['MINOR-10']; ?>"/></td>
				<td><input type="text" style="width:40px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MAJOR-10]"  value="<?php echo $variBeacon['MAJOR-10']; ?>"/></td>
				<td><input type="text"  style="width:290px" id="WordAppGA_iBeacon" name="WordApp_ibeacon[MESSAGE-10]"  value="<?php echo $variBeacon['MESSAGE-10']; ?>"/></td>
		</tr>
								</table>
	<?php submit_button(); ?>
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