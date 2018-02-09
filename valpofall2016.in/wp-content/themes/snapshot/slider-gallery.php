<?php global $snapshot_gallery_slider_attachments; $attachments = $snapshot_gallery_slider_attachments; ?>
<div class="gallery-slider loading">

	<div class="navigation">
		<a href="#" class="previous"></a>
		<a href="#" class="next"></a>
		<div class="clear"></div>
	</div>

	<?php foreach($attachments as $attachment) : ?>
		<?php echo wp_get_attachment_image($attachment->ID, 'large', false, array('class' => 'slide')) ?>
	<?php endforeach; ?>
	
</div>
<div class="home-gallery-below"></div>
<?php wp_reset_postdata() ?>