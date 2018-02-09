<?php get_header(); ?>

<div id="page-title" class="archive-title">
	<div class="container">
		<h1><?php _e('Page Not Found', 'snapshot') ?></h1>
	</div>
</div>
<div id="home-slider-below"></div>

<div class="page">
	<div class="container">
		<div id="post-main">
			<div class="entry-content">
				<p><?php echo wp_kses_post(siteorigin_setting('messages_404', __("We couldn't find what you were looking for.", 'snapshot'))) ?></p>
			</div>
		</div>

	</div>
	<div class="clear"></div>
</div>

<?php get_footer() ?>