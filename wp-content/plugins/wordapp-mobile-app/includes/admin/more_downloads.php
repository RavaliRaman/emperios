<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Welcome to ').APPNAME_FRIENDLY; ?></span></h3>

						<div class="inside">

							<p class="message_invite"><?php echo __('Help us keep WordApp Free!','wordapp-mobile-app');
echo '<br />'; echo __('Get your app for free by donating or inviting 8 friends','wordapp-mobile-app'); ?></p>

							<center>

								<h2><?php _e( 'Make a donation','wordapp-mobile-app');?></h2>

							<p><?php _e( 'We promise to invest every cent in to improving the plugin.','wordapp-mobile-app');?></p>
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="7YT8F3PTRL6LG">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


								<h2>Or  Invite 8 friends via email & get your app for <u>FREE</u></h2>
								<input type="hidden" name="email" id="email" value="<?php echo get_bloginfo('admin_email') ?>">
								<input type="hidden" name="url" id="url" value="<?php echo get_bloginfo('url') ?>">

								<input type="hidden" name="user" id="user" placeholder="Your Name" value="<?php echo get_bloginfo('name') ?>">
								<input type="text" name="name" id="name" placeholder="Please enter your name" value="" style="width:60%"><br>
							<textarea id="emails" name="emails" cols="80" rows="10" style="max-width:70%" placeholder="One of your friends email address per row"></textarea><br>
							<input class="button-primary" type="button" name="send" id="inviteFriends" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Send">
							<hr>
								<h2>Or  Share us with your friends & get your app for  <u>FREE</u></h2>
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