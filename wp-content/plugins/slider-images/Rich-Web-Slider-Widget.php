<?php
	class Rich_Web_Photo_Slider extends WP_Widget
	{
		function __construct()
 	  	{
 			$params=array('name'=>'Rich-Web Slider','description'=>'This is the widget of Rich-Web Slider plugin');
			parent::__construct('Rich_Web_Photo_Slider','',$params);
 	  	}
		function form($instance)
 		{
 			$defaults = array('Rich_Web_Slider'=>'');
		    $instance = wp_parse_args((array)$instance, $defaults);

		   	$Rich_Web_Slider = $instance['Rich_Web_Slider'];
		   	?>
		   	<div>			  
			   	<p>
			   		Slider Title:
			   		<select name="<?php echo $this->get_field_name('Rich_Web_Slider'); ?>" class="widefat">
				   		<?php
				   			global $wpdb;

							$table_name  = $wpdb->prefix . "rich_web_photo_slider_manager";
							$Rich_Web_Slider=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d", 0));
				   			
				   			foreach ($Rich_Web_Slider as $Rich_Web_Slider1)
				   			{
				   				?> <option value="<?php echo $Rich_Web_Slider1->id; ?>"> <?php echo $Rich_Web_Slider1->Slider_Title; ?> </option> <?php 
				   			}
				   		?>
			   		</select>
			   	</p>
		   	</div>
		   	<?php	
 		}
 		function widget($args,$instance)
 		{
 			extract($args);
 		 	$Rich_Web_Slider = empty($instance['Rich_Web_Slider']) ? '' : $instance['Rich_Web_Slider'];

 		 	global $wpdb;

			$table_name   = $wpdb->prefix . "rich_web_photo_slider_manager";
			$table_name1  = $wpdb->prefix . "rich_web_photo_slider_instal";
			$table_name2  = $wpdb->prefix . "rich_web_slider_effects_data";
			$table_name5  = $wpdb->prefix . "rich_web_slider_effect1";
			$table_name6  = $wpdb->prefix . "rich_web_slider_effect2";
			$table_name7  = $wpdb->prefix . "rich_web_slider_effect3";
			$table_name8  = $wpdb->prefix . "rich_web_slider_effect4";
			$table_name9  = $wpdb->prefix . "rich_web_slider_effect5";
			$table_name10 = $wpdb->prefix . "rich_web_slider_effect6";
			$table_name11 = $wpdb->prefix . "rich_web_slider_effect7";
			$table_name12 = $wpdb->prefix . "rich_web_slider_effect8";
			$table_name13 = $wpdb->prefix . "rich_web_slider_effect9";
			$table_name14 = $wpdb->prefix . "rich_web_slider_effect10";
			$table_name5_Loader  = $wpdb->prefix . "rich_web_slider_effect1_loader";
			$table_name6_Loader  = $wpdb->prefix . "rich_web_slider_effect2_loader";
			$table_name7_Loader  = $wpdb->prefix . "rich_web_slider_effect3_loader";
			$table_name8_Loader  = $wpdb->prefix . "rich_web_slider_effect4_loader";
			$table_name9_Loader  = $wpdb->prefix . "rich_web_slider_effect5_loader";
			$table_name10_Loader  = $wpdb->prefix . "rich_web_slider_effect6_loader";
			$table_name11_Loader  = $wpdb->prefix . "rich_web_slider_effect7_loader";
			$table_name12_Loader  = $wpdb->prefix . "rich_web_slider_effect8_loader";
			$table_name13_Loader  = $wpdb->prefix . "rich_web_slider_effect9_loader";
			$table_name14_Loader  = $wpdb->prefix . "rich_web_slider_effect10_loader";

			$Rich_Web_Slider_Manager=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $Rich_Web_Slider));
			$Rich_Web_Slider_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE Sl_Number = %s order by id", $Rich_Web_Slider));
			$Rich_Web_Slider_Effects=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name = %s", $Rich_Web_Slider_Manager[0]->Slider_Type));

			if($Rich_Web_Slider_Effects[0]->slider_type=='Slider Navigation')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Content Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE richideo_EN_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Fashion Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Circle Thumbnails')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Slider Carousel')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Flexible Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Dynamic Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Thumbnails Slider & Lightbox')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Accordion Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));

			}
			else if($Rich_Web_Slider_Effects[0]->slider_type=='Animation Slider')
			{
				$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14 WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
				$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14_Loader WHERE rich_web_slider_ID = %s", $Rich_Web_Slider_Effects[0]->id));
			}
 		 	echo $before_widget;
			if($Rich_Web_Slider_Effect[0]->rich_CS_BIB=='true'){ $rich_CS_BIB = 'true'; }else{ $rich_CS_BIB = 'false'; }
			if($Rich_Web_Slider_Effect[0]->rich_CS_P=='true'){ $rich_CS_P = 'true';	}else{ $rich_CS_P = 'false'; }
			if($Rich_Web_Slider_Effect[0]->rich_CS_Loop=='true'){ $rich_CS_Loop = 'true'; }else{ $rich_CS_Loop = 'false'; }
			if($Rich_Web_Slider_Effect[0]->rich_CS_Video_TShow=='true'){ $rich_CS_Video_TShow = 'block'; }else{ $rich_CS_Video_TShow = 'none'; }
			if($Rich_Web_Slider_Effect[0]->rich_CS_Video_DShow=='true'){ $rich_CS_Video_DShow = 'block'; }else{	$rich_CS_Video_DShow = 'none'; }			
			if($Rich_Web_Slider_Effect[0]->rich_CS_Video_Show=='true'){	$rich_CS_Video_Show = $Rich_Web_Slider_Effect[0]->rich_CS_Video_W; }else{ $rich_CS_Video_Show = '0'; }
			if($rich_CS_Video_Show == '0'){	$padLeft = '0';	}else{ $padLeft = '10';	}
			if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 1){ $Rich_PS_Left_Icon='rich_web rich_web-angle-double-left'; $Rich_PS_Right_Icon='rich_web rich_web-angle-double-right'; }
			else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 2){ $Rich_PS_Left_Icon='rich_web rich_web-angle-left'; $Rich_PS_Right_Icon='rich_web rich_web-angle-right';	}
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 3){	$Rich_PS_Left_Icon='rich_web rich_web-arrow-circle-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-circle-right'; }
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 4){	$Rich_PS_Left_Icon='rich_web rich_web-arrow-circle-o-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-circle-o-right'; }
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 5){	$Rich_PS_Left_Icon='rich_web rich_web-arrow-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-right';	}
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 6){	$Rich_PS_Left_Icon='rich_web rich_web-caret-left'; $Rich_PS_Right_Icon='rich_web rich_web-caret-right';	}
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 7){	$Rich_PS_Left_Icon='rich_web rich_web-caret-square-o-left';	$Rich_PS_Right_Icon='rich_web rich_web-caret-square-o-right'; }
 		 	else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 8){	$Rich_PS_Left_Icon='rich_web-chevron-circle-left'; $Rich_PS_Right_Icon='rich_web-chevron-circle-right';	}
			else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 9){	$Rich_PS_Left_Icon='rich_web rich_web-chevron-left'; $Rich_PS_Right_Icon='rich_web rich_web-chevron-right';	}
			else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 10){ $Rich_PS_Left_Icon='rich_web rich_web-hand-o-left'; $Rich_PS_Right_Icon='rich_web rich_web-hand-o-right'; }
			else if($Rich_Web_Slider_Effect[0]->rich_CS_Icon == 11){ $Rich_PS_Left_Icon='rich_web rich_web-long-arrow-left'; $Rich_PS_Right_Icon='rich_web rich_web-long-arrow-right';}
			if($Rich_Web_Slider_Effect[0]->rich_CS_Video_ArrShow=='true'){ $rich_CS_Video_ArrShow = 'inline-block'; }else{ $rich_CS_Video_ArrShow = 'none'; }			
			//Fashion Slider 			
			if($Rich_Web_Slider_Effect[0]->rich_fsl_SShow=='false'){	$rich_fsl_SShow = false; }else{ $rich_fsl_SShow = true;	}
			if($Rich_Web_Slider_Effect[0]->rich_fsl_Ic_Show=='false'){ $rich_fsl_Ic_Show = false; }else{ $rich_fsl_Ic_Show = true; }
			if($Rich_Web_Slider_Effect[0]->rich_fsl_PPL_Show=='false'){ $rich_fsl_PPL_Show = false; }else{ $rich_fsl_PPL_Show = true; }
			if($Rich_Web_Slider_Effect[0]->rich_fsl_Randomize=='false'){	$rich_fsl_Randomize = false; }else{ $rich_fsl_Randomize = true; }
			if($Rich_Web_Slider_Effect[0]->rich_fsl_Loop=='false'){ $rich_fsl_Loop = false; }else{ $rich_fsl_Loop = true; }
			if($Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Show==''){	$rich_fsl_Desc_Show = 'false'; }else{ $rich_fsl_Desc_Show = 'true';	}
 		 	?>
 		 		<?php if($Rich_Web_Slider_Effects[0]->slider_type=='Slider Navigation'){ ?>
					<link rel="stylesheet" href="<?php echo plugins_url('/Style/flexslider.css',__FILE__);?>" />
					<link rel="stylesheet" href="<?php echo plugins_url('/Style/Rich-Web-Slider-Widget.css',__FILE__);?>" />
					<?php
						$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;
						$text_array=str_split($text);
						$str_sum=0;
						$anim_sum=0.75;
					?>
					<style type="text/css">
						.center_content<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							overflow:visible;
							top:50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							-ms-transform:translateY(-50%);
							-moz-transform:translateY(-50%);
							-o-transform:translateY(-50%);
						}

						#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
							margin:20px auto !important;
							background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_BgC; ?> !important;
							z-index:999;
							width:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
							height:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>px;
							max-width:100% !important;
						}


						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

						.RW_Loader_Frame_Navigation{
							position:relative;
							
							left:50%;
							width:80px;
							height:80px;
							transform:translateX(-50%);
							-webkit-transform:translateX(-50%);
							-ms-transform:translateX(-50%);
							-moz-transform:translateX(-50%);
							-o-transform:translateX(-50%);
						}
						
						.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							text-align:center;
							margin-top:10px;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							
						}
						.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
							position:absolute;
							border:5px solid transparent;
							border-radius:50%;
						}
						.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
						.loader_Navigation1{
							width:100%;
							height:100%;
							animation:clockLoading 1s linear 500;
							-webkit-animation:clockLoading 1s linear 500;
							-ms-animation:clockLoading 1s linear 500;
							-moz-animation:clockLoading 1s linear 500;
							-o-animation:clockLoading 1s linear 500;
						}
						.loader_Navigation2{
							width:80%;
							height:80%;
							animation:anticlockLoading 1s linear 500;
							-webkit-animation:anticlockLoading 1s linear 500;
							-ms-animation:anticlockLoading 1s linear 500;
							-moz-animation:anticlockLoading 1s linear 500;
							-o-animation:anticlockLoading 1s linear 500;
						}
						@keyframes clockLoading{
							from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
							to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
						}
						@keyframes anticlockLoading{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
						}
						@keyframes clockLoadingmin{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
						}


						/*Second Loader*/




						.overlay-loader<?php echo $Rich_Web_Slider; ?> {
							display: block;
							margin: auto;
							width: 97px;
							height: 60px;
							position: relative;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
						}

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

						.loader<?php echo $Rich_Web_Slider; ?> {
							position: absolute;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
							width: 97px;
							height: 97px;
							animation-name: rotateAnim;
								-o-animation-name: rotateAnim;
								-ms-animation-name: rotateAnim;
								-webkit-animation-name: rotateAnim;
								-moz-animation-name: rotateAnim;
							animation-duration: 0.4s;
								-o-animation-duration: 0.4s;
								-ms-animation-duration: 0.4s;
								-webkit-animation-duration: 0.4s;
								-moz-animation-duration: 0.4s;
							animation-iteration-count: infinite;
								-o-animation-iteration-count: infinite;
								-ms-animation-iteration-count: infinite;
								-webkit-animation-iteration-count: infinite;
								-moz-animation-iteration-count: infinite;
							animation-timing-function: linear;
								-o-animation-timing-function: linear;
								-ms-animation-timing-function: linear;
								-webkit-animation-timing-function: linear;
								-moz-animation-timing-function: linear;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div {
							width: 8px;
							height: 8px;
							border-radius: 50%;
							border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C; ?>; 
							position: absolute;
							top: 2px;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
							border-top: none;
							border-left: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
							border-bottom: none;
							border-right: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
							border-width: 2px;
							left: 0px;
							top: -4px;
							width: 12px;
							height: 12px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
							border-width: 2px;
							left: -1px;
							top: 3px;
							width: 18px;
							height: 18px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
							border-width: 3px;
							left: -1px;
							top: -4px;
							width: 23px;
							height: 23px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
							border-width: 3px;
							left: -1px;
							top: 4px;
							width: 31px;
							height: 31px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
							border-width: 4px;
							left: 0px;
							top: -4px;
							width: 39px;
							height: 39px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
							border-width: 4px;
							left: 0px;
							top: 6px;
							width: 49px;
							height: 49px;
						}


						@keyframes rotateAnim {
							from {
								transform: rotate(360deg);
							}
							to {
								transform: rotate(0deg);
							}
						}

						@-o-keyframes rotateAnim {
							from {
								-o-transform: rotate(360deg);
							}
							to {
								-o-transform: rotate(0deg);
							}
						}

						@-ms-keyframes rotateAnim {
							from {
								-ms-transform: rotate(360deg);
							}
							to {
								-ms-transform: rotate(0deg);
							}
						}

						@-webkit-keyframes rotateAnim {
							from {
								-webkit-transform: rotate(360deg);
							}
							to {
								-webkit-transform: rotate(0deg);
							}
						}

						@-moz-keyframes rotateAnim {
							from {
								-moz-transform: rotate(360deg);
							}
							to {
								-moz-transform: rotate(0deg);
							}
						}


						/*Third Loader*/



						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

						.windows8<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							width: 78px;
							height:78px;
							margin:auto;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
							position: absolute;
							width: 74px;
							height: 74px;
							opacity: 0;
							transform: rotate(225deg);
								-o-transform: rotate(225deg);
								-ms-transform: rotate(225deg);
								-webkit-transform: rotate(225deg);
								-moz-transform: rotate(225deg);
							animation: orbit 6.96s infinite;
								-o-animation: orbit 6.96s infinite;
								-ms-animation: orbit 6.96s infinite;
								-webkit-animation: orbit 6.96s infinite;
								-moz-animation: orbit 6.96s infinite;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
							position: absolute;
							width: 10px;
							height: 10px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C; ?>; 
							left:0px;
							top:0px;
							border-radius: 10px;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
							animation-delay: 1.52s;
								-o-animation-delay: 1.52s;
								-ms-animation-delay: 1.52s;
								-webkit-animation-delay: 1.52s;
								-moz-animation-delay: 1.52s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
							animation-delay: 0.3s;
								-o-animation-delay: 0.3s;
								-ms-animation-delay: 0.3s;
								-webkit-animation-delay: 0.3s;
								-moz-animation-delay: 0.3s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
							animation-delay: 0.61s;
								-o-animation-delay: 0.61s;
								-ms-animation-delay: 0.61s;
								-webkit-animation-delay: 0.61s;
								-moz-animation-delay: 0.61s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
							animation-delay: 0.91s;
								-o-animation-delay: 0.91s;
								-ms-animation-delay: 0.91s;
								-webkit-animation-delay: 0.91s;
								-moz-animation-delay: 0.91s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
							animation-delay: 1.22s;
								-o-animation-delay: 1.22s;
								-ms-animation-delay: 1.22s;
								-webkit-animation-delay: 1.22s;
								-moz-animation-delay: 1.22s;
						}



						@keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								transform: rotate(180deg);
								animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								transform: rotate(300deg);
								animation-timing-function: linear;
								origin:0%;
							}

							30% {
								opacity: 1;
								transform:rotate(410deg);
								animation-timing-function: ease-in-out;
								origin:7%;
							}

							39% {
								opacity: 1;
								transform: rotate(645deg);
								animation-timing-function: linear;
								origin:30%;
							}

							70% {
								opacity: 1;
								transform: rotate(770deg);
								animation-timing-function: ease-out;
								origin:39%;
							}

							75% {
								opacity: 1;
								transform: rotate(900deg);
								animation-timing-function: ease-out;
								origin:70%;
							}

							76% {
							opacity: 0;
								transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								transform: rotate(900deg);
							}
						}

						@-o-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-o-transform: rotate(180deg);
								-o-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-o-transform: rotate(300deg);
								-o-animation-timing-function: linear;
								-o-origin:0%;
							}

							30% {
								opacity: 1;
								-o-transform:rotate(410deg);
								-o-animation-timing-function: ease-in-out;
								-o-origin:7%;
							}

							39% {
								opacity: 1;
								-o-transform: rotate(645deg);
								-o-animation-timing-function: linear;
								-o-origin:30%;
							}

							70% {
								opacity: 1;
								-o-transform: rotate(770deg);
								-o-animation-timing-function: ease-out;
								-o-origin:39%;
							}

							75% {
								opacity: 1;
								-o-transform: rotate(900deg);
								-o-animation-timing-function: ease-out;
								-o-origin:70%;
							}

							76% {
							opacity: 0;
								-o-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-o-transform: rotate(900deg);
							}
						}

						@-ms-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-ms-transform: rotate(180deg);
								-ms-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-ms-transform: rotate(300deg);
								-ms-animation-timing-function: linear;
								-ms-origin:0%;
							}

							30% {
								opacity: 1;
								-ms-transform:rotate(410deg);
								-ms-animation-timing-function: ease-in-out;
								-ms-origin:7%;
							}

							39% {
								opacity: 1;
								-ms-transform: rotate(645deg);
								-ms-animation-timing-function: linear;
								-ms-origin:30%;
							}

							70% {
								opacity: 1;
								-ms-transform: rotate(770deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:39%;
							}

							75% {
								opacity: 1;
								-ms-transform: rotate(900deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:70%;
							}

							76% {
							opacity: 0;
								-ms-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-ms-transform: rotate(900deg);
							}
						}

						@-webkit-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-webkit-transform: rotate(180deg);
								-webkit-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-webkit-transform: rotate(300deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:0%;
							}

							30% {
								opacity: 1;
								-webkit-transform:rotate(410deg);
								-webkit-animation-timing-function: ease-in-out;
								-webkit-origin:7%;
							}

							39% {
								opacity: 1;
								-webkit-transform: rotate(645deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:30%;
							}

							70% {
								opacity: 1;
								-webkit-transform: rotate(770deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:39%;
							}

							75% {
								opacity: 1;
								-webkit-transform: rotate(900deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:70%;
							}

							76% {
							opacity: 0;
								-webkit-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-webkit-transform: rotate(900deg);
							}
						}

						@-moz-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-moz-transform: rotate(180deg);
								-moz-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-moz-transform: rotate(300deg);
								-moz-animation-timing-function: linear;
								-moz-origin:0%;
							}

							30% {
								opacity: 1;
								-moz-transform:rotate(410deg);
								-moz-animation-timing-function: ease-in-out;
								-moz-origin:7%;
							}

							39% {
								opacity: 1;
								-moz-transform: rotate(645deg);
								-moz-animation-timing-function: linear;
								-moz-origin:30%;
							}

							70% {
								opacity: 1;
								-moz-transform: rotate(770deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:39%;
							}

							75% {
								opacity: 1;
								-moz-transform: rotate(900deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:70%;
							}

							76% {
							opacity: 0;
								-moz-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-moz-transform: rotate(900deg);
							}
						}

						/*Fourth loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

						.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
							width: 50px;
							height: 50px;
							margin: 20px auto;
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							float: left;
							width: 50%;
							height: 50%;
							position: relative;
							transform: scale(1.1);
								-o-transform: scale(1.1);
								-ms-transform: scale(1.1);
								-webkit-transform: scale(1.1);
								-moz-transform: scale(1.1);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
							content: "";
							position: absolute;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C; ?>; 
							animation: cssload-fold-thecube 2.76s infinite linear both;
								-o-animation: cssload-fold-thecube 2.76s infinite linear both;
								-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
								-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
								-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
							transform-origin: 100% 100%;
								-o-transform-origin: 100% 100%;
								-ms-transform-origin: 100% 100%;
								-webkit-transform-origin: 100% 100%;
								-moz-transform-origin: 100% 100%;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
							transform: scale(1.1) rotateZ(90deg);
								-o-transform: scale(1.1) rotateZ(90deg);
								-ms-transform: scale(1.1) rotateZ(90deg);
								-webkit-transform: scale(1.1) rotateZ(90deg);
								-moz-transform: scale(1.1) rotateZ(90deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
							transform: scale(1.1) rotateZ(180deg);
								-o-transform: scale(1.1) rotateZ(180deg);
								-ms-transform: scale(1.1) rotateZ(180deg);
								-webkit-transform: scale(1.1) rotateZ(180deg);
								-moz-transform: scale(1.1) rotateZ(180deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
							transform: scale(1.1) rotateZ(270deg);
								-o-transform: scale(1.1) rotateZ(270deg);
								-ms-transform: scale(1.1) rotateZ(270deg);
								-webkit-transform: scale(1.1) rotateZ(270deg);
								-moz-transform: scale(1.1) rotateZ(270deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
							animation-delay: 0.35s;
								-o-animation-delay: 0.35s;
								-ms-animation-delay: 0.35s;
								-webkit-animation-delay: 0.35s;
								-moz-animation-delay: 0.35s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
							animation-delay: 0.69s;
								-o-animation-delay: 0.69s;
								-ms-animation-delay: 0.69s;
								-webkit-animation-delay: 0.69s;
								-moz-animation-delay: 0.69s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
							animation-delay: 1.04s;
								-o-animation-delay: 1.04s;
								-ms-animation-delay: 1.04s;
								-webkit-animation-delay: 1.04s;
								-moz-animation-delay: 1.04s;
						}



						@keyframes cssload-fold-thecube {
							0%, 10% {
								transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-o-keyframes cssload-fold-thecube {
							0%, 10% {
								-o-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-o-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-o-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-ms-keyframes cssload-fold-thecube {
							0%, 10% {
								-ms-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-ms-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-ms-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-webkit-keyframes cssload-fold-thecube {
							0%, 10% {
								-webkit-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-webkit-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-webkit-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-moz-keyframes cssload-fold-thecube {
							0%, 10% {
								-moz-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-moz-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-moz-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						/*First Text*/

						.cssload-loader<?php echo $Rich_Web_Slider; ?> {
							width: 244px;
							height: 49px;
							line-height: 49px;
							text-align: center;
							position: relative;
							left: 50%;
							transform: translate(-50%, 0%);
								-o-transform: translate(-50%, 0%);
								-ms-transform: translate(-50%, 0%);
								-webkit-transform: translate(-50%, 0%);
								-moz-transform: translate(-50%, 0%);
							font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF; ?> !important;
							text-transform: none !important;
							font-weight: 900;
							font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS; ?>px !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							letter-spacing: 0.2em;
							margin-top:10px;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							content: "";
							display: block;
							width: 15px;
							height: 15px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_BC; ?> !important;
							position: absolute;
							animation: cssload-load 0.81s infinite alternate ease-in-out;
								-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
							top: 0;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							bottom: 0;
						}



						@keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-o-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-ms-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-webkit-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-moz-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}


						/*Second*/

						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							width:100%;
							margin:auto;
							text-align:center;
						}

						.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							text-decoration:none;
							font-weight:normal;
							font-style:normal;
							display:inline-block;
							animation-name:bounce_inTurnFadingTextG;
								-o-animation-name:bounce_inTurnFadingTextG;
								-ms-animation-name:bounce_inTurnFadingTextG;
								-webkit-animation-name:bounce_inTurnFadingTextG;
								-moz-animation-name:bounce_inTurnFadingTextG;
							animation-duration:2.09s;
								-o-animation-duration:2.09s;
								-ms-animation-duration:2.09s;
								-webkit-animation-duration:2.09s;
								-moz-animation-duration:2.09s;
							animation-iteration-count:infinite;
								-o-animation-iteration-count:infinite;
								-ms-animation-iteration-count:infinite;
								-webkit-animation-iteration-count:infinite;
								-moz-animation-iteration-count:infinite;
							animation-direction:normal;
								-o-animation-direction:normal;
								-ms-animation-direction:normal;
								-webkit-animation-direction:normal;
								-moz-animation-direction:normal;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
							animation-delay:<?php Print $anim_sum; ?>s !important;
								-o-animation-delay:<?php Print $anim_sum; ?>s !important;
								-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
								-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
								-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
						}
						<?php $anim_sum=$anim_sum+0.15; ?>
						<?php } ?>

						@keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							}
						}

						@-o-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							}
						}

						@-ms-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							}
						}

						@-webkit-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							}
						}

						@-moz-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
							}
						}

						/*Third text*/

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							top: 0px;
							left: 0px;
							right: 0px;
							bottom: 0px;
							z-index: 10;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
							position: relative;
							display:inline-block;
							margin-left:10px;
							margin-top:20px;
							height: 29px;
							left:50%;
							transform:translateX(-50%) !important;
							-webkit-transform:translateX(-50%) !important;
							-ms-transform:translateX(-50%) !important;
							-moz-transform:translateX(-50%) !important;
							-o-transform:translateX(-50%) !important;
							perspective: 195px;
								-o-perspective: 195px;
								-ms-perspective: 195px;
								-webkit-perspective: 195px;
								-moz-perspective: 195px;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
							position: relative;
							width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS*2; ?>px;
							height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS*2; ?>px;
							background: rgb(204,204,204);
							float: left;
							text-align: center;
							line-height: 2;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C; ?> !important;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS; ?>px !important;
							animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						}
						<?php $str_sum=$str_sum+86.25; ?>
						<?php } ?>


						@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							}
						}

						@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							}
						}

						@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							}
						}

						@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							}
						}

						@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC; ?> !important;
							}
						}

						.flexslider_1 .flex-direction-nav .flex-next .preview img,.flexslider_1 .flex-direction-nav .flex-prev .preview img{
							box-shadow:none !important;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?>{
							margin:20px auto !important;
							width:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
							height:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>px;
							max-width:100% !important;
						}
						<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='slide out'){ ?>
							/* general style */

							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview {
								width: 360px;
								height:100% !important;
								position: absolute;
								top:0;
								left:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								z-index:100;
								-webkit-transition:  all 0.3s ease-out !important; 
								-moz-transition:  all 0.3s ease-out !important; 
								transition:  all 0.3s ease-out !important; 	
								opacity:0;
							}							
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt {
								position: absolute;								
								top:0;
								background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?> !important;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px;
								height:100% !important;
								color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
								text-indent:0;
								<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
									text-transform: uppercase !important;
								<?php }else{?>
									text-transform: none !important;
								<?php }?>
								text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
								padding: 0px 5px;
								
								font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
								
								-webkit-box-sizing: border-box;
								-moz-box-sizing: border-box;
								-o-box-sizing: border-box;
							}
							/* next button */			
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview {
								right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								left:auto;	
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt {
								left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt {
								right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px;
							}
							/* hover style */		
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev:hover .preview {
								left:0;
								opacity:1;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next:hover .preview {
								right:0;
								opacity:1;
							}	
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img {
								position: absolute;
								left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								top:0;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								height:100% !important;
								-webkit-transition:  all 0s ease-out !important; 
								-moz-transition:  all 0s ease-out !important; 
								transition:  all 0s ease-out !important;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img {
								position: absolute;
								right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								top:0;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								height:100% !important;
								box-shadow:none !important;
								-webkit-transition:  all 0s ease-out !important; 
								-moz-transition:  all 0s ease-out !important; 
								transition:  all 0s ease-out !important;
							}
						<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='flip out'){ ?>
							/* general style */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview {
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								height:100% !important;
								position: absolute;
								top:0;
								
								z-index:100;
								-webkit-transition:  -webkit-transform 0.3s ease-out; 
								-moz-transition:  transform 0.3s ease-out; 
								transition:  transform 0.3s ease-out; 	
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img {
								position: absolute;
								left:0;
								top:0;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								
								height:100% !important;
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img {
								position: absolute;
								right:0;
								top:0;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;	
								height:100% !important;
								-webkit-transition:  -webkit-transform 300ms ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt {
								display:none;
							}
							/* prev button */				
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev {
								-webkit-perspective-origin: 100% 50%;
								perspective-origin: 100% 50%;
								-webkit-perspective: 1000px;
								perspective: 1000px;			
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview {
								-webkit-transform: rotateY(90deg);
								transform: rotateY(90deg);
								-webkit-transform-origin: 0% 50%;
								transform-origin: 0% 50%;
							}
							/* next button */				
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next {
								-webkit-perspective-origin: 0% 50%;
								perspective-origin: 0% 50%;			
								-webkit-perspective: 1000px;
								perspective: 1000px;				
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview {
								
								left:auto;	
								-webkit-transform: rotateY(-90deg);
								transform: rotateY(-90deg);
								-webkit-transform-origin: 100% 100%;
								transform-origin: 100% 100%;
							}
							/* hover style */				
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview {
								opacity:1;
								-webkit-transform: rotateY(0deg);
								transform: rotateY(0deg);			
							}
							/* different hover style for flexslider nav */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a {
								-webkit-transition:  none !important; 
								-moz-transition: none !important; 
								transition:  none !important;		
							}	
						<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='double flip out'){ ?>
							/* general style */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview {
								width: 270px;
								height:100% !important;
								position: absolute;
								top:0;
								z-index:100;
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
								-webkit-backface-visibility: hidden !important;
								backface-visibility: hidden;	
								-webkit-perspective-origin: 100% 50%;
								perspective-origin: 100% 50%;
								-webkit-perspective: 1000px;
								perspective: 1000px;										
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview img {
								position: absolute;
								top:0;
								height: 100%;	
								z-index:10;		
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt {
								background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?>;
								height:100% !important;
								color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
								text-indent:0;
								<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
									text-transform: uppercase !important;
								<?php }else{?>
									text-transform: none !important;
								<?php }?>
								text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
								padding: 0px 5px;
								font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
								position: absolute;
								top:0;
								-webkit-box-sizing: border-box;
								-moz-box-sizing: border-box;
								-o-box-sizing: border-box;
									
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
															
								-webkit-backface-visibility: hidden;
								backface-visibility: hidden;	
								z-index:5;			
							}
							/* previous button */		
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev {
								-webkit-perspective-origin: 100% 50%;
								perspective-origin: 100% 50%;
								-webkit-perspective: 1000px;
								perspective: 1000px;					
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview,
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt {
								-webkit-transform: rotateY(90deg);
								transform: rotateY(90deg);
								-webkit-transform-origin: 0% 50%;
								transform-origin: 0% 50%;
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
							}
							/* next button */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next {
								-webkit-perspective-origin: 0% 50%;
								perspective-origin: 0% 50%;			
								-webkit-perspective: 1000px;
								perspective: 1000px;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview,
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt {
								
								left:auto;	
								-webkit-transform: rotateY(-90deg);
								transform: rotateY(-90deg);
								-webkit-transform-origin: 100% 50%;
								transform-origin: 100% 50%;	
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
							}	
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img {
								left: 0;
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img {
								position: absolute;
								right:0;
								top:0;
								width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								-webkit-transition:  -webkit-transform 0.3s ease-out !important; 
								-moz-transition:  transform 0.3s ease-out !important; 
								transition:  transform 0.3s ease-out !important; 	
							}
							/* hover style */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview,
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview .alt {
								opacity:1;
								-webkit-transform: rotateY(0deg);
								transform: rotateY(0deg);						
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview .alt {		
								
								-webkit-transition-delay: 0.3s !important;
								transition-delay: 0.3s !important;			
							}
							/* different hover style for flexslider nav */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a {
								-webkit-transition:  none !important; 
								-moz-transition: none !important; 
								transition:  none !important;		
							}	
						<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='both ways'){ ?>
							/* general style */
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview {
								
								height:100% !i;
								position: absolute;
								top:0;
								
								z-index:90;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview img {
								position: absolute;
								top:0px;
								
								height: 100%;
								-webkit-transition:  all 0.3s ease-out !important; 
								-moz-transition:  all 0.3s ease-out !important; 
								transition:  all 0.3s ease-out !important; 	
								opacity:0;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt {
								background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?>;
								
								height:100% !important;
								color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
								text-indent:0;
								<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
									text-transform: uppercase !important;
								<?php }else{?>
									text-transform: none !important;
								<?php }?>
								text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
								padding: 0px 5px;
								
								font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
								
								position: absolute;
								top:0;
								-webkit-box-sizing: border-box;
								-moz-box-sizing: border-box;
								-o-box-sizing: border-box;
								-webkit-transition:  all 0.3s ease-out !important; 
								-moz-transition:  all 0.3s ease-out !important; 
								transition:  all 0.3s ease-out !important; 	
								opacity:0;						
							}
							/* next button */		
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview {
								right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
								left:auto;	
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img {
								position: absolute;
								right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt {
								left:auto;
								right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt {
								
								
								left:auto;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img {
								left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
							}
							/* hover style */		
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev:hover .preview .alt {
								transform:translateX(50%);
								opacity:1;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next:hover .preview .alt {
								transform:translateX(-100%);
								opacity:1;
							}
							.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview img {		
								transform:translateY(-100%);
								opacity:1;				
							}
						<?php }?>	
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav {
							height:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
							top:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArPFT;?>%;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a, .flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .arrow { 
							
							height:100% !important;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a{
							background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBgC;?> ;
							opacity: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArOp/100;?> ;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-prev:hover .arrow, .flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-next:hover .arrow {
							background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHBgC;?> !important;
							opacity: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHOp/100;?>;
						}	
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav {
							<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos;?>: 0%;
							padding:0px !important;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav li{
							margin: 0 <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPB;?>px; 
							margin-top:<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos==top){echo 14;}else{echo 4;}?>px;		
						}						
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a {
							width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavW;?>px; 
							height: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavH;?>px; 
							-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px; 
							-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px;
							-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px; 
							border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px; 
							border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBS;?> <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBC;?>;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a:hover { background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavHC;?>;}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a.flex-active { background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavCC;?>;}
						.flexslider_<?php echo $Rich_Web_Slider;?>
						{
							width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
							margin: 0 auto !important;
							<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS=='true'){ ?>
								box-shadow: 0px 0px 30px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> !important;
								-webkit-box-shadow:  0px 0px 30px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> !important;
								-moz-box-shadow:  0px 0px 30px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> !important;
								-o-box-shadow:  0px 0px 30px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> !important;
							<?php }?>
							-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .slides, .flexslider_<?php echo $Rich_Web_Slider;?> .slides li img, .flexslider_<?php echo $Rich_Web_Slider;?> .slides li, .flexslider_<?php echo $Rich_Web_Slider;?> .slides
						{ 
							width:100% !important;
							height:100% !important;
							padding:0px !important;
							margin-left:0px !important;
						}					
						.flexslider_<?php echo $Rich_Web_Slider;?> .slides li img 
						{  
							-webkit-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
							-moz-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
							-o-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
							border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
							-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
							border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a.flex-next .arrow {
							background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png',__FILE__)?>") no-repeat center center;
							background-size:70% 70%;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-next:hover .arrow 
						{ 
							right:0; 
							background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png',__FILE__)?>") no-repeat center center;
							background-size:70% 70%;
						}						
						.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a.flex-prev .arrow {
							background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png',__FILE__)?>") no-repeat center center;
							background-size:70% 70%;
						}
						.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-prev:hover .arrow 
						{ 
							right:0; 
							background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png',__FILE__)?>") no-repeat center center;
							background-size:70% 70%;
							
						}						
					</style>
						<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
							<div class="center_content<?php echo $Rich_Web_Slider; ?>">
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_Show == "true") { ?>
									<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 1") { ?>
									<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
										<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
										<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
										<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
										<div class="loader_Navigation4" id="loader_Navigation4"></div>
									</div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 2") { ?>
									<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
										<div class="loader<?php echo $Rich_Web_Slider; ?>">
											<div></div>
											<div></div>
											<div></div>
											<div></div>
											<div></div>
											<div></div>
											<div></div>
										</div>
									</div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 3") { ?>
									<div class="windows8<?php echo $Rich_Web_Slider; ?>">
										<div class="wBall" id="wBall_1">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_2">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_3">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_4">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_5">
											<div class="wInnerBall"></div>
										</div>
									</div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 4") { ?>
									<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
										<div class="cssload-cube cssload-c1"></div>
										<div class="cssload-cube cssload-c2"></div>
										<div class="cssload-cube cssload-c4"></div>
										<div class="cssload-cube cssload-c3"></div>
									</div>
									<?php } ?>
								<?php } ?>
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_Show == "true") { ?>
									<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 1") { ?>
									<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;?></div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 2") { ?>
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
										<?php foreach($text_array as $key=>$v){ ?>	
											<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
										<?php } ?>
									</div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 3") { ?>
									<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
										<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">	
											<?php foreach($text_array as $key=>$v){ ?>	
												<div><?php Print $v; ?></div>
											<?php } ?>
										</div>
									</div>
									<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 4") { ?>
									<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
										<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;?>
									</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>					
						<div id="rich_webSlider1_<?php echo $Rich_Web_Slider;?>" style="display:none;">
							<div class="flexslider flexslider_<?php echo $Rich_Web_Slider;?>" style='position:relative;max-width:100%;'>
								<ul class="slides">
									<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?> 
										<li>
											<img class='IMHR<?php echo $Rich_Web_Slider;?>' src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>" data-thumbnail="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>"/>	
										</li>	
									<?php } ?>					    
								</ul>
							</div>		
						</div>	
						<input type='text' style='display:none;' class='SLWIDTHR_<?php echo $Rich_Web_Slider;?>'   value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>'>
						<input type='text' style='display:none;' class='SLHEIGHTR_<?php echo $Rich_Web_Slider;?>'  value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>'>
						<input type='text' style='display:none;' class='SLCLWR_<?php echo $Rich_Web_Slider;?>'     value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>'>
						<input type='text' style='display:none;' class='SlClPrFS_<?php echo $Rich_Web_Slider;?>'   value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFS;?>'>
						<input type='text' style='display:none;' class='hovEffType_<?php echo $Rich_Web_Slider;?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff; ?>'>
						<input type='text' style='display:none;' class='navWidth_<?php echo $Rich_Web_Slider;?>'   value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavW; ?>'>
						<input type='text' style='display:none;' class='navHeight_<?php echo $Rich_Web_Slider;?>'  value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavH; ?>'>
						<input type='text' style='display:none;' class='navType'    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos;?>'>
					<script src="<?php echo plugins_url('/Scripts/jquery.flexslider-min.js',__FILE__);?>"></script>
					<script>
					var SLWIDTHR = jQuery('.SLWIDTHR_<?php echo $Rich_Web_Slider;?>').val();
					var SLHEIGHTR = jQuery('.SLHEIGHTR_<?php echo $Rich_Web_Slider;?>').val();

					jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>').css('max-height',jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>').width()*SLHEIGHTR/SLWIDTHR);
					jQuery(window).resize(function(){
						jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>').css('max-height',jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>').width()*SLHEIGHTR/SLWIDTHR);
					})

					var array_nav<?php echo $Rich_Web_Slider; ?>=[];
					jQuery(".IMHR<?php echo $Rich_Web_Slider;?>").each(function(){
						array_nav<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
					})
					console.log(array_nav<?php echo $Rich_Web_Slider; ?>);
					var y_nav<?php echo $Rich_Web_Slider; ?>=0;
					for(i=0;i<array_nav<?php echo $Rich_Web_Slider; ?>.length;i++){
						jQuery("<img class='IMHR<?php echo $Rich_Web_Slider;?>' />").attr('src', array_nav<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
		   			 		y_nav<?php echo $Rich_Web_Slider; ?>++;
		   			 		if(y_nav<?php echo $Rich_Web_Slider; ?> == array_nav<?php echo $Rich_Web_Slider; ?>.length){
		   			 			jQuery("#rich_webSlider1_<?php echo $Rich_Web_Slider;?>").css("display","block");
		   			 			jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>").remove();
		   			 			jQuery('#rich_webSlider1_<?php echo $Rich_Web_Slider;?> .flexslider').flexslider({
									slideshow: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_SlS;?>,
									slideshowSpeed: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_SlSS*1000;?>,
									pauseOnHover: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_PoH;?>,
									start: renderPreview,	//render preview on start
									before: renderPreview //render preview before moving to the next slide
								});
								function renderPreview(slider) {
									var sl = jQuery(slider);
									var prevWrapper = sl.find('.flex-prev');
									var nextWrapper = sl.find('.flex-next');		 
									 
									//calculate the prev and curr slide based on current slide
									var curr = slider.animatingTo;
									var prev = (curr == 0) ? slider.count - 1 : curr - 1;
									var next = (curr == slider.count - 1) ? 0 : curr + 1;		 

									//add prev and next slide details into the directional nav
									prevWrapper.find('.preview, .arrow').remove();
									nextWrapper.find('.preview, .arrow').remove();		 
									prevWrapper.append(grabContent(sl.find('li:eq(' + prev + ') img')));
									nextWrapper.append(grabContent(sl.find('li:eq(' + next + ') img')));	
									resp();
								}
								// grab the data and render in HTML
								function grabContent(img) {		
									var tn = img.data('thumbnail');
									var alt = img.prop('alt');		
									var html = '';
									//you can edit this markup to your own needs, but make sure you style it up accordingly
									html = '<div class="arrow"></div><div class="preview"><img src="' + tn + '" alt="" /><div class="alt">' + alt + '</div></div>';	
									return html;
									resp();
								}					
								var count=0;
								resp();						
								function resp(){
									var SLWIDTHR = jQuery('.SLWIDTHR_<?php echo $Rich_Web_Slider;?>').val();
									var SLHEIGHTR = jQuery('.SLHEIGHTR_<?php echo $Rich_Web_Slider;?>').val();
									var SLCLWR = jQuery('.SLCLWR_<?php echo $Rich_Web_Slider;?>').val();
									var SlClPrFS = jQuery('.SlClPrFS_<?php echo $Rich_Web_Slider;?>').val();
									var hovEffType = jQuery('.hovEffType_<?php echo $Rich_Web_Slider;?>').val();
									var navWidth = 	jQuery('.navWidth_<?php echo $Rich_Web_Slider;?>').val();
									var navHeight = jQuery('.navHeight_<?php echo $Rich_Web_Slider;?>').val();	
									var navType = jQuery('.navType_<?php echo $Rich_Web_Slider;?>').val();	
									
									
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>,#RW_Load_Content<?php echo $Rich_Web_Slider; ?>').css('height',jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()*SLHEIGHTR/SLWIDTHR);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next').css('height',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev').css('height',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav').css('height',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .arrow').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img').css('width',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a').css('width',navWidth*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a').css('height',navHeight*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									if(navType == 'bottom'){
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav li').css('margin-top',35/jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a').width());
									}else if(navType == 'top'){
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav li').css('margin-top','14px');
									}								
									if(hovEffType == 'slide out'){
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img').css('right',parseInt(SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700)+'px');
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img').css('left',parseInt(SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700)+'px');
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('right',parseInt(2*SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700)-1+'px');
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('left',parseInt(2*SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700)-2+'px');
									}else if(hovEffType == 'flip out' || hovEffType == 'double flip out'){
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview').css('right',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview').css('left',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('right',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('left',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700);
									}else if(hovEffType == 'both ways'){
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('left','-50px');
										jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('left','50px');
									}
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('width',2*SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('width',2*SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('font-size',SlClPrFS*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('font-size',SlClPrFS*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt').css('line-height',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt').css('line-height',SLCLWR*jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()/700+'px');
									if(jQuery('.flexslider_<?php echo $Rich_Web_Slider;?>').width()<=400){
										jQuery('.flex-control-nav').css('display','none');
									}else{
										jQuery('.flex-control-nav').css('display','block');
									}
								}
								jQuery(window).resize(function(){
									resp();
								})							
		   			 		}
						})
					}					
					</script>		
 		 		<?php } else if($Rich_Web_Slider_Effects[0]->slider_type=='Content Slider'){ ?>
 		 			<?php
						$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT;
						$text_array=str_split($text);
						$str_sum=0;
						$anim_sum=0.75;
					?>
	 		 		<style>
	 		 			.center_content<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							overflow:visible;
							top:50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							-ms-transform:translateY(-50%);
							-moz-transform:translateY(-50%);
							-o-transform:translateY(-50%);
						}

						#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
							margin:0px auto !important;
							padding:50px 0px !important;
							background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_BgC; ?> !important;
							z-index:999;
							width:0px;
							height:0px;
							box-sizing: inherit !important;
							overflow:hidden !important;
							max-width:100% !important;
						}

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>
						.RW_Loader_Frame_Navigation{
							position:relative;
							
							left:50%;
							width:80px;
							height:80px;
							transform:translateX(-50%);
							-webkit-transform:translateX(-50%);
							-ms-transform:translateX(-50%);
							-moz-transform:translateX(-50%);
							-o-transform:translateX(-50%);
						}
						.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							text-align:center;
							margin-top:10px;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							
						}
						.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
							position:absolute;
							border:5px solid transparent;
							border-radius:50%;
						}
						.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
						.loader_Navigation1{
							width:100%;
							height:100%;
							animation:clockLoading 1s linear 500;
							-webkit-animation:clockLoading 1s linear 500;
							-ms-animation:clockLoading 1s linear 500;
							-moz-animation:clockLoading 1s linear 500;
							-o-animation:clockLoading 1s linear 500;
						}
						.loader_Navigation2{
							width:80%;
							height:80%;
							animation:anticlockLoading 1s linear 500;
							-webkit-animation:anticlockLoading 1s linear 500;
							-ms-animation:anticlockLoading 1s linear 500;
							-moz-animation:anticlockLoading 1s linear 500;
							-o-animation:anticlockLoading 1s linear 500;
						}
						@keyframes clockLoading{
							from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
							to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
						}
						@keyframes anticlockLoading{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
						}
						@keyframes clockLoadingmin{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
						}


						/*Second Loader*/


						.overlay-loader<?php echo $Rich_Web_Slider; ?> {
							display: block;
							margin: auto;
							width: 97px;
							height: 60px;
							position: relative;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
						}

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

						.loader<?php echo $Rich_Web_Slider; ?> {
							position: absolute;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
							width: 97px;
							height: 97px;
							animation-name: rotateAnim;
								-o-animation-name: rotateAnim;
								-ms-animation-name: rotateAnim;
								-webkit-animation-name: rotateAnim;
								-moz-animation-name: rotateAnim;
							animation-duration: 0.4s;
								-o-animation-duration: 0.4s;
								-ms-animation-duration: 0.4s;
								-webkit-animation-duration: 0.4s;
								-moz-animation-duration: 0.4s;
							animation-iteration-count: infinite;
								-o-animation-iteration-count: infinite;
								-ms-animation-iteration-count: infinite;
								-webkit-animation-iteration-count: infinite;
								-moz-animation-iteration-count: infinite;
							animation-timing-function: linear;
								-o-animation-timing-function: linear;
								-ms-animation-timing-function: linear;
								-webkit-animation-timing-function: linear;
								-moz-animation-timing-function: linear;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div {
							width: 8px;
							height: 8px;
							border-radius: 50%;
							border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_C; ?>; 
							position: absolute;
							top: 2px;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
							border-top: none;
							border-left: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
							border-bottom: none;
							border-right: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
							border-width: 2px;
							left: 0px;
							top: -4px;
							width: 12px;
							height: 12px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
							border-width: 2px;
							left: -1px;
							top: 3px;
							width: 18px;
							height: 18px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
							border-width: 3px;
							left: -1px;
							top: -4px;
							width: 23px;
							height: 23px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
							border-width: 3px;
							left: -1px;
							top: 4px;
							width: 31px;
							height: 31px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
							border-width: 4px;
							left: 0px;
							top: -4px;
							width: 39px;
							height: 39px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
							border-width: 4px;
							left: 0px;
							top: 6px;
							width: 49px;
							height: 49px;
						}


						@keyframes rotateAnim {
							from {
								transform: rotate(360deg);
							}
							to {
								transform: rotate(0deg);
							}
						}

						@-o-keyframes rotateAnim {
							from {
								-o-transform: rotate(360deg);
							}
							to {
								-o-transform: rotate(0deg);
							}
						}

						@-ms-keyframes rotateAnim {
							from {
								-ms-transform: rotate(360deg);
							}
							to {
								-ms-transform: rotate(0deg);
							}
						}

						@-webkit-keyframes rotateAnim {
							from {
								-webkit-transform: rotate(360deg);
							}
							to {
								-webkit-transform: rotate(0deg);
							}
						}

						@-moz-keyframes rotateAnim {
							from {
								-moz-transform: rotate(360deg);
							}
							to {
								-moz-transform: rotate(0deg);
							}
						}


						/*Third Loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

						.windows8<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							width: 78px;
							height:78px;
							margin:auto;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
							position: absolute;
							width: 74px;
							height: 74px;
							opacity: 0;
							transform: rotate(225deg);
								-o-transform: rotate(225deg);
								-ms-transform: rotate(225deg);
								-webkit-transform: rotate(225deg);
								-moz-transform: rotate(225deg);
							animation: orbit 6.96s infinite;
								-o-animation: orbit 6.96s infinite;
								-ms-animation: orbit 6.96s infinite;
								-webkit-animation: orbit 6.96s infinite;
								-moz-animation: orbit 6.96s infinite;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
							position: absolute;
							width: 10px;
							height: 10px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_C; ?>; 
							left:0px;
							top:0px;
							border-radius: 10px;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
							animation-delay: 1.52s;
								-o-animation-delay: 1.52s;
								-ms-animation-delay: 1.52s;
								-webkit-animation-delay: 1.52s;
								-moz-animation-delay: 1.52s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
							animation-delay: 0.3s;
								-o-animation-delay: 0.3s;
								-ms-animation-delay: 0.3s;
								-webkit-animation-delay: 0.3s;
								-moz-animation-delay: 0.3s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
							animation-delay: 0.61s;
								-o-animation-delay: 0.61s;
								-ms-animation-delay: 0.61s;
								-webkit-animation-delay: 0.61s;
								-moz-animation-delay: 0.61s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
							animation-delay: 0.91s;
								-o-animation-delay: 0.91s;
								-ms-animation-delay: 0.91s;
								-webkit-animation-delay: 0.91s;
								-moz-animation-delay: 0.91s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
							animation-delay: 1.22s;
								-o-animation-delay: 1.22s;
								-ms-animation-delay: 1.22s;
								-webkit-animation-delay: 1.22s;
								-moz-animation-delay: 1.22s;
						}



						@keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								transform: rotate(180deg);
								animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								transform: rotate(300deg);
								animation-timing-function: linear;
								origin:0%;
							}

							30% {
								opacity: 1;
								transform:rotate(410deg);
								animation-timing-function: ease-in-out;
								origin:7%;
							}

							39% {
								opacity: 1;
								transform: rotate(645deg);
								animation-timing-function: linear;
								origin:30%;
							}

							70% {
								opacity: 1;
								transform: rotate(770deg);
								animation-timing-function: ease-out;
								origin:39%;
							}

							75% {
								opacity: 1;
								transform: rotate(900deg);
								animation-timing-function: ease-out;
								origin:70%;
							}

							76% {
							opacity: 0;
								transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								transform: rotate(900deg);
							}
						}

						@-o-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-o-transform: rotate(180deg);
								-o-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-o-transform: rotate(300deg);
								-o-animation-timing-function: linear;
								-o-origin:0%;
							}

							30% {
								opacity: 1;
								-o-transform:rotate(410deg);
								-o-animation-timing-function: ease-in-out;
								-o-origin:7%;
							}

							39% {
								opacity: 1;
								-o-transform: rotate(645deg);
								-o-animation-timing-function: linear;
								-o-origin:30%;
							}

							70% {
								opacity: 1;
								-o-transform: rotate(770deg);
								-o-animation-timing-function: ease-out;
								-o-origin:39%;
							}

							75% {
								opacity: 1;
								-o-transform: rotate(900deg);
								-o-animation-timing-function: ease-out;
								-o-origin:70%;
							}

							76% {
							opacity: 0;
								-o-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-o-transform: rotate(900deg);
							}
						}

						@-ms-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-ms-transform: rotate(180deg);
								-ms-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-ms-transform: rotate(300deg);
								-ms-animation-timing-function: linear;
								-ms-origin:0%;
							}

							30% {
								opacity: 1;
								-ms-transform:rotate(410deg);
								-ms-animation-timing-function: ease-in-out;
								-ms-origin:7%;
							}

							39% {
								opacity: 1;
								-ms-transform: rotate(645deg);
								-ms-animation-timing-function: linear;
								-ms-origin:30%;
							}

							70% {
								opacity: 1;
								-ms-transform: rotate(770deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:39%;
							}

							75% {
								opacity: 1;
								-ms-transform: rotate(900deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:70%;
							}

							76% {
							opacity: 0;
								-ms-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-ms-transform: rotate(900deg);
							}
						}

						@-webkit-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-webkit-transform: rotate(180deg);
								-webkit-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-webkit-transform: rotate(300deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:0%;
							}

							30% {
								opacity: 1;
								-webkit-transform:rotate(410deg);
								-webkit-animation-timing-function: ease-in-out;
								-webkit-origin:7%;
							}

							39% {
								opacity: 1;
								-webkit-transform: rotate(645deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:30%;
							}

							70% {
								opacity: 1;
								-webkit-transform: rotate(770deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:39%;
							}

							75% {
								opacity: 1;
								-webkit-transform: rotate(900deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:70%;
							}

							76% {
							opacity: 0;
								-webkit-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-webkit-transform: rotate(900deg);
							}
						}

						@-moz-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-moz-transform: rotate(180deg);
								-moz-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-moz-transform: rotate(300deg);
								-moz-animation-timing-function: linear;
								-moz-origin:0%;
							}

							30% {
								opacity: 1;
								-moz-transform:rotate(410deg);
								-moz-animation-timing-function: ease-in-out;
								-moz-origin:7%;
							}

							39% {
								opacity: 1;
								-moz-transform: rotate(645deg);
								-moz-animation-timing-function: linear;
								-moz-origin:30%;
							}

							70% {
								opacity: 1;
								-moz-transform: rotate(770deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:39%;
							}

							75% {
								opacity: 1;
								-moz-transform: rotate(900deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:70%;
							}

							76% {
							opacity: 0;
								-moz-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-moz-transform: rotate(900deg);
							}
						}

						/*Fourth loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

						.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
							width: 50px;
							height: 50px;
							margin: 20px auto;
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							float: left;
							width: 50%;
							height: 50%;
							position: relative;
							transform: scale(1.1);
								-o-transform: scale(1.1);
								-ms-transform: scale(1.1);
								-webkit-transform: scale(1.1);
								-moz-transform: scale(1.1);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
							content: "";
							position: absolute;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_C; ?>; 
							animation: cssload-fold-thecube 2.76s infinite linear both;
								-o-animation: cssload-fold-thecube 2.76s infinite linear both;
								-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
								-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
								-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
							transform-origin: 100% 100%;
								-o-transform-origin: 100% 100%;
								-ms-transform-origin: 100% 100%;
								-webkit-transform-origin: 100% 100%;
								-moz-transform-origin: 100% 100%;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
							transform: scale(1.1) rotateZ(90deg);
								-o-transform: scale(1.1) rotateZ(90deg);
								-ms-transform: scale(1.1) rotateZ(90deg);
								-webkit-transform: scale(1.1) rotateZ(90deg);
								-moz-transform: scale(1.1) rotateZ(90deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
							transform: scale(1.1) rotateZ(180deg);
								-o-transform: scale(1.1) rotateZ(180deg);
								-ms-transform: scale(1.1) rotateZ(180deg);
								-webkit-transform: scale(1.1) rotateZ(180deg);
								-moz-transform: scale(1.1) rotateZ(180deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
							transform: scale(1.1) rotateZ(270deg);
								-o-transform: scale(1.1) rotateZ(270deg);
								-ms-transform: scale(1.1) rotateZ(270deg);
								-webkit-transform: scale(1.1) rotateZ(270deg);
								-moz-transform: scale(1.1) rotateZ(270deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
							animation-delay: 0.35s;
								-o-animation-delay: 0.35s;
								-ms-animation-delay: 0.35s;
								-webkit-animation-delay: 0.35s;
								-moz-animation-delay: 0.35s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
							animation-delay: 0.69s;
								-o-animation-delay: 0.69s;
								-ms-animation-delay: 0.69s;
								-webkit-animation-delay: 0.69s;
								-moz-animation-delay: 0.69s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
							animation-delay: 1.04s;
								-o-animation-delay: 1.04s;
								-ms-animation-delay: 1.04s;
								-webkit-animation-delay: 1.04s;
								-moz-animation-delay: 1.04s;
						}



						@keyframes cssload-fold-thecube {
							0%, 10% {
								transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-o-keyframes cssload-fold-thecube {
							0%, 10% {
								-o-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-o-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-o-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-ms-keyframes cssload-fold-thecube {
							0%, 10% {
								-ms-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-ms-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-ms-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-webkit-keyframes cssload-fold-thecube {
							0%, 10% {
								-webkit-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-webkit-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-webkit-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-moz-keyframes cssload-fold-thecube {
							0%, 10% {
								-moz-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-moz-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-moz-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						/*First Text*/

						.cssload-loader<?php echo $Rich_Web_Slider; ?> {
							width: 244px;
							height: 49px;
							line-height: 49px;
							text-align: center;
							position: relative;
							left: 50%;
							transform: translate(-50%, 0%);
								-o-transform: translate(-50%, 0%);
								-ms-transform: translate(-50%, 0%);
								-webkit-transform: translate(-50%, 0%);
								-moz-transform: translate(-50%, 0%);
							font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FF; ?> !important;
							text-transform: none !important;
							font-weight: 900;
							font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS; ?>px !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							letter-spacing: 0.2em;
							margin-top:10px;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							content: "";
							display: block;
							width: 15px;
							height: 15px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_BC; ?> !important;
							position: absolute;
							animation: cssload-load 0.81s infinite alternate ease-in-out;
								-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
							top: 0;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							bottom: 0;
						}



						@keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-o-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-ms-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-webkit-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-moz-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}


						/*Second*/

						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							width:100%;
							margin:auto;
							text-align:center;
						}

						.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							text-decoration:none;
							font-weight:normal;
							font-style:normal;
							display:inline-block;
							animation-name:bounce_inTurnFadingTextG;
								-o-animation-name:bounce_inTurnFadingTextG;
								-ms-animation-name:bounce_inTurnFadingTextG;
								-webkit-animation-name:bounce_inTurnFadingTextG;
								-moz-animation-name:bounce_inTurnFadingTextG;
							animation-duration:2.09s;
								-o-animation-duration:2.09s;
								-ms-animation-duration:2.09s;
								-webkit-animation-duration:2.09s;
								-moz-animation-duration:2.09s;
							animation-iteration-count:infinite;
								-o-animation-iteration-count:infinite;
								-ms-animation-iteration-count:infinite;
								-webkit-animation-iteration-count:infinite;
								-moz-animation-iteration-count:infinite;
							animation-direction:normal;
								-o-animation-direction:normal;
								-ms-animation-direction:normal;
								-webkit-animation-direction:normal;
								-moz-animation-direction:normal;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
							animation-delay:<?php Print $anim_sum; ?>s !important;
								-o-animation-delay:<?php Print $anim_sum; ?>s !important;
								-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
								-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
								-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
						}
						<?php $anim_sum=$anim_sum+0.15; ?>
						<?php } ?>

						@keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							}
						}

						@-o-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							}
						}

						@-ms-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							}
						}

						@-webkit-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							}
						}

						@-moz-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
							}
						}

						/*Third text*/

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							top: 0px;
							left: 0px;
							right: 0px;
							bottom: 0px;
							z-index: 10;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
							position: relative;
							display:inline-block;
							margin-left:10px;
							margin-top:20px;
							height: 29px;
							left:50%;
							transform:translateX(-50%) !important;
							-webkit-transform:translateX(-50%) !important;
							-ms-transform:translateX(-50%) !important;
							-moz-transform:translateX(-50%) !important;
							-o-transform:translateX(-50%) !important;
							perspective: 195px;
								-o-perspective: 195px;
								-ms-perspective: 195px;
								-webkit-perspective: 195px;
								-moz-perspective: 195px;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
							position: relative;
							width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS*2; ?>px;
							height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS*2; ?>px;
							background: rgb(204,204,204);
							float: left;
							text-align: center;
							line-height: 2;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_C; ?> !important;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_FS; ?>px !important;
							animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						}
						<?php $str_sum=$str_sum+86.25; ?>
						<?php } ?>


						@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							}
						}

						@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							}
						}

						@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							}
						}

						@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							}
						}

						@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T3_BgC; ?> !important;
							}
						}

						.comment_content ul li:before, .entry-content ul li:before
						{
							content: "";
						}
					    .main 
					    {
					      width: 1500px;
						  max-width:100%;
						  margin-left:auto !important;
						  margin-right:auto !important;
					      z-index: 2;
					      float:none !important;
					      background: #161923;
					    }    
					    .main h1 
					    {
					      padding:20px 50px;
					      float: left;
					      width: 100%;
					      font-size: 90px;
					      box-sizing: border-box;
					      -webkit-box-sizing: border-box;
					      -moz-box-sizing: border-box;
					      font-weight: 100;
					      color: black;
					      margin: 0;
					      margin-top: 70px;
					      font-family: 'Playfair Display';
					      letter-spacing: -1px;
					    }   
					    .main h1.demo1 
					    {
					      background: #1ABC9C;
					    }
					    .page_container 
					    {
					      max-width: 960px;
					      margin: 50px auto;
					    }
					    .immersive_slider .is-slide .content h2
					    {
					      line-height: 140%;
					      font-weight: 100;
					      color: white;
					      font-weight: 100;
					      text-transform:none !important;
					      letter-spacing: 0px !important;
					    }
					    .immersive_slider .is-slide .content a 
					    {
					      color: white;
					    }
					    .immersive_slider .is-slide .content p
					    {
					      float: left;
					      font-weight: 100;
					      width: 100%;
					      font-size: 17px;
					      margin-top: 5px;
					    }
						.CSHD::-webkit-scrollbar 
						{
							width: 0.5em;
						}
						.CSHD::-webkit-scrollbar-track 
						{
							-webkit-box-shadow: inset 0 0 6px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BgC; ?>;
						}
						.CSHD::-webkit-scrollbar-thumb {
							background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DC; ?>;
							outline: <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DC; ?>;
						}
						.is-container .is-background img{
						  	width: 100%;
						  	height: 100%;
						  	left: 0;
						  	position: absolute;						  
						}
						.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						 	position: absolute;
						  	left: 0;
						 	width: 100%;
						  	bottom: 20px;
						  	z-index: 5;
						  	list-style: none;
						  	margin: 0 !important;
						  	padding: 0;
						  	text-align: center;
						}
						#immersive_slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.immersive_slider .is-slide .image  
						{
						  	float: right;
						  	position:relative;
						 	width: <?php echo $rich_CS_Video_Show ?>%;
						  	height:95%;
						  	padding-left: <?php echo $padLeft; ?>px;
						  	box-sizing: border-box;
						 	-moz-box-sizing: border-box;
						 	-webkit-box-sizing: border-box;
						  	vertical-align: middle;
						}
						#immersive_slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.immersive_slider .is-slide .content 
						{
						  	position:relative;
						 	float: left;
						  	width: <?php echo 100-$rich_CS_Video_Show ?>%;
						  	height:90%;
						  	padding-right: 10px;
						  	box-sizing: border-box;
						 	-moz-box-sizing: border-box;
							-webkit-box-sizing: border-box;
						  	color: white;
						  	text-align: left;
						  	line-height: 160%;
						 	vertical-align: middle;
						  	overflow-x:hidden;
						  	display: block;
						}
						.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
						{
							bottom:0px !important;
						}
						.linkDCS
						{
							position:relative;
							float:left;
							width: <?php echo 100-$rich_CS_Video_Show ?>%;
							margin-top:10px;
							text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LPos; ?>;
							z-index:999;
						}
						.CSLink
						{
							padding:3px 5px;
							border:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Link_BW; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Link_BS; ?> <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LBC; ?> !important;
							border-radius:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LBR; ?>px !important;
							font-size:12px;
							background:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LBgC; ?> !important;
							color:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LC; ?> !important;
							outline:none !important;
							transition: all 0.3s linear !important;
							text-decoration:none !important;
							box-shadow:none !important;
						}
						.CSLink:hover
						{
							background: <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LHBgC; ?> !important;
							color:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LHC; ?> !important;
						}
						.entry-content a, .entry-summary a, .page-content a, .comment-content a, .pingback .comment-body > a
						{
							border-bottom:none;
						}
						.CSIcon
						{
						  font-size: <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_AFS; ?>px;
						  position: absolute;
						  top:50%;
						  transform:translateY(-50%);
						  opacity:1;
						  cursor:pointer;
						  color: <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_AC; ?>;
						  display: <?php echo $rich_CS_Video_ArrShow; ?>;
						  line-height: 100%;
						  z-index:99999;
						}
						.CSIcon:hover
						{
							opacity:0.7;
						}
					</style>
					<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
						<div class="center_content<?php echo $Rich_Web_Slider; ?>">
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_Show == "true") { ?>
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T == "Type 1") { ?>
								<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
									<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
									<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
									<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
									<div class="loader_Navigation4" id="loader_Navigation4"></div>
									</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T == "Type 2") { ?>
								<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
									<div class="loader<?php echo $Rich_Web_Slider; ?>">
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T == "Type 3") { ?>
								<div class="windows8<?php echo $Rich_Web_Slider; ?>">
									<div class="wBall" id="wBall_1">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_2">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_3">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_4">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_5">
										<div class="wInnerBall"></div>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_L_T == "Type 4") { ?>
								<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
									<div class="cssload-cube cssload-c1"></div>
									<div class="cssload-cube cssload-c2"></div>
									<div class="cssload-cube cssload-c4"></div>
									<div class="cssload-cube cssload-c3"></div>
								</div>
								<?php } ?>
							<?php } ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_Show == "true") { ?>
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T == "Type 1") { ?>
								<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T == "Type 2") { ?>
								<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
									<?php } ?>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T == "Type 3") { ?>
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
									<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">	
										<?php foreach($text_array as $key=>$v){ ?>	
											<div><?php Print $v; ?></div>
										<?php } ?>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT_T == "Type 4") { ?>
								<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
									<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ContSl_LT;?>
								</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>					
 		 			<div class="main main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style="display:none;" >
				      	<div class="page_container">
							<div id="immersive_slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style='background:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BgC; ?>;box-shadow:0px 0px 30px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BSC; ?>;opacity:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_Op/100; ?>;border-top:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BW; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BS; ?> <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BC; ?>;border-bottom:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BW; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BS; ?> <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BC; ?>;border-radius:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_BR; ?>px;'>
									<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
										<div class="slide slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" data-blurred="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>">											
											<div class="image ImCS">
												<img class='imFiltBl<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="Slider <?php echo $i+1;?>"/>
											</div>
											<div class="content CSHD">
												<h2 class='CSHeader' style='margin:0px;display:<?php echo $rich_CS_Video_TShow; ?>;color:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TC; ?>;text-shadow:1px 1px 1px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TSC; ?>;font-size:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TFS; ?>;font-family:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TFF; ?>;text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TTA; ?>;'><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></h2>
												<p class='CSDesc' style='display:<?php echo $rich_CS_Video_DShow; ?>;color:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DC; ?>;text-shadow:1px 1px 1px <?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DSC; ?>;font-family:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DFF; ?>;text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DTA; ?>;' ><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->Sl_Img_Description);?></p>
											</div>
											<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url !== '' && $Rich_Web_Slider_Images[$i]->Sl_Link_Url !== null){ ?>
											<div class='linkDCS'>
												<a href='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>' target='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_NewTab;?>' class='CSLink CSLink_<?php echo $i; ?>' style='font-family:<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LFF; ?>;'><?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LT; ?></a>
											</div>
											<?php } ?>
										</div>
									<?php } ?>
							  <i class='is-prev is-prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> CSIcon <?php echo $Rich_PS_Left_Icon; ?>'></i>
							  <i class='is-next is-next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> CSIcon <?php echo $Rich_PS_Right_Icon; ?>'></i>
							</div>
						</div>
				  	</div>
					<input type='text' style='display:none;' class='SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_SD; ?>'>
					<input type='text' style='display:none;' class='SShowCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_H; ?>'>
					<input type='text' style='display:none;' class='AnimationType_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_AT; ?>'>
					<input type='text' style='display:none;' class='ContWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_W; ?>'>
					<input type='text' style='display:none;' class='ContHeight<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Cont_H; ?>'>
					<input type='text' style='display:none;' class='ContHeader<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_TFS; ?>'>
					<input type='text' style='display:none;' class='ContDesc<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_Video_DFS; ?>'>
					<input type='text' style='display:none;' class='ContLinkCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_LFS; ?>'>
					<input type='text' style='display:none;' class='ContIconsCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_CS_AFS; ?>'>
					<!-- <script src="<?php echo plugins_url('/Scripts/ContSl.js',__FILE__) ?>"></script> -->
					<script type="text/javascript">
						!function($){
  
						  var defaults<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = {
						    animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: "bounce",
						    slideSelector<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: ".slide",
						    container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: ".main",
						    cssBlur<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: true,
						    pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: true,
						    loop<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: true,
						    autoStart<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: 4000,
							};
						 
							$.fn.swipeEvents<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function() {
						      return this.each(function() {

						        var startX,
						            startY,
						            $this = $(this);

						        $this.bind('touchstart', touchstart<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);

						        function touchstart<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(event) {
						          var touches = event.originalEvent.touches;
						          if (touches && touches.length) {
						            startX = touches[0].pageX;
						            startY = touches[0].pageY;
						            $this.bind('touchmove', touchmove<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
						          }
						          event.preventDefault();
						        }

						        function touchmove<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(event) {
						          var touches = event.originalEvent.touches;
						          if (touches && touches.length) {
						            var deltaX = startX - touches[0].pageX;
						            var deltaY = startY - touches[0].pageY;

						            if (deltaX >= 50) {
						              $this.trigger("swipeLeft");
						            }
						            if (deltaX <= -50) {
						              $this.trigger("swipeRight");
						            }
						            if (deltaY >= 50) {
						              $this.trigger("swipeUp");
						            }
						            if (deltaY <= -50) {
						              $this.trigger("swipeDown");
						            }
						            if (Math.abs(deltaX) >= 50 || Math.abs(deltaY) >= 50) {
						              $this.unbind('touchmove', touchmove<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
						            }
						          }
						          event.preventDefault();
						        }

						      });
						    };
						  
						  $.fn.transformSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function(settings, pos) {
						    var el = $(this)
						    switch(settings.animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>) {
						      case 'slide':
						        el.addClass("ease").css({
						          "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "transform": "translate3d(" + pos + "%, 0, 0)"
						        });
						      break;
						      case 'slideUp':
						        el.addClass("ease").css({
						          "-webkit-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-moz-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-ms-transform": "translate3d(0, " + pos + "%, 0)", 
						          "transform": "translate3d(0, " + pos + "%, 0)"
						        });
						      break;
						      case 'bounce':
						        el.addClass("bounce").css({
						          "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "transform": "translate3d(" + pos + "%, 0, 0)"
						        });
						      break;
						      case 'bounceUp':
						        el.addClass("bounce").css({
						          "-webkit-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-moz-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-ms-transform": "translate3d(0, " + pos + "%, 0)", 
						          "transform": "translate3d(0, " + pos + "%, 0)"
						        });
						      break;
						      case 'fade':
						        el.addClass("no-animation").fadeOut("slow", function() {
						          el.css({
						            "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "transform": "translate3d(" + pos + "%, 0, 0)"
						          }).fadeIn("slow");
						        });
								//my effects
						       case 'fadeEase':
						        el.addClass("ease").fadeOut("slow", function() {
						          el.css({
						            "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "transform": "translate3d(" + pos + "%, 0, 0)"
						          }).fadeIn("slow");
						        });
						      break;
							  case 'fadeBounse':
						        el.addClass("bounce").fadeOut("slow", function() {
						          el.css({
						            "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						            "transform": "translate3d(" + pos + "%, 0, 0)"
						          }).fadeIn("slow");
						        });
						      break;
							  case 'bounce2':
						        el.addClass("bounce2").css({
						          "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "transform": "translate3d(" + pos + "%, 0, 0)"
						        });
						      break;
							  case 'bounce3':
						        el.addClass("bounceUp3").css({
						          "-webkit-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-moz-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "-ms-transform": "translate3d(" + pos + "%, 0, 0)", 
						          "transform": "translate3d(" + pos + "%, 0, 0)"
						        });
						      break;
							  case 'bounceUp2':
						        el.addClass("bounceUp2").css({
						          "-webkit-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-moz-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-ms-transform": "translate3d(0, " + pos + "%, 0)", 
						          "transform": "translate3d(0, " + pos + "%, 0)"
						        });
						      break;
							  case 'bounceUp3':
						        el.addClass("bounceUp3").css({
						          "-webkit-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-moz-transform": "translate3d(0, " + pos + "%, 0)", 
						          "-ms-transform": "translate3d(0, " + pos + "%, 0)", 
						          "transform": "translate3d(0, " + pos + "%, 0)"
						        });
						      break;
						    }
						  }
						  
						  $.fn.positionSlides<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function(settings, index) {
						    var el = $(this);
						    if (settings.animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "slideUp" || settings.animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "bounceUp" || settings.animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "bounceUp2" || settings.animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "bounceUp3") {
						      el.css({
						        top: (index * 100) + "%"
						      });
						    }else {
						      el.css({
						        left: (index * 100) + "%"
						      });
						    }
						  }
						  
						  
						  
						  $.fn.immersive_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function(options){
						    var settings = $.extend({}, defaults<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, options),
						        el = $(this),
						        cssBlur<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "",
						        pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "";
						        
						    // Add all the gs sepecific classes  
						    el.addClass("immersive_slider")
						    el.find(settings.slideSelector<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).addClass("is-slide");
						    
						    // Use CSS to blur the first image the plugin found automatically 
						    if (settings.cssBlur<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == true) {
						      el.find(".is-slide img:first-child").each(function( index ) {
						        var activeclass = ""
						        if(index == 0) activeclass = "active"
						        var img = $(this);
						        
						        $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).addClass("is-container").prepend("<div id='slide_" + (index + 1) + "_bg' class='is-background gs_cssblur " + activeclass + "'>" + img.clone().wrap("<div />").parent().html() + "</div>")
						        $("#slide_" + (index + 1) + "_bg").positionSlides<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, index)
						      });
						    } else {
						      el.find(".is-slide").each(function( index ) {
						        var activeclass = ""
						        if(index == 0) activeclass = "active"
						        var img = "<img src='"+ $(this).data("blurred") +"'>";
						        
						        $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).addClass("is-container").prepend("<div id='slide_" + (index + 1) + "_bg' class='is-background " + activeclass + "'>" + img + "</div>")
						        $("#slide_" + (index + 1) + "_bg").positionSlides<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, index)
						      });
						    }
						    var y=false;
						    if(settings.autoStart<?php echo $Rich_Web_Slider_Manager[0]->id; ?> != 0 || settings.autoStart<?php echo $Rich_Web_Slider_Manager[0]->id; ?> != false) {
						     setInterval(function() {
								 if(y==true){
									 return;
								 }
						        el.moveNext<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
						      }, settings.autoStart<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
						    }
						    
						    $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).find(".is-background").wrapAll( "<div class='is-bg-overflow' />");
						    el.find(".is-slide").wrapAll( "<div class='is-overflow' />");
						    el.find(".is-slide").each(function( index ) {
						      var activeclass = ""
						      if(index == 0) activeclass = "active"
						      $(this).attr("id","slide_" + (index + 1)).addClass(activeclass)
						      $(this).positionSlides<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, index)
						      if(settings.pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == true) {
						        pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> += "<li><a class='is-page " + activeclass + "' href='#slide_" + (index + 1) + "'></a></li>"
						      }
						    });
						    
						    $("<ul class='is-pagination is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>"+pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>+"</ul>").appendTo(el)
						    
						    if(settings.pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == true)  {
							  $(document).on('click touchstart', '.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a', function() {
						        var page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = $(this).attr("href");
						        
						        if (!$(this).hasClass("active")) {
						          el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)
						        }
								return false;
						       
						      });
						    }
							
							 
						   $('.is-next<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').on('click touchstart', function() {
						     el.moveNext<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
							 return false;
							
						   });
						   $('.is-prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').on('click touchstart', function() {
						     el.movePrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
							
							 return false;
						     
						   });
						    $(".main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").hover(function(){
						        y=true;
						        }, function(){
						        y=false;
						    });
						    
						    $.fn.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function(settings, page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>) {
						      var el = $(this),
						          current = el.find(".is-slide.active"),
						          next = el.find(".is-slide" + page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>),
						          bg_current = $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).find(".is-background.active"),
						          bg_next = $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).find(".is-background" + page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?> + "_bg");
						      if(next) {
						        current.removeClass("active")
						        next.addClass("active")
						        
						        bg_current.removeClass("active")
						        bg_next.addClass("active")
						        $(".is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a" + ".active").removeClass("active");
						        $(".is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a" + "[href='" + (page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>) + "']").addClass("active");
						      }
						      pos = ((page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.replace('#slide_','') - 1) * 100) * -1;
						      el.find(".is-overflow").transformSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, pos);
						      $(settings.container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).find(".is-bg-overflow").transformSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, pos);
						    }
						    
						    $.fn.moveNext<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function() {
						      var el = $(this),
						        total = el.find(settings.slideSelector<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).length + 1,
						        page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number = parseInt($(this).find(".is-slide.active").attr("id").replace('slide_','')) + 1;

						        console.log(111);
								 el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, "#slide_" + page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number)
						      if(page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number < total) {
						        el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, "#slide_" + page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number)
						      } else {
						        if (settings.loop<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == true ) el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, "#slide_1")
						      }
						    }
						    
						    $.fn.movePrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = function() {
						      var el = $(this),
						        total = el.find(settings.slideSelector<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).length + 1,
						        page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number = parseInt($(this).find(".is-slide.active").attr("id").replace('slide_','')) - 1;
						      if(page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number <= total && page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number > 0) {
						        el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, "#slide_" + page_index<?php echo $Rich_Web_Slider_Manager[0]->id; ?>_number)
						      }else {
						        if (settings.loop<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == true ) el.moveSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(settings, "#slide_" + (total - 1 ))
						      }
						    }
						  }
						}(window.jQuery);
					</script>
				  	<script type="text/javascript">
				  	    jQuery(document).ready( function() {
							var SShowCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.SShowCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?>;
							if(SShowCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == 'on'){ SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val()); }else{ SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = false; }
							var AnimationType = jQuery('.AnimationType_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					  	    jQuery("#immersive_slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").immersive_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>({
					  	      	animation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: AnimationType,
						        slideSelector<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: ".slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
						        container<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: ".main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
						        cssBlur<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: <?php echo $rich_CS_BIB; ?>,
						        pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: <?php echo $rich_CS_P; ?>,
						        loop<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: <?php echo $rich_CS_Loop; ?>,
						        autoStart<?php echo $Rich_Web_Slider_Manager[0]->id; ?>: SDuration<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*1000,
					  	    });
				  	 	});
				    </script>
					<script>
						jQuery(document).ready(function(){
							function resp(){
								var ContWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								var ContHeight<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContHeight<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								var ContHeader<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContHeader<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								var ContDesc<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContDesc<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								var ContLinkCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContLinkCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								var ContIconsCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery('.ContIconsCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val());
								
								jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',ContWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000+'px');
								jQuery('#immersive_slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',ContHeight<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+250)+'px');
								if(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()<=400){
									jQuery('.CSLink').css('display','none');
									jQuery('.CSHD').css({'width':'100%',height:'30%'});
									jQuery('.ImCS').css({'width':'100%','padding-left':'0px','height':'50%','margin-bottom':'10px'});
									jQuery('.immersive_slider .is-slide').css('padding','5px');
									jQuery('.linkDCS').css({'width':'100%','text-align':'right','margin-top':'5px'});
									jQuery('.CSIcon').css('top','92%');
									jQuery('.is-next<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css({'left':'40px','right':'auto'});
									jQuery('.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('display','none');
									jQuery('.page_container').css('margin','20px auto');
									jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width','100%')
								}else if(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()<=600){
									jQuery('.CSLink').css('display','inline');
									jQuery('.CSHD').css({'width':'64%',height:'85%'});
									jQuery('.ImCS').css({'width':'36%','padding-left':'10px','height':'95%','margin-bottom':'0px'});
									jQuery('.immersive_slider .is-slide').css('padding','30px 40px');
									jQuery('.linkDCS').css({'width':'64%','text-align':'left','margin-top':'10px'});
									jQuery('.CSIcon').css('top','50%');
									jQuery('.is-next<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css({'left':'auto','right':'10px'});
									jQuery('.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('display','block');
									jQuery('.page_container').css('margin','50px auto')
									jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width','100%')
								}else{
									jQuery('.CSLink').css('display','inline');
									jQuery('.CSHD').css({'width':'64%',height:'85%'});
									jQuery('.ImCS').css({'width':'36%','padding-left':'10px','height':'95%','margin-bottom':'0px'});
									jQuery('.immersive_slider .is-slide').css('padding','30px 40px');
									jQuery('.linkDCS').css({'width':'64%','text-align':'left','margin-top':'10px'});
									jQuery('.CSIcon').css('top','50%');
									jQuery('.is-next<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css({'left':'auto','right':'10px'});
									jQuery('.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('display','block');
									jQuery('.page_container').css('margin','50px auto')
									jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width','0px')
								}

								if(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=500){
									jQuery('.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('display','none');
								}else{
									jQuery('.is-pagination<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('display','block');
								}
								
								jQuery('.CSHeader').css('font-size',ContHeader<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+100)+'px');
								jQuery('.CSDesc').css('font-size',ContDesc<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+100)+'px');
								jQuery('.CSDesc').css('line-height',jQuery('.CSDesc').css('font-size'));
								jQuery('.CSLink').css('font-size',ContLinkCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+100)+'px');
								jQuery('.CSIcon').css('font-size',ContIconsCS<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+100)+'px');
							}
							var array_cont<?php echo $Rich_Web_Slider; ?>=[];
							jQuery(".imFiltBl<?php echo $Rich_Web_Slider;?>").each(function(){
								array_cont<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
							})
							
							var y_cont<?php echo $Rich_Web_Slider; ?>=0;
							
							for(i=0;i<array_cont<?php echo $Rich_Web_Slider; ?>.length;i++){
								jQuery("<img class='imFiltBl<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_cont<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   			 	y_cont<?php echo $Rich_Web_Slider; ?>++;
					   			 	if(y_cont<?php echo $Rich_Web_Slider; ?> == array_cont<?php echo $Rich_Web_Slider; ?>.length){
					   			 		jQuery(".main_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
					   			 		jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   				}
					   			})
					   		}
							
							setTimeout(function(){
								resp();
							},100)
							
							
							jQuery(window).resize(function(){
								resp();
							})
						})
					</script>
				<?php } else if($Rich_Web_Slider_Effects[0]->slider_type=='Fashion Slider'){ ?>	
					<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('/Style/fashion.css',__FILE__);?>" media="all" />
					<script type="text/javascript" src="<?php echo plugins_url('/Scripts/fashion.js',__FILE__);?>"></script>
					<script type="text/javascript" charset="utf-8">
						var $ = jQuery.noConflict();
						jQuery(window).load(function() {
							var animType=jQuery('.animTypeR').val();
							var SSHOWFSH = jQuery('.SSHOWFSH_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							console.log(SSHOWFSH);
							var SSHOWSpeed = jQuery('.SSHOWSpeed_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var SSHOWAnimDur = jQuery('.SSHOWAnimDur_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var ICSHOW = jQuery('.ICSHOW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var PPLSHOW = jQuery('.PPLSHOW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var RANDOMIZE = jQuery('.RANDOMIZE_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var LFSL = jQuery('.LFSL_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').flexslider({
							animation:animType,
							slideshow:SSHOWFSH,
							slideshowSpeed:SSHOWSpeed*1000,
							animationDuration:SSHOWAnimDur*100,
							directionNav:ICSHOW,
							controlNav:true,
							keyboardNav:true,
							touchSwipe:true,
							prevText:"Previous",
							nextText:"Next",
							pausePlay:PPLSHOW,
							pauseText:"Pause",
							playText:"Play",
							randomize:RANDOMIZE,
							slideToStart:0,
							animationLoop:LFSL,
							pauseOnAction:true,
							pauseOnHover:true,
							controlsContainer:"",
							manualControls:""
						});
					  });
					</script>
					<?php
						$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT;
						$text_array=str_split($text);
						$str_sum=0;
						$anim_sum=0.75;
					?>
					<style>
						.center_content<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							overflow:visible;
							top:50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							-ms-transform:translateY(-50%);
							-moz-transform:translateY(-50%);
							-o-transform:translateY(-50%);
						}

						#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
							margin:0px auto !important;
							background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_BgC; ?> !important;
							z-index:999;
							width:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Width; ?>px;
							height:0px;
							box-sizing: inherit !important;
							overflow:hidden !important;
							max-width:100% !important;
						}

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

						.RW_Loader_Frame_Navigation{
							position:relative;
							
							left:50%;
							width:80px;
							height:80px;
							transform:translateX(-50%);
							-webkit-transform:translateX(-50%);
							-ms-transform:translateX(-50%);
							-moz-transform:translateX(-50%);
							-o-transform:translateX(-50%);
						}
						.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
							position:relative;
							text-align:center;
							margin-top:10px;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							
						}
						.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
							position:absolute;
							border:5px solid transparent;
							border-radius:50%;
						}
						.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
						.loader_Navigation1{
							width:100%;
							height:100%;
							animation:clockLoading 1s linear 500;
							-webkit-animation:clockLoading 1s linear 500;
							-ms-animation:clockLoading 1s linear 500;
							-moz-animation:clockLoading 1s linear 500;
							-o-animation:clockLoading 1s linear 500;
						}
						.loader_Navigation2{
							width:80%;
							height:80%;
							animation:anticlockLoading 1s linear 500;
							-webkit-animation:anticlockLoading 1s linear 500;
							-ms-animation:anticlockLoading 1s linear 500;
							-moz-animation:anticlockLoading 1s linear 500;
							-o-animation:anticlockLoading 1s linear 500;
						}
						@keyframes clockLoading{
							from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
							to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
						}
						@keyframes anticlockLoading{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
						}
						@keyframes clockLoadingmin{
							from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
							to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
						}


						/*Second Loader*/


						.overlay-loader<?php echo $Rich_Web_Slider; ?> {
							display: block;
							margin: auto;
							width: 97px;
							height: 60px;
							position: relative;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
						}

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

						.loader<?php echo $Rich_Web_Slider; ?> {
							position: absolute;
							top: 0;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
							width: 97px;
							height: 97px;
							animation-name: rotateAnim;
								-o-animation-name: rotateAnim;
								-ms-animation-name: rotateAnim;
								-webkit-animation-name: rotateAnim;
								-moz-animation-name: rotateAnim;
							animation-duration: 0.4s;
								-o-animation-duration: 0.4s;
								-ms-animation-duration: 0.4s;
								-webkit-animation-duration: 0.4s;
								-moz-animation-duration: 0.4s;
							animation-iteration-count: infinite;
								-o-animation-iteration-count: infinite;
								-ms-animation-iteration-count: infinite;
								-webkit-animation-iteration-count: infinite;
								-moz-animation-iteration-count: infinite;
							animation-timing-function: linear;
								-o-animation-timing-function: linear;
								-ms-animation-timing-function: linear;
								-webkit-animation-timing-function: linear;
								-moz-animation-timing-function: linear;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div {
							width: 8px;
							height: 8px;
							border-radius: 50%;
							border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_C; ?>; 
							position: absolute;
							top: 2px;
							left: 0;
							right: 0;
							bottom: 0;
							margin: auto;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
							border-top: none;
							border-left: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
							border-bottom: none;
							border-right: none;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
							border-width: 2px;
							left: 0px;
							top: -4px;
							width: 12px;
							height: 12px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
							border-width: 2px;
							left: -1px;
							top: 3px;
							width: 18px;
							height: 18px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
							border-width: 3px;
							left: -1px;
							top: -4px;
							width: 23px;
							height: 23px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
							border-width: 3px;
							left: -1px;
							top: 4px;
							width: 31px;
							height: 31px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
							border-width: 4px;
							left: 0px;
							top: -4px;
							width: 39px;
							height: 39px;
						}
						.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
							border-width: 4px;
							left: 0px;
							top: 6px;
							width: 49px;
							height: 49px;
						}


						@keyframes rotateAnim {
							from {
								transform: rotate(360deg);
							}
							to {
								transform: rotate(0deg);
							}
						}

						@-o-keyframes rotateAnim {
							from {
								-o-transform: rotate(360deg);
							}
							to {
								-o-transform: rotate(0deg);
							}
						}

						@-ms-keyframes rotateAnim {
							from {
								-ms-transform: rotate(360deg);
							}
							to {
								-ms-transform: rotate(0deg);
							}
						}

						@-webkit-keyframes rotateAnim {
							from {
								-webkit-transform: rotate(360deg);
							}
							to {
								-webkit-transform: rotate(0deg);
							}
						}

						@-moz-keyframes rotateAnim {
							from {
								-moz-transform: rotate(360deg);
							}
							to {
								-moz-transform: rotate(0deg);
							}
						}


						/*Third Loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

						.windows8<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							width: 78px;
							height:78px;
							margin:auto;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
							position: absolute;
							width: 74px;
							height: 74px;
							opacity: 0;
							transform: rotate(225deg);
								-o-transform: rotate(225deg);
								-ms-transform: rotate(225deg);
								-webkit-transform: rotate(225deg);
								-moz-transform: rotate(225deg);
							animation: orbit 6.96s infinite;
								-o-animation: orbit 6.96s infinite;
								-ms-animation: orbit 6.96s infinite;
								-webkit-animation: orbit 6.96s infinite;
								-moz-animation: orbit 6.96s infinite;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
							position: absolute;
							width: 10px;
							height: 10px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_C; ?>; 
							left:0px;
							top:0px;
							border-radius: 10px;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
							animation-delay: 1.52s;
								-o-animation-delay: 1.52s;
								-ms-animation-delay: 1.52s;
								-webkit-animation-delay: 1.52s;
								-moz-animation-delay: 1.52s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
							animation-delay: 0.3s;
								-o-animation-delay: 0.3s;
								-ms-animation-delay: 0.3s;
								-webkit-animation-delay: 0.3s;
								-moz-animation-delay: 0.3s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
							animation-delay: 0.61s;
								-o-animation-delay: 0.61s;
								-ms-animation-delay: 0.61s;
								-webkit-animation-delay: 0.61s;
								-moz-animation-delay: 0.61s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
							animation-delay: 0.91s;
								-o-animation-delay: 0.91s;
								-ms-animation-delay: 0.91s;
								-webkit-animation-delay: 0.91s;
								-moz-animation-delay: 0.91s;
						}

						.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
							animation-delay: 1.22s;
								-o-animation-delay: 1.22s;
								-ms-animation-delay: 1.22s;
								-webkit-animation-delay: 1.22s;
								-moz-animation-delay: 1.22s;
						}



						@keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								transform: rotate(180deg);
								animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								transform: rotate(300deg);
								animation-timing-function: linear;
								origin:0%;
							}

							30% {
								opacity: 1;
								transform:rotate(410deg);
								animation-timing-function: ease-in-out;
								origin:7%;
							}

							39% {
								opacity: 1;
								transform: rotate(645deg);
								animation-timing-function: linear;
								origin:30%;
							}

							70% {
								opacity: 1;
								transform: rotate(770deg);
								animation-timing-function: ease-out;
								origin:39%;
							}

							75% {
								opacity: 1;
								transform: rotate(900deg);
								animation-timing-function: ease-out;
								origin:70%;
							}

							76% {
							opacity: 0;
								transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								transform: rotate(900deg);
							}
						}

						@-o-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-o-transform: rotate(180deg);
								-o-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-o-transform: rotate(300deg);
								-o-animation-timing-function: linear;
								-o-origin:0%;
							}

							30% {
								opacity: 1;
								-o-transform:rotate(410deg);
								-o-animation-timing-function: ease-in-out;
								-o-origin:7%;
							}

							39% {
								opacity: 1;
								-o-transform: rotate(645deg);
								-o-animation-timing-function: linear;
								-o-origin:30%;
							}

							70% {
								opacity: 1;
								-o-transform: rotate(770deg);
								-o-animation-timing-function: ease-out;
								-o-origin:39%;
							}

							75% {
								opacity: 1;
								-o-transform: rotate(900deg);
								-o-animation-timing-function: ease-out;
								-o-origin:70%;
							}

							76% {
							opacity: 0;
								-o-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-o-transform: rotate(900deg);
							}
						}

						@-ms-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-ms-transform: rotate(180deg);
								-ms-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-ms-transform: rotate(300deg);
								-ms-animation-timing-function: linear;
								-ms-origin:0%;
							}

							30% {
								opacity: 1;
								-ms-transform:rotate(410deg);
								-ms-animation-timing-function: ease-in-out;
								-ms-origin:7%;
							}

							39% {
								opacity: 1;
								-ms-transform: rotate(645deg);
								-ms-animation-timing-function: linear;
								-ms-origin:30%;
							}

							70% {
								opacity: 1;
								-ms-transform: rotate(770deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:39%;
							}

							75% {
								opacity: 1;
								-ms-transform: rotate(900deg);
								-ms-animation-timing-function: ease-out;
								-ms-origin:70%;
							}

							76% {
							opacity: 0;
								-ms-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-ms-transform: rotate(900deg);
							}
						}

						@-webkit-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-webkit-transform: rotate(180deg);
								-webkit-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-webkit-transform: rotate(300deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:0%;
							}

							30% {
								opacity: 1;
								-webkit-transform:rotate(410deg);
								-webkit-animation-timing-function: ease-in-out;
								-webkit-origin:7%;
							}

							39% {
								opacity: 1;
								-webkit-transform: rotate(645deg);
								-webkit-animation-timing-function: linear;
								-webkit-origin:30%;
							}

							70% {
								opacity: 1;
								-webkit-transform: rotate(770deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:39%;
							}

							75% {
								opacity: 1;
								-webkit-transform: rotate(900deg);
								-webkit-animation-timing-function: ease-out;
								-webkit-origin:70%;
							}

							76% {
							opacity: 0;
								-webkit-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-webkit-transform: rotate(900deg);
							}
						}

						@-moz-keyframes orbit {
							0% {
								opacity: 1;
								z-index:99;
								-moz-transform: rotate(180deg);
								-moz-animation-timing-function: ease-out;
							}

							7% {
								opacity: 1;
								-moz-transform: rotate(300deg);
								-moz-animation-timing-function: linear;
								-moz-origin:0%;
							}

							30% {
								opacity: 1;
								-moz-transform:rotate(410deg);
								-moz-animation-timing-function: ease-in-out;
								-moz-origin:7%;
							}

							39% {
								opacity: 1;
								-moz-transform: rotate(645deg);
								-moz-animation-timing-function: linear;
								-moz-origin:30%;
							}

							70% {
								opacity: 1;
								-moz-transform: rotate(770deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:39%;
							}

							75% {
								opacity: 1;
								-moz-transform: rotate(900deg);
								-moz-animation-timing-function: ease-out;
								-moz-origin:70%;
							}

							76% {
							opacity: 0;
								-moz-transform:rotate(900deg);
							}

							100% {
							opacity: 0;
								-moz-transform: rotate(900deg);
							}
						}

						/*Fourth loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

						.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
							width: 50px;
							height: 50px;
							margin: 20px auto;
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							position: relative;
							transform: rotateZ(45deg);
								-o-transform: rotateZ(45deg);
								-ms-transform: rotateZ(45deg);
								-webkit-transform: rotateZ(45deg);
								-moz-transform: rotateZ(45deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
							float: left;
							width: 50%;
							height: 50%;
							position: relative;
							transform: scale(1.1);
								-o-transform: scale(1.1);
								-ms-transform: scale(1.1);
								-webkit-transform: scale(1.1);
								-moz-transform: scale(1.1);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
							content: "";
							position: absolute;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_C; ?>; 
							animation: cssload-fold-thecube 2.76s infinite linear both;
								-o-animation: cssload-fold-thecube 2.76s infinite linear both;
								-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
								-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
								-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
							transform-origin: 100% 100%;
								-o-transform-origin: 100% 100%;
								-ms-transform-origin: 100% 100%;
								-webkit-transform-origin: 100% 100%;
								-moz-transform-origin: 100% 100%;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
							transform: scale(1.1) rotateZ(90deg);
								-o-transform: scale(1.1) rotateZ(90deg);
								-ms-transform: scale(1.1) rotateZ(90deg);
								-webkit-transform: scale(1.1) rotateZ(90deg);
								-moz-transform: scale(1.1) rotateZ(90deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
							transform: scale(1.1) rotateZ(180deg);
								-o-transform: scale(1.1) rotateZ(180deg);
								-ms-transform: scale(1.1) rotateZ(180deg);
								-webkit-transform: scale(1.1) rotateZ(180deg);
								-moz-transform: scale(1.1) rotateZ(180deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
							transform: scale(1.1) rotateZ(270deg);
								-o-transform: scale(1.1) rotateZ(270deg);
								-ms-transform: scale(1.1) rotateZ(270deg);
								-webkit-transform: scale(1.1) rotateZ(270deg);
								-moz-transform: scale(1.1) rotateZ(270deg);
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
							animation-delay: 0.35s;
								-o-animation-delay: 0.35s;
								-ms-animation-delay: 0.35s;
								-webkit-animation-delay: 0.35s;
								-moz-animation-delay: 0.35s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
							animation-delay: 0.69s;
								-o-animation-delay: 0.69s;
								-ms-animation-delay: 0.69s;
								-webkit-animation-delay: 0.69s;
								-moz-animation-delay: 0.69s;
						}
						.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
							animation-delay: 1.04s;
								-o-animation-delay: 1.04s;
								-ms-animation-delay: 1.04s;
								-webkit-animation-delay: 1.04s;
								-moz-animation-delay: 1.04s;
						}



						@keyframes cssload-fold-thecube {
							0%, 10% {
								transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-o-keyframes cssload-fold-thecube {
							0%, 10% {
								-o-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-o-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-o-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-ms-keyframes cssload-fold-thecube {
							0%, 10% {
								-ms-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-ms-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-ms-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-webkit-keyframes cssload-fold-thecube {
							0%, 10% {
								-webkit-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-webkit-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-webkit-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						@-moz-keyframes cssload-fold-thecube {
							0%, 10% {
								-moz-transform: perspective(136px) rotateX(-180deg);
								opacity: 0;
							}
							25%,
										75% {
								-moz-transform: perspective(136px) rotateX(0deg);
								opacity: 1;
							}
							90%,
										100% {
								-moz-transform: perspective(136px) rotateY(180deg);
								opacity: 0;
							}
						}

						/*First Text*/

						.cssload-loader<?php echo $Rich_Web_Slider; ?> {
							width: 244px;
							height: 49px;
							line-height: 49px;
							text-align: center;
							position: relative;
							left: 50%;
							transform: translate(-50%, 0%);
								-o-transform: translate(-50%, 0%);
								-ms-transform: translate(-50%, 0%);
								-webkit-transform: translate(-50%, 0%);
								-moz-transform: translate(-50%, 0%);
							font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FF; ?> !important;
							text-transform: none !important;
							font-weight: 900;
							font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS; ?>px !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							letter-spacing: 0.2em;
							margin-top:10px;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							content: "";
							display: block;
							width: 15px;
							height: 15px;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_BC; ?> !important;
							position: absolute;
							animation: cssload-load 0.81s infinite alternate ease-in-out;
								-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
								-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
							top: 0;
						}
						.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
							bottom: 0;
						}



						@keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-o-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-ms-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-webkit-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}

						@-moz-keyframes cssload-load {
							0% {
								left: 0;
								height: 29px;
								width: 15px;
							}
							50% {
								height: 8px;
								width: 39px;
							}
							100% {
								left: 229px;
								height: 29px;
								width: 15px;
							}
						}


						/*Second*/

						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							width:100%;
							margin:auto;
							text-align:center;
						}

						.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							text-decoration:none;
							font-weight:normal;
							font-style:normal;
							display:inline-block;
							animation-name:bounce_inTurnFadingTextG;
								-o-animation-name:bounce_inTurnFadingTextG;
								-ms-animation-name:bounce_inTurnFadingTextG;
								-webkit-animation-name:bounce_inTurnFadingTextG;
								-moz-animation-name:bounce_inTurnFadingTextG;
							animation-duration:2.09s;
								-o-animation-duration:2.09s;
								-ms-animation-duration:2.09s;
								-webkit-animation-duration:2.09s;
								-moz-animation-duration:2.09s;
							animation-iteration-count:infinite;
								-o-animation-iteration-count:infinite;
								-ms-animation-iteration-count:infinite;
								-webkit-animation-iteration-count:infinite;
								-moz-animation-iteration-count:infinite;
							animation-direction:normal;
								-o-animation-direction:normal;
								-ms-animation-direction:normal;
								-webkit-animation-direction:normal;
								-moz-animation-direction:normal;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
							animation-delay:<?php Print $anim_sum; ?>s !important;
								-o-animation-delay:<?php Print $anim_sum; ?>s !important;
								-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
								-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
								-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
						}
						<?php $anim_sum=$anim_sum+0.15; ?>
						<?php } ?>

						@keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							}
						}

						@-o-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							}
						}

						@-ms-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							}
						}

						@-webkit-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							}
						}

						@-moz-keyframes bounce_inTurnFadingTextG{
							0%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T2_AnC; ?>;
							}

							100%{
								color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
							}
						}

						/*Third text*/

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
							position: relative;
							top: 0px;
							left: 0px;
							right: 0px;
							bottom: 0px;
							z-index: 10;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
							position: relative;
							display:inline-block;
							margin-left:10px;
							margin-top:20px;
							height: 29px;
							left:50%;
							transform:translateX(-50%) !important;
							-webkit-transform:translateX(-50%) !important;
							-ms-transform:translateX(-50%) !important;
							-moz-transform:translateX(-50%) !important;
							-o-transform:translateX(-50%) !important;
							perspective: 195px;
								-o-perspective: 195px;
								-ms-perspective: 195px;
								-webkit-perspective: 195px;
								-moz-perspective: 195px;
						}

						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
							position: relative;
							width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS*2; ?>px;
							height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS*2; ?>px;
							background: rgb(204,204,204);
							float: left;
							text-align: center;
							line-height: 2;
							font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS; ?>px !important;
							font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FF; ?> !important;
							color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_C; ?> !important;
						}
						<?php foreach($text_array as $key=>$v) { ?>
						.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_FS; ?>px !important;
							animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
								-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						}
						<?php $str_sum=$str_sum+86.25; ?>
						<?php } ?>


						@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							}
						}

						@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							}
						}

						@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							}
						}

						@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							}
						}

						@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
							from {
								-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
								box-shadow: 0 0 0 rgba(0,0,0,0);
							}
							to {
								-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
								box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?>;
								background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T3_BgC; ?> !important;
							}
						}

						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slides img {
							max-width: 100%;
							width:100% !important;
							height:100% !important;
							display: block;
						}
						.pausePlay{
							opacity:0;
							cursor:pointer;
							transition:all linear 0.4s;
						}
						.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
							position:relative !important;
							width:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Width; ?>px !important;
							height:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Height; ?>px;
							box-sizing:border-box !important;
						}
						.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .pausePlay{
							opacity:1;
						}
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
							width:100% !important;
							height:100% !important;
						}
						.flexslider .slides,.flexslider .slides > li,.flexslider_4 .slides img{
							width:100% !important;
							height:100% !important;
						}
						.flex-pauseplay{
							position:absolute;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							text-align:center;
							color:#fff;
							height:50px;
							width:50px;
							z-index:1;
						}
						.flex-caption {
							position: absolute;
							right: 58px;
							bottom: 20px;
							display:none;
						}
						.fl_cap_Animate{
							display:block;
							height:auto !important;
							max-height:65px !important;
						}
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a {width:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Size; ?>px; height:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Size; ?>px; margin:0; display: block; position: absolute; right:11px; cursor: pointer; text-indent: -9999px; text-decoration:none !important;
						}						
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next {
							background: url(<?php echo plugins_url('/Images/'. $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Type .'-'. $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Type .'.png',__FILE__);?>) no-repeat center;
							bottom: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Size+24+5; ?>px;
							background-size:100% 100%;
						}
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev {
							background: url(<?php echo plugins_url('/Images/'. $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Type .'.png',__FILE__);?>) no-repeat center;
							bottom: 24px;
							background-size:100% 100%;
						}
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next:hover {
							background: url(<?php echo plugins_url('/Images/'. $Rich_Web_Slider_Effect[0]->rich_fsl_Hover_Icon_Type .'-'. $Rich_Web_Slider_Effect[0]->rich_fsl_Hover_Icon_Type .'.png',__FILE__);?>) no-repeat center;
							background-size:100% 100%;
						}
						.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev:hover {
							background: url(<?php echo plugins_url('/Images/'. $Rich_Web_Slider_Effect[0]->rich_fsl_Hover_Icon_Type .'.png',__FILE__);?>) no-repeat center;
							background-size:100% 100%;
						}
						.flex-direction-nav a {
							overflow: visible;
							margin: 0;
							opacity: 1;
							top: none;
						}
						.caption_title_line {
							width: 450px;
							padding: 0px 15px 0px 15px;
							color: #303030;
						}
						.animate{
							right:2px !important;
							top:50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							-ms-transform:translateY(-50%);
						}
						.animate2{
							left:2px !important;
							top:50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							-ms-transform:translateY(-50%);
						}
						.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar {
							width: 0.5em;
						}
						.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar-track {
							-webkit-box-shadow: inset 0 0 6px <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Bg_Color; ?>;
						}
						.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar-thumb {
							background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Color; ?>;
							outline: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Color; ?>;
						}
						.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
							position: absolute;
							top: 10px;
							right: 10px;
							text-decoration: none !important;
							border: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Border_Width; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Border_Style; ?> <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Border_Color; ?>;
							border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Title_Text_Shadow; ?>px;
							padding: 5px 10px;
							background: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Bg_Color; ?>;
							
							font-size: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Font_Size; ?>px;
							line-height: 1 !important;
							color: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Color; ?> !important;
							outline:none !important;
							box-shadow:none !important;
							border:none !important;
							font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Font_Family; ?>;
							transition:all linear 0.3s;
						}
						<?php if($Rich_Web_Slider_Effect[0]->rich_fsl_Link_Transparency == "") { ?>
							.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
								opacity:1 !important;
							}
						<?php } else { ?>
							.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
								opacity: 0.65 !important;
							}
						<?php } ?>
						.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover{
							border-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Hover_Border_Color; ?>;
							background: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Hover_Bg_Color; ?>;
							color: <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Hover_Color; ?> !important;
							
						}
						<?php if($Rich_Web_Slider_Effect[0]->rich_fsl_Link_Hover_Transparency == "") { ?>
							.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover{
								opacity:1 !important;
							}
						<?php } else { ?>
							.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover{
								opacity: 0.65 !important;
							}
						<?php } ?>

						
						<?php if($Rich_Web_Slider_Effect[0]->rich_fsl_Link_Hover_Transparency == "") { ?>
							.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
								opacity:1 !important;
							}
						<?php } else { ?>
							.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
								opacity: 0.75 !important;
							}
						<?php } ?>
						.flex-direction-nav{
							list-style:none !important;
							padding:0px !important;
							margin:0px !important;
						}
					</style>
					<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
						<div class="center_content<?php echo $Rich_Web_Slider; ?>">
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_Show == "true") { ?>
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T == "Type 1") { ?>
								<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
									<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
									<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
									<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
									<div class="loader_Navigation4" id="loader_Navigation4"></div>
									</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T == "Type 2") { ?>
								<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
									<div class="loader<?php echo $Rich_Web_Slider; ?>">
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
										<div></div>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T == "Type 3") { ?>
								<div class="windows8<?php echo $Rich_Web_Slider; ?>">
									<div class="wBall" id="wBall_1">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_2">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_3">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_4">
										<div class="wInnerBall"></div>
									</div>
									<div class="wBall" id="wBall_5">
										<div class="wInnerBall"></div>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_L_T == "Type 4") { ?>
								<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
									<div class="cssload-cube cssload-c1"></div>
									<div class="cssload-cube cssload-c2"></div>
									<div class="cssload-cube cssload-c4"></div>
									<div class="cssload-cube cssload-c3"></div>
								</div>
								<?php } ?>
							<?php } ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_Show == "true") { ?>
								<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T == "Type 1") { ?>
								<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T == "Type 2") { ?>
								<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
									<?php } ?>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T == "Type 3") { ?>
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
									<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">	
										<?php foreach($text_array as $key=>$v){ ?>	
											<div><?php Print $v; ?></div>
										<?php } ?>
									</div>
								</div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT_T == "Type 4") { ?>
								<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
									<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FSl_LT;?>
								</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<div class="slider_container slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style='position:relative;display:none;padding:0px;max-width:100%;border:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Border_Width; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Border_Style; ?> <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Border_Color;?>;background:<?php if($Rich_Web_Slider_Effect[0]->rich_fsl_Border_Style=='none' || $Rich_Web_Slider_Effect[0]->rich_fsl_Border_Width == '0' ){ echo none; }else{ echo $Rich_Web_Slider_Effect[0]->rich_fsl_Border_Color; } ?>;box-shadow:0px 0px <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Box_Shadow; ?>px <?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Shadow_Color; ?>;'>
						<div class="flexslider flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
						 	<ul class="slides" style='list-style:none;margin:0px;padding:0px;'>
								<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
									<li>
										<a href="#" class='clfl' style='position:relative;'>
										<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url !== '' && $Rich_Web_Slider_Images[$i]->Sl_Link_Url !== null){ ?>
											<a href='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url; ?>' target='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_NewTab;?>' class='FSLLink FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
												<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Text; ?>
											</a>
										<?php } ?>
											<img style='margin:0px;' class="RW_Fashion_IMG<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="" title=""/>
										</a>
										<div class="flex-caption flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style='overflow-x:hidden;background:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Bg_Color; ?>;height:<?php echo 2*$Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Size+5; ?>px;'>
											<div class="caption_title_line">
												<h2 style='padding:0px;font-size:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Title_Font_Size; ?>px;color:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Title_Color; ?>;font-family:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Title_Font_Family; ?>;text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Title_Text_Align; ?>;'><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></h2>
												<p style='padding:0px;margin:0px;font-size:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Size; ?>px;line-height:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Size; ?>px;color:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Color; ?>;font-family:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Font_Family; ?>;text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Text_Align; ?>;'><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->Sl_Img_Description);?></p>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
					  	</div>
					 </div>
					 <input type='text' style='display:none;' class='animTypeR_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_animation; ?>'>
					 <input type='text' style='display:none;' class='SSHOWFSH_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_SShow; ?>'>
					 <input type='text' style='display:none;' class='SSHOWSpeed_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_SShow_Speed; ?>'>
					 <input type='text' style='display:none;' class='SSHOWAnimDur_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Anim_Dur; ?>'>
					 <input type='text' style='display:none;' class='ICSHOW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_Ic_Show; ?>'>
					 <input type='text' style='display:none;' class='PPLSHOW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_PPL_Show; ?>'>
					 <input type='text' style='display:none;' class='RANDOMIZE_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_Randomize; ?>'>
					 <input type='text' style='display:none;' class='LFSL_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_Loop; ?>'>
					 <input type='text' style='display:none;' class='FSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Width; ?>'>
					 <input type='text' style='display:none;' class='FSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Height; ?>'>
					 <input type='text' style='display:none;' class='FSLDescShow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $rich_fsl_Desc_Show; ?>'>
					 <input type='text' style='display:none;' class='FSLLinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Link_Font_Size; ?>'>
					 <input type='text' style='display:none;' class='IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->rich_fsl_Icon_Size; ?>'>
					 <script>
						jQuery(document).ready(function(){
							var x=jQuery('.animTypeR_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var dirNav='true';
							var FSLDescShow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.FSLDescShow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var FSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.FSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var FSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.FSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var FSLLinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.FSLLinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
							var IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();							
							function resp()
							{
								jQuery('.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('font-size',FSLLinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+200)+'px');
								jQuery('.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('line-height',jQuery('.FSLLink_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('font-size'));
								jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slides img').css('width','100%');
								jQuery(".slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>").css("height",jQuery(".slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").width()*FSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/FSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);

								if(jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slides img').width()>jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a').width()+450+31)
								{
									if(FSLDescShow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=='true'){ jQuery('.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').addClass('fl_cap_Animate'); }
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next').removeClass('animate');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev').removeClass('animate2');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav').css('top','100%');
								}
								else
								{
									jQuery('.flex-caption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').removeClass('fl_cap_Animate');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next').addClass('animate');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev').addClass('animate2');
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next').css('width',IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150));
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.next').css('height',IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150));
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev').css('width',IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150));
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav li a.prev').css('height',IcOnSize_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150));
									jQuery('.flexslider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .flex-direction-nav').css('top','50%');
								}
								if(jQuery('.slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=300){
									jQuery('.FSLLink').css('display','none');
								}else{
									jQuery('.FSLLink').css('display','block');
								}
							}
							jQuery(window).load(function(){	
								resp();		
							})
							setTimeout(function(){
								resp();	
							},100)
							
							

							var array_fashion<?php echo $Rich_Web_Slider; ?>=[];
							jQuery(".RW_Fashion_IMG<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
								array_fashion<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
							})
							
							var y_fashion<?php echo $Rich_Web_Slider; ?>=0;
							
							for(i=0;i<array_fashion<?php echo $Rich_Web_Slider; ?>.length;i++){
								jQuery("<img class='RW_Fashion_IMG<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_fashion<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   			 	y_fashion<?php echo $Rich_Web_Slider; ?>++;
					   			 	if(y_fashion<?php echo $Rich_Web_Slider; ?> == array_fashion<?php echo $Rich_Web_Slider; ?>.length){
					   			 		jQuery(".slider_container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
					   			 		jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>").remove();
					   				}
					   			})
					   		}
							jQuery(window).resize(function(){ resp(); })
						})
					</script>
			<?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Circle Thumbnails'){ ?>
				<?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
		        <style>
		        	.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_BgC; ?> !important;
						z-index:999;
						width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_W;?>px;
						height:0px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>


					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T3_BgC; ?> !important;
						}
					}
		        	.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
    					border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BC;?> !important;
    					width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_W;?>px;
    					height:0px;
    					max-width:100%;
    					box-sizing:border-box !important;
    					<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxSShow=='true'){ ?>
    						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxSType=='true'){ ?> 
    							-webkit-box-shadow: 0px 0px 100px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
                                -moz-box-shadow: 0px 0px 100px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
    							box-shadow: 0px 0px 100px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
    						<?php }else{ ?>
    							-webkit-box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
    							-moz-box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
    							box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxS;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_BxC;?>;
    						<?php }?>
    					<?php }?>
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TDABgC;?>;
    					<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TDAPos;?>: 0px;
					}
					.cn-loading
					{
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_LBgC;?>;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content .cn-nav-content-current h2
					{
						margin-top: 10px;
					    font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TFS;?>px !important;
					    font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TFF;?> !important;
					    color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TCC;?> !important;
						opacity:1 !important;
						letter-spacing:0px !important;
					    text-transform:none !important;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content h3
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TFS-5;?>px !important;
					    font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TFF;?> !important;
					    color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TC;?> !important;
					    margin:0px !important;
					    letter-spacing:0px !important;
					    text-transform:none !important;
					}
					.cn-nav_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.cn-nav-prev span
					{
					    background: url(<?php echo plugins_url('/Images/prev_'. $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArType .'.png',__FILE__);?>) no-repeat center center;
					}
					.cn-nav_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.cn-nav-next:hover, .cn-nav_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.cn-nav-next:focus{
						color:none !important;
						transition:all 0s !important;
					}
					.cn-nav_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.cn-nav-next span
					{
					    background: url(<?php echo plugins_url('/Images/next_'. $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArType .'.png',__FILE__);?>) no-repeat center center;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content div span
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArTextFS;?>px;
					    font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArTextFF;?>;
					    color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArTextC;?>;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-prev span, .cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-next span
					{
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArBgC;?>;
						-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArBR;?>px;
                        -webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArBR;?>px;
    					border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArBR;?>px;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a:hover span, .cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a:hover div
					{
						-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArHBR;?>px;
                        -webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArHBR;?>px;
    					border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArHBR;?>px;
					}
					.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a:hover span
					{
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArHBC;?>;
					}	
					.cn-bar-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:none !important;
						top:50% !important;
						left:50% !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						width:100%;
					}
					.cn-nav-content-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						width:75% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
					}
					.cn-nav-content-anim2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						width:100% !important;
					}
					@media screen and (max-width:500px){
						#cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
							max-height:300px;
						}
					}
		        </style>
		        <div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CircleSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<script id="barTmpl" type="text/x-jquery-tmpl">
		            <div class="cn-bar cn-bar_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
		                <div class="cn-nav cn-nav_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
							<a href="#" class="cn-nav-prev">
								<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArText=='true'){ ?>
									<span><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArLeft;?></span>
								<?php }?>
								<div style="background-image:url(${prevSource});"></div> 
							</a>
							<a href="#" class="cn-nav-next">
		                       <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArText=='true'){ ?>
									<span><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArRight;?></span>
								<?php }?>
								<div style="background-image:url(${nextSource});"></div>
							</a>
		                </div>
		                <div class="cn-nav-content cn-nav-content_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
		                    <div class="cn-nav-content-prev">
		                        <span id='pCl'><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArLeft;?></span>
		                        <h3>${prevTitle}</h3>
		                    </div>
		                    <div class="cn-nav-content-current">
		                        <h2>${currentTitle}</h2>
		                    </div>
		                    <div class="cn-nav-content-next">
		                        <span id='nCl'><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_ArRight;?></span>
		                        <h3>${nextTitle}</h3>
		                    </div>
		                </div>
		            </div>
				</script>
				<div class="wrapper wrapper<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style="display:none;">
	                <div id="cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" class="cn-slideshow cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
	                    <div class="cn-images cn-images_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
	                    	<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
	                    		<?php if($i=='0'){ ?>
	                    			<img class="rw_circle_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="image<?php echo $i;?>" title="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>" data-thumb="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" style="display:block;width:100%;height:100%;"/>
	                    		<?php } else { ?>
	                    			<img class="rw_circle_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="image<?php echo $i;?>" title="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>" data-thumb="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" style='width:100%;height:100%;'/>
	                    		<?php }?>
	                    	<?php } ?>	                      
	                    </div><!-- cn-images -->
	                </div>
	            </div>
				<input type='text' style='display:none;' class='respSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_W;?>' />
				<input type='text' style='display:none;' class='respSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_H;?>' />
				<input type='text' style='display:none;' class='respSLTitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_CT_TFS-5;?>' />
				<script type="text/javascript" src="<?php echo plugins_url('/Scripts/jquery.tmpl.min.js',__FILE__);?>"></script>
				<script type="text/javascript" src="<?php echo plugins_url('/Scripts/jquery.slideshow.js',__FILE__);?>"></script>
				<script type="text/javascript">
		            jQuery(function() {
						jQuery('#cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').slideshow(<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
		            });
		        </script>

				<script>
					jQuery(document).ready(function(){
						var respSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.respSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var respSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.respSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var respSLTitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.respSLTitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						function resp(){
							jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*respSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/respSLWidth_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
							if(jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=500){

								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content h3').css('font-size',respSLTitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content .cn-nav-content-current h2').css('font-size',(parseInt(respSLTitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)+5)*jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+100))
								jQuery('#nCl').css('display','none');
								jQuery('#pCl').css('display','none');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar').addClass('cn-bar-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-nav-content_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').addClass('cn-nav-content-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-nav-content-prev, .cn-nav-content-next').css('display','none');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content .cn-nav-content-current h2').css('margin-top',respSLHeight_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/2000)
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a').hover(function(){
									jQuery(this).find('span').css({'width':'46px','height':'46px','margin':'-23px 0 0 -23px'})
									jQuery(this).find('div').css({'width':'36px','height':'36px','margin':'-18px 0 0 -18px'})

								},function(){
									jQuery(this).find('span').css({'width':'46px','height':'46px','margin':'-23px 0 0 -23px'})
									jQuery(this).find('div').css({'width':'0px','height':'0px','margin':'0px 0 0 0px'})
								})
							}else{
								jQuery('#nCl').css('display','block');
								jQuery('#pCl').css('display','block');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar').removeClass('cn-bar-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-nav-content_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').removeClass('cn-nav-content-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-nav-content-prev, .cn-nav-content-next').css('display','block');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content .cn-nav-content-current h2').css('margin-top','10px')
							}
							if(jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=300){
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-prev').css('left','0px');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-next').css('right','0px');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content').addClass('cn-nav-content-anim2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css("max-width","calc(100% - 46px)");
							}else{
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-prev').css('left','35px');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav a.cn-nav-next').css('right','35px');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .cn-bar .cn-nav-content').removeClass('cn-nav-content-anim2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
								jQuery('.cn-slideshow_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css("max-width","100%");
							}
						}

						var array_circle<?php echo $Rich_Web_Slider; ?>=[];
						jQuery(".rw_circle_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
							array_circle<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
						})

						var y_circle<?php echo $Rich_Web_Slider; ?>=0;
						
						for(i=0;i<array_circle<?php echo $Rich_Web_Slider; ?>.length;i++){
							jQuery("<img class='RW_Fashion_IMG<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_circle<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   		 	y_circle<?php echo $Rich_Web_Slider; ?>++;
					   			 if(y_circle<?php echo $Rich_Web_Slider; ?> == array_circle<?php echo $Rich_Web_Slider; ?>.length){
					   			 	jQuery(".wrapper<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
					   			 	jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   			}
					   		})
					   	}



						// jQuery(window).load(function(){
							resp();
						// })
						jQuery(window).resize(function(){
							resp();
						})
					})
				</script>
		    <?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Slider Carousel'){ ?>
				<link href="<?php echo plugins_url('/Style/Slider_Carousel.css',__FILE__);?>" rel="stylesheet" type="text/css">
				<?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
				<style type="text/css">
					.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_BgC; ?> !important;
						z-index:999;
						width:100%;
						height:200px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>


					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T3_BgC; ?> !important;
						}
					}

					.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						outline: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BC;?>;
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShShow=='true'){ ?>
							<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShType=='true'){ ?>
								-webkit-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
								-moz-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
								box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
							<?php }else { ?>
								-webkit-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
								-moz-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
								box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_BoxShC;?>;
							<?php }?>
						<?php }?>
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW;?>px;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_ICBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_ICBS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_ICBC;?>;
						box-sizing:border-box !important;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background: transparent;
						cursor: pointer;
						position: relative;
						margin:0px !important;
						padding:0px !important;
					}
					li.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before{
						content: ' ' !important;
						display: none;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						/*opacity: .5;*/
					}
					.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBR;?>px;
						box-sizing:border-box !important;
					}
					.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						width: 100%;
						margin: 0 !important;
						padding: 0;
					}
					.your-item-pic-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IH;?>px !important;
					}
					.your-item-title_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TC;?>;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TBgC;?>;
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TFS;?>px;
						font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TFF;?>;
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TFS+10;?>px;
						line-height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_TFS+10;?>px;	
					}
					.your-item-title_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						width: 100%;
						text-align: center;	
						margin-top: 0px !important;
						box-sizing:border-box !important;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .your-item-title_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_THC;?>;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_THBgC;?>;
					}
					.Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						position: fixed;
						height: 100%;
						width: 0%;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_OC;?>;
						top: 0;
						left: 0;
						z-index: 9999999;
						cursor: pointer;
					}
					.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						top:10%;
						left:10%;
						right:10%;
						width:700px;
						height:500px;
						margin: auto;
						position: fixed;
						z-index: 9999999;
						-webkit-transform: translateX(5200px);
					    -moz-transform: translateX(5200px);
					    -o-transform: translateX(5200px);
					    -ms-transform: translateX(5200px);
					    transform: translateX(5200px);
					    -webkit-transition: all 0.7s ease-in-out;
                        -moz-transition: all 0.7s ease-in-out;
                        -o-transition: all 0.7s ease-in-out;
                        -ms-transition: all 0.7s ease-in-out;
                        transition: all 0.7s ease-in-out;
						cursor: pointer;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BW;?>px solid <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BC;?>;
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShShow=='true'){ ?>
							<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShType=='true'){ ?>
								-webkit-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
								-moz-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
								box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
							<?php }else { ?>
								-webkit-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
								-moz-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
								box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC;?>;
							<?php }?>
						<?php }?>
					}
					.Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						width: 100%;
						height: 100% !important;
						margin: 0;
						padding: 0;
						cursor: pointer;
					}
					.Rich_Web_PSlider_SC_PCI_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS;?>px;
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_C;?>;
						position: absolute;
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 30 && $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS < 35){ ?>
							top: -20px;
							right: -15px;
						<?php } else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 35 && $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS < 40){ ?>
							top: -22px;
							right: -16px;
						<?php } else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 40 && $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS < 45){ ?>
							top: -25px;
							right: -19px;
						<?php } else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 45){ ?>
							top: -27px;
							right: -21px;
						<?php } else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 25 && $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS < 30){ ?>
							top: -16px;
							right: -13px;
						<?php } else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS >= 20 && $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_FS < 25){ ?>
							top: -13px;
							right: -11px;
						<?php } else { ?>
							top: -9px;
							right: -7px;
						<?php }?>
					}
					.Rich_Web_PSlider_SC_PCI_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover
					{
						opacity: 0.8;
					}
					/*.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						position: absolute;
						top: 35%;
						width: 100%;
						height: 50px; 
						line-height: 50px;
						text-align: center;
					}*/
					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a
					{
						box-shadow:none !important;
						text-decoration: none !important;
						-webkit-transition: all 0.3s ease-in-out;
                        -moz-transition: all 0.3s ease-in-out;
                        -o-transition: all 0.3s ease-in-out;
                        -ms-transition: all 0.3s ease-in-out;
                        transition: all 0.3s ease-in-out;
					}
					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a:hover
					{
						text-decoration: none !important;
					}
					.Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, .Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_C;?> !important;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_BgC;?> !important;
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_FS;?>px !important;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_BC;?> !important;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_BR;?>px !important;
						padding: 5px 7px 5px 12px;
					}
					.Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover, .Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_HC;?> !important;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_HBgC;?> !important;
					}
					.Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_FF;?> !important;
						padding: 5px 10px 5px 10px !important;
					}
					.Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, .Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_C;?> !important;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_BgC;?> !important;
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_FS;?>px !important;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_BC;?> !important;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_BR;?>px !important;
						padding: 5px 7px 5px 7px;
					}
					.Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover, .Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_HC;?> !important;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_HBgC;?> !important;
					}
					.Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_FF;?> !important;
						padding: 5px 10px 5px 10px !important;
					}
					.Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, .Rich_Web_PSlider_SC_ArrText
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_C;?> !important;
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_BgC;?> !important;
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_FS;?>px !important;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_BC;?> !important;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_BR;?>px !important;
						padding: 5px 7px 5px 7px;
						outline:none !important;
						outline-offset: 0px !important;
						box-shadow:none !important;
					}
					.Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover, .Rich_Web_PSlider_SC_ArrText:hover
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_HC;?> !important;
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_HBgC;?> !important;
					}
					.Rich_Web_PSlider_SC_ArrText
					{
						font-family:  <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_FF;?> !important;
					}
					.slider-arrow_left_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						left: 5px;
						top: 35%;
						cursor:pointer !important;
					}
					.slider-arrow_right_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top: 35%;
						right: 5px;
					}

					.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul{
						width:<?php print count($Rich_Web_Slider_Images)*($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW) ?>px !important;
						left:0;
						position:relative !important;
					}
					
					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:relative;
						width:<?php print $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW; ?>px;
						height:<?php print $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IH; ?>px;
						box-sizing:border-box;
					}



					<?php if( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "1" ) { ?>
					/*effect 1*/

					.rw_hov_div1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						opacity:0;
						transition:opacity 0.4s ease-in-out;
						-webkit-transition:opacity 0.4s ease-in-out;
						-ms-transition:opacity 0.4s ease-in-out;
						-moz-transition:opacity 0.4s ease-in-out;
						-o-transition:opacity 0.4s ease-in-out;
					}
					
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:1;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:relative;
						top:-100%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
						transition:top 0.4s ease-in-out;
						-webkit-transition:top 0.4s ease-in-out;
						-ms-transition:top 0.4s ease-in-out;
						-moz-transition:top 0.4s ease-in-out;
						-o-transition:top 0.4s ease-in-out;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:50%;
					}
					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "2" ){ ?>

					/*Effect 2*/

					.rw_hov_div2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						width:100%;
						height:100%;
						top:0px;
						left:0px;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						transform:scale(0,0);
						-webkit-transform:scale(0,0);
						-ms-transform:scale(0,0);
						-moz-transform:scale(0,0);
						-o-transform:scale(0,0);
						transition:transform 0.6s ease 0s;
						-webkit-transition:transform 0.6s ease 0s;
						-ms-transition:transform 0.6s ease 0s;
						-moz-transition:transform 0.6s ease 0s;
						-o-transition:transform 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						transform:scale(1,1);
						-webkit-transform:scale(1,1);
						-ms-transform:scale(1,1);
						-moz-transform:scale(1,1);
						-o-transform:scale(1,1);
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:relative;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "3" ){ ?>
					/*Effect 3*/

					.rw_hov_div3_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						width:100%;
						height:100%;
						top:-100%;
						left:0px;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						transition:top 0.4s ease 0s;
						-webkit-transition:top 0.4s ease 0s;
						-ms-transition:top 0.4s ease 0s;
						-moz-transition:top 0.4s ease 0s;
						-o-transition:top 0.4s ease 0s;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div3_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:0px;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:relative;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "4" ){ ?>

					/*Effect 4*/

					.rw_hov_div4_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						width:100%;
						height:100%;
						top:0px;
						left:0px;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						transform:scale(0,0);
						-webkit-transform:scale(0,0);
						-ms-transform:scale(0,0);
						-moz-transform:scale(0,0);
						-o-transform:scale(0,0);
						transition:transform 0.6s ease 0s;
						-webkit-transition:transform 0.6s ease 0s;
						-ms-transition:transform 0.6s ease 0s;
						-moz-transition:transform 0.6s ease 0s;
						-o-transition:transform 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div4_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						transform:scale(1,1);
						-webkit-transform:scale(1,1);
						-ms-transform:scale(1,1);
						-moz-transform:scale(1,1);
						-o-transform:scale(1,1);
					}

					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IBC;?> !important;
						overflow:hidden !important;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:relative;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						border:none !important;
						transform:scale(1,1);
						-webkit-transform:scale(1,1);
						-ms-transform:scale(1,1);
						-moz-transform:scale(1,1);
						-o-transform:scale(1,1);
						transition:transform 0.6s linear;
						-webkit-transition:transform 0.6s linear;
						-ms-transition:transform 0.6s linear;
						-moz-transition:transform 0.6s linear;
						-o-transition:transform 0.6s linear;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						transform:scale(1.2,1.2);
						-webkit-transform:scale(1.2,1.2);
						-ms-transform:scale(1.2,1.2);
						-moz-transform:scale(1.2,1.2);
						-o-transform:scale(1.2,1.2);
					}
					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "5" ){ ?>

					/*Effect 5*/

					.rw_hov_div5_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						width:100%;
						height:100%;
						top:0px;
						left:0px;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						opacity:1;
						transition:opacity 0.6s ease 0s;
						-webkit-transition:opacity 0.6s ease 0s;
						-ms-transition:opacity 0.6s ease 0s;
						-moz-transition:opacity 0.6s ease 0s;
						-o-transition:opacity 0.6s ease 0s;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div5_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:0;
					}
					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute;
						top:100%;
						left:50%;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
						transition:top 0.3s linear;
						-webkit-transition:top 0.3s linear;
						-ms-transition:top 0.3s linear;
						-moz-transition:top 0.3s linear;
						-o-transition:top 0.3s linear;
					}
					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						overflow:hidden !important;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:60%;
					}

					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "6" ){ ?>

					/*Effect 6*/

					.rw_hov_div6_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position: absolute;
						top:50%;
						left:50%;
						width:100%;
						height:100%;
						opacity:0;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						perspective-origin: 800px;
						transition:all 0.6s ease 0s;
						-webkit-transition:all 0.6s ease 0s;
						-ms-transition:all 0.6s ease 0s;
						-moz-transition:all 0.6s ease 0s;
						-o-transition:all 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div6_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:1;
						width:80%;
						height:80%;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute !important;
						top:-100%;
						left:50%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition:top 0.3s ease 0s;
						-webkit-transition:top 0.3s ease 0s;
						-ms-transition:top 0.3s ease 0s;
						-moz-transition:top 0.3s ease 0s;
						-o-transition:top 0.3s ease 0s;
					}
					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:50%;
					}

					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "7" ){ ?>

					/*Effect 7*/

					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						overflow:hidden !important;
					}

					.rw_hov_div7_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						top:0;
						left:0;
						width:100%;
						height:100%;
						transition:all 0.6s ease 0s;
						-webkit-transition:all 0.6s ease 0s;
						-ms-transition:all 0.6s ease 0s;
						-moz-transition:all 0.6s ease 0s;
						-o-transition:all 0.6s ease 0s;
					}

					.rw_hov_div7_1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						left:-100%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
					}
					.rw_hov_div7_2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						top:100%;
						opacity:0.5;
						transform:translateY(50%) translateX(-50%);
						-webkit-transform:translateY(50%) translateX(-50%);
						-ms-transform:translateY(50%) translateX(-50%);
						-moz-transform:translateY(50%) translateX(-50%);
						-o-transform:translateY(50%) translateX(-50%);
					}
					.rw_hov_div7_3_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						left:100%;
						transform:translateY(50%) translateX(50%);
						-webkit-transform:translateY(50%) translateX(50%);
						-ms-transform:translateY(50%) translateX(50%);
						-moz-transform:translateY(50%) translateX(50%);
						-o-transform:translateY(50%) translateX(50%);
					}
					.rw_hov_div7_4_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						top:-100%;
						opacity:0.5;
						transform:translateY(-50%) translateX(50%);
						-webkit-transform:translateY(-50%) translateX(50%);
						-ms-transform:translateY(-50%) translateX(50%);
						-moz-transform:translateY(-50%) translateX(50%);
						-o-transform:translateY(-50%) translateX(50%);
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div7_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						left: 0px !important;
						top: 0px !important
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute !important;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition:opacity 0.6s ease 0s;
						-webkit-transition:opacity 0.6s ease 0s;
						-ms-transition:opacity 0.6s ease 0s;
						-moz-transition:opacity 0.6s ease 0s;
						-o-transition:opacity 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:1;
					}

					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "8" ){ ?>

					/*Effect 8*/

					.rw_hov_div8_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position: absolute;
						top:0;
						left:0;
						width:100%;
						height:100%;
						opacity:0;
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
						transition:opacity 0.6s ease 0s;
						-webkit-transition:opacity 0.6s ease 0s;
						-ms-transition:opacity 0.6s ease 0s;
						-moz-transition:opacity 0.6s ease 0s;
						-o-transition:opacity 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div8_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:1;
					}

					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						overflow:hidden !important;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:right;
						position:absolute !important;
						top:150%;
						left:95%;
						opacity:1;
						width:100%;
						transform:translateY(-100%) translateX(-100%);
						-webkit-transform:translateY(-100%) translateX(-100%);
						-ms-transform:translateY(-100%) translateX(-100%);
						-moz-transform:translateY(-100%) translateX(-100%);
						-o-transform:translateY(-100%) translateX(-100%);
						transition:top 0.6s ease 0s;
						-webkit-transition:top 0.6s ease 0s;
						-ms-transition:top 0.6s ease 0s;
						-moz-transition:top 0.6s ease 0s;
						-o-transition:top 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:95%;
					}

					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "9" ){ ?>

					/*Effect 9*/

					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						overflow:hidden !important;
					}
					.rw_hov_div9_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background:<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;	
						transition:all 0.6s ease 0s;
						-webkit-transition:all 0.6s ease 0s;
						-ms-transition:all 0.6s ease 0s;
						-moz-transition:all 0.6s ease 0s;
						-o-transition:all 0.6s ease 0s;
					}
					.rw_hov_div9_1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position: absolute;
						top:-100%;
						left:-100%;
						width:100%;
						height:100%;
					}
					.rw_hov_div9_2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position: absolute;
						top:100%;
						left:100%;
						width:100%;
						height:100%;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div9_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top: 0 !important;
						left: 0 !important;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute !important;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition:opacity 0.6s ease 0s;
						-webkit-transition:opacity 0.6s ease 0s;
						-ms-transition:opacity 0.6s ease 0s;
						-moz-transition:opacity 0.6s ease 0s;
						-o-transition:opacity 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:1;
					}

					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "10" ){ ?>

					/*Effect 10*/

					.rw_hov_div10_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position:absolute;
						width:100%;
						height:100%;
						top:0px;
						left:0px;
						box-sizing:border-box;
						border-bottom: 0px solid <?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
   						border-left: 300px solid transparent;
   						-webkit-transition:all 0.6s ease 0s;
						-ms-transition:all 0.6s ease 0s;
						-moz-transition:all 0.6s ease 0s;
						-o-transition:all 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rw_hov_div10_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						border-bottom: 90px solid <?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_H_OvC; ?>;
					}

					.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						overflow:hidden !important;
					}

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute !important;
						top:150%;
						left:98%;
						width:100%;
						text-align:right !important;
						opacity:1;
						transform:translateY(-100%) translateX(-100%);
						-webkit-transform:translateY(-100%) translateX(-100%);
						-ms-transform:translateY(-100%) translateX(-100%);
						-moz-transform:translateY(-100%) translateX(-100%);
						-o-transform:translateY(-100%) translateX(-100%);
						transition:top 0.6s ease 0s;
						-webkit-transition:top 0.6s ease 0s;
						-ms-transition:top 0.6s ease 0s;
						-moz-transition:top 0.6s ease 0s;
						-o-transition:top 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						top:98%;
					}
					<?php }elseif( $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "11" ){ ?>

					/*Default*/

					.Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:center;
						position:absolute !important;
						top:50%;
						left:50%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition:opacity 0.6s ease 0s;
						-webkit-transition:opacity 0.6s ease 0s;
						-ms-transition:opacity 0.6s ease 0s;
						-moz-transition:opacity 0.6s ease 0s;
						-o-transition:opacity 0.6s ease 0s;
					}

					.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						opacity:0.5;
					}

					<?php } ?>





					@media screen and (max-width:700px){
						.Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, .Rich_Web_PSlider_SC_ArrText{
							cursor:default;
						}
					}
				</style>
				<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				
				<div class="your-slider-wrap your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style="display: none;"> 
					<a class="Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> slider-nav-arrow slider-arrow_left_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> slider-nav-arrow_disable" href="javascript:void(0)">
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Type=='text'){ ?>
							<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Prev;?>
						<?php }else{ ?>
							<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_IType;?>-left'></i>
						<?php }?>
					</a> 
					<a class="Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> slider-nav-arrow slider-arrow_right_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" href="javascript:void(0)">
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Type=='text'){ ?>
							<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Next;?>
						<?php }else{ ?>
							<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_IType;?>-right'></i>
						<?php } ?>
					</a>
					<div class="your-slider responsiveSlider responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
					    <ul>
					    	<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
					    		<li class="your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"> 
					    			<div class="rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?> box">
					    				<img src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="" class="your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
					    				<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "1" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "2" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "3" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "4") { ?>
					    					<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
						    					<div class="Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
											        <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
											        	<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Type=='text'){ ?>
											        		<a class="Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
											        			<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Text;?>
											        		</a>	
											        	<?php }else{ ?>
											        		<a class="Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
											        			<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_IType;?>'></i>
											        		</a>								        	
											        	<?php }?>
											        <?php }?>
										        	<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Type=='text'){ ?>
										        		<a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>('<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>')"  style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
										        			<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Text;?>
										        		</a>
										        	<?php }else{ ?>
										        		<a class="Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>('<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>')"  style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
										        			<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_IType;?>'></i>
										        		</a>
										        	<?php } ?>   
										        </div>
							    			</div>
					    				<?php }else{ ?>
					    					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "5" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "6" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "8" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "10") { ?>
						    					<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
						    					
							    				</div>
						    				<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "7") { ?>
						    					<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
							    				<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
							    				<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_3_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
							    				<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_4_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
						    				<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "9"){ ?>
						    					<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_1_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
							    				<div class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT; ?>_2_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>
						    				<?php }?>
						    				<div class="Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
											        <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
											        	<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Type=='text'){ ?>
											        		<a class="Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
											        			<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Text;?>
											        		</a>	
											        	<?php }else{ ?>
											        		<a class="Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
											        			<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_IType;?>'></i>
											        		</a>								        	
											        	<?php }?>
											        <?php }?>
										        	<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Type=='text'){ ?>
										        		<a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>('<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>')"  style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
										        			<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Text;?>
										        		</a>
										        	<?php }else{ ?>
										        		<a class="Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>('<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>')"  style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
										        			<i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_IType;?>'></i>
										        		</a>
										        	<?php } ?>   
										        </div>
					    				<?php } ?>
					    			</div>
							        <div class="your-item-title_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></div>
							    </li>
	                    	<?php } ?>	  
					    </ul>
					</div>
					<div class="Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)"></div>
					<div class="Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)">
						<i class='Rich_Web_PSlider_SC_PCI_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_Type;?>' onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)"></i>
						<img src=""  class="Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
					</div>
				</div>	
				<input type='text' style='display:none;' class='yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW;?>'>
				<input type='text' style='display:none;' class='yith_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IH;?>'>
				<input type="text" style="display:none;" class="ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" value="<?php print count($Rich_Web_Slider_Images)*($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW) ?>">
				<input type="text" style="display:none" name="" class="rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" value="<?php print count($Rich_Web_Slider_Images); ?>">
				<script>
					jQuery(document).ready(function(){
						var yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> =jQuery('.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var yith_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> =jQuery('.yith_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						function resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(){
							if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>){
								jQuery('.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width());
								jQuery('.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*yith_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
								jQuery('.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').removeClass('your-item-pic-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
							}else if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()>yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>){
								jQuery('.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
								jQuery('.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',yith_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
								jQuery('.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').addClass('your-item-pic-anim_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>');
							}
							
							if( parseInt(jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()) >= parseInt(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").width()) ){
								;
								jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").width());
								jQuery(".Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").css('display','none');
							}else{
								jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',"100%");
								jQuery(".Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").css('display','block');
							}
							jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',600*jQuery(window).width()/1000+'px');
							jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',400*jQuery(window).width()/1000+'px');
						}

						var array_carousel<?php echo $Rich_Web_Slider; ?>=[];
						jQuery(".your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
							array_carousel<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
						})

						var y_carousel<?php echo $Rich_Web_Slider; ?>=0;

						var yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=0;
						var rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=0;
						var ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?> =0;
						var width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=0;

						function best<?php echo $Rich_Web_Slider; ?>(){
					   		if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=parseInt(jQuery('.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val())){
					   			yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=parseInt(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").parent().width());
					   		}else if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()>parseInt(jQuery('.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val())){yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=parseInt(jQuery(".yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").val()); 		 
					   		}	
					   		rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery(".rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").val());	
					   		if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>){
					   			jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("max-width",rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
					   			ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = parseInt(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("max-width")); 
					   		}else if(jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()>yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>){
					   			ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=parseInt(jQuery(".ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").val());
					   			// jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("max-width",'10000px');
					   		}
							width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=parseInt(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").width());
						}
						var next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "";
						var prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "";
						function nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(){
							if( (jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left+ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)-(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left+width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)<yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> && (jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left+ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)-(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left+width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)>0 ){
								next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "true";
							} else if( (jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left+ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)-(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left+width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>) == 0 ) {
								next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "false";
							} else {
								next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "trueFalse";
							}

							if( jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left-jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left == 0 ) {
								prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "true";
							}else if( jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left-jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left < 0 && jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left-jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left > -yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ){
								prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "false";
							} else {
								prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = "trueFalse";
							}
							// console.log(ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
						}
						function next_anim(){
							if( next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "true" ){
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left","-="+((jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left+ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)-(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left+width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>))+"");
							} else if( next<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "false" ) {
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left","0px");
							} else {
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left","-="+yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>+"");
							}
						}

						function prev_anim(){
							if( prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "true" ) {
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left",jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left-ul_width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>+width<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").offset().left)
							}else if( prev<?php echo $Rich_Web_Slider_Manager[0]->id; ?> == "false" ){
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left","0");
							} else {
								jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").css("left","+="+yitw_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>+"");
							}
							// console.log(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul").offset().left);
						}
						for(i=0;i<array_carousel<?php echo $Rich_Web_Slider; ?>.length;i++){
							jQuery("<img class='your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_carousel<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
								// jQuery(".RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   		 	y_carousel<?php echo $Rich_Web_Slider; ?>++;
					   			if(y_carousel<?php echo $Rich_Web_Slider; ?> == array_carousel<?php echo $Rich_Web_Slider; ?>.length){
					   				setTimeout(function(){
					   			 		resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
					   			 	},100)
					   			 	jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   			 	jQuery(".your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
					   			 	best<?php echo $Rich_Web_Slider; ?>();
					   			}
					   		})
					   	}
					   	
					   	jQuery(".slider-arrow_right_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").click(function(){
					   		nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>()
							next_anim();
						})
						jQuery(".slider-arrow_left_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").click(function(){
							nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>()
							prev_anim();
						})

						// setTimeout(function(){
						// 	resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
						// 	best<?php echo $Rich_Web_Slider; ?>();
						// 	nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>()
						// },1000)
							
					
						
						jQuery(window).resize(function(){
							resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
							best<?php echo $Rich_Web_Slider; ?>();
							nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id; ?>()
						})
					})
				</script>
				<script type="text/javascript">
				 function Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(PSlider_Src)
					{
						jQuery('.Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').animate({'width':'100%'},500);
						jQuery('.Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').attr('src',PSlider_Src);
						jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
					}
					function Rich_Web_PSlider_SC_Close_Popup(a)
					{
						jQuery('.Rich_Web_PSlider_SC_Popup_Image_'+a+'').css({'transform':'translateX(5200px)','-ms-transform': 'translateX(5200px)', '-o-transform': 'translateX(5200px)','-moz-transform': 'translateX(5200px)','-webkit-transform': 'translateX(5200px)'});
						setTimeout(function(){
							jQuery('.Rich_Web_PSlider_SC_Popup_Photo_'+a+'').attr('src','');
							jQuery('.Rich_Web_PSlider_SC_Popup_'+a+'').animate({'width':'0'},500);
						},200)	
					}
				</script>
			<?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Flexible Slider'){ ?>
				<?php 
					if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='angle-double'){ $Rich_Web_Slider_FlS_L='\f100'; $Rich_Web_Slider_FlS_R='\f101'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='angle'){ $Rich_Web_Slider_FlS_L='\f104'; $Rich_Web_Slider_FlS_R='\f105'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='arrow-circle'){ $Rich_Web_Slider_FlS_L='\f0a8'; $Rich_Web_Slider_FlS_R='\f0a9'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='arrow-circle-o'){ $Rich_Web_Slider_FlS_L='\f190'; $Rich_Web_Slider_FlS_R='\f18e';	}
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='arrow'){ $Rich_Web_Slider_FlS_L='\f060'; $Rich_Web_Slider_FlS_R='\f061'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='caret'){ $Rich_Web_Slider_FlS_L='\f0d9'; $Rich_Web_Slider_FlS_R='\f0da'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='caret-square-o'){ $Rich_Web_Slider_FlS_L='\f191';	$Rich_Web_Slider_FlS_R='\f152';	}
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='chevron-circle'){ $Rich_Web_Slider_FlS_L='\f137';	$Rich_Web_Slider_FlS_R='\f138';	}
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='chevron'){ $Rich_Web_Slider_FlS_L='\f053'; $Rich_Web_Slider_FlS_R='\f054'; }
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='hand-o'){ $Rich_Web_Slider_FlS_L='\f0a5';	$Rich_Web_Slider_FlS_R='\f0a4';	}
					else if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type=='long-arrow'){ $Rich_Web_Slider_FlS_L='\f177';	$Rich_Web_Slider_FlS_R='\f178';	}
				?>
				<link href="<?php echo plugins_url('/Style/mislider.css',__FILE__);?>" rel="stylesheet">
			    
			   
			    <?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
			    <style type="text/css">
			    	.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_BgC; ?> !important;
						z-index:999;
						width:100%;
						height:200px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T3_BgC; ?> !important;
						}
					}
	
					a:focus {
						outline: none !important;
					}
					
					
					.mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						width: 100%;
					   
						padding: 0;
						display: block;
						position: relative;
						float: left;
						overflow: visible !important;
					}
					.js .mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						display: none;
						opacity: 0;
					}
					.mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before{
						display:none !important
					}
					.mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.mis-current {
						z-index: 100;
						display: block;
					}
					.mis-stage, .mis-slider, .mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>, .mis-container, .mis-container * {
						-webkit-box-sizing: border-box;
						-moz-box-sizing: border-box;
						box-sizing: border-box;
						margin: 0;
						padding: 0;
					}
					

			    	.mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
			    	{
			    		background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_BgC;?>;
    					margin-top: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_H/2;?>px !important;
						margin-left: 0px !important;
						margin-right: 0px !important;
						margin-bottom: 0px !important;
						padding:0px !important;
			    	}
					.mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						display: block;
						width: auto;
						height: auto;
						border: 0;
					}
			    	.mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li img 
			    	{
					    max-width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_W;?>px;
					    width: 100%;
					    display: inline;
					    border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BR;?>px;
					    border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BC;?>;
					    height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_H;?>px;
					    margin: 0;
					    filter:none !important;
					    -webkit-filter:none !important;
					    -ms-filter:none !important;
					    -moz-filter:none !important;
					    -o-filter:none !important;
					    <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShShow=='true'){ ?>
						    <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShType=='true'){ ?>
								-webkit-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
								-moz-box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
								box-shadow: 0 30px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px -18px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
						    <?php }else{ ?> <?php ?>
						    	-webkit-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
								-moz-box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
								box-shadow: 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_BoxShC;?>;
						    <?php }?>
						<?php }?>
					}
					.entry-content li, .comment-content li, .mu_register li{
						margin:0px;
					}
					.mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>
					{
						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_W+80;?>px;
    					height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_H+90;?>px;
    					
    					margin-top: -<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_I_H/2-40;?>px !important;
    					padding:0px !important;
					}
					.mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li span, .mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a figure
					{
    					color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_T_C;?> !important;
    					font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_T_FF;?> !important;
					}
					.mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li span, .mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a{
						box-shadow:none !important;
						border:none !important;
					}
					.entry-content ol li, .entry-content ul li{
						margin-left:0px;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a 
					{
						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_W;?>px;
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_H;?>px;
   						margin: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_PB;?>px;
   						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_BC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_BR;?>px;
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_C;?>;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li.mis-current a
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_CC;?>;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a:hover 
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_HC;?>;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_C;?> !important;
						border:none !important;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.mis-prev:before, .mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.mis-next:after {
					    content: "<?php echo $Rich_Web_Slider_FlS_L;?>"; 
					    display: block;
					    font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_S;?>px;
					    text-indent: 0;
						border:none !important;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.mis-next:after {
					    content: "<?php echo $Rich_Web_Slider_FlS_R;?>"; 
						border:none !important;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position: absolute;
						top: 0px;
						width: 100%;
						margin: 0 auto !important;
						z-index: 300;
						padding: 0px !important;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li {
						display: inline-block;
						margin:0px !important;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li:before, li.mis-slide:before
					{
						content: '' !important;
					}
					.mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li a {
						display: block;
						text-indent: 100%;
						overflow: hidden;
						white-space: nowrap;
						box-shadow:none !important;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						display: block;
						position: absolute;
						height: 0;
						top: 0;
						opacity: 0.5;
						z-index: 200;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a {
						position: absolute;
						font-size: 0;
						line-height: .01; 
						font-family: FontAwesome;
						font-weight: bold;
						text-decoration: none;
						text-indent: -9999px; 
						box-shadow:none !important;
						z-index:2;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a:hover {
						opacity: .8;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.mis-next {
						left: auto;
						right: 3px;
						border:none !important;
						padding-left:25px !important;
					}
					.mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.mis-prev {
						left: 4px;
						border:none !important;
						padding-right:25px !important;
					}
					@media screen and (max-width:700px){
						.mis-nav-buttons_1 a{
							cursor:default !important;
						}
						.mis-slider li a{
							cursor:default !important;
						}
					}
			    </style>
			    <div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>"  style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<figure class="rw_fl_slider_figure<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style="height:0px; overflow:hidden;">
				    <div class="mis-stage mis-stage_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
				        <ol class="mis-slider mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
				            <?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
	                    		 <li class="mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
					                <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url != ''){ ?>
	                    				<a href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>" class="mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
						                    <figure>
						                        <img class="rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>">
						                        <figcaption><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></figcaption>
						                    </figure>
						                </a>
	                    			<?php }else{ ?>
	                    				<span class="mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>">
						                    <figure>
						                        <img class="rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>">
						                        <figcaption><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></figcaption>
						                    </figure>
						                </span>
	                    			<?php }?>	
					            </li>							
	                    	<?php } ?>	  
				        </ol>
				    </div>
				</figure>
				<input type='text' style='display:none;' class='RW_SL_Number' value='<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>

				<script type="text/javascript">
				jQuery(document).ready(function(){


					var array_flexible<?php echo $Rich_Web_Slider; ?>=[];
					jQuery(".rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
						array_flexible<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
					})

					var y_flexible<?php echo $Rich_Web_Slider; ?>=0;
						
					for(i=0;i<array_flexible<?php echo $Rich_Web_Slider; ?>.length;i++){
						jQuery("<img class='RW_Fashion_IMG<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_flexible<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   	 	y_flexible<?php echo $Rich_Web_Slider; ?>++;
					   		if(y_flexible<?php echo $Rich_Web_Slider; ?> == array_flexible<?php echo $Rich_Web_Slider; ?>.length){
					   			
					   			 
					   			  var slider = jQuery('.mis-stage_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').miSlider({
						               	speed: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_TS;?>,
										pause: <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_AP=='true'){ echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_PT*1000;}else{ echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_AP;} ?>,
										increment: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SS;?>,
										slidesOnStage: <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SVis=='true'){ echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_CS;}else{ echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SVis;} ?>,
										slidesContinuous: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SLoop;?>,
										slidePosition: "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SlPos;?>",
										slideScaling: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SSc;?>,
										navList: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Nav_Show;?>,
										navButtons: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Show;?>,
										navButtonsShow: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_ShNavBut;?>,
										classNavButtons: "mis-nav-buttons_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
										classNavList: "mis-nav-list_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
										classSlide: "mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
										classStage: "mis-stage_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
										classSlider: "mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
										//selectorSlide: "mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",
						            });
					   			
					   				jQuery(".rw_fl_slider_figure<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").css("height","auto");
					   				jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();   			
					   		}
					   	})
					}
				})
				</script>
				<script src="<?php echo plugins_url('/Scripts/mislider.js',__FILE__);?>"></script>
			<?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Dynamic Slider'){ ?>			<?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
				<style type="text/css">
					.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_BgC; ?> !important;
						z-index:999;
						width:100%;
						height:200px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T3_BgC; ?> !important;
						}
					}




















					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> 
					{
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_BC;?>;
						max-width: 99% !important;
    					margin: 15px auto !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						text-align:justify !important;
					}
					
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2 
					{
					 	font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_TFS;?>px !important;
					  	color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_TC;?> !important;
					  	font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_TFF;?>;
					  	text-transform:none !important;
					  	letter-spacing:0px !important;
					  	text-align:justify !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p 
					{
					  	font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DFS;?>px;
					  	color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DC;?>;
					  	font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DFF;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LFS;?>px;
					  	color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LC;?>;
					  	font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LFF;?>;
					  	background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LBgC;?>;
					  	border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LBW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LBS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LBC;?>;
					  	border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LBR;?>px;
					  	display: inline-block;
					  	padding: 5px 10px;
					  	text-decoration: none;
					  	margin: auto;
					  	line-height: 1;
					  	cursor: pointer;
					  	box-shadow:none !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a:hover
					{
					  	color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LHC;?>;
					  	background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LHBgC;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button 
					{
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_C;?>;
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_BgC;?> !important;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_BC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_BR;?>px;
						letter-spacing: 0px;

					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button:focus
					{
						outline: none !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span:hover button {
					 	color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_HC;?>;
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_HBgC;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button 
					{
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_H;?>px;
  						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_W;?>px;
  						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_BC;?>;
  						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_BR;?>px;
  						margin-right: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_PB;?>px;
  						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_C;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button.active 
					{
  						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_CC;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button:hover 
					{
  						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Nav_HC;?>;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  overflow: hidden;
					  width: 100%;
					  position: relative;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  width: <?php echo (count($Rich_Web_Slider_Images)+1)*100;?>%;
					  overflow: hidden;
					  display: block;
					  overflow: hidden;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before {
					  content: " ";
					  display: block;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  float: left;
					  overflow: hidden;
					  position: relative;
					  display: block;
					  overflow: hidden;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before {
					  content: " ";
					  display: block;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  position: absolute;
					  top: 0;
					  left: 0;
					  width: 100%;
					  height: 100%;
					 
					  background-position: center center;
					  z-index: 0;
					}
					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_ImgT == "Type 1") { ?>
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
							background-size: 100% 100%;
						}
					<?php } else { ?>
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
							background-size: cover;
						}
					<?php } ?>
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  padding: 0px 80px !important;
					  max-width: 1200px;
					  margin: auto;
					  width: 100%;
					  position: relative;
					  z-index: 2;
					  top: 50%;
					  left: 0;
					  -webkit-transform: translate(0, -50%);
					  -ms-transform: translate(0, -50%);
					  transform: translate(0, -50%);
					  display: block;
					  overflow: hidden;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before {
					  content: " ";
					  display: block;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  position: absolute;
					  top: 0;
					  left: 0;
					  width: 100%;
					  height: 100%;
					  display: block;
					  z-index: 1;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  padding: 20px;
					  position: absolute;
					  bottom: 0;
					  left: 50%;
					  -webkit-transform: translate(-50%, 0);
					  -ms-transform: translate(-50%, 0);
					  transform: translate(-50%, 0);
					  z-index: 2;
					  display: block;
					  overflow: hidden;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before {
					  content: " ";
					  display: block;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button {
					  float: left;
					  cursor: pointer;
					  margin-bottom: 5px;
					  padding: 0;
					  outline:none !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button:last-of-type {
					  margin-right: 0;
					  margin-bottom: 0;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  position: absolute;
					  top: 0;
					  left: 0;
					  width: 100%;
					  height: 100%;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span {
					  padding: 10px;
					  position: absolute;
					  overflow: hidden;
					  top: 0;
					  height: 100%;
					  z-index: 3;
					  text-align: center;
					  cursor: pointer;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span:first-child {
					  left: 0;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span:last-child {
					  right: 0;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button {
					  position: relative;
					  top: 50%;
					  text-transform: none !important;
					  font-weight:100 !important;
					  -webkit-transform: translate(0, -50%);
					  -ms-transform: translate(0, -50%);
					  transform: translate(0, -50%);
					  cursor: pointer;
					  padding: 10px 5px;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.css-transitions .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  -webkit-transition: all 0.6s ease 0s;
					  transition: all 0.6s ease 0s;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.css-transitions .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  -webkit-transition: all 0.6s ease 0s;
					  transition: all 0.6s ease 0s;
					}
					.rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  height:100% !important;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.css-transitions .rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  -webkit-transition: all 0.6s ease 0s;
					  transition: all 0.6s ease 0s;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.css-transitions .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button {
					  -webkit-transition: all 0.6s ease 0s;
					  transition: all 0.6s ease 0s;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.css-transitions .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button {
					  -webkit-transition: all 0.6s ease 0s;
					  transition: all 0.6s ease 0s;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  background: rgba(0, 0, 0, 0.3);
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  position:absolute;
					  width: 100%;
					  max-width: 50%;
					  top:50%;
					  max-height:70%;
					  overflow-x:hidden;
					  padding-right:10px;
					  box-sizing:border-box;
					  transform:translateY(-50%);
					  -webkit-transform:translateY(-50%);
					  -ms-transform:translateY(-50%);
					  -moz-transform:translateY(-50%);
					  -o-transform:translateY(-50%);
					}

					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar 
					{
						width: 0.5em;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar-track 
					{
						-webkit-box-shadow: inset 0 0 6px transparent;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>::-webkit-scrollbar-thumb {
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DC;?>;
						outline: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DC;?>;
					}

					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p {
						line-height:1.3;
					}
					.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover .rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  background: rgba(0, 0, 0, 0);
					}
					.rSlider--image_RW{
						position:absolute;
						width:100%;
						height:100%;
						
					}
					@media (min-width: 0) { .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a { font-size: 0.7rem !important; } }
					@media (min-width: 800px) { .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a { font-size: 0.7rem !important; } }
					@media (min-width: 1400px) { .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p, .rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a { font-size: 1.2rem !important; } }
					@media (min-width: 0) and (max-width: 500px) { 
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> p { display: none; } 
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2 { font-size: 14px !important; } 
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a { font-size: 14px !important; } 
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {padding: 150px 80px;}
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> button { font-size: 10px;line-height:10px !important; }
					}
					@media screen and (max-width:700px){
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span{
							cursor:default !important;
						}
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span button{
							cursor:default !important;
						}
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a{
							cursor:default !important;
						}
						.rSlider--image_RW{
							cursor:default !important;
						}
						
					}
					@media screen and (max-width:600px){
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
							display:none !important;
						}
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
							top:65%;
						}
						.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> h2{
							margin:0px;
						}
					}
				</style>
				<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<div class='rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' style="display:none;">
				    <div class='rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
				    	<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
				    		<div class='rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
					        	<div class='rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
						          	<div class='slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
						          		<?php if($Rich_Web_Slider_Images[$i]->SL_Img_Title!=''){ ?>
							            	<h2><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></h2>
						          		<?php }?>
						          		<?php if($Rich_Web_Slider_Images[$i]->Sl_Img_Description!=''){ ?>
							           		<p><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->Sl_Img_Description);?></p>
						          		<?php }?>
						          		<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
							           		<a href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>" target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>"><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LT;?></a>
						          		<?php }?>
						          		
						          	</div>
						          	<div class='rSlider--image_RW' name='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>' alt='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_NewTab;?>'>

						          		</div>
						        </div>
						        <div class='rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> '><img  src='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>' /></div>
						        <div class='rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'></div>
						        <input type="text" style="display:none;" class="rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" rel="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>">
					     	</div>
				    	<?php }?>
				    </div>
				    <div class='rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'></div>
				    <div class='rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'></div>
				</div>
				<input type='text' style='display:none;' class='RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_H;?>'>
				<script type="text/javascript">
  					jQuery(document).ready(function(){
  						var array_dynamic<?php echo $Rich_Web_Slider; ?>=[];
						jQuery(".rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
							array_dynamic<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("rel"));
						})
						console.log(array_dynamic<?php echo $Rich_Web_Slider; ?>);

						var y_dynamic<?php echo $Rich_Web_Slider; ?>=0;
						
						for(i=0;i<array_dynamic<?php echo $Rich_Web_Slider; ?>.length;i++){
							jQuery("<img class='rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_dynamic<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   		 	y_dynamic<?php echo $Rich_Web_Slider; ?>++;
					   			if(y_dynamic<?php echo $Rich_Web_Slider; ?> == array_dynamic<?php echo $Rich_Web_Slider; ?>.length){
					   			 	jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
					   			 	jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   			}
					   		})
					   	}
  					})
  				</script> 
  				<script type="text/javascript">
			        (function(){
					  var pluginName  = "rSlider",
					      defaults    = {
					        currentSlide: 0,
					        defaultSlide: 0,
					        delay: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_PT*1000;?>,
					        height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_H;?>,
					        width: undefined,
					        minHeight: 150,
					        automatic: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_AP;?>,
					        dirButtons: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_Show;?>,
					        dirButtonNext: "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_RT;?>",
					        dirButtonPrev: "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_LT;?>",
					        transitions: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Tr;?>
					      };
					  var Plugin = function(context, options)
					  {
					    this.$context   = jQuery(context);
					    this.$view      = this.$context.find(".rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.$slides    = this.$view.find(".rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.$images    = this.$slides.find(".rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.$container = this.$slides.find(".rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.$dotsControls  = this.$context.find(".rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.$arrowControls  = this.$context.find(".rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");
					    this.slidesLen    = this.$slides.length;
					    this.settings = jQuery.extend(defaults, options);
					    this.w = this.settings.width || this.$context.width();
					    this.h = this.settings.height || this.$context.height();
					    this.delayTimer = undefined;
					    this.resizeTimer  = undefined;
					    this.init();
					  };
					  var pluginProto = {
					    init: function()
					    {
					      var self = this;
					      if(self.settings.currentSlide !== self.settings.defaultSlide)
					        self.setSlide(self.settings.defaultSlide)
					        self.events();
					        self.setStyle();
					        self.startAutomaticMovement();
					        self.setDotsControls();
					        self.setArrowControls();
					        self.activateButton( self.settings.currentSlide );
					        self.fixSlideHeight();
					        self.moveSlide();
					        self.setAnimations();
					    },
					    calculateMargin: function()
					    {
					      var self    = this,
					        margin  = -self.settings.currentSlide * self.w;
					      return margin;
					    },
					    startAutomaticMovement: function()
					    {
					      var self    = this,
					      moving  = function()
					      {
					        self.goToSlide(self.nextSlide());
					        self.activateButton();
					        self.moveSlide();
					      };
					      if(self.settings.automatic)
					      {
					        clearInterval(self.delayTimer);
					        self.delayTimer = setInterval(moving, self.settings.delay)
					      }
					    },
					    stopAutomaticMovement: function()
					    {
					      var self = this;
					      clearInterval(self.delayTimer);
					    },
					    setStyle: function()
					    {
					      var self = this;
					      self.setMetrics();
					      self.setBackgroundImages();
					    },
					    setBackgroundImages: function()
					    {
					      var self = this,
					          $imgs = self.$images.find("img"),
					          assignAttribute = function()
					          {
					            var $img    = jQuery(this),
					                $parent = $img.parent(),
					                attr    = $img.attr("src");
					            $parent.css({"background-image": "url('" + attr + "')"});
					          }
					      jQuery.each($imgs, assignAttribute);
					      $imgs.remove();
					    },
					    setDotsControls: function()
					    {
					      var self = this,
					          buttons = "",
					          i = 0;
					      jQuery.each(self.$images, function()
					      {
					        buttons += "<button data-slide-index='" + i + "'></button>";
					        i++;
					      });
					      self.$dotsControls.append(buttons);
					    },
					    setArrowControls: function()
					    {
					      var self = this,
					          buttons = "";
					      if(!self.settings.dirButtons) return;
					      buttons += "<span><button data-dir='prev'>" + self.settings.dirButtonPrev + "</button></span>";
					      buttons += "<span><button data-dir='next'>" + self.settings.dirButtonNext + "</button></span>";
					      self.$arrowControls.append(buttons);
					    },
					    setMetrics: function()
					    {
					      var self = this;
					      self.$slides.width(self.w);
					      if(self.settings.height && self.settings.width)
					      {
					        self.$view.height(self.h);
					        self.$context.width(self.w);
					      }
					    },
					    nextSlide: function()
					    {
					      var self = this,
					          index;
					      index = self.settings.currentSlide+1;
					      if(self.settings.currentSlide === self.slidesLen - 1) index = 0;
					      return index;
					    },
					    prevSlide: function()
					    {
					      var self  = this,
					          index = self.settings.currentSlide-1;
					      if(self.settings.currentSlide === 0) index = self.slidesLen-1;
					      return index;
					    },
					    setSlide: function(index)
					    {
					      var self = this;
					      self.settings.currentSlide = index;
					      return index;
					    },
					    moveSlide: function()
					    {
					      var self = this;
					      self.$view.css({ "margin-left": self.calculateMargin() })
					    },
					    goToSlide: function(slideIndex)
					    {
					      var self  = this,
					          index = slideIndex;
					      // next or prev
					      switch(index)
					      {
					        case "next":
					          index = self.nextSlide();
					          break;
					        case "prev":
					          index = self.prevSlide();
					          break;
					      };
					      self.setSlide(index);
					      self.fixSlideHeight();
					      return self.settings.currentSlide;
					    },
					    activateButton: function(index)
					    {
					      var self    = this,
					          buttons = self.$dotsControls.children("button"),
					          index   = index || self.settings.currentSlide;
					      buttons.removeClass('active');
					      buttons.eq(index).addClass('active');
					    },
					    resizeImages: function(containerWidth)
					    {
					      var self = this;
					      self.w = containerWidth;
					      self.moveSlide();
					      self.$slides.width(containerWidth);
					    },
					    userEvents: {
					      handleDotsControls: function($btn)
					      {
					        var self  = this,
					            dir   = $btn.data("slide-index");
					        self.goToSlide(dir);
					        self.startAutomaticMovement();
					        self.activateButton();
					        self.moveSlide();
					        return self.settings.currentSlide;
					      },
					      handleArrowControls: function($btn)
					      {
					        var self  = this,
					            dir   = $btn.data("dir");
					        self.goToSlide(dir);
					        self.startAutomaticMovement();
					        self.activateButton();
					        self.moveSlide();
					        return self.settings.currentSlide;
					      },
					      resizeWindow: function()
					      {
					        var self  = this,
					            w     = self.$context.innerWidth();
					        self.resizeImages(w);
					        self.fixSlideHeight();
					        self.removeAnimations();
					      }
					    },
					    fixSlideHeight: function()
					    {
					      var self      = this,
					          numSlide  = self.settings.currentSlide,
					          $slide    = self.$slides.eq(numSlide),
					          $image    = $slide.find(".rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"),
					          h         = self.settings.height,
					          minH      = self.settings.minHeight;
					      if( h < minH ) h = minH;
					      if( h > self.$context.outerHeight() ) h = h;
					      self.$slides.height(h);
					      $slide.height(h);
					      return h;
					    },
					    removeAnimations: function()
					    {
					      var self = this,
					          className = "css-transitions";
					      self.$context.removeClass(className);
					      clearTimeout(self.resizeTimer);
					      self.resizeTimer = setTimeout(self.setAnimations.bind(self), 500);
					    },
					    setAnimations: function()
					    {
					      var self = this,
					          className = "css-transitions";
					      if(!self.settings.transitions) return;
					      self.$context.addClass(className);
					    },
					    events: function()
					    {
					      var self = this;
					      self.$dotsControls.on("click", "button", function()
					      {
					        var $btn = jQuery(this);
					        self.userEvents.handleDotsControls.call(self, $btn);
					      });
					      self.$arrowControls.on("click", "span", function()
					      {
					        var $btn = jQuery(this).children("button");
					        self.userEvents.handleArrowControls.call(self, $btn);
					      });
					      jQuery(window).on("resize", self.userEvents.resizeWindow.bind(self));
					      self.$context.on( "mouseover", self.stopAutomaticMovement.bind(self) );
					      self.$context.on( "mouseleave", self.startAutomaticMovement.bind(self));
					    }
					  };
					  jQuery.extend(Plugin.prototype, pluginProto);
					  jQuery.fn[pluginName] = function(options)
					  {
					    return jQuery.each(jQuery(this), function()
					    {
					      return new Plugin( this, options);
					    });
					  };
					  jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").rSlider();
					}());
					jQuery(document).ready(function(){
						var RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						jQuery('.rSlider--image_RW').css("width","0px");
						function resp(){
							jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150))
							jQuery('.rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('padding',20*jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/(jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()+150)+'px')
							if(jQuery('.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=350){
								jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a").css("display","none");
								jQuery('.rSlider--image_RW').css("width","100%");
								jQuery('.rSlider--image_RW').css("cursor","pointer");
							}else{
								jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a").css("display","inline-block");
									jQuery('.rSlider--image_RW').css("width","0px");
									jQuery('.rSlider--image_RW').css("cursor","default");
							}
						}
						jQuery('.rSlider--image_RW').each(function(){
							jQuery(this).click(function(){
								//if(jQuery('.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=450){
									if(jQuery(this).attr('name') != ''){
										if(jQuery(this).attr('alt')=="checked"){
											window.open(jQuery(this).attr('name'), '_blank');
										}else{
											window.open(jQuery(this).attr('name'),"_self")
										}
										
									}
								//}
								
								
								
							})
						})
						setTimeout (function(){
							resp();
						},100)
						jQuery(window).load(function(){
							resp();
						})
						jQuery(window).resize(function(){
							resp();
						})
					})
  				</script>
  			<?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Thumbnails Slider & Lightbox'){ ?>
  				<?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
				<style type="text/css">
					.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_BgC; ?> !important;
						z-index:999;
						width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_W;?>px;
						height:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_H;?>px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T3_BgC; ?> !important;
						}
					}





				

					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic { margin: 0px auto; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow { top: 50%; transform:translateY(-50%); -webkit-transform:translateY(-50%); -ms-transform:translateY(-50%); position: absolute; display: block; z-index: 100; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow a { display: block; width: 45px; text-align: center; outline: 0; background-size: 70% 70%; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> { outline: 0; display: none; float: right; position: absolute; right: 20px; margin: 0px ; z-index: 100; opacity: 0.90; filter: alpha(opacity=90);overflow:hidden;  }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul { margin: 0; padding: 0; float: left; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul li { list-style: none; float: left; margin: 0; padding: 0 !important; background:none !important; margin-top:2px !important;}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul a { display: inline-block; padding: 0; text-decoration: none; text-align: center; outline: 0; box-sizing:border-box !important;}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span { visibility: hidden; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .anythingNavWindow { overflow: hidden; float: left; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li.prev a span, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> li.next a span { visibility: visible; position: relative; top: -6px; color: #fff; }
					.as-oldie .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow { top: 40%; }
					.as-oldie .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow a { margin: 0; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> { display: block; overflow: visible !important; position: relative; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .anythingWindow { overflow: hidden; position: relative; width: 100%; height: 100%; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .anythingBase { background: transparent; list-style: none; position: absolute; overflow: visible !important; top: 0; left: 0; margin: 0; padding: 0; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .arrow span { display: block; visibility: hidden; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .arrow.disabled { display: none; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?> { background: transparent; display: block; overflow: hidden; float: left; padding: 0; margin: 0; border:none !important; border-radius:0px !important;cursor:pointer !important;}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:before{
						display:none !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?> img{
						margin:0px !important;
						height:100% !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .vertical .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?> { float: none; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .fade .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?> { float: none; position: absolute; top: 0; left: 0; z-index: 0; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .fade .activePage { z-index: 1; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.rtl .anythingWindow { direction: ltr; unicode-bidi: bidi-override; }
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.rtl .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul { float: left; } 
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.rtl .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul a { float: right; } 
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .anythingWindow, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul a, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .arrow a, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .start-stop { transition-duration: 0s; -o-transition-duration: 0s; -moz-transition-duration: 0s; -webkit-transition-duration: 0s;line-height:0 !important; box-shadow:none !important; }



				
					#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  list-style: none;
					}
					#cboxPhoto { width: 100%; height: 100%; margin: 0 !important; }
					div.anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
					  bottom: 25px; /* thumbnail images are larger than the original bullets; move it up */
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a {
					  background-image: url();
					  height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_H;?>px;
					  width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_W;?>px;
					  margin: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_PB;?>px;
					  border: 1px solid <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BC;?>;
					  border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					  -moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					  -webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					  text-indent: 0;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> span img
					{
						width: 100%;
						height: 100% !important;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					    -moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					    -webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_BR;?>px;
					    filter:none !important;
					    box-shadow:none !important;
					    margin:0px !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> 
					{
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_H;?>px;
						<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_Pos;?>: 15px;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a span {
					  	visibility: visible; 
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a:hover
					{
					  	border-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_HBC;?>;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.cur 
					{
					 	border-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_CBC;?>;
					}
					.anythingWindow ul li:before, .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul li:before
					{
						content: '' !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*{
						height:0;
						overflow: hidden !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BR;?>px;
						
						
						margin:25px auto !important;
						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShShow=='true'){ ?>
    						<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShType=='true'){ ?> 
    							-webkit-box-shadow: 0px 0px 20px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
                                -moz-box-shadow: 0px 0px 20px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
    							box-shadow: 0px 0px 20px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
    						<?php }else{ ?>
    							-webkit-box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
    							-moz-box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
    							box-shadow: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxSh;?>px 50px -10px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BoxShC;?>;
    						<?php }?>
    					<?php }?>
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingWindow 
					{
						
						
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .start-stop 
					{
						display: inline-block;
						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_W;?>px;
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_H;?>px;
						margin: 0 <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_PB;?>px;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_BC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_BR;?>px;
						padding: 0;
						text-align: center;
						text-decoration: none;
						z-index: 100;
						outline: 0;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic.activeSlider .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.start-stop 
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_StC;?>;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic.activeSlider .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a.start-stop.playing {
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_SpC;?>;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow
					{
						background-color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_C;?>;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow a
					{
						height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_S;?>px;
						width: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_S;?>px;
						border:none !important;
						box-shadow:none !important;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .back a 
					{ 
						background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_Type . '.png',__FILE__)?>") no-repeat center center;
						background-size:100% 100%;
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .forward a
					{
						background: url("<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_Type .'-'. $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_Type .'.png',__FILE__)?>") no-repeat center center;
						background-size:100% 100%;

					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .back 
					{ 
						left: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BW;?>px; 
					}
					.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .forward 
					{ 
						right: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_BW;?>px; 
					}
					#cboxOverlay
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_OvC;?>;
					}
					#cboxContent
					{
						background: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_BgC;?>; 
						overflow:hidden;
						border: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_BC;?>;
						border-radius: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_BR;?>px;
					}
					#cboxTitle, #cboxCurrent
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_TFS;?>px;
						font-family: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_TFF;?>;
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_TC;?>;
					}
					#cboxPrevious, #cboxNext
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrS;?>px;
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrC;?>;
					}
					#cboxClose
					{
						font-size: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CIS;?>px;
						color: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CIC;?>;
					}
					
					#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						margin-left:0px !important;
					}
					
					
					@media screen and (max-width:700px){
						.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> ul a, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .forward a, .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .back a{
							cursor:default !important;
						}
						#cboxNext, #cboxPrevious, #cboxClose{
							cursor:default !important;
						}
					}
				</style>
				<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_ThSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<ul id="RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style='opacity:1;display:none;'>
					<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
				  		<li style='padding:0px;background:none;'><img class='contImgWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" title="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>"></li>
			    	<?php }?>
				</ul>
				<input type='text' style='display:none;' class='slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_W;?>'>
				<input type='text' style='display:none;' class='slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_H;?>'>
				<input type='text' style='display:none;' class='countImgs<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo count($Rich_Web_Slider_Images);?>'>
				<input type='text' style='display:none;' class='arrW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_S;?>'>
				<input type='text' style='display:none;' class='imgSmW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_W;?>'>
				<input type='text' style='display:none;' class='imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_H;?>'>
				<input type='text' style='display:none;' class='autPLW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_W;?>'>
				<input type='text' style='display:none;' class='autPLH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_H;?>'>
				<input type='text' style='display:none;' class='slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CM;?>'>
				<script type="text/javascript">
					jQuery(function(){
						var Rich_Web_Thumb_Photos<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=new Array();
						<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
							Rich_Web_Thumb_Photos<?php echo $Rich_Web_Slider_Manager[0]->id; ?>[<?php echo $i;?>]="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url; ?>";
						<?php }?>
					 jQuery('#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>')
					  .anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>({
					   theme<?php echo $Rich_Web_Slider_Manager[0]->id; ?>           : 'metallic',
					   mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>            : "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CM;?>",
					   toggleArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>    : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_TA;?>,
					   autoPlay<?php echo $Rich_Web_Slider_Manager[0]->id; ?>        : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_AP;?>,
					   pauseOnHover<?php echo $Rich_Web_Slider_Manager[0]->id; ?>    : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_PH;?>,
					   stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>       : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Loop;?>,
					   delay           : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_PT*1000;?>,
					   animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>   : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CS;?>,
					   buildArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>     : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Arr_Show;?>,
					   buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?> : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Nav_Show;?>,
					   buildStartStop  : <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_SS_Show;?>,
					   navigationFormatter : function(i, panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>){ // add thumbnails as navigation links
					    return '<img src="'+Rich_Web_Thumb_Photos<?php echo $Rich_Web_Slider_Manager[0]->id; ?>[i-1]+'">';
					   }
					  })
					  // target all images inside the current slider
					  // replace with 'img.someclass' to target specific images
					  .find('.panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:not(.cloned) img') // ignore the cloned panels
					   .attr('rel','group<?php echo $Rich_Web_Slider_Manager[0]->id; ?>')           
					   .colorbox({
					     width: '80%',
					     height: '70%',
					     previous: "<i class='rich_web rich_web-<?php echo  $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrType;?>-left'></i>",
						 next: "<i class='rich_web rich_web-<?php echo  $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrType;?>-right'></i>",
						 close: "<i class='rich_web rich_web-<?php echo  $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_TSL_CIT;?>'></i>",
					     href: function(){ return jQuery(this).attr('src'); },
					     // use $(this).attr('title') for specific image captions
					     title: function(){ return jQuery(this).attr('title'); },
					     rel: 'group<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'
					   });
					});
				</script>
				<script type="text/javascript">
					;(function(d,l,n){d.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=function(m,p){var a=this,b,k;a.el=m;a.$el=d(m).addClass("anythingBase").wrap('<div class="anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"><div class="anythingWindow" /></div>');a.$el.data("AnythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",a);a.init=function(){a.options=b=d.extend({},d.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.defaults,p);a.initialized=!1;d.isFunction(b.onBeforeInitialize)&&a.$el.bind("before_initialize",b.onBeforeInitialize);a.$el.trigger("before_initialize",a);d('\x3c!--[if lte IE 8]><script>jQuery("body").addClass("as-oldie");\x3c/script><![endif]--\x3e').appendTo("body").remove();
					a.$wrapper=a.$el.parent().closest("div.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").addClass("anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-"+b.theme<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);a.$outer=a.$wrapper.parent();a.$window=a.$el.closest("div.anythingWindow");a.$win=d(l);a.$controls=d('<div class="anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"></div>');a.$nav=d('<ul class="thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"><li><a><span></span></a></li></ul>');a.$startStop=d('<a href="#" class="start-stop"></a>');(b.buildStartStop||b.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)&&a.$controls.appendTo(b.appendControlsTo&&d(b.appendControlsTo).length?d(b.appendControlsTo):a.$wrapper);b.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&
					a.$nav.appendTo(b.appendNavigationTo&&d(b.appendNavigationTo).length?d(b.appendNavigationTo):a.$controls);b.buildStartStop&&a.$startStop.appendTo(b.appendStartStopTo&&d(b.appendStartStopTo).length?d(b.appendStartStopTo):a.$controls);a.runTimes=d(".anythingBase").length;a.regex=b.hashTags?new RegExp("panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"+a.runTimes+"-(\\d+)","i"):null;1===a.runTimes&&a.makeActive();a.flag=!1;b.autoPlayLocked&&(b.autoPlay<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=!0);a.playing=b.autoPlay<?php echo $Rich_Web_Slider_Manager[0]->id; ?>;a.slideshow=!1;a.hovered=!1;a.panelSize=[];a.currentPage=a.targetPage=
					b.startPanel=parseInt(b.startPanel,10)||1;b.changeBy=parseInt(b.changeBy,10)||1;k=(b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>||"h").toLowerCase().match(/(h|v|f)/);k=b.vertical?"v":(k||["h"])[0];b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>="v"===k?"vertical":"f"===k?"fade":"horizontal";"f"===k&&(b.showMultiple=1,b.infiniteSlides=!1);a.adj=b.infiniteSlides?0:1;a.adjustMultiple=0;b.playRtl&&a.$wrapper.addClass("rtl");b.buildStartStop&&a.buildAutoPlay();b.buildArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&a.buildNextBackButtons();a.$lastPage=a.$targetPage=a.$currentPage;if(b.expand){if(!0===b.aspectRatio)b.aspectRatio=
					a.$el.width()/a.$el.height();else if("string"===typeof b.aspectRatio&&-1!==b.aspectRatio.indexOf(":")){var c=b.aspectRatio.split(":");b.aspectRatio=c[0]/c[1]}0<b.aspectRatio&&1<b.showMultiple&&(b.aspectRatio*=b.showMultiple)}a.updateSlider();b.expand&&(a.$window.css({width:"100%",height:"100%"}),a.checkResize());d.isFunction(d.easing[b.easing])||(b.easing="swing");b.pauseOnHover<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&a.$wrapper.hover(function(){a.playing&&(a.$el.trigger("slideshow_paused",a),a.clearTimer(!0))},function(){a.playing&&(a.$el.trigger("slideshow_unpaused",
					a),a.startStop(a.playing,!0))});a.slideControls(!1);a.$wrapper.bind("mouseenter mouseleave",function(b){d(this)["mouseenter"===b.type?"addClass":"removeClass"]("anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-hovered");a.hovered="mouseenter"===b.type?!0:!1;a.slideControls(a.hovered)});d(n).keyup(function(c){if(b.enableKeyboard&&a.$wrapper.hasClass("activeSlider")&&!c.target.tagName.match("TEXTAREA|INPUT|SELECT")&&("vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>||38!==c.which&&40!==c.which))switch(c.which){case 39:case 40:a.goForward();break;case 37:case 38:a.goBack()}});
					a.currentPage=(b.hashTags?a.gotoHash():"")||b.startPanel||1;a.gotoPage(a.currentPage,!1,null,-1);var f="slideshow_resized slideshow_paused slideshow_unpaused slide_init slide_begin slideshow_stop slideshow_start initialized swf_completed".split(" ");d.each("onSliderResize onShowPause onShowUnpause onSlideInit onSlideBegin onShowStop onShowStart onInitialized onSWFComplete".split(" "),function(c,h){d.isFunction(b[h])&&a.$el.bind(f[c],b[h])});d.isFunction(b.onSlideComplete)&&a.$el.bind("slide_complete",
					function(){setTimeout(function(){b.onSlideComplete(a)},0);return!1});a.initialized=!0;a.$el.trigger("initialized",a);a.startStop(b.autoPlay<?php echo $Rich_Web_Slider_Manager[0]->id; ?>)};a.updateSlider=function(){a.$el.children(".cloned").remove();a.navTextVisible="hidden"!==a.$nav.find("span:first").css("visibility");a.$nav.empty();a.currentPage=a.currentPage||1;a.$items=a.$el.children();a.pages=a.$items.length;a.dir="vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?"top":"left";b.showMultiple=parseInt(b.showMultiple,10)||1;b.navigationSize=!1===b.navigationSize?0:parseInt(b.navigationSize,
					10)||0;a.$items.find("a").unbind("focus.AnythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").bind("focus.AnythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>",function(c){var f=d(this).closest(".panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"),f=a.$items.index(f)+a.adj;a.$items.find(".focusedLink").removeClass("focusedLink");d(this).addClass("focusedLink");a.$window.scrollLeft(0).scrollTop(0);-1!==f&&(f>=a.currentPage+b.showMultiple||f<a.currentPage)&&(a.gotoPage(f),c.preventDefault())});1<b.showMultiple&&(b.showMultiple>a.pages&&(b.showMultiple=a.pages),a.adjustMultiple=b.infiniteSlides&&1<a.pages?0:b.showMultiple-
					1);a.$controls.add(a.$nav).add(a.$startStop).add(a.$forward).add(a.$back)[1>=a.pages?"hide":"show"]();1<a.pages&&a.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();"fade"!==b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&b.infiniteSlides&&1<a.pages&&(a.$el.prepend(a.$items.filter(":last").clone().addClass("cloned")),1<b.showMultiple?a.$el.append(a.$items.filter(":lt("+b.showMultiple+")").clone().addClass("cloned multiple")):a.$el.append(a.$items.filter(":first").clone().addClass("cloned")),a.$el.find(".cloned").each(function(){d(this).find("a,input,textarea,select,button,area,form").attr({disabled:"disabled",
					name:""});d(this).find("[id]")[d.fn.addBack?"addBack":"andSelf"]().removeAttr("id")}));a.$items=a.$el.addClass(b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>).children().addClass("panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");a.setDimensions();b.resizeContents?(a.$items.css("width",a.width),a.$wrapper.css("width",a.getDim(a.currentPage)[0]).add(a.$items).css("height",a.height)):a.$win.load(function(){a.setDimensions();k=a.getDim(a.currentPage);a.$wrapper.css({width:k[0],height:k[1]});a.setCurrentPage(a.currentPage,!1)});a.currentPage>a.pages&&(a.currentPage=a.pages);a.setCurrentPage(a.currentPage,
					!1);a.$nav.find("a").eq(a.currentPage-1).addClass("cur");"fade"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&(k=a.$items.eq(a.currentPage-1),b.resumeOnVisible?k.css({opacity:1,visibility:"visible"}).siblings().css({opacity:0,visibility:"hidden"}):(a.$items.css("opacity",1),k.fadeIn(0).siblings().fadeOut(0)))};a.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=function(){if(b.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&1<a.pages){var c,f,e,h,g;a.$items.filter(":not(.cloned)").each(function(q){g=d("<li/>");e=q+1;f=(1===e?" first":"")+(e===a.pages?" last":"");c='<a class="panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'+e+(a.navTextVisible?
					'"':" "+b.tooltipClass+'" title="@"')+' href="#"><span>@</span></a>';d.isFunction(b.navigationFormatter)?(h=b.navigationFormatter(e,d(this)),"string"===typeof h?g.html(c.replace(/@/g,h)):g=d("<li/>",h)):g.html(c.replace(/@/g,e));g.appendTo(a.$nav).addClass(f).data("index",e)});a.$nav.children("li").bind(b.clickControls,function(c){!a.flag&&b.enableNavigation&&(a.flag=!0,setTimeout(function(){a.flag=!1},100),a.gotoPage(d(this).data("index")));c.preventDefault()});b.navigationSize&&b.navigationSize<
					a.pages&&(a.$controls.find(".anythingNavWindow").length||a.$nav.before('<ul><li class="prev"><a href="#"><span>'+b.backText+"</span></a></li></ul>").after('<ul><li class="next"><a href="#"><span>'+b.forwardText+"</span></a></li></ul>").wrap('<div class="anythingNavWindow"></div>'),a.navWidths=a.$nav.find("li").map(function(){return d(this).outerWidth(!0)+Math.ceil(parseInt(d(this).find("span").css("left"),10)/2||0)}).get(),a.navLeft=1,a.$nav.width(a.navWidth(1,a.pages+1)+25),a.$controls.find(".anythingNavWindow").width(a.navWidth(1,
					b.navigationSize+1)).end().find(".prev,.next").bind(b.clickControls,function(c){a.flag||(a.flag=!0,setTimeout(function(){a.flag=!1},200),a.navWindow(a.navLeft+b.navigationSize*(d(this).is(".prev")?-1:1)));c.preventDefault()}))}};a.navWidth=function(b,f){var e,d=Math.max(b,f),g=0;for(e=Math.min(b,f);e<d;e++)g+=a.navWidths[e-1]||0;return g};a.navWindow=function(c){if(b.navigationSize&&b.navigationSize<a.pages&&a.navWidths){var f=a.pages-b.navigationSize+1;c=1>=c?1:1<c&&c<f?c:f;c!==a.navLeft&&(a.$controls.find(".anythingNavWindow").animate({scrollLeft:a.navWidth(1,
					c),width:a.navWidth(c,c+b.navigationSize)},{queue:!1,duration:b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>}),a.navLeft=c)}};a.buildNextBackButtons=function(){a.$forward=d('<span class="arrow forward"><a href="#"><span>'+b.forwardText+"</span></a></span>");a.$back=d('<span class="arrow back"><a href="#"><span>'+b.backText+"</span></a></span>");a.$back.bind(b.clickBackArrow,function(c){b.enableArrows&&!a.flag&&(a.flag=!0,setTimeout(function(){a.flag=!1},100),a.goBack());c.preventDefault()});a.$forward.bind(b.clickForwardArrow,
					function(c){b.enableArrows&&!a.flag&&(a.flag=!0,setTimeout(function(){a.flag=!1},100),a.goForward());c.preventDefault()});a.$back.add(a.$forward).find("a").bind("focusin focusout",function(){d(this).toggleClass("hover")});a.$back.appendTo(b.appendBackTo&&d(b.appendBackTo).length?d(b.appendBackTo):a.$wrapper);a.$forward.appendTo(b.appendForwardTo&&d(b.appendForwardTo).length?d(b.appendForwardTo):a.$wrapper);a.arrowWidth=a.$forward.width();a.arrowRight=parseInt(a.$forward.css("right"),10);a.arrowLeft=
					parseInt(a.$back.css("left"),10)};a.buildAutoPlay=function(){a.$startStop.html("<span>"+(a.playing?b.stopText:b.startText)+"</span>").bind(b.clickSlideshow,function(c){b.enableStartStop&&(a.startStop(!a.playing),a.makeActive(),a.playing&&!b.autoPlayDelayed&&a.goForward(!0,b.playRtl));c.preventDefault()}).bind("focusin focusout",function(){d(this).toggleClass("hover")})};a.checkResize=function(b){var f=!!(n.hidden||n.webkitHidden||n.mozHidden||n.msHidden);clearTimeout(a.resizeTimer);a.resizeTimer=
					setTimeout(function(){var e=a.$outer.width(),d="BODY"===a.$outer[0].tagName?a.$win.height():a.$outer.height();f||a.lastDim[0]===e&&a.lastDim[1]===d||(a.setDimensions(),a.$el.trigger("slideshow_resized",a),a.gotoPage(a.currentPage,a.playing,null,-1));"undefined"===typeof b&&a.checkResize()},f?2E3:500)};a.setDimensions=function(){a.$wrapper.find(".anythingWindow, .anythingBase, .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>")[d.fn.addBack?"addBack":"andSelf"]().css({width:"",height:""});a.width=a.$el.width();a.height=a.$el.height();a.outerPad=
					[a.$wrapper.innerWidth()-a.$wrapper.width(),a.$wrapper.innerHeight()-a.$wrapper.height()];var c,f,e,h,g=0,m={width:"100%",height:"100%"},k=1<b.showMultiple&&"horizontal"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.width||a.$window.width()/b.showMultiple:a.$window.width(),n=1<b.showMultiple&&"vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.height/b.showMultiple||a.$window.height()/b.showMultiple:a.$window.height();if(b.expand){a.lastDim=[a.$outer.width(),a.$outer.height()];c=a.lastDim[0]-a.outerPad[0];f=a.lastDim[1]-a.outerPad[1];if(b.aspectRatio&&b.aspectRatio<
					a.width){var l=f*b.aspectRatio;l<c?c=l:(l=c/b.aspectRatio,l<f&&(f=l))}a.$wrapper.add(a.$window).css({width:c,height:f});a.height=f=1<b.showMultiple&&"vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?n:f;a.width=k=1<b.showMultiple&&"horizontal"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?c/b.showMultiple:c;a.$items.css({width:k,height:n})}a.$items.each(function(l){h=d(this);e=h.children();b.resizeContents?(c=a.width,f=a.height,h.css({width:c,height:f}),e.length&&("EMBED"===e[0].tagName&&e.attr(m),"OBJECT"===e[0].tagName&&e.find("embed").attr(m),1===e.length&&e.css(m))):
					("vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?(c=h.css("display","inline-block").width(),h.css("display","")):c=h.width()||a.width,1===e.length&&c>=k&&(c=e.width()>=k?k:e.width(),e.css("max-width",c)),h.css({width:c,height:""}),f=1===e.length?e.outerHeight(!0):h.height(),f<=a.outerPad[1]&&(f=a.height),h.css("height",f));a.panelSize[l]=[c,f,g];g+="vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?f:c});a.$el.css("vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?"height":"width","fade"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.width:g)};a.getDim=function(c){var f,e,d=a.width,g=a.height;if(1>a.pages||isNaN(c))return[d,
					g];c=b.infiniteSlides&&1<a.pages?c:c-1;if(e=a.panelSize[c])d=e[0]||d,g=e[1]||g;if(1<b.showMultiple)for(e=1;e<b.showMultiple;e++)f=c+e,"vertical"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?(d=Math.max(d,a.panelSize[f][0]),g+=a.panelSize[f][1]):(d+=a.panelSize[f][0],g=Math.max(g,a.panelSize[f][1]));return[d,g]};a.goForward=function(c,d){a.gotoPage(a[b.allowRapidChange?"targetPage":"currentPage"]+b.changeBy*(d?-1:1),c)};a.goBack=function(c){a.gotoPage(a[b.allowRapidChange?"targetPage":"currentPage"]-b.changeBy,c)};a.gotoPage=function(c,
					f,e,h){!0!==f&&(f=!1,a.startStop(!1),a.makeActive());/^[#|.]/.test(c)&&d(c).length&&(c=d(c).closest(".panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").index()+a.adj);if(1!==b.changeBy){var g=a.pages-a.adjustMultiple;1>c&&(c=b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?1:b.infiniteSlides?a.pages+c:b.showMultiple>1-c?1:g);c>a.pages?c=b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.pages:b.showMultiple>1-c?1:c-=g:c>=g&&(c=g)}1>=a.pages||(a.$lastPage=a.$currentPage,"number"!==typeof c&&(c=parseInt(c,10)||b.startPanel,a.setCurrentPage(c)),f&&b.isVideoPlaying(a)||(b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&!b.infiniteSlides&&c>a.pages-b.showMultiple&&
					(c=a.pages-b.showMultiple+1),a.exactPage=c,c>a.pages+1-a.adj&&(c=b.infiniteSlides||b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.pages:1),c<a.adj&&(c=b.infiniteSlides||b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?1:a.pages),b.infiniteSlides||(a.exactPage=c),a.currentPage=c>a.pages?a.pages:1>c?1:a.currentPage,a.$currentPage=a.$items.eq(a.currentPage-a.adj),a.targetPage=0===c?a.pages:c>a.pages?1:c,a.$targetPage=a.$items.eq(a.targetPage-a.adj),h="undefined"!==typeof h?h:b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,0<=h&&a.$el.trigger("slide_init",a),0<h&&!0===b.toggleControls&&a.slideControls(!0),
					b.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&a.setNavigation(a.targetPage),!0!==f&&(f=!1),(!f||b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&c===a.pages)&&a.startStop(!1),0<=h&&a.$el.trigger("slide_begin",a),setTimeout(function(d){var f,g=!0;b.allowRapidChange&&a.$wrapper.add(a.$el).add(a.$items).stop(!0,!0);b.resizeContents||(f=a.getDim(c),d={},a.$wrapper.width()!==f[0]&&(d.width=f[0]||a.width,g=!1),a.$wrapper.height()!==f[1]&&(d.height=f[1]||a.height,g=!1),g||a.$wrapper.filter(":not(:animated)").animate(d,{queue:!1,duration:0>h?0:h,easing:b.easing}));"fade"===
					b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?a.$lastPage[0]!==a.$targetPage[0]?(a.fadeIt(a.$lastPage,0,h),a.fadeIt(a.$targetPage,1,h,function(){a.endAnimation(c,e,h)})):a.endAnimation(c,e,h):(d={},d[a.dir]=-a.panelSize[b.infiniteSlides&&1<a.pages?c:c-1][2],"vertical"!==b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>||b.resizeContents||(d.width=f[0]),a.$el.filter(":not(:animated)").animate(d,{queue:!1,duration:0>h?0:h,easing:b.easing,complete:function(){a.endAnimation(c,e,h)}}))},parseInt(b.delayBeforeAnimate,10)||0)))};a.endAnimation=function(c,d,e){0===c?(a.$el.css(a.dir,"fade"===
					b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?0:-a.panelSize[a.pages][2]),c=a.pages):c>a.pages&&(a.$el.css(a.dir,"fade"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?0:-a.panelSize[1][2]),c=1);a.exactPage=c;a.setCurrentPage(c,!1);"fade"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&a.fadeIt(a.$items.not(":eq("+(c-a.adj)+")"),0,0);a.hovered||a.slideControls(!1);b.hashTags&&a.setHash(c);0<=e&&a.$el.trigger("slide_complete",a);"function"===typeof d&&d(a);b.autoPlayLocked&&!a.playing&&setTimeout(function(){a.startStop(!0)},b.resumeDelay-(b.autoPlayDelayed?b.delay:0))};a.fadeIt=function(a,f,e,h){var g=a.filter(":not(:animated)");
					a=0>e?0:e;if(b.resumeOnVisible)1===f&&g.css("visibility","visible"),g.fadeTo(a,f,function(){0===f&&g.css("visibility","hidden");d.isFunction(h)&&h()});else g[0===f?"fadeOut":"fadeIn"](a,h)};a.setCurrentPage=function(c,d){c=parseInt(c,10);if(!(1>a.pages||0===c||isNaN(c))){c>a.pages+1-a.adj&&(c=a.pages-a.adj);c<a.adj&&(c=1);b.buildArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&!b.infiniteSlides&&b.stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&(a.$forward[c===a.pages-a.adjustMultiple?"addClass":"removeClass"]("disabled"),a.$back[1===c?"addClass":"removeClass"]("disabled"),
					c===a.pages&&a.playing&&a.startStop());if(!d){var e=a.getDim(c);a.$wrapper.css({width:e[0],height:e[1]}).add(a.$window).scrollLeft(0).scrollTop(0);a.$el.css(a.dir,"fade"===b.mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>?0:-a.panelSize[b.infiniteSlides&&1<a.pages?c:c-1][2])}a.currentPage=c;a.$currentPage=a.$items.removeClass("activePage").eq(c-a.adj).addClass("activePage");b.buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&a.setNavigation(c)}};a.setNavigation=function(b){a.$nav.find(".cur").removeClass("cur").end().find("a").eq(b-1).addClass("cur")};a.makeActive=function(){a.$wrapper.hasClass("activeSlider")||
					(d(".activeSlider").removeClass("activeSlider"),a.$wrapper.addClass("activeSlider"))};a.gotoHash=function(){var c=l.location.hash,f=c.indexOf("&"),e=c.match(a.regex);null!==e||/^#&/.test(c)||/#!?\//.test(c)||/\=/.test(c)?null!==e&&(e=b.hashTags?parseInt(e[1],10):null):(c=c.substring(0,0<=f?f:c.length),e=d(c).length&&d(c).closest(".anythingBase")[0]===a.el?a.$items.index(d(c).closest(".panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"))+a.adj:null);return e};a.setHash=function(b){var d="panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>"+a.runTimes+"-",e=l.location.hash;"undefined"!==
					typeof e&&(l.location.hash=0<e.indexOf(d)?e.replace(a.regex,d+b):e+"&"+d+b)};a.slideControls=function(c){var d=c?"slideDown":"slideUp",e=c?0:b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,h=c?b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:0,g=c?1:0;c=c?0:1;b.toggleControls&&a.$controls.stop(!0,!0).delay(e)[d](b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/2).delay(h);b.buildArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&b.toggleArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>&&(!a.hovered&&a.playing&&(c=1,g=0),a.$forward.stop(!0,!0).delay(e).animate({right:a.arrowRight+c*a.arrowWidth,opacity:g},b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/2),a.$back.stop(!0,!0).delay(e).animate({left:a.arrowLeft+
					c*a.arrowWidth,opacity:g},b.animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/2))};a.clearTimer=function(b){a.timer&&(l.clearInterval(a.timer),!b&&a.slideshow&&(a.$el.trigger("slideshow_stop",a),a.slideshow=!1))};a.startStop=function(c,d){!0!==c&&(c=!1);(a.playing=c)&&!d&&(a.$el.trigger("slideshow_start",a),a.slideshow=!0);b.buildStartStop&&(a.$startStop.toggleClass("playing",c).find("span").html(c?b.stopText:b.startText),"hidden"===a.$startStop.find("span").css("visibility")&&a.$startStop.addClass(b.tooltipClass).attr("title",c?b.stopText:
					b.startText));c?(a.clearTimer(!0),a.timer=l.setInterval(function(){n.hidden||n.webkitHidden||n.mozHidden||n.msHidden?b.autoPlayLocked||a.startStop():b.isVideoPlaying(a)?b.resumeOnVideoEnd||a.startStop():a.goForward(!0,b.playRtl)},b.delay)):a.clearTimer()};a.init()};d.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.defaults={theme<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:"default",mode<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:"horiz",expand:!1,resizeContents:!0,showMultiple:!1,easing:"swing",buildArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!0,buildNavigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!0,buildStartStop:!0,toggleArrows<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!1,toggleControls:!1,startText:"Start",stopText:"Stop",
					forwardText:"&raquo;",backText:"&laquo;",tooltipClass:"tooltip",enableArrows:!0,enableNavigation:!0,enableStartStop:!0,enableKeyboard:!0,startPanel:1,changeBy:1,hashTags:!0,infiniteSlides:!0,navigationFormatter:null,navigationSize:!1,autoPlay<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!1,autoPlayLocked:!1,autoPlayDelayed:!1,pauseOnHover<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!0,stopAtEnd<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:!1,playRtl:!1,delay:3E3,resumeDelay:15E3,animationTime<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:600,delayBeforeAnimate:0,clickForwardArrow:"click",clickBackArrow:"click",clickControls:"click focusin",clickSlideshow:"click",allowRapidChange:!1,
					resumeOnVideoEnd:!0,resumeOnVisible:!0,isVideoPlaying:function(d){return!1}};d.fn.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=function(m,l){return this.each(function(){var a,b=d(this).data("AnythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>");(typeof m).match("object|undefined")?b?b.updateSlider():new d.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(this,m):/\d/.test(m)&&!isNaN(m)&&b?(a="number"===typeof m?m:parseInt(d.trim(m),10),1<=a&&a<=b.pages&&b.gotoPage(a,!1,l)):/^[#|.]/.test(m)&&d(m).length&&b.gotoPage(m,!1,l)})}})(jQuery,window,document);
				</script>
				<script type='text/javascript'>
					jQuery(document).ready(function(){
						jQuery("#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").parent().parent().css("display","none");
						var slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var countImgs<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.countImgs<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var arrW<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.arrW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val(); 
						var imgSmW<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.imgSmW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val(); 
						var imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val(); 
						var autPLW<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.autPLW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val(); 
						var autPLH<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = jQuery('.autPLH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
						var slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?> = 	jQuery('.slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();				
						jQuery('.arrow').click(function(){
							resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
						})
						function resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(){

							jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").css("max-height",jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
							// jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css("width",jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").width()+"px");
							if(jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()<=400 && slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?>!='horizontal'){
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width','100%');
							}else{
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width',slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							}
							
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-width',slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-height',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-height',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
							if(slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=='fade'){
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-height',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width'));
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-width',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width'));
							}else if(slShType<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=='vertical'){
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-width',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width'));
							}
							jQuery('.contImgWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-width',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width'));
							jQuery('.contImgWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('max-height',jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()*slHresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>/slWresp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>);
							
							// jQuery('#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',countImgs<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .panel<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width());
							// jQuery('#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',jQuery('.boxed-layout img').css('max-width'));
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a').css('width',imgSmW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000)
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a').css('height',imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a span').css('width',imgSmW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000)
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .thumbNav<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a span').css('height',imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',imgSmH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000+5);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('min-height','23px');
							if(jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()<=300){
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('bottom','5px')
							}else{
								jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('bottom','15px')
							}
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow a').css('width',arrW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .arrow a').css('height',arrW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .start-stop').css('width',autPLW<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/(jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()+100));
							jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>-metallic .anythingControls<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .start-stop').css('height',autPLH<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/(jQuery('.anythingSlider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()+100))
						}

						var array_thumbnail<?php echo $Rich_Web_Slider; ?>=[];
						jQuery(".contImgWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
							array_thumbnail<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
						})
						console.log(array_thumbnail<?php echo $Rich_Web_Slider; ?>);

						var y_thumbnail<?php echo $Rich_Web_Slider; ?>=0;
						
						for(i=0;i<array_thumbnail<?php echo $Rich_Web_Slider; ?>.length;i++){
							jQuery("<img class='contImgWidth<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_thumbnail<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   		 	y_thumbnail<?php echo $Rich_Web_Slider; ?>++;
					   			if(y_thumbnail<?php echo $Rich_Web_Slider; ?> == array_thumbnail<?php echo $Rich_Web_Slider; ?>.length){
					   			 	setTimeout(function(){
					   			 		jQuery("#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
						   			 	jQuery("#RichWeb_TSL_slider<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").parent().parent().fadeIn(1000);
						   			 	jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
						   			 	resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
						   			 },100)
					   			 	
					   			}
					   		})
					   	}

						jQuery(window).resize(function(){
							resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
						})
					})
				</script>
				<!-- <script src="<?php echo plugins_url('/Scripts/jquery.easing.1.2.js',__FILE__);?>"></script> -->
				<!-- <script src="<?php echo plugins_url('/Scripts/jquery.anythingslider.min.js',__FILE__);?>"></script>
				<script src="<?php echo plugins_url('/Scripts/jquery.colorbox-min.js',__FILE__);?>"></script> -->
				
 		 	<?php } else if($Rich_Web_Slider_Effects[0]->slider_type=='Accordion Slider'){ ?>
				<?php
					$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT;
					$text_array=str_split($text);
					$str_sum=0;
					$anim_sum=0.75;
				?>
				<style>
					.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_BgC; ?> !important;
						z-index:999;
						width:0px;
						height:0px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T3_BgC; ?> !important;
						}
					}

















					.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						position: absolute;
						top: 50%;
						overflow: hidden;
						text-align: center;
						background: rgba(221,51,51,0.42);
						line-height: 20px;
						font-size: 18px;
						-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
						filter: alpha(opacity=0);
						opacity: 0;
						text-decoration:none;
						letter-spacing: 4px;
						font-weight: 700;
						padding:20px;
						max-width:100%;
						box-sizing:border-box;
						left:50%;
						color: #fff;
						text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
					}


					.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hpver{
						color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_C;?> !important;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position:relative;
						height:400px;
						margin: 20px auto;
						overflow: hidden;
						box-shadow: 1px 1px 4px rgba(0,0,0,0.08);
						border: 7px solid rgba(255,255,255,0.6);
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position: absolute;
						top: 0;
						height:100% !important;
						box-shadow: 0 0 0 1px rgba(255,255,255,0.6);
						-webkit-transition: all 0.3s ease-in-out;
						-moz-transition: all 0.3s ease-in-out;
						-o-transition: all 0.3s ease-in-out;
						-ms-transition: all 0.3s ease-in-out;
						transition: all 0.3s ease-in-out;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> > .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position: relative;
						left: 0 !important;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .img_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						display: block;
						width: 100%;
						height:100% !important;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position: absolute;
						top: 0;
						left: 0;
						height: 100%;
						cursor: pointer;
						border: 0;
						padding: 0;
						-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
						filter: alpha(opacity=0);
						opacity: 0;
						z-index: 100;
						-webkit-appearance: none;
						-moz-appearance: none;
						appearance: none;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked{
						width: 5px !important;
						left: auto;
						right: 0px;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked ~ .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						-webkit-transition: all 0.7s ease-in-out;
						-moz-transition: all 0.7s ease-in-out;
						-o-transition: all 0.7s ease-in-out;
						-ms-transition: all 0.7s ease-in-out;
						transition: all 0.7s ease-in-out;
						left: 100% !important;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						width: 100%;
						height: 100%;
						background: rgba(87, 73, 81, 0.1);
						position: absolute;
						top: 0px;
						-webkit-transition: all 0.2s ease-in-out;
						-moz-transition: all 0.2s ease-in-out;
						-o-transition: all 0.2s ease-in-out;
						-ms-transition: all 0.2s ease-in-out;
						transition: all 0.2s ease-in-out;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						position: absolute;
						top: 40%;
						overflow: hidden;
						text-align: center;
						background: rgba(87, 73, 81, 0.3);
						line-height: 20px;
						font-size: 18px;
						-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
						filter: alpha(opacity=0);
						opacity: 0;
						letter-spacing: 4px;
						font-weight: 700;
						box-sizing:border-box;
						padding:20px;
						max-width:100%;
						left:50%;
						color: #fff;
						text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>,
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked:hover + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						background: rgba(87, 73, 81, 0);
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						-webkit-transition: all 0.4s ease-in-out 0.5s;
						-moz-transition: all 0.4s ease-in-out 0.5s;
						-o-transition: all 0.4s ease-in-out 0.5s;
						-ms-transition: all 0.4s ease-in-out 0.5s;
						transition: all 0.4s ease-in-out 0.5s;
						-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=99)";
						filter: alpha(opacity=99);
						opacity: 1;
						top: 50%;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> a {
						-webkit-transition: all 0.4s ease-in-out 0.5s;
						-moz-transition: all 0.4s ease-in-out 0.5s;
						-o-transition: all 0.4s ease-in-out 0.5s;
						-ms-transition: all 0.4s ease-in-out 0.5s;
						transition: all 0.4s ease-in-out 0.5s;
						-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=99)";
						filter: alpha(opacity=99);
						opacity: 1;
						top: 80%;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> #ia-selector-last:checked + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						-webkit-transition-delay: 0.3s;
						-moz-transition-delay: 0.3s;
						-o-transition-delay: 0.3s;
						-ms-transition-delay: 0.3s;
						transition-delay: 0.3s;
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:hover + .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						background: rgba(87, 73, 81, 0.03);
					}
					.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>:checked ~ .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>{
						z-index: 1;
					}	
					.figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> {
						margin: 0;
						-webkit-margin-before: 0;
						-webkit-margin-after: 0;
						-webkit-margin-start: 0;
						-webkit-margin-end: 0;
					}
				</style>
				<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
					<div class="center_content<?php echo $Rich_Web_Slider; ?>">
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 1") { ?>
							<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
								<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
								<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
								<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
								<div class="loader_Navigation4" id="loader_Navigation4"></div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 2") { ?>
							<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
								<div class="loader<?php echo $Rich_Web_Slider; ?>">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 3") { ?>
							<div class="windows8<?php echo $Rich_Web_Slider; ?>">
								<div class="wBall" id="wBall_1">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_2">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_3">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_4">
									<div class="wInnerBall"></div>
								</div>
								<div class="wBall" id="wBall_5">
									<div class="wInnerBall"></div>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 4") { ?>
							<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-cube cssload-c1"></div>
								<div class="cssload-cube cssload-c2"></div>
								<div class="cssload-cube cssload-c4"></div>
								<div class="cssload-cube cssload-c3"></div>
							</div>
							<?php } ?>
						<?php } ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_Show == "true") { ?>
							<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 1") { ?>
							<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT;?></div>
								<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 2") { ?>
							<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
								<?php } ?>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 3") { ?>
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
								<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
									<?php foreach($text_array as $key=>$v){ ?>	
										<div><?php Print $v; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 4") { ?>
							<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
								<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT;?>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<section class="main" id="rw_acc_main<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style="display: none;">
					<div class="ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" style='border:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BC;?>;box-shadow:0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BShC;?>;'>
					<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
						<figure class='figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' style='box-shadow:0px 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_BShC;?>'>
							<img class='img_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'  src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" />
							<input class='input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' type="radio" name="radio-set_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>" checked="checked"/>
							<figcaption class='figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
								<?php if($Rich_Web_Slider_Images[$i]->SL_Img_Title!=''){ ?>
								<span class='span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' style='font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_FF;?>;color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_C;?>;text-shadow:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_TShC;?>;background:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_BgC;?>'>
									<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>
								</span>
								<?php } ?>
								<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
								<a style='font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_FF;?>;color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_C;?>;text-shadow:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_TSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_TShC;?>;background:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_BgC;?>' href='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>' target='<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>' class='Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>'>
									<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_Text;?>
								</a>
								<?php } ?>
							</figcaption>
						<?php } ?>
					<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
						</figure>
					<?php } ?>
					</div>
				</section>
				<input type='text' style='display:none;' class='Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_W;?>'>
				<input type='text' style='display:none;' class='Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_H;?>'>
				<input type='text' style='display:none;' class='Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_W;?>'>
				<input type='text' style='display:none;' class='Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_FS;?>'>
				<input type='text' style='display:none;' class='Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_FS;?>'>
				<script>
				jQuery(document).ready(function(){
					
					var Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=jQuery('.Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					var Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=jQuery('.Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					var Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=jQuery('.Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					var Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=jQuery('.Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					var Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=jQuery('.Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').val();
					
					var array_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>=[];
					jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').each(function(){
						array_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.push(jQuery(this));
					})
					
					jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
					jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
					function resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>(){
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('height',Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000);
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()/1000);
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('left',(jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()-jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width())/(array_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.length-1));
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('width',(jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width()-jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').width())/(array_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>.length-1));
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('font-size',Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000)
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('line-height','2')
						jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id; ?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('padding','0px 7px')
						jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('font-size',Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').parent().width()/1000)
						jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('line-height','2')
						jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>').css('padding','0px 7px')
					}

					var array_accordion<?php echo $Rich_Web_Slider; ?>=[];
					jQuery(".img_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").each(function(){
						array_accordion<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
					})
					console.log(array_accordion<?php echo $Rich_Web_Slider; ?>);

					var y_accordion<?php echo $Rich_Web_Slider; ?>=0;
						
					for(i=0;i<array_accordion<?php echo $Rich_Web_Slider; ?>.length;i++){
						jQuery("<img class='img_<?php echo $Rich_Web_Slider_Manager[0]->id; ?>' />").attr('src', array_accordion<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
					   		 y_accordion<?php echo $Rich_Web_Slider; ?>++;
					   		if(y_accordion<?php echo $Rich_Web_Slider; ?> == array_accordion<?php echo $Rich_Web_Slider; ?>.length){
					   			jQuery("#rw_acc_main<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").fadeIn(1000);
						   		jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id; ?>").remove();
					   			resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
					   		}
					   	})
					}

					jQuery(window).resize(function(){
						resp<?php echo $Rich_Web_Slider_Manager[0]->id; ?>();
					})
					
				})
			</script>
			<?php }else if($Rich_Web_Slider_Effects[0]->slider_type=='Animation Slider'){ ?>
			<link rel="stylesheet" href="<?php echo plugins_url('/Style/animateSlSVG.css',__FILE__);?>">
			<?php
				$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT;
				$text_array=str_split($text);
				$str_sum=0;
				$anim_sum=0.75;
			?>
			<style>
				.center_content<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						overflow:visible;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
					}
					#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>{
						margin:0px auto !important;
						background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_BgC; ?> !important;
						z-index:999;
						width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_W;?>px;
						height:0px;
						box-sizing: inherit !important;
						overflow:hidden !important;
						max-width:100% !important;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "small") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:45px !important;
								height:45px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
	    						border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important;
								width:50% !important;
								height:50%!important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "middle") { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:60px !important;
								height:60px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
	    						border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important;
								width:55% !important;
								height:55%!important;
							}
						<?php } else { ?>
							.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>{
								width:80px !important;
								height:80px !important;
							}
							.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T1_C; ?> !important;
							}
							.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
								border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
	    						border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T2_C; ?> !important;
							}
							.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
								border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important; 
								border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T3_C; ?> !important;
								width:60% !important;
								height:60%!important;
							}
						<?php } ?>

					.RW_Loader_Frame_Navigation{
						position:relative;			
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;						
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4{
						position:absolute;
						border:5px solid transparent;
						border-radius:50%;
					}
					.loader_Navigation1<?php echo $Rich_Web_Slider; ?>{
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
						}
						.loader_Navigation2<?php echo $Rich_Web_Slider; ?>{
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);	
						}
						.loader_Navigation3<?php echo $Rich_Web_Slider; ?>{
							width:60%;
							height:60%;
							top:50%;
							left:50%;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-ms-box-sizing:border-box;
							-moz-box-sizing:border-box;
							-o-box-sizing:border-box;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							-ms-transform:translateY(-50%) translateX(-50%);
							-moz-transform:translateY(-50%) translateX(-50%);
							-o-transform:translateY(-50%) translateX(-50%);
							animation:clockLoadingmin 1s linear 500;
							-webkit-animation:clockLoadingmin 1s linear 500;
							-ms-animation:clockLoadingmin 1s linear 500;
							-moz-animation:clockLoadingmin 1s linear 500;
							-o-animation:clockLoadingmin 1s linear 500;
						}
					.loader_Navigation1{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}


					/*Second Loader*/

					.overlay-loader<?php echo $Rich_Web_Slider; ?> {
						display: block;
						margin: auto;
						width: 97px;
						height: 60px;
						position: relative;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "small") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 40px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 49px !important;
	    						height: 49px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 3px !important;
								height: 3px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 9px !important;
								height: 9px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 19px !important;
								height: 19px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 24px !important;
								height: 24px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 28px !important;
								height: 28px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "middle") { ?>
							.overlay-loader<?php echo $Rich_Web_Slider; ?>{
								height: 50px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 67px !important;
	    						height: 67px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 8px !important;
								height: 8px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 14px !important;
								height: 14px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 20px !important;
								height: 20px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 26px !important;
								height: 26px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 32px !important;
								height: 32px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 38px !important;
								height: 38px !important;
							}
						<?php } else { ?>
							.loader<?php echo $Rich_Web_Slider; ?> {
								width: 97px !important;
	    						height: 97px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
								width: 12px !important;
								height: 12px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
								width: 18px !important;
								height: 18px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
								width: 23px !important;
								height: 23px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
								width: 31px !important;
								height: 31px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
								width: 39px !important;
								height: 39px !important;
							}
							.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
								width: 49px !important;
								height: 49px !important;
							}
						<?php } ?>

					.loader<?php echo $Rich_Web_Slider; ?> {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div {
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_C; ?>; 
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(odd) {
						border-top: none;
						border-left: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(even) {
						border-bottom: none;
						border-right: none;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(2) {
						border-width: 2px;
						left: 0px;
						top: -4px;
						width: 12px;
						height: 12px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(3) {
						border-width: 2px;
						left: -1px;
						top: 3px;
						width: 18px;
						height: 18px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(4) {
						border-width: 3px;
						left: -1px;
						top: -4px;
						width: 23px;
						height: 23px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(5) {
						border-width: 3px;
						left: -1px;
						top: 4px;
						width: 31px;
						height: 31px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(6) {
						border-width: 4px;
						left: 0px;
						top: -4px;
						width: 39px;
						height: 39px;
					}
					.loader<?php echo $Rich_Web_Slider; ?> div:nth-child(7) {
						border-width: 4px;
						left: 0px;
						top: 6px;
						width: 49px;
						height: 49px;
					}

					@keyframes rotateAnim {
						from {
							transform: rotate(360deg);
						}
						to {
							transform: rotate(0deg);
						}
					}

					@-o-keyframes rotateAnim {
						from {
							-o-transform: rotate(360deg);
						}
						to {
							-o-transform: rotate(0deg);
						}
					}

					@-ms-keyframes rotateAnim {
						from {
							-ms-transform: rotate(360deg);
						}
						to {
							-ms-transform: rotate(0deg);
						}
					}

					@-webkit-keyframes rotateAnim {
						from {
							-webkit-transform: rotate(360deg);
						}
						to {
							-webkit-transform: rotate(0deg);
						}
					}

					@-moz-keyframes rotateAnim {
						from {
							-moz-transform: rotate(360deg);
						}
						to {
							-moz-transform: rotate(0deg);
						}
					}


						/*Third Loader*/

						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "small") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 45px !important;
								height:45px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 42px !important;
								height: 42px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "middle") { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 60px !important;
								height:60px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 56px !important;
								height: 56px !important;
							}
						<?php } else { ?>
							.windows8<?php echo $Rich_Web_Slider; ?>{
								width: 78px !important;
								height:78px !important;
							}

							.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
								width: 74px !important;
								height: 74px !important;
							}
						<?php } ?>

					.windows8<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						width: 78px;
						height:78px;
						margin:auto;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall {
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> .wBall .wInnerBall{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_C; ?>; 
						left:0px;
						top:0px;
						border-radius: 10px;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_1 {
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_2 {
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_3 {
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_4 {
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}

					.windows8<?php echo $Rich_Web_Slider; ?> #wBall_5 {
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}



					@keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							transform: rotate(180deg);
							animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							transform: rotate(300deg);
							animation-timing-function: linear;
							origin:0%;
						}

						30% {
							opacity: 1;
							transform:rotate(410deg);
							animation-timing-function: ease-in-out;
							origin:7%;
						}

						39% {
							opacity: 1;
							transform: rotate(645deg);
							animation-timing-function: linear;
							origin:30%;
						}

						70% {
							opacity: 1;
							transform: rotate(770deg);
							animation-timing-function: ease-out;
							origin:39%;
						}

						75% {
							opacity: 1;
							transform: rotate(900deg);
							animation-timing-function: ease-out;
							origin:70%;
						}

						76% {
							opacity: 0;
							transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							transform: rotate(900deg);
						}
					}

					@-o-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-o-transform: rotate(180deg);
							-o-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-o-transform: rotate(300deg);
							-o-animation-timing-function: linear;
							-o-origin:0%;
						}

						30% {
							opacity: 1;
							-o-transform:rotate(410deg);
							-o-animation-timing-function: ease-in-out;
							-o-origin:7%;
						}

						39% {
							opacity: 1;
							-o-transform: rotate(645deg);
							-o-animation-timing-function: linear;
							-o-origin:30%;
						}

						70% {
							opacity: 1;
							-o-transform: rotate(770deg);
							-o-animation-timing-function: ease-out;
							-o-origin:39%;
						}

						75% {
							opacity: 1;
							-o-transform: rotate(900deg);
							-o-animation-timing-function: ease-out;
							-o-origin:70%;
						}

						76% {
							opacity: 0;
							-o-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-o-transform: rotate(900deg);
						}
					}

					@-ms-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-ms-transform: rotate(180deg);
							-ms-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-ms-transform: rotate(300deg);
							-ms-animation-timing-function: linear;
							-ms-origin:0%;
						}

						30% {
							opacity: 1;
							-ms-transform:rotate(410deg);
							-ms-animation-timing-function: ease-in-out;
							-ms-origin:7%;
						}

						39% {
							opacity: 1;
							-ms-transform: rotate(645deg);
							-ms-animation-timing-function: linear;
							-ms-origin:30%;
						}

						70% {
							opacity: 1;
							-ms-transform: rotate(770deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:39%;
						}

						75% {
							opacity: 1;
							-ms-transform: rotate(900deg);
							-ms-animation-timing-function: ease-out;
							-ms-origin:70%;
						}

						76% {
							opacity: 0;
							-ms-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-ms-transform: rotate(900deg);
						}
					}

					@-webkit-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-webkit-transform: rotate(180deg);
							-webkit-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-webkit-transform: rotate(300deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:0%;
						}

						30% {
							opacity: 1;
							-webkit-transform:rotate(410deg);
							-webkit-animation-timing-function: ease-in-out;
							-webkit-origin:7%;
						}

						39% {
							opacity: 1;
							-webkit-transform: rotate(645deg);
							-webkit-animation-timing-function: linear;
							-webkit-origin:30%;
						}

						70% {
							opacity: 1;
							-webkit-transform: rotate(770deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:39%;
						}

						75% {
							opacity: 1;
							-webkit-transform: rotate(900deg);
							-webkit-animation-timing-function: ease-out;
							-webkit-origin:70%;
						}

						76% {
							opacity: 0;
							-webkit-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-webkit-transform: rotate(900deg);
						}
					}

					@-moz-keyframes orbit {
						0% {
							opacity: 1;
							z-index:99;
							-moz-transform: rotate(180deg);
							-moz-animation-timing-function: ease-out;
						}

						7% {
							opacity: 1;
							-moz-transform: rotate(300deg);
							-moz-animation-timing-function: linear;
							-moz-origin:0%;
						}

						30% {
							opacity: 1;
							-moz-transform:rotate(410deg);
							-moz-animation-timing-function: ease-in-out;
							-moz-origin:7%;
						}

						39% {
							opacity: 1;
							-moz-transform: rotate(645deg);
							-moz-animation-timing-function: linear;
							-moz-origin:30%;
						}

						70% {
							opacity: 1;
							-moz-transform: rotate(770deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:39%;
						}

						75% {
							opacity: 1;
							-moz-transform: rotate(900deg);
							-moz-animation-timing-function: ease-out;
							-moz-origin:70%;
						}

						76% {
							opacity: 0;
							-moz-transform:rotate(900deg);
						}

						100% {
							opacity: 0;
							-moz-transform: rotate(900deg);
						}
					}

					/*Fourth loader*/

					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "small") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 30px !important;
								height: 30px !important;
							}
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_S == "middle") { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 40px !important;
								height: 40px !important;
							}
						<?php } else { ?>
							.cssload-thecube<?php echo $Rich_Web_Slider; ?>{
								width: 50px !important;
								height: 50px !important;
							}
						<?php } ?>

					.cssload-thecube<?php echo $Rich_Web_Slider; ?> {
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube {
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-cube:before {
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_C; ?>; 
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2 {
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3 {
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4 {
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c2:before {
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c3:before {
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo $Rich_Web_Slider; ?> .cssload-c4:before {
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}



					@keyframes cssload-fold-thecube {
						0%, 10% {
							transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-o-keyframes cssload-fold-thecube {
						0%, 10% {
							-o-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-o-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-o-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-ms-keyframes cssload-fold-thecube {
						0%, 10% {
							-ms-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-ms-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-ms-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-webkit-keyframes cssload-fold-thecube {
						0%, 10% {
							-webkit-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-webkit-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-webkit-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

					@-moz-keyframes cssload-fold-thecube {
						0%, 10% {
							-moz-transform: perspective(136px) rotateX(-180deg);
							opacity: 0;
						}
						25%,
									75% {
							-moz-transform: perspective(136px) rotateX(0deg);
							opacity: 1;
						}
						90%,
									100% {
							-moz-transform: perspective(136px) rotateY(180deg);
							opacity: 0;
						}
					}

						/*First Text*/

					.cssload-loader<?php echo $Rich_Web_Slider; ?> {
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FF; ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS; ?>px !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before, .cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_BC; ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::before {
						top: 0;
					}
					.cssload-loader<?php echo $Rich_Web_Slider; ?>::after {
						bottom: 0;
					}



					@keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-o-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-ms-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-webkit-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}

					@-moz-keyframes cssload-load {
						0% {
							left: 0;
							height: 29px;
							width: 15px;
						}
						50% {
							height: 8px;
							width: 39px;
						}
						100% {
							left: 229px;
							height: 29px;
							width: 15px;
						}
					}


						/*Second*/

					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						width:100%;
						margin:auto;
						text-align:center;
					}

					.inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>{
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					#inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>{
						animation-delay:<?php Print $anim_sum; ?>s !important;
						-o-animation-delay:<?php Print $anim_sum; ?>s !important;
						-ms-animation-delay:<?php Print $anim_sum; ?>s !important;
						-webkit-animation-delay:<?php Print $anim_sum; ?>s !important;
						-moz-animation-delay:<?php Print $anim_sum; ?>s !important;
					}
					<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>

					@keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						}
					}

					@-o-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						}
					}

					@-ms-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						}
					}

					@-webkit-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						}
					}

					@-moz-keyframes bounce_inTurnFadingTextG{
						0%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T2_AnC; ?>;
						}

						100%{
							color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
						}
					}

					/*Third text*/

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> {
						position: relative;
						top: 0px;
						left: 0px;
						right: 0px;
						bottom: 0px;
						z-index: 10;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> > .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box {
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}

					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div {
						position: relative;
						width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS*2; ?>px;
						height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS*2; ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS; ?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FF; ?> !important;
						color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_C; ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
					.cssload-preloader<?php echo $Rich_Web_Slider; ?> .cssload-preloader<?php echo $Rich_Web_Slider; ?>-box > div:nth-child(<?php Print $key+1; ?>) {
						background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_FS; ?>px !important;
						animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-o-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-ms-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
						-moz-animation: cssload-movement<?php echo $Rich_Web_Slider; ?> 690ms ease <?php Print $str_sum; ?>ms infinite alternate;
					}
					<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>


					@keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						}
					}

					@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-o-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						}
					}

					@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-ms-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						}
					}

					@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-webkit-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						}
					}

					@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider; ?> {
						from {
							-moz-transform: scale(1.0) translateY(0px) rotateX(0deg);
							box-shadow: 0 0 0 rgba(0,0,0,0);
						}
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?>;
							background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T3_BgC; ?> !important;
						}
					}

				.cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>{
					width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_W;?>px !important;
					border:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BW;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BS;?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BC;?> !important;
					border-radius:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BR;?>px !important;
					
				}
				<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_BS=="Type 1"){ ?>
				.cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>{
					box-shadow:0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_ShC;?> !important;
				}
				<?php }else{?>
				.cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>{
					box-shadow:0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_ShC;?> !important;
				}
				<?php } ?>
				.RW_Title<?php echo $Rich_Web_Slider; ?>{
					font-size:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FS;?>px !important;
					font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FF;?> !important;
					color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_C;?> !important;
					background-color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_BgC;?> !important;
					text-align:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_TA;?> !important;
					padding:0px !important;
					height:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FS*2;?>px;
					line-height:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FS*2;?>px;
				}
				<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_Sh == "true"){ ?>
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?>{
					display:block !important;
				}
				<?php }else{ ?>
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?>{
					display:none !important;
				}
				<?php } ?>
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?> a{
					width:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_S;?>px !important;
					height:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_S;?>px !important;
					border:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_BW;?>px solid <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_BC;?> !important;
					background-color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_BgC;?> !important;
				}
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?> a:hover{
					background-color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_HBgC;?> !important;
				}
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?> li.selected a{
					background-color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_CC;?> !important;
					outline:none !important;
				}
				.cd-slider-controls<?php echo $Rich_Web_Slider; ?> li{
					margin-right:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_N_M;?>px !important;
				}
				<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_Sh == "true"){ ?>
				.cd-slider-navigation<?php echo $Rich_Web_Slider; ?>{
					display:block !important;
				}
				<?php }else{ ?>
				.cd-slider-navigation<?php echo $Rich_Web_Slider; ?>{
					display:none !important;
				}
				<?php } ?>
				.RW_CL<?php echo $Rich_Web_Slider; ?> {
				  position:relative;
				  display: inline-block;
				  text-decoration:none !important;
				  top:50%;
				  transform:translateY(-50%);
				  -webkit-transform:translateY(-50%) ;
				  -ms-transform:translateY(-50%);
				  -moz-transform:translateY(-50%);
				  -o-transform:translateY(-50%);
				  font-size:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_S;?>px !important;
				  height:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_S;?>px !important;
				  color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_C;?> !important;
				  overflow: hidden;
				  white-space: nowrap;
				  opacity:0.7;
				  cursor:pointer;
				  -webkit-transition: -webkit-transform 0.2s;
				  -moz-transition: -moz-transform 0.2s;
				  transition: transform 0.2s;
				}
				.RW_CL<?php echo $Rich_Web_Slider; ?>:hover{
					opacity:1;
				}
				.RW_CL_N<?php echo $Rich_Web_Slider; ?>{
					margin-right:5px !important;
					float:right;
				}
				.RW_CL_P<?php echo $Rich_Web_Slider; ?>{
					margin-left:5px !important;
					float:left;
				}
				<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_Sh == "27" || $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_Sh == "28"){ ?>
				.RW_CL_N<?php echo $Rich_Web_Slider; ?>{
					margin-right:0px !important;
				}
				.RW_CL_P<?php echo $Rich_Web_Slider; ?>{
					margin-left:0px !important;
				}
				<?php }else{ ?>
				.RW_CL_N<?php echo $Rich_Web_Slider; ?>{
					margin-right:5px !important;
				}
				.RW_CL_P<?php echo $Rich_Web_Slider; ?>{
					margin-left:5px !important;
				}
				<?php } ?>
				@media screen and (max-width:600px){
					.RW_Title<?php echo $Rich_Web_Slider; ?>{
						font-size:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FS*3/4;?>px !important;
						font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_FF;?> !important;
						color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_C;?> !important;
						background-color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_BgC;?> !important;
						text-align:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_TA;?> !important;
						padding:5px !important;
					}
				}

				.comment_content .cd-slider li:before, .entry-content .cd-slider li:before{
					display:none !important;
				}
				.cd-slider-navigation<?php echo $Rich_Web_Slider; ?> li:before{
					display:none !important;
				}
				
			</style>
			<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>" style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
				<div class="center_content<?php echo $Rich_Web_Slider; ?>">
					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_Show == "true") { ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T == "Type 1") { ?>
						<div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider; ?>">
							<div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation1"></div>
							<div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation2"></div>
							<div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider; ?>" id="loader_Navigation3"></div>
							<div class="loader_Navigation4" id="loader_Navigation4"></div>
						</div>
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T == "Type 2") { ?>
						<div class="overlay-loader<?php echo $Rich_Web_Slider; ?>">
							<div class="loader<?php echo $Rich_Web_Slider; ?>">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T == "Type 3") { ?>
						<div class="windows8<?php echo $Rich_Web_Slider; ?>">
							<div class="wBall" id="wBall_1">
								<div class="wInnerBall"></div>
							</div>
							<div class="wBall" id="wBall_2">
								<div class="wInnerBall"></div>
							</div>
							<div class="wBall" id="wBall_3">
								<div class="wInnerBall"></div>
							</div>
							<div class="wBall" id="wBall_4">
								<div class="wInnerBall"></div>
							</div>
							<div class="wBall" id="wBall_5">
								<div class="wInnerBall"></div>
							</div>
						</div>
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_L_T == "Type 4") { ?>
						<div class="cssload-thecube<?php echo $Rich_Web_Slider; ?>">
							<div class="cssload-cube cssload-c1"></div>
							<div class="cssload-cube cssload-c2"></div>
							<div class="cssload-cube cssload-c4"></div>
							<div class="cssload-cube cssload-c3"></div>
						</div>
						<?php } ?>
					<?php } ?>
					<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_Show == "true") { ?>
						<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T == "Type 1") { ?>
						<div class="cssload-loader<?php echo $Rich_Web_Slider; ?>"><?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT;?></div>
							<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T == "Type 2") { ?>
						<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>">
							<?php foreach($text_array as $key=>$v){ ?>	
								<div id="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>_<?php Print $key+1; ?>" class="inTurnFadingTextG<?php echo $Rich_Web_Slider; ?>"><?php Print $v; ?></div>
							<?php } ?>
						</div>
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T == "Type 3") { ?>
						<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>">
							<div class="cssload-preloader<?php echo $Rich_Web_Slider; ?>-box">
								<?php foreach($text_array as $key=>$v){ ?>	
									<div><?php Print $v; ?></div>
								<?php } ?>
							</div>
						</div>
						<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT_T == "Type 4") { ?>
						<div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider; ?>">
							<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AnimSl_LT;?>
						</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<div class="cd-slider-wrapper cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>" style="display:none;">
				<!-- <div id="RW_Load_Content<?php echo $Rich_Web_Slider; ?>">
					<div class="RW_Loader_Frame">
						<div class="loader1 loader1<?php echo $Rich_Web_Slider; ?>" id="loader1"></div>
						<div class="loader2 loader2<?php echo $Rich_Web_Slider; ?>" id="loader2"></div>
						<div class="loader3 loader3<?php echo $Rich_Web_Slider; ?>" id="loader3"></div>
						<div class="loader4" id="loader4"></div>
					</div>
					<div class="RW_Loader_Text<?php echo $Rich_Web_Slider; ?>">
						<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_L_T;?>
					</div>
				</div> -->
				<ul class="cd-slider" >
					<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
						<li style="padding:0px;margin:0px;" class="visible RW_Im_An_Sl RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?> RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?><?php echo $i+1; ?>">
							<div class="cd-svg-wrapper">
								<img  class="RW_ANMSL_Image RW_ANMSL_Image<?php echo $Rich_Web_Slider; ?>" src="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Img_Url;?>" />
							</div>
						</li>
						<?php if($Rich_Web_Slider_Images[$i]->SL_Img_Title == ""){ ?>
						<div style="opacity:0" class="RW_Title RW_Title<?php echo $Rich_Web_Slider; ?> RW_Title_Ef<?php echo $Rich_Web_Slider; ?><?php echo $i+1; ?>"><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></div>
						<?php } else { ?>
						<div style="opacity:1" class="RW_Title RW_Title<?php echo $Rich_Web_Slider; ?> RW_Title_Ef<?php echo $Rich_Web_Slider; ?><?php echo $i+1; ?>"><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></div>
						<?php } ?>
					<?php } ?>
				</ul>
				<ul class="cd-slider-navigation cd-slider-navigation<?php echo $Rich_Web_Slider; ?>">
					<?php if($Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_ShC=="Icon"){ ?>
					<li style="padding:0px;margin:0px;" class="RW_Right_Anim_Sl"><i class="next-slide RW_CL_N RW_CL_N<?php echo $Rich_Web_Slider; ?> RW_CL RW_CL<?php echo $Rich_Web_Slider; ?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_T;?>-right"></i></li>
					<li style="padding:0px;margin:0px;" class="RW_Left_Anim_Sl"><i class="prev-slide RW_CL_P RW_CL_P<?php echo $Rich_Web_Slider; ?> RW_CL RW_CL<?php echo $Rich_Web_Slider; ?> <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_Ic_T;?>-left"></i></li>
					<?php }else{ ?>
					<li style="padding:0px;" class="RW_Right_Anim_Sl"><img src="<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_Sh .'-'. $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_Sh .'.png',__FILE__)?>" class="next-slide RW_CL_N RW_CL_N<?php echo $Rich_Web_Slider; ?> RW_CL RW_CL<?php echo $Rich_Web_Slider; ?>"></li>
					<li style="padding:0px;margin:0px;" class="RW_Left_Anim_Sl"><img src="<?php echo plugins_url('/Images/icon-'. $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_T_Sh .'.png',__FILE__)?>" class="prev-slide RW_CL_P RW_CL_P<?php echo $Rich_Web_Slider; ?> RW_CL RW_CL<?php echo $Rich_Web_Slider; ?>"></li>
					<?php } ?>
				</ul> 
				<div class="cd-slider-controls cd-slider-controls<?php echo $Rich_Web_Slider; ?>" style="display:none;">
				<?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
					<?php if($i==0){ ?>
					<li style="padding:0px;margin:0px;" class="selected"><a class="RW_Thumb<?php echo $Rich_Web_Slider; ?>" href="#0" name="<?php echo $i+1; ?>"><em>Item <?php echo $i+1; ?></em></a></li>
					<?php }else{ ?>
					<li style="padding:0px;margin:0px;"><a class="RW_Thumb<?php echo $Rich_Web_Slider; ?>" href="#0" name="<?php echo $i+1; ?>"><em>Item <?php echo $i+1; ?></em></a></li>
					<?php } ?>
				<?php } ?>
				</div>
			</div>
			<input type="text" style="display:none" class="CountShort<?php echo $Rich_Web_Slider; ?>" value="<?php echo count($Rich_Web_Slider_Images); ?>">
			<input type="text" style="display:none" class="Rich_Web_AnSL_H<?php echo $Rich_Web_Slider; ?>" value="<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_H;?>">
			<input type="text" style="display:none" class="Rich_Web_AnSL_ET<?php echo $Rich_Web_Slider; ?>" value="<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_ET;?>">
			<input type="text" style="display:none" class="Rich_Web_AnSL_SSh<?php echo $Rich_Web_Slider; ?>" value="<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_SSh;?>">
			<input type="text" style="display:none" class="Rich_Web_AnSL_SShChT<?php echo $Rich_Web_Slider; ?>" value="<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AnSL_SShChT;?>">
			
			<script>
			var Rich_Web_AnSL_ET<?php echo $Rich_Web_Slider; ?> = parseInt(jQuery(".Rich_Web_AnSL_ET<?php echo $Rich_Web_Slider; ?>").val());
			var Rich_Web_AnSL_SSh<?php echo $Rich_Web_Slider; ?> = jQuery(".Rich_Web_AnSL_SSh<?php echo $Rich_Web_Slider; ?>").val();
			var Rich_Web_AnSL_SShChT<?php echo $Rich_Web_Slider; ?> = parseInt(jQuery(".Rich_Web_AnSL_SShChT<?php echo $Rich_Web_Slider; ?>").val());
			var animateEffect<?php echo $Rich_Web_Slider; ?>=Rich_Web_AnSL_ET<?php echo $Rich_Web_Slider; ?>;
			var CountShort<?php echo $Rich_Web_Slider; ?>=parseInt(jQuery(".CountShort<?php echo $Rich_Web_Slider; ?>").val());
			var count<?php echo $Rich_Web_Slider; ?>=1;
			var y_y<?php echo $Rich_Web_Slider; ?>=false;
			var zIndex<?php echo $Rich_Web_Slider; ?>=0;
			var thumbCount<?php echo $Rich_Web_Slider; ?>=1;
			var anim_over<?php echo $Rich_Web_Slider; ?>=0;
			var array<?php echo $Rich_Web_Slider; ?>=[];
			jQuery(".RW_ANMSL_Image<?php echo $Rich_Web_Slider; ?>").each(function(){
				array<?php echo $Rich_Web_Slider; ?>.push(jQuery(this).attr("src"));
			})
			var y<?php echo $Rich_Web_Slider; ?>=0;
			var Rich_Web_AnSL_H = parseInt(jQuery(".Rich_Web_AnSL_H<?php echo $Rich_Web_Slider; ?>").val());
			function resp<?php echo $Rich_Web_Slider; ?>(){
				jQuery(".cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>,#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>").css("height",Rich_Web_AnSL_H*jQuery(".cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>").width()/1000);
			}
	   		jQuery(window).resize(function(){
				resp<?php echo $Rich_Web_Slider; ?>();
			})
			for(i=0;i<array<?php echo $Rich_Web_Slider; ?>.length;i++){
				jQuery("<img class='RW_ANMSL_Image<?php echo $Rich_Web_Slider; ?>' />").attr('src', array<?php echo $Rich_Web_Slider; ?>[i]).on("load",function(){
	   			 	y<?php echo $Rich_Web_Slider; ?>++;
	   			 	if(y<?php echo $Rich_Web_Slider; ?>==array<?php echo $Rich_Web_Slider; ?>.length){
	   			 		jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider; ?>").remove();
						jQuery(".cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>").fadeIn(1000);
						jQuery(".cd-slider-navigation<?php echo $Rich_Web_Slider; ?>").css("display","block");
						jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?>").css("display","block");
						jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").css("borderRadius","0% 0% 0% 0%");
						jQuery('.RW_Title<?php echo $Rich_Web_Slider; ?>').hide();
						jQuery('.RW_Title_Ef<?php echo $Rich_Web_Slider; ?>1').show();
						
						if(animateEffect<?php echo $Rich_Web_Slider; ?>==1 || animateEffect<?php echo $Rich_Web_Slider; ?>==2 || animateEffect<?php echo $Rich_Web_Slider; ?>==3 || animateEffect<?php echo $Rich_Web_Slider; ?>==4 || animateEffect<?php echo $Rich_Web_Slider; ?>==5){
							anim_over<?php echo $Rich_Web_Slider; ?>=300;
						}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==14){
							anim_over<?php echo $Rich_Web_Slider; ?>=0;
						}else{
							anim_over<?php echo $Rich_Web_Slider; ?>=1000;
						}
						jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").addClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
						jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>1").removeClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
						function nextAnim<?php echo $Rich_Web_Slider; ?>(){
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?> li").removeClass("selected");
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?> li").eq(count<?php echo $Rich_Web_Slider; ?>-1).addClass("selected");
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==1){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","0% 0% 0% 100%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==2){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","100% 0% 0% 0%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==3){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","100% 0% 0% 100%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","100% 100% 0% 0%");
							}
							jQuery('.RW_Title_Ef<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).slideDown(anim_over<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".cd-slider-navigation<?php echo $Rich_Web_Slider; ?> li").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?>").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".RW_Title<?php echo $Rich_Web_Slider; ?>").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).removeClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).addClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==1 || animateEffect<?php echo $Rich_Web_Slider; ?>==2 || animateEffect<?php echo $Rich_Web_Slider; ?>==3 || animateEffect<?php echo $Rich_Web_Slider; ?>==12 || animateEffect<?php echo $Rich_Web_Slider; ?>==13){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").addClass("RW_Im_An_Sl_right");
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").removeClass("RW_Im_An_Sl_left");
							}
							setTimeout(function(){
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>').removeClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>').addClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).removeClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).addClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							},anim_over<?php echo $Rich_Web_Slider; ?>)	
							thumbCount<?php echo $Rich_Web_Slider; ?>=count<?php echo $Rich_Web_Slider; ?>;		
							y_y<?php echo $Rich_Web_Slider; ?>=true;
							setTimeout(function(){
								y_y<?php echo $Rich_Web_Slider; ?>=false;
							},500)
						}
						function prevAnim<?php echo $Rich_Web_Slider; ?>(){
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?> li").removeClass("selected");
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?> li").eq(count<?php echo $Rich_Web_Slider; ?>-1).addClass("selected");
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==1){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","0% 0% 100% 0%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==2){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","0% 100% 0% 0%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==3){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","0% 100% 100% 0%");
							}else if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>"+count<?php echo $Rich_Web_Slider; ?>).css("borderRadius","0% 0% 100% 100%");
							}
							jQuery('.RW_Title_Ef<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).slideDown(anim_over<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".cd-slider-navigation<?php echo $Rich_Web_Slider; ?> li").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".cd-slider-controls<?php echo $Rich_Web_Slider; ?>").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery(".RW_Title<?php echo $Rich_Web_Slider; ?>").css("z-index",zIndex<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).addClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).removeClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==1 || animateEffect<?php echo $Rich_Web_Slider; ?>==2 || animateEffect<?php echo $Rich_Web_Slider; ?>==3 || animateEffect<?php echo $Rich_Web_Slider; ?>==12 || animateEffect<?php echo $Rich_Web_Slider; ?>==13){
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").addClass("RW_Im_An_Sl_left");
								jQuery(".RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>").removeClass("RW_Im_An_Sl_right");
							}
							setTimeout(function(){
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>').removeClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>').addClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).addClass("RW_Im_An_Sl_AddAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
								jQuery('.RW_Im_An_Sl<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).removeClass("RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>);
							},anim_over<?php echo $Rich_Web_Slider; ?>)
							thumbCount<?php echo $Rich_Web_Slider; ?>=count<?php echo $Rich_Web_Slider; ?>;
							y_y<?php echo $Rich_Web_Slider; ?>=true;
							setTimeout(function(){
								y_y<?php echo $Rich_Web_Slider; ?>=false;
							},500)
						}
						function prev<?php echo $Rich_Web_Slider; ?>(){
							if(y_y<?php echo $Rich_Web_Slider; ?>==true){
								return;
							}
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
								jQuery(".RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>).css("top","0%");
							}
							zIndex<?php echo $Rich_Web_Slider; ?>++;
							jQuery('.RW_Title_Ef<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).slideUp(anim_over<?php echo $Rich_Web_Slider; ?>);
							count<?php echo $Rich_Web_Slider; ?>--;
							if(count<?php echo $Rich_Web_Slider; ?>==0){
								count<?php echo $Rich_Web_Slider; ?>=CountShort<?php echo $Rich_Web_Slider; ?>;
							}
							prevAnim<?php echo $Rich_Web_Slider; ?>();
						}
						function next<?php echo $Rich_Web_Slider; ?>(){
							if(y_y<?php echo $Rich_Web_Slider; ?>==true){
								return;
							}
							if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
								jQuery(".RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>).css("top","100%");
							}
							zIndex<?php echo $Rich_Web_Slider; ?>++;
							jQuery('.RW_Title_Ef<?php echo $Rich_Web_Slider; ?>'+count<?php echo $Rich_Web_Slider; ?>).slideUp(anim_over<?php echo $Rich_Web_Slider; ?>);
							count<?php echo $Rich_Web_Slider; ?>++;
							if(count<?php echo $Rich_Web_Slider; ?>==CountShort<?php echo $Rich_Web_Slider; ?>+1){
								count<?php echo $Rich_Web_Slider; ?>=1;
							}
							nextAnim<?php echo $Rich_Web_Slider; ?>();
						}
						var Interval<?php echo $Rich_Web_Slider; ?>;
						if(Rich_Web_AnSL_SSh<?php echo $Rich_Web_Slider; ?> == "true"){
							Interval<?php echo $Rich_Web_Slider; ?>=setInterval(function(){
								next<?php echo $Rich_Web_Slider; ?>();
							},(Rich_Web_AnSL_SShChT<?php echo $Rich_Web_Slider; ?>/10)*CountShort<?php echo $Rich_Web_Slider; ?>*2) 
							jQuery(".RW_CL_N<?php echo $Rich_Web_Slider; ?>").bind("click",function(){
								next<?php echo $Rich_Web_Slider; ?>();
								console.log(y_y<?php echo $Rich_Web_Slider; ?>);
							})
							jQuery(".RW_CL_P<?php echo $Rich_Web_Slider; ?>").bind("click",function(){
								prev<?php echo $Rich_Web_Slider; ?>();
							})
							jQuery( ".cd-slider-wrapper<?php echo $Rich_Web_Slider; ?>" )
							  .mouseout(function() {
							    Interval<?php echo $Rich_Web_Slider; ?>=setInterval(function(){
									next<?php echo $Rich_Web_Slider; ?>();
								},(Rich_Web_AnSL_SShChT<?php echo $Rich_Web_Slider; ?>/10)*CountShort<?php echo $Rich_Web_Slider; ?>*2) 
							  })
							  .mouseover(function() {
							  	clearInterval(Interval<?php echo $Rich_Web_Slider; ?>);
							  })
						}else{
							jQuery(".RW_CL_N<?php echo $Rich_Web_Slider; ?>").bind("click",function(){
								next<?php echo $Rich_Web_Slider; ?>();
								console.log(y_y<?php echo $Rich_Web_Slider; ?>);
							})
							jQuery(".RW_CL_P<?php echo $Rich_Web_Slider; ?>").bind("click",function(){
								prev<?php echo $Rich_Web_Slider; ?>();
							})
						}
						
						jQuery(".RW_Thumb<?php echo $Rich_Web_Slider; ?>").click(function(){
							console.log(thumbCount<?php echo $Rich_Web_Slider; ?>);
							count<?php echo $Rich_Web_Slider; ?>=parseInt(jQuery(this).attr("name"));
							if(count<?php echo $Rich_Web_Slider; ?> != thumbCount<?php echo $Rich_Web_Slider; ?>){
								jQuery('.RW_Title<?php echo $Rich_Web_Slider; ?>').slideUp(500);
							}
							
							zIndex<?php echo $Rich_Web_Slider; ?>++;
							if(count<?php echo $Rich_Web_Slider; ?> > thumbCount<?php echo $Rich_Web_Slider; ?>){
								if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
									jQuery(".RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>).css("top","100%");
								}
								nextAnim<?php echo $Rich_Web_Slider; ?>();
							}else if(count<?php echo $Rich_Web_Slider; ?> < thumbCount<?php echo $Rich_Web_Slider; ?>){
								if(animateEffect<?php echo $Rich_Web_Slider; ?>==4){
									jQuery(".RW_Im_An_Sl_RAnim"+animateEffect<?php echo $Rich_Web_Slider; ?>).css("top","0%");
								}
								prevAnim<?php echo $Rich_Web_Slider; ?>();
							}
							thumbCount<?php echo $Rich_Web_Slider; ?>=count<?php echo $Rich_Web_Slider; ?>;
							y_y<?php echo $Rich_Web_Slider; ?>=true;
							setTimeout(function(){
								y_y<?php echo $Rich_Web_Slider; ?>=false;
							},500)
						})
						resp<?php echo $Rich_Web_Slider; ?>();	
	   			 	}
	   			})
			}
			</script>
			<?php
			}
			echo $after_widget;
 		}
	}
?>