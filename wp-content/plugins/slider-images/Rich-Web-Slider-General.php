<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}

	global $wpdb;
	$table_name   = $wpdb->prefix . "rich_web_photo_slider_manager";
	$table_name1  = $wpdb->prefix . "rich_web_photo_slider_instal";
	$table_name2  = $wpdb->prefix . "rich_web_slider_effects_data";
	$table_name3  = $wpdb->prefix . "rich_web_slider_font_family";
	$table_name4  = $wpdb->prefix . "rich_web_slider_id";
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

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(check_admin_referer( 'edit-menu_'.$comment_id, 'Rich_Web_PSlider_Nonce' ))
		{	
			$Rich_Web_slider_name=sanitize_text_field($_POST['rich_web_slider_name']); $Rich_Web_slider_type=sanitize_text_field($_POST['rich_web_slider_type']);
			//Slider Navigation
			$Rich_Web_Sl1_SlS=sanitize_text_field($_POST['rich_web_Sl1_SlS']); $Rich_Web_Sl1_PoH=sanitize_text_field($_POST['rich_web_Sl1_PoH']); $Rich_Web_Sl1_W=sanitize_text_field($_POST['rich_web_Sl1_W']); $Rich_Web_Sl1_H=sanitize_text_field($_POST['rich_web_Sl1_H']);
			//Content Slider
			$rich_CS_BIB=sanitize_text_field($_POST['rich_CS_BIB']); $rich_CS_Loop=sanitize_text_field($_POST['rich_CS_Loop']); $rich_CS_Cont_W=sanitize_text_field($_POST['rich_CS_Cont_W']); $rich_CS_Cont_H=sanitize_text_field($_POST['rich_CS_Cont_H']); $rich_CS_Cont_BW=sanitize_text_field($_POST['rich_CS_Cont_BW']); $rich_CS_Cont_BS=sanitize_text_field($_POST['rich_CS_Cont_BS']); $rich_CS_Cont_BC=sanitize_text_field($_POST['rich_CS_Cont_BC']); $rich_CS_Cont_BR=sanitize_text_field($_POST['rich_CS_Cont_BR']);
			//Fashion Slider	
			$rich_fsl_PPL_Show=sanitize_text_field($_POST['rich_fsl_PPL_Show']); $rich_fsl_Loop=sanitize_text_field($_POST['rich_fsl_Loop']); $rich_fsl_Width=sanitize_text_field($_POST['rich_fsl_Width']); $rich_fsl_Height=sanitize_text_field($_POST['rich_fsl_Height']); $rich_fsl_Border_Width=sanitize_text_field($_POST['rich_fsl_Border_Width']); $rich_fsl_Border_Style=sanitize_text_field($_POST['rich_fsl_Border_Style']); $rich_fsl_Border_Color=sanitize_text_field($_POST['rich_fsl_Border_Color']);
			//Circle Thumbnails Slider
			$Rich_Web_Sl_CT_W=sanitize_text_field($_POST['Rich_Web_Sl_CT_W']); $Rich_Web_Sl_CT_H=sanitize_text_field($_POST['Rich_Web_Sl_CT_H']); $Rich_Web_Sl_CT_BW=sanitize_text_field($_POST['Rich_Web_Sl_CT_BW']); $Rich_Web_Sl_CT_BS=sanitize_text_field($_POST['Rich_Web_Sl_CT_BS']); $Rich_Web_Sl_CT_BC=sanitize_text_field($_POST['Rich_Web_Sl_CT_BC']);
			//Slider Carousel
			$Rich_Web_Sl_SC_BW=sanitize_text_field($_POST['Rich_Web_Sl_SC_BW']); $Rich_Web_Sl_SC_BS=sanitize_text_field($_POST['Rich_Web_Sl_SC_BS']); $Rich_Web_Sl_SC_BC=sanitize_text_field($_POST['Rich_Web_Sl_SC_BC']); $Rich_Web_Sl_SC_IW=sanitize_text_field($_POST['Rich_Web_Sl_SC_IW']); $Rich_Web_Sl_SC_IH=sanitize_text_field($_POST['Rich_Web_Sl_SC_IH']); 
			//Flexible Slider
			$Rich_Web_Sl_FS_I_W=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_W']); $Rich_Web_Sl_FS_I_H=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_H']); $Rich_Web_Sl_FS_I_BW=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_BW']); $Rich_Web_Sl_FS_I_BS=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_BS']); $Rich_Web_Sl_FS_I_BC=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_BC']); $Rich_Web_Sl_FS_I_BR=sanitize_text_field($_POST['Rich_Web_Sl_FS_I_BR']);
			//Dymanic Slider
			$Rich_Web_Sl_DS_H=sanitize_text_field($_POST['Rich_Web_Sl_DS_H']); $Rich_Web_Sl_DS_BW=sanitize_text_field($_POST['Rich_Web_Sl_DS_BW']); $Rich_Web_Sl_DS_BS=sanitize_text_field($_POST['Rich_Web_Sl_DS_BS']); $Rich_Web_Sl_DS_BC=sanitize_text_field($_POST['Rich_Web_Sl_DS_BC']);
			//Thumbnails Slider & Lightbox
			$Rich_Web_Sl_TSL_W=sanitize_text_field($_POST['Rich_Web_Sl_TSL_W']); $Rich_Web_Sl_TSL_H=sanitize_text_field($_POST['Rich_Web_Sl_TSL_H']); $Rich_Web_Sl_TSL_BW=sanitize_text_field($_POST['Rich_Web_Sl_TSL_BW']); $Rich_Web_Sl_TSL_BS=sanitize_text_field($_POST['Rich_Web_Sl_TSL_BS']); $Rich_Web_Sl_TSL_BC=sanitize_text_field($_POST['Rich_Web_Sl_TSL_BC']); $Rich_Web_Sl_TSL_BR=sanitize_text_field($_POST['Rich_Web_Sl_TSL_BR']);
			//Animation Slider
			$Rich_Web_AnSL_W=sanitize_text_field($_POST['Rich_Web_AnSL_W']); $Rich_Web_AnSL_H=sanitize_text_field($_POST['Rich_Web_AnSL_H']); $Rich_Web_AnSL_BW=sanitize_text_field($_POST['Rich_Web_AnSL_BW']); $Rich_Web_AnSL_BS=sanitize_text_field($_POST['Rich_Web_AnSL_BS']); $Rich_Web_AnSL_BC=sanitize_text_field($_POST['Rich_Web_AnSL_BC']); $Rich_Web_AnSL_BR=sanitize_text_field($_POST['Rich_Web_AnSL_BR']);

			//Navigation Slider Loading

			$Rich_Web_NSL_L_Show=sanitize_text_field($_POST['Rich_Web_NSL_L_Show']); $Rich_Web_NSL_LT_Show=sanitize_text_field($_POST['Rich_Web_NSL_LT_Show']); $Rich_Web_NSL_LT=sanitize_text_field($_POST['Rich_Web_NSL_LT']); $Rich_Web_NSL_L_BgC=sanitize_text_field($_POST['Rich_Web_NSL_L_BgC']); $Rich_Web_NSL_L_T=sanitize_text_field($_POST['Rich_Web_NSL_L_T']); $Rich_Web_NSL_LT_T=sanitize_text_field($_POST['Rich_Web_NSL_LT_T']); $Rich_Web_NSL_LT_FS=sanitize_text_field($_POST['Rich_Web_NSL_LT_FS']);$Rich_Web_NSL_LT_FF=sanitize_text_field($_POST['Rich_Web_NSL_LT_FF']); $Rich_Web_NSL_LT_C=sanitize_text_field($_POST['Rich_Web_NSL_LT_C']); $Rich_Web_NSL_L_T1_C=sanitize_text_field($_POST['Rich_Web_NSL_L_T1_C']); $Rich_Web_NSL_L_T2_C=sanitize_text_field($_POST['Rich_Web_NSL_L_T2_C']); $Rich_Web_NSL_L_T3_C=sanitize_text_field($_POST['Rich_Web_NSL_L_T3_C']); $Rich_Web_NSL_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_NSL_LT_T2_BC']); $Rich_Web_NSL_L_C=sanitize_text_field($_POST['Rich_Web_NSL_L_C']); $Rich_Web_NSL_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_NSL_LT_T2_AnC']); $Rich_Web_NSL_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_NSL_LT_T3_BgC']); $Rich_Web_NSL_L_S=sanitize_text_field($_POST['Rich_Web_NSL_L_S']); $Rich_Web_NSL_Loading_Show=sanitize_text_field($_POST['Rich_Web_NSL_Loading_Show']); 

			//Content Slider Loading

			$Rich_Web_ContSl_L_Show=sanitize_text_field($_POST['Rich_Web_ContSl_L_Show']); $Rich_Web_ContSl_LT_Show=sanitize_text_field($_POST['Rich_Web_ContSl_LT_Show']); $Rich_Web_ContSl_LT=sanitize_text_field($_POST['Rich_Web_ContSl_LT']); $Rich_Web_ContSl_L_BgC=sanitize_text_field($_POST['Rich_Web_ContSl_L_BgC']); $Rich_Web_ContSl_L_T=sanitize_text_field($_POST['Rich_Web_ContSl_L_T']); $Rich_Web_ContSl_LT_T=sanitize_text_field($_POST['Rich_Web_ContSl_LT_T']); $Rich_Web_ContSl_LT_FS=sanitize_text_field($_POST['Rich_Web_ContSl_LT_FS']); $Rich_Web_ContSl_LT_FF=sanitize_text_field($_POST['Rich_Web_ContSl_LT_FF']); $Rich_Web_ContSl_LT_C=sanitize_text_field($_POST['Rich_Web_ContSl_LT_C']); $Rich_Web_ContSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_ContSl_L_T1_C']); $Rich_Web_ContSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_ContSl_L_T2_C']); $Rich_Web_ContSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_ContSl_L_T3_C']); $Rich_Web_ContSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_ContSl_LT_T2_BC']); $Rich_Web_ContSl_L_C=sanitize_text_field($_POST['Rich_Web_ContSl_L_C']); $Rich_Web_ContSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_ContSl_LT_T2_AnC']); $Rich_Web_ContSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_ContSl_LT_T3_BgC']); $Rich_Web_ContSl_L_S=sanitize_text_field($_POST['Rich_Web_ContSl_L_S']); $Rich_Web_ContSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_ContSl_Loading_Show']); 

			//Fashion Slider Loading

			$Rich_Web_FSl_L_Show=sanitize_text_field($_POST['Rich_Web_FSl_L_Show']); $Rich_Web_FSl_LT_Show=sanitize_text_field($_POST['Rich_Web_FSl_LT_Show']); $Rich_Web_FSl_LT=sanitize_text_field($_POST['Rich_Web_FSl_LT']); $Rich_Web_FSl_L_BgC=sanitize_text_field($_POST['Rich_Web_FSl_L_BgC']); $Rich_Web_FSl_L_T=sanitize_text_field($_POST['Rich_Web_FSl_L_T']); $Rich_Web_FSl_LT_T=sanitize_text_field($_POST['Rich_Web_FSl_LT_T']); $Rich_Web_FSl_LT_FS=sanitize_text_field($_POST['Rich_Web_FSl_LT_FS']); $Rich_Web_FSl_LT_FF=sanitize_text_field($_POST['Rich_Web_FSl_LT_FF']); $Rich_Web_FSl_LT_C=sanitize_text_field($_POST['Rich_Web_FSl_LT_C']); $Rich_Web_FSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_FSl_L_T1_C']); $Rich_Web_FSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_FSl_L_T2_C']); $Rich_Web_FSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_FSl_L_T3_C']); $Rich_Web_FSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_FSl_LT_T2_BC']); $Rich_Web_FSl_L_C=sanitize_text_field($_POST['Rich_Web_FSl_L_C']); $Rich_Web_FSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_FSl_LT_T2_AnC']); $Rich_Web_FSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_FSl_LT_T3_BgC']); $Rich_Web_FSl_L_S=sanitize_text_field($_POST['Rich_Web_FSl_L_S']); $Rich_Web_FSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_FSl_Loading_Show']); 

			//Circle Slider Loading

			$Rich_Web_CircleSl_L_Show=sanitize_text_field($_POST['Rich_Web_CircleSl_L_Show']); $Rich_Web_CircleSl_LT_Show=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_Show']); $Rich_Web_CircleSl_LT=sanitize_text_field($_POST['Rich_Web_CircleSl_LT']); $Rich_Web_CircleSl_L_BgC=sanitize_text_field($_POST['Rich_Web_CircleSl_L_BgC']); $Rich_Web_CircleSl_L_T=sanitize_text_field($_POST['Rich_Web_CircleSl_L_T']); $Rich_Web_CircleSl_LT_T=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_T']); $Rich_Web_CircleSl_LT_FS=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_FS']); $Rich_Web_CircleSl_LT_FF=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_FF']); $Rich_Web_CircleSl_LT_C=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_C']); $Rich_Web_CircleSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_CircleSl_L_T1_C']); $Rich_Web_CircleSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_CircleSl_L_T2_C']); $Rich_Web_CircleSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_CircleSl_L_T3_C']); $Rich_Web_CircleSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_T2_BC']); $Rich_Web_CircleSl_L_C=sanitize_text_field($_POST['Rich_Web_CircleSl_L_C']); $Rich_Web_CircleSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_T2_AnC']); $Rich_Web_CircleSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_CircleSl_LT_T3_BgC']); $Rich_Web_CircleSl_L_S=sanitize_text_field($_POST['Rich_Web_CircleSl_L_S']); $Rich_Web_CircleSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_CircleSl_Loading_Show']); 

			//Carousel Slider Loading

			$Rich_Web_CarSl_L_Show=sanitize_text_field($_POST['Rich_Web_CarSl_L_Show']); $Rich_Web_CarSl_LT_Show=sanitize_text_field($_POST['Rich_Web_CarSl_LT_Show']); $Rich_Web_CarSl_LT=sanitize_text_field($_POST['Rich_Web_CarSl_LT']); $Rich_Web_CarSl_L_BgC=sanitize_text_field($_POST['Rich_Web_CarSl_L_BgC']); $Rich_Web_CarSl_L_T=sanitize_text_field($_POST['Rich_Web_CarSl_L_T']); $Rich_Web_CarSl_LT_T=sanitize_text_field($_POST['Rich_Web_CarSl_LT_T']); $Rich_Web_CarSl_LT_FS=sanitize_text_field($_POST['Rich_Web_CarSl_LT_FS']); $Rich_Web_CarSl_LT_FF=sanitize_text_field($_POST['Rich_Web_CarSl_LT_FF']); $Rich_Web_CarSl_LT_C=sanitize_text_field($_POST['Rich_Web_CarSl_LT_C']); $Rich_Web_CarSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_CarSl_L_T1_C']); $Rich_Web_CarSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_CarSl_L_T2_C']); $Rich_Web_CarSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_CarSl_L_T3_C']); $Rich_Web_CarSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_CarSl_LT_T2_BC']); $Rich_Web_CarSl_L_C=sanitize_text_field($_POST['Rich_Web_CarSl_L_C']); $Rich_Web_CarSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_CarSl_LT_T2_AnC']); $Rich_Web_CarSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_CarSl_LT_T3_BgC']); $Rich_Web_CarSl_HT=sanitize_text_field($_POST['Rich_Web_CarSl_HT']); $Rich_Web_CarSl_H_OvC=sanitize_text_field($_POST['Rich_Web_CarSl_H_OvC']); $Rich_Web_CarSl_L_S=sanitize_text_field($_POST['Rich_Web_CarSl_L_S']); $Rich_Web_CarSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_CarSl_Loading_Show']); 

			//Flexible Slider Loading

			$Rich_Web_FlexibleSl_L_Show=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_Show']); $Rich_Web_FlexibleSl_LT_Show=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_Show']); $Rich_Web_FlexibleSl_LT=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT']); $Rich_Web_FlexibleSl_L_BgC=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_BgC']); $Rich_Web_FlexibleSl_L_T=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_T']); $Rich_Web_FlexibleSl_LT_T=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_T']); $Rich_Web_FlexibleSl_LT_FS=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_FS']); $Rich_Web_FlexibleSl_LT_FF=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_FF']); $Rich_Web_FlexibleSl_LT_C=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_C']); $Rich_Web_FlexibleSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_T1_C']); $Rich_Web_FlexibleSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_T2_C']); $Rich_Web_FlexibleSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_T3_C']); $Rich_Web_FlexibleSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_T2_BC']); $Rich_Web_FlexibleSl_L_C=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_C']); $Rich_Web_FlexibleSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_T2_AnC']); $Rich_Web_FlexibleSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_FlexibleSl_LT_T3_BgC']); $Rich_Web_FlexibleSl_L_S=sanitize_text_field($_POST['Rich_Web_FlexibleSl_L_S']); $Rich_Web_FlexibleSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_FlexibleSl_Loading_Show']); 

			//Dynamic Slider Loading

			$Rich_Web_DynamicSl_L_Show=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_Show']); $Rich_Web_DynamicSl_LT_Show=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_Show']); $Rich_Web_DynamicSl_LT=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT']); $Rich_Web_DynamicSl_L_BgC=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_BgC']); $Rich_Web_DynamicSl_L_T=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_T']); $Rich_Web_DynamicSl_LT_T=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_T']); $Rich_Web_DynamicSl_LT_FS=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_FS']); $Rich_Web_DynamicSl_LT_FF=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_FF']); $Rich_Web_DynamicSl_LT_C=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_C']); $Rich_Web_DynamicSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_T1_C']); $Rich_Web_DynamicSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_T2_C']); $Rich_Web_DynamicSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_T3_C']); $Rich_Web_DynamicSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_T2_BC']); $Rich_Web_DynamicSl_L_C=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_C']); $Rich_Web_DynamicSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_T2_AnC']); $Rich_Web_DynamicSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_DynamicSl_LT_T3_BgC']);$Rich_Web_DynamicSl_ImgT=sanitize_text_field($_POST['Rich_Web_DynamicSl_ImgT']); $Rich_Web_DynamicSl_L_S=sanitize_text_field($_POST['Rich_Web_DynamicSl_L_S']); $Rich_Web_DynamicSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_DynamicSl_Loading_Show']); 

			//Thumbnails Slider Loading

			$Rich_Web_ThSl_L_Show=sanitize_text_field($_POST['Rich_Web_ThSl_L_Show']); $Rich_Web_ThSl_LT_Show=sanitize_text_field($_POST['Rich_Web_ThSl_LT_Show']); $Rich_Web_ThSl_LT=sanitize_text_field($_POST['Rich_Web_ThSl_LT']); $Rich_Web_ThSl_L_BgC=sanitize_text_field($_POST['Rich_Web_ThSl_L_BgC']); $Rich_Web_ThSl_L_T=sanitize_text_field($_POST['Rich_Web_ThSl_L_T']); $Rich_Web_ThSl_LT_T=sanitize_text_field($_POST['Rich_Web_ThSl_LT_T']); $Rich_Web_ThSl_LT_FS=sanitize_text_field($_POST['Rich_Web_ThSl_LT_FS']); $Rich_Web_ThSl_LT_FF=sanitize_text_field($_POST['Rich_Web_ThSl_LT_FF']); $Rich_Web_ThSl_LT_C=sanitize_text_field($_POST['Rich_Web_ThSl_LT_C']); $Rich_Web_ThSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_ThSl_L_T1_C']); $Rich_Web_ThSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_ThSl_L_T2_C']); $Rich_Web_ThSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_ThSl_L_T3_C']); $Rich_Web_ThSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_ThSl_LT_T2_BC']); $Rich_Web_ThSl_L_C=sanitize_text_field($_POST['Rich_Web_ThSl_L_C']); $Rich_Web_ThSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_ThSl_LT_T2_AnC']); $Rich_Web_ThSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_ThSl_LT_T3_BgC']); $Rich_Web_ThSl_L_S=sanitize_text_field($_POST['Rich_Web_ThSl_L_S']); $Rich_Web_ThSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_ThSl_Loading_Show']); 

			//Accordion Slider Loading

			$Rich_Web_AccSl_L_Show=sanitize_text_field($_POST['Rich_Web_AccSl_L_Show']); $Rich_Web_AccSl_LT_Show=sanitize_text_field($_POST['Rich_Web_AccSl_LT_Show']); $Rich_Web_AccSl_LT=sanitize_text_field($_POST['Rich_Web_AccSl_LT']); $Rich_Web_AccSl_L_BgC=sanitize_text_field($_POST['Rich_Web_AccSl_L_BgC']); $Rich_Web_AccSl_L_T=sanitize_text_field($_POST['Rich_Web_AccSl_L_T']); $Rich_Web_AccSl_LT_T=sanitize_text_field($_POST['Rich_Web_AccSl_LT_T']); $Rich_Web_AccSl_LT_FS=sanitize_text_field($_POST['Rich_Web_AccSl_LT_FS']); $Rich_Web_AccSl_LT_FF=sanitize_text_field($_POST['Rich_Web_AccSl_LT_FF']); $Rich_Web_AccSl_LT_C=sanitize_text_field($_POST['Rich_Web_AccSl_LT_C']); $Rich_Web_AccSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_AccSl_L_T1_C']); $Rich_Web_AccSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_AccSl_L_T2_C']); $Rich_Web_AccSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_AccSl_L_T3_C']); $Rich_Web_AccSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_AccSl_LT_T2_BC']); $Rich_Web_AccSl_L_C=sanitize_text_field($_POST['Rich_Web_AccSl_L_C']); $Rich_Web_AccSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_AccSl_LT_T2_AnC']); $Rich_Web_AccSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_AccSl_LT_T3_BgC']); $Rich_Web_AccSl_L_S=sanitize_text_field($_POST['Rich_Web_AccSl_L_S']); $Rich_Web_AccSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_AccSl_Loading_Show']); 

			//Animation Slider Loading

			$Rich_Web_AnimSl_L_Show=sanitize_text_field($_POST['Rich_Web_AnimSl_L_Show']); $Rich_Web_AnimSl_LT_Show=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_Show']); $Rich_Web_AnimSl_LT=sanitize_text_field($_POST['Rich_Web_AnimSl_LT']); $Rich_Web_AnimSl_L_BgC=sanitize_text_field($_POST['Rich_Web_AnimSl_L_BgC']); $Rich_Web_AnimSl_L_T=sanitize_text_field($_POST['Rich_Web_AnimSl_L_T']); $Rich_Web_AnimSl_LT_T=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_T']); $Rich_Web_AnimSl_LT_FS=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_FS']); $Rich_Web_AnimSl_LT_FF=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_FF']); $Rich_Web_AnimSl_LT_C=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_C']); $Rich_Web_AnimSl_L_T1_C=sanitize_text_field($_POST['Rich_Web_AnimSl_L_T1_C']); $Rich_Web_AnimSl_L_T2_C=sanitize_text_field($_POST['Rich_Web_AnimSl_L_T2_C']); $Rich_Web_AnimSl_L_T3_C=sanitize_text_field($_POST['Rich_Web_AnimSl_L_T3_C']); $Rich_Web_AnimSl_LT_T2_BC=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_T2_BC']); $Rich_Web_AnimSl_L_C=sanitize_text_field($_POST['Rich_Web_AnimSl_L_C']); $Rich_Web_AnimSl_LT_T2_AnC=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_T2_AnC']); $Rich_Web_AnimSl_LT_T3_BgC=sanitize_text_field($_POST['Rich_Web_AnimSl_LT_T3_BgC']); $Rich_Web_AnimSl_L_S=sanitize_text_field($_POST['Rich_Web_AnimSl_L_S']); $Rich_Web_AnimSl_Loading_Show=sanitize_text_field($_POST['Rich_Web_AnimSl_Loading_Show']); 

			if($rich_fsl_PPL_Show == 'on'){ $rich_fsl_PPL_Show = 'true'; }else{ $rich_fsl_PPL_Show = 'false'; }
			if($rich_fsl_Loop == 'on'){ $rich_fsl_Loop = 'true'; }else{ $rich_fsl_Loop = 'false'; }
			if($Rich_Web_Sl1_SlS=='on'){ $Rich_Web_Sl1_SlS='true'; }else{ $Rich_Web_Sl1_SlS='false'; }
			if($Rich_Web_Sl1_PoH=='on'){ $Rich_Web_Sl1_PoH='true'; }else{ $Rich_Web_Sl1_PoH='false'; }
			if($rich_CS_BIB=='on'){ $rich_CS_BIB='true'; }else{ $rich_CS_BIB='none'; }
			if($rich_CS_Loop=='on'){ $rich_CS_Loop='true'; }else{ $rich_CS_Loop='none'; }
			if($Rich_Web_NSL_L_Show == 'on'){ $Rich_Web_NSL_L_Show = 'true'; }else{ $Rich_Web_NSL_L_Show = 'false'; }
			if($Rich_Web_NSL_LT_Show == 'on'){ $Rich_Web_NSL_LT_Show = 'true'; }else{ $Rich_Web_NSL_LT_Show = 'false'; }
			if($Rich_Web_NSL_Loading_Show == 'on'){ $Rich_Web_NSL_Loading_Show = 'true'; }else{ $Rich_Web_NSL_Loading_Show = 'false'; }
			if($Rich_Web_ContSl_L_Show == 'on'){ $Rich_Web_ContSl_L_Show = 'true'; }else{ $Rich_Web_ContSl_L_Show = 'false'; }
			if($Rich_Web_ContSl_LT_Show == 'on'){ $Rich_Web_ContSl_LT_Show = 'true'; }else{ $Rich_Web_ContSl_LT_Show = 'false'; }
			if($Rich_Web_ContSl_Loading_Show == 'on'){ $Rich_Web_ContSl_Loading_Show = 'true'; }else{ $Rich_Web_ContSl_Loading_Show = 'false'; }
			if($Rich_Web_FSl_L_Show == 'on'){ $Rich_Web_FSl_L_Show = 'true'; }else{ $Rich_Web_FSl_L_Show = 'false'; }
			if($Rich_Web_FSl_LT_Show == 'on'){ $Rich_Web_FSl_LT_Show = 'true'; }else{ $Rich_Web_FSl_LT_Show = 'false'; }
			if($Rich_Web_FSl_Loading_Show == 'on'){ $Rich_Web_FSl_Loading_Show = 'true'; }else{ $Rich_Web_FSl_Loading_Show = 'false'; }
			if($Rich_Web_CircleSl_L_Show == 'on'){ $Rich_Web_CircleSl_L_Show = 'true'; }else{ $Rich_Web_CircleSl_L_Show = 'false'; }
			if($Rich_Web_CircleSl_LT_Show == 'on'){ $Rich_Web_CircleSl_LT_Show = 'true'; }else{ $Rich_Web_CircleSl_LT_Show = 'false'; }
			if($Rich_Web_CircleSl_Loading_Show == 'on'){ $Rich_Web_CircleSl_Loading_Show = 'true'; }else{ $Rich_Web_CircleSl_Loading_Show = 'false'; }
			if($Rich_Web_CarSl_L_Show == 'on'){ $Rich_Web_CarSl_L_Show = 'true'; }else{ $Rich_Web_CarSl_L_Show = 'false'; }
			if($Rich_Web_CarSl_LT_Show == 'on'){ $Rich_Web_CarSl_LT_Show = 'true'; }else{ $Rich_Web_CarSl_LT_Show = 'false'; }
			if($Rich_Web_CarSl_Loading_Show == 'on'){ $Rich_Web_CarSl_Loading_Show = 'true'; }else{ $Rich_Web_CarSl_Loading_Show = 'false'; }
			if($Rich_Web_FlexibleSl_L_Show == 'on'){ $Rich_Web_FlexibleSl_L_Show = 'true'; }else{ $Rich_Web_FlexibleSl_L_Show = 'false'; }
			if($Rich_Web_FlexibleSl_LT_Show == 'on'){ $Rich_Web_FlexibleSl_LT_Show = 'true'; }else{ $Rich_Web_FlexibleSl_LT_Show = 'false'; }
			if($Rich_Web_FlexibleSl_Loading_Show == 'on'){ $Rich_Web_FlexibleSl_Loading_Show = 'true'; }else{ $Rich_Web_FlexibleSl_Loading_Show = 'false'; }
			if($Rich_Web_DynamicSl_L_Show == 'on'){ $Rich_Web_DynamicSl_L_Show = 'true'; }else{ $Rich_Web_DynamicSl_L_Show = 'false'; }
			if($Rich_Web_DynamicSl_LT_Show == 'on'){ $Rich_Web_DynamicSl_LT_Show = 'true'; }else{ $Rich_Web_DynamicSl_LT_Show = 'false'; }
			if($Rich_Web_DynamicSl_Loading_Show == 'on'){ $Rich_Web_DynamicSl_Loading_Show = 'true'; }else{ $Rich_Web_DynamicSl_Loading_Show = 'false'; }
			if($Rich_Web_ThSl_L_Show == 'on'){ $Rich_Web_ThSl_L_Show = 'true'; }else{ $Rich_Web_ThSl_L_Show = 'false'; }
			if($Rich_Web_ThSl_LT_Show == 'on'){ $Rich_Web_ThSl_LT_Show = 'true'; }else{ $Rich_Web_ThSl_LT_Show = 'false'; }
			if($Rich_Web_ThSl_Loading_Show == 'on'){ $Rich_Web_ThSl_Loading_Show = 'true'; }else{ $Rich_Web_ThSl_Loading_Show = 'false'; }
			if($Rich_Web_AccSl_L_Show == 'on'){ $Rich_Web_AccSl_L_Show = 'true'; }else{ $Rich_Web_AccSl_L_Show = 'false'; }
			if($Rich_Web_AccSl_LT_Show == 'on'){ $Rich_Web_AccSl_LT_Show = 'true'; }else{ $Rich_Web_AccSl_LT_Show = 'false'; }
			if($Rich_Web_AccSl_Loading_Show == 'on'){ $Rich_Web_AccSl_Loading_Show = 'true'; }else{ $Rich_Web_AccSl_Loading_Show = 'false'; }
			if($Rich_Web_AnimSl_L_Show == 'on'){ $Rich_Web_AnimSl_L_Show = 'true'; }else{ $Rich_Web_AnimSl_L_Show = 'false'; }
			if($Rich_Web_AnimSl_LT_Show == 'on'){ $Rich_Web_AnimSl_LT_Show = 'true'; }else{ $Rich_Web_AnimSl_LT_Show = 'false'; }
			if($Rich_Web_AnimSl_Loading_Show == 'on'){ $Rich_Web_AnimSl_Loading_Show = 'true'; }else{ $Rich_Web_AnimSl_Loading_Show = 'false'; }

			if(isset($_POST['rich_webSlUpdate']))
			{
				$Rich_Web_Slider_UP_ID=sanitize_text_field($_POST['rich_web_Slider_UP_ID']);

				$wpdb->query($wpdb->prepare("UPDATE $table_name2 set slider_name = %s, slider_type = %s WHERE id = %d", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Slider_UP_ID));

				if($Rich_Web_slider_type=='Slider Navigation')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name5 set rich_web_slider_name = %s, rich_web_slider_type = %s, rich_web_Sl1_SlS = %s, rich_web_Sl1_PoH = %s, rich_web_Sl1_W = %s, rich_web_Sl1_H = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl1_SlS, $Rich_Web_Sl1_PoH, $Rich_Web_Sl1_W, $Rich_Web_Sl1_H, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name5_Loader set Rich_Web_NSL_L_Show = %s, Rich_Web_NSL_LT_Show = %s, Rich_Web_NSL_LT = %s, Rich_Web_NSL_L_BgC = %s, Rich_Web_NSL_L_T = %s, Rich_Web_NSL_LT_T = %s, Rich_Web_NSL_LT_FS = %s, Rich_Web_NSL_LT_FF = %s, Rich_Web_NSL_LT_C = %s, Rich_Web_NSL_L_T1_C = %s, Rich_Web_NSL_L_T2_C = %s, Rich_Web_NSL_L_T3_C = %s, Rich_Web_NSL_LT_T2_BC = %s, Rich_Web_NSL_L_C = %s, Rich_Web_NSL_LT_T2_AnC = %s, Rich_Web_NSL_LT_T3_BgC = %s, Rich_Web_NSL_L_S=%s, Rich_Web_NSL_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_NSL_L_Show, $Rich_Web_NSL_LT_Show, $Rich_Web_NSL_LT, $Rich_Web_NSL_L_BgC, $Rich_Web_NSL_L_T, $Rich_Web_NSL_LT_T, $Rich_Web_NSL_LT_FS, $Rich_Web_NSL_LT_FF, $Rich_Web_NSL_LT_C, $Rich_Web_NSL_L_T1_C, $Rich_Web_NSL_L_T2_C, $Rich_Web_NSL_L_T3_C, $Rich_Web_NSL_LT_T2_BC, $Rich_Web_NSL_L_C, $Rich_Web_NSL_LT_T2_AnC, $Rich_Web_NSL_LT_T3_BgC, $Rich_Web_NSL_L_S, $Rich_Web_NSL_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Content Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name6 set rich_web_slider_name = %s, rich_web_slider_type = %s, rich_CS_BIB = %s, rich_CS_Loop = %s, rich_CS_Cont_W = %s, rich_CS_Cont_H = %s, rich_CS_Cont_BW = %s, rich_CS_Cont_BS = %s, rich_CS_Cont_BC = %s, rich_CS_Cont_BR = %s WHERE richideo_EN_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $rich_CS_BIB, $rich_CS_Loop, $rich_CS_Cont_W, $rich_CS_Cont_H, $rich_CS_Cont_BW, $rich_CS_Cont_BS, $rich_CS_Cont_BC, $rich_CS_Cont_BR, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name6_Loader set Rich_Web_ContSl_L_Show = %s, Rich_Web_ContSl_LT_Show = %s, Rich_Web_ContSl_LT = %s, Rich_Web_ContSl_L_BgC = %s, Rich_Web_ContSl_L_T = %s, Rich_Web_ContSl_LT_T = %s, Rich_Web_ContSl_LT_FS = %s, Rich_Web_ContSl_LT_FF = %s, Rich_Web_ContSl_LT_C = %s, Rich_Web_ContSl_L_T1_C = %s, Rich_Web_ContSl_L_T2_C = %s, Rich_Web_ContSl_L_T3_C = %s, Rich_Web_ContSl_LT_T2_BC = %s, Rich_Web_ContSl_L_C = %s, Rich_Web_ContSl_LT_T2_AnC = %s, Rich_Web_ContSl_LT_T3_BgC = %s, Rich_Web_ContSl_L_S=%s, Rich_Web_ContSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_ContSl_L_Show, $Rich_Web_ContSl_LT_Show, $Rich_Web_ContSl_LT, $Rich_Web_ContSl_L_BgC, $Rich_Web_ContSl_L_T, $Rich_Web_ContSl_LT_T, $Rich_Web_ContSl_LT_FS, $Rich_Web_ContSl_LT_FF, $Rich_Web_ContSl_LT_C, $Rich_Web_ContSl_L_T1_C, $Rich_Web_ContSl_L_T2_C, $Rich_Web_ContSl_L_T3_C, $Rich_Web_ContSl_LT_T2_BC, $Rich_Web_ContSl_L_C, $Rich_Web_ContSl_LT_T2_AnC, $Rich_Web_ContSl_LT_T3_BgC, $Rich_Web_ContSl_L_S, $Rich_Web_ContSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Fashion Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name7 set rich_web_slider_name = %s, rich_web_slider_type = %s, rich_fsl_PPL_Show = %s, rich_fsl_Loop = %s, rich_fsl_Width = %s, rich_fsl_Height = %s, rich_fsl_Border_Width = %s, rich_fsl_Border_Style = %s, rich_fsl_Border_Color = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $rich_fsl_PPL_Show, $rich_fsl_Loop, $rich_fsl_Width, $rich_fsl_Height, $rich_fsl_Border_Width, $rich_fsl_Border_Style, $rich_fsl_Border_Color, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name7_Loader set Rich_Web_FSl_L_Show = %s, Rich_Web_FSl_LT_Show = %s, Rich_Web_FSl_LT = %s, Rich_Web_FSl_L_BgC = %s, Rich_Web_FSl_L_T = %s, Rich_Web_FSl_LT_T = %s, Rich_Web_FSl_LT_FS = %s, Rich_Web_FSl_LT_FF = %s, Rich_Web_FSl_LT_C = %s, Rich_Web_FSl_L_T1_C = %s, Rich_Web_FSl_L_T2_C = %s, Rich_Web_FSl_L_T3_C = %s, Rich_Web_FSl_LT_T2_BC = %s, Rich_Web_FSl_L_C = %s, Rich_Web_FSl_LT_T2_AnC = %s, Rich_Web_FSl_LT_T3_BgC = %s, Rich_Web_FSl_L_S=%s, Rich_Web_FSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_FSl_L_Show, $Rich_Web_FSl_LT_Show, $Rich_Web_FSl_LT, $Rich_Web_FSl_L_BgC, $Rich_Web_FSl_L_T, $Rich_Web_FSl_LT_T, $Rich_Web_FSl_LT_FS, $Rich_Web_FSl_LT_FF, $Rich_Web_FSl_LT_C, $Rich_Web_FSl_L_T1_C, $Rich_Web_FSl_L_T2_C, $Rich_Web_FSl_L_T3_C, $Rich_Web_FSl_LT_T2_BC, $Rich_Web_FSl_L_C, $Rich_Web_FSl_LT_T2_AnC, $Rich_Web_FSl_LT_T3_BgC, $Rich_Web_FSl_L_S, $Rich_Web_FSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Circle Thumbnails')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name8 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_Sl_CT_W = %s, Rich_Web_Sl_CT_H = %s, Rich_Web_Sl_CT_BW = %s, Rich_Web_Sl_CT_BS = %s, Rich_Web_Sl_CT_BC = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl_CT_W, $Rich_Web_Sl_CT_H, $Rich_Web_Sl_CT_BW, $Rich_Web_Sl_CT_BS, $Rich_Web_Sl_CT_BC, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name8_Loader set Rich_Web_CircleSl_L_Show = %s, Rich_Web_CircleSl_LT_Show = %s, Rich_Web_CircleSl_LT = %s, Rich_Web_CircleSl_L_BgC = %s, Rich_Web_CircleSl_L_T = %s, Rich_Web_CircleSl_LT_T = %s, Rich_Web_CircleSl_LT_FS = %s, Rich_Web_CircleSl_LT_FF = %s, Rich_Web_CircleSl_LT_C = %s, Rich_Web_CircleSl_L_T1_C = %s, Rich_Web_CircleSl_L_T2_C = %s, Rich_Web_CircleSl_L_T3_C = %s, Rich_Web_CircleSl_LT_T2_BC = %s, Rich_Web_CircleSl_L_C = %s, Rich_Web_CircleSl_LT_T2_AnC = %s, Rich_Web_CircleSl_LT_T3_BgC = %s, Rich_Web_CircleSl_L_S=%s, Rich_Web_CircleSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_CircleSl_L_Show, $Rich_Web_CircleSl_LT_Show, $Rich_Web_CircleSl_LT, $Rich_Web_CircleSl_L_BgC, $Rich_Web_CircleSl_L_T, $Rich_Web_CircleSl_LT_T, $Rich_Web_CircleSl_LT_FS, $Rich_Web_CircleSl_LT_FF, $Rich_Web_CircleSl_LT_C, $Rich_Web_CircleSl_L_T1_C, $Rich_Web_CircleSl_L_T2_C, $Rich_Web_CircleSl_L_T3_C, $Rich_Web_CircleSl_LT_T2_BC, $Rich_Web_CircleSl_L_C, $Rich_Web_CircleSl_LT_T2_AnC, $Rich_Web_CircleSl_LT_T3_BgC, $Rich_Web_CircleSl_L_S, $Rich_Web_CircleSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Slider Carousel')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name9 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_Sl_SC_BW = %s, Rich_Web_Sl_SC_BS = %s, Rich_Web_Sl_SC_BC = %s, Rich_Web_Sl_SC_IW = %s, Rich_Web_Sl_SC_IH = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl_SC_BW, $Rich_Web_Sl_SC_BS, $Rich_Web_Sl_SC_BC, $Rich_Web_Sl_SC_IW, $Rich_Web_Sl_SC_IH, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name9_Loader set Rich_Web_CarSl_L_Show = %s, Rich_Web_CarSl_LT_Show = %s, Rich_Web_CarSl_LT = %s, Rich_Web_CarSl_L_BgC = %s, Rich_Web_CarSl_L_T = %s, Rich_Web_CarSl_LT_T = %s, Rich_Web_CarSl_LT_FS = %s, Rich_Web_CarSl_LT_FF = %s, Rich_Web_CarSl_LT_C = %s, Rich_Web_CarSl_L_T1_C = %s, Rich_Web_CarSl_L_T2_C = %s, Rich_Web_CarSl_L_T3_C = %s, Rich_Web_CarSl_LT_T2_BC = %s, Rich_Web_CarSl_L_C = %s, Rich_Web_CarSl_LT_T2_AnC = %s, Rich_Web_CarSl_LT_T3_BgC = %s, Rich_Web_CarSl_HT = %s, Rich_Web_CarSl_H_OvC = %s, Rich_Web_CarSl_L_S=%s, Rich_Web_CarSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_CarSl_L_Show, $Rich_Web_CarSl_LT_Show, $Rich_Web_CarSl_LT, $Rich_Web_CarSl_L_BgC, $Rich_Web_CarSl_L_T, $Rich_Web_CarSl_LT_T, $Rich_Web_CarSl_LT_FS, $Rich_Web_CarSl_LT_FF, $Rich_Web_CarSl_LT_C, $Rich_Web_CarSl_L_T1_C, $Rich_Web_CarSl_L_T2_C, $Rich_Web_CarSl_L_T3_C, $Rich_Web_CarSl_LT_T2_BC, $Rich_Web_CarSl_L_C, $Rich_Web_CarSl_LT_T2_AnC, $Rich_Web_CarSl_LT_T3_BgC, $Rich_Web_CarSl_HT, $Rich_Web_CarSl_H_OvC, $Rich_Web_CarSl_L_S, $Rich_Web_CarSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Flexible Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name10 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_Sl_FS_I_W = %s, Rich_Web_Sl_FS_I_H = %s, Rich_Web_Sl_FS_I_BW = %s, Rich_Web_Sl_FS_I_BS = %s, Rich_Web_Sl_FS_I_BC = %s, Rich_Web_Sl_FS_I_BR = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl_FS_I_W, $Rich_Web_Sl_FS_I_H, $Rich_Web_Sl_FS_I_BW, $Rich_Web_Sl_FS_I_BS, $Rich_Web_Sl_FS_I_BC, $Rich_Web_Sl_FS_I_BR, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name10_Loader set Rich_Web_FlexibleSl_L_Show = %s, Rich_Web_FlexibleSl_LT_Show = %s, Rich_Web_FlexibleSl_LT = %s, Rich_Web_FlexibleSl_L_BgC = %s, Rich_Web_FlexibleSl_L_T = %s, Rich_Web_FlexibleSl_LT_T = %s, Rich_Web_FlexibleSl_LT_FS = %s, Rich_Web_FlexibleSl_LT_FF = %s, Rich_Web_FlexibleSl_LT_C = %s, Rich_Web_FlexibleSl_L_T1_C = %s, Rich_Web_FlexibleSl_L_T2_C = %s, Rich_Web_FlexibleSl_L_T3_C = %s, Rich_Web_FlexibleSl_LT_T2_BC = %s, Rich_Web_FlexibleSl_L_C = %s, Rich_Web_FlexibleSl_LT_T2_AnC = %s, Rich_Web_FlexibleSl_LT_T3_BgC = %s, Rich_Web_FlexibleSl_L_S=%s, Rich_Web_FlexibleSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_FlexibleSl_L_Show, $Rich_Web_FlexibleSl_LT_Show, $Rich_Web_FlexibleSl_LT, $Rich_Web_FlexibleSl_L_BgC, $Rich_Web_FlexibleSl_L_T, $Rich_Web_FlexibleSl_LT_T, $Rich_Web_FlexibleSl_LT_FS, $Rich_Web_FlexibleSl_LT_FF, $Rich_Web_FlexibleSl_LT_C, $Rich_Web_FlexibleSl_L_T1_C, $Rich_Web_FlexibleSl_L_T2_C, $Rich_Web_FlexibleSl_L_T3_C, $Rich_Web_FlexibleSl_LT_T2_BC, $Rich_Web_FlexibleSl_L_C, $Rich_Web_FlexibleSl_LT_T2_AnC, $Rich_Web_FlexibleSl_LT_T3_BgC, $Rich_Web_FlexibleSl_L_S, $Rich_Web_FlexibleSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Dynamic Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name11 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_Sl_DS_H = %s, Rich_Web_Sl_DS_BW = %s, Rich_Web_Sl_DS_BS = %s, Rich_Web_Sl_DS_BC = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl_DS_H, $Rich_Web_Sl_DS_BW, $Rich_Web_Sl_DS_BS, $Rich_Web_Sl_DS_BC, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name11_Loader set Rich_Web_DynamicSl_L_Show = %s, Rich_Web_DynamicSl_LT_Show = %s, Rich_Web_DynamicSl_LT = %s, Rich_Web_DynamicSl_L_BgC = %s, Rich_Web_DynamicSl_L_T = %s, Rich_Web_DynamicSl_LT_T = %s, Rich_Web_DynamicSl_LT_FS = %s, Rich_Web_DynamicSl_LT_FF = %s, Rich_Web_DynamicSl_LT_C = %s, Rich_Web_DynamicSl_L_T1_C = %s, Rich_Web_DynamicSl_L_T2_C = %s, Rich_Web_DynamicSl_L_T3_C = %s, Rich_Web_DynamicSl_LT_T2_BC = %s, Rich_Web_DynamicSl_L_C = %s, Rich_Web_DynamicSl_LT_T2_AnC = %s, Rich_Web_DynamicSl_LT_T3_BgC = %s, Rich_Web_DynamicSl_ImgT = %s, Rich_Web_DynamicSl_L_S=%s, Rich_Web_DynamicSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_DynamicSl_L_Show, $Rich_Web_DynamicSl_LT_Show, $Rich_Web_DynamicSl_LT, $Rich_Web_DynamicSl_L_BgC, $Rich_Web_DynamicSl_L_T, $Rich_Web_DynamicSl_LT_T, $Rich_Web_DynamicSl_LT_FS, $Rich_Web_DynamicSl_LT_FF, $Rich_Web_DynamicSl_LT_C, $Rich_Web_DynamicSl_L_T1_C, $Rich_Web_DynamicSl_L_T2_C, $Rich_Web_DynamicSl_L_T3_C, $Rich_Web_DynamicSl_LT_T2_BC, $Rich_Web_DynamicSl_L_C, $Rich_Web_DynamicSl_LT_T2_AnC, $Rich_Web_DynamicSl_LT_T3_BgC, $Rich_Web_DynamicSl_ImgT, $Rich_Web_DynamicSl_L_S, $Rich_Web_DynamicSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Thumbnails Slider & Lightbox')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name12 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_Sl_TSL_W = %s, Rich_Web_Sl_TSL_H = %s, Rich_Web_Sl_TSL_BW = %s, Rich_Web_Sl_TSL_BS = %s, Rich_Web_Sl_TSL_BC = %s, Rich_Web_Sl_TSL_BR = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_Sl_TSL_W, $Rich_Web_Sl_TSL_H, $Rich_Web_Sl_TSL_BW, $Rich_Web_Sl_TSL_BS, $Rich_Web_Sl_TSL_BC, $Rich_Web_Sl_TSL_BR, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name12_Loader set Rich_Web_ThSl_L_Show = %s, Rich_Web_ThSl_LT_Show = %s, Rich_Web_ThSl_LT = %s, Rich_Web_ThSl_L_BgC = %s, Rich_Web_ThSl_L_T = %s, Rich_Web_ThSl_LT_T = %s, Rich_Web_ThSl_LT_FS = %s, Rich_Web_ThSl_LT_FF = %s, Rich_Web_ThSl_LT_C = %s, Rich_Web_ThSl_L_T1_C = %s, Rich_Web_ThSl_L_T2_C = %s, Rich_Web_ThSl_L_T3_C = %s, Rich_Web_ThSl_LT_T2_BC = %s, Rich_Web_ThSl_L_C = %s, Rich_Web_ThSl_LT_T2_AnC = %s, Rich_Web_ThSl_LT_T3_BgC = %s, Rich_Web_ThSl_L_S=%s, Rich_Web_ThSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_ThSl_L_Show, $Rich_Web_ThSl_LT_Show, $Rich_Web_ThSl_LT, $Rich_Web_ThSl_L_BgC, $Rich_Web_ThSl_L_T, $Rich_Web_ThSl_LT_T, $Rich_Web_ThSl_LT_FS, $Rich_Web_ThSl_LT_FF, $Rich_Web_ThSl_LT_C, $Rich_Web_ThSl_L_T1_C, $Rich_Web_ThSl_L_T2_C, $Rich_Web_ThSl_L_T3_C, $Rich_Web_ThSl_LT_T2_BC, $Rich_Web_ThSl_L_C, $Rich_Web_ThSl_LT_T2_AnC, $Rich_Web_ThSl_LT_T3_BgC, $Rich_Web_ThSl_L_S, $Rich_Web_ThSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Accordion Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name13_Loader set Rich_Web_AccSl_L_Show = %s, Rich_Web_AccSl_LT_Show = %s, Rich_Web_AccSl_LT = %s, Rich_Web_AccSl_L_BgC = %s, Rich_Web_AccSl_L_T = %s, Rich_Web_AccSl_LT_T = %s, Rich_Web_AccSl_LT_FS = %s, Rich_Web_AccSl_LT_FF = %s, Rich_Web_AccSl_LT_C = %s, Rich_Web_AccSl_L_T1_C = %s, Rich_Web_AccSl_L_T2_C = %s, Rich_Web_AccSl_L_T3_C = %s, Rich_Web_AccSl_LT_T2_BC = %s, Rich_Web_AccSl_L_C = %s, Rich_Web_AccSl_LT_T2_AnC = %s, Rich_Web_AccSl_LT_T3_BgC = %s, Rich_Web_AccSl_L_S=%s, Rich_Web_AccSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_AccSl_L_Show, $Rich_Web_AccSl_LT_Show, $Rich_Web_AccSl_LT, $Rich_Web_AccSl_L_BgC, $Rich_Web_AccSl_L_T, $Rich_Web_AccSl_LT_T, $Rich_Web_AccSl_LT_FS, $Rich_Web_AccSl_LT_FF, $Rich_Web_AccSl_LT_C, $Rich_Web_AccSl_L_T1_C, $Rich_Web_AccSl_L_T2_C, $Rich_Web_AccSl_L_T3_C, $Rich_Web_AccSl_LT_T2_BC, $Rich_Web_AccSl_L_C, $Rich_Web_AccSl_LT_T2_AnC, $Rich_Web_AccSl_LT_T3_BgC, $Rich_Web_AccSl_L_S, $Rich_Web_AccSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
				else if($Rich_Web_slider_type=='Animation Slider')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name14 set rich_web_slider_name = %s, rich_web_slider_type = %s, Rich_Web_AnSL_W = %s, Rich_Web_AnSL_H = %s, Rich_Web_AnSL_BW = %s, Rich_Web_AnSL_BS = %s, Rich_Web_AnSL_BC = %s, Rich_Web_AnSL_BR = %s WHERE rich_web_slider_ID = %s", $Rich_Web_slider_name, $Rich_Web_slider_type, $Rich_Web_AnSL_W, $Rich_Web_AnSL_H, $Rich_Web_AnSL_BW, $Rich_Web_AnSL_BS, $Rich_Web_AnSL_BC, $Rich_Web_AnSL_BR, $Rich_Web_Slider_UP_ID));

					$wpdb->query($wpdb->prepare("UPDATE $table_name14_Loader set Rich_Web_AnimSl_L_Show = %s, Rich_Web_AnimSl_LT_Show = %s, Rich_Web_AnimSl_LT = %s, Rich_Web_AnimSl_L_BgC = %s, Rich_Web_AnimSl_L_T = %s, Rich_Web_AnimSl_LT_T = %s, Rich_Web_AnimSl_LT_FS = %s, Rich_Web_AnimSl_LT_FF = %s, Rich_Web_AnimSl_LT_C = %s, Rich_Web_AnimSl_L_T1_C = %s, Rich_Web_AnimSl_L_T2_C = %s, Rich_Web_AnimSl_L_T3_C = %s, Rich_Web_AnimSl_LT_T2_BC = %s, Rich_Web_AnimSl_L_C = %s, Rich_Web_AnimSl_LT_T2_AnC = %s, Rich_Web_AnimSl_LT_T3_BgC = %s, Rich_Web_AnimSl_L_S=%s, Rich_Web_AnimSl_Loading_Show=%s WHERE rich_web_slider_ID = %s", $Rich_Web_AnimSl_L_Show, $Rich_Web_AnimSl_LT_Show, $Rich_Web_AnimSl_LT, $Rich_Web_AnimSl_L_BgC, $Rich_Web_AnimSl_L_T, $Rich_Web_AnimSl_LT_T, $Rich_Web_AnimSl_LT_FS, $Rich_Web_AnimSl_LT_FF, $Rich_Web_AnimSl_LT_C, $Rich_Web_AnimSl_L_T1_C, $Rich_Web_AnimSl_L_T2_C, $Rich_Web_AnimSl_L_T3_C, $Rich_Web_AnimSl_LT_T2_BC, $Rich_Web_AnimSl_L_C, $Rich_Web_AnimSl_LT_T2_AnC, $Rich_Web_AnimSl_LT_T3_BgC, $Rich_Web_AnimSl_L_S, $Rich_Web_AnimSl_Loading_Show, $Rich_Web_Slider_UP_ID));
				}
			}
		}
		else
	    {
	        wp_die('Security check fail'); 
	    }	
	}

	$Rich_WebFontCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id>%d",0));
	$Rich_WebSliderCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id>%d",0));

	
