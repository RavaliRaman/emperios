<?php get_header(); the_post(); global $post; ?>

<div id="page-title" class="post-title">
	<div class="container">
		<div class="post-info">
			<div class="date">
				<em></em>
				<a href="<?php the_permalink() ?>"><?php echo get_the_date() ?></a>
			</div>
			<div class="comments">
				<em></em>
				<a href="#comments"><?php comments_number( __('No Comments', 'snapshot'), __('One Comment', 'snapshot'), __('% Comments', 'snapshot') ); ?></a>
			</div>
			<div class="category">
				<em></em><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo get_the_title($post->post_parent) ?></a>
			</div>

			<?php $category = get_the_category(); if(!empty($category)) : ?>
			<div class="category">
				<em></em><a href="<?php echo get_term_link($category[0]) ?>"><?php echo $category[0]->name ?></a>
			</div>
			<?php endif ?>
		</div>

		<h1><?php the_title() ?></h1>

		<div class="nav">
			<?php
				$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));
				foreach ( $attachments as $k => $attachment )
					if ( $attachment->ID == $post->ID )
						break;
				
				if(isset($attachments[$k-1])){
					?><a href="<?php echo esc_url(get_attachment_link($attachments[$k-1]->ID)) ?>" rel="prev"></a><?php
				}
				if(isset($attachments[$k+1])){
					?><a href="<?php echo esc_url(get_attachment_link($attachments[$k+1]->ID)) ?>" rel="next"></a><?php
				}
			?>
		</div>
	</div>
</div>

<div id="post-single-viewer" class="image">
	<div class="container">
		<?php echo wp_get_attachment_image($post->ID, 'single-large', false, array('class' => 'single-image')); ?>
	</div>
</div>
<div id="home-slider-below"></div>

<div id="post-<?php the_ID() ?>" <?php post_class() ?>>
	<div class="container">
		<div id="post-share">
			<?php if(siteorigin_setting('social_display_share')) get_template_part('share') ?>
		</div>

		<div id="post-main">
			<div class="entry-content">
				<?php the_content() ?>

				<?php global $numpages; if(!empty($numpages) || get_the_tag_list() != '') : ?>
				<div class="clear"></div>
				<?php endif; ?>

				<?php wp_link_pages() ?>
				<?php the_tags() ?>
			</div>
			<div class="clear"></div>

			<div id="single-comments-wrapper">
				<?php comments_template() ?>
			</div>
		</div>

		<div id="post-images">
			<?php
			// TODO this should only select specific images
			$children = get_children(array(
				'post_mime_type' => 'image',
				'post_parent' => get_the_ID(),
				'post_type' => 'attachment'
			));

			foreach($children as $child){
				$exclude = get_post_meta($child->ID, 'sidebar_exclude', true);
				if(!empty($exclude)) continue;

				$src = wp_get_attachment_image_src($child->ID, 'single-large');
				?>
				<div class="image">
					<?php if(count($children)) echo '<a href="#" data-src="'.$src[0].'" data-width="'.$src[1].'" data-height="'.$src[2].'">' ?>
					<?php echo wp_get_attachment_image($child->ID, 'post-thumbnail', false, array('class' => 'thumbnail')); ?>
					<?php if(count($children)) echo '</a>' ?>
				</div>
				<?php

			}
			?>
		</div>

	</div>
	<div class="clear"></div>
</div>

<?php get_footer() ?>
