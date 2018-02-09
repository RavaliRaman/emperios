<?php
include trailingslashit(plugin_dir_path(__FILE__)).'admin_toolbar.php';

/* Temp data for debug */
$wordapp_debug_header = update_option('wordapp_debug_header', 'yes');

$wordapp_debug_footer = update_option('wordapp_debug_footer', 'yes');

$activate = '';
$url = 'http://52.27.101.150/mobrock/app/activateJson.php';
$activate = json_decode(wp_remote_retrieve_body(wp_remote_get($url)), true);
?>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content"  style="width: 85%;">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">


						<div class="inside">




  <form method="post" action="options.php" id="mainForm">
<?php
$varColor = (array) get_option('WordApp_options');

$varMenu = (array) get_option('WordApp_menu');

$varStructure = (array) get_option('WordApp_structure');

$varSlideshow = (array) get_option('WordApp_slideshow');
$varGA = (array) get_option('WordApp_ga');

if ($active_tab == '') {
	settings_fields('WordApp_main');

	if (!isset($varColor['Title'])) {
		$varColor['Title'] = '';
	}
	if (!isset($varColor['Color'])) {
		$varColor['Color'] = '';
	}
	if (!isset($varColor['ColorText'])) {
		$varColor['ColorText'] = '';
	}
	if (!isset($varColor['ColorTextHHH'])) {
		$varColor['ColorTextHHH'] = '';
	}
	if (!isset($varColor['ColorTextP'])) {
		$varColor['ColorTextP'] = '';
	}
	if (!isset($varColor['ColorTextFont'])) {
		$varColor['ColorTextFont'] = '';
	}
	if (!isset($varColor['ColorTextFontHHH'])) {
		$varColor['ColorTextFontHHH'] = '';
	}
	if (!isset($varColor['ColorTextFontP'])) {
		$varColor['ColorTextFontP'] = '';
	}
	if (!isset($varColor['logo'])) {
		$varColor['logo'] = '';
	}
	if (!isset($varColor['style'])) {
		$varColor['style'] = '';
	}
	if (!isset($varColor['theme'])) {
		$varColor['theme'] = '';
	}
	if (!isset($varColor['background'])) {
		$varColor['background'] = '';
	}
	if (!isset($varColor['mythemeName'])) {
		$varColor['mythemeName'] = '';
	}

	if (!isset($varColor['page_id'])) {
		$varColor['page_id'] = '';
	}

	if ($varColor['theme'] == 'MyTheme' && $varMenu['activebars']  !== 'on') {
		$varColor['style'] = 'page';
		$hiddenDivLive = 'display:none;';
		$hiddenDivLiveNot = '';
	} else {
		$hiddenDivLive = '';
		$hiddenDivLiveNot = 'display:none;';
	}
?>

		<div style="">
	  <h3><?php _e('Colors', 'wordapp-mobile-app');
	?>  <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Top & bottom bar colors', 'wordapp-mobile-app');
	?></span>	</h3>

	<hr>
	<p>  	<label for="WordApp_options[Color]"><?php echo __('App  Toolbar Color', 'wordapp-mobile-app');
	?></label>
 	<input type="text" id="WordAppColor_Color" name="WordApp_options[Color]"  class="cpa-color-picker" value="<?php echo $varColor['Color'];
	?>"/></p>

<?php if ($varColor['theme'] == 'MyTheme') { echo ""; } else{ ?>
	  <p><a href="#" class="advancedColors"><?php echo __('+ Advanced colors & fonts', 'wordapp-mobile-app');
		?></a></p>
<?php } ?>

	<div class="advancedColorsDiv<?php if ($varColor['theme'] == 'MyTheme') { echo "mytheme"; }?>">

		<!-- Advanced Color & font  header  -->
		<p>  	<label for="WordApp_options[ColorText]"><?php echo __('App header font & icon color', 'wordapp-mobile-app');
	?></label>
 		<input type="text" id="WordAppColor_ColorText" name="WordApp_options[ColorText]"  class="cpa-color-picker" value="<?php echo $varColor['ColorText'];
	?>"/></p>
	 	<p>  	<label for="WordApp_options[ColorFont]"><?php echo __('App header font', 'wordapp-mobile-app');
	?></label>

		 <input id="WordApp_options[ColorTextFont]" type="text"  name="WordApp_options[ColorTextFont]" class="fontpicker" value="<?php echo $varColor['ColorTextFont'];
	?>"/></p>


<?php if ($varColor['theme'] == 'MyTheme') {

	}else{
?>


		<!-- Advanced Color & font  H1 2 3  -->
		<p>  	<label for="WordApp_options[ColorTextHHH]"><?php echo __('H1 H2 H3 font color', 'wordapp-mobile-app');
		?></label>
 		<input type="text" id="WordAppColor_ColorTextHHH" name="WordApp_options[ColorTextHHH]"  class="cpa-color-picker" value="<?php echo $varColor['ColorTextHHH'];
		?>"/></p>
	 	<p>  	<label for="WordApp_options[ColorFontHHH]"><?php echo __('H1 H2 H3 font', 'wordapp-mobile-app');
		?></label>

		 <input id="WordApp_options[ColorTextFontHHH]" name="WordApp_options[ColorTextFontHHH]" type="text"  class="fontpicker" value="<?php echo $varColor['ColorTextFontHHH'];
		?>"/></p>

		<!-- Advanced Color & font  P  -->
		<p>  	<label for="WordApp_options[ColorTextP]"><?php echo __('Paragraph font color', 'wordapp-mobile-app');
		?></label>
 		<input type="text" id="WordAppColor_ColorTextP" name="WordApp_options[ColorTextP]"  class="cpa-color-picker" value="<?php echo $varColor['ColorTextP'];
		?>"/></p>
	 	<p>  	<label for="WordApp_options[ColorTextP]"><?php echo __('Paragraph font', 'wordapp-mobile-app');
		?></label>

		 <input id="WordApp_options[ColorTextFontP]" name="WordApp_options[ColorTextFontP]" type="text"  class="fontpicker" value="<?php echo $varColor['ColorTextFontP'];
		?>"/></p>
<?php

	}
?>

	  </div>
	  </div>
	  <h3><?php _e('App configuration', 'wordapp-mobile-app');
	?> </h3>
	  <span style="float:right" class="spanHelp"></span>
	<hr>

	  <p> 	<label for="WordApp_options[Title]"><?php echo __('App Name', 'wordapp-mobile-app');
	?></label>
   	<input type="text" id="WordAppColor_Title"  required pattern="[A-Za-z ]+" name="WordApp_options[Title]" value="<?php echo $varColor['Title'];
	?>"/> <small>Only A-Z characters accepted</small></p>
   <div style="">
   	<p> 	<label for="WordApp_options[logo]"><?php echo __('App Logo', 'wordapp-mobile-app');
	?></label>
  <input type="text" id="WordAppColor_logo" name="WordApp_options[logo]" value="<?php echo esc_url($varColor['logo']);
	?>" />
        <input id="upload_logo_button" type="button" class="button" value="<?php echo __('Upload Logo');
	?>" />  <img src="<?php echo WORDAPP_DIR_URL; ?>/images/remove.png" data-default="<?php echo plugins_url(APPNAME).'/images/no-image-icon.jpg';?>" data-imagevalue="WordAppColor_logo" data-imagesr="logo_url" class="WordApp_img_remove">
        <br />
        <?php
	if ($varColor['logo'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varColor['logo'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="logo_url" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>

					 <h3><?php _e('App Homepage Background', 'wordapp-mobile-app');
	?>   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('May not be acceptable for all themes', 'wordapp-mobile-app');
	?></span>	</h3>

					<hr>

				<p> 	<label for="WordApp_options[background]"><?php echo __('App Background', 'wordapp-mobile-app');
	?></label>
  			<input type="text" id="WordAppColor_background" name="WordApp_options[background]" value="<?php echo esc_url($varColor['background']);
	?>" />
        <input id="upload_background_button" type="button" class="button" value="<?php echo __('Upload Background', 'wordapp-mobile-app');
	?>" /><img src="<?php echo WORDAPP_DIR_URL; ?>/images/remove.png" data-default="<?php echo plugins_url(APPNAME).'/images/no-image-icon.jpg';?>" data-imagevalue="WordAppColor_background" data-imagesr="background_url" class="WordApp_img_remove">
        <br />
        <?php
	if ($varColor['background'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varColor['background'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="background_url" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>
					<?php

?>
				</div>
         <h3><?php _e('Content style', 'wordapp-mobile-app');
	?> <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('How the content is displayed on the homepage', 'wordapp-mobile-app');
	?> </span>	</h3>

	<hr>
    <script type="text/javascript">

				</script>

	   <p> 	<label for="WordApp_options[logo]"><?php echo __('App Theme', 'wordapp-mobile-app');
	?></label>
		   <a href="admin.php?page=WordAppPluginsAndThemes"><?php echo __('Change App Theme', 'wordapp-mobile-app');
	?></a>
			 <input type="hidden" name="WordApp_options[theme]" value="<?php echo $varColor['theme'];
	?>">
			 <select style="display:none" name="WordApp_options[themeOld]">
							<option  id="" value="wooWordApp" <?php echo $varColor['theme'] == 'wooWordApp' ? 'selected' : ''?>><?php echo __('Woocommerce Theme', 'wordapp-mobile-app');
	?></option>

							<option  id="" value="" <?php echo $varColor['theme'] == '' ? 'selected' : ''?>><?php echo __('Standard', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Fastfood" <?php echo $varColor['theme'] == 'Flat|Fastfood' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Fastfood', 'wordapp-mobile-app');
	?></option>

							<option  id="" value="Flat|Pub" <?php echo $varColor['theme'] == 'Flat|Pub' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Pub or Bar', 'wordapp-mobile-app');
	?></option>

							<option  id="" value="Flat|NightClub" <?php echo $varColor['theme'] == 'Flat|NightClub' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Night Club', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Golf" <?php echo $varColor['theme'] == 'Flat|Golf' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Golf Courses', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Spas" <?php echo $varColor['theme'] == 'Flat|Spas' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Spas', 'wordapp-mobile-app');
	?></option>

							<option  id="" value="Flat|Gym" <?php echo $varColor['theme'] == 'Flat|Gym' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Gyms & Fitness Clubs', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Auto" <?php echo $varColor['theme'] == 'Flat|Auto' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Auto Dealerships', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Churches" <?php echo $varColor['theme'] == 'Flat|Churches' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Churches', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|DJs" <?php echo $varColor['theme'] == 'Flat|DJs' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Bands & DJs', 'wordapp-mobile-app');
	?></option>

							<option  id="" value="Flat|Chiropractors" <?php echo $varColor['theme'] == 'Flat|Chiropractors' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Chiropractors', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|HairSalons" <?php echo $varColor['theme'] == 'Flat|HairSalons' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Hair Salons', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="Flat|Other" <?php echo $varColor['theme'] == 'Flat|Other' ? 'selected' : ''?>><?php echo __('Beautiful Slider - Other', 'wordapp-mobile-app');
	?></option>
							<option  id="" value="MyTheme" <?php echo $varColor['theme'] == 'MyTheme' ? 'selected' : ''?>><?php echo __('Use my theme (Not recommended)', 'wordapp-mobile-app');
	?></option>

						</select>
			</p>

			<?php
	if ($varColor['theme'] == '' | $varColor['theme'] == '2015') {
?>

						<p>
        <label for="WordApp_options[style]"><?php echo __('Post list style', 'wordapp-mobile-app');
		?></label>
       <div style="left: 150px;top: -70px;position: relative;">
			<input type="radio" name="WordApp_options[style]" id="listStyle" value="list" <?php echo $varColor['style'] == 'list' ? 'checked' : ''?>><?php echo __('List of posts', 'wordapp-mobile-app');
		?><br>

			 <p id="pageInfoList" style="<?php echo $varColor['style'] !== 'list' ? 'display:none' : ''?>">

		   </p>


		   	<input type="radio" name="WordApp_options[style]" id="tilesStyle" value="tiles" <?php echo $varColor['style'] == 'tiles' ? 'checked' : ''?>><?php echo __('Large Tiles', 'wordapp-mobile-app');
		?><br>

			 <p id="pageInfoTiles" style="<?php echo $varColor['style'] !== 'tiles' ? 'display:none' : ''?>">

		   </p>
			</div>
						<?php

	}

?>
		    <label for="WordApp_options[style]"><?php echo __('Opening page :', 'wordapp-mobile-app');
	?></label>
		   <div style="left: 150px;top: -50px;position: relative;">
		   	<input type="radio" name="WordApp_options[style]" id="pageStyle" value="page" <?php echo $varColor['style'] == 'page' ? 'checked' : ''?>><?php echo __('A page', 'wordapp-mobile-app');
?>

        <p id="pageInfo" style="<?php echo $varColor['style'] !== 'page' ? 'display:none' : ''?>">
        <?php

	if ($varColor['page_id'] == '') {
		$varColor['page_id'] = 0;
	}
	$args = array(
		'depth' => 0,
		'child_of' => 0,
		'selected' => $varColor['page_id'],
		'echo' => 0,
		'name' => 'WordApp_options[page_id]',
		'id' => 'WordAppOptionsPage', // string
		'show_option_none' => __('-- Default Homepage --'), // string
		'show_option_no_change' => null, // string
		'option_none_value' => null, // string
	);

	$mobile_page = str_replace('</select>', '', wp_dropdown_pages($args));

	/*

            'hierarchical' => true,
                    'post_type'=>'wordapp_mobile_pages',
            */

	$select_id = '';
	$post_type = 'wordapp_mobile_pages';
	$mobile_page .= wa_generate_post_select($select_id, $post_type, $varColor['page_id']);
	echo $mobile_page;

?>
        </p>
       	</div> </p>





	<?php
	if ($varColor['theme'] == 'MyTheme') {

?>

		   <div style="left: 150px;top: -50px;position: relative;">
			   <input type="radio"  name="WordApp_options[style]" id="pageStyleNone" value="" <?php echo $varColor['style'] == '' ? 'checked' : ''?>> <?php _e('Use Wordpress default settings', 'wordapp-mobile-app');
		?> </div>
        <?php
	}

	if ($varColor['theme'] == 'MyTheme') {
		if (is_multisite()) {
			$args = array('allowed' => 'site', 'errors' => false, 'blog_id' => 0);
		} else {
			$args = null;
		}


if ( function_exists( 'wp_get_themes' ) )
	$themes = wp_get_themes($args);
else
	$themes = get_themes($args);
	
		//$themes = wp_get_themes($args);

?>

		<label for="WordApp_options[style]"><?php echo __('Choose a theme :', 'wordapp-mobile-app');
		?></label>
		<div style="left: 150px;top: -50px;position: relative;">
		 <select id="theme" name="WordApp_options[mythemeName]">
          <?php
		foreach ($themes as $theme_name => $theme) {
?>
              <option value="<?php echo $theme_name;
			?>" <?php echo $varColor['mythemeName'] == $theme_name ? 'selected' : ''?>><?php echo $theme['Name'];
			?></option>
              <?php

		}
?>
        </select>

       	</div>

	<?php

	}
	if ($varColor['theme'] == 'MyTheme') {


	} else {
?>
        <label for="WordApp_options[style]"><?php echo __('Default ');
		?></label>
		   <div style="left: 150px;top: -50px;position: relative;">
			   <input type="radio" name="WordApp_options[style]" id="" value="" <?php echo $varColor['style'] == '' ? 'checked' : ''?>> <?php _e('Use Wordpress default settings', 'wordapp-mobile-app');
		?> </div>
        <?php

	}
} elseif ($active_tab == 'visu') {
	include WORDAPP_DIR.'/includes/admin/visu.php';

}
elseif ($active_tab == 'builder') {
	/*
                    3. Home builder
                    */
	if ($_POST):

		update_option('WordApp_theme_options', json_encode($_POST));

	$jsonApp = '';
	$jsonApp = json_decode(get_option('WordApp_theme_options'), true);

	endif;

	print_r((DEBUG_WORDAPP) ? $_POST : '');
	?></form>

		<form action="" method="post">
								<input type="hidden" name="updateHome" value="1">
								<input type="hidden" name="option" value="<?php echo $jsonApp['option'];
	?>">
								<input type="hidden" name="theme" value="<?php echo $jsonApp['theme'];
	?>">
						<?php

	foreach ($jsonApp['content'] as $key => $value) {
		//commandes
		echo '<p><label>'.$jsonApp['content'][$key]['label'].'</label>';
		echo '<input value=	"';
		echo $jsonApp['content'][$key]['value'].'" ';
		echo 'name="content['.$key.'][value]" ';
		echo 'type="'.$jsonApp['content'][$key]['type'].'" ';
		echo ''.$jsonApp['content'][$key]['extra'].' >';
		echo '</p>';

		echo '<input type="hidden" name="content['.$key.'][name]" value="'.$jsonApp['content'][$key]['name'].'">';
		echo '<input type="hidden" name="content['.$key.'][label]" value="'.$jsonApp['content'][$key]['label'].'">';
		echo '<input type="hidden" name="content['.$key.'][type]" value="'.$jsonApp['content'][$key]['type'].'">';
		echo '<input type="hidden" name="content['.$key.'][extra]" value="'.urlencode($jsonApp['content'][$key]['extra']).'">';
		echo '<input type="hidden" name="content['.$key.'][help]" value="'.$jsonApp['content'][$key]['help'].'">';

		//print_r($key);
	}
} elseif ($active_tab == 'step2') {
	settings_fields('WordApp_main_menu');

	if (!isset($varMenu['side'])) {
		$varMenu['side'] = '';
	}
	
	if (!isset($varMenu['menuRight'])) {
		$varMenu['menuRight'] = '';
	}
	if (!isset($varMenu['rside'])) {
		$varMenu['rside'] = '';
	}
	if (!isset($varMenu['top'])) {
		$varMenu['top'] = '';
	}
	if (!isset($varMenu['menu'])) {
		$varMenu['menu'] = '';
	}
	if (!isset($varMenu['menuTop'])) {
		$varMenu['menuTop'] = '';
	}
	if (!isset($varMenu['bottom'])) {
		$varMenu['bottom'] = '';
	}
	if (!isset($varMenu['menuBottom'])) {
		$varMenu['menuBottom'] = '';
	}
	if (!isset($varMenu['menuTop'])) {
		$varMenu['menuTop'] = '';
	}
	
	if (!isset($varMenu['lsideicon'])) {
		$varMenu['lsideicon'] = '';
	}
	if (!isset($varMenu['rsideicon'])) {
		$varMenu['rsideicon'] = '';
	}
	if (!isset($varMenu['activebars'])) {
		$varMenu['activebars'] = '';
	}
	if (!isset($varMenu['barstyle'])) {
		$varMenu['barstyle'] = '';
	}
	if (!isset($varColor['theme'])) {
		$varColor['theme'] = '';
	}


	if ($varColor['theme'] == 'MyTheme') {
?>

			 <h3><?php _e('Activated Navigation Bars', 'wordapp-mobile-app');
		?></h3>
			<hr>
			<p> <label for="WordApp_menu[activebars]"><?php echo __('Activate Bars?', 'wordapp-mobile-app');
		?></label>

			   	<input type="checkbox" name="WordApp_menu[activebars]" class="js-switch"  id="activebars" value="on" <?php echo $varMenu['activebars'] == 'on' ? 'checked' : ''?> />
			<br />
				<?php echo __('If using your own theme you can add mobile navigation bars', 'wordapp-mobile-app');
?>
			</p>


			<p> <label for="WordApp_menu[barstyle]"><?php echo __('Bars Style', 'wordapp-mobile-app');
		?></label>
			<select name="WordApp_menu[barstyle]">
				
				<option value="Awesome" <?php echo ($varMenu['barstyle'] == 'Awesome') ? 'selected' : '';  ?>><?php echo __('Awesome', 'wordapp-mobile-app');?></option>
				<option value="Wavey" <?php echo ($varMenu['barstyle'] == 'Wavey') ? 'selected' : '';  ?>><?php echo __('Wavey', 'wordapp-mobile-app');?></option>
			</select>

			<br />

			</p>

			<p> <label for="WordApp_menu[activehelper]"><?php echo __('Activate Tidy up?', 'wordapp-mobile-app');
		?></label>

			   	<input type="checkbox" name="WordApp_menu[activehelper]" class="js-switch"  id="activehelper" value="on" <?php echo $varMenu['activehelper'] == 'on' ? 'checked' : ''?> />
			<br />
				<?php echo __('Help remove extra headers & footer to make the app look more tidy.', 'wordapp-mobile-app');
?>
			</p>

			<?php

	}
?>
			

<?php
	if ($varColor['theme'] == 'MyTheme') {
		
		?>
		 <h3><?php _e('Top Menu', 'wordapp-mobile-app');
		?> 	</h3>
	<hr>
         <p>
			  <label for="WordApp_menu[top]"><?php _e('Top Menus', 'wordapp-mobile-app');
		?></label>

        <input type="radio" name="WordApp_menu[top]" id="topBarOff" value="" <?php echo $varMenu['top'] == '' ? 'checked' : ''?>><?php echo __('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[top]" id="topBarOn" value="on" <?php echo $varMenu['top'] == 'on' ? 'checked' : ''?>><?php echo __('on', 'wordapp-mobile-app');
?>
         </p>
		
		<div id="topInfo" style="<?php echo $varMenu['top'] !== 'on' ? 'display:none' : ''?>">
		<h3><?php _e('Side Menu', 'wordapp-mobile-app');
	?> 	</h3>
			<hr>
       <p>
		   <label for="WordApp_menu[side]"><?php echo __('Left Side Menus', 'wordapp-mobile-app');
	?></label>

        <input type="radio" name="WordApp_menu[side]" id="sideBarOff" value="" <?php echo $varMenu['side'] == '' ? 'checked' : ''?>><?php _e('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[side]" id="sideBarOn" value="on" <?php echo $varMenu['side'] == 'on' ? 'checked' : ''?>><?php _e('on', 'wordapp-mobile-app');
?>

        </p><p id="sidseInfo" style="left: 156px;top: -21px;position: relative;">
       <?php
	WordApp_nav_menu_drop_down('WordApp_menu[menu]', $varMenu['menu']);
	?> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"><?php _e('Choose a ', 'wordapp-mobile-app');
	?> <a href="nav-menus.php"><?php _e('menu', 'wordapp-mobile-app');
	?></a> <?php _e('to attach to this navigation bar', 'wordapp-mobile-app');
?>
        </p>
         <p id="" style="left: 156px;top: -21px;position: relative;">  
			
			<select name="WordApp_menu[lsideicon]">
				<?php 
					if(!isset($varMenu['lsideicon']) || $varMenu['lsideicon'] == ''){ $varMenu['lsideicon'] == 'bars'; }
					echo listOfIcons($varMenu['lsideicon']);?>
			</select> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"> <?php echo __('Left Menus Icon', 'wordapp-mobile-app');?> <a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank"><?php echo __('Preview Icons', 'wordapp-mobile-app');
		?></a>
        </p>
          <p>
		   <label for="WordApp_menu[side]"><?php echo __('Right Side Menus', 'wordapp-mobile-app');
	?></label>

        <input type="radio" name="WordApp_menu[rside]" id="rsideBarOff" value="" <?php echo $varMenu['rside'] == '' ? 'checked' : ''?>><?php _e('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[rside]" id="rsideBarOn" value="on" <?php echo $varMenu['rside'] == 'on' ? 'checked' : ''?>><?php _e('on', 'wordapp-mobile-app');
?>

        </p>
        <p id="" style="left: 156px;top: -21px;position: relative;">
       <?php
		WordApp_nav_menu_drop_down('WordApp_menu[menuRight]', $varMenu['menuRight']);
		?> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"><?php _e('Choose a ', 'wordapp-mobile-app');
		?> <a href="nav-menus.php"><?php _e('menu', 'wordapp-mobile-app');
		?></a> <?php _e('to attach to this navigation bar', 'wordapp-mobile-app');
?>
        </p>
          <p id="" style="left: 156px;top: -21px;position: relative;">  
			
			<select name="WordApp_menu[rsideicon]">
				
				<?php 
					if(!isset($varMenu['rsideicon']) || $varMenu['rsideicon'] == ''){ $varMenu['rsideicon'] == 'bars'; }
					echo listOfIcons($varMenu['rsideicon']);?>
			</select> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"> <?php echo __('Right Menus Icon', 'wordapp-mobile-app');?> <a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank"><?php echo __('Preview Icons', 'wordapp-mobile-app');
		?></a>
        </p>
        
     <span><center><img src="<?php echo plugins_url(APPNAME.'/images/lightbulb.gif')?>"  width="18px"  height="18px"> <?php echo __('HINT: You can add widgets to your side bars. WordPress widgets', 'wordapp-mobile-app'); ?>
     <a href="<?php echo admin_url().'widgets.php'; ?>"><?php echo __('WordPress widgets', 'wordapp-mobile-app');?></a></center> </span>
		</div>
		<?php
		
	}else{
		?>
		<h3><?php _e('Side Menu', 'wordapp-mobile-app');
	?> 	</h3>
			<hr>
		
       <p>
		   <label for="WordApp_menu[side]"><?php echo __('Side Menus', 'wordapp-mobile-app');
	?></label>

         <input type="radio" name="WordApp_menu[side]" id="sideBarOff" value="" <?php echo $varMenu['side'] == '' ? 'checked' : ''?>><?php _e('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[side]" id="sideBarOn" value="on" <?php echo $varMenu['side'] == 'on' ? 'checked' : ''?>><?php _e('on', 'wordapp-mobile-app');
?>

        </p><p id="sideInfo" style="left: 156px;top: -21px;position: relative;<?php echo $varMenu['side'] !== 'on' ? 'display:none' : ''?>">
       <?php
	WordApp_nav_menu_drop_down('WordApp_menu[menu]', $varMenu['menu']);
	?> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"><?php _e('Choose a ', 'wordapp-mobile-app');
	?> <a href="nav-menus.php"><?php _e('menu', 'wordapp-mobile-app');
	?></a> <?php _e('to attach to this navigation bar', 'wordapp-mobile-app');
?>
        </p>
       
		
		
		<?php
		
	}
?>

			<?php
	if ($varColor['theme'] == 'MyTheme') {
		
		
		}
		else{
	if ($varColor['theme'] == 'wooWordApp') {
	} else {
?>

					 <h3><?php _e('Top Menu', 'wordapp-mobile-app');
		?> 	</h3>
	<hr>
         <p>
			  <label for="WordApp_menu[top]"><?php _e('Top Menus', 'wordapp-mobile-app');
		?></label>

        <input type="radio" name="WordApp_menu[top]" id="topBarOff" value="" <?php echo $varMenu['top'] == '' ? 'checked' : ''?>><?php echo __('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[top]" id="topBarOn" value="on" <?php echo $varMenu['top'] == 'on' ? 'checked' : ''?>><?php echo __('on', 'wordapp-mobile-app');
?>
         </p><p id="topInfo" style="left: 156px;top: -21px;position: relative;<?php echo $varMenu['top'] !== 'on' ? 'display:none' : ''?>">
       <?php
		WordApp_nav_menu_drop_down('WordApp_menu[menuTop]', $varMenu['menuTop']);
		?> <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="18px"  height="18px"><?php _e('Choose a ', 'wordapp-mobile-app');
		?> <a href="nav-menus.php"><?php _e('menu', 'wordapp-mobile-app');
		?></a> <?php _e('to attach to this navigation bar', 'wordapp-mobile-app');
?>
        </p>

		<?php

	}
	
	}
?>
					 <h3><?php _e('Bottom Navigation', 'wordapp-mobile-app');
	?>   	</h3>
	<hr>
         <p>
			  <label for="WordApp_menu[bottom]"><?php echo __('Bottom Menus','wordapp-mobile-app');
	?></label>

        <input type="radio" name="WordApp_menu[bottom]" id="bottomBarOff" value="" <?php echo $varMenu['bottom'] == '' ? 'checked' : ''?>><?php echo __('off', 'wordapp-mobile-app');
?>
		<input type="radio" name="WordApp_menu[bottom]" id="bottomBarOn" value="on" <?php echo $varMenu['bottom'] == 'on' ? 'checked' : ''?>><?php echo __('on', 'wordapp-mobile-app');
?>
         </p><div id="bottomInfo" style="left: 156px;top: -21px;position: relative;<?php echo $varMenu['bottom'] !== 'on' ? 'display:none' : ''?>">
       <?php
	WordApp_nav_menu_drop_down('WordApp_menu[menuBottom]', $varMenu['menuBottom']);
	?><a href="nav-menus.php"><?php _e('Choose'); ?> <?php _e('menu', 'wordapp-mobile-app');
	?></a> <?php _e('to attach to this navigation bar', 'wordapp-mobile-app');
	?></span>
		<br / >

		<ul style="position: relative;top: 0px;left: 50px;">

		<?php


	if (!isset($menu_item)) {
		$menu_item = '';
	}
	//if(!isset($menu_items)) $menu_items='';
	//if(!isset($menu_item->title)) $menu_item->title='';
	if (!isset($title)) {
		$title = '';
	}

	if (isset($varMenu['menuBottom']) && $varMenu['menuBottom'] != '') {
		$menu_items = wp_get_nav_menu_items($varMenu['menuBottom']);

		//print_r($menu_items);
		$i = 0;
		foreach ($menu_items as $key => $menu_item) {
			if (!isset($varMenu['bottomIcon'][$i])) {
				$varMenu['bottomIcon'][$i] = '';
			}
			if (!isset($varMenu['bottomIcon'][$i]) && $varMenu['bottomIcon'][$i] != '') {
				$varMenu['bottomIcon'][$i] = '';
			}

			echo '<li><span>';
			if (isset($menu_item->title)  && $menu_item->title != '') {
				echo $menu_item->title;
			}
			echo ' Icon </span>';
			// echo $varMenu['bottomIcon'][$i];
?>
		<select name="WordApp_menu[bottomIcon][<?php echo $i;
			?>]">
		<?php echo listOfIcons($varMenu['bottomIcon'][$i]);
?>
		</select><br></li>
		<?php
			++$i;
		}
	}

	?></ul>
		<?php
	if (strpos($varColor['theme'], '|') !== false) {
		list($themeSelected, $themeType) = explode('|', $varColor['theme']);
	}else{
		$themeSelected = $varColor['theme'];
		$themeType = '';
	}

	if(!isset($selected)) $selected ='';
	$selected = $selected;
	if ($themeSelected == 'MyiOS' || $themeSelected == 'MyTheme') {
?>
		<a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank"><?php echo __('Preview Icons', 'wordapp-mobile-app');
		?></a>
		<?php

	} else {
?>
		<input style="position: relative;float: right;top: -223px;right: 210px;" id="jqIcons" type="button" class="button" value="<?php echo __('Preview Icons', 'wordapp-mobile-app');
		?>" />
<?php

	}
?>
</div>
        <?php

} elseif ($active_tab == 'step3') {
	if (!isset($varStructure['icon'])) {
		$varStructure['icon'] = '';
	}
	if (!isset($varStructure['splash'])) {
		$varStructure['splash'] = '';
	}
	if (!isset($varStructure['description'])) {
		$varStructure['description'] = '';
	}
	if (!isset($varStructure['keywords'])) {
		$varStructure['keywords'] = '';
	}
	if (!isset($varStructure['cat'])) {
		$varStructure['cat'] = '';
	}
if (!isset($varStructure['iconrounded'])) {
		$varStructure['iconrounded'] = '';
	}
	if (!isset($varStructure['version'])) {
		$varStructure['version'] = '0.0.1';
	}
		if (!isset($varStructure['fullappname'])) {
		$varStructure['fullappname'] = '';
	}

	settings_fields('WordApp_main_structure');

?>

  <div class="notice">
        <p><?php _e( 'If updating information in the app structure you will need to request a new copy of the app for the update to take place.', 'wordapp-mobile-app' ); ?></p>
    </div>
			<h3><?php _e('App Icon', 'wordapp-mobile-app');
	?>   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Icon size must be 512px x 512px', 'wordapp-mobile-app');
	?></span>	</h3>

	<hr>
         	<p> 	<label for="WordApp_structure[icon]"><?php echo __('App Icon', 'wordapp-mobile-app');
	?></label>
 		 <input type="text" id="WordAppColor_icon" name="WordApp_structure[icon]" value="<?php echo esc_url($varStructure['icon']);
	?>" />
        <input id="upload_logo_button_icon" type="button" class="button" value="<?php echo __('Upload Icon', 'wordapp-mobile-app');
	?>" /> <img src="<?php echo WORDAPP_DIR_URL; ?>/images/remove.png" data-default="<?php echo plugins_url(APPNAME).'/images/no-image-icon.jpg';?>" data-imagevalue="WordAppColor_icon" data-imagesr="icon_url" class="WordApp_img_remove">
	<br />
	<input type="checkbox" name="WordApp_structure[iconrounded]" id="WordApp_structure_iconrounded" value="yes" <?php echo ($varStructure['iconrounded']=='yes' ? 'checked' : '');?>> <?php echo __('Round the corners of your app icon', 'wordapp-mobile-app');
	?>
<br />
        <br />
        <?php
	if ($varStructure['icon'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varStructure['icon'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;<?php echo ($varStructure['iconrounded']=='yes' ? 'border-radius:35px' : '');?>" alt="" id="icon_url" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>
        <h3><?php _e('App Splash Screen', 'wordapp-mobile-app');
	?>   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Splash size must be 640px x 1136px', 'wordapp-mobile-app');
	?></span>	</h3>

	<hr>
        <p> 	<label for="WordApp_options[splash]"><?php echo __('App Splash', 'wordapp-mobile-app');
	?></label>
  		<input type="text" id="WordAppColor_splash" name="WordApp_structure[splash]" value="<?php echo esc_url($varStructure['splash']);
	?>" />
        <input id="upload_logo_button_splash" type="button" class="button" value="<?php echo __('Upload Splash', 'wordapp-mobile-app');
	?>" /> <img src="<?php echo WORDAPP_DIR_URL; ?>/images/remove.png" data-default="<?php echo plugins_url(APPNAME).'/images/no-image-icon.jpg';?>" data-imagevalue="WordAppColor_splash" data-imagesr="splash_url" class="WordApp_img_remove">
        <br />
        <?php
	if ($varStructure['splash'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varStructure['splash'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="splash_url" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>
        
        
        <h3><?php echo  __('App Structure','wordapp-mobile-app');
	?>  <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('This used in the app framework', 'wordapp-mobile-app');
	?></span></h3>
	  <span style="float:right" class="spanHelp"></span>
		<hr>
	   <p> 	<label for="WordApp_structure[version]"><?php echo __('Full App Name', 'wordapp-mobile-app');
	?></label>
			<input type="text" style="width:100px"  id="WordApp_structure[fullappname]" name="WordApp_structure[fullappname]"  value="<?php echo $varStructure['fullappname'];
	?>"> <small><?php _e('Full app name including spaces', 'wordapp-mobile-app');
	?></small></p>
          <p> 	<label for="WordApp_structure[version]"><?php echo __('App Version', 'wordapp-mobile-app');
	?></label>
			<input type="text" style="width:100px"  id="WordApp_structure[version]" name="WordApp_structure[version]" <?php if (get_option('WordApp_pro') != 'on'): ?>disabled="disabled"<?php endif;
	?> value="<?php echo $varStructure['version'];
	?>"> <small><?php if (get_option('WordApp_pro') != 'on'): ?><a href="http://app-developers.biz/wordapp-specials/" target="_blank"><?php _e('Upgrade to change version', 'wordapp-mobile-app');
	?></a><?php endif;
	?></small></p>

 		<h3><?php echo  __('App Meta','wordapp-mobile-app');
	?>  <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Info used in the app store listings', 'wordapp-mobile-app');
	?></span></h3>
	  <span style="float:right" class="spanHelp"></span>
		<hr>
 		<p> 	<label for="WordApp_structure[description]"><?php echo __('App Description', 'wordapp-mobile-app');
	?></label>
   	<textarea style="width:60%"  id="WordApp_structure[description]" name="WordApp_structure[description]"><?php echo $varStructure['description'];
	?></textarea></p>

	


	  <p> 	<label for="WordApp_structure[keywords]"><?php echo __('App Keywords', 'wordapp-mobile-app');
	?></label>
   	<textarea style="width:60%"  id="WordApp_structure[keywords]" name="WordApp_structure[keywords]"><?php echo $varStructure['keywords'];
	?></textarea></p>

		<p> 	<label for="WordApp_structure[cat]"><?php echo __('App Category', 'wordapp-mobile-app');
	?></label>


			<select class="gwt-ListBox"  name="WordApp_structure[cat]">
				<option value="">Select a category</option>

				<option value="<?php echo $varStructure['cat'];
	?>" selected><?php echo $varStructure['cat'];
	?></option>
				<option value="BOOKS_AND_REFERENCE">Books &amp; Reference</option>
				<option value="BUSINESS">Business</option>
				<option value="COMICS">Comics</option>
				<option value="COMMUNICATION">Communication</option>
				<option value="EDUCATION">Education</option>
				<option value="ENTERTAINMENT">Entertainment</option>
				<option value="FINANCE">Finance</option>
				<option value="HEALTH_AND_FITNESS">Health &amp; Fitness</option>
				<option value="LIBRARIES_AND_DEMO">Libraries &amp; Demo</option>
				<option value="LIFESTYLE">Lifestyle</option>
				<option value="MEDIA_AND_VIDEO">Media &amp; Video</option>
				<option value="MEDICAL">Medical</option>
				<option value="MUSIC_AND_AUDIO">Music &amp; Audio</option>
				<option value="NEWS_AND_MAGAZINES">News &amp; Magazines</option>
				<option value="PERSONALIZATION">Personalisation</option>
				<option value="PHOTOGRAPHY">Photography</option>
				<option value="PRODUCTIVITY">Productivity</option>
				<option value="SHOPPING">Shopping</option>
				<option value="SOCIAL">Social</option>
				<option value="SPORTS">Sports</option>
				<option value="TOOLS">Tools</option>
				<option value="TRANSPORTATION">Transport</option>
				<option value="TRAVEL_AND_LOCAL">Travel &amp; Local</option>
				<option value="WEATHER">Weather</option>
			</select>
			</p>
        <?php

} elseif ($active_tab == 'slideshow') {
	settings_fields('WordApp_main_slideshow');

	if (!isset($varSlideshow['onoff'])) {
		$varSlideshow['onoff'] = '';
	}
	if (!isset($varSlideshow['one'])) {
		$varSlideshow['one'] = '';
	}
	if (!isset($varSlideshow['two'])) {
		$varSlideshow['two'] = '';
	}
	if (!isset($varSlideshow['three'])) {
		$varSlideshow['three'] = '';
	}
	if (!isset($varSlideshow['four'])) {
		$varSlideshow['four'] = '';
	}
	if (!isset($varSlideshow['five'])) {
		$varSlideshow['five'] = '';
	}
	if (!isset($varSlideshow['wooCat'])) {
		$varSlideshow['wooCat'] = '';
	}
	if (!isset($varColor['theme'])) {
		$varColor['theme'] = '';
	}
	$pieces = '';

	if ($varColor['theme'] == '') {
	} elseif ($varColor['theme'] == 'wooWordApp') {
	} else {
		$pieces = explode('|', $varColor['theme']);

		$varSlideshow['onoff'] = 'on';
		if ($varSlideshow['one'] == '') {
			$varSlideshow['one'] = WORDAPP_DIR_URL.'/themes/wordappjqmobile'.$pieces[0].'/images/photos/'.$pieces[1].'/1.jpg';
		}
		if ($varSlideshow['two'] == '') {
			$varSlideshow['two'] = WORDAPP_DIR_URL.'/themes/wordappjqmobile'.$pieces[0].'/images/photos/'.$pieces[1].'/2.jpg';
		}
		if ($varSlideshow['three'] == '') {
			$varSlideshow['three'] = WORDAPP_DIR_URL.'/themes/wordappjqmobile'.$pieces[0].'/images/photos/'.$pieces[1].'/3.jpg';
		}
		if ($varSlideshow['four'] == '') {
			$varSlideshow['four'] = WORDAPP_DIR_URL.'/themes/wordappjqmobile'.$pieces[0].'/images/photos/'.$pieces[1].'/4.jpg';
		}
		if ($varSlideshow['five'] == '') {
			$varSlideshow['five'] = WORDAPP_DIR_URL.'/themes/wordappjqmobile'.$pieces[0].'/images/photos/'.$pieces[1].'/5.jpg';
		}
	}
?>
			 <p>
			  <label for="WordApp_menu[top]"><?php echo __('Activate the slideshow ?');
	?></label>

			 <input type="radio" name="WordApp_slideshow[onoff]" id="bottomSlideOff" value="" <?php echo $varSlideshow['onoff'] == '' ? 'checked' : ''?>><?php echo __('off');
?>
		<input type="radio" name="WordApp_slideshow[onoff]" id="bottomSlideOn" value="on" <?php echo $varSlideshow['onoff'] == 'on' ? 'checked' : ''?>><?php echo __('on');
?>
</p>
<?php
	if ($varColor['theme'] == 'wooWordApp') {
?>
<p>
			  <label for="WordApp_menu[top]"><?php echo __('Woocommerce Category');
		?></label>
					<?php

		$args = array(
			'selected' => $varSlideshow['wooCat'],
			'echo' => 1,
			'name' => 'WordApp_slideshow[wooCat]',
			'show_option_none' => __('Select a category'), // string

			'taxonomy' => 'product_cat',
		);
		wp_dropdown_categories($args);
?>
</p>
			<?php

	}
?>

<div style="<?php if ($varColor['theme'] == 'wooWordApp') {
		echo 'display:none';
	}
	?>">
			<h3><?php _e('Slide', 'wordapp-mobile-app');
	?> #1  <span style="float:right" class="spanHelp">
       <img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Landscape photos work the best', 'wordapp-mobile-app');
	?></span>	</h3>

			<hr>
         	<p> 	<label for="WordApp_slideshow[one]"><?php echo __('Slide Image #1');
	?></label>
 		 <input type="text" id="WordApp_slideshow_1" name="WordApp_slideshow[one]" value="<?php echo esc_url($varSlideshow['one']);
	?>" />
        <input id="upload_slideshow_one" type="button" class="button" value="<?php echo __('Upload Image', 'wordapp-mobile-app');
	?>" />
        <br />
        <?php
	if ($varSlideshow['one'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varSlideshow['one'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="icon_urlss_one" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>



		<h3><?php _e('Slide', 'wordapp-mobile-app');
	?> #2   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Landscape photos work the best', 'wordapp-mobile-app');
	?></span>	</h3>

		<hr>
        <p> 	<label for="WordApp_slideshow[tow]"><?php echo __('Slide Image #2');
	?></label>
 		<input type="text" id="WordApp_slideshow_2" name="WordApp_slideshow[two]" value="<?php echo esc_url($varSlideshow['two']);
	?>" />
        <input id="upload_slideshow_two" type="button" class="button" value="<?php echo __('Upload Image', 'wordapp-mobile-app');
	?>" />
        <br />
        <?php
	if ($varSlideshow['two'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varSlideshow['two'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="icon_urlss_two" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>


		<h3><?php _e('Slide', 'wordapp-mobile-app');
	?> #3   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Landscape photos work the best', 'wordapp-mobile-app');
	?></span>	</h3>

		<hr>
        <p> 	<label for="WordApp_slideshow[three]"><?php echo __('Slide Image #3');
	?></label>
 		<input type="text" id="WordApp_slideshow_3" name="WordApp_slideshow[three]" value="<?php echo esc_url($varSlideshow['three']);
	?>" />
        <input id="upload_slideshow_three" type="button" class="button" value="<?php echo __('Upload Image', 'wordapp-mobile-app');
	?>" />
        <br />
        <?php
	if ($varSlideshow['three'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varSlideshow['three'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="icon_urlss_three" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>

		<h3><?php _e('Slide', 'wordapp-mobile-app');
	?> #4   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Landscape photos work the best', 'wordapp-mobile-app');
	?></span>	</h3>

		<hr>
        <p> 	<label for="WordApp_slideshow[four]"><?php echo __('Slide Image #4');
	?></label>
 		<input type="text" id="WordApp_slideshow_4" name="WordApp_slideshow[four]" value="<?php echo esc_url($varSlideshow['four']);
	?>" />
        <input id="upload_slideshow_four" type="button" class="button" value="<?php echo __('Upload Image', 'wordapp-mobile-app');
	?>" />
        <br />
        <?php
	if ($varSlideshow['four'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varSlideshow['four'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="icon_urlss_four" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>

        <h3><?php _e('Slide', 'wordapp-mobile-app');
	?> #5   <span style="float:right" class="spanHelp"><img src="<?php echo plugins_url(APPNAME.'/images/help.png')?>" style="vertical-align: middle;" width="24px"  height="24px"> <?php _e('Landscape photos work the best', 'wordapp-mobile-app');
	?></span>	</h3>

		<hr>
        <p> 	<label for="WordApp_slideshow[five]"><?php echo __('Slide Image #5');
	?></label>
 		<input type="text" id="WordApp_slideshow_5" name="WordApp_slideshow[five]" value="<?php echo esc_url($varSlideshow['five']);
	?>" />
        <input id="upload_slideshow_five" type="button" class="button" value="<?php echo __('Upload Image', 'wordapp-mobile-app');
	?>" />
        <br />
        <?php
	if ($varSlideshow['five'] == '') {
		$img_url = plugins_url(APPNAME).'/images/no-image-icon.jpg';
	} else {
		$img_url = $varSlideshow['five'];
	}
?>
        <img src="<?php echo esc_url($img_url);
	?>" style="max-width:200px;border: 2px dashed #e5e5e5;padding: 5px;" alt="" id="icon_urlss_five" title="" width="" height="" class="alignzone size-full wp-image-125" /></a>
        </p>
</div>



        <?php

} elseif ($active_tab == 'step4') {
	if (!isset($varColor['Title'])) {
		$varColor['Title'] = '';
	}
	if (!isset($varStructure['description'])) {
		$varStructure['description'] = '';
	}
	if (!isset($varStructure['cat'])) {
		$varStructure['cat'] = '';
	}
	if (!isset($varStructure['icon'])) {
		$varStructure['icon'] = '';
	}
	if (!isset($varStructure['splash'])) {
		$varStructure['splash'] = '';
	}
	if (!isset($varStructure['certificate'])) {
		$varStructure['certificate'] = '';
	}

	if (get_option('WordApp_pro') == 'on') {
		?><center>
<h1><?php echo __('Premium users app publisher.', 'wordapp-mobile-app');
		?></h1>
<h2><?php echo __('Need a new version of your app?', 'wordapp-mobile-app');
		?></h2>
<h2><?php echo __('Check everything is correctly filled out and Hit Publish app.', 'wordapp-mobile-app');
		?></h2>
<?php

	} else {
		?><center>
<h1><?php echo __('This is where it gets complicated!', 'wordapp-mobile-app');
		?></h1>
<h2><?php echo __('but that is why we are here, right?', 'wordapp-mobile-app');
		?></h2>
<h2><?php echo __('Watch this short video to see how it works.', 'wordapp-mobile-app');
		?></h2>
<div style="width:100%;height:100%;height: 400px; float: none; clear: both; margin: 2px auto;">


  <embed src="<?php echo $activate['pubVideo'];
		?>?version=3&amp;hl=en_US&amp;rel=0&amp;autohide=1&amp;autoplay=0" wmode="transparent" type="application/x-shockwave-flash" width="100%" height="400px" allowfullscreen="true" title="Adobe Flash Player">
</div>
<h2><?php echo __('Get your android app for free !', 'wordapp-mobile-app');
		?></h2>

<?php

	}
?>

<p><strong><?php echo __('Check List', 'wordapp-mobile-app');
	?></strong></p>
<table class="widefat">





	<?php
	$u = '';
	if ($varColor['Title'] == '') {
		$tickOnOff = 'tickOn.png';
		$completed = '';
		$completedNoLine = '';
		$completedTxt = '';
	} else {
		$tickOnOff = 'tick.png';
		$completed = 'completed';
		$completedNoLine = 'completedNoLine';
		$completedTxt = 'Completed';
		++$u;
	}
?>
	<tr>
		<td><img src="<?php echo plugins_url(APPNAME.'/images/'.$tickOnOff);
	?>"></td>
		<td><a href="admin.php?page=WordAppBuilder&tab=" class="<?php echo $completed ?>"><?php echo __('Give your app a name');
	?></a></td>
		<td class="<?php echo $completedNoLine ?>"><?php echo __($completedTxt);
	?></td>
	</tr>


		<?php
	if ($varStructure['icon'] == '') {
		$tickOnOff = 'tickOn.png';
		$completed = '';
		$completedNoLine = '';
		$completedTxt = '';
	} else {
		$tickOnOff = 'tick.png';
		$completed = 'completed';
		$completedNoLine = 'completedNoLine';
		$completedTxt = 'Completed';
		++$u;
	}
?>
	<tr>
		<td><img src="<?php echo plugins_url(APPNAME.'/images/'.$tickOnOff);
	?>"></td>
		<td><a href="admin.php?page=WordAppBuilder&tab=step3" class="<?php echo $completed ?>"><?php echo __('Upload app icon', 'wordapp-mobile-app');
	?></a></td>
		<td class="<?php echo $completedNoLine ?>"><?php echo __($completedTxt);
	?></td>
	</tr>




		<?php
	if ($varStructure['splash'] == '') {
		$tickOnOff = 'tickOn.png';
		$completed = '';
		$completedNoLine = '';
		$completedTxt = '';
	} else {
		$tickOnOff = 'tick.png';
		$completed = 'completed';
		$completedNoLine = 'completedNoLine';
		$completedTxt = 'Completed';
		++$u;
	}
?>
	<tr>
		<td><img src="<?php echo plugins_url(APPNAME.'/images/'.$tickOnOff);
	?>"></td>
		<td><a href="admin.php?page=WordAppBuilder&tab=step3" class="<?php echo $completed ?>"><?php echo __('Upload app splash screen', 'wordapp-mobile-app');
	?></a></td>
		<td class="<?php echo $completedNoLine ?>"><?php echo __($completedTxt);
	?></td>
	</tr>




</table>

</form>
<form id="sendToAD"  name="sendToAD" method="POST" action="https://secure.buildapps.biz/mobrock/app/sendToAD.php">

	<input type="hidden" name="ref" value="<?php echo get_admin_url();
	?>" id="ref">
<?php
	if (get_option('WordApp_pro') == 'on') {
		if ($u >= 3) {
			$fullVar = array_merge($varColor, $varMenu, $varStructure, $varSlideshow, $varGA);
?>

								<h3><?php _e('To which email address would you like us to send your app ?', 'wordapp-mobile-app');
			?></h3><br>
								<input type="text" name="email" id="email" style="width: 400px;text-align: center;height: 50px;margin: 11px;font-size: 20px;" placeholder="<?php _e('Your email address');
			?>" value="<?php echo get_bloginfo('admin_email') ?>"><br>
								<input type="hidden" name="url" id="url" value="<?php echo get_bloginfo('url') ?>">

								<input type="hidden" name="user" id="user" placeholder="Your Name" value="<?php echo get_bloginfo('name') ?>">
								<input type="hidden" name="bs64" id="bs64" value="yes">
								<input type="hidden" name="fullJson" id="fullJson" value="<?php echo base64_encode(json_encode($fullVar, true));?>">
				<?php
			echo'	<input class="button-primary" type="button" name="send"  id="submitPubPremium" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Publish App!', 'WordApp').'"></h3>';
		} else {
			_e('You must fill out all the info above to re-publish your app.', 'wordapp-mobile-app');
		}
	} else {
		if ($u >= 3) {

			$fullVar = array_merge($varColor, $varMenu, $varStructure, $varSlideshow, $varGA);
?>


								<h3><?php _e('To which email address would you like us to send your app ?', 'wordapp-mobile-app');
			?></h3><br>
								<input type="text" name="email" id="email" style="width: 400px;text-align: center;height: 50px;margin: 11px;font-size: 20px;" placeholder="Your email address" value="<?php echo get_bloginfo('admin_email') ?>"><br>
								<input type="hidden" name="url" id="url" value="<?php echo get_bloginfo('url') ?>">

								<input type="hidden" name="user" id="user" placeholder="Your Name" value="<?php echo get_bloginfo('name') ?>">
								<input type="hidden" name="bs64" id="bs64" value="yes">
								<input type="hidden" name="fullJson" id="fullJson" value="<?php echo base64_encode(json_encode($fullVar, true));?>">

		<?php /*

<table class="widefat" width="30%" style="  width: 36%;">
    <thead>
    <tr>
        <th class="row-title"><?php echo __( 'Publish Your App' ); ?></th>

    </tr>
    </thead>
    <tbody>
        <tr class="alternate">
        <td class="row-title"><?php echo __( 'App on iOS & Android' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'Unlimited push notifications' ); ?></td>

    </tr>
    <tr class="alternate">
        <td class="row-title"><?php echo __( 'Schedule push notes (July)' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'HTML Rich windows' ); ?></td>

    </tr>
        <tr class="alternate">
        <td class="row-title"><?php echo __( 'Unlimited Downloads' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'We will upload your app for you'); ?></td>

    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th class="row-title" style="color:green"><center><?php echo __( 'Only $9.99 USD per month' ); ?></center></th>

    </tr>
        <tr>
        <th class="row-title" style="color:green"><center><?php echo __( 'First Month on android for free!' ); ?></center></th>

    </tr>
    </tfoot>
</table>
    */
			if ($activate[download] == 'UNLIMITED') {
				echo '<h3 style="color:red;background-color:yellow;">'.__('Hit Upgrade to Publish below', 'WordApp').'<br />';
				echo'	<input type="hidden" name="download" id="download"  value="">';
				echo'	<input class="button-primary" type="button" name="send"  id="submitPub" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Publish Android App!', 'WordApp').'"></h3>';
				//echo' <input class="button-primary" type="button" name="send"  id="submitPubPro" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Upgrade to pro only $2.99"></h3>';
				echo'	<input class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Upgrage to Pro only $2.99', 'WordApp').'">';
			} else {
				echo '<h3 style="color:red;background-color:yellow;">Your android app is now free!<br /> Hit publish below!<br />';
				echo'	<input type="hidden" name="download" id="download"  value="">';
				echo'	<input class="button-primary" type="button" name="send"  id="submitPub" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Publish Android App!', 'WordApp').'"></h3>';
				//echo' <input class="button-primary" type="button" name="send"  id="submitPubPro" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Upgrade to pro only $2.99"></h3>';
				echo'	<input class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Upgrage to Pro only $2.99', 'WordApp').'">';
			}

			/*
            echo'	<input type="hidden" name="download" id="download"  value="0">';
            echo'	<hr>Get your app from $0.99 per month for our premium service.<br />';
            echo'	<input class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Upgrage to Pro only $0.99"></h3>';
            */
			?>				<input type="hidden" name="url" id="url"  value="<?php echo get_bloginfo('url') ?>">

<?php
			/*
        if($activate->download =='0') {
            // echo '<hr> Your first month for free (Android App + Web App)! <br /><input value="Use my credits" id="submitPub"  type="button" class="button button-primary" name="publish">';
               echo '<h4><a href="admin.php?page=WordAppMoreDownloads">Get your app for free!</a></h4>';
                                            }

        */

			/* <input value="Publish my app!" id="submitPub"  type="button" class="button button-primary" name="publish"> */
?>
	   <?php

		} else {
			echo '<h3 style="color:red;">'.__('You must fill out all the information above to publish your app!', 'WordApp').'</h3><br>';

			$fullVar = array_merge($varColor, $varMenu, $varStructure, $varSlideshow, $varGA);
?>
<input type="hidden" name="bs64" id="bs64" value="yes">
								<input type="hidden" name="fullJson" id="fullJson" value="<?php echo base64_encode(json_encode($fullVar, true));?>">
					<input type="text" name="email" id="email" style="width: 400px;text-align: center;height: 50px;margin: 11px;font-size: 20px;" placeholder="<?php _e('Your email address', 'wordapp-mobile-app');
			?>" value="<?php echo get_bloginfo('admin_email') ?>"><br>
					<input type="hidden" name="url" id="url" value="<?php echo get_bloginfo('url') ?>">
					<input type="hidden" name="user" id="user" placeholder="Your Name" value="<?php echo get_bloginfo('name') ?>">

		<?php /*

<table class="widefat" width="30%" style="  width: 36%;">
    <thead>
    <tr>
        <th class="row-title"><?php echo __( 'Publish Your App' ); ?></th>

    </tr>
    </thead>
    <tbody>
        <tr class="alternate">
        <td class="row-title"><?php echo __( 'App on iOS & Android' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'Unlimited push notifications' ); ?></td>

    </tr>
    <tr class="alternate">
        <td class="row-title"><?php echo __( 'Schedule push notes (July)' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'HTML Rich windows' ); ?></td>

    </tr>
        <tr class="alternate">
        <td class="row-title"><?php echo __( 'Unlimited Downloads' ); ?></td>

    </tr>
    <tr>
        <td class="row-title"><?php echo __( 'We will upload your app for you'); ?></td>

    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th class="row-title" style="color:green"><center><?php echo __( 'Only $9.99 USD per month' ); ?></center></th>

    </tr>
        <tr>
        <th class="row-title" style="color:green"><center><?php echo __( 'First Month on android for free!' ); ?></center></th>

    </tr>
    </tfoot>
</table>
    */

			echo '<h3 style="color:red;background-color:yellow;">'.__('Your android app is now free', 'WordApp').'<br /> '.__('Hit publish below!', 'WordApp').'<br />';
			echo'	<input type="hidden" name="download" id="download"  value="">';
			//echo' <input class="button-primary" type="button" name="send"  id="submitPub" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Publish Android App!"></h3>';
			//echo' <input class="button-primary" type="button" name="send"  id="submitPubPro" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Upgrade to pro only $2.99"></h3>';
			echo'	<input class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="'.__('Upgrage to Pro only $2.99', 'WordApp').'">';

			/*
            echo'	<input type="hidden" name="download" id="download"  value="0">';
            echo'	<hr>Get your app from $0.99 per month for our premium service.<br />';
            echo'	<input class="button-primary" type="button" name="send"  id="pushNoteSend" style="margin: 12px;width: 300px;height: 54px;font-size: 21px;" value="Upgrage to Pro only $0.99"></h3>';
            */
			?>				<input type="hidden" name="url" id="url"  value="<?php echo get_bloginfo('url') ?>">

	<?php

		}
	}
?>
			<center><small><?php _e('External link', 'wordapp-mobile-app');
	?></small></center>
					</form>
		<?php

} // END Step 4
?></center>
<?php if ($active_tab == 'step4') {
} else {
?>
   <center>
   	<?php submit_button();
?>
<?php

}
?>
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

					<div class="postbox" style="max-height: 869px;">

						<h3><span><?php echo __('Preview my app', 'wordapp-mobile-app'); ?></span></h3>




						<div class="inside">
						<center>
						<?php
if (get_option('WordApp_pro') == 'on'):
?>

							<?php
	endif;
?>

<hr>
    <button style="color:#fff;background-color:red;" id="previewAppTop" data-id="https://c-m-s.mobi/previewApp/?url=<?php echo base64_encode(get_bloginfo('url')); ?>" class="fullpreviewApp" ><?php _e('Preview your app in full', 'wordapp-mobile-app');?></button>
<hr>
					</center>
         	<div id="preview">
				<center>



	<div class="ios-device ios-device--large ios-device--black iphone-6--large" style="max-width:350px;width: 100%;
  height: 620px">
					<div class="ios-device__screen" ><div id="signalBar"><img src="<?php echo plugins_url(APPNAME.'/images/ios-status-bar.png'); ?>" style="height:20px;width:100%"></div>
						<iframe width="100%" height="100%" src="<?php bloginfo('wpurl'); ?>/?WordApp_demo=1&WordApp_launch=1&datecache=<?php echo date('YmdHsi');  ?>" id="fullpreviews"  ></iframe></div>
</div>


				<hr>


                    <button style="color:#fff;background-color:red;" id="previewApp" data-id="https://c-m-s.mobi/previewApp/?url=<?php echo base64_encode(get_bloginfo('url')); ?>" class="fullpreviewApp" ><?php _e('Preview your app in full', 'wordapp-mobile-app');?></button>
<hr>


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

				<script src="https://apis.google.com/js/platform.js"></script>
<center>
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

<div class="g-ytsubscribe" data-channelid="UC7NJLsf6IonOy8QI8gt5BeA" data-layout="default" data-count="default" data-onytevent="onYtEvent"></div></center>
						<center><small><a href="admin.php?page=WordAppSettings"><?php echo __(
	"Can't see your app? Try deactivating some plugins", 'WordApp'
); ?><br /><?php echo __(
	'that are non-mobile friendly.', 'WordApp'
); ?></a></small></center>
							</div>
			<div style="" id="myPreview" style=";">
				<center>Send me instructions to my phone.
					<hr>

	<form method="POST" >

    <input type="hidden" name="numberdialcode" id="numberdialcode" value="<?php echo base64_encode(urlencode(get_bloginfo('url'))); ?>" >
    <input type="text" name="number" class="phoneNumber" id="number">
    <input type="hidden" name="site" value="<?php echo base64_encode(urlencode(get_bloginfo('url'))); ?>" >
    <input type="submit" name="submit_form" id="submitPhone" value="Submit">
 </form>
 <br> Enter your mobile phone number above and receive an SMS with instructions on how to preview your app & updates.
 	<hr>
 <img src="https://chart.googleapis.com/chart?chs=280x280&cht=qr&chl=<?php echo base64_encode(urlencode(get_bloginfo('url'))); ?>&choe=UTF-8" title="" />

					<b>
					<?php


if (get_option('WordApp_pro') != 'on'):

	/*
									?>
									<button style="color:#fff;background-color:red;" id="previewApp" data-id="<?php echo $activate['simulator']; ?>?device=iphone6&scale=65&autoplay=true&orientation=portrait&deviceColor=black&params=%7b%22starturl%22%3a%22<?php echo urlencode(get_bloginfo('url').'?WordApp_mobile_app=app'); ?>%22%7d&osVersion=8.4" class="fullpreviewApp" ><?php _e('Preview your app in full', 'wordapp-mobile-app');?></button>
					<?php

					*/
?>

                       Premium users only.


					<?php
	endif;

?>

					</b>
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
include trailingslashit(plugin_dir_path(__FILE__)).'footer.php';
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
<?php
/* --- Create selector --- */

function WordApp_nav_menu_drop_down($name, $selected = '', $print = true)
{
	// array of menu objects
	$menus = wp_get_nav_menus();
	$out = '';

	// No menu found.
	if (empty($menus) or is_a($menus, 'WP_Error')) {
		// Give some feedback …
		$out .= __('There are no menus.');

		// … and make it usable …
		if (current_user_can('edit_theme_options')) {
			$out .= sprintf(
				__(' <a href="%s">Create one</a>.'),
				admin_url('nav-menus.php')
			);
		}
		// … and stop.
		$print and print $out;

		return $out;
	}
	if (!isset($title)) {
		$title = '';
	}
	if (!isset($active)) {
		$active = '';
	}
	// Set name and ID to let you use a <label for='id_$name'>
	$out = "<select name='$name' id='id_$name'>\n";
	$out .= "\t<option value='' $active $title>".__('Select a menu')."</option>\n";
	//print_r($menus);
	foreach ($menus as $menu) {
		// Preselect the active menu
		$active = $selected == $menu->term_id ? 'selected' : '';
		// Show the description
		$title = empty($menu->description) ? '' : esc_attr($menu->description);

		$out .= "\t<option value='$menu->term_id' $active $title>$menu->name</option>\n";
	}

	$out .= '</select>';

	$print and print $out;

	return $out;
}

function listOfIcons($selected)
{
	$varColor = (array) get_option('WordApp_options');
	$varMenu = (array) get_option('WordApp_menu');
if($selected == ''){ $selected = "bars"; }
	if(!isset($varColor['local'])) $varColor['local']='';

	if (strpos($varColor['theme'], '|') !== false) {
		list($themeSelected, $themeType) = explode('|', $varColor['theme']);
	}else{
		$themeSelected = $varColor['theme'];
		$themeType ='';
	}
	if($themeSelected == 'MyTheme' && ($varMenu['barstyle'] == '' || $varMenu['barstyle'] == 'Default')){
		$dfault = '1';

	}else if($themeSelected != 'MyTheme'){
			$dfault = '1';
		}
	else{
		$dfault = '0';

	}
	$selected = $selected;
	if ($themeSelected == 'MyiOS' || $themeSelected == 'MyTheme2' || $varColor['local'] == 'remote' || $dfault == '0') {

		$vals = '<option '.($selected == 'adjust' ? 'selected' : '').' >adjust</option>
<option '.($selected == 'adn' ? 'selected' : '').' >adn</option>
<option '.($selected == 'align-center' ? 'selected' : '').' >align-center</option>
<option '.($selected == 'align-justify' ? 'selected' : '').' >align-justify</option>
<option '.($selected == 'align-left' ? 'selected' : '').' >align-left</option>
<option '.($selected == 'align-right' ? 'selected' : '').' >align-right</option>
<option '.($selected == 'ambulance' ? 'selected' : '').' >ambulance</option>
<option '.($selected == 'anchor' ? 'selected' : '').' >anchor</option>
<option '.($selected == 'android' ? 'selected' : '').' >android</option>
<option '.($selected == 'angellist' ? 'selected' : '').' >angellist</option>
<option '.($selected == 'angle-double-down' ? 'selected' : '').' >angle-double-down</option>
<option '.($selected == 'angle-double-left' ? 'selected' : '').' >angle-double-left</option>
<option '.($selected == 'angle-double-right' ? 'selected' : '').' >angle-double-right</option>
<option '.($selected == 'angle-double-up' ? 'selected' : '').' >angle-double-up</option>
<option '.($selected == 'angle-down' ? 'selected' : '').' >angle-down</option>
<option '.($selected == 'angle-left' ? 'selected' : '').' >angle-left</option>
<option '.($selected == 'angle-right' ? 'selected' : '').' >angle-right</option>
<option '.($selected == 'angle-up' ? 'selected' : '').' >angle-up</option>
<option '.($selected == 'apple' ? 'selected' : '').' >apple</option>
<option '.($selected == 'archive' ? 'selected' : '').' >archive</option>
<option '.($selected == 'area-chart' ? 'selected' : '').' >area-chart</option>
<option '.($selected == 'arrow-circle-down' ? 'selected' : '').' >arrow-circle-down</option>
<option '.($selected == 'arrow-circle-left' ? 'selected' : '').' >arrow-circle-left</option>
<option '.($selected == 'arrow-circle-o-down' ? 'selected' : '').' >arrow-circle-o-down</option>
<option '.($selected == 'arrow-circle-o-left' ? 'selected' : '').' >arrow-circle-o-left</option>
<option '.($selected == 'arrow-circle-o-right' ? 'selected' : '').' >arrow-circle-o-right</option>
<option '.($selected == 'arrow-circle-o-up' ? 'selected' : '').' >arrow-circle-o-up</option>
<option '.($selected == 'arrow-circle-right' ? 'selected' : '').' >arrow-circle-right</option>
<option '.($selected == 'arrow-circle-up' ? 'selected' : '').' >arrow-circle-up</option>
<option '.($selected == 'arrow-down' ? 'selected' : '').' >arrow-down</option>
<option '.($selected == 'arrow-left' ? 'selected' : '').' >arrow-left</option>
<option '.($selected == 'arrow-right' ? 'selected' : '').' >arrow-right</option>
<option '.($selected == 'arrow-up' ? 'selected' : '').' >arrow-up</option>
<option '.($selected == 'arrows' ? 'selected' : '').' >arrows</option>
<option '.($selected == 'arrows-alt' ? 'selected' : '').' >arrows-alt</option>
<option '.($selected == 'arrows-h' ? 'selected' : '').' >arrows-h</option>
<option '.($selected == 'arrows-v' ? 'selected' : '').' >arrows-v</option>
<option '.($selected == 'asterisk' ? 'selected' : '').' >asterisk</option>
<option '.($selected == 'at' ? 'selected' : '').' >at</option>
<option '.($selected == 'automobile' ? 'selected' : '').' >automobile</option>
<option '.($selected == 'backward' ? 'selected' : '').' >backward</option>
<option '.($selected == 'ban' ? 'selected' : '').' >ban</option>
<option '.($selected == 'bank' ? 'selected' : '').' >bank</option>
<option '.($selected == 'bar-chart' ? 'selected' : '').' >bar-chart</option>
<option '.($selected == 'bar-chart-o' ? 'selected' : '').' >bar-chart-o</option>
<option '.($selected == 'barcode' ? 'selected' : '').' >barcode</option>
<option '.($selected == 'bars' ? 'selected' : '').' >bars</option>
<option '.($selected == 'bed' ? 'selected' : '').' >bed</option>
<option '.($selected == 'beer' ? 'selected' : '').' >beer</option>
<option '.($selected == 'behance' ? 'selected' : '').' >behance</option>
<option '.($selected == 'behance-square' ? 'selected' : '').' >behance-square</option>
<option '.($selected == 'bell' ? 'selected' : '').' >bell</option>
<option '.($selected == 'bell-o' ? 'selected' : '').' >bell-o</option>
<option '.($selected == 'bell-slash' ? 'selected' : '').' >bell-slash</option>
<option '.($selected == 'bell-slash-o' ? 'selected' : '').' >bell-slash-o</option>
<option '.($selected == 'bicycle' ? 'selected' : '').' >bicycle</option>
<option '.($selected == 'binoculars' ? 'selected' : '').' >binoculars</option>
<option '.($selected == 'birthday-cake' ? 'selected' : '').' >birthday-cake</option>
<option '.($selected == 'bitbucket' ? 'selected' : '').' >bitbucket</option>
<option '.($selected == 'bitbucket-square' ? 'selected' : '').' >bitbucket-square</option>
<option '.($selected == 'bitcoin' ? 'selected' : '').' >bitcoin</option>
<option '.($selected == 'bold' ? 'selected' : '').' >bold</option>
<option '.($selected == 'bolt' ? 'selected' : '').' >bolt</option>
<option '.($selected == 'bomb' ? 'selected' : '').' >bomb</option>
<option '.($selected == 'book' ? 'selected' : '').' >book</option>
<option '.($selected == 'bookmark' ? 'selected' : '').' >bookmark</option>
<option '.($selected == 'bookmark-o' ? 'selected' : '').' >bookmark-o</option>
<option '.($selected == 'briefcase' ? 'selected' : '').' >briefcase</option>
<option '.($selected == 'btc' ? 'selected' : '').' >btc</option>
<option '.($selected == 'bug' ? 'selected' : '').' >bug</option>
<option '.($selected == 'building' ? 'selected' : '').' >building</option>
<option '.($selected == 'building-o' ? 'selected' : '').' >building-o</option>
<option '.($selected == 'bullhorn' ? 'selected' : '').' >bullhorn</option>
<option '.($selected == 'bullseye' ? 'selected' : '').' >bullseye</option>
<option '.($selected == 'bus' ? 'selected' : '').' >bus</option>
<option '.($selected == 'buysellads' ? 'selected' : '').' >buysellads</option>
<option '.($selected == 'cab' ? 'selected' : '').' >cab</option>
<option '.($selected == 'calculator' ? 'selected' : '').' >calculator</option>
<option '.($selected == 'calendar' ? 'selected' : '').' >calendar</option>
<option '.($selected == 'calendar-o' ? 'selected' : '').' >calendar-o</option>
<option '.($selected == 'camera' ? 'selected' : '').' >camera</option>
<option '.($selected == 'camera-retro' ? 'selected' : '').' >camera-retro</option>
<option '.($selected == 'car' ? 'selected' : '').' >car</option>
<option '.($selected == 'caret-down' ? 'selected' : '').' >caret-down</option>
<option '.($selected == 'caret-left' ? 'selected' : '').' >caret-left</option>
<option '.($selected == 'caret-right' ? 'selected' : '').' >caret-right</option>
<option '.($selected == 'caret-square-o-down' ? 'selected' : '').' >caret-square-o-down</option>
<option '.($selected == 'caret-square-o-left' ? 'selected' : '').' >caret-square-o-left</option>
<option '.($selected == 'caret-square-o-right' ? 'selected' : '').' >caret-square-o-right</option>
<option '.($selected == 'caret-square-o-up' ? 'selected' : '').' >caret-square-o-up</option>
<option '.($selected == 'caret-up' ? 'selected' : '').' >caret-up</option>
<option '.($selected == 'cart-arrow-down' ? 'selected' : '').' >cart-arrow-down</option>
<option '.($selected == 'cart-plus' ? 'selected' : '').' >cart-plus</option>
<option '.($selected == 'cc' ? 'selected' : '').' >cc</option>
<option '.($selected == 'cc-amex' ? 'selected' : '').' >cc-amex</option>
<option '.($selected == 'cc-discover' ? 'selected' : '').' >cc-discover</option>
<option '.($selected == 'cc-mastercard' ? 'selected' : '').' >cc-mastercard</option>
<option '.($selected == 'cc-paypal' ? 'selected' : '').' >cc-paypal</option>
<option '.($selected == 'cc-stripe' ? 'selected' : '').' >cc-stripe</option>
<option '.($selected == 'cc-visa' ? 'selected' : '').' >cc-visa</option>
<option '.($selected == 'certificate' ? 'selected' : '').' >certificate</option>
<option '.($selected == 'chain' ? 'selected' : '').' >chain</option>
<option '.($selected == 'chain-broken' ? 'selected' : '').' >chain-broken</option>
<option '.($selected == 'check' ? 'selected' : '').' >check</option>
<option '.($selected == 'check-circle' ? 'selected' : '').' >check-circle</option>
<option '.($selected == 'check-circle-o' ? 'selected' : '').' >check-circle-o</option>
<option '.($selected == 'check-square' ? 'selected' : '').' >check-square</option>
<option '.($selected == 'check-square-o' ? 'selected' : '').' >check-square-o</option>
<option '.($selected == 'chevron-circle-down' ? 'selected' : '').' >chevron-circle-down</option>
<option '.($selected == 'chevron-circle-left' ? 'selected' : '').' >chevron-circle-left</option>
<option '.($selected == 'chevron-circle-right' ? 'selected' : '').' >chevron-circle-right</option>
<option '.($selected == 'chevron-circle-up' ? 'selected' : '').' >chevron-circle-up</option>
<option '.($selected == 'chevron-down' ? 'selected' : '').' >chevron-down</option>
<option '.($selected == 'chevron-left' ? 'selected' : '').' >chevron-left</option>
<option '.($selected == 'chevron-right' ? 'selected' : '').' >chevron-right</option>
<option '.($selected == 'chevron-up' ? 'selected' : '').' >chevron-up</option>
<option '.($selected == 'child' ? 'selected' : '').' >child</option>
<option '.($selected == 'circle' ? 'selected' : '').' >circle</option>
<option '.($selected == 'circle-o' ? 'selected' : '').' >circle-o</option>
<option '.($selected == 'circle-o-notch' ? 'selected' : '').' >circle-o-notch</option>
<option '.($selected == 'circle-thin' ? 'selected' : '').' >circle-thin</option>
<option '.($selected == 'clipboard' ? 'selected' : '').' >clipboard</option>
<option '.($selected == 'clock-o' ? 'selected' : '').' >clock-o</option>
<option '.($selected == 'close' ? 'selected' : '').' >close</option>
<option '.($selected == 'cloud' ? 'selected' : '').' >cloud</option>
<option '.($selected == 'cloud-download' ? 'selected' : '').' >cloud-download</option>
<option '.($selected == 'cloud-upload' ? 'selected' : '').' >cloud-upload</option>
<option '.($selected == 'cny' ? 'selected' : '').' >cny</option>
<option '.($selected == 'code' ? 'selected' : '').' >code</option>
<option '.($selected == 'code-fork' ? 'selected' : '').' >code-fork</option>
<option '.($selected == 'codepen' ? 'selected' : '').' >codepen</option>
<option '.($selected == 'coffee' ? 'selected' : '').' >coffee</option>
<option '.($selected == 'cog' ? 'selected' : '').' >cog</option>
<option '.($selected == 'cogs' ? 'selected' : '').' >cogs</option>
<option '.($selected == 'columns' ? 'selected' : '').' >columns</option>
<option '.($selected == 'comment' ? 'selected' : '').' >comment</option>
<option '.($selected == 'comment-o' ? 'selected' : '').' >comment-o</option>
<option '.($selected == 'comments' ? 'selected' : '').' >comments</option>
<option '.($selected == 'comments-o' ? 'selected' : '').' >comments-o</option>
<option '.($selected == 'compass' ? 'selected' : '').' >compass</option>
<option '.($selected == 'compress' ? 'selected' : '').' >compress</option>
<option '.($selected == 'connectdevelop' ? 'selected' : '').' >connectdevelop</option>
<option '.($selected == 'copy' ? 'selected' : '').' >copy</option>
<option '.($selected == 'copyright' ? 'selected' : '').' >copyright</option>
<option '.($selected == 'credit-card' ? 'selected' : '').' >credit-card</option>
<option '.($selected == 'crop' ? 'selected' : '').' >crop</option>
<option '.($selected == 'crosshairs' ? 'selected' : '').' >crosshairs</option>
<option '.($selected == 'css3' ? 'selected' : '').' >css3</option>
<option '.($selected == 'cube' ? 'selected' : '').' >cube</option>
<option '.($selected == 'cubes' ? 'selected' : '').' >cubes</option>
<option '.($selected == 'cut' ? 'selected' : '').' >cut</option>
<option '.($selected == 'cutlery' ? 'selected' : '').' >cutlery</option>
<option '.($selected == 'dashboard' ? 'selected' : '').' >dashboard</option>
<option '.($selected == 'dashcube' ? 'selected' : '').' >dashcube</option>
<option '.($selected == 'database' ? 'selected' : '').' >database</option>
<option '.($selected == 'dedent' ? 'selected' : '').' >dedent</option>
<option '.($selected == 'delicious' ? 'selected' : '').' >delicious</option>
<option '.($selected == 'desktop' ? 'selected' : '').' >desktop</option>
<option '.($selected == 'deviantart' ? 'selected' : '').' >deviantart</option>
<option '.($selected == 'diamond' ? 'selected' : '').' >diamond</option>
<option '.($selected == 'digg' ? 'selected' : '').' >digg</option>
<option '.($selected == 'dollar' ? 'selected' : '').' >dollar</option>
<option '.($selected == 'dot-circle-o' ? 'selected' : '').' >dot-circle-o</option>
<option '.($selected == 'download' ? 'selected' : '').' >download</option>
<option '.($selected == 'dribbble' ? 'selected' : '').' >dribbble</option>
<option '.($selected == 'dropbox' ? 'selected' : '').' >dropbox</option>
<option '.($selected == 'drupal' ? 'selected' : '').' >drupal</option>
<option '.($selected == 'edit' ? 'selected' : '').' >edit</option>
<option '.($selected == 'eject' ? 'selected' : '').' >eject</option>
<option '.($selected == 'ellipsis-h' ? 'selected' : '').' >ellipsis-h</option>
<option '.($selected == 'ellipsis-v' ? 'selected' : '').' >ellipsis-v</option>
<option '.($selected == 'empire' ? 'selected' : '').' >empire</option>
<option '.($selected == 'envelope' ? 'selected' : '').' >envelope</option>
<option '.($selected == 'envelope-o' ? 'selected' : '').' >envelope-o</option>
<option '.($selected == 'envelope-square' ? 'selected' : '').' >envelope-square</option>
<option '.($selected == 'eraser' ? 'selected' : '').' >eraser</option>
<option '.($selected == 'eur' ? 'selected' : '').' >eur</option>
<option '.($selected == 'euro' ? 'selected' : '').' >euro</option>
<option '.($selected == 'exchange' ? 'selected' : '').' >exchange</option>
<option '.($selected == 'exclamation' ? 'selected' : '').' >exclamation</option>
<option '.($selected == 'exclamation-circle' ? 'selected' : '').' >exclamation-circle</option>
<option '.($selected == 'exclamation-triangle' ? 'selected' : '').' >exclamation-triangle</option>
<option '.($selected == 'expand' ? 'selected' : '').' >expand</option>
<option '.($selected == 'external-link' ? 'selected' : '').' >external-link</option>
<option '.($selected == 'external-link-square' ? 'selected' : '').' >external-link-square</option>
<option '.($selected == 'eye' ? 'selected' : '').' >eye</option>
<option '.($selected == 'eye-slash' ? 'selected' : '').' >eye-slash</option>
<option '.($selected == 'eyedropper' ? 'selected' : '').' >eyedropper</option>
<option '.($selected == 'facebook' ? 'selected' : '').' >facebook</option>
<option '.($selected == 'facebook-f' ? 'selected' : '').' >facebook-f</option>
<option '.($selected == 'facebook-official' ? 'selected' : '').' >facebook-official</option>
<option '.($selected == 'facebook-square' ? 'selected' : '').' >facebook-square</option>
<option '.($selected == 'fast-backward' ? 'selected' : '').' >fast-backward</option>
<option '.($selected == 'fast-forward' ? 'selected' : '').' >fast-forward</option>
<option '.($selected == 'fax' ? 'selected' : '').' >fax</option>
<option '.($selected == 'female' ? 'selected' : '').' >female</option>
<option '.($selected == 'fighter-jet' ? 'selected' : '').' >fighter-jet</option>
<option '.($selected == 'file' ? 'selected' : '').' >file</option>
<option '.($selected == 'file-archive-o' ? 'selected' : '').' >file-archive-o</option>
<option '.($selected == 'file-audio-o' ? 'selected' : '').' >file-audio-o</option>
<option '.($selected == 'file-code-o' ? 'selected' : '').' >file-code-o</option>
<option '.($selected == 'file-excel-o' ? 'selected' : '').' >file-excel-o</option>
<option '.($selected == 'file-image-o' ? 'selected' : '').' >file-image-o</option>
<option '.($selected == 'file-movie-o' ? 'selected' : '').' >file-movie-o</option>
<option '.($selected == 'file-o' ? 'selected' : '').' >file-o</option>
<option '.($selected == 'file-pdf-o' ? 'selected' : '').' >file-pdf-o</option>
<option '.($selected == 'file-photo-o' ? 'selected' : '').' >file-photo-o</option>
<option '.($selected == 'file-picture-o' ? 'selected' : '').' >file-picture-o</option>
<option '.($selected == 'file-powerpoint-o' ? 'selected' : '').' >file-powerpoint-o</option>
<option '.($selected == 'file-sound-o' ? 'selected' : '').' >file-sound-o</option>
<option '.($selected == 'file-text' ? 'selected' : '').' >file-text</option>
<option '.($selected == 'file-text-o' ? 'selected' : '').' >file-text-o</option>
<option '.($selected == 'file-video-o' ? 'selected' : '').' >file-video-o</option>
<option '.($selected == 'file-word-o' ? 'selected' : '').' >file-word-o</option>
<option '.($selected == 'file-zip-o' ? 'selected' : '').' >file-zip-o</option>
<option '.($selected == 'files-o' ? 'selected' : '').' >files-o</option>
<option '.($selected == 'film' ? 'selected' : '').' >film</option>
<option '.($selected == 'filter' ? 'selected' : '').' >filter</option>
<option '.($selected == 'fire' ? 'selected' : '').' >fire</option>
<option '.($selected == 'fire-extinguisher' ? 'selected' : '').' >fire-extinguisher</option>
<option '.($selected == 'flag' ? 'selected' : '').' >flag</option>
<option '.($selected == 'flag-checkered' ? 'selected' : '').' >flag-checkered</option>
<option '.($selected == 'flag-o' ? 'selected' : '').' >flag-o</option>
<option '.($selected == 'flash' ? 'selected' : '').' >flash</option>
<option '.($selected == 'flask' ? 'selected' : '').' >flask</option>
<option '.($selected == 'flickr' ? 'selected' : '').' >flickr</option>
<option '.($selected == 'floppy-o' ? 'selected' : '').' >floppy-o</option>
<option '.($selected == 'folder' ? 'selected' : '').' >folder</option>
<option '.($selected == 'folder-o' ? 'selected' : '').' >folder-o</option>
<option '.($selected == 'folder-open' ? 'selected' : '').' >folder-open</option>
<option '.($selected == 'folder-open-o' ? 'selected' : '').' >folder-open-o</option>
<option '.($selected == 'font' ? 'selected' : '').' >font</option>
<option '.($selected == 'forumbee' ? 'selected' : '').' >forumbee</option>
<option '.($selected == 'forward' ? 'selected' : '').' >forward</option>
<option '.($selected == 'foursquare' ? 'selected' : '').' >foursquare</option>
<option '.($selected == 'frown-o' ? 'selected' : '').' >frown-o</option>
<option '.($selected == 'futbol-o' ? 'selected' : '').' >futbol-o</option>
<option '.($selected == 'gamepad' ? 'selected' : '').' >gamepad</option>
<option '.($selected == 'gavel' ? 'selected' : '').' >gavel</option>
<option '.($selected == 'gbp' ? 'selected' : '').' >gbp</option>
<option '.($selected == 'ge' ? 'selected' : '').' >ge</option>
<option '.($selected == 'gear' ? 'selected' : '').' >gear</option>
<option '.($selected == 'gears' ? 'selected' : '').' >gears</option>
<option '.($selected == 'genderless' ? 'selected' : '').' >genderless</option>
<option '.($selected == 'gift' ? 'selected' : '').' >gift</option>
<option '.($selected == 'git' ? 'selected' : '').' >git</option>
<option '.($selected == 'git-square' ? 'selected' : '').' >git-square</option>
<option '.($selected == 'github' ? 'selected' : '').' >github</option>
<option '.($selected == 'github-alt' ? 'selected' : '').' >github-alt</option>
<option '.($selected == 'github-square' ? 'selected' : '').' >github-square</option>
<option '.($selected == 'gittip' ? 'selected' : '').' >gittip</option>
<option '.($selected == 'glass' ? 'selected' : '').' >glass</option>
<option '.($selected == 'globe' ? 'selected' : '').' >globe</option>
<option '.($selected == 'google' ? 'selected' : '').' >google</option>
<option '.($selected == 'google-plus' ? 'selected' : '').' >google-plus</option>
<option '.($selected == 'google-plus-square' ? 'selected' : '').' >google-plus-square</option>
<option '.($selected == 'google-wallet' ? 'selected' : '').' >google-wallet</option>
<option '.($selected == 'graduation-cap' ? 'selected' : '').' >graduation-cap</option>
<option '.($selected == 'gratipay' ? 'selected' : '').' >gratipay</option>
<option '.($selected == 'group' ? 'selected' : '').' >group</option>
<option '.($selected == 'h-square' ? 'selected' : '').' >h-square</option>
<option '.($selected == 'hacker-news' ? 'selected' : '').' >hacker-news</option>
<option '.($selected == 'hand-o-down' ? 'selected' : '').' >hand-o-down</option>
<option '.($selected == 'hand-o-left' ? 'selected' : '').' >hand-o-left</option>
<option '.($selected == 'hand-o-right' ? 'selected' : '').' >hand-o-right</option>
<option '.($selected == 'hand-o-up' ? 'selected' : '').' >hand-o-up</option>
<option '.($selected == 'hdd-o' ? 'selected' : '').' >hdd-o</option>
<option '.($selected == 'header' ? 'selected' : '').' >header</option>
<option '.($selected == 'headphones' ? 'selected' : '').' >headphones</option>
<option '.($selected == 'heart' ? 'selected' : '').' >heart</option>
<option '.($selected == 'heart-o' ? 'selected' : '').' >heart-o</option>
<option '.($selected == 'heartbeat' ? 'selected' : '').' >heartbeat</option>
<option '.($selected == 'history' ? 'selected' : '').' >history</option>
<option '.($selected == 'home' ? 'selected' : '').' >home</option>
<option '.($selected == 'hospital-o' ? 'selected' : '').' >hospital-o</option>
<option '.($selected == 'hotel' ? 'selected' : '').' >hotel</option>
<option '.($selected == 'html5' ? 'selected' : '').' >html5</option>
<option '.($selected == 'ils' ? 'selected' : '').' >ils</option>
<option '.($selected == 'image' ? 'selected' : '').' >image</option>
<option '.($selected == 'inbox' ? 'selected' : '').' >inbox</option>
<option '.($selected == 'indent' ? 'selected' : '').' >indent</option>
<option '.($selected == 'info' ? 'selected' : '').' >info</option>
<option '.($selected == 'info-circle' ? 'selected' : '').' >info-circle</option>
<option '.($selected == 'inr' ? 'selected' : '').' >inr</option>
<option '.($selected == 'instagram' ? 'selected' : '').' >instagram</option>
<option '.($selected == 'institution' ? 'selected' : '').' >institution</option>
<option '.($selected == 'ioxhost' ? 'selected' : '').' >ioxhost</option>
<option '.($selected == 'italic' ? 'selected' : '').' >italic</option>
<option '.($selected == 'joomla' ? 'selected' : '').' >joomla</option>
<option '.($selected == 'jpy' ? 'selected' : '').' >jpy</option>
<option '.($selected == 'jsfiddle' ? 'selected' : '').' >jsfiddle</option>
<option '.($selected == 'key' ? 'selected' : '').' >key</option>
<option '.($selected == 'keyboard-o' ? 'selected' : '').' >keyboard-o</option>
<option '.($selected == 'krw' ? 'selected' : '').' >krw</option>
<option '.($selected == 'language' ? 'selected' : '').' >language</option>
<option '.($selected == 'laptop' ? 'selected' : '').' >laptop</option>
<option '.($selected == 'lastfm' ? 'selected' : '').' >lastfm</option>
<option '.($selected == 'lastfm-square' ? 'selected' : '').' >lastfm-square</option>
<option '.($selected == 'leaf' ? 'selected' : '').' >leaf</option>
<option '.($selected == 'leanpub' ? 'selected' : '').' >leanpub</option>
<option '.($selected == 'legal' ? 'selected' : '').' >legal</option>
<option '.($selected == 'lemon-o' ? 'selected' : '').' >lemon-o</option>
<option '.($selected == 'level-down' ? 'selected' : '').' >level-down</option>
<option '.($selected == 'level-up' ? 'selected' : '').' >level-up</option>
<option '.($selected == 'life-bouy' ? 'selected' : '').' >life-bouy</option>
<option '.($selected == 'life-buoy' ? 'selected' : '').' >life-buoy</option>
<option '.($selected == 'life-ring' ? 'selected' : '').' >life-ring</option>
<option '.($selected == 'life-saver' ? 'selected' : '').' >life-saver</option>
<option '.($selected == 'lightbulb-o' ? 'selected' : '').' >lightbulb-o</option>
<option '.($selected == 'line-chart' ? 'selected' : '').' >line-chart</option>
<option '.($selected == 'link' ? 'selected' : '').' >link</option>
<option '.($selected == 'linkedin' ? 'selected' : '').' >linkedin</option>
<option '.($selected == 'linkedin-square' ? 'selected' : '').' >linkedin-square</option>
<option '.($selected == 'linux' ? 'selected' : '').' >linux</option>
<option '.($selected == 'list' ? 'selected' : '').' >list</option>
<option '.($selected == 'list-alt' ? 'selected' : '').' >list-alt</option>
<option '.($selected == 'list-ol' ? 'selected' : '').' >list-ol</option>
<option '.($selected == 'list-ul' ? 'selected' : '').' >list-ul</option>
<option '.($selected == 'location-arrow' ? 'selected' : '').' >location-arrow</option>
<option '.($selected == 'lock' ? 'selected' : '').' >lock</option>
<option '.($selected == 'long-arrow-down' ? 'selected' : '').' >long-arrow-down</option>
<option '.($selected == 'long-arrow-left' ? 'selected' : '').' >long-arrow-left</option>
<option '.($selected == 'long-arrow-right' ? 'selected' : '').' >long-arrow-right</option>
<option '.($selected == 'long-arrow-up' ? 'selected' : '').' >long-arrow-up</option>
<option '.($selected == 'magic' ? 'selected' : '').' >magic</option>
<option '.($selected == 'magnet' ? 'selected' : '').' >magnet</option>
<option '.($selected == 'mail-forward' ? 'selected' : '').' >mail-forward</option>
<option '.($selected == 'mail-reply' ? 'selected' : '').' >mail-reply</option>
<option '.($selected == 'mail-reply-all' ? 'selected' : '').' >mail-reply-all</option>
<option '.($selected == 'male' ? 'selected' : '').' >male</option>
<option '.($selected == 'map-marker' ? 'selected' : '').' >map-marker</option>
<option '.($selected == 'mars' ? 'selected' : '').' >mars</option>
<option '.($selected == 'mars-double' ? 'selected' : '').' >mars-double</option>
<option '.($selected == 'mars-stroke' ? 'selected' : '').' >mars-stroke</option>
<option '.($selected == 'mars-stroke-h' ? 'selected' : '').' >mars-stroke-h</option>
<option '.($selected == 'mars-stroke-v' ? 'selected' : '').' >mars-stroke-v</option>
<option '.($selected == 'maxcdn' ? 'selected' : '').' >maxcdn</option>
<option '.($selected == 'meanpath' ? 'selected' : '').' >meanpath</option>
<option '.($selected == 'medium' ? 'selected' : '').' >medium</option>
<option '.($selected == 'medkit' ? 'selected' : '').' >medkit</option>
<option '.($selected == 'meh-o' ? 'selected' : '').' >meh-o</option>
<option '.($selected == 'mercury' ? 'selected' : '').' >mercury</option>
<option '.($selected == 'microphone' ? 'selected' : '').' >microphone</option>
<option '.($selected == 'microphone-slash' ? 'selected' : '').' >microphone-slash</option>
<option '.($selected == 'minus' ? 'selected' : '').' >minus</option>
<option '.($selected == 'minus-circle' ? 'selected' : '').' >minus-circle</option>
<option '.($selected == 'minus-square' ? 'selected' : '').' >minus-square</option>
<option '.($selected == 'minus-square-o' ? 'selected' : '').' >minus-square-o</option>
<option '.($selected == 'mobile' ? 'selected' : '').' >mobile</option>
<option '.($selected == 'mobile-phone' ? 'selected' : '').' >mobile-phone</option>
<option '.($selected == 'money' ? 'selected' : '').' >money</option>
<option '.($selected == 'moon-o' ? 'selected' : '').' >moon-o</option>
<option '.($selected == 'mortar-board' ? 'selected' : '').' >mortar-board</option>
<option '.($selected == 'motorcycle' ? 'selected' : '').' >motorcycle</option>
<option '.($selected == 'music' ? 'selected' : '').' >music</option>
<option '.($selected == 'navicon' ? 'selected' : '').' >navicon</option>
<option '.($selected == 'neuter' ? 'selected' : '').' >neuter</option>
<option '.($selected == 'newspaper-o' ? 'selected' : '').' >newspaper-o</option>
<option '.($selected == 'openid' ? 'selected' : '').' >openid</option>
<option '.($selected == 'outdent' ? 'selected' : '').' >outdent</option>
<option '.($selected == 'pagelines' ? 'selected' : '').' >pagelines</option>
<option '.($selected == 'paint-brush' ? 'selected' : '').' >paint-brush</option>
<option '.($selected == 'paper-plane' ? 'selected' : '').' >paper-plane</option>
<option '.($selected == 'paper-plane-o' ? 'selected' : '').' >paper-plane-o</option>
<option '.($selected == 'paperclip' ? 'selected' : '').' >paperclip</option>
<option '.($selected == 'paragraph' ? 'selected' : '').' >paragraph</option>
<option '.($selected == 'paste' ? 'selected' : '').' >paste</option>
<option '.($selected == 'pause' ? 'selected' : '').' >pause</option>
<option '.($selected == 'paw' ? 'selected' : '').' >paw</option>
<option '.($selected == 'paypal' ? 'selected' : '').' >paypal</option>
<option '.($selected == 'pencil' ? 'selected' : '').' >pencil</option>
<option '.($selected == 'pencil-square' ? 'selected' : '').' >pencil-square</option>
<option '.($selected == 'pencil-square-o' ? 'selected' : '').' >pencil-square-o</option>
<option '.($selected == 'phone' ? 'selected' : '').' >phone</option>
<option '.($selected == 'phone-square' ? 'selected' : '').' >phone-square</option>
<option '.($selected == 'photo' ? 'selected' : '').' >photo</option>
<option '.($selected == 'picture-o' ? 'selected' : '').' >picture-o</option>
<option '.($selected == 'pie-chart' ? 'selected' : '').' >pie-chart</option>
<option '.($selected == 'pied-piper' ? 'selected' : '').' >pied-piper</option>
<option '.($selected == 'pied-piper-alt' ? 'selected' : '').' >pied-piper-alt</option>
<option '.($selected == 'pinterest' ? 'selected' : '').' >pinterest</option>
<option '.($selected == 'pinterest-p' ? 'selected' : '').' >pinterest-p</option>
<option '.($selected == 'pinterest-square' ? 'selected' : '').' >pinterest-square</option>
<option '.($selected == 'plane' ? 'selected' : '').' >plane</option>
<option '.($selected == 'play' ? 'selected' : '').' >play</option>
<option '.($selected == 'play-circle' ? 'selected' : '').' >play-circle</option>
<option '.($selected == 'play-circle-o' ? 'selected' : '').' >play-circle-o</option>
<option '.($selected == 'plug' ? 'selected' : '').' >plug</option>
<option '.($selected == 'plus' ? 'selected' : '').' >plus</option>
<option '.($selected == 'plus-circle' ? 'selected' : '').' >plus-circle</option>
<option '.($selected == 'plus-square' ? 'selected' : '').' >plus-square</option>
<option '.($selected == 'plus-square-o' ? 'selected' : '').' >plus-square-o</option>
<option '.($selected == 'power-off' ? 'selected' : '').' >power-off</option>
<option '.($selected == 'print' ? 'selected' : '').' >print</option>
<option '.($selected == 'puzzle-piece' ? 'selected' : '').' >puzzle-piece</option>
<option '.($selected == 'qq' ? 'selected' : '').' >qq</option>
<option '.($selected == 'qrcode' ? 'selected' : '').' >qrcode</option>
<option '.($selected == 'question' ? 'selected' : '').' >question</option>
<option '.($selected == 'question-circle' ? 'selected' : '').' >question-circle</option>
<option '.($selected == 'quote-left' ? 'selected' : '').' >quote-left</option>
<option '.($selected == 'quote-right' ? 'selected' : '').' >quote-right</option>
<option '.($selected == 'ra' ? 'selected' : '').' >ra</option>
<option '.($selected == 'random' ? 'selected' : '').' >random</option>
<option '.($selected == 'rebel' ? 'selected' : '').' >rebel</option>
<option '.($selected == 'recycle' ? 'selected' : '').' >recycle</option>
<option '.($selected == 'reddit' ? 'selected' : '').' >reddit</option>
<option '.($selected == 'reddit-square' ? 'selected' : '').' >reddit-square</option>
<option '.($selected == 'refresh' ? 'selected' : '').' >refresh</option>
<option '.($selected == 'remove' ? 'selected' : '').' >remove</option>
<option '.($selected == 'renren' ? 'selected' : '').' >renren</option>
<option '.($selected == 'reorder' ? 'selected' : '').' >reorder</option>
<option '.($selected == 'repeat' ? 'selected' : '').' >repeat</option>
<option '.($selected == 'reply' ? 'selected' : '').' >reply</option>
<option '.($selected == 'reply-all' ? 'selected' : '').' >reply-all</option>
<option '.($selected == 'retweet' ? 'selected' : '').' >retweet</option>
<option '.($selected == 'rmb' ? 'selected' : '').' >rmb</option>
<option '.($selected == 'road' ? 'selected' : '').' >road</option>
<option '.($selected == 'rocket' ? 'selected' : '').' >rocket</option>
<option '.($selected == 'rotate-left' ? 'selected' : '').' >rotate-left</option>
<option '.($selected == 'rotate-right' ? 'selected' : '').' >rotate-right</option>
<option '.($selected == 'rouble' ? 'selected' : '').' >rouble</option>
<option '.($selected == 'rss' ? 'selected' : '').' >rss</option>
<option '.($selected == 'rss-square' ? 'selected' : '').' >rss-square</option>
<option '.($selected == 'rub' ? 'selected' : '').' >rub</option>
<option '.($selected == 'ruble' ? 'selected' : '').' >ruble</option>
<option '.($selected == 'rupee' ? 'selected' : '').' >rupee</option>
<option '.($selected == 'save' ? 'selected' : '').' >save</option>
<option '.($selected == 'scissors' ? 'selected' : '').' >scissors</option>
<option '.($selected == 'search' ? 'selected' : '').' >search</option>
<option '.($selected == 'search-minus' ? 'selected' : '').' >search-minus</option>
<option '.($selected == 'search-plus' ? 'selected' : '').' >search-plus</option>
<option '.($selected == 'sellsy' ? 'selected' : '').' >sellsy</option>
<option '.($selected == 'send' ? 'selected' : '').' >send</option>
<option '.($selected == 'send-o' ? 'selected' : '').' >send-o</option>
<option '.($selected == 'server' ? 'selected' : '').' >server</option>
<option '.($selected == 'share' ? 'selected' : '').' >share</option>
<option '.($selected == 'share-alt' ? 'selected' : '').' >share-alt</option>
<option '.($selected == 'share-alt-square' ? 'selected' : '').' >share-alt-square</option>
<option '.($selected == 'share-square' ? 'selected' : '').' >share-square</option>
<option '.($selected == 'share-square-o' ? 'selected' : '').' >share-square-o</option>
<option '.($selected == 'shekel' ? 'selected' : '').' >shekel</option>
<option '.($selected == 'sheqel' ? 'selected' : '').' >sheqel</option>
<option '.($selected == 'shield' ? 'selected' : '').' >shield</option>
<option '.($selected == 'ship' ? 'selected' : '').' >ship</option>
<option '.($selected == 'shirtsinbulk' ? 'selected' : '').' >shirtsinbulk</option>
<option '.($selected == 'shopping-cart' ? 'selected' : '').' >shopping-cart</option>
<option '.($selected == 'sign-in' ? 'selected' : '').' >sign-in</option>
<option '.($selected == 'sign-out' ? 'selected' : '').' >sign-out</option>
<option '.($selected == 'signal' ? 'selected' : '').' >signal</option>
<option '.($selected == 'simplybuilt' ? 'selected' : '').' >simplybuilt</option>
<option '.($selected == 'sitemap' ? 'selected' : '').' >sitemap</option>
<option '.($selected == 'skyatlas' ? 'selected' : '').' >skyatlas</option>
<option '.($selected == 'skype' ? 'selected' : '').' >skype</option>
<option '.($selected == 'slack' ? 'selected' : '').' >slack</option>
<option '.($selected == 'sliders' ? 'selected' : '').' >sliders</option>
<option '.($selected == 'slideshare' ? 'selected' : '').' >slideshare</option>
<option '.($selected == 'smile-o' ? 'selected' : '').' >smile-o</option>
<option '.($selected == 'soccer-ball-o' ? 'selected' : '').' >soccer-ball-o</option>
<option '.($selected == 'sort' ? 'selected' : '').' >sort</option>
<option '.($selected == 'sort-alpha-asc' ? 'selected' : '').' >sort-alpha-asc</option>
<option '.($selected == 'sort-alpha-desc' ? 'selected' : '').' >sort-alpha-desc</option>
<option '.($selected == 'sort-amount-asc' ? 'selected' : '').' >sort-amount-asc</option>
<option '.($selected == 'sort-amount-desc' ? 'selected' : '').' >sort-amount-desc</option>
<option '.($selected == 'sort-asc' ? 'selected' : '').' >sort-asc</option>
<option '.($selected == 'sort-desc' ? 'selected' : '').' >sort-desc</option>
<option '.($selected == 'sort-down' ? 'selected' : '').' >sort-down</option>
<option '.($selected == 'sort-numeric-asc' ? 'selected' : '').' >sort-numeric-asc</option>
<option '.($selected == 'sort-numeric-desc' ? 'selected' : '').' >sort-numeric-desc</option>
<option '.($selected == 'sort-up' ? 'selected' : '').' >sort-up</option>
<option '.($selected == 'soundcloud' ? 'selected' : '').' >soundcloud</option>
<option '.($selected == 'space-shuttle' ? 'selected' : '').' >space-shuttle</option>
<option '.($selected == 'spinner' ? 'selected' : '').' >spinner</option>
<option '.($selected == 'spoon' ? 'selected' : '').' >spoon</option>
<option '.($selected == 'spotify' ? 'selected' : '').' >spotify</option>
<option '.($selected == 'square' ? 'selected' : '').' >square</option>
<option '.($selected == 'square-o' ? 'selected' : '').' >square-o</option>
<option '.($selected == 'stack-exchange' ? 'selected' : '').' >stack-exchange</option>
<option '.($selected == 'stack-overflow' ? 'selected' : '').' >stack-overflow</option>
<option '.($selected == 'star' ? 'selected' : '').' >star</option>
<option '.($selected == 'star-half' ? 'selected' : '').' >star-half</option>
<option '.($selected == 'star-half-empty' ? 'selected' : '').' >star-half-empty</option>
<option '.($selected == 'star-half-full' ? 'selected' : '').' >star-half-full</option>
<option '.($selected == 'star-half-o' ? 'selected' : '').' >star-half-o</option>
<option '.($selected == 'star-o' ? 'selected' : '').' >star-o</option>
<option '.($selected == 'steam' ? 'selected' : '').' >steam</option>
<option '.($selected == 'steam-square' ? 'selected' : '').' >steam-square</option>
<option '.($selected == 'step-backward' ? 'selected' : '').' >step-backward</option>
<option '.($selected == 'step-forward' ? 'selected' : '').' >step-forward</option>
<option '.($selected == 'stethoscope' ? 'selected' : '').' >stethoscope</option>
<option '.($selected == 'stop' ? 'selected' : '').' >stop</option>
<option '.($selected == 'street-view' ? 'selected' : '').' >street-view</option>
<option '.($selected == 'strikethrough' ? 'selected' : '').' >strikethrough</option>
<option '.($selected == 'stumbleupon' ? 'selected' : '').' >stumbleupon</option>
<option '.($selected == 'stumbleupon-circle' ? 'selected' : '').' >stumbleupon-circle</option>
<option '.($selected == 'subscript' ? 'selected' : '').' >subscript</option>
<option '.($selected == 'subway' ? 'selected' : '').' >subway</option>
<option '.($selected == 'suitcase' ? 'selected' : '').' >suitcase</option>
<option '.($selected == 'sun-o' ? 'selected' : '').' >sun-o</option>
<option '.($selected == 'superscript' ? 'selected' : '').' >superscript</option>
<option '.($selected == 'support' ? 'selected' : '').' >support</option>
<option '.($selected == 'table' ? 'selected' : '').' >table</option>
<option '.($selected == 'tablet' ? 'selected' : '').' >tablet</option>
<option '.($selected == 'tachometer' ? 'selected' : '').' >tachometer</option>
<option '.($selected == 'tag' ? 'selected' : '').' >tag</option>
<option '.($selected == 'tags' ? 'selected' : '').' >tags</option>
<option '.($selected == 'tasks' ? 'selected' : '').' >tasks</option>
<option '.($selected == 'taxi' ? 'selected' : '').' >taxi</option>
<option '.($selected == 'tencent-weibo' ? 'selected' : '').' >tencent-weibo</option>
<option '.($selected == 'terminal' ? 'selected' : '').' >terminal</option>
<option '.($selected == 'text-height' ? 'selected' : '').' >text-height</option>
<option '.($selected == 'text-width' ? 'selected' : '').' >text-width</option>
<option '.($selected == 'th' ? 'selected' : '').' >th</option>
<option '.($selected == 'th-large' ? 'selected' : '').' >th-large</option>
<option '.($selected == 'th-list' ? 'selected' : '').' >th-list</option>
<option '.($selected == 'thumb-tack' ? 'selected' : '').' >thumb-tack</option>
<option '.($selected == 'thumbs-down' ? 'selected' : '').' >thumbs-down</option>
<option '.($selected == 'thumbs-o-down' ? 'selected' : '').' >thumbs-o-down</option>
<option '.($selected == 'thumbs-o-up' ? 'selected' : '').' >thumbs-o-up</option>
<option '.($selected == 'thumbs-up' ? 'selected' : '').' >thumbs-up</option>
<option '.($selected == 'ticket' ? 'selected' : '').' >ticket</option>
<option '.($selected == 'times' ? 'selected' : '').' >times</option>
<option '.($selected == 'times-circle' ? 'selected' : '').' >times-circle</option>
<option '.($selected == 'times-circle-o' ? 'selected' : '').' >times-circle-o</option>
<option '.($selected == 'tint' ? 'selected' : '').' >tint</option>
<option '.($selected == 'toggle-down' ? 'selected' : '').' >toggle-down</option>
<option '.($selected == 'toggle-left' ? 'selected' : '').' >toggle-left</option>
<option '.($selected == 'toggle-off' ? 'selected' : '').' >toggle-off</option>
<option '.($selected == 'toggle-on' ? 'selected' : '').' >toggle-on</option>
<option '.($selected == 'toggle-right' ? 'selected' : '').' >toggle-right</option>
<option '.($selected == 'toggle-up' ? 'selected' : '').' >toggle-up</option>
<option '.($selected == 'train' ? 'selected' : '').' >train</option>
<option '.($selected == 'transgender' ? 'selected' : '').' >transgender</option>
<option '.($selected == 'transgender-alt' ? 'selected' : '').' >transgender-alt</option>
<option '.($selected == 'trash' ? 'selected' : '').' >trash</option>
<option '.($selected == 'trash-o' ? 'selected' : '').' >trash-o</option>
<option '.($selected == 'tree' ? 'selected' : '').' >tree</option>
<option '.($selected == 'trello' ? 'selected' : '').' >trello</option>
<option '.($selected == 'trophy' ? 'selected' : '').' >trophy</option>
<option '.($selected == 'truck' ? 'selected' : '').' >truck</option>
<option '.($selected == 'try' ? 'selected' : '').' >try</option>
<option '.($selected == 'tty' ? 'selected' : '').' >tty</option>
<option '.($selected == 'tumblr' ? 'selected' : '').' >tumblr</option>
<option '.($selected == 'tumblr-square' ? 'selected' : '').' >tumblr-square</option>
<option '.($selected == 'turkish-lira' ? 'selected' : '').' >turkish-lira</option>
<option '.($selected == 'twitch' ? 'selected' : '').' >twitch</option>
<option '.($selected == 'twitter' ? 'selected' : '').' >twitter</option>
<option '.($selected == 'twitter-square' ? 'selected' : '').' >twitter-square</option>
<option '.($selected == 'umbrella' ? 'selected' : '').' >umbrella</option>
<option '.($selected == 'underline' ? 'selected' : '').' >underline</option>
<option '.($selected == 'undo' ? 'selected' : '').' >undo</option>
<option '.($selected == 'university' ? 'selected' : '').' >university</option>
<option '.($selected == 'unlink' ? 'selected' : '').' >unlink</option>
<option '.($selected == 'unlock' ? 'selected' : '').' >unlock</option>
<option '.($selected == 'unlock-alt' ? 'selected' : '').' >unlock-alt</option>
<option '.($selected == 'unsorted' ? 'selected' : '').' >unsorted</option>
<option '.($selected == 'upload' ? 'selected' : '').' >upload</option>
<option '.($selected == 'usd' ? 'selected' : '').' >usd</option>
<option '.($selected == 'user' ? 'selected' : '').' >user</option>
<option '.($selected == 'user-md' ? 'selected' : '').' >user-md</option>
<option '.($selected == 'user-plus' ? 'selected' : '').' >user-plus</option>
<option '.($selected == 'user-secret' ? 'selected' : '').' >user-secret</option>
<option '.($selected == 'user-times' ? 'selected' : '').' >user-times</option>
<option '.($selected == 'users' ? 'selected' : '').' >users</option>
<option '.($selected == 'venus' ? 'selected' : '').' >venus</option>
<option '.($selected == 'venus-double' ? 'selected' : '').' >venus-double</option>
<option '.($selected == 'venus-mars' ? 'selected' : '').' >venus-mars</option>
<option '.($selected == 'viacoin' ? 'selected' : '').' >viacoin</option>
<option '.($selected == 'video-camera' ? 'selected' : '').' >video-camera</option>
<option '.($selected == 'vimeo-square' ? 'selected' : '').' >vimeo-square</option>
<option '.($selected == 'vine' ? 'selected' : '').' >vine</option>
<option '.($selected == 'vk' ? 'selected' : '').' >vk</option>
<option '.($selected == 'volume-down' ? 'selected' : '').' >volume-down</option>
<option '.($selected == 'volume-off' ? 'selected' : '').' >volume-off</option>
<option '.($selected == 'volume-up' ? 'selected' : '').' >volume-up</option>
<option '.($selected == 'warning' ? 'selected' : '').' >warning</option>
<option '.($selected == 'wechat' ? 'selected' : '').' >wechat</option>
<option '.($selected == 'weibo' ? 'selected' : '').' >weibo</option>
<option '.($selected == 'weixin' ? 'selected' : '').' >weixin</option>
<option '.($selected == 'whatsapp' ? 'selected' : '').' >whatsapp</option>
<option '.($selected == 'wheelchair' ? 'selected' : '').' >wheelchair</option>
<option '.($selected == 'wifi' ? 'selected' : '').' >wifi</option>
<option '.($selected == 'windows' ? 'selected' : '').' >windows</option>
<option '.($selected == 'won' ? 'selected' : '').' >won</option>
<option '.($selected == 'wordpress' ? 'selected' : '').' >wordpress</option>
<option '.($selected == 'wrench' ? 'selected' : '').' >wrench</option>
<option '.($selected == 'xing' ? 'selected' : '').' >xing</option>
<option '.($selected == 'xing-square' ? 'selected' : '').' >xing-square</option>
<option '.($selected == 'yahoo' ? 'selected' : '').' >yahoo</option>
<option '.($selected == 'yelp' ? 'selected' : '').' >yelp</option>
<option '.($selected == 'yen' ? 'selected' : '').' >yen</option>
<option '.($selected == 'youtube' ? 'selected' : '').' >youtube</option>
<option '.($selected == 'youtube-play' ? 'selected' : '').' >youtube-play</option>
<option '.($selected == 'youtube-square' ? 'selected' : '').' >youtube-square</option>';
	} else {
		$vals = '<option  '.($selected == '' ? 'selected' : '').'  >- no icon -</option>
			<option  '.($selected == 'action' ? 'selected' : '').'  >action</option>
			<option '.($selected == 'alert' ? 'selected' : '').' >alert</option>
			<option  '.($selected == 'arrow-d' ? 'selected' : '').'  >arrow-d</option>
			<option  '.($selected == 'arrow-d-l' ? 'selected' : '').'  >arrow-d-l</option>
			<option  '.($selected == 'arrow-d-r' ? 'selected' : '').'  >arrow-d-r</option>
			<option  '.($selected == 'arrow-l' ? 'selected' : '').'  >arrow-l</option>
			<option  '.($selected == 'arrow-r' ? 'selected' : '').'  >arrow-r</option>
			<option  '.($selected == 'arrow-u' ? 'selected' : '').'  >arrow-u</option>
			<option  '.($selected == 'arrow-u-l' ? 'selected' : '').'  >arrow-u-l</option>
			<option  '.($selected == 'arrow-u-r' ? 'selected' : '').'  >arrow-u-r</option>
			<option  '.($selected == 'audio' ? 'selected' : '').'  >audio</option>
			<option  '.($selected == 'back' ? 'selected' : '').'  >back</option>
			<option  '.($selected == 'bars' ? 'selected' : '').'  >bars</option>
			<option  '.($selected == 'bullets' ? 'selected' : '').'  >bullets</option>
			<option  '.($selected == 'calendar' ? 'selected' : '').'  >calendar</option>
			<option  '.($selected == 'camera' ? 'selected' : '').'  >camera</option>
			<option  '.($selected == 'carat-d' ? 'selected' : '').'  >carat-d</option>
			<option  '.($selected == 'carat-l' ? 'selected' : '').'  >carat-l</option>
			<option  '.($selected == 'carat-r' ? 'selected' : '').'  >carat-r</option>
			<option  '.($selected == 'carat-u' ? 'selected' : '').'  >carat-u</option>
			<option  '.($selected == 'check' ? 'selected' : '').'  >check</option>
			<option  '.($selected == 'clock' ? 'selected' : '').'  >clock</option>
			<option  '.($selected == 'cloud' ? 'selected' : '').'  >cloud</option>
			<option  '.($selected == 'comment' ? 'selected' : '').'  >comment</option>
			<option  '.($selected == 'delete' ? 'selected' : '').'  >delete</option>
			<option  '.($selected == 'edit' ? 'selected' : '').'  >edit</option>
			<option  '.($selected == 'eye' ? 'selected' : '').'  >eye</option>
			<option  '.($selected == 'forbidden' ? 'selected' : '').'  >forbidden</option>
			<option  '.($selected == 'forward' ? 'selected' : '').'  >forward</option>
			<option  '.($selected == 'gear' ? 'selected' : '').'  >gear</option>
			<option  '.($selected == 'grid' ? 'selected' : '').'  >grid</option>
			<option  '.($selected == 'heart' ? 'selected' : '').'  >heart</option>
			<option  '.($selected == 'home' ? 'selected' : '').'  >home</option>
			<option  '.($selected == 'info' ? 'selected' : '').'  >info</option>
			<option  '.($selected == 'location' ? 'selected' : '').'  >location</option>
			<option  '.($selected == 'lock' ? 'selected' : '').'  >lock</option>
			<option  '.($selected == 'mail' ? 'selected' : '').'  >mail</option>
			<option  '.($selected == 'minus' ? 'selected' : '').'  >minus</option>
			<option  '.($selected == 'navigation' ? 'selected' : '').'  >navigation</option>
			<option  '.($selected == 'phone' ? 'selected' : '').'  >phone</option>
			<option  '.($selected == 'plus' ? 'selected' : '').'  >plus</option>
			<option  '.($selected == 'power' ? 'selected' : '').'  >power</option>
			<option  '.($selected == 'recycle' ? 'selected' : '').'  >recycle</option>
			<option  '.($selected == 'refresh' ? 'selected' : '').'  >refresh</option>
			<option  '.($selected == 'search' ? 'selected' : '').'  >search</option>
			<option  '.($selected == 'shop' ? 'selected' : '').'  >shop</option>
			<option  '.($selected == 'star' ? 'selected' : '').'  >star</option>
			<option  '.($selected == 'tag' ? 'selected' : '').'  >tag</option>
			<option  '.($selected == 'user' ? 'selected' : '').'  >user</option>
			<option  '.($selected == 'video' ? 'selected' : '').'  >video</option>';
	}

	return $vals;
}

function wa_generate_post_select($select_id, $post_type, $selected = 0)
{
	$post_type_object = get_post_type_object($post_type);
	$returnedinfo = '';
	$label = $post_type_object->label;
	$posts = get_posts(array('post_type' => $post_type, 'post_status' => 'publish', 'suppress_filters' => false, 'posts_per_page' => -1));
	//echo '<select name="'. $select_id .'" id="'.$select_id.'">';
	$returnedinfo .= '<option value="" >-- '.__('Mobile Pages').'  --</option>';
	foreach ($posts as $post) {

		// $select = $post->ID, '"', $selected == $post->ID ? ' selected="selected";
		$select = ($post->ID == $selected ? ' selected="selected"' : '');
		$returnedinfo .= '<option value="'.$post->ID.'" '.$select.'>'.$post->post_title.'</option>';
	}
	$returnedinfo .=  '</select>';

	return $returnedinfo;
}
/* --- /create selector ----*/
?>
