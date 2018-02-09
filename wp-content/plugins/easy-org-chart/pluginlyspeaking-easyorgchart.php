<?php 
/**
 * Plugin Name: PluginlySpeaking Easy Org Chart
 * Plugin URI: http://pluginlyspeaking.com/plugins/easy-org-chart/
 * Description: Create your own organizational chart.
 * Author: PluginlySpeaking
 * Version: 3.1
 * Author URI: http://www.pluginlyspeaking.com
 * License: GPL2
 */

 // Check for the PRO version
add_action( 'admin_init', 'pseoc_free_pro_check' );
function pseoc_free_pro_check() {
    if (is_plugin_active('pluginlyspeaking-easyorgchart-pro/pluginlyspeaking-easyorgchart-pro.php')) {

        function my_admin_notice(){
        echo '<div class="updated">
                <p>Easy Org Chart <strong>PRO</strong> version is activated.</p>
				<p>Easy Org Chart <strong>FREE</strong> version is desactivated.</p>
              </div>';
        }
        add_action('admin_notices', 'my_admin_notice');

        deactivate_plugins(__FILE__);
    }
}
 
add_action( 'wp_enqueue_scripts', 'pseoc_add_script' );

function pseoc_add_script() {
	wp_enqueue_style( 'pseoc_css', plugins_url('css/pseoc.css', __FILE__));
	wp_enqueue_script("jquery");
}

// Enqueue admin styles
add_action( 'admin_enqueue_scripts', 'pseoc_add_admin_style' );
function pseoc_add_admin_style() {
	wp_enqueue_style( 'pseoc_admin_css', plugins_url('css/pseoc_admin.css', __FILE__));
	wp_enqueue_script('jquery-effects-pulsate');
}

function pseoc_create_type() {
  register_post_type( 'e_org_chart_ps',
    array(
      'labels' => array(
        'name' => 'Easy Org Chart',
        'singular_name' => 'Easy Org Chart'
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'supports'           => array( 'title' ),
      'menu_icon'    => 'dashicons-plus',
    )
  );
}

add_action( 'init', 'pseoc_create_type' );


function pseoc_admin_css() {
    global $post_type;
    $post_types = array( 
                        'e_org_chart_ps',
                  );
    if(in_array($post_type, $post_types))
    echo '<style type="text/css">#edit-slug-box, #post-preview, #view-post-btn{display: none;}</style>';
}

function pseoc_remove_view_link( $action ) {

    unset ($action['view']);
    return $action;
}

add_filter( 'post_row_actions', 'pseoc_remove_view_link' );
add_action( 'admin_head-post-new.php', 'pseoc_admin_css' );
add_action( 'admin_head-post.php', 'pseoc_admin_css' );

function pseoc_check($cible,$test){
  if($test == $cible){return ' checked="checked" ';}
}

function pseoc_colorpicker_enqueue() {
    global $typenow;
    if( $typenow == 'e_org_chart_ps' ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'pseoc_colorpicker', plugin_dir_url( __FILE__ ) . 'js/pseoc_colorpicker.js', array( 'wp-color-picker' ) );
    }
}
add_action( 'admin_enqueue_scripts', 'pseoc_colorpicker_enqueue' );

add_action('add_meta_boxes','pseoc_init_settings_metabox');

function pseoc_init_settings_metabox(){
  add_meta_box('pseoc_settings_metabox', 'Settings', 'pseoc_add_settings_metabox', 'e_org_chart_ps', 'side', 'high');
}

function pseoc_add_settings_metabox($post){
	?>
	<table class="pseoc_table pseoc_pro_features">
		<tr>
			<td class="pseoc_first_td_settings"><label for="zoomable">Zoomable : </label></td>
			<td><input type="radio" id="zoomable_yes" name="zoomable" value="yes" disabled > Yes <input type="radio" id="zoomable_no" name="zoomable" value="no" disabled > No<br></td>
		</tr>
		<tr>
			<td class="pseoc_first_td_settings">
				<label for="initial_zoom">Initial Zoom : </label>
			</td>
			<td>
				<select name="initial_zoom" class="pseoc_select_100" disabled >
					<option value="0.8">Slightly unzoomed</option>
					<option value="1">Normal</option>
					<option value="1.2">Slightly zoomed</option>
					<option value="1.4">Zoomed</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="pseoc_first_td_settings"><label for="force_font">Force original font : </label></td>
			<td><input type="radio" id="force_font_yes" name="force_font" value="yes" disabled > Yes <input type="radio" id="force_font_no" name="force_font" value="no" disabled > No<br></td>
		</tr>
		<tr>
			<td class="pseoc_first_td_settings"><label for="">Device Restriction : </label></td>
			<td>
				<input type="checkbox" name="device_restrict_no_mobile" value="pseoc_no_mobile" disabled /> Hide on Mobile 
				<br /><input type="checkbox" name="device_restrict_no_tablet" value="pseoc_no_tablet" disabled /> Hide on Tablet
				<br /><input type="checkbox" name="device_restrict_no_desktop" value="pseoc_no_desktop" disabled /> Hide on Desktop
			</td>
		</tr>
		<tr>
			<td class="pseoc_first_td_settings">
				<label for="user_restrict">User Restriction : </label></td>
			<td>
				<select name="user_restrict" class="pseoc_select_100" disabled>
					<option value="logged_in">Logged In</option>
					<option value="guest">Guest</option>
				</select>
			</td>
		</tr>
	</table>
	
	<?php 
	
}

add_action('add_meta_boxes','pseoc_init_advert_metabox');

function pseoc_init_advert_metabox(){
  add_meta_box('pseoc_advert_metabox', 'Upgrade to PRO Version', 'pseoc_add_advert_metabox', 'e_org_chart_ps', 'side', 'low');
}

function pseoc_add_advert_metabox($post){	
	?>
	
	<ul style="list-style-type:disc;padding-left:20px;margin-bottom:25px;">
		<li>Org Chart Styling</li>
		<li>Boxes Styling</li>
		<li>Scroll by dragging</li>
		<li>Zoomable</li>
		<li>Additional information</li>
		<li>Use your theme's font</li>
		<li>Device restriction</li>
		<li>User restriction</li>
		<li>And more...</li>
	</ul>
	
		<label for="pro_features" style="font-size:10pt;font-weight:bold;color:#33b690;" >Show all PRO features : </label>
		<input type="radio" id="pro_features_yes" name="pro_features" value="yes" > Yes 
		<input type="radio" id="pro_features_no" name="pro_features" value="no" checked="checked" > No
	
	<a style="margin-top:30px;text-decoration: none;display:inline-block; background:#33b690; padding:8px 25px 8px; border-bottom:3px solid #33a583; border-radius:3px; color:white;" target="_blank" href="http://pluginlyspeaking.com/plugins/easy-org-chart/">Go to the PRO version</a>
	<span style="display:block;margin-top:14px; font-size:13px; color:#0073AA; line-height:20px;">
		<span class="dashicons dashicons-tickets"></span> Code <strong>EOC10OFF</strong> (10% OFF)
	</span>
	
	<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {
			$('input[name=pro_features]').live('change', function(){
				if($('#pro_features_yes').is(':checked')) {
					$('.pseoc_pro_features').show("pulsate", {times:2}, 2000);
					$('#pseoc_settings_metabox').show("pulsate", {times:2}, 2000);
				} 
				if($('#pro_features_no').is(':checked')) {
					$('.pseoc_pro_features').hide("pulsate", {times:2}, 2000);
					$('#pseoc_settings_metabox').hide("pulsate", {times:2}, 2000);
				} 
			});
		});
	</script>
	
	<?php 
	
}

add_action('add_meta_boxes','pseoc_init_content_metabox');

function pseoc_init_content_metabox(){
  add_meta_box('pseoc_content_metabox', 'Org Chart Advanced Styling', 'pseoc_add_content_metabox', 'e_org_chart_ps', 'normal');
}

