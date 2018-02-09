<?php 
 if ( ! defined( 'ABSPATH' ) ) exit;
$De_Settings = unserialize(get_option('servicebox_default_Settings'));
 $PostId = $post->ID;
 $Settings = unserialize(get_post_meta( $PostId, 'Wpsm_Servicebox_Shortcode_Settings', true));

		$option_names = array(
			    'service_acc_sec_title' 		    =>$De_Settings['service_acc_sec_title'],
				'service_display_icon' 			    => $De_Settings['service_display_icon'],
				'service_display_readmore' 			=> $De_Settings['service_display_readmore'],
				'service_title_clr' 		        => $De_Settings['service_title_clr'],
				'service_icon_clr' 		            => $De_Settings['service_icon_clr'],
				'service_icon_bg_clr' 		        => $De_Settings['service_icon_bg_clr'],
				'service_des_clr' 		            => $De_Settings['service_des_clr'],
				'service_readmore_clr' 		        => $De_Settings['service_readmore_clr'],
				'service_readmore_bg_clr' 		    => $De_Settings['service_readmore_bg_clr'],
				'service_box_bg_clr_dsn2' 		    => $De_Settings['service_box_bg_clr_dsn2'],
				'service_title_font_size'	        => $De_Settings['service_title_font_size'],
				'service_des_font_size'	        	=> $De_Settings['service_des_font_size'],
				'service_readmore_font_size'	    => $De_Settings['service_readmore_font_size'],
				'font_family' 			            => $De_Settings['font_family'],
				"sb_layout"   						=> $De_Settings['sb_layout'],
				"sb_web_link_label"   				=> $De_Settings['sb_web_link_label'],
				"templates"   						=> $De_Settings['templates'],
				'custom_css' 			            => $De_Settings['custom_css'],
			
			);
			foreach($option_names as $option_name => $default_value) {
				if(isset($Settings[$option_name])) 
					${"" . $option_name}  = $Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}


			
		?>
<style>

</style>
<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#service_title_font_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#service_title_font_size" ).val( ui.value );
      }
		});
		
		jQuery( "#service_title_font_size_id" ).slider("value",<?php echo $service_title_font_size; ?>);
		jQuery( "#service_title_font_size" ).val( jQuery( "#service_title_font_size_id" ).slider( "value") );
    
  });
</script>
<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#service_des_font_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#service_des_font_size" ).val( ui.value );
      }
		});
		
		jQuery( "#service_des_font_size_id" ).slider("value",<?php echo $service_des_font_size; ?>);
		jQuery( "#service_des_font_size" ).val( jQuery( "#service_des_font_size_id" ).slider( "value") );
    
  });
</script> 
<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#service_readmore_font_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#service_readmore_font_size" ).val( ui.value );
      }
		});
		
		jQuery( "#service_readmore_font_size_id" ).slider("value",<?php echo $service_readmore_font_size; ?>);
		jQuery( "#service_readmore_font_size" ).val( jQuery( "#service_readmore_font_size_id" ).slider( "value") );
    
  });
</script> 
<Script>
function wpsm_update_default(){
	 jQuery.ajax({
		url: location.href,
		type: "POST",
		data : {
			    'action_faq':'default_settins_action',
			     },
                success : function(data){
									alert("Default Settings Updated");
									location.reload(true);
                                   }	
	});
	
}
</script>
<style>
.ac_tooltip{
	display:none;
	
}
</style>
<?php

if(isset($_POST['action_faq']) == "default_settins_action")
	{
	
		$Settings_Array2 = serialize( array(
			'service_acc_sec_title' 		        => $service_acc_sec_title,
				'service_display_icon' 			    => $service_display_icon,
				'service_display_readmore' 			=> $service_display_readmore,
				'service_title_clr' 		        => $service_title_clr,
				'service_icon_clr'	 		        => $service_icon_clr,
				'service_icon_bg_clr' 		        => $service_icon_bg_clr,
				'service_des_clr' 		            => $service_des_clr,
				'service_readmore_clr' 		        => $service_readmore_clr,
				'service_readmore_bg_clr' 		    => $service_readmore_bg_clr,
				'service_box_bg_clr_dsn2' 		    => $service_box_bg_clr_dsn2,
				'service_title_font_size'	        => $service_title_font_size,
				'service_des_font_size'	        	=> $service_des_font_size,
				'service_readmore_font_size'	    => $service_readmore_font_size,
				'font_family' 			            => $font_family,
				'templates' 			            => $templates,
				'sb_web_link_label' 			    => $sb_web_link_label,
				'sb_layout' 			            => $sb_layout,
				'custom_css' 			            => $custom_css,
				) );

			update_option('servicebox_default_Settings', $Settings_Array2);
}

 ?> 
