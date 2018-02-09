<?php 
	 if ( ! defined( 'ABSPATH' ) ) exit;
    $ac_post_type = "wpsm_Servicebox_r";
	
    $AllData = array(  'p' => $WPSM_SERVICE_ID, 'post_type' => $ac_post_type, 'orderby' => 'ASC');
    $loop = new WP_Query( $AllData );
	
	while ( $loop->have_posts() ) : $loop->the_post();
		//get the post id
		$post_id = get_the_ID();
		$Shortcode_Settings = unserialize(get_post_meta( $post_id, 'Wpsm_Servicebox_Shortcode_Settings', true));

		$option_names = array(
			"service_acc_sec_title" 	 => "yes",
				"service_display_icon" 		 => "yes",
				"service_display_readmore"     => "yes",
				"service_title_clr"         => "#000000",
				"service_icon_clr" => "#636363",
				"service_icon_bg_clr" => "#dddddd",
				"service_des_clr" => "#7f7f7f",
				"service_readmore_clr"    => "#4c4c4c",
				"service_readmore_bg_clr"  => "#ffffff",
				"service_box_bg_clr_dsn2"  => "#e5e5e5",
				"service_title_font_size"     		 => "22",
				"service_des_font_size"     	 => "19",
				"service_readmore_font_size"     	 => "16",
				"custom_css"      =>"",
				"font_family"      =>"Open Sans",
				"sb_web_link_label"      =>"Read More",
				"sb_layout"      =>"6",
				"templates"      =>"1",
			);
			
			foreach($option_names as $option_name => $default_value) {
				if(isset($Shortcode_Settings[$option_name])) 
					${"" . $option_name}  = $Shortcode_Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}
		
		
		$data = unserialize(get_post_meta( get_the_ID(), 'wpsm_servicebox_data', true));
		$TotalCount =  get_post_meta( get_the_ID(), 'wpsm_servicebox_count', true );
		
		
		?>
		<div class="wpsm_service_b_row" id="wpsm_service_b_row_<?php echo $post_id; ?>">
			<?php 
			if($TotalCount>0) 
			{
				
				require('designs/design-'.$templates.'/index.php');
				
			}
			else{
				echo "<h3> No ServiceBox Found </h3>";
			}
			
			?>
		</div>
		
	<?php	
	endwhile; ?>