function pseoc_add_content_metabox($post){
	$prefix = '_e_org_chart_';
	
	$theme = get_post_meta($post->ID, $prefix.'theme',true);
	$color = get_post_meta($post->ID, $prefix.'color',true);
	
	$optimised = get_post_meta($post->ID, $prefix.'optimised',true);
	if($optimised == '')
		$optimised = "no";
	
	$org_chart_width = get_post_meta($post->ID, $prefix.'org_chart_width',true);
	
	$container_width = get_post_meta($post->ID, $prefix.'container_width',true);
	$container_width_custom = get_post_meta($post->ID, $prefix.'container_width_custom',true);
	
	if($container_width == '' && $org_chart_width != '')
	{
		$container_width = 'custom';
		$container_width_custom = $org_chart_width.'px';
	}
	
	$container_height = get_post_meta($post->ID, $prefix.'container_height',true);
	$container_height_custom = get_post_meta($post->ID, $prefix.'container_height_custom',true);
	
	if($theme == 'empty' && $background_color == '' && $border_color == '')
	{
		$background_color == '#ffffff';
		switch($color)
		{
			case 'black' :
				$border_color == '#000000';
				break;
			case 'blue' :
				$border_color == '#084C9E';
				break;
			case 'gray' :
				$border_color == '#808080';
				break;
			case 'golden' :
				$border_color == '#DAA520';
				break;
			case 'salmon' :
				$border_color == '#FA8072';
				break;
			case 'red' :
				$border_color == '#C91111';
				break;
			case 'pine_green' :
				$border_color == '#007872';
				break;
			case 'green' :
				$border_color == '#1C8E0D';
				break;
			case 'brown' :
				$border_color == '#943F07';
				break;
			case 'orange' :
				$border_color == '#FF8000';
				break;
		}
	}
	if($theme == 'full' && $background_color == '' && $border_color == '')
	{
		switch($color)
		{
			case 'black' :
				$border_color == '#000000';
				$background_color == '#000000';
				break;
			case 'blue' :
				$border_color == '#084C9E';
				$background_color == '#084C9E';
				break;
			case 'gray' :
				$border_color == '#808080';
				$background_color == '#808080';
				break;
			case 'golden' :
				$border_color == '#DAA520';
				$background_color == '#DAA520';
				break;
			case 'salmon' :
				$border_color == '#FA8072';
				$background_color == '#FA8072';
				break;
			case 'red' :
				$border_color == '#C91111';
				$background_color == '#C91111';
				break;
			case 'pine_green' :
				$border_color == '#007872';
				$background_color == '#007872';
				break;
			case 'green' :
				$border_color == '#1C8E0D';
				$background_color == '#1C8E0D';
				break;
			case 'brown' :
				$border_color == '#943F07';
				$background_color == '#943F07';
				break;
			case 'orange' :
				$border_color == '#FF8000';
				$background_color == '#FF8000';
				break;
		}
	}
	
	?>
	
	<h2 class="pseoc_admin_title">Container Size</h2>
	
		<table class="pseoc_table_100_3td">
			<tr>
				<td class="pseoc_td_label">
					<label for="container_width">Visible Width : </label>
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="container_width_100" name="container_width" value="100" <?php echo (empty($container_width)) ? 'checked="checked"' : pseoc_check($container_width,'100'); ?>> FullWidth 
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="container_width_cus" name="container_width" value="custom" <?php echo (empty($container_width)) ? '' : pseoc_check($container_width,'custom'); ?>> Custom	
				</td>
				<td>
					<input name="container_width_custom" id="container_width_custom" type="text" placeholder="ex: 900px, 40%, etc..." value="<?php echo (empty($container_width_custom)) ? '' : $container_width_custom; ?>" />
				</td>
				<td>					
				</td>
			</tr>
			<tr>
				<td class="pseoc_td_label">
					<label for="container_height">Visible Height : </label>
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="container_height_500" name="container_height" value="500" <?php echo (empty($container_height)) ? 'checked="checked"' : pseoc_check($container_height,'500'); ?>> 500px 
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="container_height_cus" name="container_height" value="custom" <?php echo (empty($container_height)) ? '' : pseoc_check($container_height,'custom'); ?>> Custom	
				</td>
				<td>
					<input name="container_height_custom" id="container_height_custom" type="text" placeholder="ex: 900px, etc..." value="<?php echo (empty($container_height_custom)) ? '' : $container_height_custom; ?>" />
				</td>
				<td>					
				</td>
			</tr>
		</table>
		
	<h2 class="pseoc_admin_title">Org Chart Advanced Settings</h2>
	
		<table class="pseoc_table_100_3td">
			<tr>
				<td class="pseoc_td_label">
					<label for="optimised">Org Chart Width Calculation : </label>
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="optimised_no" name="optimised" value="no" <?php echo (empty($optimised)) ? 'checked="checked"' : pseoc_check($optimised,'no'); ?>> Auto 
				</td>
				<td class="pseoc_td_thin_radio">
					<input type="radio" id="optimised_yes" name="optimised" value="yes" <?php echo (empty($optimised)) ? '' : pseoc_check($optimised,'yes'); ?>> Optimised	
				</td>
				<td>					
				</td>
			</tr>
		</table>
		<span class="pseoc_desc">If you choose Optimised, the last group of each row will be compact. This option can lead to a narrower Org Chart.</span>
		
	<div class="pseoc_pro_features">
	
		<h2 class="pseoc_admin_title">Org Chart Styling</h2>
		
			<table class="pseoc_table_100_3td">
				<tr>
					<td class="pseoc_td_label">
						<label for="corners">Do you want rounded corners ? </label>
					</td>
					<td class="pseoc_td_thin_radio">
						<input type="radio" id="corners_yes" name="corners" value="25px" disabled > Yes 
					</td>
					<td class="pseoc_td_thin_radio">
						<input type="radio" id="corners_no" name="corners" value="2px" disabled > No	
					</td>
					<td>					
					</td>
				</tr>
				<tr>				
					<td class="pseoc_td_label">
						<label for="background_color" class="pseoc_label_colorpicker">Background Color : </label>
					</td>
					<td colspan="2">
						<input name="background_color" type="text" value="" class="pseoc_colorpicker" disabled />
					</td>
					<td>
					</td>
				</tr>
				<tr>				
					<td class="pseoc_td_label">
						<label for="border_color" class="pseoc_label_colorpicker">Border Color : </label>
					</td>
					<td colspan="2">
						<input name="border_color" type="text" value="" class="pseoc_colorpicker" disabled />
					</td>
					<td>
					</td>
				</tr>
			</table>
			
		<h2 class="pseoc_admin_title">Boxes Styling</h2>
			

			<table class="pseoc_table_100_3td">
				<tr>
					<td class="pseoc_td_label">
						<label for="template">Boxes Template :</label>
					</td>
					<td class="pseoc_td_thin">
						<select name="template" disabled >
							<option value="template_1">Horizontal</option>
							<option value="template_2">Vertical</option>
						</select>
					</td>
					<td>
					</td>
				</tr>				
				<tr>
					<td class="pseoc_td_label">
						<label for="last_name_color" class="pseoc_label_colorpicker">Last Name Color : </label>
					</td>
					<td class="pseoc_td_thin">
						<input name="last_name_color" type="text" value="" class="pseoc_colorpicker" disabled />
					</td>
					<td>
					</td>
				</tr>
				<tr>				
					<td class="pseoc_td_label">
						<label for="first_name_color" class="pseoc_label_colorpicker">First Name Color : </label>
					</td>
					<td class="pseoc_td_thin">
						<input name="first_name_color" type="text" value="" class="pseoc_colorpicker" disabled />
					</td>
					<td>
					</td>
				</tr>
				<tr>				
					<td class="pseoc_td_label">
						<label for="job_color" class="pseoc_label_colorpicker">Job/Role Color : </label>
					</td>
					<td>
						<input name="job_color" type="text" value="" class="pseoc_colorpicker" disabled />
					</td>
					<td>
					</td>
				</tr>
			</table>
		</div>
		
		<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {
			if($('#container_width_100').is(':checked')) {
				$('#container_width_custom').hide();
			} 
			if($('#container_width_cus').is(':checked')) {
				$('#container_width_custom').show();
			} 
			
			$('input[name=container_width]').live('change', function(){
				if($('#container_width_100').is(':checked')) {
					$('#container_width_custom').hide();
				} 
				if($('#container_width_cus').is(':checked')) {
					$('#container_width_custom').show();
				} 
			});	

			if($('#container_height_500').is(':checked')) {
				$('#container_height_custom').hide();
			} 
			if($('#container_height_cus').is(':checked')) {
				$('#container_height_custom').show();
			} 
			
			$('input[name=container_height]').live('change', function(){
				if($('#container_height_500').is(':checked')) {
					$('#container_height_custom').hide();
				} 
				if($('#container_height_cus').is(':checked')) {
					$('#container_height_custom').show();
				} 
			});				
		});
	</script>

		
	<?php
}

add_action('add_meta_boxes','pseoc_init_boxes_metabox');

function pseoc_init_boxes_metabox(){
  add_meta_box('pseoc_boxes_metabox', 'Build your Org Chart', 'pseoc_add_boxes_metabox', 'e_org_chart_ps', 'normal');
}

