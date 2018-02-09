<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';

$active_tab ='';
if (!isset($_GET['tab'])) {
		$_GET['tab'] = '';
	}
if( isset( $_GET[ 'tab' ] ) ) {
	$active_tab = sanitize_text_field($_GET[ 'tab' ]);
}


?>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content"  style="width: 85%;">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">


						<div class="inside">


<h2 class="nav-tab-wrapper" style="padding: 1px 12px;">

    <a href="?page=WordAppCss&amp" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">CSS Editor</a>
	    <a href="?page=WordAppCss&amp;tab=javascript" class="nav-tab <?php echo $active_tab == 'javascript' ? 'nav-tab-active' : ''; ?>">JavaScript Editor</a>


</h2>

  <form method="post" action="options.php">
   <h3><?php _e('Add your own code to your app','wordapp-mobile-app');?></h3>
    <?php


$varCSS = (array)get_option( 'WordApp_css' );
settings_fields( 'WordApp_main_css' );
if(!isset($varCSS['css'])) $varCSS['css']='';
if($varCSS['css'] == ""){

	$varCSS['css'] ="/*********************************/
/* Enter your custom css here */
/*********************************/

body{

}";
}

if(!isset($varCSS['javascript'])) $varCSS['javascript']='';
if($varCSS['javascript'] == ""){

	$varCSS['javascript'] ="/*********************************/
/* Enter your jQuery & cordova code here */

/*********************************/

";
}

?>
  <textarea <?php if($_GET['tab'] == 'javascript'){ echo 'style="display:none"  id="WordApp_javascript2" '; }else{ echo ' id="WordApp_css"'; } ?>   name="WordApp_css[css]"><?php echo $varCSS['css']; ?></textarea></p>


	  <textarea <?php if($_GET['tab'] ==''){ echo 'style="display:none"  id="WordApp_css2" '; }else{ echo ' id="WordApp_css"'; }?>  name="WordApp_css[javascript]"><?php echo $varCSS['javascript']; ?></textarea></p>



   	<?php submit_button(); ?>

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
			<div id="postbox-container-1" class="postbox-container" style="width: 47%;max-width:400px;">

				<div class="meta-box-sortables">

					<div class="postbox" style="max-height: 749px;">

						<h3><span><?php echo __(
	'Preview my app','WordApp'
); ?></span></h3>
<center><small><?php echo __(
	'Clicking deactivated in demo','WordApp'
); ?></small></center>
						<div class="inside">



         	<div id="preview">


				<div class="ios-device ios-device--large ios-device--black iphone-6--large" style="max-width:350px;width: 100%;
  height: 620px">
					<div class="ios-device__screen" ><iframe width="100%" height="100%" src="<?php bloginfo('wpurl'); ?>/?WordApp_demo=1&WordApp_launch=1"></iframe></div>
</div>
				<hr><center> <input type="button" class="button button-primary" value="Preview app in mobile browser" style="display:none;" id="previewApp" > </center>
				</div>
			<div style="" id="myPreview" style=";">
				<center><h1 style="font-size: 10px;">Preview my app in mobile browser</h1>
				<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urlencode(get_bloginfo('url')) ?>&choe=UTF-8" title="" />
				<br> Scan this QR code with your mobile phone to view your app in your mobile browser.
					<hr><b>	PLEASE NOTE : You must set <u>mobile site</u> active in settings.</b>
				</center>

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
<hr>







<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'footer.php';
?>
</div>
<style>

.completed {
  color: #49b26f;
  text-decoration: line-through!important;
}
.completedNoLine {
  color: #49b26f!important;

}
	#myPreview{

		display: none!important
	}
</style>

 <script type="text/javascript">
        jQuery(document).ready(function() {
            var editor = CodeMirror.fromTextArea(document.getElementById("WordApp_css"), {
                lineNumbers: true,
                mode: "text/css",
                theme: "blackboard"
            });
            
             var editor = CodeMirror.fromTextArea(document.getElementById("WordApp_javascript"), {
               lineNumbers: true,
        matchBrackets: true,
        continueComments: "Enter",
        extraKeys: {"Ctrl-Q": "toggleComment"},
         theme: "blackboard"
            });
        })
    </script>
