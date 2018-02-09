<?php if(have_posts()) : ?>
	<div id="post-loop">
		<div class="container">
			<?php while(have_posts()): the_post(); ?>
				<div <?php post_class('post') ?>>
					<div class="post-background">
						<?php if(has_post_thumbnail()) : the_post_thumbnail('post-thumbnail', array('class' => 'thumbnail')) ?>
						<?php else : ?><img src="<?php echo get_template_directory_uri() ?>/images/defaults/no-thumbnail.jpg" width="310" height="420" class="thumbnail" />
						<?php endif ?>
						<div class="post-content">
							<?php do_action('before_post_summary') ?>
							<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
							<div class="excerpt">
								<?php the_excerpt() ?>
							</div>
							
							<div class="date">
								<em></em>
								<a href="<?php the_permalink() ?>"><?php echo get_the_date() ?></a>
							</div>
							
							<?php $comments = get_comment_count(get_the_ID()); ?>
							<?php if(!empty($comments['approved'])) : ?>
								<div class="comments">
									<em></em>
									<a href="<?php the_permalink() ?>#comments"><?php printf(__('%s Comments', 'snapshot'), $comments['approved']) ?></a>
								</div>
							<?php endif; ?>
							<?php do_action('after_post_summary') ?>
						</div>

						<div class="corner corner-se"></div>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="clear"></div>
			
			<div id="page-navigation">
				<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); ?>
				<?php else : posts_nav_link(' ', __('Previous Page', 'snapshot'), __('Next Page', 'snapshot')); echo '<div class="clear"></div>'; endif;?>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="page">
		<div class="container">
			<div id="post-main">
				<div class="entry-content">
					<p><?php echo wp_kses_post(siteorigin_setting('messages_no_results', __("No results.", 'snapshot'))) ?></p>
				</div>
			</div>
	
		</div>
		<div class="clear"></div>
	</div>
<?php endif; ?>
