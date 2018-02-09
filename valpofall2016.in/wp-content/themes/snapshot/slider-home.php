<?php
$query = snapshot_get_slider_query();
$post_count = 0;
?>
<div id="home-slider" class="loading <?php if(siteorigin_setting('slider_scale_height')) echo 'gallery-slider'; ?>">
	<div class="container">
		
		<div class="post-titles">
			<?php while($query->have_posts()) : $query->the_post(); if(has_post_thumbnail()) : $post_count++; ?>
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			<?php endif; endwhile; ?>
		</div>

		<?php if($post_count == 0) : ?>
			<div class="demo-message">
				<?php _e("This Slider Will Display Your Post's Featured Images... So Start Adding Some Posts.", 'snapshot') ?>
			</div>
		<?php endif; ?>
		
		<div class="navigation">
			<a href="#" class="previous"></a>
			<a href="#" class="next"></a>
			<div class="clear"></div>
		</div>
	</div>
	
	<?php $query->rewind_posts(); while($query->have_posts()) : $query->the_post(); if(has_post_thumbnail()) : ?>
		<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'slider-large', false, array('class' => 'slide')) ?>
	<?php endif; endwhile; ?>
	
	<?php if($post_count == 0) : ?>
		<div class="demo-message-background"></div>
		<img src="<?php echo get_template_directory_uri() ?>/demo/first.jpg" class="slide" />
		<img src="<?php echo get_template_directory_uri() ?>/demo/second.jpg" class="slide" />
	<?php endif; ?>
</div>
<div id="home-slider-below"></div>
<?php wp_reset_postdata() ?>