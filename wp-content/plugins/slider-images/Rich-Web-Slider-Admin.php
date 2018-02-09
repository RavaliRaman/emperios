<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;
	$table_name  = $wpdb->prefix . "rich_web_photo_slider_manager";
	$table_name1 = $wpdb->prefix . "rich_web_photo_slider_instal";
	$table_name2 = $wpdb->prefix . "rich_web_slider_effects_data";
	$table_name4 = $wpdb->prefix . "rich_web_slider_id";
	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );
	add_filter( 'upload_size_limit', 'PBP_increase_upload' );
	function PBP_increase_upload(  )
	{
	 	return 100048576;
	}

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(check_admin_referer( 'edit-menu_'.$comment_id, 'Rich_Web_PSlider_Nonce' ))
		{	
			$Slider_Title = sanitize_text_field($_POST['Slider_Title']);
			$Slider_Type = sanitize_text_field($_POST['Slider_Type']);
			$SL_Img_Title = array();
			$Sl_Img_Description = array();
			$Sl_Img_Url = array();
			$Sl_Link_Url = array();
			$Sl_Link_NewTab =    array();
			
			$JumboHidNum=sanitize_text_field($_POST['JumboHidNum']);
			for($i=1;$i<=$JumboHidNum;$i++)
			{
				$SL_Img_Title[$i] = str_replace("\&","&", sanitize_text_field(esc_html($_POST['JADD_Tit_' . $i])));
				$Sl_Img_Description[$i] = str_replace("\&","&", sanitize_text_field(esc_html($_POST['JAdd_Description_' . $i])));
				$Sl_Img_Url[$i] = sanitize_text_field($_POST['JAdd_src_' . $i]);
				$Sl_Link_Url[$i] = sanitize_text_field($_POST['JADD_Link_' . $i]);
				$Sl_Link_NewTab[$i] = sanitize_text_field($_POST['JAdd_NewTab_' . $i]);
			}
			
			if(isset($_POST['rich_webSlSave']))
			{
				$wpdb->query($wpdb->prepare("INSERT INTO $table_name (id, Slider_Title, Slider_Type, Slider_IMGS_Quantity) VALUES (%d, %s, %s, %d)", '', $Slider_Title, $Slider_Type, $JumboHidNum));
				
				$Slider_ID = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d order by id desc limit 1",0));
				$Rich_Web_Sl_Id = $Slider_ID[0]->Slider_ID + 1;
				$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, Slider_ID) VALUES (%d, %d)", '', $Rich_Web_Sl_Id));
				
				for($i=1;$i<=$JumboHidNum;$i++)
				{
					$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, SL_Img_Title, Sl_Img_Description, Sl_Img_Url, Sl_Link_Url, Sl_Link_NewTab, Sl_Number) VALUES (%d, %s, %s, %s, %s, %s, %d)", '', $SL_Img_Title[$i], $Sl_Img_Description[$i], $Sl_Img_Url[$i], $Sl_Link_Url[$i], $Sl_Link_NewTab[$i], $Rich_Web_Sl_Id));
				}
			}
			else if(isset($_POST['rich_webSlUpdate']))
			{
				$upd_id = sanitize_text_field($_POST['upd_id']);

				$wpdb->query($wpdb->prepare("UPDATE $table_name set Slider_Title=%s, Slider_Type=%s, Slider_IMGS_Quantity=%d WHERE id=%d", $Slider_Title, $Slider_Type, $JumboHidNum, $upd_id));
				$wpdb->query($wpdb->prepare("DELETE FROM $table_name1 WHERE Sl_Number=%d", $upd_id));
				
				for($i=1;$i<=$JumboHidNum;$i++)
				{
					$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, SL_Img_Title, Sl_Img_Description, Sl_Img_Url, Sl_Link_Url, Sl_Link_NewTab, Sl_Number) VALUES (%d, %s, %s, %s, %s, %s, %d)", '', $SL_Img_Title[$i], $Sl_Img_Description[$i], $Sl_Img_Url[$i], $Sl_Link_Url[$i], $Sl_Link_NewTab[$i], $upd_id));
				}
			}
		}
		else
	    {
	        wp_die('Security check fail'); 
	    }	
	}
	
	$Rich_WebDat = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d", 0));
	$Rich_WebIm = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d order by id", 0));
	$Rich_WebEff = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id>%d", 0));
	$jaboId = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d order by id desc limit 1",0));	