function pseoc_add_boxes_metabox($post){
	$prefix = '_e_org_chart_';
	
	$cell = get_post_meta($post->ID, $prefix . 'group', true );
	
	if($cell != "" && count( $cell ) > 0)
	{
		$number_cell = count( $cell );
		for($i = 0;$i < $number_cell;$i++)
		{
			$boxe_id[$i] = $i + 1;
			$last_name[$i] = $cell[$i]['_e_org_chart_last_name'];
			$first_name[$i] = $cell[$i]['_e_org_chart_first_name'];
			$job[$i] = $cell[$i]['_e_org_chart_job'];
			$pic[$i] = $cell[$i]['_e_org_chart_pic'];
			$row[$i] = $cell[$i]['_e_org_chart_row'];
			$parent[$i] = $cell[$i]['_e_org_chart_parent'];
		}
	} else {
		$boxe_id = get_post_meta($post->ID, $prefix.'boxe_id',true);
		$last_name = get_post_meta($post->ID, $prefix.'last_name',true);
		$first_name = get_post_meta($post->ID, $prefix.'first_name',true);
		$job = get_post_meta($post->ID, $prefix.'job',true);	
		$pic = get_post_meta($post->ID, $prefix.'pic',true);
		$row = get_post_meta($post->ID, $prefix.'row',true);
		$parent = get_post_meta($post->ID, $prefix.'parent',true);
	}


	
	?>
	<a class="button pseoc_add_boxe" href="javascript:void(0);">Add a person</a>
	<div class="pseoc_boxes_wrapper">
		<?php
		if($last_name != "" && count( $last_name ) > 0)
		{
			foreach ($last_name as $k => $thing) {
			?>
				<div class="pseoc_boxe_wrapper">
					<input name="boxe_id[]" type="hidden" class="pseoc_to_increment pseoc_boxeid" value="<?php echo $boxe_id[$k]; ?>"/>
					<table class="pseoc_boxe_table">
						<tr>
							<td>
								<label for="last_name">Last Name : </label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="last_name[]" type="text" class="pseoc_to_empty pseoc_lastname" value="<?php echo $last_name[$k]; ?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="first_name">First Name : </label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="first_name[]" type="text" class="pseoc_to_empty pseoc_firstname" value="<?php echo $first_name[$k]; ?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="job">Job / Role : </label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="job[]" type="text" class="pseoc_to_empty" value="<?php echo $job[$k]; ?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="pic">Profile Picture : </label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" id="pseoc_media_profile_pic_<?php echo $boxe_id[$k]; ?>" class="pseoc_to_empty pseoc_id_to_change_text" name="pic[]" value="<?php echo $pic[$k]; ?>" /><br>
								<input type="button" id="profile_pic_<?php echo $boxe_id[$k]; ?>" class="button profilepic-button pseoc_id_to_change_button" value="Choose an image" />
							</td>
						</tr>
						
						<tr class="pseoc_spacer pseoc_pro_features">
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<label for="mail">Mail : </label>
							</td>
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<input name="mail" type="text" class="pseoc_to_empty" value="" disabled />
							</td>
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<label for="phone">Phone : </label>
							</td>
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<input name="phone" type="text" class="pseoc_to_empty" value="" disabled />
							</td>
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<label for="other">Other : </label>
							</td>
						</tr>
						<tr class="pseoc_pro_features">
							<td>
								<input name="other" type="text" class="pseoc_to_empty" value="" disabled />
							</td>
						</tr>
						<tr class="pseoc_spacer pseoc_pro_features">
						</tr>						
						
						<tr>
							<td>
								<label for="row">Row : </label>
							</td>
						</tr>
						<tr>
							<td>
								<select class="pseoc_select_100" name="row[]">
									<option <?php selected( $row[$k], "1"); ?> value="1">1</option>
									<option <?php selected( $row[$k], "2");  ?> value="2">2</option>
									<option <?php selected( $row[$k], "3");  ?> value="3">3</option>
									<option <?php selected( $row[$k], "4");  ?> value="4">4</option>
									<option <?php selected( $row[$k], "5");  ?> value="5">5</option>
									<option <?php selected( $row[$k], "6");  ?> value="6">6</option>
									<option <?php selected( $row[$k], "7");  ?> value="7">7</option>
									<option <?php selected( $row[$k], "8");  ?> value="8">8</option>
									<option <?php selected( $row[$k], "9");  ?> value="9">9</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="parent">Upper hierarchy : </label>
							</td>
						</tr>
						<tr>
							<td>
								<select class="pseoc_select_100 pseoc_parent_select" name="parent[]"></select>
								<input type="hidden" class="pseoc_currentid pseoc_to_empty_0" value="<?php echo $parent[$k]; ?>"/>
							</td>
						</tr>
					</table>
					<p style="text-align:center;"><a class="button pseoc_del_boxe" href="javascript:void(0);">Delete</a></p>
				</div>
			<?php
			}
		} else {
		?>
		<div class="pseoc_boxe_wrapper">
				<input name="boxe_id[]" type="hidden" class="pseoc_to_increment pseoc_boxeid" value="1"/>
				<table class="pseoc_boxe_table">
					<tr>
						<td>
							<label for="last_name">Last Name : </label>
						</td>
					</tr>
					<tr>
						<td>
							<input name="last_name[]" type="text" class="pseoc_to_empty pseoc_lastname" value=""/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="first_name">First Name : </label>
						</td>
					</tr>
					<tr>
						<td>
							<input name="first_name[]" type="text" class="pseoc_to_empty pseoc_firstname" value=""/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="job">Job / Role : </label>
						</td>
					</tr>
					<tr>
						<td>
							<input name="job[]" type="text" class="pseoc_to_empty" value=""/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="pic">Profile Picture : </label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" id="pseoc_media_profile_pic_1" class="pseoc_to_empty pseoc_id_to_change_text" name="pic[]" value="" /><br>
							<input type="button" id="profile_pic_1" class="button profilepic-button pseoc_id_to_change_button" value="Choose an image" />
						</td>
					</tr>
					
					<tr class="pseoc_spacer pseoc_pro_features">
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<label for="mail">Mail : </label>
						</td>
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<input name="mail" type="text" class="pseoc_to_empty" value="" disabled />
						</td>
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<label for="phone">Phone : </label>
						</td>
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<input name="phone" type="text" class="pseoc_to_empty" value="" disabled />
						</td>
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<label for="other">Other : </label>
						</td>
					</tr>
					<tr class="pseoc_pro_features">
						<td>
							<input name="other" type="text" class="pseoc_to_empty" value="" disabled />
						</td>
					</tr>
					<tr class="pseoc_spacer pseoc_pro_features">
					</tr>
					
					<tr>
						<td>
							<label for="row">Row : </label>
						</td>
					</tr>
					<tr>
						<td>
							<select class="pseoc_select_100" name="row[]">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="parent">Upper hierarchy : </label>
						</td>
					</tr>
					<tr>
						<td>
							<select class="pseoc_select_100 pseoc_parent_select" name="parent[]">
								<option value="0">None</option>
							</select>
							<input type="hidden" class="pseoc_currentid pseoc_to_empty_0" value="0"/>
						</td>
					</tr>
				</table>
				<p style="text-align:center;"><a class="button pseoc_del_boxe" href="javascript:void(0);">Delete</a></p>
			</div>
		<?php
		}
		?>
	</div>
	<a class="button pseoc_add_boxe" href="javascript:void(0);">Add a person</a>
	
	<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {			
			function pseoc_refresh_parent(){
				var arr_boxe_id = $.map($('.pseoc_boxeid'), function (el) { return el.value; });
				var arr_last_name = $.map($('.pseoc_lastname'), function (el) { return el.value; });
				var arr_first_name = $.map($('.pseoc_firstname'), function (el) { return el.value; });
				var option = '<option value="0">None</option>';
				for (var i=0;i<arr_boxe_id.length;i++){
				   if(arr_last_name[i] != '' || arr_first_name[i] != '')
					{
						option += '<option value="'+ arr_boxe_id[i] + '">' + arr_last_name[i] + ' ' + arr_first_name[i] + '</option>';	
					}
				}
				$('.pseoc_parent_select').find('option').remove();
				$('.pseoc_parent_select').append(option);
				$('.pseoc_currentid').each(function() {
					var current_id = parseInt($(this).val());
					if( isNaN(current_id))
						current_id = 0;
					
					$(this).siblings('.pseoc_parent_select').val(current_id);

				});
			}
			
			function pseoc_refresh_func(){				
				$('.pseoc_del_boxe').on('click',function(){
					if($('.pseoc_boxe_wrapper').length > 1)
					{
						var del_id = parseInt($(this).parent().siblings('.pseoc_boxeid').val());
						$(this).closest('.pseoc_boxe_wrapper').remove();
						var reset_id = 1;
						$('.pseoc_boxe_wrapper').each(function() {
						  if (parseInt($(this).find('.pseoc_currentid').val()) > del_id)
						  {
							  var new_id = parseInt($(this).find('.pseoc_currentid').val() - 1);
							  $(this).find('.pseoc_currentid').val(new_id);
						  }
						  if (parseInt($(this).find('.pseoc_currentid').val()) == del_id)
						  {
							  $(this).find('.pseoc_currentid').val("0");
						  }
						  $(this).find('.pseoc_to_increment').val(reset_id);
						  $(this).find('.pseoc_id_to_change_text').attr('id','pseoc_media_profile_pic_' +reset_id);
						  $(this).find('.pseoc_id_to_change_button').attr('id','profile_pic_' +reset_id);
						  reset_id++;
						});
						pseoc_refresh_parent();
					}
				});
				
				$('.pseoc_lastname').live('change', function(){
					pseoc_refresh_parent();
				});
				
				$('.pseoc_firstname').live('change', function(){
					pseoc_refresh_parent();
				});
				
				$('.pseoc_parent_select').live('change', function(){
					var current_id = parseInt($(this).val());
					$(this).siblings('.pseoc_currentid').val(current_id);
				});
			}
			
			pseoc_refresh_parent();
			pseoc_refresh_func();			
			
			$('.pseoc_add_boxe').on('click',function(){
				$('.pseoc_boxe_wrapper:last').clone().appendTo('.pseoc_boxes_wrapper');
				$('.pseoc_boxe_wrapper:last .pseoc_to_empty').val('');
				$('.pseoc_boxe_wrapper:last .pseoc_to_empty_0').val('0');
				
				var reset_id = 1;
				$('.pseoc_boxe_wrapper').each(function() {
				  $(this).find('.pseoc_to_increment').val(reset_id);
				  $(this).find('.pseoc_id_to_change_text').attr('id','pseoc_media_profile_pic_' +reset_id);
				  $(this).find('.pseoc_id_to_change_button').attr('id','profile_pic_' +reset_id);
				  reset_id++;
				});
				
				pseoc_refresh_func();
			});			
		});
	</script>
		
	<?php
}

add_action( 'admin_enqueue_scripts', 'pseoc_profile_pic_enqueue' );
function pseoc_profile_pic_enqueue() {
	global $typenow;
	if( $typenow == 'e_org_chart_ps' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'pseoc_media_pic-js', plugin_dir_url( __FILE__ ) . 'js/pseoc_media_pic.js', array( 'jquery' ) );
		wp_localize_script( 'pseoc_media_pic-js', 'pseoc_media_pic_js',
			array(
				'title' => __( 'Choose or Upload an image'),
				'button' => __( 'Use this file'),
			)
		);
		wp_enqueue_script( 'pseoc_media_pic-js' );
	}
}

