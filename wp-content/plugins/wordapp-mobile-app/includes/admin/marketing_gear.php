<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';

$varStructure = (array)get_option( 'WordApp_structure' );
if(!isset($varStructure['icon'])) $varStructure['icon']='';
if(!isset($varStructure['splash'])) $varStructure['splash']='';
if(!isset($varStructure['description'])) $varStructure['description']='';
if(!isset($varStructure['keywords'])) $varStructure['keywords']='';
if(!isset($varStructure['cat'])) $varStructure['cat']='';
$im_url = '';
$im_url = urldecode(site_url().'?wordapp_download=1');
?>


	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h3><span><?php echo __( 'Some marketing gear to help you get app downloads - ','WordApp').APPNAME_FRIENDLY; ?></span></h3>

						<div class="inside">

						<canvas id="myCanvas" width="750" height="550"></canvas>
							<p><center><small><?php _e( '* Right mouse click and save image as to download image','wordapp-mobile-app');?></small>	</center></p>
						<canvas id="myCanvas2" width="750" height="264"></canvas>
							<p><center><small><?php _e( '* Right mouse click and save image as to download image','wordapp-mobile-app');?></small>	</center></p>

						<canvas id="myCanvas3" width="400" height="400"></canvas>
							<p><center><small><?php _e( '* Right mouse click and save image as to download image','wordapp-mobile-app');?></small>	</center></p>
    <script type="text/javascript">
      var canvas = document.getElementById('myCanvas');
      var context = canvas.getContext('2d');


      var imageObj = new Image();
	  var imageObjTwo = new Image();
	  var imageObjSplash = new Image();

      imageObj.onload = function() {
        context.drawImage(imageObj, 0, 0);



      imageObjTwo.onload = function() {
        context.drawImage(imageObjTwo, 430, 120);
      };
      imageObjTwo.src = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $im_url ;?>&choe=UTF-8';


		<?php  if($varStructure['splash'] != ''): ?>
	  imageObjSplash.onload = function() {
        context.drawImage(imageObjSplash, 23, 85,212,373);
      };
      imageObjSplash.src = '<?php echo  $varStructure['splash']; ?>';
		<?php endif; ?>

		  context.drawImage(imageObj, x, y, width, height)
      };
      imageObj.src = '<?php echo WORDAPP_DIR_URL; ?>images/promo/imagePromo1.png';



		/*Image 2*/



	  var canvas2 = document.getElementById('myCanvas2');
      var context2 = canvas2.getContext('2d');


      var imageObj2 = new Image();
	  var imageObjTwo2 = new Image();
	  var imageObjSplash2 = new Image();

      imageObj2.onload = function() {
        context2.drawImage(imageObj2, 0, 0);



      imageObjTwo2.onload = function() {
        context2.drawImage(imageObjTwo2, 619, 85);
      };
      imageObjTwo2.src = 'https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=<?php echo $im_url ;?>&choe=UTF-8';


		<?php  if($varStructure['splash'] != ''): ?>
	  imageObjSplash2.onload = function() {
        context2.drawImage(imageObjSplash2, 376, 8,149,238);
      };
      imageObjSplash2.src = '<?php echo  $varStructure['splash']; ?>';
		<?php endif; ?>

		  context2.drawImage(imageObj2, x, y, width, height)
      };
      imageObj2.src = '<?php echo WORDAPP_DIR_URL; ?>images/promo/imagePromo2.png';



		/*Image 3*/



	  var canvas3 = document.getElementById('myCanvas3');
      var context3 = canvas3.getContext('2d');


      var imageObj3 = new Image();
	  var imageObjTwo3 = new Image();

      imageObj3.onload = function() {
        context3.drawImage(imageObj3, 0, 0);



      imageObjTwo3.onload = function() {
        context3.drawImage(imageObjTwo3, 105, 159);
      };
      imageObjTwo3.src = 'https://chart.googleapis.com/chart?chs=190x190&cht=qr&chl=<?php echo $im_url ;?>&choe=UTF-8';



		  context3.drawImage(imageObj3, x, y, width, height)
      };
      imageObj3.src = '<?php echo WORDAPP_DIR_URL; ?>images/promo/bigSticker.png';

    </script>

							<center>
							<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $im_url ;?>&choe=UTF-8">
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