?>
<form method="POST" enctype="multipart/form-data">
	<?php wp_nonce_field( 'edit-menu_'.$comment_id, 'Rich_Web_PSlider_Nonce' );?>
	<?php require_once( 'Rich-Web-Slider-Header.php' ); ?>	
	<div style="position: relative; width: 100%; right: 1%; height: 50px;">
		<input type='button' class='JAddSlider' value='New Slider' onclick='addSliderJ(<?php echo $jaboId[0]->Slider_ID+1;?>)' />
		<input type='submit' class='JSaveSlider' value='Save' name='rich_webSlSave' />
		<input type='submit' class='JUpdateSlider' value='Update' name='rich_webSlUpdate' />
		<input type='button' class='JCanselSlider' value='Cancel' onclick='canselSliderJ()' />
		<input type='text' style='display:none' id="upd_id" name='upd_id'>
	</div>
	<div class="Rich_Web_SliderIm_Fixed_Div"></div>
	<div class="Rich_Web_SliderIm_Absolute_Div">
		<div class="Rich_Web_SliderIm_Relative_Div">
			<p> Are you sure you want to remove ? </p>				 
			<span class="Rich_Web_SliderIm_Relative_No">No</span>
			<span class="Rich_Web_SliderIm_Relative_Yes">Yes</span>
		</div>			
	</div>
	<div class='Table_Data_rich_web_Content' >
		<div class='Table_Data_rich_web1'>
			<table class='rich_web_Tit_Table'>
				<tr class='rich_web_Tit_Table_Tr'>
					<td>No</td>
					<td>Slider Name</td>
					<td>Slider Option</td>
					<td>Images</td>
					<td>Actions</td>
				</tr>
			</table>
			<table class='rich_web_Tit_Table2'>
			<?php for($i=0;$i<count($Rich_WebDat);$i++){?> 
				<tr class='rich_web_Tit_Table_Tr2'>
					<td><?php echo $i+1; ?></td>
					<td><?php echo $Rich_WebDat[$i]->Slider_Title; ?></td>
					<td><?php echo $Rich_WebDat[$i]->Slider_Type; ?></td>
					<td><?php echo $Rich_WebDat[$i]->Slider_IMGS_Quantity; ?></td>
					<td onclick="rich_web_Copy_Sl(<?php echo $Rich_WebDat[$i]->id;?>)"><i class='jIcFileso rich_web rich_web-files-o'></i></td>
					<td onclick="rich_web_Edit_Sl(<?php echo $Rich_WebDat[$i]->id;?>)"><i class='jIcPencil rich_web rich_web-pencil'></i></td>
					<td onclick="rich_web_Delete_Sl(<?php echo $Rich_WebDat[$i]->id;?>)"><i class='jIcDel rich_web rich_web-trash'></i></td>
				</tr>
			<?php } ?>
			</table>
		</div>
		<div class='Table_Data_rich_web2'>
			<table class="rich_web_ShortTable" style="display: table; float: right;">
				<tr style="text-align:center">
					<td>Shortcode</td>
				</tr>
				<tr>
					<td>Copy &amp; paste the shortcode directly into any WordPress post or page.</td>
				</tr>
				<tr>
					<td class="rich_web_Slider_ID">[Rich_Web_Slider id="1"]</td>
				</tr>
				<tr>
					<td>Templete Include</td>
				</tr>
				<tr>
					<td>Copy &amp; paste this code into a template file to include the slideshow within your theme.</td>
				</tr>
				<tr>
					<td class="JMBSL">&lt;?php echo do_shortcode('[Rich_Web_Slider id="1"]');?&gt;</td>
				</tr>
			</table>
			<table class='rich_web_SaveSl_Table' style='float:left;'>
				<tr>
					<td style='width:100%' colspan='2'> Slider Name	</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='text' class='JSlInput JSliderName' name='Slider_Title' placeholder=" * Required" required/>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'> Slider Type </td>
				</tr>
				<tr>
					<td colspan='2'>
						<select class='JSlInput JSType' name='Slider_Type'>
							<?php for($i=0;$i<count($Rich_WebEff);$i++){ ?>
								<option value='<?php echo $Rich_WebEff[$i]->slider_name;?>'><?php echo $Rich_WebEff[$i]->slider_name;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td class='addImJ' colspan='3'>	Add Image </td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'> Image Title	</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='text' class='JSlInput JSlInput2 JSliderImageTitle' id='JSliderImageTitle'/>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'>
						<div id="wp-content-media-buttons" class="wp-media-buttons" >													
							<a href="#" class="button insert-media add_media" style="border:1px solid rgba(0, 73, 107, 0.8); color:rgba(0, 73, 107, 0.8); background-color:#f4f4f4" data-editor="rich_web_imgSrc_1" title="Add Image" id="rich_webImgSrc" onclick="rich_web_Img_Src_Clicked()">
								<span class="wp-media-buttons-icon"></span>Add Image
							</a>
						</div>
						<input type="text" style="display:none;" id="rich_web_imgSrc_1" class='JSlInput JSlInput2'>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type="text" id="rich_web_imgSrc_2" class="JSlInput JSlInput2 rich_web_ImgSrc_Select" readonly>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'> Image Description </td>
				</tr>
				<tr>
					<td colspan='2'>
						<textarea class='JSlInput JSlInput2 JSliderImageDesc' id='JSliderImageDesc' style='height:80px;'> </textarea>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'> Link </td>
				</tr>
				<tr>
					<td>
						<input type='text' class='JSlInput JSlInput2 JSliderImageLink' id='JSliderImageLink'/>
					</td>
					<td>
						New Tab <input type='checkbox' id='JNewTab' class='jChB'>
					</td>
				</tr>
				<tr>
					<td class='addImJ' colspan='3' style='padding:0px;'>
						<input type='button' class='JSVBut' onclick="rich_web_Save()" value='Save' />
						<input type='button' class='JUPBut' onclick="rich_web_Update()" value='Update' />
						<input type='button' class='JRBut' onclick="rich_web_Res()" value='Reset'/>
						<input type="text" style="display:none;" id="JumboHidNum" name="JumboHidNum" value="0">
						<input type="text" style="display:none;" id="JumboHidUpd" value="0">
					</td>
				</tr>
			</table>
			<table class='rich_web_SaveSl_Table2'>
				<tr>
					<td> No	</td>
					<td> Image </td>
					<td> Image Title </td>
					<td> Edit </td>
					<td> Delete </td>
				</tr>
			</table>
			<table class='rich_web_SaveSl_Table3' onmousemove='rich_webSortable()'></table>
		</div>
	</div>
</form>