<div class="gallery-slider loading">

	<div class="post-titles">
		<?php while(have_posts()) : the_post(); if(has_post_thumbnail()) : ?>
			<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		<?php endif; endwhile; ?>
	</div>

	<div class="navigation">
		<a href="#" class="previous"></a>
		<a href="#" class="next"></a>
		<div class="clear"></div>
	</div>

	<?php rewind_posts(); while(have_posts()) : the_post(); if(has_post_thumbnail()) : ?>
		<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'single-large-landscape', false, array('class' => 'slide')) ?>
	<?php endif; endwhile; ?>
</div>
<div id="home-slider-below"></div>