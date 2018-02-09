<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'The Community ','WordApp').APPNAME_FRIENDLY; ?></span></h3>

						<div class="inside">
							<h2 style="text-align: center;">
							<?php echo __('Become part of a growing mobile marketing community!','wordapp-mobile-app'); ?>
							</h2>
							<p class="message_invite"><?php echo __('Built in 2015 ','WordApp').APPNAME_FRIENDLY.__(' was a project lead by a group of mobile & wordpress geeks. We love mobile and the way apps are improving our lives. This is where we thought we could help. By offering a <b><u>FREE</u></b> wordpress plugin that will convert your site/blog in to a beautiful mobile app. A community of enthusiastic people followed the plugin & encouraged us to share our mobile marketing knowledge in a forum.','wordapp-mobile-app'); ?></p>

							<center>
								<hr>

								<table style="width:100%;text-align:center"><tr>
									<td><h3><?php _e('Help us grow','wordapp-mobile-app'); ?></h3>


										<?php _e('Here are a few free resources :','wordapp-mobile-app'); ?>
										<ul>
											<li><a href="https://www.youtube.com/channel/UCmUo6cRgYfXJhSDLoX3Rueg"><?php _e('Mobile Marketing Videos','wordapp-mobile-app'); ?></a></li>
											<li><a href="https://www.facebook.com/groups/515530875261456/"><?php _e('Mobile Marketing Facebook Group','wordapp-mobile-app'); ?></a></li>
											<li><a href="https://www.facebook.com/WordAppMobileApp"><?php _e('Facebook Page','wordapp-mobile-app'); ?></a></li>

											</td></tr><tr>
									<td><h3><?php _e('Help us grow','wordapp-mobile-app'); ?></h3>

										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick">
										<input type="hidden" name="hosted_button_id" value="4F5HBJR699H8J">
										<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
										<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</form>
										<p class="message_invite"><?php _e('Thanks to the amazing support of our friends, family & followers we are really proud of WordApp.','wordapp-mobile-app'); ?>

										<br / >
										<?php _e('If you believe in WordApp the are many ways you can get involved :','wordapp-mobile-app'); ?>
										<ul>
											<li><?php _e('Tell your friends & family','wordapp-mobile-app'); ?></li>
											<li><?php _e('Share the love on Facebook & Twitter','wordapp-mobile-app'); ?></li>
											<li><?php _e('Write a plugin or theme for the marketplace','wordapp-mobile-app'); ?></li>
											<li><?php _e('Make a donation','wordapp-mobile-app'); ?></li>
										</ul>
										<center><u><b>- <?php _e('Thanks for all your help','wordapp-mobile-app'); ?> -</b></u></center>
										</p>

										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="4F5HBJR699H8J">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

									</td>
									</tr>
								</table>
							<input class="button-primary" id="goCommunity" type="button" name="send"  style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value=" - <?php _e('Join the free community !','wordapp-mobile-app'); ?> - ">
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