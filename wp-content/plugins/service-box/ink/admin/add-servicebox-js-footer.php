<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<script>
var j = 1000;
	function add_new_accordion(){
	var output = '<li class="wpsm_ac-panel single_acc_box" >'+
							'<span class="ac_label"><?php _e('Service Title',wpshopmart_service_box_text_domain); ?></span>'+
							'<input type="text" id="service_title[]" name="service_title[]" value="" placeholder="Enter Service Title Here" class="wpsm_ac_label_text">'+
							'<span class="ac_label"><?php _e('Service Small Description',wpshopmart_service_box_text_domain); ?></span>'+
							'<textarea  id="service_description[]" name="service_description[]"  placeholder="Enter Service Description Here" class="wpsm_ac_label_text"></textarea>'+
							'<span class="ac_label"><?php _e('Service Icon',wpshopmart_service_box_text_domain); ?></span>'+
							'<div class="form-group input-group">'+
								'<input data-placement="bottomRight" id="service_icon[]" name="service_icon[]" class="form-control icp icp-auto" value="fa-laptop" type="text" readonly="readonly" />'+
								'<span class="input-group-addon "></span>'+
							'</div>'+
							'<span class="ac_label"><?php _e('Add Your Service Link Or Read More Link Here (With http://or https://)',wpshopmart_service_box_text_domain); ?></span>'+
							
								'<input type="text" id="service_link[]" name="service_link[]" value="" placeholder="Enter Service Link Here" class="wpsm_ac_label_text">'+		
							'<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>'+
							
						'</li>';
		
	jQuery(output).hide().appendTo("#accordion_panel").slideDown("slow");
	j++;
	call_icon();
	}
	jQuery(document).ready(function(){

	  jQuery('#accordion_panel').sortable({
	  
	   revert: true,
	 
	  });
	});
	
	
</script>
<script>
	jQuery(function(jQuery)
		{
			var accordion = 
			{
				accordion_ul: '',
				init: function() 
				{
					this.accordion_ul = jQuery('#accordion_panel');

					this.accordion_ul.on('click', '.remove_button', function() {
					if (confirm('Are you sure you want to delete this?')) {
						jQuery(this).parent().slideUp(600, function() {
							jQuery(this).remove();
						});
					}
					return false;
					});
					 jQuery('#delete_all_acc').on('click', function() {
						if (confirm('Are you sure you want to delete all the Faq?')) {
							jQuery(".single_acc_box").slideUp(600, function() {
								jQuery(".single_acc_box").remove();
							});
							jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
							
						}
						return false;
					});
					
			   }
			};
		accordion.init();
	});
</script>


