<?php if( get_post_meta(get_the_ID(), 'snapshot_post_video', true) && function_exists('snapshot_plus_video_viewer') ) : ?>
	<div id="post-single-viewer">
		<div class="container">
			<?php snapshot_plus_video_viewer(get_the_ID()); ?>
		</div>
	</div>
<?php elseif(has_post_thumbnail()) : ?>
	<div id="post-single-viewer" class="image">
		<div class="container">
			<?php
			$image = get_post_meta(get_the_ID(), 'snapshot_post_image', true);
			$image = wp_parse_args($image, array(
				'size' => 'single-large',
				'url' => '',
			));
			if(!empty($image['url'])) echo '<a href="'.esc_url($image['url']).'">';
			echo wp_get_attachment_image(get_post_thumbnail_id(), $image['size'], false, array('class' => 'single-image'));
			if(!empty($image['url'])) echo '</a>';
			?>
		</div>
	</div>
<?php endif; ?>
<div id="home-slider-below"></div>