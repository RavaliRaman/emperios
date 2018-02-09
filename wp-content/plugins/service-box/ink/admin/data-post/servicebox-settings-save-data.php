<?php  if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($PostID) && isset($_POST['wpsm_servicebox_setting_save_action'])) {
			
			
			$service_acc_sec_title 		     = sanitize_option('service_acc_sec_title', $_POST['service_acc_sec_title']);
			$service_display_icon      	     = sanitize_option('service_display_icon', $_POST['service_display_icon']);
			$service_display_readmore      	 = sanitize_option('service_display_readmore', $_POST['service_display_readmore']);
			$service_title_clr        		 = sanitize_text_field($_POST['service_title_clr']);
			$service_icon_clr                = sanitize_text_field($_POST['service_icon_clr']);
			$service_icon_bg_clr 			 = sanitize_text_field($_POST['service_icon_bg_clr']);
			$service_des_clr 				 = sanitize_text_field($_POST['service_des_clr']);
			$service_readmore_clr  	    	 = sanitize_text_field($_POST['service_readmore_clr']);
			$service_readmore_bg_clr  	    = sanitize_text_field($_POST['service_readmore_bg_clr']);
			$service_box_bg_clr_dsn2      	 = sanitize_text_field($_POST['service_box_bg_clr_dsn2']);
			$service_title_font_size         = sanitize_text_field($_POST['service_title_font_size']);
			$service_des_font_size           = sanitize_text_field($_POST['service_des_font_size']);
			$service_readmore_font_size      = sanitize_text_field($_POST['service_readmore_font_size']);
			$sb_web_link_label      		 = sanitize_text_field($_POST['sb_web_link_label']);
			$sb_layout      				 = sanitize_text_field($_POST['sb_layout']);
			$font_family            		 = sanitize_text_field($_POST['font_family']);
			$templates         = sanitize_option('templates', $_POST['templates']);
			$custom_css             		 = stripslashes($_POST['custom_css']);
			
				
			
			$Shortcode_Settings_Array = serialize( array(
				'service_acc_sec_title' 		    => $service_acc_sec_title,
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
				'sb_layout' 			            => $sb_layout,
				'sb_web_link_label' 			    => $sb_web_link_label,
				'templates' 			            => $templates,
				'custom_css' 			            => $custom_css,
				
				) );

			update_post_meta($PostID, 'Wpsm_Servicebox_Shortcode_Settings', $Shortcode_Settings_Array);
		}

?>