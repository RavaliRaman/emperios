<?php
/*
Template Name: Full Width
*/
get_header(); the_post()
?>

<div id="page-title" class="archive-title">
	<div class="container">
		<h1><?php the_title() ?></h1>
	</div>
</div>
<div id="home-slider-below"></div>

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