<input type="hidden" id="wpsm_servicebox_setting_save_action" name="wpsm_servicebox_setting_save_action" value="wpsm_servicebox_setting_save_action">
		
<table class="form-table acc_table">
	<tbody>
		
		<tr>
			<th scope="row"><label><?php _e('Display Icon ',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_sec_title_tp"><i class="fa fa-lightbulb-o"></i></a>
				</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="service_display_icon" value="yes" id="enable_service_display_icon" <?php if($service_display_icon == 'yes' ) { echo "checked"; } ?>   >
					<label for="enable_service_display_icon" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_service_box_text_domain); ?></label>
					<input type="radio" class="switch-input" name="service_display_icon" value="no" id="disable_service_display_icon"  <?php if($service_display_icon == 'no' ) { echo "checked"; } ?> >
					<label for="disable_service_display_icon" class="switch-label switch-label-on"><?php _e('No',wpshopmart_service_box_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_sec_title_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Display Faq Section Title ',wpshopmart_service_box_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Display Read More Button ',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_sec_title_tp"><i class="fa fa-lightbulb-o"></i></a>
				</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="service_display_readmore" value="yes" id="enable_service_display_readmore" <?php if($service_display_readmore == 'yes' ) { echo "checked"; } ?>   >
					<label for="enable_service_display_readmore" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_service_box_text_domain); ?></label>
					<input type="radio" class="switch-input" name="service_display_readmore" value="no" id="disable_service_display_readmore"  <?php if($service_display_readmore == 'no' ) { echo "checked"; } ?> >
					<label for="disable_service_display_readmore" class="switch-label switch-label-on"><?php _e('No',wpshopmart_service_box_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_sec_title_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Display Faq Section Title ',wpshopmart_service_box_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Service Title Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_title_clr" name="service_title_clr" type="text" value="<?php echo $service_title_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Service Icon Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_icon_clr" name="service_icon_clr" type="text" value="<?php echo $service_icon_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
				
		<tr >
			<th scope="row"><label><?php _e('Service Icon Backgrond Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_icon_bg_clr" name="service_icon_bg_clr" type="text" value="<?php echo $service_icon_bg_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Service Description Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_des_clr" name="service_des_clr" type="text" value="<?php echo $service_des_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Read More Link Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_readmore_clr" name="service_readmore_clr" type="text" value="<?php echo $service_readmore_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Read More Link Background Color',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_readmore_bg_clr" name="service_readmore_bg_clr" type="text" value="<?php echo $service_readmore_bg_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		
		<tr >
			<th scope="row"><label><?php _e('Service Box Background Color for Design-2',wpshopmart_service_box_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="service_box_bg_clr_dsn2" name="service_box_bg_clr_dsn2" type="text" value="<?php echo $service_box_bg_clr_dsn2; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_service_box_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_service_box_directory_url.'assets/tooltip/img/test.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><?php _e('Title Font Size',wpshopmart_service_box_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#title_size_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div id="service_title_font_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="service_title_font_size" name="service_title_font_size"  readonly="readonly">
				<!-- Tooltip -->
				<div id="title_size_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Icon Font Size from here. Just Scroll it to change size.</h2>
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><?php _e('Service Description Font Size',wpshopmart_service_box_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#title_size_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div id="service_des_font_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="service_des_font_size" name="service_des_font_size"  readonly="readonly">
				<!-- Tooltip -->
				<div id="title_size_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Icon Font Size from here. Just Scroll it to change size.</h2>
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><?php _e('Read More Link Text Size',wpshopmart_service_box_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#title_size_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div id="service_readmore_font_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="service_readmore_font_size" name="service_readmore_font_size"  readonly="readonly">
				<!-- Tooltip -->
				<div id="title_size_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Icon Font Size from here. Just Scroll it to change size.</h2>
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th><?php _e('Font Style/Family',wpshopmart_service_box_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#font_family_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<?php if(!isset($font_family)) $font_family = "Open Sans";?>	
				<select name="font_family" id="font_family" class="standard-dropdown" style="width:100%" >
					<optgroup label="Default Fonts">
						<option value="Arial"           <?php if($font_family == 'Arial' ) { echo "selected"; } ?>>Arial</option>
						<option value="Arial Black"    <?php if($font_family == 'Arial Black' ) { echo "selected"; } ?>>Arial Black</option>
						<option value="Courier New"     <?php if($font_family == 'Courier New' ) { echo "selected"; } ?>>Courier New</option>
						<option value="Georgia"         <?php if($font_family == 'Georgia' ) { echo "selected"; } ?>>Georgia</option>
						<option value="Grande"          <?php if($font_family == 'Grande' ) { echo "selected"; } ?>>Grande</option>
						<option value="Helvetica" 	<?php if($font_family == 'Helvetica' ) { echo "selected"; } ?>>Helvetica Neue</option>
						<option value="Impact"         <?php if($font_family == 'Impact' ) { echo "selected"; } ?>>Impact</option>
						<option value="Lucida"         <?php if($font_family == 'Lucida' ) { echo "selected"; } ?>>Lucida</option>
						<option value="Lucida Grande"         <?php if($font_family == 'Lucida Grande' ) { echo "selected"; } ?>>Lucida Grande</option>
						<option value="Open Sans"   <?php if($font_family == 'Open Sans' ) { echo "selected"; } ?>>Open Sans</option>
						<option value="OpenSansBold"   <?php if($font_family == 'OpenSansBold' ) { echo "selected"; } ?>>OpenSansBold</option>
						<option value="Palatino Linotype"       <?php if($font_family == 'Palatino Linotype' ) { echo "selected"; } ?>>Palatino</option>
						<option value="Sans"           <?php if($font_family == 'Sans' ) { echo "selected"; } ?>>Sans</option>
						<option value="sans-serif"           <?php if($font_family == 'sans-serif' ) { echo "selected"; } ?>>Sans-Serif</option>
						<option value="Tahoma"         <?php if($font_family == 'Tahoma' ) { echo "selected"; } ?>>Tahoma</option>
						<option value="Times New Roman"          <?php if($font_family == 'Times New Roman' ) { echo "selected"; } ?>>Times New Roman</option>
						<option value="Trebuchet"      <?php if($font_family == 'Trebuchet' ) { echo "selected"; } ?>>Trebuchet</option>
						<option value="Verdana"        <?php if($font_family == 'Verdana' ) { echo "selected"; } ?>>Verdana</option>
						<option value="0"        <?php if($font_family == '0' ) { echo "selected"; } ?>>Theme Default Font Style</option>
					</optgroup>
				</select>
				<!-- Tooltip -->
				<div id="font_family_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Description Font Family/Style from here. Select any one form these options.</h2>
					
					</div>
		    	</div>
				<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/service-showcase-pro-plugin-wordpress/" target="_balnk">Get 500+ Google Fonts In Premium Version</a> </div>
			
				
			</td>
		</tr>
		<tr>
			<th><label><?php _e('Service Box Column Display layout ',wpshopmart_service_box_text_domain); ?> </label>
				<a  class="ac_tooltip" href="#help" data-tooltip="#sb_layout_tp"><i class="fa fa-lightbulb-o"></i></a>
			</th>
			<td>
				<select name="sb_layout" id="sb_layout" class="standard-dropdown" style="width:100%" >
						<option value="6"  <?php if($sb_layout == '6' ) { echo "selected"; } ?>>2 Column Layout</option>
						<option value="4"  <?php if($sb_layout == '4' ) { echo "selected"; } ?>>3 Column Layout</option>
						<option value="3"  <?php if($sb_layout == '3' ) { echo "selected"; } ?>>4 Column Layout</option>

				</select>
				<div id="sb_layout_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">Testimonial Column Display layout</h2>
					</div>
		    	</div>
				<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/service-showcase-pro-plugin-wordpress/" target="_balnk">Get More 6+ Column Layout In Premium Version</a> </div>
			
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><label><?php _e('Service Box Read More Link Label',wpshopmart_service_box_text_domain); ?></label>
				<a  class="ac_tooltip" href="#help" data-tooltip="#sb_web_link_label_tp"><i class="fa fa-lightbulb-o"></i></a>
			</th>
			<td>
				<input type="text" class="wpsm_ac_label_text" id="sb_web_link_label" name="sb_web_link_label"  value="<?php echo $sb_web_link_label; ?>">
				<div id="sb_web_link_label_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">Update Website Link Label Here</h2>
					</div>
		    	</div>
				<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/service-showcase-pro-plugin-wordpress/" target="_balnk">Enable Read More Link Edit Option For Each Box In pro version   </a> </div>
			
			</td>
		</tr>	
		
		
		<script>
		jQuery(function() {
		jQuery(".wpsm_off *").attr("disabled", "disabled").off('click');
		  
		  // Target a single one
		  jQuery("#custom_css").linedtextarea();

		});
		jQuery('.ac_tooltip').darkTooltip({
				opacity:1,
				gravity:'east',
				size:'small'
			});
		</script>
	</tbody>
</table>