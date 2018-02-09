<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wpsm_row"> 
<style>
.wpsm_row{
	overflow:hidden;
	display:block;
	width:100%;
}
.wpsm_service_b_row{ 
	overflow:hidden;
	display:block;
	width:100%;
	border:0px solid #ddd;
	margin-bottom:20px;
}
 #wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox{
	padding:30px 0 ;
	margin-bottom:20px;
}
#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-icon{
	background:<?php echo $service_icon_bg_clr; ?> !important;
	height: 70px;
	width: 70px;
	border-radius:50% !important;
	text-align: center !important;
	float: left !important;
}

#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-icon i{
	font-size:30px !important;
	color: <?php echo $service_icon_clr; ?> !important;
	line-height: 70px;
}
<?php if($service_display_icon=="yes"){ ?>   
#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-content {
	margin-left: 95px;
}
<?php } ?>
#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-content h3{
	color: <?php echo $service_title_clr; ?> !important;
	font-size: <?php echo $service_title_font_size; ?>px !important;
	font-weight: 600;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
	margin-top: 0;
	clear:inherit !important;
	line-height:1.4 !important;
	margin-bottom:0px !important;
	
}
#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-content p{
	color:<?php echo $service_des_clr; ?> !important;
	font-size: <?php echo $service_des_font_size; ?>px !important;
	line-height:1.4 !important;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
	margin-top:10px;
	margin-bottom:0px;
	
}
#wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_read{
	color: <?php echo $service_readmore_clr; ?> !important;
	font-size: <?php echo $service_readmore_font_size; ?>px !important;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
	text-decoration: none;
	border-bottom: 1px solid;
	 margin-top:15px;
	 display: inline-block;
}
<?php echo $custom_css; ?>
</style>

			<?php
			$i=1;
			
			switch($sb_layout){
					case(6):
						$row=2;
					break;
					case(4):
						$row=3;
					break;
					case(3):
						$row=4;
					break;
				}
					foreach($data as $single_data)
					{
						 $service_title = $single_data['service_title'];
						 $service_description = $single_data['service_description'];
						 $service_icon = $single_data['service_icon'];
						 $service_link = $single_data['service_link'];
						?>

				<div class="wpsm_col-md-<?php echo $sb_layout; ?> wpsm_col-sm-6">
                    <div class="wpsm_serviceBox">
						<?php if($service_display_icon=="yes"){ ?>                       
							<div class="wpsm_service-icon">
								<i class="fa <?php echo $service_icon; ?>"></i>
							</div>
						<?php } ?>
                        <div class="wpsm_service-content">
                            <h3><?php echo $service_title; ?></h3>
                            <p> <?php echo $service_description; ?></p>
                            <?php if($service_display_readmore=="yes"){ ?>
							<?php if($service_link !="") { ?>	
							<a target="_blank" href="<?php echo $service_link; ?>" class="wpsm_read"><?php echo $sb_web_link_label; ?>
                                
                            </a>
							<?php } } ?>
                        </div>
                    </div>
                </div>

				<?php
					if($i%$row==0){
						?>
						</div>
						<div class="wpsm_row">
						<?php 
					}	
					
					 $i++;
       } ?>    

</div>	   