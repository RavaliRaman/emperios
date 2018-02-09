(function($) { 
  'use strict';

	/**
	 * Active the Zoom
	 */
	
	$('.wpb-wiz-main-image').elevateZoom({
		zoomType: "inner",
		cursor: "crosshair",
		zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 750,
		gallery:'wpb_wiz_gallery',
		galleryActiveClass: 'wpb-wiz-active', 
	});

	/**
	 * Change image on gallery image click
	 */
	
	$(".wpb-wiz-main-image").bind("click", function(e) { 
		var ez = $('.wpb-wiz-main-image').data('elevateZoom');	
		$.fancybox(ez.getGalleryList()); 
		return false; 
	});

	/**
	 * Remove srcset & size attr
	 */
	
	$("#wpb_wiz_gallery a").on("click", function(){ 
		$('.single-product .images > a img').removeAttr('srcset');
		$('.single-product .images > a img').removeAttr('sizes');
	});
	
})(jQuery);