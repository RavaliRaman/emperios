function addSliderJ(number)
{
	jQuery('.Table_Data_rich_web1').css('display','none');
	jQuery('.JAddSlider').addClass('JAddSliderAnim');
	jQuery('.Table_Data_rich_web2').css('display','block');
	jQuery('.JSaveSlider').addClass('JSaveSliderAnim');
	jQuery('.JCanselSlider').addClass('JCanselSliderAnim');
	jQuery('.rich_web_Slider_ID').html('[Rich_Web_Slider id="'+number+'"]');
	jQuery('.JMBSL').html('&lt;?php echo do_shortcode(&apos;[Rich_Web_Slider id="'+number+'"]&apos;);?&gt;');	
}
function canselSliderJ()
{
	location.reload();
}
function rich_web_Img_Src_Clicked()
{
	var zInt = setInterval(function(){
		var code = jQuery('#rich_web_imgSrc_1').val();			
		if(code.indexOf('img')>0)
		{
			var s=code.split('src="'); 
			var src=s[1].split('"');
			jQuery('#rich_web_imgSrc_2').val(src[0]);
			if(jQuery('#rich_web_imgSrc_2').val().length>0)
			{
				jQuery('#rich_web_imgSrc_1').val('');	
				clearInterval(zInt);
			}				
		}
	},100)
}
function rich_web_Res()
{
	jQuery('.JSlInput2').val('');
	jQuery('.jChB').attr('checked',false);
}
function rich_web_Save()
{
	var JumboHidNum = jQuery('#JumboHidNum').val();
	var JSliderImageTitle = jQuery('#JSliderImageTitle').val();
	var rich_web_imgSrc_2 = jQuery('#rich_web_imgSrc_2').val();
	var JSliderImageDesc = jQuery('#JSliderImageDesc').val();
	var JSliderImageLink = jQuery('#JSliderImageLink').val();
	var JNewTab = jQuery('#JNewTab').attr('checked');
	jQuery('.rich_web_SaveSl_Table3').append('<tr id="tr_'+parseInt(parseInt(JumboHidNum)+1)+'"><td name="number_name_'+parseInt(parseInt(JumboHidNum)+1)+'" id="number_name_'+parseInt(parseInt(JumboHidNum)+1)+'" >'+parseInt(parseInt(JumboHidNum)+1)+'</td><td id="JAdd_Img_'+parseInt(parseInt(JumboHidNum)+1)+'"><img src="'+rich_web_imgSrc_2+'" id="JAdd_Img_Src_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JAdd_Img_Src_'+parseInt(parseInt(JumboHidNum)+1)+'" style="height:60px;"></td><td id="JAdd_Title_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JAdd_Title_'+parseInt(parseInt(JumboHidNum)+1)+'">'+JSliderImageTitle+'</td><td id="tdEdit_'+parseInt(parseInt(JumboHidNum)+1)+'"><i class="jIcPencil rich_web  rich_web-pencil" onclick="jambEditId('+parseInt(parseInt(JumboHidNum)+1)+')"></i></td><td id="tdDelete_'+parseInt(parseInt(JumboHidNum)+1)+'"><i class="jIcDel rich_web  rich_web-trash" onclick="jambDelId('+parseInt(parseInt(JumboHidNum)+1)+')"></i><input type="text" style="display:none;" class="add_title" id="JADD_Tit_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JADD_Tit_'+parseInt(parseInt(JumboHidNum)+1)+'" value="'+JSliderImageTitle+'" /><input type="text" style="display:none;" class="add_description" id="JAdd_Description_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JAdd_Description_'+parseInt(parseInt(JumboHidNum)+1)+'" value="'+JSliderImageDesc+'"/><input type="text" style="display:none;" class="add_img" id="JAdd_src_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JAdd_src_'+parseInt(parseInt(JumboHidNum)+1)+'" value="'+rich_web_imgSrc_2+'" /><input type="text" style="display:none" class="add_link" id="JADD_Link_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JADD_Link_'+parseInt(parseInt(JumboHidNum)+1)+'" value="'+JSliderImageLink+'"><input type="text" style="display:none;" class="NewTab" id="JAdd_NewTab_'+parseInt(parseInt(JumboHidNum)+1)+'" name="JAdd_NewTab_'+parseInt(parseInt(JumboHidNum)+1)+'" value="'+JNewTab+'" /></td></tr>');
	jQuery('#JumboHidNum').val(parseInt(parseInt(JumboHidNum)+1));
	rich_web_Res();
}
function jambEditId(editNumber)
{
	var title = jQuery('#JAdd_Title_'+editNumber).text();
	var src = jQuery('#JAdd_Img_Src_'+editNumber).attr('src');
	var description = jQuery('#JAdd_Description_'+editNumber).val();
	var link = jQuery('#JADD_Link_'+editNumber).val();
	var newTab = jQuery('#JAdd_NewTab_'+editNumber).val();
	jQuery('#JumboHidUpd').val(editNumber);
	jQuery('.JSVBut').hide();
	jQuery('.JUPBut').show();
	jQuery('#JSliderImageTitle').val(title);
	jQuery('#rich_web_imgSrc_2').val(src);
	jQuery('#JSliderImageDesc').val(description);
	jQuery('#JSliderImageLink').val(link);
	if(newTab=='checked')
	{
		jQuery('#JNewTab').attr('checked',true);
	}
	else
	{
		jQuery('#JNewTab').attr('checked',false);
	}
}
function rich_web_Update()
{
	updateNumber=jQuery('#JumboHidUpd').val();
	var src = jQuery('#rich_web_imgSrc_2').val();
	var title = jQuery('#JSliderImageTitle').val();
	var description = jQuery('#JSliderImageDesc').val();
	var link = jQuery('#JSliderImageLink').val();
	var newTab = jQuery('#JNewTab').attr('checked');
	jQuery('#JAdd_Img_Src_'+updateNumber).attr('src',src);
	jQuery('#JADD_Tit_'+updateNumber).val(title);
	jQuery('#JAdd_Title_'+updateNumber).text(title);
	jQuery('#JAdd_src_'+updateNumber).val(src);
	jQuery('#JAdd_Description_'+updateNumber).val(description);
	jQuery('#JADD_Link_'+updateNumber).val(link);
	jQuery('#JAdd_NewTab_'+updateNumber).val(newTab);
	jQuery('.JSVBut').show();
	jQuery('.JUPBut').hide();
	rich_web_Res();
}
function jambDelId(removeNumber)
{
	var RWSIRSI = removeNumber;
	jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeIn();	
	jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeIn();

	jQuery('.Rich_Web_SliderIm_Relative_No').click(function(){
		jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();	
		jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
		RWSIRSI = null;
	})
	jQuery('.Rich_Web_SliderIm_Relative_Yes').click(function(){
		if(RWSIRSI != null)
		{
			jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();	
			jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
			jQuery('#tr_'+removeNumber).remove();
			jQuery('#JumboHidNum').val(jQuery('#JumboHidNum').val()-1);
			jQuery('.rich_web_SaveSl_Table3 tr').each(function(){
				jQuery(this).attr('id','tr_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(1)').html(parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(1)').attr('name','number_name_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(1)').attr('id','number_name_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(2)').attr('id','JAdd_Img_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(2) img').attr('id','JAdd_Img_Src_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(2) img').attr('name','JAdd_Img_Src_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(3)').attr('id','JAdd_Title_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(3)').attr('name','JAdd_Title_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(4)').attr('id','tdEdit_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(4) i').attr('onclick','jambEditId('+parseInt(parseInt(jQuery(this).index())+1)+')');
				jQuery(this).find('td:nth-child(5)').attr('id','tdDelete_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('td:nth-child(5) i').attr('onclick','jambDelId('+parseInt(parseInt(jQuery(this).index())+1)+')');
				jQuery(this).find('.add_title').attr('id','JADD_Tit_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_title').attr('name','JADD_Tit_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_description').attr('id','JAdd_Description_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_description').attr('name','JAdd_Description_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_img').attr('id','JAdd_src_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_img').attr('name','JAdd_src_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_link').attr('id','JADD_Link_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.add_link').attr('name','JADD_Link_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.NewTab').attr('id','JAdd_NewTab_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.NewTab').attr('name','JAdd_NewTab_'+parseInt(parseInt(jQuery(this).index())+1));
			})
		}
		RWSIRSI = null;			
	})			
}
function rich_webSortable()
{
	jQuery('.rich_web_SaveSl_Table3 tbody').sortable({
		update: function( event, ui ){
			jQuery(this).find('tr').each(function(i){
				jQuery(this).attr('id','tr_'+(i+1));
				jQuery(this).find('td:nth-child(1)').html((i+1));
				jQuery(this).find('td:nth-child(1)').attr('name','number_name_'+(i+1));
				jQuery(this).find('td:nth-child(1)').attr('id','number_name_'+(i+1));
				jQuery(this).find('td:nth-child(2)').attr('id','JAdd_Img_'+(i+1));
				jQuery(this).find('td:nth-child(2) img').attr('id','JAdd_Img_Src_'+(i+1));
				jQuery(this).find('td:nth-child(2) img').attr('name','JAdd_Img_Src_'+(i+1));
				jQuery(this).find('td:nth-child(3)').attr('id','JAdd_Title_'+(i+1));
				jQuery(this).find('td:nth-child(3)').attr('name','JAdd_Title_'+(i+1));
				jQuery(this).find('td:nth-child(4)').attr('id','tdEdit_'+(i+1));
				jQuery(this).find('td:nth-child(4) i').attr('onclick','jambEditId('+(i+1)+')');
				jQuery(this).find('td:nth-child(5)').attr('id','tdDelete_'+(i+1));
				jQuery(this).find('td:nth-child(5) i').attr('onclick','jambDelId('+(i+1)+')');
				jQuery(this).find('.add_title').attr('id','JADD_Tit_'+(i+1));
				jQuery(this).find('.add_title').attr('name','JADD_Tit_'+(i+1));
				jQuery(this).find('.add_description').attr('id','JAdd_Description_'+(i+1));
				jQuery(this).find('.add_description').attr('name','JAdd_Description_'+(i+1));
				jQuery(this).find('.add_img').attr('id','JAdd_src_'+(i+1));
				jQuery(this).find('.add_img').attr('name','JAdd_src_'+(i+1));
				jQuery(this).find('.add_link').attr('id','JADD_Link_'+(i+1));
				jQuery(this).find('.add_link').attr('name','JADD_Link_'+(i+1));
				jQuery(this).find('.NewTab').attr('id','JAdd_NewTab_'+(i+1));
				jQuery(this).find('.NewTab').attr('name','JAdd_NewTab_'+(i+1));
			});
		}
	})
}
function rich_web_Edit_Sl(number)
{
	jQuery('.Table_Data_rich_web1').css('display','none');
	jQuery('.JAddSlider').addClass('JAddSliderAnim');
	jQuery('.Table_Data_rich_web2').css('display','block');
	jQuery('.JUpdateSlider').addClass('JSaveSliderAnim');
	jQuery('.JCanselSlider').addClass('JCanselSliderAnim');
	jQuery('#upd_id').val(number);
	jQuery('.rich_web_Slider_ID').html('[Rich_Web_Slider id="'+number+'"]');
	jQuery('.JMBSL').html('&lt;?php echo do_shortcode(&apos;[Rich_Web_Slider id="'+number+'"]&apos;);?&gt;');
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Edit', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var arr=Array();
		var spl=response.split('=>');
		for(var i=3;i<spl.length;i++)
		{
			arr[arr.length]=spl[i].split('[')[0].trim(); 
		}
		arr[arr.length-1]=arr[arr.length-1].split(')')[0].trim();
		jQuery('.JSliderName').val(arr[0]);
		jQuery('.JSType').val(arr[1]);
		jQuery('#JumboHidNum').val(arr[2]);
		console.log(jQuery('#JumboHidNum').val());
	})
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Edit_ImDescTit', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var rich_webTitle=Array();
		var rich_webSrc=Array();
		var rich_webDesc=Array();
		var rich_webLink=Array();
		var rich_webNewTab=Array();
		var arrInst=response.split('stdClass Object');
		for(i=1;i<arrInst.length;i++)
		{
			var CSPL=arrInst[i].split('=>');
			rich_webTitle[rich_webTitle.length]=CSPL[2].split('[')[0].trim();
			rich_webSrc[rich_webSrc.length]=CSPL[4].split('[')[0].trim();
			rich_webDesc[rich_webDesc.length]=CSPL[3].split('[')[0].trim();
			rich_webLink[rich_webLink.length]=CSPL[5].split('[')[0].trim();
			rich_webNewTab[rich_webNewTab.length]=CSPL[6].split('[')[0].trim();
		}
		for(i=1;i<=rich_webTitle.length;i++)
		{
			jQuery('.rich_web_SaveSl_Table3').append('<tr id="tr_'+i+'"><td name="number_name_'+i+'" id="number_name_'+i+'" >'+i+'</td><td id="JAdd_Img_'+i+'"><img src="'+rich_webSrc[i-1]+'" id="JAdd_Img_Src_'+i+'" name="JAdd_Img_Src_'+i+'" style="height:60px;"></td><td id="JAdd_Title_'+i+'" name="JAdd_Title_'+i+'">'+rich_webTitle[i-1]+'</td><td id="tdEdit_'+i+'"><i class="jIcPencil rich_web  rich_web-pencil" onclick="jambEditId('+i+')"></i></td><td id="tdDelete_'+i+'"><i class="jIcDel rich_web  rich_web-trash" onclick="jambDelId('+i+')"></i><input type="text" style="display:none;" class="add_title" id="JADD_Tit_'+i+'" name="JADD_Tit_'+i+'" value="'+rich_webTitle[i-1]+'" /><input type="text" style="display:none;" class="add_description" id="JAdd_Description_'+i+'" name="JAdd_Description_'+i+'" value="'+rich_webDesc[i-1]+'"/><input type="text" style="display:none;" class="add_img" id="JAdd_src_'+i+'" name="JAdd_src_'+i+'" value="'+rich_webSrc[i-1]+'" /><input type="text" style="display:none" class="add_link" id="JADD_Link_'+i+'" name="JADD_Link_'+i+'" value="'+rich_webLink[i-1]+'"><input type="text" style="display:none;" class="NewTab" id="JAdd_NewTab_'+i+'" name="JAdd_NewTab_'+i+'" value="'+rich_webNewTab[i-1]+'" /></td></tr>');
		}
	})
}
function rich_web_Delete_Sl(number)
{
	var RWSIRS = number;
	jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeIn();	
	jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeIn();

	jQuery('.Rich_Web_SliderIm_Relative_No').click(function(){
		jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();	
		jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
		RWSIRS = null;
	})
	jQuery('.Rich_Web_SliderIm_Relative_Yes').click(function(){
		if(RWSIRS != null)
		{
			jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();	
			jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
			var ajaxurl = object.ajaxurl;
			var data = {
				action: 'rich_web_Del', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: number, // translates into $_POST['foobar'] in PHP
			};
			jQuery.post(ajaxurl, data, function(response) {
				location.reload();
			})
		}
		RWSIRS = null;			
	})			
}
function rich_web_Copy_Sl(number)
{
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Copy_Sl', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		location.reload();
	})
}