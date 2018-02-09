<?php
/*
Template Name: Slider and Text
*/
get_header(); the_post()
?>
	
	<?php get_template_part('slider', 'home'); ?>

	<div id="post-<?php the_ID() ?>" <?php post_class() ?>>
		<div class="container">
			<div id="post-main">
				<div class="entry-content">
					<?php the_content() ?>

					<?php global $numpages; if(empty($numpages)) : ?>
						<div class="clear"></div>
					<?php endif; ?>
					<?php wp_link_pages() ?>
				</div>

				<?php comments_template() ?>
			</div>

		</div>
		<div class="clear"></div>
	</div>

<?php get_footer() ?>