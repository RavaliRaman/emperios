<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div style=" overflow: hidden;padding: 10px;">
<style>
	.html_editor_button{
		border-radius:0px;
		background-color: #9C9C9C;
		border-color: #9C9C9C;
		margin-bottom:20px;
	}
	</style>
	<h3><?php _e('Add Service Box',wpshopmart_service_box_text_domain); ?></h3>
	<input type="hidden" name="servicebox_save_data_action" value="servicebox_save_data_action" />
	<ul class="clearfix" id="accordion_panel">
	<?php
			$i=1;
			$data = unserialize(get_post_meta( $post->ID, 'wpsm_servicebox_data', true));
			$TotalCount =  get_post_meta( $post->ID, 'wpsm_servicebox_count', true );
			if($TotalCount) 
			{
				if($TotalCount!=-1)
				{
					foreach($data as $single_data)
					{
						 $service_title = $single_data['service_title'];
						 $service_description = $single_data['service_description'];
						 $service_icon = $single_data['service_icon'];
						 $service_link = $single_data['service_link'];
						?>
						<li class="wpsm_ac-panel single_acc_box" >
							<span class="ac_label"><?php _e('Service Title',wpshopmart_service_box_text_domain); ?></span>
							<input type="text" id="service_title[]" name="service_title[]" value="<?php echo  $service_title; ?>" placeholder="Enter Faq Title Here" class="wpsm_ac_label_text">
							<span class="ac_label"><?php _e('Service Small Description',wpshopmart_service_box_text_domain); ?></span>
							<textarea  id="service_description[]" name="service_description[]"  placeholder="Enter Faq Description Here" class="wpsm_ac_label_text"><?php echo $service_description; ?></textarea>
							
							<span class="ac_label"><?php _e('Service Icon',wpshopmart_service_box_text_domain); ?></span>
							<div class="form-group input-group">
								<input data-placement="bottomRight" id="service_icon[]" name="service_icon[]" class="form-control icp icp-auto" value="<?php echo  $service_icon; ?>" type="text" readonly="readonly" />
								<span class="input-group-addon "></span>
							</div>
							<span class="ac_label"><?php _e('Add Your Service Link Or Read More Link Here (With http://or https://)',wpshopmart_service_box_text_domain); ?></span>
							
								<input type="text" id="service_link[]" name="service_link[]" value="<?php echo $service_link; ?>" placeholder="Enter Service Link Here" class="wpsm_ac_label_text">		
							<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
							
						</li>
						<?php 
						$i++;
					} // end of foreach
				}else{
				echo "<h2>No Faq Found</h2>";
				}
			}
			else 
			{
				  for($i=1; $i<=2; $i++)
				  {
					  ?>
					 <li class="wpsm_ac-panel single_acc_box" >
							<span class="ac_label"><?php _e('Service Title',wpshopmart_service_box_text_domain); ?></span>
							<input type="text" id="service_title[]" name="service_title[]" value="Sample Title" placeholder="Enter Service Title Here" class="wpsm_ac_label_text">
							<span class="ac_label"><?php _e('Service Small Description',wpshopmart_service_box_text_domain); ?></span>
							<textarea  id="service_description[]" name="service_description[]"  placeholder="Enter Service Description Here" class="wpsm_ac_label_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat.</textarea>
							
							<span class="ac_label"><?php _e('Service Icon',wpshopmart_service_box_text_domain); ?></span>
							<div class="form-group input-group">
								<input data-placement="bottomRight" id="service_icon[]" name="service_icon[]" class="form-control icp icp-auto" value="fa-laptop" type="text" readonly="readonly" />
								<span class="input-group-addon "></span>
							</div>
							<span class="ac_label"><?php _e('Add Your Service Link Or Read More Link Here (With http://or https://)',wpshopmart_service_box_text_domain); ?></span>
							
								<input type="text" id="service_link[]" name="service_link[]" value="#" placeholder="Enter Service Link Here" class="wpsm_ac_label_text">		
							<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
							
						</li>
					 <?php
				}
			}
			?>
	</ul>
</div>





<a class="wpsm_ac-panel add_wpsm_ac_new" id="add_new_ac" onclick="add_new_accordion()"   >
	<?php _e('Add New Service Box', wpshopmart_service_box_text_domain); ?>
</a>
<a  style="float: left;padding:10px !important;background:#31a3dd;" class=" add_wpsm_ac_new delete_all_acc" id="delete_all_acc"    >
	<i style="font-size:57px;"class="fa fa-trash-o"></i>
	<span style="display:block"><?php _e('Delete All',wpshopmart_service_box_text_domain); ?></span>
</a>
<div style="clear:left;"></div>
<?php require('add-servicebox-js-footer.php'); ?>