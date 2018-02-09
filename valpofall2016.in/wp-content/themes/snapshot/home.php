<?php get_header() ?>

<?php global $paged; if((empty($paged) || $paged == 1) && siteorigin_setting('slider_enabled')) : get_template_part('slider', 'home'); ?>
<?php else : ?>
	<div id="page-title" class="archive-title">
		<div class="container">
			<h1><?php echo esc_html(siteorigin_setting('general_latest_posts')) ?></h1>
		</div>
	</div>
	<div id="home-slider-below"></div>
<?php endif; ?>

<?php get_template_part('loop', 'index') ?>

<?php get_footer() ?>
