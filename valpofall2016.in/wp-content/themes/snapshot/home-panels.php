<?php
/**
 * Template used by the panels page builder for the home page.
 *
 * Template Name: Page Builder Home
 */
get_header();
?>
	
<?php if(siteorigin_setting('slider_enabled')) : get_template_part('slider', 'home'); ?>
<?php else : ?><div id="page-title" class="archive-title"><div class="container"></div></div><div id="home-slider-below"></div><?php endif; ?>

<div id="panels-home">
	<div class="container">
		<div id="post-main">
			<div class="entry-content">
				<?php
				if(is_page()) the_content();
				else if( function_exists('siteorigin_panels_render') ) echo siteorigin_panels_render('home');
				?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php get_footer() ?>