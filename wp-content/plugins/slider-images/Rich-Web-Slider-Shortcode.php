<?php
	function Rich_Web_Slider_ID($atts, $content = null)
	{
		$atts=shortcode_atts(
			array(
				"id"=>"1"
			),$atts
		);
		return Rich_Web_Draw_Short_Slider($atts['id']);
	}
	add_shortcode('Rich_Web_Slider', 'Rich_Web_Slider_ID');
	function Rich_Web_Draw_Short_Slider($Slider_ID)
	{
		ob_start();	
			$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Rich-Web Slider'), $Slider_ID, 'Rich_Web_Slider' );
			$Rich_Web_Photo_Slider=new Rich_Web_Photo_Slider;

			$instance=array('Rich_Web_Slider'=>$Slider_ID);
			$Rich_Web_Photo_Slider->widget($args,$instance);	
			$cont[]= ob_get_contents();
		ob_end_clean();	
		return $cont[0];		
	}
?>