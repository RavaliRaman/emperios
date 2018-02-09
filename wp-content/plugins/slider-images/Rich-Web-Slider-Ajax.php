<?php	
	// Admin Menu
	add_action( 'wp_ajax_rich_web_Edit', 'rich_web_Edit_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Edit', 'rich_web_Edit_Callback' );

	function rich_web_Edit_Callback()
	{
		$number = sanitize_text_field($_POST['foobar']);
		global $wpdb;

		$table_name = $wpdb->prefix . "rich_web_photo_slider_manager";
		
		$Rich_Web_Manager=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id=%s", $number));

		print_r($Rich_Web_Manager);
		die();
	}
	
	add_action( 'wp_ajax_rich_web_Edit_ImDescTit', 'rich_web_Edit_ImDescTit_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Edit_ImDescTit', 'rich_web_Edit_ImDescTit_Callback' );

	function rich_web_Edit_ImDescTit_Callback()
	{
		$number = sanitize_text_field($_POST['foobar']);
		global $wpdb;

		$table_name1 = $wpdb->prefix . "rich_web_photo_slider_instal";

		$Rich_Web_Instal=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE Sl_Number=%d order by id", $number));
		print_r($Rich_Web_Instal);
		die();
	}
	
	add_action( 'wp_ajax_rich_web_Del', 'rich_web_Del_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Del', 'rich_web_Del_Callback' );

	function rich_web_Del_Callback()
	{
		$number = sanitize_text_field($_POST['foobar']);
		global $wpdb;
		$table_name  = $wpdb->prefix . "rich_web_photo_slider_manager";
		$table_name1 = $wpdb->prefix . "rich_web_photo_slider_instal";

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id=%d", $number));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name1 WHERE Sl_Number=%d", $number));
		die();
	}

	add_action( 'wp_ajax_rich_web_Copy_Sl', 'rich_web_Copy_Sl_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Copy_Sl', 'rich_web_Copy_Sl_Callback' );

	function rich_web_Copy_Sl_Callback()
	{
		$number = sanitize_text_field($_POST['foobar']);
		global $wpdb;
		$table_name  = $wpdb->prefix . "rich_web_photo_slider_manager";
		$table_name1 = $wpdb->prefix . "rich_web_photo_slider_instal";
		$table_name4 = $wpdb->prefix . "rich_web_slider_id";

		$Rich_Web_Manager=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id=%s", $number));
		$Rich_Web_Instal=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE Sl_Number=%d order by id", $number));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name (id, Slider_Title, Slider_Type, Slider_IMGS_Quantity) VALUES (%d, %s, %s, %d)", '', $Rich_Web_Manager[0]->Slider_Title, $Rich_Web_Manager[0]->Slider_Type, $Rich_Web_Manager[0]->Slider_IMGS_Quantity));
				
		$Slider_ID = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id > %d order by id desc limit 1",0));
		$Rich_Web_Sl_Id = $Slider_ID[0]->Slider_ID + 1;
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, Slider_ID) VALUES (%d, %d)", '', $Rich_Web_Sl_Id));
		
		for($i = 0; $i < count($Rich_Web_Instal); $i++)
		{
			$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, SL_Img_Title, Sl_Img_Description, Sl_Img_Url, Sl_Link_Url, Sl_Link_NewTab, Sl_Number) VALUES (%d, %s, %s, %s, %s, %s, %d)", '', $Rich_Web_Instal[$i]->SL_Img_Title, $Rich_Web_Instal[$i]->Sl_Img_Description, $Rich_Web_Instal[$i]->Sl_Img_Url, $Rich_Web_Instal[$i]->Sl_Link_Url, $Rich_Web_Instal[$i]->Sl_Link_NewTab, $Rich_Web_Sl_Id));
		}

		die();
	}
	// Theme Menu
	add_action( 'wp_ajax_rich_web_Edit_Option', 'rich_web_Edit_Option_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Edit_Option', 'rich_web_Edit_Option_Callback' );

	function rich_web_Edit_Option_Callback()
	{
		$Rich_Web_Slider_ID = sanitize_text_field($_POST['foobar']);

		global $wpdb;
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
		$array=array();
		$Rich_Web_Effects=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id=%d", $Rich_Web_Slider_ID));

		if($Rich_Web_Effects[0]->slider_type=='Slider Navigation')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Content Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE richideo_EN_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Fashion Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Circle Thumbnails')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Slider Carousel')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Flexible Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Dynamic Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Thumbnails Slider & Lightbox')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Accordion Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}
		else if($Rich_Web_Effects[0]->slider_type=='Animation Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));
			$array[]=$Rich_Web_Effect;
			$array[]=$Rich_Web_Effect_Loading;
		}

		print json_encode($array);
		die();
	}

	add_action( 'wp_ajax_rich_web_Copy_Sl2', 'rich_web_Copy_Sl2_Callback' );
	add_action( 'wp_ajax_nopriv_rich_web_Copy_Sl2', 'rich_web_Copy_Sl2_Callback' );

	function rich_web_Copy_Sl2_Callback()
	{
		$Rich_Web_Slider_ID = sanitize_text_field($_POST['foobar']);

		global $wpdb;
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

		$Rich_Web_Effects=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id=%d", $Rich_Web_Slider_ID));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', $Rich_Web_Effects[0]->slider_name, $Rich_Web_Effects[0]->slider_type));

		$Rich_Web_Slider_New_ID=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id > %d order by id desc limit 1", 0));

		if($Rich_Web_Effects[0]->slider_type=='Slider Navigation')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name5 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, rich_web_Sl1_SlS, rich_web_Sl1_SlSS, rich_web_Sl1_PoH, rich_web_Sl1_W, rich_web_Sl1_H, rich_web_Sl1_BoxS, rich_web_Sl1_BoxSC, rich_web_Sl1_IBW, rich_web_Sl1_IBS, rich_web_Sl1_IBC, rich_web_Sl1_IBR, rich_web_Sl1_TBgC, rich_web_Sl1_TC, rich_web_Sl1_TTA, rich_web_Sl1_TFS, rich_web_Sl1_TFF, rich_web_Sl1_TUp, rich_web_Sl1_ArBgC, rich_web_Sl1_ArOp, rich_web_Sl1_ArType, rich_web_Sl1_ArHBgC, rich_web_Sl1_ArHOp, rich_web_Sl1_ArHEff, rich_web_Sl1_ArBoxW, rich_web_Sl1_NavW, rich_web_Sl1_NavH, rich_web_Sl1_NavPB, rich_web_Sl1_NavBW, rich_web_Sl1_NavBS, rich_web_Sl1_NavBC, rich_web_Sl1_NavBR, rich_web_Sl1_NavCC, rich_web_Sl1_NavHC, rich_web_Sl1_ArPFT, rich_web_Sl1_NavPos) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->rich_web_Sl1_SlS, $Rich_Web_Effect[0]->rich_web_Sl1_SlSS, $Rich_Web_Effect[0]->rich_web_Sl1_PoH, $Rich_Web_Effect[0]->rich_web_Sl1_W, $Rich_Web_Effect[0]->rich_web_Sl1_H, $Rich_Web_Effect[0]->rich_web_Sl1_BoxS, $Rich_Web_Effect[0]->rich_web_Sl1_BoxSC, $Rich_Web_Effect[0]->rich_web_Sl1_IBW, $Rich_Web_Effect[0]->rich_web_Sl1_IBS, $Rich_Web_Effect[0]->rich_web_Sl1_IBC, $Rich_Web_Effect[0]->rich_web_Sl1_IBR, $Rich_Web_Effect[0]->rich_web_Sl1_TBgC, $Rich_Web_Effect[0]->rich_web_Sl1_TC, $Rich_Web_Effect[0]->rich_web_Sl1_TTA, $Rich_Web_Effect[0]->rich_web_Sl1_TFS, $Rich_Web_Effect[0]->rich_web_Sl1_TFF, $Rich_Web_Effect[0]->rich_web_Sl1_TUp, $Rich_Web_Effect[0]->rich_web_Sl1_ArBgC, $Rich_Web_Effect[0]->rich_web_Sl1_ArOp, $Rich_Web_Effect[0]->rich_web_Sl1_ArType, $Rich_Web_Effect[0]->rich_web_Sl1_ArHBgC, $Rich_Web_Effect[0]->rich_web_Sl1_ArHOp, $Rich_Web_Effect[0]->rich_web_Sl1_ArHEff, $Rich_Web_Effect[0]->rich_web_Sl1_ArBoxW, $Rich_Web_Effect[0]->rich_web_Sl1_NavW, $Rich_Web_Effect[0]->rich_web_Sl1_NavH, $Rich_Web_Effect[0]->rich_web_Sl1_NavPB, $Rich_Web_Effect[0]->rich_web_Sl1_NavBW, $Rich_Web_Effect[0]->rich_web_Sl1_NavBS, $Rich_Web_Effect[0]->rich_web_Sl1_NavBC, $Rich_Web_Effect[0]->rich_web_Sl1_NavBR, $Rich_Web_Effect[0]->rich_web_Sl1_NavCC, $Rich_Web_Effect[0]->rich_web_Sl1_NavHC, $Rich_Web_Effect[0]->rich_web_Sl1_ArPFT, $Rich_Web_Effect[0]->rich_web_Sl1_NavPos));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name5_Loader (id, rich_web_slider_ID, Rich_Web_NSL_L_Show, Rich_Web_NSL_LT_Show, Rich_Web_NSL_LT, Rich_Web_NSL_L_BgC, Rich_Web_NSL_L_T, Rich_Web_NSL_LT_T, Rich_Web_NSL_LT_FS, Rich_Web_NSL_LT_FF, Rich_Web_NSL_LT_C, Rich_Web_NSL_L_T1_C, Rich_Web_NSL_L_T2_C, Rich_Web_NSL_L_T3_C, Rich_Web_NSL_LT_T2_BC, Rich_Web_NSL_L_C, Rich_Web_NSL_LT_T2_AnC, Rich_Web_NSL_LT_T3_BgC, Rich_Web_NSL_L_S, Rich_Web_NSL_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_NSL_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Content Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE richideo_EN_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name6 (id, richideo_EN_ID, rich_web_slider_name, rich_web_slider_type, rich_CS_BIB, rich_CS_P, rich_CS_Loop, rich_CS_SD, rich_CS_AT, rich_CS_Cont_BgC, rich_CS_Cont_BSC, rich_CS_Cont_W, rich_CS_Cont_H, rich_CS_Cont_Op, rich_CS_Cont_BW, rich_CS_Cont_BS, rich_CS_Cont_BC, rich_CS_Cont_BR, rich_CS_Video_TShow, rich_CS_Video_TC, rich_CS_Video_TSC, rich_CS_Video_TFS, rich_CS_Video_TFF, rich_CS_Video_TTA, rich_CS_Video_DShow, rich_CS_Video_DC, rich_CS_Video_DSC, rich_CS_Video_DFS, rich_CS_Video_DFF, rich_CS_Video_DTA, rich_CS_Video_Show, rich_CS_Video_W, rich_CS_Video_H, rich_CS_LFS, rich_CS_LFF, rich_CS_LC, rich_CS_LT, rich_CS_LBgC, rich_CS_LBC, rich_CS_LBR, rich_CS_LPos, rich_CS_LHBgC, rich_CS_LHC, rich_CS_Video_ArrShow, rich_CS_AFS, rich_CS_AC, rich_CS_Icon, rich_CS_Link_BW, rich_CS_Link_BS) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->rich_CS_BIB, $Rich_Web_Effect[0]->rich_CS_P, $Rich_Web_Effect[0]->rich_CS_Loop, $Rich_Web_Effect[0]->rich_CS_SD, $Rich_Web_Effect[0]->rich_CS_AT, $Rich_Web_Effect[0]->rich_CS_Cont_BgC, $Rich_Web_Effect[0]->rich_CS_Cont_BSC, $Rich_Web_Effect[0]->rich_CS_Cont_W, $Rich_Web_Effect[0]->rich_CS_Cont_H, $Rich_Web_Effect[0]->rich_CS_Cont_Op, $Rich_Web_Effect[0]->rich_CS_Cont_BW, $Rich_Web_Effect[0]->rich_CS_Cont_BS, $Rich_Web_Effect[0]->rich_CS_Cont_BC, $Rich_Web_Effect[0]->rich_CS_Cont_BR, $Rich_Web_Effect[0]->rich_CS_Video_TShow, $Rich_Web_Effect[0]->rich_CS_Video_TC, $Rich_Web_Effect[0]->rich_CS_Video_TSC, $Rich_Web_Effect[0]->rich_CS_Video_TFS, $Rich_Web_Effect[0]->rich_CS_Video_TFF, $Rich_Web_Effect[0]->rich_CS_Video_TTA, $Rich_Web_Effect[0]->rich_CS_Video_DShow, $Rich_Web_Effect[0]->rich_CS_Video_DC, $Rich_Web_Effect[0]->rich_CS_Video_DSC, $Rich_Web_Effect[0]->rich_CS_Video_DFS, $Rich_Web_Effect[0]->rich_CS_Video_DFF, $Rich_Web_Effect[0]->rich_CS_Video_DTA, $Rich_Web_Effect[0]->rich_CS_Video_Show, $Rich_Web_Effect[0]->rich_CS_Video_W, $Rich_Web_Effect[0]->rich_CS_Video_H, $Rich_Web_Effect[0]->rich_CS_LFS, $Rich_Web_Effect[0]->rich_CS_LFF, $Rich_Web_Effect[0]->rich_CS_LC, $Rich_Web_Effect[0]->rich_CS_LT, $Rich_Web_Effect[0]->rich_CS_LBgC, $Rich_Web_Effect[0]->rich_CS_LBC, $Rich_Web_Effect[0]->rich_CS_LBR, $Rich_Web_Effect[0]->rich_CS_LPos, $Rich_Web_Effect[0]->rich_CS_LHBgC, $Rich_Web_Effect[0]->rich_CS_LHC, $Rich_Web_Effect[0]->rich_CS_Video_ArrShow, $Rich_Web_Effect[0]->rich_CS_AFS, $Rich_Web_Effect[0]->rich_CS_AC, $Rich_Web_Effect[0]->rich_CS_Icon, $Rich_Web_Effect[0]->rich_CS_Link_BW, $Rich_Web_Effect[0]->rich_CS_Link_BS));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name6_Loader (id, rich_web_slider_ID, Rich_Web_ContSl_L_Show, Rich_Web_ContSl_LT_Show, Rich_Web_ContSl_LT, Rich_Web_ContSl_L_BgC, Rich_Web_ContSl_L_T, Rich_Web_ContSl_LT_T, Rich_Web_ContSl_LT_FS, Rich_Web_ContSl_LT_FF, Rich_Web_ContSl_LT_C, Rich_Web_ContSl_L_T1_C, Rich_Web_ContSl_L_T2_C, Rich_Web_ContSl_L_T3_C, Rich_Web_ContSl_LT_T2_BC, Rich_Web_ContSl_L_C, Rich_Web_ContSl_LT_T2_AnC, Rich_Web_ContSl_LT_T3_BgC, Rich_Web_ContSl_L_S, Rich_Web_ContSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_ContSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Fashion Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name7 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, rich_fsl_animation, rich_fsl_SShow, rich_fsl_SShow_Speed, rich_fsl_Anim_Dur, rich_fsl_Ic_Show, rich_fsl_PPL_Show, rich_fsl_Randomize, rich_fsl_Loop, rich_fsl_Width, rich_fsl_Height, rich_fsl_Border_Width, rich_fsl_Border_Style, rich_fsl_Border_Color, rich_fsl_Box_Shadow, rich_fsl_Shadow_Color, rich_fsl_Desc_Show, rich_fsl_Desc_Size, rich_fsl_Desc_Color, rich_fsl_Desc_Font_Family, rich_fsl_Desc_Text_Align, rich_fsl_Desc_Bg_Color, rich_fsl_Desc_Transparency, rich_fsl_Title_Font_Size, rich_fsl_Title_Color, rich_fsl_Title_Text_Shadow, rich_fsl_Title_Font_Family, rich_fsl_Title_Text_Align, rich_fsl_Link_Text, rich_fsl_Link_Border_Width, rich_fsl_Link_Border_Style, rich_fsl_Link_Border_Color, rich_fsl_Link_Font_Size, rich_fsl_Link_Color, rich_fsl_Link_Font_Family, rich_fsl_Link_Bg_Color, rich_fsl_Link_Transparency, rich_fsl_Link_Hover_Border_Color, rich_fsl_Link_Hover_Bg_Color, rich_fsl_Link_Hover_Color, rich_fsl_Link_Hover_Transparency, rich_fsl_Icon_Size, rich_fsl_Icon_Type, rich_fsl_Hover_Icon_Type) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->rich_fsl_animation, $Rich_Web_Effect[0]->rich_fsl_SShow, $Rich_Web_Effect[0]->rich_fsl_SShow_Speed, $Rich_Web_Effect[0]->rich_fsl_Anim_Dur, $Rich_Web_Effect[0]->rich_fsl_Ic_Show, $Rich_Web_Effect[0]->rich_fsl_PPL_Show, $Rich_Web_Effect[0]->rich_fsl_Randomize, $Rich_Web_Effect[0]->rich_fsl_Loop, $Rich_Web_Effect[0]->rich_fsl_Width, $Rich_Web_Effect[0]->rich_fsl_Height, $Rich_Web_Effect[0]->rich_fsl_Border_Width, $Rich_Web_Effect[0]->rich_fsl_Border_Style, $Rich_Web_Effect[0]->rich_fsl_Border_Color, $Rich_Web_Effect[0]->rich_fsl_Box_Shadow, $Rich_Web_Effect[0]->rich_fsl_Shadow_Color, $Rich_Web_Effect[0]->rich_fsl_Desc_Show, $Rich_Web_Effect[0]->rich_fsl_Desc_Size, $Rich_Web_Effect[0]->rich_fsl_Desc_Color, $Rich_Web_Effect[0]->rich_fsl_Desc_Font_Family, $Rich_Web_Effect[0]->rich_fsl_Desc_Text_Align, $Rich_Web_Effect[0]->rich_fsl_Desc_Bg_Color, $Rich_Web_Effect[0]->rich_fsl_Desc_Transparency, $Rich_Web_Effect[0]->rich_fsl_Title_Font_Size, $Rich_Web_Effect[0]->rich_fsl_Title_Color, $Rich_Web_Effect[0]->rich_fsl_Title_Text_Shadow, $Rich_Web_Effect[0]->rich_fsl_Title_Font_Family, $Rich_Web_Effect[0]->rich_fsl_Title_Text_Align, $Rich_Web_Effect[0]->rich_fsl_Link_Text, $Rich_Web_Effect[0]->rich_fsl_Link_Border_Width, $Rich_Web_Effect[0]->rich_fsl_Link_Border_Style, $Rich_Web_Effect[0]->rich_fsl_Link_Border_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Font_Size, $Rich_Web_Effect[0]->rich_fsl_Link_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Font_Family, $Rich_Web_Effect[0]->rich_fsl_Link_Bg_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Transparency, $Rich_Web_Effect[0]->rich_fsl_Link_Hover_Border_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Hover_Bg_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Hover_Color, $Rich_Web_Effect[0]->rich_fsl_Link_Hover_Transparency, $Rich_Web_Effect[0]->rich_fsl_Icon_Size, $Rich_Web_Effect[0]->rich_fsl_Icon_Type, $Rich_Web_Effect[0]->rich_fsl_Hover_Icon_Type));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name7_Loader (id, rich_web_slider_ID, Rich_Web_FSl_L_Show, Rich_Web_FSl_LT_Show, Rich_Web_FSl_LT, Rich_Web_FSl_L_BgC, Rich_Web_FSl_L_T, Rich_Web_FSl_LT_T, Rich_Web_FSl_LT_FS, Rich_Web_FSl_LT_FF, Rich_Web_FSl_LT_C, Rich_Web_FSl_L_T1_C, Rich_Web_FSl_L_T2_C, Rich_Web_FSl_L_T3_C, Rich_Web_FSl_LT_T2_BC, Rich_Web_FSl_L_C, Rich_Web_FSl_LT_T2_AnC, Rich_Web_FSl_LT_T3_BgC, Rich_Web_FSl_L_S, Rich_Web_FSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_FSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Circle Thumbnails')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name8 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_CT_W, Rich_Web_Sl_CT_H, Rich_Web_Sl_CT_BW, Rich_Web_Sl_CT_BS, Rich_Web_Sl_CT_BC, Rich_Web_Sl_CT_BxSShow, Rich_Web_Sl_CT_BxSType, Rich_Web_Sl_CT_BxS, Rich_Web_Sl_CT_BxC, Rich_Web_Sl_CT_TDABgC, Rich_Web_Sl_CT_TDAPos, Rich_Web_Sl_CT_LBgC, Rich_Web_Sl_CT_TFS, Rich_Web_Sl_CT_TFF, Rich_Web_Sl_CT_TCC, Rich_Web_Sl_CT_TC, Rich_Web_Sl_CT_ArBgC, Rich_Web_Sl_CT_ArBR, Rich_Web_Sl_CT_ArType, Rich_Web_Sl_CT_ArHBC, Rich_Web_Sl_CT_ArHBR, Rich_Web_Sl_CT_ArText, Rich_Web_Sl_CT_ArLeft, Rich_Web_Sl_CT_ArRight, Rich_Web_Sl_CT_ArTextC, Rich_Web_Sl_CT_ArTextFS, Rich_Web_Sl_CT_ArTextFF) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_W, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_H, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BxSShow, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BxSType, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BxS, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_BxC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TDABgC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TDAPos, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_LBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TFS, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TFF, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TCC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_TC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArBR, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArType, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArHBC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArHBR, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArText, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArLeft, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArRight, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArTextC, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArTextFS, $Rich_Web_Effect[0]->Rich_Web_Sl_CT_ArTextFF));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name8_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name8_Loader (id, rich_web_slider_ID, Rich_Web_CircleSl_L_Show, Rich_Web_CircleSl_LT_Show, Rich_Web_CircleSl_LT, Rich_Web_CircleSl_L_BgC, Rich_Web_CircleSl_L_T, Rich_Web_CircleSl_LT_T, Rich_Web_CircleSl_LT_FS, Rich_Web_CircleSl_LT_FF, Rich_Web_CircleSl_LT_C, Rich_Web_CircleSl_L_T1_C, Rich_Web_CircleSl_L_T2_C, Rich_Web_CircleSl_L_T3_C, Rich_Web_CircleSl_LT_T2_BC, Rich_Web_CircleSl_L_C, Rich_Web_CircleSl_LT_T2_AnC, Rich_Web_CircleSl_LT_T3_BgC, Rich_Web_CircleSl_L_S, Rich_Web_CircleSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_CircleSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Slider Carousel')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name9 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_SC_BW, Rich_Web_Sl_SC_BS, Rich_Web_Sl_SC_BC, Rich_Web_Sl_SC_BoxShShow, Rich_Web_Sl_SC_BoxShType, Rich_Web_Sl_SC_BoxSh, Rich_Web_Sl_SC_BoxShC, Rich_Web_Sl_SC_IW, Rich_Web_Sl_SC_IH, Rich_Web_Sl_SC_IBW, Rich_Web_Sl_SC_IBS, Rich_Web_Sl_SC_IBC, Rich_Web_Sl_SC_IBR, Rich_Web_Sl_SC_ICBW, Rich_Web_Sl_SC_ICBS, Rich_Web_Sl_SC_ICBC, Rich_Web_Sl_SC_TBgC, Rich_Web_Sl_SC_TC, Rich_Web_Sl_SC_TFS, Rich_Web_Sl_SC_TFF, Rich_Web_Sl_SC_THBgC, Rich_Web_Sl_SC_THC, Rich_Web_Sl_SC_Pop_OC, Rich_Web_Sl_SC_Pop_BW, Rich_Web_Sl_SC_Pop_BC, Rich_Web_Sl_SC_Pop_BoxShShow, Rich_Web_Sl_SC_Pop_BoxShType, Rich_Web_Sl_SC_Pop_BoxSh, Rich_Web_Sl_SC_Pop_BoxShC, Rich_Web_Sl_SC_L_BgC, Rich_Web_Sl_SC_L_C, Rich_Web_Sl_SC_L_FS, Rich_Web_Sl_SC_L_BW, Rich_Web_Sl_SC_L_BS, Rich_Web_Sl_SC_L_BC, Rich_Web_Sl_SC_L_BR, Rich_Web_Sl_SC_L_HBgC, Rich_Web_Sl_SC_L_HC, Rich_Web_Sl_SC_L_Type, Rich_Web_Sl_SC_L_Text, Rich_Web_Sl_SC_L_IType, Rich_Web_Sl_SC_L_FF, Rich_Web_Sl_SC_PI_BgC, Rich_Web_Sl_SC_PI_C, Rich_Web_Sl_SC_PI_FS, Rich_Web_Sl_SC_PI_BW, Rich_Web_Sl_SC_PI_BS, Rich_Web_Sl_SC_PI_BC, Rich_Web_Sl_SC_PI_BR, Rich_Web_Sl_SC_PI_HBgC, Rich_Web_Sl_SC_PI_HC, Rich_Web_Sl_SC_PI_Type, Rich_Web_Sl_SC_PI_Text, Rich_Web_Sl_SC_PI_IType, Rich_Web_Sl_SC_PI_FF, Rich_Web_Sl_SC_Arr_BgC, Rich_Web_Sl_SC_Arr_C, Rich_Web_Sl_SC_Arr_FS, Rich_Web_Sl_SC_Arr_BW, Rich_Web_Sl_SC_Arr_BS, Rich_Web_Sl_SC_Arr_BC, Rich_Web_Sl_SC_Arr_BR, Rich_Web_Sl_SC_Arr_HBgC, Rich_Web_Sl_SC_Arr_HC, Rich_Web_Sl_SC_Arr_Type, Rich_Web_Sl_SC_Arr_FF, Rich_Web_Sl_SC_Arr_IType, Rich_Web_Sl_SC_Arr_Next, Rich_Web_Sl_SC_Arr_Prev, Rich_Web_Sl_SC_PCI_FS, Rich_Web_Sl_SC_PCI_C, Rich_Web_Sl_SC_PCI_Type) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BoxShShow, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BoxShType, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BoxSh, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_BoxShC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IH, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IBW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IBS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IBC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_IBR, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_ICBW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_ICBS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_ICBC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_TBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_TC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_TFS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_TFF, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_THBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_THC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_OC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShShow, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShType, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BoxSh, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Pop_BoxShC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_C, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_FS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_HBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_Type, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_Text, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_IType, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_L_FF, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_C, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_FS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_HBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_Type, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_Text, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_IType, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PI_FF, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_C, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_FS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_HBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_Type, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_FF, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_IType, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_Next, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_Arr_Prev, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PCI_FS, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PCI_C, $Rich_Web_Effect[0]->Rich_Web_Sl_SC_PCI_Type));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name9_Loader (id, rich_web_slider_ID, Rich_Web_CarSl_L_Show, Rich_Web_CarSl_LT_Show, Rich_Web_CarSl_LT, Rich_Web_CarSl_L_BgC, Rich_Web_CarSl_L_T, Rich_Web_CarSl_LT_T, Rich_Web_CarSl_LT_FS, Rich_Web_CarSl_LT_FF, Rich_Web_CarSl_LT_C, Rich_Web_CarSl_L_T1_C, Rich_Web_CarSl_L_T2_C, Rich_Web_CarSl_L_T3_C, Rich_Web_CarSl_LT_T2_BC, Rich_Web_CarSl_L_C, Rich_Web_CarSl_LT_T2_AnC, Rich_Web_CarSl_LT_T3_BgC, Rich_Web_CarSl_HT, Rich_Web_CarSl_H_OvC, Rich_Web_CarSl_L_S, Rich_Web_CarSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_HT,  $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_H_OvC,  $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_CarSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Flexible Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name10 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_FS_BgC, Rich_Web_Sl_FS_AP, Rich_Web_Sl_FS_TS, Rich_Web_Sl_FS_PT, Rich_Web_Sl_FS_SS, Rich_Web_Sl_FS_SVis, Rich_Web_Sl_FS_CS, Rich_Web_Sl_FS_SLoop, Rich_Web_Sl_FS_SSc, Rich_Web_Sl_FS_SlPos, Rich_Web_Sl_FS_ShNavBut, Rich_Web_Sl_FS_I_W, Rich_Web_Sl_FS_I_H, Rich_Web_Sl_FS_I_BW, Rich_Web_Sl_FS_I_BS, Rich_Web_Sl_FS_I_BC, Rich_Web_Sl_FS_I_BR, Rich_Web_Sl_FS_I_BoxShShow, Rich_Web_Sl_FS_I_BoxShType, Rich_Web_Sl_FS_I_BoxSh, Rich_Web_Sl_FS_I_BoxShC, Rich_Web_Sl_FS_T_C, Rich_Web_Sl_FS_T_FF, Rich_Web_Sl_FS_Nav_Show, Rich_Web_Sl_FS_Nav_W, Rich_Web_Sl_FS_Nav_H, Rich_Web_Sl_FS_Nav_BW, Rich_Web_Sl_FS_Nav_BS, Rich_Web_Sl_FS_Nav_BC, Rich_Web_Sl_FS_Nav_BR, Rich_Web_Sl_FS_Nav_PB, Rich_Web_Sl_FS_Nav_CC, Rich_Web_Sl_FS_Nav_HC, Rich_Web_Sl_FS_Nav_C, Rich_Web_Sl_FS_Arr_Show, Rich_Web_Sl_FS_Arr_Type, Rich_Web_Sl_FS_Arr_S, Rich_Web_Sl_FS_Arr_C) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_AP, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_TS, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_PT, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_SS, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_SVis, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_CS, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_SLoop, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_SSc, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_SlPos, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_ShNavBut, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_W, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_H, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BoxShShow, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BoxShType, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BoxSh, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_I_BoxShC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_T_C, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_T_FF, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_W, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_H, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_PB, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_CC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Nav_C, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Arr_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Arr_Type, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Arr_S, $Rich_Web_Effect[0]->Rich_Web_Sl_FS_Arr_C));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name10_Loader (id, rich_web_slider_ID, Rich_Web_FlexibleSl_L_Show, Rich_Web_FlexibleSl_LT_Show, Rich_Web_FlexibleSl_LT, Rich_Web_FlexibleSl_L_BgC, Rich_Web_FlexibleSl_L_T, Rich_Web_FlexibleSl_LT_T, Rich_Web_FlexibleSl_LT_FS, Rich_Web_FlexibleSl_LT_FF, Rich_Web_FlexibleSl_LT_C, Rich_Web_FlexibleSl_L_T1_C, Rich_Web_FlexibleSl_L_T2_C, Rich_Web_FlexibleSl_L_T3_C, Rich_Web_FlexibleSl_LT_T2_BC, Rich_Web_FlexibleSl_L_C, Rich_Web_FlexibleSl_LT_T2_AnC, Rich_Web_FlexibleSl_LT_T3_BgC, Rich_Web_FlexibleSl_L_S, Rich_Web_FlexibleSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_FlexibleSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Dynamic Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name11 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_DS_AP, Rich_Web_Sl_DS_PT, Rich_Web_Sl_DS_Tr, Rich_Web_Sl_DS_H, Rich_Web_Sl_DS_BW, Rich_Web_Sl_DS_BS, Rich_Web_Sl_DS_BC, Rich_Web_Sl_DS_TFS, Rich_Web_Sl_DS_TFF, Rich_Web_Sl_DS_TC, Rich_Web_Sl_DS_DFS, Rich_Web_Sl_DS_DFF, Rich_Web_Sl_DS_DC, Rich_Web_Sl_DS_LFS, Rich_Web_Sl_DS_LFF, Rich_Web_Sl_DS_LC, Rich_Web_Sl_DS_LBgC, Rich_Web_Sl_DS_LBW, Rich_Web_Sl_DS_LBS, Rich_Web_Sl_DS_LBC, Rich_Web_Sl_DS_LBR, Rich_Web_Sl_DS_LHC, Rich_Web_Sl_DS_LHBgC, Rich_Web_Sl_DS_LT, Rich_Web_Sl_DS_Arr_Show, Rich_Web_Sl_DS_Arr_LT, Rich_Web_Sl_DS_Arr_RT, Rich_Web_Sl_DS_Arr_C, Rich_Web_Sl_DS_Arr_BgC, Rich_Web_Sl_DS_Arr_BW, Rich_Web_Sl_DS_Arr_BS, Rich_Web_Sl_DS_Arr_BC, Rich_Web_Sl_DS_Arr_BR, Rich_Web_Sl_DS_Arr_HC, Rich_Web_Sl_DS_Arr_HBgC, Rich_Web_Sl_DS_Nav_W, Rich_Web_Sl_DS_Nav_H, Rich_Web_Sl_DS_Nav_PB, Rich_Web_Sl_DS_Nav_BW, Rich_Web_Sl_DS_Nav_BS, Rich_Web_Sl_DS_Nav_BC, Rich_Web_Sl_DS_Nav_BR, Rich_Web_Sl_DS_Nav_C, Rich_Web_Sl_DS_Nav_HC, Rich_Web_Sl_DS_Nav_CC) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_AP, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_PT, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Tr, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_H, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_TFS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_TFF, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_TC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_DFS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_DFF, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_DC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LFS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LFF, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LBW, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LBS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LBC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LBR, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LHC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LHBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_LT, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_LT, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_RT, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_C, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Arr_HBgC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_W, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_H, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_PB, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_C, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_HC, $Rich_Web_Effect[0]->Rich_Web_Sl_DS_Nav_CC));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name11_Loader (id, rich_web_slider_ID, Rich_Web_DynamicSl_L_Show, Rich_Web_DynamicSl_LT_Show, Rich_Web_DynamicSl_LT, Rich_Web_DynamicSl_L_BgC, Rich_Web_DynamicSl_L_T, Rich_Web_DynamicSl_LT_T, Rich_Web_DynamicSl_LT_FS, Rich_Web_DynamicSl_LT_FF, Rich_Web_DynamicSl_LT_C, Rich_Web_DynamicSl_L_T1_C, Rich_Web_DynamicSl_L_T2_C, Rich_Web_DynamicSl_L_T3_C, Rich_Web_DynamicSl_LT_T2_BC, Rich_Web_DynamicSl_L_C, Rich_Web_DynamicSl_LT_T2_AnC, Rich_Web_DynamicSl_LT_T3_BgC, Rich_Web_DynamicSl_ImgT, Rich_Web_DynamicSl_L_S, Rich_Web_DynamicSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_ImgT,  $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_DynamicSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Thumbnails Slider & Lightbox')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name12 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_TSL_W, Rich_Web_Sl_TSL_H, Rich_Web_Sl_TSL_BW, Rich_Web_Sl_TSL_BS, Rich_Web_Sl_TSL_BC, Rich_Web_Sl_TSL_BR, Rich_Web_Sl_TSL_BoxShShow, Rich_Web_Sl_TSL_BoxShType, Rich_Web_Sl_TSL_BoxSh, Rich_Web_Sl_TSL_BoxShC, Rich_Web_Sl_TSL_CM, Rich_Web_Sl_TSL_TA, Rich_Web_Sl_TSL_AP, Rich_Web_Sl_TSL_PH, Rich_Web_Sl_TSL_Loop, Rich_Web_Sl_TSL_PT, Rich_Web_Sl_TSL_CS, Rich_Web_Sl_TSL_Nav_Show, Rich_Web_Sl_TSL_Nav_W, Rich_Web_Sl_TSL_Nav_H, Rich_Web_Sl_TSL_Nav_PB, Rich_Web_Sl_TSL_Nav_BC, Rich_Web_Sl_TSL_Nav_BR, Rich_Web_Sl_TSL_Nav_CBC, Rich_Web_Sl_TSL_Nav_HBC, Rich_Web_Sl_TSL_Nav_Pos, Rich_Web_Sl_TSL_SS_Show, Rich_Web_Sl_TSL_SS_W, Rich_Web_Sl_TSL_SS_H, Rich_Web_Sl_TSL_SS_BC, Rich_Web_Sl_TSL_SS_BR, Rich_Web_Sl_TSL_SS_StC, Rich_Web_Sl_TSL_SS_SpC, Rich_Web_Sl_TSL_Arr_Show, Rich_Web_Sl_TSL_Arr_Type, Rich_Web_Sl_TSL_Arr_S, Rich_Web_Sl_TSL_Arr_C, Rich_Web_Sl_TSL_Pop_OvC, Rich_Web_Sl_TSL_Pop_BW, Rich_Web_Sl_TSL_Pop_BS, Rich_Web_Sl_TSL_Pop_BC, Rich_Web_Sl_TSL_Pop_BR, Rich_Web_Sl_TSL_Pop_BgC, Rich_Web_Sl_TSL_TFS, Rich_Web_Sl_TSL_TFF, Rich_Web_Sl_TSL_TC, Rich_Web_Sl_TSL_Pop_ArrType, Rich_Web_Sl_TSL_Pop_ArrS, Rich_Web_Sl_TSL_Pop_ArrC, Rich_Web_Sl_TSL_CIT, Rich_Web_Sl_TSL_CIS, Rich_Web_Sl_TSL_CIC) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_W, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_H, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BoxShShow, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BoxShType, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BoxSh, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_BoxShC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_CM, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_TA, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_AP, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_PH, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Loop, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_PT, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_CS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_W, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_H, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_PB, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_CBC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_HBC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Nav_Pos, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_W, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_H, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_StC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_SS_SpC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Arr_Show, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Arr_Type, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Arr_S, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Arr_C, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_OvC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_BW, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_BS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_BC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_BR, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_BgC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_TFS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_TFF, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_TC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrType, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_Pop_ArrC, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_CIT, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_CIS, $Rich_Web_Effect[0]->Rich_Web_Sl_TSL_CIC));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name12_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name12_Loader (id, rich_web_slider_ID, Rich_Web_ThSl_L_Show, Rich_Web_ThSl_LT_Show, Rich_Web_ThSl_LT, Rich_Web_ThSl_L_BgC, Rich_Web_ThSl_L_T, Rich_Web_ThSl_LT_T, Rich_Web_ThSl_LT_FS, Rich_Web_ThSl_LT_FF, Rich_Web_ThSl_LT_C, Rich_Web_ThSl_L_T1_C, Rich_Web_ThSl_L_T2_C, Rich_Web_ThSl_L_T3_C, Rich_Web_ThSl_LT_T2_BC, Rich_Web_ThSl_L_C, Rich_Web_ThSl_LT_T2_AnC, Rich_Web_ThSl_LT_T3_BgC, Rich_Web_ThSl_L_S, Rich_Web_ThSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_ThSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Accordion Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name13 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_AcSL_W, Rich_Web_AcSL_H, Rich_Web_AcSL_BW, Rich_Web_AcSL_BS, Rich_Web_AcSL_BC, Rich_Web_AcSL_BSh, Rich_Web_AcSL_BShC, Rich_Web_AcSL_Img_W, Rich_Web_AcSL_Img_BSh, Rich_Web_AcSL_Img_BShC, Rich_Web_AcSL_Title_FS, Rich_Web_AcSL_Title_FF, Rich_Web_AcSL_Title_C, Rich_Web_AcSL_Title_TSh, Rich_Web_AcSL_Title_TShC, Rich_Web_AcSL_Title_BgC, Rich_Web_AcSL_Link_FS, Rich_Web_AcSL_Link_FF, Rich_Web_AcSL_Link_C, Rich_Web_AcSL_Link_TSh, Rich_Web_AcSL_Link_TShC, Rich_Web_AcSL_Link_BgC, Rich_Web_AcSL_Link_Text) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_AcSL_W, $Rich_Web_Effect[0]->Rich_Web_AcSL_H, $Rich_Web_Effect[0]->Rich_Web_AcSL_BW, $Rich_Web_Effect[0]->Rich_Web_AcSL_BS, $Rich_Web_Effect[0]->Rich_Web_AcSL_BC, $Rich_Web_Effect[0]->Rich_Web_AcSL_BSh, $Rich_Web_Effect[0]->Rich_Web_AcSL_BShC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Img_W, $Rich_Web_Effect[0]->Rich_Web_AcSL_Img_BSh, $Rich_Web_Effect[0]->Rich_Web_AcSL_Img_BShC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_FS, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_FF, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_C, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_TSh, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_TShC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Title_BgC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_FS, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_FF, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_C, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_TSh, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_TShC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_BgC, $Rich_Web_Effect[0]->Rich_Web_AcSL_Link_Text));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name13_Loader (id, rich_web_slider_ID, Rich_Web_AccSl_L_Show, Rich_Web_AccSl_LT_Show, Rich_Web_AccSl_LT, Rich_Web_AccSl_L_BgC, Rich_Web_AccSl_L_T, Rich_Web_AccSl_LT_T, Rich_Web_AccSl_LT_FS, Rich_Web_AccSl_LT_FF, Rich_Web_AccSl_LT_C, Rich_Web_AccSl_L_T1_C, Rich_Web_AccSl_L_T2_C, Rich_Web_AccSl_L_T3_C, Rich_Web_AccSl_LT_T2_BC, Rich_Web_AccSl_L_C, Rich_Web_AccSl_LT_T2_AnC, Rich_Web_AccSl_LT_T3_BgC, Rich_Web_AccSl_L_S, Rich_Web_AccSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_AccSl_Loading_Show));
		}
		else if($Rich_Web_Effects[0]->slider_type=='Animation Slider')
		{
			$Rich_Web_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14 WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name14 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_AnSL_W, Rich_Web_AnSL_H, Rich_Web_AnSL_BW, Rich_Web_AnSL_BS, Rich_Web_AnSL_BC, Rich_Web_AnSL_BR, Rich_Web_AnSL_BSh, Rich_Web_AnSL_ShC, Rich_Web_AnSL_ET, Rich_Web_AnSL_SSh, Rich_Web_AnSL_SShChT, Rich_Web_AnSL_T_FS, Rich_Web_AnSL_T_FF, Rich_Web_AnSL_T_C, Rich_Web_AnSL_T_BgC, Rich_Web_AnSL_T_TA, Rich_Web_AnSL_T_Sh, Rich_Web_AnSL_T_ShC, Rich_Web_AnSL_N_Sh, Rich_Web_AnSL_N_S, Rich_Web_AnSL_N_BW, Rich_Web_AnSL_N_BC, Rich_Web_AnSL_N_BgC, Rich_Web_AnSL_N_BS, Rich_Web_AnSL_N_HBgC, Rich_Web_AnSL_N_CC, Rich_Web_AnSL_N_M, Rich_Web_AnSL_Ic_Sh, Rich_Web_AnSL_Ic_T, Rich_Web_AnSL_Ic_S, Rich_Web_AnSL_Ic_C, Rich_Web_AnSL_L_BgC, Rich_Web_AnSL_L_T, Rich_Web_AnSL_L_FS, Rich_Web_AnSL_L_FF, Rich_Web_AnSL_L_C, Rich_Web_AnSL_L1_T, Rich_Web_AnSL_L2_T, Rich_Web_AnSL_L3_T) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect[0]->rich_web_slider_name, $Rich_Web_Effect[0]->rich_web_slider_type, $Rich_Web_Effect[0]->Rich_Web_AnSL_W, $Rich_Web_Effect[0]->Rich_Web_AnSL_H, $Rich_Web_Effect[0]->Rich_Web_AnSL_BW, $Rich_Web_Effect[0]->Rich_Web_AnSL_BS, $Rich_Web_Effect[0]->Rich_Web_AnSL_BC, $Rich_Web_Effect[0]->Rich_Web_AnSL_BR, $Rich_Web_Effect[0]->Rich_Web_AnSL_BSh, $Rich_Web_Effect[0]->Rich_Web_AnSL_ShC, $Rich_Web_Effect[0]->Rich_Web_AnSL_ET, $Rich_Web_Effect[0]->Rich_Web_AnSL_SSh, $Rich_Web_Effect[0]->Rich_Web_AnSL_SShChT, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_FS, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_FF, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_C, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_BgC, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_TA, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_Sh, $Rich_Web_Effect[0]->Rich_Web_AnSL_T_ShC, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_Sh, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_S, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_BW, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_BC, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_BgC, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_BS, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_HBgC, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_CC, $Rich_Web_Effect[0]->Rich_Web_AnSL_N_M, $Rich_Web_Effect[0]->Rich_Web_AnSL_Ic_Sh, $Rich_Web_Effect[0]->Rich_Web_AnSL_Ic_T, $Rich_Web_Effect[0]->Rich_Web_AnSL_Ic_S, $Rich_Web_Effect[0]->Rich_Web_AnSL_Ic_C, $Rich_Web_Effect[0]->Rich_Web_AnSL_L_BgC, $Rich_Web_Effect[0]->Rich_Web_AnSL_L_T, $Rich_Web_Effect[0]->Rich_Web_AnSL_L_FS, $Rich_Web_Effect[0]->Rich_Web_AnSL_L_FF, $Rich_Web_Effect[0]->Rich_Web_AnSL_L_C, $Rich_Web_Effect[0]->Rich_Web_AnSL_L1_T, $Rich_Web_Effect[0]->Rich_Web_AnSL_L2_T, $Rich_Web_Effect[0]->Rich_Web_AnSL_L3_T));

			$Rich_Web_Effect_Loading=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name14_Loader WHERE rich_web_slider_ID=%s", $Rich_Web_Slider_ID));

			$wpdb->query($wpdb->prepare("INSERT INTO $table_name14_Loader (id, rich_web_slider_ID, Rich_Web_AnimSl_L_Show, Rich_Web_AnimSl_LT_Show, Rich_Web_AnimSl_LT, Rich_Web_AnimSl_L_BgC, Rich_Web_AnimSl_L_T, Rich_Web_AnimSl_LT_T, Rich_Web_AnimSl_LT_FS, Rich_Web_AnimSl_LT_FF, Rich_Web_AnimSl_LT_C, Rich_Web_AnimSl_L_T1_C, Rich_Web_AnimSl_L_T2_C, Rich_Web_AnimSl_L_T3_C, Rich_Web_AnimSl_LT_T2_BC, Rich_Web_AnimSl_L_C, Rich_Web_AnimSl_LT_T2_AnC, Rich_Web_AnimSl_LT_T3_BgC, Rich_Web_AnimSl_L_S, Rich_Web_AnimSl_Loading_Show) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_Web_Slider_New_ID[0]->id, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_Show, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_BgC, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_T, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_T, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_FS, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_FF, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_T1_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_T2_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_T3_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_T2_BC, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_C, $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_T2_AnC,  $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_LT_T3_BgC,  $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_L_S,  $Rich_Web_Effect_Loading[0]->Rich_Web_AnimSl_Loading_Show));
		}
		die();
	}
?>