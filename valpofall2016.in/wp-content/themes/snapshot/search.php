<?php get_header(); ?>

<div id="page-title" class="archive-title">
	<div class="container">
		<h1><?php wp_title(' ') ?></h1>
	</div>
</div>
<div id="home-slider-below"></div>

<?php get_template_part('loop') ?>

<?php get_footer() ?>