add_action('save_post','pseoc_save_metabox');
function pseoc_save_metabox($post_id){
	
	$prefix = '_e_org_chart_';
	
	//Metabox Settings
	if(isset($_POST['org_chart_width'])){
		update_post_meta($post_id, $prefix.'org_chart_width', preg_replace("/[^0-9]/","",sanitize_text_field($_POST['org_chart_width'])));
	}
	if(isset($_POST['optimised'])){
		update_post_meta($post_id, $prefix.'optimised', sanitize_text_field($_POST['optimised']));
	}
	
	if( isset( $_POST[ 'container_width' ] ) ) {
		update_post_meta( $post_id, $prefix.'container_width', sanitize_text_field($_POST[ 'container_width' ] ));
	}
	if( isset( $_POST[ 'container_width_custom' ] ) ) {
		update_post_meta( $post_id, $prefix.'container_width_custom', sanitize_text_field($_POST[ 'container_width_custom' ] ));
	}
	
	if( isset( $_POST[ 'container_height' ] ) ) {
		update_post_meta( $post_id, $prefix.'container_height', sanitize_text_field($_POST[ 'container_height' ] ));
	}
	if( isset( $_POST[ 'container_height_custom' ] ) ) {
		update_post_meta( $post_id, $prefix.'container_height_custom', sanitize_text_field($_POST[ 'container_height_custom' ] ));
	}

	if ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) {
		if(isset($_POST['boxe_id']))
		{
			update_post_meta( $post_id, $prefix.'boxe_id', array_map( 'esc_attr', $_POST['boxe_id'] ));
		}
		if(isset($_POST['last_name']))
		{
			update_post_meta( $post_id, $prefix.'last_name', array_map( 'esc_attr', $_POST['last_name']));
		}
		if(isset($_POST['first_name']))
		{
			update_post_meta( $post_id, $prefix.'first_name', array_map( 'esc_attr', $_POST['first_name']));
		}
		if(isset($_POST['job']))
		{
			update_post_meta( $post_id, $prefix.'job', array_map( 'esc_attr', $_POST['job']));
		}
		if(isset($_POST['pic']))
		{
			update_post_meta( $post_id, $prefix.'pic', array_map( 'esc_attr', $_POST['pic']));
		}
		if(isset($_POST['row']))
		{
			update_post_meta( $post_id, $prefix.'row', array_map( 'esc_attr', $_POST['row']));
		}
		if(isset($_POST['parent']))
		{
			update_post_meta( $post_id, $prefix.'parent', array_map( 'esc_attr', $_POST['parent']));
		}
	}

	delete_post_meta( $post_id, $prefix . 'group');
}

add_action( 'manage_e_org_chart_ps_posts_custom_column' , 'pseoc_custom_columns', 10, 2 );

function pseoc_custom_columns( $column, $post_id ) {
    switch ( $column ) {
	case 'shortcode' :
		global $post;
		$pre_slug = '' ;
		$pre_slug = $post->post_title;
		$slug = sanitize_title($pre_slug);
    	$shortcode = '<span style="border: solid 3px lightgray; background:white; padding:7px; font-size:17px; line-height:40px;">[e_org_chart_ps name="'.$slug.'"]</strong>';
	    echo $shortcode; 
	    break;
    }
}

function pseoc_add_columns($columns) {
    return array_merge($columns, 
              array('shortcode' => __('Shortcode'),
                    ));
}
add_filter('manage_e_org_chart_ps_posts_columns' , 'pseoc_add_columns');


