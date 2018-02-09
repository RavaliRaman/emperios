<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';

if ( function_exists( 'wp_get_themes' ) )
	$get_themesone = wp_get_themes();
else
	$get_themesone = get_themes();



if(!isset($_GET['quickTheme'])) $_GET['quickTheme'] ='';
if(!isset($_GET['noThanks'])) $_GET['noThanks'] ='';

if($_GET['quickTheme'] == "1"){

	//update_option( 'wordapp_firstVisit', '1' );
	if(!isset($_GET['appThemeSelected'])) $_GET['appThemeSelected'] ='';
	if($_GET['appThemeSelected'] == "2015") $_GET['appThemeSelected'] = '';


	//list($themeSelected, $themeType)=explode('|', $_GET['appThemeSelected']);
	
	if (strpos($_GET['appThemeSelected'], '|') !== false) {
			list($themeSelected, $themeType) = explode('|',$_GET['appThemeSelected']);
		}else{
			$themeSelected = $_GET['appThemeSelected'];
			$themeType ='';
		}

	if($themeSelected == 'MyiOS'){

		/* install new themes here */

		include WORDAPP_DIR.'/themes/wordappjqmobileMyiOS/install.php';

		/* end install new themes here */
	}
	elseif($themeSelected == 'MyThemed'){

		/* install new themes here */

		if($_GET['remote'] == '1'){
			$myOptions['local'] = 'remote';

			$path_temp = get_theme_root();
			$new_theme = $path_temp.'/'.$_GET['appThemeSelect'];

			if (file_exists($new_theme)) {

			}else{
				$url = urldecode($_GET['url']);

				$response = wp_remote_get($url);
				$zip = $response['body'];
				// Create the name of the file and the declare the directory and path
				$file_temp = WORDAPP_DIR."/zip/".$_GET['appThemeSelect'].".zip";

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
		}else{
			$myOptions['local'] = 'local';

		}

		$myOptionsGet = get_option('WordApp_options');

		foreach($myOptionsGet as $option => $value) {
			//echo $option . " => " . $value . "<br />";
			$myOptions[$option] = $value;
		}
		$myOptions['theme'] = 'MyTheme';
		$myOptions['mythemeName'] = $_GET['appThemeSelect'];
		$myOptions['Color'] = '#1e73be';
		$myOptions['style'] = 'page';


		update_option('WordApp_options', $myOptions);

		/* end install new themes here */
	}
	else{


		$myOptionsGet = get_option('WordApp_options');

		foreach($myOptionsGet as $option => $value) {
			//echo $option . " => " . $value . "<br />";
			$myOptions[$option] = $value;
		}
		if($_GET['appThemeSelected'] == 'MyTheme'){

			$theme_data = wp_get_theme();
			$themename =  $theme_data->get( 'TextDomain' );
			$myOptions['mythemeName'] = $themename;

		}
		$myOptions['theme'] = $_GET['appThemeSelected'];
		$myOptions['Color'] = '#1e73be';
		$myOptions['style'] = 'tiles';

		$myOptions['local'] = 'local';


		update_option('WordApp_options', $myOptions);

		$myOptions2Get = get_option('WordApp_menu');

		foreach($myOptions2Get as $option => $value) {
			//echo $option . " => " . $value . "<br />";
			$myOptions2[$option] = $value;
		}

		$myOptions2['side'] = 'on';

		if($_GET['appThemeSelected'] == 'MyTheme'){
			$myOptions2['side'] = 'on';
			$myOptions2['top'] = 'on';
			$myOptions2['bottom'] = 'on';
			$myOptions2['activebars'] = 'on';
			$myOptions2['barstyle'] = 'Awesome';
			$myOptions2['activehelper'] = 'on';

		}

		update_option('WordApp_menu', $myOptions2);
	}


?>
 <div >

				<b><?php _e('Install successful','wordapp-mobile-app');?></b>
		 <br>
				<?php _e('Thank you for using','wordapp-mobile-app');?>
				<?php echo APPNAME_FRIENDLY; ?>,  <?php _e('we hope you enjoy using our plugin.','wordapp-mobile-app');?>
			  	 <?php _e('If you continue using','wordapp-mobile-app');?>  <?php echo APPNAME_FRIENDLY; ?>  <?php _e('you agree to our','wordapp-mobile-app');?> <a href="http://app-developers.biz/terms-conditions/" > <?php _e('terms of service.','wordapp-mobile-app');?></a>
				<br /><?php _e('Thank you for supporting our plugin.','wordapp-mobile-app');?>
				<div style="float: right;">
				<small><a href="#"><?php _e('Hide','wordapp-mobile-app');?></a> </small>

			</div>

<?php
}


?>
	<div id="poststuff">

		<div id="the-list">
			<?php
if(isset($_GET['install']) && $_GET['install'] == '1'){
	$id = $_GET['id'];
	$my_post = array(
		'post_title'    => $postas[$id]['title'],
		'post_type'    => 'wordapp_plugins',
		'post_content'  =>  $postas[$id]['content'],
		'post_status'   => 'publish'
	);
	wp_insert_post( $my_post );
}
?>
		<?php

$myOptionsGet = get_option('WordApp_options');

// $request = wp_remote_get(WORDAPP_DIR_URL.'themes/themes.php');
include WORDAPP_DIR.'/themes/themes.php';


//$postas = json_decode($dataThemes);
if(empty($data)){
	$data['nothing'] = true;
}
?>

	<div id="poststuff">
			<div style="clear:both">
			<hr>
			<h1><a href="https://app-developers.biz/wordapp-themes/" target="_blank"><?php _e('GET MORE THEMES','wordapp-mobile-app'); ?></a></h1>
			<hr>
			</div>
		<div id="the-list">

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
	if(!isset($myOptionsGet['theme'])) $myOptionsGet['theme'] ='2015';
?>
<div class="plugin-card plugin-card-akismet" style=" max-width: 372px;">
			<div class="plugin-card-top wordapp-theme-card-top">
				<span class="theme-icon"><img src="<?php echo $posta['thumbnail_small']; ?>"></span>


			</div>
			<div class="plugin-card-bottom">

				<div class="column-updated">
				<?php
	if($myOptionsGet['theme'] == $posta['name']){ echo "Installed"; }
	else{
		if($posta['local'] == 'local'){
?>
					<a href="?page=WordAppPluginsAndThemes&quickTheme=1&appThemeSelected=<?php echo $posta['name']; ?>" class=" install-now button"  aria-label="Install Now" data-name="<?php echo $posta['name']; ?>" id="install-<?php echo $posta['id']; ?>">Install Now </a>
					<?php

		}
		elseif($posta['local'] == 'pro'){
?>
					<a href="<?php echo $posta['url']; ?>" target='_blank' class=" install-now button"  aria-label="Install Now" data-name="<?php echo $posta['name']; ?>" id="install-<?php echo $posta['id']; ?>">More Details </a>
					<?php

		}else{




			if ( ! empty( $get_themesone ) && is_array( $get_themesone ) ) {

				if (array_key_exists($posta['name'], $get_themesone)) {

					if($myOptionsGet['mythemeName'] == $posta['name'] && $myOptionsGet['theme'] == 'MyTheme'){ echo "Installed"; }
					else{
?>
				      <a href="?page=WordAppPluginsAndThemes&quickTheme=1&appThemeSelected=MyThemed&appThemeSelect=<?php echo $posta['name']; ?>" class=" install-now button"  aria-label="Install Now" data-name="<?php echo $posta['name']; ?>" id="install-<?php echo $posta['id']; ?>">Install Now</a>
				      <?php

					}
				}else{

?>
				    		<a href="?page=WordAppPluginsAndThemes&quickTheme=1&appThemeSelected=MyThemed&appThemeSelect=<?php echo $posta['name']; ?>&remote=1&url=<?php echo urlencode($posta['url']); ?>" class=" install-now button"  aria-label="Download theme" data-name="<?php echo $posta['name']; ?>" id="install-<?php echo $posta['id']; ?>">Download & Install Theme</a>
				    	<?php


				}


			}




		} }
?>
				</div>

				<div class="column-downloaded">
					<cite><h4 class="h4install"><?php echo $posta['title']; ?></h4></cite>
								</div>
			</div>
		</div>

<?php
}
?>
			<div style="clear:both">
			<hr>
			<h1><a href="https://app-developers.biz/wordapp-themes/" target="_blank"><?php _e('GET MORE THEMES','wordapp-mobile-app'); ?></a></h1>
			<hr>
			</div>


						<div style="clear:both">

			<hr>
			<h1><?php _e('USE ONE OF YOUR WORDPRESS THEMES','wordapp-mobile-app'); ?></h1>
			<hr>
			</div>
			<?php