?>
<div class="rw_loading_c" style="display: none;">
	<div class="cont_cont">
		<div class="cssload-thecube">
			<div class="cssload-cube cssload-c1"></div>
			<div class="cssload-cube cssload-c2"></div>
			<div class="cssload-cube cssload-c4"></div>
			<div class="cssload-cube cssload-c3"></div>
		</div>
		<div class="RW_Loader_Text_Navigation">
			Please Wait !
		</div>
	</div>
</div>
<form method="POST">
	<?php wp_nonce_field( 'edit-menu_'.$comment_id, 'Rich_Web_PSlider_Nonce' );?>
	<?php require_once( 'Rich-Web-Slider-Header.php' ); ?>
	<div style="position: relative; width: 100%; right: 1%; height: 50px;">
		<input type='button' class='JAddSlider2' value='Add Option (Pro)' onclick='addSliderJ2()' />
		<input type='submit' class='JUpdateSlider2' value='Update' name="rich_webSlUpdate" />
		<input type='button' class='JCanselSlider2' value='Cancel' onclick='canselSliderJ2()' />
		<input type='text' class="richideo_EN_ID" style='display:none' id="rich_web_slider_ID" name='rich_web_Slider_UP_ID'>
	</div>
	<div class="Rich_Web_SliderIm_Fixed_Div"></div>
	<div class="Rich_Web_SliderIm_Absolute_Div">
		<div class="Rich_Web_SliderIm_Relative_Div">
			<p> Are you sure you want to remove ? </p>				 
			<span class="Rich_Web_SliderIm_Relative_No">No</span>
			<span class="Rich_Web_SliderIm_Relative_Yes">Yes</span>
		</div>			
	</div>
	<div class='Table_Data_rich_web_Content_2' >
		<div class='Table_Data_rich_web1_2'>
			<table class='rich_web_Tit_Table_2'>
				<tr class='rich_web_Tit_Table_2_Tr'>
					<td>No</td>
					<td>Option Name</td>
					<td>Slider Type</td>
					<td>Actions</td>
				</tr>
			</table>
			<table class='rich_web_Tit_Table2_2'>
				<?php for($i=0;$i<count($Rich_WebSliderCount);$i++){ ?>
					<tr class='rich_web_Tit_Table2_2_Tr2'>
						<td><?php echo $i+1;?></td>
						<td><?php echo $Rich_WebSliderCount[$i]->slider_name;?></td>
						<td><?php echo $Rich_WebSliderCount[$i]->slider_type;?></td>
						<td onclick="rich_web_Copy_Sl2('<?php echo $Rich_WebSliderCount[$i]->id;?>')"><i class='jIcFileso rich_web rich_web-files-o'></i></td>
						<td onclick="rich_web_Edit_Sl2('<?php echo $Rich_WebSliderCount[$i]->id;?>')"><i class='jIcPencil rich_web rich_web-pencil'></i></td>
						<td onclick="addSliderJ2()"><i class='jIcDel rich_web rich_web-trash'></i></td>
					</tr>
				<?php }?>
			</table>
		</div>
		<div class='Table_Data_rich_web2_2'>
			<table class='rich_web_SaveSl_Table'>
				<tr>
					<td>Slider Name</td>
					<td>Slider Type</td>
				</tr>
				<tr>
					<td><input type="text" class="rich_web_Text_Field" name="rich_web_slider_name" id="rich_web_slider_name" required placeholder="* Required"></td>
					<td class='SlType'>
						<select class="rich_web_Text_Field" id="rich_web_slider_type" name="rich_web_slider_type" onchange="Rich_PS_Buttons_Clicked()">
							<option value="Slider Navigation">            Slider Navigation            </option>
							<option value="Content Slider">               Content Slider               </option>
							<option value="Fashion Slider">               Fashion Slider               </option>
							<option value="Circle Thumbnails">            Circle Thumbnails            </option>
							<option value="Slider Carousel">              Slider Carousel              </option>
							<option value="Flexible Slider">              Flexible Slider              </option>
							<option value="Dynamic Slider">               Dynamic Slider               </option>
							<option value="Thumbnails Slider & Lightbox"> Thumbnails Slider & Lightbox </option>
							<option value="Accordion Slider">             Accordion Slider             </option>
							<option value="Animation Slider">             Animation Slider             </option>
						</select>
					</td>
				</tr>
			</table>
			<table class='rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_1' style="display:none;">
				<tr>
					<td colspan="4">General Options</td>
				</tr>
				<tr>
					<td>Slide Show</td>
					<td>SlideShow Speed (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause on Hover</td>
					<td>Width (px)</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_web_Sl1_SlS" id="rich_web_Sl1_SlS"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_SlSS" min="1" max="5">
							<span class="range-slider__value" id="rich_web_Sl1_SlSS_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_web_Sl1_PoH" id="rich_web_Sl1_PoH"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_W" name="rich_web_Sl1_W" min="100" max="2000">
							<span class="range-slider__value" id="rich_web_Sl1_W_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Height (px)</td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_H" name="rich_web_Sl1_H" min="100" max="2000">
							<span class="range-slider__value" id="rich_web_Sl1_H_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_web_Sl1_BoxS"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" id="rich_web_Sl1_BoxSC" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Image Options</td>					
				</tr>
				<tr>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_IBW" min="0" max="20">
							<span class="range-slider__value" id="rich_web_Sl1_IBW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_IBS">
							<option value="none">   None   </option>
							<option value="solid">  Solid  </option>
							<option value="dashed"> Dashed </option>
							<option value="dotted"> Dotted </option>
						</select>
					</td>
					<td><input type="text" id="rich_web_Sl1_IBC" class="alpha-color-picker" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_IBR" min="0" max="500">
							<span class="range-slider__value" id="rich_web_Sl1_IBR_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="4">Title Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td><input type="text" id="rich_web_Sl1_TBgC" class="alpha-color-picker" value=""></td>
					<td><input type="text" id="rich_web_Sl1_TC" class="alpha-color-picker" value=""></td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_TTA">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_TFS" min="8" max="48">
							<span class="range-slider__value" id="rich_web_Sl1_TFS_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Uppercase <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_web_Sl1_TUp"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">Arrows Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Opacity (%) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Arrow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td><input type="text" id="rich_web_Sl1_ArBgC" class="alpha-color-picker" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_ArOp" min="0" max="100">
							<span class="range-slider__value" id="rich_web_Sl1_ArOp_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_ArType">
							<option value="1">  Type 1  </option>
							<option value="2">  Type 2  </option>
							<option value="3">  Type 3  </option>
							<option value="4">  Type 4  </option>
							<option value="5">  Type 5  </option>
							<option value="6">  Type 6  </option>
							<option value="7">  Type 7  </option>
							<option value="8">  Type 8  </option>
							<option value="9">  Type 9  </option>
							<option value="10"> Type 10 </option>
							<option value="11"> Type 11 </option>
							<option value="12"> Type 12 </option>
							<option value="13"> Type 13 </option>
							<option value="14"> Type 14 </option>
							<option value="15"> Type 15 </option>
							<option value="16"> Type 16 </option>
							<option value="17"> Type 17 </option>
							<option value="18"> Type 18 </option>
							<option value="19"> Type 19 </option>
							<option value="20"> Type 20 </option>
							<option value="21"> Type 21 </option>
							<option value="22"> Type 22 </option>
							<option value="23"> Type 23 </option>
							<option value="24"> Type 24 </option>
							<option value="25"> Type 25 </option>
						</select>
					</td>
					<td><input type="text" id="rich_web_Sl1_ArHBgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Hover Opacity (%) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Effect <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Position From Top (%) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_ArHOp" min="0" max="100">
							<span class="range-slider__value" id="rich_web_Sl1_ArHOp_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_ArHEff">
							<option value="slide out">       Slide Out       </option>
							<option value="flip out">        Flip Out        </option>
							<option value="double flip out"> Double Flip Out </option>
							<option value="both ways">       Both Ways       </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_ArBoxW" min="50" max="150">
							<span class="range-slider__value" id="rich_web_Sl1_ArBoxW_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_ArPFT" min="0" max="100">
							<span class="range-slider__value" id="rich_web_Sl1_ArPFT_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="4">Navigation Options</td>
				</tr>
				<tr>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Place Between (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_NavW" min="0" max="20">
							<span class="range-slider__value" id="rich_web_Sl1_NavW_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_NavH" min="0" max="20">
							<span class="range-slider__value" id="rich_web_Sl1_NavH_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_NavPB" min="0" max="15">
							<span class="range-slider__value" id="rich_web_Sl1_NavPB_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_NavBW" min="1" max="5">
							<span class="range-slider__value" id="rich_web_Sl1_NavBW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Current Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_web_Sl1_NavBS">
							<option value="none">   None   </option>
							<option value="solid">  Solid  </option>
							<option value="dashed"> Dashed </option>
							<option value="dotted"> Dotted </option>
						</select>
					</td>
					<td><input type="text" id="rich_web_Sl1_NavBC" class="alpha-color-picker" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_web_Sl1_NavBR" min="0" max="20">
							<span class="range-slider__value" id="rich_web_Sl1_NavBR_Span">0</span>
						</div>
					</td>
					<td><input type="text" id="rich_web_Sl1_NavCC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Position <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td><input type="text" id="rich_web_Sl1_NavHC" class="alpha-color-picker" value=""></td>
					<td>
						<select id="rich_web_Sl1_NavPos" class="rich_web_Select_Menu">
							<option value="top">    Top    </option>
							<option value="bottom"> Bottom </option>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_NSL_L_Show" name="Rich_Web_NSL_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_NSL_LT_Show" name="Rich_Web_NSL_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_NSL_Loading_Show" name="Rich_Web_NSL_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_NSL_L_BgC" id="Rich_Web_NSL_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_NSL_LT_C" id="Rich_Web_NSL_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_NSL_L_C" id="Rich_Web_NSL_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_NSL_L_S" name="Rich_Web_NSL_L_S" class="rich_web_Select_Menu">
							<option value="small" >    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_NSL_LT" id="Rich_Web_NSL_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_NSL_L_T" name="Rich_Web_NSL_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('NSL')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_NSL_LT_T" name="Rich_Web_NSL_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('NSL')">
							<option value="Type 1">  Type 1  </option>
							<option value="Type 2">  Type 2  </option>
							<option value="Type 3">  Type 3  </option>
							<option value="Type 4">  Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_NSL_LT_FS" name="Rich_Web_NSL_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_NSL_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_NSL_LT_FF" name="Rich_Web_NSL_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_NSL_L_T1_C" id="Rich_Web_NSL_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_NSL_L_T2_C" id="Rich_Web_NSL_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_NSL_L_T3_C" id="Rich_Web_NSL_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_NSL_LT_T2_BC" id="Rich_Web_NSL_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_NSL_LT_T2_AnC" id="Rich_Web_NSL_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_NSL_LT_T3_BgC" id="Rich_Web_NSL_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_2" style='display:none;'>	
				<tr>
					<td colspan="4">General Settings</td>
				</tr>
				<tr>
					<td>Background Image Blur</td>
					<td>Navigation <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loop</td>
					<td>Slide Duration (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>		
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_CS_BIB" id="rich_CS_BIB"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_P"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_CS_Loop" id="rich_CS_Loop"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_SD" min="1" max="20">
							<span class="range-slider__value" id="rich_CS_SD_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Animation Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Show Slideshow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadox Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>	
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_AT" >
							<option value="slide">      Slide       </option>
							<option value="slideUp">    Slide Up    </option>
							<option value="bounce">     Bounce      </option>
							<option value="bounceUp">   Bounce Up   </option>
							<option value="fade">       Fade        </option>							
							<option value="fadeEase">   FadeEase    </option>
							<option value="fadeBounse"> FadeBounse  </option>
							<option value="bounce2">    Bounce 2    </option>
							<option value="bounce3">    Bounce 3    </option>
							<option value="bounceUp2">  Bounce Up 2 </option>
							<option value="bounceUp3">  Bounce Up 3 </option>
						</select>
					</td>					
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_Video_H"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" id="rich_CS_Cont_BgC" class="alpha-color-picker" value=""></td>
					<td><input type='text' id="rich_CS_Cont_BSC" class='alpha-color-picker' value=""></td>
				</tr>		
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Opacity (%) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px)</td>					
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Cont_W" name="rich_CS_Cont_W" min="400" max="1500">
							<span class="range-slider__value" id="rich_CS_Cont_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Cont_H" name="rich_CS_Cont_H" min="400" max="900">
							<span class="range-slider__value" id="rich_CS_Cont_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Cont_Op" min="0" max="100">
							<span class="range-slider__value" id="rich_CS_Cont_Op_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Cont_BW" name="rich_CS_Cont_BW" min="0" max="10">
							<span class="range-slider__value" id="rich_CS_Cont_BW_Span">0</span>
						</div>
					</td>					
				</tr>
				<tr>
					<td>Border Style</td>
					<td>Border Color</td>
					<td>Border Radius (px)</td>
					<td></td>
				</tr>	
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Cont_BS" name="rich_CS_Cont_BS">
							<option value='none'>   None   </option>
				 			<option value='dotted'> Dotted </option>
				 			<option value='dashed'> Dashed </option>
				 			<option value='solid'>  Solid  </option>
						</select>
					</td>
					<td><input type='text' id="rich_CS_Cont_BC" class='alpha-color-picker' name="rich_CS_Cont_BC" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Cont_BR" name="rich_CS_Cont_BR" min="0" max="10">
							<span class="range-slider__value" id="rich_CS_Cont_BR_Span">0</span>
						</div>
					</td>				
					<td></td>				
				</tr>
				<tr>
					<td colspan='4'>Settings for Image Title</td>
				</tr>
				<tr>
					<td>Show Title <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>		
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_Video_TShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type='text' id="rich_CS_Video_TC" class='alpha-color-picker' value=""></td>
					<td><input type='text' id="rich_CS_Video_TSC" class='alpha-color-picker' value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Video_TFS" min="6" max="36">
							<span class="range-slider__value" id="rich_CS_Video_TFS_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Video_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Video_TTA">
							<option value='left'>   Left   </option>
				 			<option value='right'>  Right  </option>
				 			<option value='center'> Center </option>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Settings for Image Description</td>
				</tr>
				<tr>
					<td>Show Description <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>		
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_Video_DShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type='text' id="rich_CS_Video_DC" class='alpha-color-picker' value=""></td>	
					<td><input type='text' id="rich_CS_Video_DSC" class='alpha-color-picker' value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Video_DFS" min="6" max="36">
							<span class="range-slider__value" id="rich_CS_Video_TFS_Span">0</span>
						</div>
					</td>					
				</tr>
				<tr>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Video_DFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Video_DTA">
							<option value='left'>    Left    </option>
				 			<option value='right'>   Right   </option>
				 			<option value='center'>  Center  </option>
				 			<option value='justify'> Justify </option>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Settings for Image</td>
				</tr>
				<tr>
					<td>Show Image <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Width <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>	
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_Video_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Video_W" min="6" max="36">
							<span class="range-slider__value" id="rich_CS_Video_W_Span">0</span>
						</div>
					</td>
					<td colspan="2"></td>
				</tr>									
				<tr>
					<td colspan='4'>Settings for Link</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_LFS" min="8" max="36">
							<span class="range-slider__value" id="rich_CS_LFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_LFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td><input type='text' id="rich_CS_LC" class='alpha-color-picker' value=""></td>
					<td><input type='text' id="rich_CS_LT" value=""></td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Position <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td><input type='text' id="rich_CS_LBgC" class='alpha-color-picker' value=""></td>
					<td><input type='text' id="rich_CS_LBC" class='alpha-color-picker' value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_LBR" min="0" max="20">
							<span class="range-slider__value" id="rich_CS_LBR_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_LPos">
							<option value='left'>   Left   </option>
				 			<option value='right'>  Right  </option>
				 			<option value='center'> Center </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_Link_BW" min="0" max="20">
							<span class="range-slider__value" id="rich_CS_Link_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Link_BS">
							<option value='none'>   None   </option>
				 			<option value='dotted'> Dotted </option>
				 			<option value='dashed'> Dashed </option>
							<option value='solid'>  Solid  </option>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Hover Settings for Link</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td><input type='text' id="rich_CS_LHBgC" class='alpha-color-picker' value=""></td>
					<td><input type='text' id="rich_CS_LHC" class='alpha-color-picker' value=""></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Settings for Arrows</td>
				</tr>
				<tr>
					<td>Show Arrows <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>		
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_CS_Video_ArrShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_CS_AFS" min="8" max="36">
							<span class="range-slider__value" id="rich_CS_AFS_Span">0</span>
						</div>
					</td>
					<td><input type='text' id="rich_CS_AC" class='alpha-color-picker' value=""></td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_CS_Icon">
							<option value='1'> Type 1 </option>
				 			<option value='2'> Type 2 </option>
				 			<option value='3'> Type 3 </option>
							<option value='4'> Type 4 </option>
							<option value='5'> Type 5 </option>
				 			<option value='6'> Type 6 </option>
				 			<option value='7'> Type 7 </option>
							<option value='8'> Type 8 </option>
							<option value='9'> Type 9 </option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ContSl_L_Show" name="Rich_Web_ContSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ContSl_LT_Show" name="Rich_Web_ContSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ContSl_Loading_Show" name="Rich_Web_ContSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_ContSl_L_BgC" id="Rich_Web_ContSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_ContSl_LT_C" id="Rich_Web_ContSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ContSl_L_C" id="Rich_Web_ContSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_ContSl_L_S" name="Rich_Web_ContSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_ContSl_LT" id="Rich_Web_ContSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_ContSl_L_T" name="Rich_Web_ContSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('ContSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_ContSl_LT_T" name="Rich_Web_ContSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('ContSl')">
							<option value="Type 1"> Type 1  </option>
							<option value="Type 2"> Type 2  </option>
							<option value="Type 3"> Type 3  </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_ContSl_LT_FS" name="Rich_Web_ContSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_ContSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_ContSl_LT_FF" name="Rich_Web_ContSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_ContSl_L_T1_C" id="Rich_Web_ContSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ContSl_L_T2_C" id="Rich_Web_ContSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ContSl_L_T3_C" id="Rich_Web_ContSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_ContSl_LT_T2_BC" id="Rich_Web_ContSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_ContSl_LT_T2_AnC" id="Rich_Web_ContSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_ContSl_LT_T3_BgC" id="Rich_Web_ContSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>									
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_3" style='display:none;'>
				<tr>
					<td colspan='4'>General Option</td>
				</tr>
				<tr>
					<td>Animation Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Slideshow Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>SlideShow Speed (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Animation Duration (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_animation">
							<option value='fade'>  Fade  </option>
				 			<option value='slide'> Slide </option>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_fsl_SShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_SShow_Speed" min="1" max="30">
							<span class="range-slider__value" id="rich_fsl_SShow_Speed_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Anim_Dur" min="1" max="10">
							<span class="range-slider__value" id="rich_fsl_Anim_Dur_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Icon Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause-Play Show</td>
					<td>Randomize <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loop</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_fsl_Ic_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_fsl_PPL_Show" id="rich_fsl_PPL_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_fsl_Randomize"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" name="rich_fsl_Loop" id="rich_fsl_Loop"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td colspan='4'>Slider Settings</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px)</td>
					<td>Border Style</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Width" name="rich_fsl_Width" min="300" max="1000">
							<span class="range-slider__value" id="rich_fsl_Width_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Height" name="rich_fsl_Height" min="200" max="1000">
							<span class="range-slider__value" id="rich_fsl_Height_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Border_Width" name="rich_fsl_Border_Width" min="0" max="20">
							<span class="range-slider__value" id="rich_fsl_Border_Width_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Border_Style" name="rich_fsl_Border_Style">
							<option value='none'>   None   </option>
				 			<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
				 			<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>Box Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td><input type='text' id="rich_fsl_Border_Color" class='alpha-color-picker' name="rich_fsl_Border_Color" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Box_Shadow" min="0" max="50">
							<span class="range-slider__value" id="rich_fsl_Box_Shadow_Span">0</span>
						</div>
					</td>
					<td><input type='text' id="rich_fsl_Shadow_Color" class='alpha-color-picker' value=""></td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Description Settings</td>
				</tr>
				<tr>
					<td>Description Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="rich_fsl_Desc_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Desc_Size" min="8" max="36">
							<span class="range-slider__value" id="rich_fsl_Desc_Size_Span">0</span>
						</div>
					</td>
					<td><input type='text' id="rich_fsl_Desc_Color" class='alpha-color-picker' value=""></td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Desc_Font_Family">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>					
				</tr>
				<tr>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Desc_Text_Align">
							<option value='left'>   Left   </option>
							<option value='right'>  Right  </option>
				 			<option value='center'> Center </option>
						</select>
					</td>
					<td><input type='text' id="rich_fsl_Desc_Bg_Color" class='alpha-color-picker' value=""></td>
					
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Title Settings</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Title_Font_Size" min="8" max="36">
							<span class="range-slider__value" id="rich_fsl_Title_Font_Size_Span">0</span>
						</div>
					</td>
					<td><input type='text' id="rich_fsl_Title_Color" class='alpha-color-picker' value=""></td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Title_Font_Family">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Title_Text_Align">
							<option value='left'>   Left   </option>
							<option value='right'>  Right  </option>
				 			<option value='center'> Center </option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='4'>Link Settings</td>
				</tr>
				<tr>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td><input type='text' id="rich_fsl_Link_Text" value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Link_Border_Width" min="0" max="30">
							<span class="range-slider__value" id="rich_fsl_Link_Border_Width_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Link_Border_Style">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
				 			<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td><input type='text' id="rich_fsl_Link_Border_Color" class='alpha-color-picker' value=""></td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Link_Font_Size" min="8" max="36">
							<span class="range-slider__value" id="rich_fsl_Link_Font_Size_Span">0</span>
						</div>
					</td>
					<td><input type='text' id="rich_fsl_Link_Color" class='alpha-color-picker' value=""></td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Link_Font_Family">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td><input type='text' id="rich_fsl_Link_Bg_Color" class='alpha-color-picker' value=""></td>
				</tr>
				<tr>
					<td>Hover Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td><input type='text' id="rich_fsl_Link_Hover_Border_Color" class='alpha-color-picker' value=""></td>
					<td><input type='text' id="rich_fsl_Link_Hover_Bg_Color" class='alpha-color-picker' value=""></td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Title_Text_Shadow" min="0" max="100">
							<span class="range-slider__value" id="rich_fsl_Title_Text_Shadow_Span">0</span>
						</div>
					</td>
					<td></td>
				</tr>
				<tr>					
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>					
					<td><input type='text' id="rich_fsl_Link_Hover_Color" class='alpha-color-picker' value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Icon Settings</td>
				</tr>
				<tr>
					<td>Icon Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="rich_fsl_Icon_Size" min="10" max="45">
							<span class="range-slider__value" id="rich_fsl_Icon_Size_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Icon_Type">
							<option value='1'>  Icon 1  </option>
							<option value='2'>  Icon 2  </option>
							<option value='3'>  Icon 3  </option>
							<option value='4'>  Icon 4  </option>
							<option value='5'>  Icon 5  </option>
							<option value='6'>  Icon 6  </option>
							<option value='7'>  Icon 7  </option>
							<option value='8'>  Icon 8  </option>
							<option value='9'>  Icon 9  </option>
							<option value='10'> Icon 10 </option>
							<option value='11'> Icon 11 </option>
							<option value='12'> Icon 12 </option>
							<option value='13'> Icon 13 </option>
							<option value='14'> Icon 14 </option>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="rich_fsl_Hover_Icon_Type">
							<option value='1'>  Icon 1  </option>
							<option value='2'>  Icon 2  </option>
							<option value='3'>  Icon 3  </option>
							<option value='4'>  Icon 4  </option>
							<option value='5'>  Icon 5  </option>
							<option value='6'>  Icon 6  </option>
							<option value='7'>  Icon 7  </option>
							<option value='8'>  Icon 8  </option>
							<option value='9'>  Icon 9  </option>
							<option value='10'> Icon 10 </option>
							<option value='11'> Icon 11 </option>
							<option value='12'> Icon 12 </option>
							<option value='13'> Icon 13 </option>
							<option value='14'> Icon 14 </option>
						</select>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FSl_L_Show" name="Rich_Web_FSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FSl_LT_Show" name="Rich_Web_FSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FSl_Loading_Show" name="Rich_Web_FSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_FSl_L_BgC" id="Rich_Web_FSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_FSl_LT_C" id="Rich_Web_FSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FSl_L_C" id="Rich_Web_FSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_FSl_L_S" name="Rich_Web_FSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_FSl_LT" id="Rich_Web_FSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_FSl_L_T" name="Rich_Web_FSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('FSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_FSl_LT_T" name="Rich_Web_FSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('FSl')">
							<option value="Type 1"> Type 1  </option>
							<option value="Type 2"> Type 2  </option>
							<option value="Type 3"> Type 3  </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_FSl_LT_FS" name="Rich_Web_FSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_FSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_FSl_LT_FF" name="Rich_Web_FSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_FSl_L_T1_C" id="Rich_Web_FSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FSl_L_T2_C" id="Rich_Web_FSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FSl_L_T3_C" id="Rich_Web_FSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_FSl_LT_T2_BC" id="Rich_Web_FSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_FSl_LT_T2_AnC" id="Rich_Web_FSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_FSl_LT_T3_BgC" id="Rich_Web_FSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_4" style='display:none;'>
				<tr>
					<td colspan='4'>General Options</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px)</td>
					<td>Border Style</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_W" name="Rich_Web_Sl_CT_W" min="100" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_H" name="Rich_Web_Sl_CT_H" min="100" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_BW" name="Rich_Web_Sl_CT_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_BS" name="Rich_Web_Sl_CT_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_BC" name="Rich_Web_Sl_CT_BC" value="">
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_CT_BxSShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_CT_BxSType"/>
							<span class="switch-label" data-on="1" data-off="2"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_BxS" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_BxS_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>					
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_BxC" value="">
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='2'>Title & Description Area</td>
					<td colspan='2'>Loading Icon</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Position <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_TDABgC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_TDAPos">
							<option value='top'>    Top    </option>
							<option value='bottom'> Bottom </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_LBgC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Title Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Current Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_TFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_TFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_TCC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_TC" value="">
					</td>
				</tr>
				<tr>
					<td colspan='4'>Arrow Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Show Arrow Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_ArBgC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_ArBR" min="0" max="25">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_ArBR_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_ArType">
							<option value='1'> Type 1 </option>
							<option value='2'> Type 2 </option>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_CT_ArText"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Left Arrow Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Right Arrow Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_ArLeft" value="">
					</td>
					<td>
						<input type="text"  id="Rich_Web_Sl_CT_ArRight" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_ArTextC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_ArTextFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_ArTextFS_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Text Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_CT_ArTextFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Arrow Hover</td>
				</tr>
				<tr>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_CT_ArHBC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_CT_ArHBR" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_CT_ArHBR_Span">0</span>
						</div>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CircleSl_L_Show" name="Rich_Web_CircleSl_L_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CircleSl_LT_Show" name="Rich_Web_CircleSl_LT_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CircleSl_Loading_Show" name="Rich_Web_CircleSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_CircleSl_L_BgC" id="Rich_Web_CircleSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_CircleSl_LT_C" id="Rich_Web_CircleSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CircleSl_L_C" id="Rich_Web_CircleSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_CircleSl_L_S" name="Rich_Web_CircleSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_CircleSl_LT" id="Rich_Web_CircleSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_CircleSl_L_T" name="Rich_Web_CircleSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('CircleSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_CircleSl_LT_T" name="Rich_Web_CircleSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('CircleSl')">
							<option value="Type 1">  Type 1  </option>
							<option value="Type 2">  Type 2  </option>
							<option value="Type 3">  Type 3  </option>
							<option value="Type 4">  Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_CircleSl_LT_FS" name="Rich_Web_CircleSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_CircleSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_CircleSl_LT_FF" name="Rich_Web_CircleSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_CircleSl_L_T1_C" id="Rich_Web_CircleSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CircleSl_L_T2_C" id="Rich_Web_CircleSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CircleSl_L_T3_C" id="Rich_Web_CircleSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_CircleSl_LT_T2_BC" id="Rich_Web_CircleSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_CircleSl_LT_T2_AnC" id="Rich_Web_CircleSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_CircleSl_LT_T3_BgC" id="Rich_Web_CircleSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>				
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_5" style='display:none;'>
				<tr>
					<td colspan='4'>General Options</td>
				</tr>
				<tr>
					<td>Border Width (px)</td>
					<td>Border Style</td>
					<td>Border Color</td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_BW" name="Rich_Web_Sl_SC_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_BS" name="Rich_Web_Sl_SC_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_BC" name="Rich_Web_Sl_SC_BC" value="">
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_SC_BoxShShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_SC_BoxShType"/>
							<span class="switch-label" data-on="1" data-off="2"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_BoxSh" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_BoxSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_BoxShC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Image Options</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_IW" name="Rich_Web_Sl_SC_IW" min="100" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_IW_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_IH" name="Rich_Web_Sl_SC_IH" min="100" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_IH_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_IBW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_IBW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_IBS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_IBC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_IBR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_IBR_Span">0</span>
						</div>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Image Container</td>
				</tr>
				<tr>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Overlay Color</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_ICBW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_ICBW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_ICBS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_ICBC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id='Rich_Web_CarSl_H_OvC' name='Rich_Web_CarSl_H_OvC' value="">
					</td>
				</tr>
				<tr>
					<td>Hover Type</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id='Rich_Web_CarSl_HT' name='Rich_Web_CarSl_HT'>
							<option value='1'>   Type 1   </option>
							<option value='2'>   Type 2   </option>
							<option value='3'>   Type 3   </option>
							<option value='4'>   Type 4   </option>
							<option value='5'>   Type 5   </option>
							<option value='6'>   Type 6   </option>
							<option value='7'>   Type 7   </option>
							<option value='8'>   Type 8   </option>
							<option value='9'>   Type 9   </option>
							<option value='10'>  Type 10   </option>
							<option value='11'>  Default   </option>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Title Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_TBgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_TC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_TFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_TFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_THBgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_THC" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Popup Image Options</td>
				</tr>
				<tr>
					<td>Overlay Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Pop_OC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_Pop_BW" min="0" max="15">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_Pop_BW_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Pop_BC" value="">
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_SC_Pop_BoxShShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_SC_Pop_BoxShType"/>
							<span class="switch-label" data-on="1" data-off="2"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_Pop_BoxSh" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_Pop_BoxSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Pop_BoxShC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Link Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_L_BgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_L_C" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_L_FS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_L_FS_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_L_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_L_BW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_L_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_L_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_L_BR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_L_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_L_HBgC" value="">
					</td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_L_HC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_L_Type">
							<option value='text'> Text </option>
							<option value='icon'> Icon </option>
						</select>
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_L_Text" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_L_IType">
							<option value='link'>          Type 1 </option>
							<option value='paperclip'>     Type 2 </option>
							<option value='external-link'> Type 3 </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_L_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Popup Icon</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PI_BgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PI_C" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_PI_FS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_PI_FS_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_PI_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_PI_BW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PI_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PI_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_PI_BR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_PI_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PI_HBgC" value="">
					</td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PI_HC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PI_Type">
							<option value='text'> Text </option>
							<option value='icon'> Icon </option>
						</select>
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PI_Text" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PI_IType">
							<option value='file-image-o'>   Type 1 </option>
							<option value='picture-o'>      Type 2 </option>
							<option value='eye'>            Type 3 </option>
							<option value='object-ungroup'> Type 4 </option>
							<option value='television'>     Type 5 </option>
							<option value='arrows-alt'>     Type 6 </option>
							<option value='camera'>         Type 7 </option>
							<option value='camera-retro'>   Type 8 </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PI_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Arrows Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Arr_BgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Arr_C" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_Arr_FS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_Arr_FS_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_Arr_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_Arr_BW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Arr_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_Arr_BR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_Arr_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Arr_HBgC" value="">
					</td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_Arr_HC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_Type">
							<option value='text'> Text </option>
							<option value='icon'> Icon </option>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_IType">
							<option value='angle-double'>   Type 1  </option>
							<option value='angle'>          Type 2  </option>
							<option value='arrow-circle'>   Type 3  </option>
							<option value='arrow-circle-o'> Type 4  </option>
							<option value='arrow'>          Type 5  </option>
							<option value='caret'>          Type 6  </option>
							<option value='caret-square-o'> Type 7  </option>
							<option value='chevron-circle'> Type 8  </option>
							<option value='chevron'>        Type 9  </option>
							<option value='hand-o'>         Type 10 </option>
							<option value='long-arrow'>     Type 11 </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Next Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
 					<td>Prev Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_Next" value="">
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_Arr_Prev" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Popup Close Icon</td>
				</tr>
				<tr>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_SC_PCI_FS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_SC_PCI_FS_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_SC_PCI_C" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_SC_PCI_Type">
							<option value='home'>           Type 1 </option>
							<option value='times'>          Type 2 </option>
							<option value='times-circle'>   Type 3 </option>
							<option value='times-circle-o'> Type 4 </option>
						</select>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CarSl_L_Show" name="Rich_Web_CarSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CarSl_LT_Show" name="Rich_Web_CarSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_CarSl_Loading_Show" name="Rich_Web_CarSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_CarSl_L_BgC" id="Rich_Web_CarSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_CarSl_LT_C" id="Rich_Web_CarSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CarSl_L_C" id="Rich_Web_CarSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_CarSl_L_S" name="Rich_Web_CarSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_CarSl_LT" id="Rich_Web_CarSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_CarSl_L_T" name="Rich_Web_CarSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('CarSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_CarSl_LT_T" name="Rich_Web_CarSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('CarSl')">
							<option value="Type 1">  Type 1  </option>
							<option value="Type 2">  Type 2  </option>
							<option value="Type 3">  Type 3  </option>
							<option value="Type 4">  Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?php echo $Rich_Web_Sl5_Loader[0]->Rich_Web_CarSl_LT_FS;?>" id="Rich_Web_CarSl_LT_FS" name="Rich_Web_CarSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_CarSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_CarSl_LT_FF" name="Rich_Web_CarSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_CarSl_L_T1_C" id="Rich_Web_CarSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CarSl_L_T2_C" id="Rich_Web_CarSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_CarSl_L_T3_C" id="Rich_Web_CarSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_CarSl_LT_T2_BC" id="Rich_Web_CarSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_CarSl_LT_T2_AnC" id="Rich_Web_CarSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_CarSl_LT_T3_BgC" id="Rich_Web_CarSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>			
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_6" style='display:none;'>
				<tr>
					<td colspan='4'>General Options</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Autoplay <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Transition Speed (ms) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause Time (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_BgC" value="">
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_AP"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_TS" min="100" max="1000" step="100">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_TS_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_PT" min="1" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_PT_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Slide Steps <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Visibility of Slides <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Count of Slides <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Slide Loop <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_SS" min="1" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_SS_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_SVis"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_CS" min="1" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_CS_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_SLoop"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Slide Scaling <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Slide Position <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Always Show Nav Buttons <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_SSc" min="100" max="300" step="10">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_SSc_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_FS_SlPos">
							<option value='left'>   Left   </option>
							<option value='right'>  Right  </option>
							<option value='center'> Center </option>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_ShNavBut"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Image Options</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px)</td>
					<td>Border Style</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_I_W" name="Rich_Web_Sl_FS_I_W" min="100" max="900">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_I_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_I_H" name="Rich_Web_Sl_FS_I_H" min="100" max="900">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_I_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_I_BW" name="Rich_Web_Sl_FS_I_BW" min="0" max="15">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_I_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_FS_I_BS" name="Rich_Web_Sl_FS_I_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>Border Radius (px)</td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_I_BC" name="Rich_Web_Sl_FS_I_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_I_BR" name="Rich_Web_Sl_FS_I_BR" min="0" max="200">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_I_BR_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_I_BoxShShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_I_BoxShType"/>
							<span class="switch-label" data-on="1" data-off="2"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_I_BoxSh" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_I_BoxSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_I_BoxShC" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Title Options</td>
				</tr>
				<tr>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_T_C" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_FS_T_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Navigation Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_Nav_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Nav_W" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Nav_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Nav_H" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Nav_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Nav_BW" min="0" max="5">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Nav_BW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Place Between (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_FS_Nav_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_Nav_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Nav_BR" min="0" max="15">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Nav_BR_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Nav_PB" min="0" max="15">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Nav_PB_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Current Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_Nav_CC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_Nav_HC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_Nav_C" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Arrows Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_FS_Arr_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_FS_Arr_Type">
							<option value='angle-double'>   Type 1  </option>
							<option value='angle'>          Type 2  </option>
							<option value='arrow-circle'>   Type 3  </option>
							<option value='arrow-circle-o'> Type 4  </option>
							<option value='arrow'>          Type 5  </option>
							<option value='caret'>          Type 6  </option>
							<option value='caret-square-o'> Type 7  </option>
							<option value='chevron-circle'> Type 8  </option>
							<option value='chevron'>        Type 9  </option>
							<option value='hand-o'>         Type 10 </option>
							<option value='long-arrow'>     Type 11 </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_FS_Arr_S" min="8" max="80">
							<span class="range-slider__value" id="Rich_Web_Sl_FS_Arr_S_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_FS_Arr_C" value="">
					</td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FlexibleSl_L_Show" name="Rich_Web_FlexibleSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FlexibleSl_LT_Show" name="Rich_Web_FlexibleSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_FlexibleSl_Loading_Show" name="Rich_Web_FlexibleSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_FlexibleSl_L_BgC" id="Rich_Web_FlexibleSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_FlexibleSl_LT_C" id="Rich_Web_FlexibleSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FlexibleSl_L_C" id="Rich_Web_FlexibleSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_FlexibleSl_L_S" name="Rich_Web_FlexibleSl_L_S" class="rich_web_Select_Menu">
							<option value="small" >  Small   </option>
							<option value="middle">  Middle  </option>
							<option value="large" >  Large   </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_FlexibleSl_LT" id="Rich_Web_FlexibleSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_FlexibleSl_L_T" name="Rich_Web_FlexibleSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('FlexibleSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_FlexibleSl_LT_T" name="Rich_Web_FlexibleSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('FlexibleSl')">
							<option value="Type 1"> Type 1    </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3    </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_FlexibleSl_LT_FS" name="Rich_Web_FlexibleSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_FlexibleSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_FlexibleSl_LT_FF" name="Rich_Web_FlexibleSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_FlexibleSl_L_T1_C" id="Rich_Web_FlexibleSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FlexibleSl_L_T2_C" id="Rich_Web_FlexibleSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_FlexibleSl_L_T3_C" id="Rich_Web_FlexibleSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_FlexibleSl_LT_T2_BC" id="Rich_Web_FlexibleSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_FlexibleSl_LT_T2_AnC" id="Rich_Web_FlexibleSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_FlexibleSl_LT_T3_BgC" id="Rich_Web_FlexibleSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_7" style='display:none;'>
				<tr>
					<td colspan='4'>General Options</td>
				</tr>
				<tr>
					<td>Autoplay <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause Time (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Transition <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px)</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_DS_AP"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_PT" min="1" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_PT_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_DS_Tr"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_H" name="Rich_Web_Sl_DS_H" min="150" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_H_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Width (px)</td>
					<td>Border Style</td>
					<td>Border Color</td>
					<td>Slider Image Type</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_BW" name="Rich_Web_Sl_DS_BW" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_BS" name="Rich_Web_Sl_DS_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_BC" name="Rich_Web_Sl_DS_BC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id='Rich_Web_DynamicSl_ImgT' name='Rich_Web_DynamicSl_ImgT'>
							<option value='Type 1'>  Type 1  </option>
							<option value='Type 2'>  Type 2  </option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='4'>Title Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_TFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_TFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_TC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Description Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_DFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_DFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_DFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_DC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Link Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_LFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_LFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_LFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_LC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_LBgC" value="">
					</td>
				</tr>
				<tr>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_LBW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_LBW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_LBS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_LBC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_LBR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_LBR_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Link Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_LHC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_LHBgC" value="">
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_LT" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Arrow Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Left Arrow Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Right Arrow Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_DS_Arr_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_Arr_LT" value="">
					</td>
					<td>
						<input type="text" class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_Arr_RT" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Arr_C" value="">
					</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Arr_BgC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Arr_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Arr_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_Arr_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Arr_BC" value="">
					</td>
				</tr>
				<tr>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Arr_BR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Arr_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Arr_HC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Arr_HBgC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Navigation Options</td>
				</tr>
				<tr>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Place Between (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Nav_W" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Nav_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Nav_H" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Nav_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Nav_PB" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Nav_PB_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Nav_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Nav_BW_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_DS_Nav_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Nav_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_DS_Nav_BR" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_DS_Nav_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Nav_C" value="">
					</td>
				</tr>
				<tr>
					<td>Hover Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Current Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Nav_HC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_DS_Nav_CC" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_DynamicSl_L_Show" name="Rich_Web_DynamicSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_DynamicSl_LT_Show" name="Rich_Web_DynamicSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_DynamicSl_Loading_Show" name="Rich_Web_DynamicSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_DynamicSl_L_BgC" id="Rich_Web_DynamicSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_DynamicSl_LT_C" id="Rich_Web_DynamicSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_DynamicSl_L_C" id="Rich_Web_DynamicSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_DynamicSl_L_S" name="Rich_Web_DynamicSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_DynamicSl_LT" id="Rich_Web_DynamicSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_DynamicSl_L_T" name="Rich_Web_DynamicSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('DynamicSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_DynamicSl_LT_T" name="Rich_Web_DynamicSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('DynamicSl')">
							<option value="Type 1">  Type 1  </option>
							<option value="Type 2">  Type 2  </option>
							<option value="Type 3">  Type 3  </option>
							<option value="Type 4">  Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_DynamicSl_LT_FS" name="Rich_Web_DynamicSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_DynamicSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_DynamicSl_LT_FF" name="Rich_Web_DynamicSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_DynamicSl_L_T1_C" id="Rich_Web_DynamicSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_DynamicSl_L_T2_C" id="Rich_Web_DynamicSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_DynamicSl_L_T3_C" id="Rich_Web_DynamicSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_DynamicSl_LT_T2_BC" id="Rich_Web_DynamicSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_DynamicSl_LT_T2_AnC" id="Rich_Web_DynamicSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_DynamicSl_LT_T3_BgC" id="Rich_Web_DynamicSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_8" style='display:none;'>
				<tr>
					<td colspan='4'>General Options</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px)</td>
					<td>Border Style</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_W" name="Rich_Web_Sl_TSL_W" min="150" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_H" name="Rich_Web_Sl_TSL_H" min="150" max="1200">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_BW" name="Rich_Web_Sl_TSL_BW" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_BS" name="Rich_Web_Sl_TSL_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>Border Radius (px)</td>
					<td>Box Shadow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_BC" name="Rich_Web_Sl_TSL_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_BR" name="Rich_Web_Sl_TSL_BR" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_BR_Span">0</span>
						</div>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_BoxShShow"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_BoxShType"/>
							<span class="switch-label" data-on="1" data-off="2"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Change Mode <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Toggle Arrows <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_BoxSh" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_BoxSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_BoxShC" value="">
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_CM">
							<option value='horizontal'> Horizontal </option>
							<option value='vertical'>   Vertical   </option>
							<option value='fade'>       Fade       </option>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_TA"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
				</tr>
				<tr>
					<td>Auto Play <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause on Hover <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loop <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Pause Time (s) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_AP"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_PH"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_Loop"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_PT" min="1" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_PT_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Change Speed (ms) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_CS" min="100" max="1000" step="100">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_CS_Span">0</span>
						</div>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Navigation Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>					
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Place Between (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_Nav_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Nav_W" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Nav_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Nav_H" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Nav_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Nav_PB" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Nav_PB_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Current Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Nav_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Nav_BR" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Nav_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Nav_CBC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Nav_HBC" value="">
					</td>
				</tr>
				<tr>
					<td>Position <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_Nav_Pos">
							<option value='top'>    Top    </option>
							<option value='bottom'> Bottom </option>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Start/Stop Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_SS_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_SS_W" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_SS_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_SS_H" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_SS_H_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_SS_BC" value="">
					</td>
				</tr>
				<tr>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Start Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Stop Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_SS_BR" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_SS_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_SS_StC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_SS_SpC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Arrows Options</td>
				</tr>
				<tr>
					<td>Show <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_Sl_TSL_Arr_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_Arr_Type">
							<option value='5'>  Type 1  </option>
							<option value='6'>  Type 2  </option>
							<option value='7'>  Type 3  </option>
							<option value='8'>  Type 4  </option>
							<option value='9'>  Type 5  </option>
							<option value='10'> Type 6  </option>
							<option value='11'> Type 7  </option>
							<option value='12'> Type 8  </option>
							<option value='13'> Type 9  </option>
							<option value='14'> Type 10 </option>
							<option value='15'> Type 11 </option>
							<option value='16'> Type 12 </option>
							<option value='17'> Type 13 </option>
							<option value='18'> Type 14 </option>
							<option value='19'> Type 15 </option>
							<option value='20'> Type 16 </option>
							<option value='21'> Type 17 </option>
							<option value='22'> Type 18 </option>
							<option value='23'> Type 19 </option>
							<option value='24'> Type 20 </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Arr_S" min="0" max="100">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Arr_S_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Arr_C" value="">
					</td>
				</tr>
				<tr>
					<td colspan='4'>Popup Options</td>
				</tr>
				<tr>
					<td>Overlay Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Pop_OvC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Pop_BW" min="0" max="15">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Pop_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_Pop_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Pop_BC" value="">
					</td>
				</tr>
				<tr>
					<td>Border Radius (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Content Background <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Pop_BR" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Pop_BR_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Pop_BgC" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Title in Popup</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_TFS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_TFS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_TFF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_TC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Arrows in Popup</td>
				</tr>
				<tr>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_Pop_ArrType">
							<option value='angle-double'>   Type 1  </option>
							<option value='angle'>          Type 2  </option>
							<option value='arrow-circle'>   Type 3  </option>
							<option value='arrow-circle-o'> Type 4  </option>
							<option value='arrow'>          Type 5  </option>
							<option value='caret'>          Type 6  </option>
							<option value='caret-square-o'> Type 7  </option>
							<option value='chevron-circle'> Type 8  </option>
							<option value='chevron'>        Type 9  </option>
							<option value='hand-o'>         Type 10 </option>
							<option value='long-arrow'>     Type 11 </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_Pop_ArrS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_Pop_ArrS_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_Pop_ArrC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Close Icon in Popup</td>
				</tr>
				<tr>
					<td>Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_Sl_TSL_CIT">
							<option value='home'>           Type 1 </option>
							<option value='times'>          Type 2 </option>
							<option value='times-circle'>   Type 3 </option>
							<option value='times-circle-o'> Type 4 </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_Sl_TSL_CIS" min="8" max="48">
							<span class="range-slider__value" id="Rich_Web_Sl_TSL_CIS_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_Sl_TSL_CIC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ThSl_L_Show" name="Rich_Web_ThSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ThSl_LT_Show" name="Rich_Web_ThSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_ThSl_Loading_Show" name="Rich_Web_ThSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_ThSl_L_BgC" id="Rich_Web_ThSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_ThSl_LT_C" id="Rich_Web_ThSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ThSl_L_C" id="Rich_Web_ThSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_ThSl_L_S" name="Rich_Web_ThSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_ThSl_LT" id="Rich_Web_ThSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_ThSl_L_T" name="Rich_Web_ThSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('ThSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_ThSl_LT_T" name="Rich_Web_ThSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('ThSl')">
							<option value="Type 1"> Type 1  </option>
							<option value="Type 2"> Type 2  </option>
							<option value="Type 3"> Type 3  </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_ThSl_LT_FS" name="Rich_Web_ThSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_ThSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_ThSl_LT_FF" name="Rich_Web_ThSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_ThSl_L_T1_C" id="Rich_Web_ThSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ThSl_L_T2_C" id="Rich_Web_ThSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_ThSl_L_T3_C" id="Rich_Web_ThSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_ThSl_LT_T2_BC" id="Rich_Web_ThSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_ThSl_LT_T2_AnC" id="Rich_Web_ThSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_ThSl_LT_T3_BgC" id="Rich_Web_ThSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_9" style='display:none;'>
				<tr>
					<td colspan='4'>Slider Options</td>
				</tr>
				<tr>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Height (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Style <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_W" min="200" max="1000">
							<span class="range-slider__value" id="Rich_Web_AcSL_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_H" min="200" max="1000">
							<span class="range-slider__value" id="Rich_Web_AcSL_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_BW" min="0" max="20">
							<span class="range-slider__value" id="Rich_Web_AcSL_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AcSL_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_BSh" min="0" max="50">
							<span class="range-slider__value" id="Rich_Web_AcSL_BSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_BShC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Slider Image Options</td>
				</tr>
				<tr>
					<td>Width (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Box Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Img_W" min="50" max="700">
							<span class="range-slider__value" id="Rich_Web_AcSL_Img_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Img_BSh" min="0" max="10">
							<span class="range-slider__value" id="Rich_Web_AcSL_Img_BSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Img_BShC" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan='4'>Slider Image Title Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Title_FS" min="8" max="36">
							<span class="range-slider__value" id="Rich_Web_AcSL_Title_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AcSL_Title_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Title_C" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Title_TSh" min="0" max="5">
							<span class="range-slider__value" id="Rich_Web_AcSL_Title_TSh_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Title_TShC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Title_BgC" value="">
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan='4'>Slider Image Link Options</td>
				</tr>
				<tr>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Link_FS" min="8" max="36">
							<span class="range-slider__value" id="Rich_Web_AcSL_Link_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AcSL_Link_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Link_C" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AcSL_Link_TSh" min="0" max="5">
							<span class="range-slider__value" id="Rich_Web_AcSL_Link_TSh_Span">0</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Link_TShC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AcSL_Link_BgC" value="">
					</td>
					<td>
						<input type='text' id="Rich_Web_AcSL_Link_Text" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AccSl_L_Show" name="Rich_Web_AccSl_L_Show"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AccSl_LT_Show" name="Rich_Web_AccSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AccSl_Loading_Show" name="Rich_Web_AccSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_AccSl_L_BgC" id="Rich_Web_AccSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_AccSl_LT_C" id="Rich_Web_AccSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AccSl_L_C" id="Rich_Web_AccSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_AccSl_L_S" name="Rich_Web_AccSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_AccSl_LT" id="Rich_Web_AccSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_AccSl_L_T" name="Rich_Web_AccSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('AccSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_AccSl_LT_T" name="Rich_Web_AccSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('AccSl')">
							<option value="Type 1"> Type 1  </option>
							<option value="Type 2"> Type 2  </option>
							<option value="Type 3"> Type 3  </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AccSl_LT_FS" name="Rich_Web_AccSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_AccSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AccSl_LT_FF" name="Rich_Web_AccSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_AccSl_L_T1_C" id="Rich_Web_AccSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AccSl_L_T2_C" id="Rich_Web_AccSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AccSl_L_T3_C" id="Rich_Web_AccSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_AccSl_LT_T2_BC" id="Rich_Web_AccSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_AccSl_LT_T2_AnC" id="Rich_Web_AccSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_AccSl_LT_T3_BgC" id="Rich_Web_AccSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
			<table class="rich_web_SaveSl_Table_2 rich_web_SaveSl_Table_2_10" style='display:none;'>
				<tr>
					<td colspan='4'>General Settings</td>
				</tr>
				<tr>
					<td>Width (px)</td>
					<td>Height (px)</td>
					<td>Border Width (px)</td>
					<td>Border Style</td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_W" name="Rich_Web_AnSL_W" min="300" max="1400">
							<span class="range-slider__value" id="Rich_Web_AnSL_W_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_H" name="Rich_Web_AnSL_H" min="300" max="1400">
							<span class="range-slider__value" id="Rich_Web_AnSL_H_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_BW" name="Rich_Web_AnSL_BW" min="0" max="30">
							<span class="range-slider__value" id="Rich_Web_AnSL_BW_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_BS" name="Rich_Web_AnSL_BS">
							<option value='none'>   None   </option>
							<option value='solid'>  Solid  </option>
							<option value='dotted'> Dotted </option>
							<option value='dashed'> Dashed </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>Radius (px)</td>
					<td>Shadow (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_BC" name="Rich_Web_AnSL_BC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_BR" name="Rich_Web_AnSL_BR" min="0" max="200">
							<span class="range-slider__value" id="Rich_Web_AnSL_BR_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_BSh" min="0" max="30">
							<span class="range-slider__value" id="Rich_Web_AnSL_BSh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_ShC" value="">
					</td>
				</tr>
				<tr>
					<td>Effect Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Slideshow <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Slideshow Change Time (ms) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Shadow Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_ET">
							<option value='1'>  Curve-Horizontal          </option>
							<option value='2'>  Curve-Vertical            </option>
							<option value='3'>  Curve-Criss-Cross         </option>
							<option value='4'>  Curve-Criss-Cross-Reverse </option>
							<option value='5'>  Opacity                   </option>
							<option value='6'>  Zoom-Out                  </option>
							<option value='7'>  Zoom-Out-Bazier           </option>
							<option value='8'>  Zoom-In                   </option>
							<option value='9'>  Zoom-In-Bazier            </option>
							<option value='10'> Zoom-In-Bazier-Circle     </option>
							<option value='11'> Zoom-In-Circle            </option>
							<option value='12'> Zoom-Criss-Cross          </option>
							<option value='13'> Zoom-Criss-Cross-Reverse  </option>
							<option value='14'> None                      </option>
						</select>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnSL_SSh"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_SShChT" min="1000" max="10000">
							<span class="range-slider__value" id="Rich_Web_AnSL_SShChT_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_N_BS">
							<option value='Type 1'> Type 1 </option>
							<option value='Type 2'> Type 2 </option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='4'>Title Settings</td>
				</tr>
				<tr>
					<td>Font Size(px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_T_FS" min="8" max="36">
							<span class="range-slider__value" id="Rich_Web_AnSL_T_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_T_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_T_C" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_T_BgC" value="">
					</td>
				</tr>
				<tr>
					<td>Text Align <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_T_TA">
							<option value='left'>    Left    </option>
							<option value='right'>   Right   </option>
							<option value='center'>  Center  </option>
							<option value='justify'> Justify </option>
						</select>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td colspan='4'>Navigation Settings</td>
				</tr>
				<tr>
					<td>Navigation <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size(px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Width(px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Border Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnSL_N_Sh"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_N_S" min="5" max="30">
							<span class="range-slider__value" id="Rich_Web_AnSL_T_Sh_Span">0</span>
						</div>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_N_BW" min="0" max="5">
							<span class="range-slider__value" id="Rich_Web_AnSL_T_Sh_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_N_BC" value="">
					</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Margin (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Hover Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Current Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_N_BgC" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_N_M" min="0" max="12">
							<span class="range-slider__value" id="Rich_Web_AnSL_N_M_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_N_HBgC" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_N_CC" value="">
					</td>
				</tr>
				<tr>
					<td colspan='4'>Icons Settings</td>
				</tr>
				<tr>
					<td>Icons <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Image/Icon <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnSL_Ic_Sh"/>
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_T_ShC">
							<option value='Image'> Image </option>
							<option value='Icon'>  Icon  </option>
						</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>Image Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Type <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Size <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Icon Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_T_Sh">							
							<option value='1'>  Type 1  </option>
							<option value='2'>  Type 2  </option>
							<option value='3'>  Type 3  </option>
							<option value='4'>  Type 4  </option>
							<option value='5'>  Type 5  </option>
							<option value='6'>  Type 6  </option>
							<option value='7'>  Type 7  </option>
							<option value='8'>  Type 8  </option>
							<option value='9'>  Type 9  </option>
							<option value='10'> Type 10 </option>
							<option value='11'> Type 11 </option>
							<option value='12'> Type 12 </option>
							<option value='13'> Type 13 </option>
							<option value='14'> Type 14 </option>
							<option value='15'> Type 15 </option>
							<option value='16'> Type 16 </option>
							<option value='17'> Type 17 </option>
							<option value='18'> Type 18 </option>
							<option value='19'> Type 19 </option>
							<option value='20'> Type 20 </option>
							<option value='21'> Type 21 </option>
							<option value='22'> Type 22 </option>
							<option value='23'> Type 23 </option>
							<option value='24'> Type 24 </option>
							<option value='25'> Type 25 </option>
							<option value='26'> Type 26 </option>
							<option value='27'> Type 27 </option>
							<option value='28'> Type 28 </option>
						</select>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_Ic_T">
							<option value='rich_web rich_web-angle-double'>   Icon 1  </option>
							<option value='rich_web rich_web-angle'>          Icon 2  </option>
							<option value='rich_web rich_web-arrow-circle'>   Icon 3  </option>
							<option value='rich_web rich_web-arrow-circle-o'> Icon 4  </option>
							<option value='rich_web rich_web-arrow'>          Icon 5  </option>
							<option value='rich_web rich_web-caret'>          Icon 6  </option>
							<option value='rich_web rich_web-caret-square-o'> Icon 7  </option>
							<option value='rich_web rich_web-chevron-circle'> Icon 8  </option>
							<option value='rich_web rich_web-chevron'>        Icon 9  </option>
							<option value='rich_web rich_web-hand-o'>         Icon 10 </option>
							<option value='rich_web rich_web-long-arrow'>     Icon 11 </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_Ic_S" min="10" max="80">
							<span class="range-slider__value" id="Rich_Web_AnSL_Ic_S_Span">0</span>
						</div>
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_Ic_C" value="">
					</td>
				</tr>
				<tr>
					<td colspan='4'>Loader Settings</td>
				</tr>
				<tr>
					<td>Background Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Text <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Size (px) <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Font Family <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_L_BgC" value="">
					</td>
					<td>
						<input type='text' id="Rich_Web_AnSL_L_T" value="">
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnSL_L_FS" min="8" max="36">
							<span class="range-slider__value" id="Rich_Web_AnSL_L_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnSL_L_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Text Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loader 1 Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loader 2 Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
					<td>Loader 3 Color <span class="Rich_Web_SliderIm_Pro">(Pro)</span></td>
				</tr>
				<tr>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_L_C" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_L1_T" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_L2_T" value="">
					</td>
					<td>
						<input type='text' class='alpha-color-picker' id="Rich_Web_AnSL_L3_T" value="">
					</td>
				</tr>
				<tr>
					<td colspan="4">Loading Options</td>
				</tr>
				<tr>
					<td>Loader Show</td>
					<td>Loader Text Show</td>
					<td>Loading Show</td>
					<td>Background Color</td>
				</tr>
				<tr>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnimSl_L_Show" name="Rich_Web_AnimSl_L_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnimSl_LT_Show" name="Rich_Web_AnimSl_LT_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td>
						<label class="switch switch-light">
							<input class="switch-input" type="checkbox" id="Rich_Web_AnimSl_Loading_Show" name="Rich_Web_AnimSl_Loading_Show" />
							<span class="switch-label" data-on="On" data-off="Off"></span> 
							<span class="switch-handle"></span> 
						</label>
					</td>
					<td><input type="text" name="Rich_Web_AnimSl_L_BgC" id="Rich_Web_AnimSl_L_BgC" class="alpha-color-picker" value=""></td>
				</tr>
				<tr>
					<td>Text Color</td>
					<td>Loader Color</td>
					<td>Loader Size</td>
					<td>Loading Text</td>
				</tr>
				<tr>
					<td><input type="text" name="Rich_Web_AnimSl_LT_C" id="Rich_Web_AnimSl_LT_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AnimSl_L_C" id="Rich_Web_AnimSl_L_C" class="alpha-color-picker" value=""></td>
					<td>
						<select id="Rich_Web_AnimSl_L_S" name="Rich_Web_AnimSl_L_S" class="rich_web_Select_Menu">
							<option value="small">    Small    </option>
							<option value="middle">   Middle   </option>
							<option value="large">    Large    </option>
						</select>
					</td>
					<td><input type="text" name="Rich_Web_AnimSl_LT" id="Rich_Web_AnimSl_LT" value=""></td>
				</tr>
				<tr>
					<td>Loader Type</td>
					<td>Loader Text Type</td>
					<td>Font Size (px)</td>
					<td>Font Family</td>
				</tr>
				<tr>
					<td>
						<select id="Rich_Web_AnimSl_L_T" name="Rich_Web_AnimSl_L_T" class="rich_web_Select_Menu" onChange="change_rw_tr('AnimSl')">
							<option value="Type 1"> Type 1 </option>
							<option value="Type 2"> Type 2 </option>
							<option value="Type 3"> Type 3 </option>
							<option value="Type 4"> Type 4 </option>
						</select>
					</td>
					<td>
						<select id="Rich_Web_AnimSl_LT_T" name="Rich_Web_AnimSl_LT_T" class="rich_web_Select_Menu" onChange="change_rw_ltt('AnimSl')">
							<option value="Type 1"> Type 1  </option>
							<option value="Type 2"> Type 2  </option>
							<option value="Type 3"> Type 3  </option>
							<option value="Type 4"> Default </option>
						</select>
					</td>
					<td>
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="" id="Rich_Web_AnimSl_LT_FS" name="Rich_Web_AnimSl_LT_FS" min="8" max="25">
							<span class="range-slider__value" id="Rich_Web_AnimSl_LT_FS_Span">0</span>
						</div>
					</td>
					<td>
						<select class="rich_web_Select_Menu" id="Rich_Web_AnimSl_LT_FF" name="Rich_Web_AnimSl_LT_FF">
							<?php for($i=0;$i<count($Rich_WebFontCount);$i++){ ?> 
								<option value="<?php echo $Rich_WebFontCount[$i]->Font_family;?>"><?php echo $Rich_WebFontCount[$i]->Font_family;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr class="Loder_1_Option">
					<td>Loader 1 Color</td>
					<td>Loader 2 Color</td>
					<td>Loader 3 Color</td>
					<td></td>
				</tr>
				<tr class="Loder_1_Option">
					<td><input type="text" name="Rich_Web_AnimSl_L_T1_C" id="Rich_Web_AnimSl_L_T1_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AnimSl_L_T2_C" id="Rich_Web_AnimSl_L_T2_C" class="alpha-color-picker" value=""></td>
					<td><input type="text" name="Rich_Web_AnimSl_L_T3_C" id="Rich_Web_AnimSl_L_T3_C" class="alpha-color-picker" value=""></td>
					<td></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td>Loading Text Animation Borders Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color1">
					<td><input type="text" name="Rich_Web_AnimSl_LT_T2_BC" id="Rich_Web_AnimSl_LT_T2_BC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td>Loading Text Animation Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color2">
					<td><input type="text" name="Rich_Web_AnimSl_LT_T2_AnC" id="Rich_Web_AnimSl_LT_T2_AnC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td>Loading Text Background Color</td>
					<td colspan="3"></td>
				</tr>
				<tr class="rw_text_color rw_text_color3">
					<td><input type="text" name="Rich_Web_AnimSl_LT_T3_BgC" id="Rich_Web_AnimSl_LT_T3_BgC" class="alpha-color-picker" value=""></td>
					<td colspan="3"></td>
				</tr>
			</table>
		</div>
	</div>
</form>