function pseoc_shortcode($atts) {
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
		
	global $post;
    $args = array('post_type' => 'e_org_chart_ps', 'numberposts'=>-1);
    $custom_posts = get_posts($args);
	$output = '';
	foreach($custom_posts as $post) : setup_postdata($post);
	$sanitize_title = sanitize_title($post->post_title);
	if ($sanitize_title == $name)
	{
		$prefix = '_e_org_chart_';
		$postid = get_the_ID();	
	   
		$cell = get_post_meta( $postid, $prefix . 'group', true );
		
		if($cell != "" && count( $cell ) > 0)
		{
			$number_cell = count( $cell );
			for($i = 0;$i < $number_cell;$i++)
			{
				$boxe_id[$i] = $i + 1;
				
				if(isset($cell[$i]['_e_org_chart_last_name']))
				{
					$last_name[$i] = $cell[$i]['_e_org_chart_last_name'];
				}else{
					$last_name[$i] = '';
				}
				
				if(isset($cell[$i]['_e_org_chart_first_name']))
				{
					$first_name[$i] = $cell[$i]['_e_org_chart_first_name'];
				}else{
					$first_name[$i] = '';
				}
				
				if(isset($cell[$i]['_e_org_chart_job']))
				{
					$job[$i] = $cell[$i]['_e_org_chart_job'];
				}else{
					$job[$i] = '';
				}
				
				if(isset($cell[$i]['_e_org_chart_pic']))
				{
					$pic[$i] = $cell[$i]['_e_org_chart_pic'];
				}else{
					$pic[$i] = '';
				}
				
				if(isset($cell[$i]['_e_org_chart_row']))
				{
					$row[$i] = $cell[$i]['_e_org_chart_row'];
				}else{
					$row[$i] = '';
				}
				
				if(isset($cell[$i]['_e_org_chart_parent']))
				{
					$parent[$i] = $cell[$i]['_e_org_chart_parent'];
				}else{
					$parent[$i] = '';
				}
			}
		} else {
			$boxe_id = get_post_meta($postid, $prefix.'boxe_id',true);
			$last_name = get_post_meta($postid, $prefix.'last_name',true);
			$first_name = get_post_meta($postid, $prefix.'first_name',true);
			$job = get_post_meta($postid, $prefix.'job',true);	
			$pic = get_post_meta($postid, $prefix.'pic',true);
			$row = get_post_meta($postid, $prefix.'row',true);
			$parent = get_post_meta($postid, $prefix.'parent',true);
		}
		
		$container_width = get_post_meta( $postid, $prefix . 'container_width', true );
		if($container_width == '100')
			$container_width_custom = '100%';	
		if($container_width == 'custom')
			$container_width_custom = get_post_meta( $postid, $prefix . 'container_width_custom', true );
		
		$container_height = get_post_meta( $postid, $prefix . 'container_height', true );
		if($container_height == '500')
			$container_height_custom = '500px';	
		if($container_height == 'custom')
			$container_height_custom = get_post_meta( $postid, $prefix . 'container_height_custom', true );
		
		$optimised = get_post_meta( $postid, $prefix . 'optimised', true );
		if($optimised == "")
			$optimised = "no";

		$template_width = 200;

		
		$theme = get_post_meta( $postid, $prefix . 'theme', true );
	
		$nb_cell = count($boxe_id);
		
		$nb_row1 = 0;
		$nb_row2 = 0;
		$nb_row3 = 0;
		$nb_row4 = 0;
		$nb_row5 = 0;
		$nb_row6 = 0;
		$nb_row7 = 0;
		$nb_row8 = 0;
		$nb_row9 = 0;
		
		$list_parent_row1 = array();
		$list_parent_row2 = array();
		$list_parent_row3 = array();
		$list_parent_row4 = array();
		$list_parent_row5 = array();
		$list_parent_row6 = array();
		$list_parent_row7 = array();
		$list_parent_row8 = array();
		$list_parent_row9 = array();
		
		for( $i=0; $i<$nb_cell;$i++)
		{
			$is_gparent[$boxe_id[$i]] = "no";
			for($j=0; $j<$nb_cell;$j++)
			{
				if($boxe_id[$i] == $parent[$j])
				{
					for($k=0; $k<$nb_cell;$k++)
					{
						if($boxe_id[$j] == $parent[$k])
						{
							$is_gparent[$boxe_id[$i]] = "yes";
						}
					}
				}
			}
		}
		
		for( $i=0; $i<$nb_cell;$i++)
		{
			switch ($row[$i]) {
				case 1:
					$nb_row1++;
					$list_parent_row1[] = $parent[$i];
					break;
				case 2:
					$nb_row2++;
					$list_parent_row2[] = $parent[$i];
					break;
				case 3:
					$nb_row3++;
					$list_parent_row3[] = $parent[$i];
					break;
				case 4:
					$nb_row4++;
					$list_parent_row4[] = $parent[$i];
					break;
				case 5:
					$nb_row5++;
					$list_parent_row5[] = $parent[$i];
					break;
				case 6:
					$nb_row6++;
					$list_parent_row6[] = $parent[$i];
					break;
				case 7:
					$nb_row7++;
					$list_parent_row7[] = $parent[$i];
					break;
				case 8:
					$nb_row8++;
					$list_parent_row8[] = $parent[$i];
					break;
				case 9:
					$nb_row9++;
					$list_parent_row9[] = $parent[$i];
					break;
			}
		}
		
		if($optimised == "yes")
		{
			$parent_row1 = array();
			$parent_row2 = array();
			$parent_row3 = array();
			$parent_row4 = array();
			$parent_row5 = array();
			$parent_row6 = array();
			$parent_row7 = array();
			$parent_row8 = array();
			$parent_row9 = array();
		
			$count_child_row1 = array_count_values($list_parent_row1);
			arsort($count_child_row1);
			$parent_row1 = array_keys($count_child_row1);
			$max_row1 = 1;
			if (reset($count_child_row1) != false)
			{
				$max_row1 = reset($count_child_row1);
			}
			
			$count_child_row2 = array_count_values($list_parent_row2);
			arsort($count_child_row2);
			$parent_row2 = array_keys($count_child_row2);
			$max_row2 = 1;
			if($parent_row2 != '')
			{
				foreach($parent_row2 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row2[$value] != false)
						{
							$max_row2 = $count_child_row2[$value];
						}						
					}
				}
			}
		
			
			$count_child_row3 = array_count_values($list_parent_row3);
			arsort($count_child_row3);
			$parent_row3 = array_keys($count_child_row3);
			$max_row3 = 1;
			if($parent_row3 != '')
			{
				foreach($parent_row3 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row3[$value] != false)
						{
							$max_row3 = $count_child_row3[$value];	
						}								
					}
				}
			}
			
			
			$count_child_row4 = array_count_values($list_parent_row4);
			arsort($count_child_row4);
			$max_row4 = 1;
			if($parent_row4 != '')
			{
				foreach($parent_row4 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row4[$value] != false)
						{
							$max_row4 = $count_child_row4[$value];	
						}								
					}
				}
			}
			
			$count_child_row5 = array_count_values($list_parent_row5);
			arsort($count_child_row5);
			$max_row5 = 1;
			if($parent_row5 != '')
			{
				foreach($parent_row5 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row5[$value] != false)
						{
							$max_row5 = $count_child_row5[$value];	
						}								
					}
				}
			}
			
			$count_child_row6 = array_count_values($list_parent_row6);
			arsort($count_child_row6);
			$max_row6 = 1;
			if($parent_row6 != '')
			{
				foreach($parent_row6 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row6[$value] != false)
						{
							$max_row6 = $count_child_row6[$value];	
						}								
					}
				}
			}
			
			$count_child_row7 = array_count_values($list_parent_row7);
			arsort($count_child_row7);
			$max_row7 = 1;
			if($parent_row7 != '')
			{
				foreach($parent_row7 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row7[$value] != false)
						{
							$max_row7 = $count_child_row7[$value];	
						}								
					}
				}
			}
			
			$count_child_row8 = array_count_values($list_parent_row8);
			arsort($count_child_row8);
			$max_row8 = 1;
			if($parent_row8 != '')
			{
				foreach($parent_row8 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row8[$value] != false)
						{
							$max_row8 = $count_child_row8[$value];	
						}								
					}
				}
			}
			
			$count_child_row9 = array_count_values($list_parent_row9);
			arsort($count_child_row9);
			$max_row9 = 1;
			if($parent_row9 != '')
			{
				foreach($parent_row9 as $value)
				{
					if($is_gparent[$value] == "yes")
					{
						if ($count_child_row9[$value] != false)
						{
							$max_row9 = $count_child_row9[$value];	
						}								
					}
				}
			}
			
			$minimum_width = $template_width * $max_row1 * $max_row2 * $max_row3 * $max_row4 * $max_row5 * $max_row6 * $max_row7 * $max_row8 * $max_row9 + 1;
		}
		
		if($optimised == "no")
		{
			$count_child_row1 = array_count_values($list_parent_row1);
			arsort($count_child_row1);
			$max_row1 = 1;
			if (reset($count_child_row1) != false)
				$max_row1 = reset($count_child_row1);
			
			$count_child_row2 = array_count_values($list_parent_row2);
			arsort($count_child_row2);
			$max_row2 = 1;
			if (reset($count_child_row2) != false)
				$max_row2 = reset($count_child_row2);
			
			$count_child_row3 = array_count_values($list_parent_row3);
			arsort($count_child_row3);
			$max_row3 = 1;
			if (reset($count_child_row3) != false)
				$max_row3 = reset($count_child_row3);
			
			$count_child_row4 = array_count_values($list_parent_row4);
			arsort($count_child_row4);
			$max_row4 = 1;
			if (reset($count_child_row4) != false)
				$max_row4 = reset($count_child_row4);
			
			$count_child_row5 = array_count_values($list_parent_row5);
			arsort($count_child_row5);
			$max_row5 = 1;
			if (reset($count_child_row5) != false)
				$max_row5 = reset($count_child_row5);
			
			$count_child_row6 = array_count_values($list_parent_row6);
			arsort($count_child_row6);
			$max_row6 = 1;
			if (reset($count_child_row6) != false)
				$max_row6 = reset($count_child_row6);
			
			$count_child_row7 = array_count_values($list_parent_row7);
			arsort($count_child_row7);
			$max_row7 = 1;
			if (reset($count_child_row7) != false)
				$max_row7 = reset($count_child_row7);
			
			$count_child_row8 = array_count_values($list_parent_row8);
			arsort($count_child_row8);
			$max_row8 = 1;
			if (reset($count_child_row8) != false)
				$max_row8 = reset($count_child_row8);
			
			$count_child_row9 = array_count_values($list_parent_row9);
			arsort($count_child_row9);
			$max_row9 = 1;
			if (reset($count_child_row9) != false)
				$max_row9 = reset($count_child_row9);
			
			$minimum_width = $template_width * $max_row1 * $max_row2 * $max_row3 * $max_row4 * $max_row5 * $max_row6 * $max_row7 * $max_row8 * $max_row9 + 1;
		}
		
		$count_all_child = array_count_values($parent);
		$pics_folders = ''.plugins_url( 'image/', __FILE__ ).'';
		
		$output = '';
		$output .= '<style type="text/css">';
			$output .= '.pseoc_mid_content'.$postid.' {';
				$output .= 'border:2px solid #000000;';
				$output .= 'background: #ffffff;';
			$output .= '}';
			$output .= '.pseoc_top_left_child'.$postid.' {';
				$output .= 'border-right:1px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_top_right_child'.$postid.' {';
				$output .= 'border-left:1px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_bot_left_child'.$postid.' {';
				$output .= 'border-right:1px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_bot_right_child'.$postid.' {';
				$output .= 'border-left:1px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_wrapper_mid'.$postid.':after {';
				$output .= 'border-top:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_wrapper_left'.$postid.':after {';
				$output .= 'border-top:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_wrapper_right'.$postid.':after {';
				$output .= 'border-top:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_top_left_first'.$postid.' {';
				$output .= 'border-top:2px solid #000000;';
				$output .= 'border-left:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_top_left'.$postid.' {';
				$output .= 'border-left:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_mid_left_1'.$postid.' {';
				$output .= 'border-bottom:1px solid #000000;';
				$output .= 'border-left:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_mid_left_2'.$postid.' {';
				$output .= 'border-top:1px solid #000000;';
				$output .= 'border-left:2px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_mid_left_2_last'.$postid.' {';
				$output .= 'border-top:1px solid #000000;';
			$output .= '}';
			$output .= '.pseoc_sub_mid_content'.$postid.' {';
				$output .= 'border:2px solid #000000;';
				$output .= 'background: #ffffff;';
			$output .= '}';
			$output .= '.pseoc_sub_bot_left'.$postid.' {';
				$output .= 'border-left:2px solid #000000;';
			$output .= '}';
		$output .= '</style>';
		
		$output .= '<div id="global_wrapper'.$postid.'" style="position:relative;width:'.$container_width_custom.';height:'.$container_height_custom.';">';		
		$output .= '<div id="wrapper_easy_org_chart_pro_overflow'.$postid.'" class="e_o_c_pro_wrapper_overflow" style="width:'.$container_width_custom.';height:'.$container_height_custom.';position:relative;padding:20px;">';
		$output .= '<div id="wrapper_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_wrapper_template_1 pseoc_zoom_siblings" style="width:'.$minimum_width.'px;position:absolute;">';
		
		for( $i=0; $i<$nb_cell;$i++)
		{
			$count_for_image_i = 1;
			if($row[$i] == 1)
			{
				$row1_width = $minimum_width * (100 / $nb_row1) / 100;
				$output .= '<div id="'.$boxe_id[$i].'_rank1_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper" style="width:'. 100 / $nb_row1 .'%;">';
				$output .= '<div id="'.$boxe_id[$i].'_rank1_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
				$output .= '<div id="'.$boxe_id[$i].'_rank1_top_left'.$postid.'" class="pseoc_top_left"></div>';					
				$output .= '<div id="'.$boxe_id[$i].'_rank1_top_right'.$postid.'" class="pseoc_top_right"></div>';					
				$output .= '<div id="'.$boxe_id[$i].'_rank1_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
				
				$output .= '<div id="'.$boxe_id[$i].'_rank1_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
				
				if(isset($pic[$i]) && $pic[$i] !== false && $pic[$i] != "")
				{
					$output .= '<img src="'.$pic[$i].'" class="e_o_c_pro_profile_pic_top"/>';
				}
				else
				{
					$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic_top"/>';
				}
				
				$output .= '<p class="e_o_c_pro_firstname_top" style="color:#000000;" >'.$first_name[$i].'</p>';
				$output .= '<p class="e_o_c_pro_lastname_top" style="color:#000000;">'.$last_name[$i].'</p>';
				$output .= '<p class="e_o_c_pro_job_top" style="color:#999999;">'.$job[$i].'</p>';
				$output .= '<p class="e_o_c_pro_icon" >';				
				
				$output .= '</p>';
				$output .= '</div>';
				
				$output .= '<div id="'.$boxe_id[$i].'_rank1_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
				if(!isset($count_all_child[$boxe_id[$i]]))
				{									
					$output .= '<div id="'.$boxe_id[$i].'_rank1_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
					$output .= '<div id="'.$boxe_id[$i].'_rank1_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
				}else{
					$output .= '<div id="'.$boxe_id[$i].'_rank1_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
					$output .= '<div id="'.$boxe_id[$i].'_rank1_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
				}				
				$output .= '</div>';			
				if ($nb_row2 > 0)
				{
					for( $j=0; $j<$nb_cell;$j++)
					{
						$count_for_image_j = 1;					
						if($row[$j] == 2 && $parent[$j] == $boxe_id[$i] )
						{
							$row2_width = $row1_width * (100 / $count_all_child[$boxe_id[$i]]) / 100;	
							if ($optimised == "yes" && $is_gparent[$parent[$j]] == "no")
							{
								if($count_for_image_i == 1)
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row1_width - $template_width) / 2 .'px;">';
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
								}else{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
								}
								
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
								$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
								
								if($count_for_image_i == $count_all_child[$boxe_id[$i]])
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
								}
								else
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
								}
								$output .= '</div>';
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
								
								
								if(isset($pic[$j]) && $pic[$j] !== false && $pic[$j] != "")
								{
									$output .= '<img src="'.$pic[$j].'" class="e_o_c_pro_profile_pic"/>';
								}
								else
								{
									$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
								}
								
								$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$j].'</p>';
								$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$j].'</p>';
								$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$j].'</p>';

								$output .= '</div>';
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
								
								if($count_for_image_i == $count_all_child[$boxe_id[$i]])
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
								}
								else
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
								}
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
								
								$output .= '</div>';
						
								if($count_for_image_i == $count_all_child[$boxe_id[$i]])
								{
									$output .= '</div>';
								}
								
								$count_for_image_i++;
							}
							else
							{
								if($count_all_child[$boxe_id[$i]] == 1)
								{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$i]] .'%;">';
								}
								
								if($count_all_child[$boxe_id[$i]] > 1)
								{
									if($count_for_image_i == 1)
									{
										$output .= '<div id="'.$boxe_id[$j].'_rank2_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$i]] .'%;">';
									}
									else
									{
										if($count_for_image_i == $count_all_child[$boxe_id[$i]])
										{
											$output .= '<div id="'.$boxe_id[$j].'_rank2_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$i]] .'%;">';
										}
										else
										{
											$output .= '<div id="'.$boxe_id[$j].'_rank2_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$i]] .'%;">';
										}
									}
								}
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
								$output .= '<div id="'.$boxe_id[$j].'_rank2_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
								$output .= '<div id="'.$boxe_id[$j].'_rank2_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
								$output .= '<div id="'.$boxe_id[$j].'_rank2_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
								
								
								if(isset($pic[$j]) && $pic[$j] !== false && $pic[$j] != "")
								{
									$output .= '<img src="'.$pic[$j].'" class="e_o_c_pro_profile_pic"/>';
								}
								else
								{
									$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
								}
								
								$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$j].'</p>';
								$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$j].'</p>';
								$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$j].'</p>';

								$output .= '</div>';
								
								$output .= '<div id="'.$boxe_id[$j].'_rank2_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
								
								if(!isset($count_all_child[$boxe_id[$j]]))
								{									
									$output .= '<div id="'.$boxe_id[$j].'_rank2_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
									$output .= '<div id="'.$boxe_id[$j].'_rank2_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
								}else{
									$output .= '<div id="'.$boxe_id[$j].'_rank2_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
									$output .= '<div id="'.$boxe_id[$j].'_rank2_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
								}
								$output .= '</div>';
								
								if ($nb_row3 > 0)
								{
									for( $k=0; $k<$nb_cell;$k++)
									{
										$count_for_image_k = 1;
										if($row[$k] == 3 && $parent[$k] == $boxe_id[$j] )
										{
											$row3_width = $row2_width * (100 / $count_all_child[$boxe_id[$j]]) / 100;
											if ($optimised == "yes" && $is_gparent[$parent[$k]] == "no")
											{
												if($count_for_image_j == 1)
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row2_width - $template_width) / 2 .'px;">';
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
												}else{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
												}
												
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
												$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
												
												if($count_for_image_j == $count_all_child[$boxe_id[$j]])
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
												}
												else
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
												}
												$output .= '</div>';
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
												
												
												if(isset($pic[$k]) && $pic[$k] !== false && $pic[$k] != "")
												{
													$output .= '<img src="'.$pic[$k].'" class="e_o_c_pro_profile_pic"/>';
												}
												else
												{
													$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
												}
												
												$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$k].'</p>';
												$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$k].'</p>';
												$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$k].'</p>';

												$output .= '</div>';
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
												
												if($count_for_image_j == $count_all_child[$boxe_id[$j]])
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
												}
												else
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
												}
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
												
												$output .= '</div>';
										
												if($count_for_image_j == $count_all_child[$boxe_id[$j]])
												{
													$output .= '</div>';
												}
												
												$count_for_image_j++;
											}
											else
											{
												if($count_all_child[$boxe_id[$j]] == 1)
												{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$j]] .'%;">';
												}
												
												if($count_all_child[$boxe_id[$j]] > 1)
												{
													if($count_for_image_j == 1)
													{
														$output .= '<div id="'.$boxe_id[$k].'_rank3_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$j]] .'%;">';
													}
													else
													{
														if($count_for_image_j == $count_all_child[$boxe_id[$j]])
														{
															$output .= '<div id="'.$boxe_id[$k].'_rank3_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$j]] .'%;">';
														}
														else
														{
															$output .= '<div id="'.$boxe_id[$k].'_rank3_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$j]] .'%;">';
														}
													}
												}
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
												$output .= '<div id="'.$boxe_id[$k].'_rank3_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
												$output .= '<div id="'.$boxe_id[$k].'_rank3_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
												$output .= '<div id="'.$boxe_id[$k].'_rank3_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
												
												
												if(isset($pic[$k]) && $pic[$k] !== false && $pic[$k] != "")
												{
													$output .= '<img src="'.$pic[$k].'" class="e_o_c_pro_profile_pic"/>';
												}
												else
												{
													$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
												}
												
												$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$k].'</p>';
												$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$k].'</p>';
												$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$k].'</p>';

												$output .= '</div>';
												
												$output .= '<div id="'.$boxe_id[$k].'_rank3_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
												
												if(!isset($count_all_child[$boxe_id[$k]]))
												{									
													$output .= '<div id="'.$boxe_id[$k].'_rank3_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
													$output .= '<div id="'.$boxe_id[$k].'_rank3_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
												}else{
													$output .= '<div id="'.$boxe_id[$k].'_rank3_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
													$output .= '<div id="'.$boxe_id[$k].'_rank3_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
												}
												$output .= '</div>';
												
												
												if ($nb_row4 > 0)
												{
													for( $l=0; $l<$nb_cell;$l++)
													{
														$count_for_image_l = 1;
														if($row[$l] == 4 && $parent[$l] == $boxe_id[$k] )
														{
															$row4_width = $row3_width * (100 / $count_all_child[$boxe_id[$k]]) / 100;
															if ($optimised == "yes" && $is_gparent[$parent[$l]] == "no")
															{
																if($count_for_image_k == 1)
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row3_width - $template_width) / 2 .'px;">';
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																}else{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																}
																
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																
																if($count_for_image_k == $count_all_child[$boxe_id[$k]])
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																}
																else
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																}
																$output .= '</div>';
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																
																
																if(isset($pic[$l]) && $pic[$l] !== false && $pic[$l] != "")
																{
																	$output .= '<img src="'.$pic[$l].'" class="e_o_c_pro_profile_pic"/>';
																}
																else
																{
																	$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																}
																
																$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$l].'</p>';
																$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$l].'</p>';
																$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$l].'</p>';

																$output .= '</div>';
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																
																if($count_for_image_k == $count_all_child[$boxe_id[$k]])
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																}
																else
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																}
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																
																$output .= '</div>';
														
																if($count_for_image_k == $count_all_child[$boxe_id[$k]])
																{
																	$output .= '</div>';
																}
																
																$count_for_image_k++;
															}
															else
															{
																if($count_all_child[$boxe_id[$k]] == 1)
																{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$k]] .'%;">';
																}
																
																if($count_all_child[$boxe_id[$k]] > 1)
																{
																	if($count_for_image_k == 1)
																	{
																		$output .= '<div id="'.$boxe_id[$l].'_rank4_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$k]] .'%;">';
																	}
																	else
																	{
																		if($count_for_image_k == $count_all_child[$boxe_id[$k]])
																		{
																			$output .= '<div id="'.$boxe_id[$l].'_rank4_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$k]] .'%;">';
																		}
																		else
																		{
																			$output .= '<div id="'.$boxe_id[$l].'_rank4_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$k]] .'%;">';
																		}
																	}
																}
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																$output .= '<div id="'.$boxe_id[$l].'_rank4_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																$output .= '<div id="'.$boxe_id[$l].'_rank4_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																$output .= '<div id="'.$boxe_id[$l].'_rank4_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																
																
																if(isset($pic[$l]) && $pic[$l] !== false && $pic[$l] != "")
																{
																	$output .= '<img src="'.$pic[$l].'" class="e_o_c_pro_profile_pic"/>';
																}
																else
																{
																	$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																}
																
																$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$l].'</p>';
																$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$l].'</p>';
																$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$l].'</p>';

																$output .= '</div>';
																
																$output .= '<div id="'.$boxe_id[$l].'_rank4_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																
																if(!isset($count_all_child[$boxe_id[$l]]))
																{									
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																}else{
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																	$output .= '<div id="'.$boxe_id[$l].'_rank4_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																}
																$output .= '</div>';

																if ($nb_row5 > 0)
																{
																	for( $m=0; $m<$nb_cell;$m++)
																	{
																		$count_for_image_m = 1;
																		if($row[$m] == 5 && $parent[$m] == $boxe_id[$l] )
																		{
																			$row5_width = $row4_width * (100 / $count_all_child[$boxe_id[$l]]) / 100;
																			if ($optimised == "yes" && $is_gparent[$parent[$m]] == "no")
																			{
																				if($count_for_image_l == 1)
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row4_width - $template_width) / 2 .'px;">';
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																				}else{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																				}
																				
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																				
																				if($count_for_image_l == $count_all_child[$boxe_id[$l]])
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																				}
																				else
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																				}
																				$output .= '</div>';
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																				
																				
																				if(isset($pic[$m]) && $pic[$m] !== false && $pic[$m] != "")
																				{
																					$output .= '<img src="'.$pic[$m].'" class="e_o_c_pro_profile_pic"/>';
																				}
																				else
																				{
																					$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																				}
																				
																				$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$m].'</p>';
																				$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$m].'</p>';
																				$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$m].'</p>';

																				$output .= '</div>';
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																				
																				if($count_for_image_l == $count_all_child[$boxe_id[$l]])
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																				}
																				else
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																				}
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																				
																				$output .= '</div>';
																		
																				if($count_for_image_l == $count_all_child[$boxe_id[$l]])
																				{
																					$output .= '</div>';
																				}
																				
																				$count_for_image_l++;
																			}
																			else
																			{
																				if($count_all_child[$boxe_id[$l]] == 1)
																				{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$l]] .'%;">';
																				}
																				
																				if($count_all_child[$boxe_id[$l]] > 1)
																				{
																					if($count_for_image_l == 1)
																					{
																						$output .= '<div id="'.$boxe_id[$m].'_rank5_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$l]] .'%;">';
																					}
																					else
																					{
																						if($count_for_image_l == $count_all_child[$boxe_id[$l]])
																						{
																							$output .= '<div id="'.$boxe_id[$m].'_rank5_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$l]] .'%;">';
																						}
																						else
																						{
																							$output .= '<div id="'.$boxe_id[$m].'_rank5_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$l]] .'%;">';
																						}
																					}
																				}
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																				
																				
																				if(isset($pic[$m]) && $pic[$m] !== false && $pic[$m] != "")
																				{
																					$output .= '<img src="'.$pic[$m].'" class="e_o_c_pro_profile_pic"/>';
																				}
																				else
																				{
																					$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																				}
																				
																				$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$m].'</p>';
																				$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$m].'</p>';
																				$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$m].'</p>';

																				$output .= '</div>';
																				
																				$output .= '<div id="'.$boxe_id[$m].'_rank5_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																				
																				if(!isset($count_all_child[$boxe_id[$m]]))
																				{									
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																				}else{
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																					$output .= '<div id="'.$boxe_id[$m].'_rank5_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																				}
																				$output .= '</div>';
																			
																				if ($nb_row6 > 0)
																				{
																					for( $n=0; $n<$nb_cell;$n++)
																					{
																						$count_for_image_n = 1;
																						if($row[$n] == 6 && $parent[$n] == $boxe_id[$m] )
																						{
																							$row6_width = $row5_width * (100 / $count_all_child[$boxe_id[$m]]) / 100;
																							if ($optimised == "yes" && $is_gparent[$parent[$n]] == "no")
																							{
																								if($count_for_image_m == 1)
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row5_width - $template_width) / 2 .'px;">';
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																								}else{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																								}
																								
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																								
																								if($count_for_image_m == $count_all_child[$boxe_id[$m]])
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																								}
																								else
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																								}
																								$output .= '</div>';
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																								
																								
																								if(isset($pic[$n]) && $pic[$n] !== false && $pic[$n] != "")
																								{
																									$output .= '<img src="'.$pic[$n].'" class="e_o_c_pro_profile_pic"/>';
																								}
																								else
																								{
																									$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																								}
																								
																								$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$n].'</p>';
																								$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$n].'</p>';
																								$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$n].'</p>';

																								$output .= '</div>';
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																								
																								if($count_for_image_m == $count_all_child[$boxe_id[$m]])
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																								}
																								else
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																								}
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																								
																								$output .= '</div>';
																						
																								if($count_for_image_m == $count_all_child[$boxe_id[$m]])
																								{
																									$output .= '</div>';
																								}
																								
																								$count_for_image_m++;
																							}
																							else
																							{
																								if($count_all_child[$boxe_id[$m]] == 1)
																								{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$m]] .'%;">';
																								}
																								
																								if($count_all_child[$boxe_id[$m]] > 1)
																								{
																									if($count_for_image_m == 1)
																									{
																										$output .= '<div id="'.$boxe_id[$n].'_rank6_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$m]] .'%;">';
																									}
																									else
																									{
																										if($count_for_image_m == $count_all_child[$boxe_id[$m]])
																										{
																											$output .= '<div id="'.$boxe_id[$n].'_rank6_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$m]] .'%;">';
																										}
																										else
																										{
																											$output .= '<div id="'.$boxe_id[$n].'_rank6_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$m]] .'%;">';
																										}
																									}
																								}
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																								
																								
																								if(isset($pic[$n]) && $pic[$n] !== false && $pic[$n] != "")
																								{
																									$output .= '<img src="'.$pic[$n].'" class="e_o_c_pro_profile_pic"/>';
																								}
																								else
																								{
																									$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																								}
																								
																								$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$n].'</p>';
																								$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$n].'</p>';
																								$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$n].'</p>';

																								$output .= '</div>';
																								
																								$output .= '<div id="'.$boxe_id[$n].'_rank6_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																								
																								if(!isset($count_all_child[$boxe_id[$n]]))
																								{									
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																								}else{
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																									$output .= '<div id="'.$boxe_id[$n].'_rank6_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																								}
																								$output .= '</div>';
																								
																								if ($nb_row7 > 0)
																								{
																									for( $o=0; $o<$nb_cell;$o++)
																									{
																										$count_for_image_o = 1;
																										if($row[$o] == 7 && $parent[$o] == $boxe_id[$n] )
																										{	
																											$row7_width = $row6_width * (100 / $count_all_child[$boxe_id[$n]]) / 100;
																											if ($optimised == "yes" && $is_gparent[$parent[$o]] == "no")
																											{
																												if($count_for_image_n == 1)
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row6_width - $template_width) / 2 .'px;">';
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																												}else{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																												}
																												
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																												
																												if($count_for_image_n == $count_all_child[$boxe_id[$n]])
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																												}
																												else
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																												}
																												$output .= '</div>';
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																												
																												
																												if(isset($pic[$o]) && $pic[$o] !== false && $pic[$o] != "")
																												{
																													$output .= '<img src="'.$pic[$o].'" class="e_o_c_pro_profile_pic"/>';
																												}
																												else
																												{
																													$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																												}
																												
																												$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$o].'</p>';
																												$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$o].'</p>';
																												$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$o].'</p>';
																												$output .= '</div>';
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																												
																												if($count_for_image_n == $count_all_child[$boxe_id[$n]])
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																												}
																												else
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																												}
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																												
																												$output .= '</div>';
																										
																												if($count_for_image_n == $count_all_child[$boxe_id[$n]])
																												{
																													$output .= '</div>';
																												}
																												
																												$count_for_image_n++;
																											}
																											else
																											{
																												if($count_all_child[$boxe_id[$n]] == 1)
																												{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$n]] .'%;">';
																												}
																												
																												if($count_all_child[$boxe_id[$n]] > 1)
																												{
																													if($count_for_image_n == 1)
																													{
																														$output .= '<div id="'.$boxe_id[$o].'_rank7_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$n]] .'%;">';
																													}
																													else
																													{
																														if($count_for_image_n == $count_all_child[$boxe_id[$n]])
																														{
																															$output .= '<div id="'.$boxe_id[$o].'_rank7_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$n]] .'%;">';
																														}
																														else
																														{
																															$output .= '<div id="'.$boxe_id[$o].'_rank7_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$n]] .'%;">';
																														}
																													}
																												}
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																												
																												
																												if(isset($pic[$o]) && $pic[$o] !== false && $pic[$o] != "")
																												{
																													$output .= '<img src="'.$pic[$o].'" class="e_o_c_pro_profile_pic"/>';
																												}
																												else
																												{
																													$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																												}
																												
																												$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$o].'</p>';
																												$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$o].'</p>';
																												$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$o].'</p>';
																												$output .= '</div>';
																												
																												$output .= '<div id="'.$boxe_id[$o].'_rank7_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																												
																												if(!isset($count_all_child[$boxe_id[$o]]))
																												{									
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																												}else{
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																													$output .= '<div id="'.$boxe_id[$o].'_rank7_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																												}
																												$output .= '</div>';
																							
																												if ($nb_row8 > 0)
																												{
																													for( $p=0; $p<$nb_cell;$p++)
																													{
																														$count_for_image_p = 1;
																														if($row[$p] == 8 && $parent[$p] == $boxe_id[$o] )
																														{	
																															$row8_width = $row7_width * (100 / $count_all_child[$boxe_id[$o]]) / 100;
																															if ($optimised == "yes" && $is_gparent[$parent[$p]] == "no")
																															{
																																if($count_for_image_o == 1)
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row7_width - $template_width) / 2 .'px;">';
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																																}else{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																																}
																																
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																																
																																if($count_for_image_o == $count_all_child[$boxe_id[$o]])
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																																}
																																else
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																																}
																																$output .= '</div>';
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																																
																																
																																if(isset($pic[$p]) && $pic[$p] !== false && $pic[$p] != "")
																																{
																																	$output .= '<img src="'.$pic[$p].'" class="e_o_c_pro_profile_pic"/>';
																																}
																																else
																																{
																																	$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																																}
																																
																																$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$p].'</p>';
																																$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$p].'</p>';
																																$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$p].'</p>';
	
																																$output .= '</div>';
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																																
																																if($count_for_image_o == $count_all_child[$boxe_id[$o]])
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																																}
																																else
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																																}
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																																
																																$output .= '</div>';
																														
																																if($count_for_image_o == $count_all_child[$boxe_id[$o]])
																																{
																																	$output .= '</div>';
																																}
																																
																																$count_for_image_o++;
																															}
																															else
																															{
																																if($count_all_child[$boxe_id[$o]] == 1)
																																{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$o]] .'%;">';
																																}
																																
																																if($count_all_child[$boxe_id[$o]] > 1)
																																{
																																	if($count_for_image_o == 1)
																																	{
																																		$output .= '<div id="'.$boxe_id[$p].'_rank8_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$o]] .'%;">';
																																	}
																																	else
																																	{
																																		if($count_for_image_o == $count_all_child[$boxe_id[$o]])
																																		{
																																			$output .= '<div id="'.$boxe_id[$p].'_rank8_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$o]] .'%;">';
																																		}
																																		else
																																		{
																																			$output .= '<div id="'.$boxe_id[$p].'_rank8_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$o]] .'%;">';
																																		}
																																	}
																																}
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																																
																																
																																if(isset($pic[$p]) && $pic[$p] !== false && $pic[$p] != "")
																																{
																																	$output .= '<img src="'.$pic[$p].'" class="e_o_c_pro_profile_pic"/>';
																																}
																																else
																																{
																																	$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																																}
																																
																																$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$p].'</p>';
																																$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$p].'</p>';
																																$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$p].'</p>';
																																$output .= '</div>';
																																
																																$output .= '<div id="'.$boxe_id[$p].'_rank8_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																																
																																if(!isset($count_all_child[$boxe_id[$p]]))
																																{									
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																																}else{
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																																	$output .= '<div id="'.$boxe_id[$p].'_rank8_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																																}
																																$output .= '</div>';
																									
																																if ($nb_row9 > 0)
																																{
																																	for( $q=0; $q<$nb_cell;$q++)
																																	{
																																		$count_for_image_q = 1;
																																		if($row[$q] == 9 && $parent[$q] == $boxe_id[$p] )
																																		{
																																			$row9_width = $row8_width * (100 / $count_all_child[$boxe_id[$p]]) / 100;
																																			if ($optimised == "yes")
																																			{
																																				if($count_for_image_p == 1)
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper_bg_sub" style="width:'. $template_width .'px;margin-left:'. ($row8_width - $template_width) / 2 .'px;">';
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';	
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_left'.$postid.'" class="pseoc_sub_top_left_first'.$postid.' pseoc_sub_top_left_first"></div>';	
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_top_right_first"></div>';
																																				}else{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_sub_content">';
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_left'.$postid.'" class="pseoc_sub_top_left'.$postid.' pseoc_sub_top_left"></div>';	
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_top_right"></div>';
																																				}
																																				
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_mid_left">';
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_1'.$postid.' pseoc_sub_mid_left_1"></div>';
																																				
																																				if($count_for_image_p == $count_all_child[$boxe_id[$p]])
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2_last'.$postid.' pseoc_sub_mid_left_2_last"></div>';
																																				}
																																				else
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_top_right'.$postid.'" class="pseoc_sub_mid_left_2'.$postid.' pseoc_sub_mid_left_2"></div>';
																																				}
																																				$output .= '</div>';
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_mid_content'.$postid.'" class="pseoc_sub_mid_content'.$postid.' pseoc_sub_mid_content">';	
																																				
																																				
																																				if(isset($pic[$q]) && $pic[$q] !== false && $pic[$q] != "")
																																				{
																																					$output .= '<img src="'.$pic[$q].'" class="e_o_c_pro_profile_pic"/>';
																																				}
																																				else
																																				{
																																					$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																																				}
																																				
																																				$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$q].'</p>';
																																				$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$q].'</p>';
																																				$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$q].'</p>';
						
																																				$output .= '</div>';
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_mid_right'.$postid.'" class="pseoc_sub_mid_right"></div>';	
																																				
																																				if($count_for_image_p == $count_all_child[$boxe_id[$p]])
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left_last"></div>';	
																																				}
																																				else
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_bot_left'.$postid.'" class="pseoc_sub_bot_left'.$postid.' pseoc_sub_bot_left"></div>';	
																																				}
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_sub_bot_right'.$postid.'" class="pseoc_sub_bot_right"></div>';	
																																				
																																				$output .= '</div>';
																																		
																																				if($count_for_image_p == $count_all_child[$boxe_id[$p]])
																																				{
																																					$output .= '</div>';
																																				}
																																				
																																				$count_for_image_p++;
																																			}
																																			else
																																			{
																																				if($count_all_child[$boxe_id[$p]] == 1)
																																				{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid_alone" style="width:'. 100 / $count_all_child[$boxe_id[$p]] .'%;">';
																																				}
																																				
																																				if($count_all_child[$boxe_id[$p]] > 1)
																																				{
																																					if($count_for_image_p == 1)
																																					{
																																						$output .= '<div id="'.$boxe_id[$q].'_rank9_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_left'.$postid.' pseoc_wrapper_left" style="width:'. 100 / $count_all_child[$boxe_id[$p]] .'%;">';
																																					}
																																					else
																																					{
																																						if($count_for_image_p == $count_all_child[$boxe_id[$p]])
																																						{
																																							$output .= '<div id="'.$boxe_id[$q].'_rank9_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_right'.$postid.' pseoc_wrapper_right" style="width:'. 100 / $count_all_child[$boxe_id[$p]] .'%;">';
																																						}
																																						else
																																						{
																																							$output .= '<div id="'.$boxe_id[$q].'_rank9_easy_org_chart_pro_wrap'.$postid.'" class="e_o_c_pro_wrapper pseoc_wrapper_mid'.$postid.' pseoc_wrapper_mid" style="width:'. 100 / $count_all_child[$boxe_id[$p]] .'%;">';
																																						}
																																					}
																																				}
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_easy_org_chart_pro'.$postid.'" class="e_o_c_pro_content">';	
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_top_left'.$postid.'" class="pseoc_top_left_child'.$postid.' pseoc_top_left_child"></div>';					
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_top_right'.$postid.'" class="pseoc_top_right_child'.$postid.' pseoc_top_right_child"></div>';					
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_mid_left'.$postid.'" class="pseoc_mid_left"></div>';	
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_mid_content'.$postid.'" class="pseoc_mid_content'.$postid.' pseoc_mid_content">';	
																																				
																																				
																																				if(isset($pic[$q]) && $pic[$q] !== false && $pic[$q] != "")
																																				{
																																					$output .= '<img src="'.$pic[$q].'" class="e_o_c_pro_profile_pic"/>';
																																				}
																																				else
																																				{
																																					$output .= '<img src="'.$pics_folders.'john_doe.png" class="e_o_c_pro_profile_pic"/>';
																																				}
																																				
																																				$output .= '<p class="e_o_c_pro_firstname" style="color:#000000;" >'.$first_name[$q].'</p>';
																																				$output .= '<p class="e_o_c_pro_lastname" style="color:#000000;">'.$last_name[$q].'</p>';
																																				$output .= '<p class="e_o_c_pro_job" style="color:#999999;" >'.$job[$q].'</p>';
				
																																				$output .= '</div>';
																																				
																																				$output .= '<div id="'.$boxe_id[$q].'_rank9_mid_right'.$postid.'" class="pseoc_mid_right"></div>';		
																																				
																																				if(!isset($count_all_child[$boxe_id[$q]]))
																																				{									
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_bot_left'.$postid.'" class="pseoc_bot_left"></div>';					
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_bot_right'.$postid.'" class="pseoc_bot_right"></div>';	
																																				}else{
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_bot_left'.$postid.'" class="pseoc_bot_left_child'.$postid.' pseoc_bot_left_child"></div>';					
																																					$output .= '<div id="'.$boxe_id[$q].'_rank9_bot_right'.$postid.'" class="pseoc_bot_right_child'.$postid.' pseoc_bot_right_child"></div>';		
																																				}
																																				$output .= '</div>';
																																				$count_for_image_p++;
																																			}		
																																		}
																																	}
																																}	
																																$output .= '</div>';
																																$count_for_image_o++;
																															}		
																														}
																													}
																												}
																												$output .= '</div>';
																												$count_for_image_n++;
																											}		
																										}
																									}																			
																								}
																								$output .= '</div>';
																								$count_for_image_m++;
																							}		
																						}
																					}
																				}		
																				$output .= '</div>';
																				$count_for_image_l++;
																			}	
																		}
																	}
																}	
																$output .= '</div>';
																$count_for_image_k++;
															}	
														}
													}
												}	
												$output .= '</div>';
												$count_for_image_j++;
											}		
										}
									}
								}
								$output .= '</div>';
								$count_for_image_i++;
							}
						}		
					}
				}				
				$output .= '</div>';
			}
		}	
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		
		$output .= '<script type="text/javascript">';
		$output .= '$=jQuery.noConflict();';
		$output .= '$(document).ready(function()';
		$output .= '{';		
		
		$output .= 'var outerContent = $("#wrapper_easy_org_chart_pro_overflow'.$postid.'");';	
		$output .= 'var innerContent = $("#wrapper_easy_org_chart_pro'.$postid.'");';	
		$output .= 'outerContent.scrollLeft((innerContent.width() - outerContent.width()) / 2);   ';			

		$output .= '});';
		$output .= '</script>';
		
	}
	endforeach; wp_reset_query();
	return $output;
}
add_shortcode( 'e_org_chart_ps', 'pseoc_shortcode' );


	
?>