if ( function_exists( 'wp_get_themes' ) )
	$get_themes = wp_get_themes();
else
	$get_themes = get_themes();


if ( ! empty( $get_themes ) && is_array( $get_themes ) ) {
	foreach( $get_themes as $theme ) {


		$content = '';
		$installed = false;
		$links = array();
		$current_stylesheet = get_stylesheet();
		$latest_version = $theme->version;
		$item_id = $theme->item_id;
		$template = $theme->template;
		$stylesheet = '';
		$title = $theme->Name;
		$version = '';
		$description = $theme->description;
		$author = $theme->author_name;
		$parent_theme = '';
		$tags = '';


		$theme_root = $theme->theme_root;



?>


<div class="plugin-card plugin-card-akismet" style="max-width: 372px;">
			<div class="plugin-card-top wordapp-theme-card-top" style="min-height:248px;">
				<span class="theme-icon"><img src="<?php echo get_theme_root_uri().'/'.$template; ?>/screenshot.png"></span>


			</div>
			<div class="plugin-card-bottom">

				<div class="column-updated">

					<?php
		if($myOptionsGet['theme'] == $template){ echo "Installed"; }
		else{
?>
					<a href="?page=WordAppPluginsAndThemes&quickTheme=1&appThemeSelected=MyThemed&appThemeSelect=<?php echo $template; ?>" class=" install-now button"  aria-label="Install Now" data-name="<?php echo $template; ?>" id="install-<?php echo $item_id; ?>">Install Now</a>
					<?php }
?>
									</div>

				<div class="column-downloaded">
					<cite><h4 class="h4install"><?php echo $title; ?>	</h4></cite>
								</div>
			</div>
		</div>
<?php

	}

}

?>

			</div>
</div> <!-- .wrap -->


<div style="clear:both"></div>
			<?php _e('* Changing themes may delete some of your information','wordapp-mobile-app'); ?>

<hr>
<div style="clear:both"></div>
<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'footer.php';
?>
