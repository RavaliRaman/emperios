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
    padding: 20px 10px 20px 10px;
    text-align: center;
    transition: all 0.3s ease 0s;
   background:<?php echo $service_box_bg_clr_dsn2; ?>;
	margin-bottom:30px;
}
 
 #wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-icon i{
    font-size: 60px;
	 color: <?php echo $service_icon_clr; ?> !important;
}
 #wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-content h3{
   color: <?php echo $service_title_clr; ?> !important;
	font-size: <?php echo $service_title_font_size; ?>px !important;
	font-weight: 600;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
   clear:inherit !important;
	line-height:1.4 !important;
	margin-top:10px !important;
	margin-bottom:0px !important;
}
 #wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_service-content p{
   color:<?php echo $service_des_clr; ?> !important;
	font-size: <?php echo $service_des_font_size; ?>px !important;
	line-height:1.4 !important;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
	margin-top:10px !important;
	margin-bottom:0px !important;
	
	
}
 #wpsm_service_b_row_<?php echo $post_id; ?> .wpsm_serviceBox .wpsm_read_more{
   margin-top:15px;
   color: <?php echo $service_readmore_clr; ?> !important;
	font-size: <?php echo $service_readmore_font_size; ?>px !important;
   background:<?php echo $service_readmore_bg_clr; ?>;
    border: 2px solid <?php echo $service_readmore_bg_clr; ?>;
    text-decoration: none;
    display: inline-block;
    padding: 7px 10px;
   border-radius: 0;
    font-weight: normal;
	<?php if($font_family !="0"){ ?>
	font-family:'<?php echo $font_family; ?>' !important;
	<?php } ?>
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
								<p>
									<?php echo $service_description; ?>
								</p>
							</div>
							<?php if($service_display_readmore=="yes"){ ?>
								<?php if($service_link !="") { ?>
									<a href="<?php echo $service_link; ?>" class="btn btn-default wpsm_read_more" target="_blank"><?php echo $sb_web_link_label; ?></a>
								<?php } 
							} ?>
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
