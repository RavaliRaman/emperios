<?php  include dirname( __FILE__ ) . '/inc/mobile-header.php'; ?>
	<div class="right">
		<?php if (have_posts()) : ?>
 			<?php $post = $posts[0]; ?>
			<ul data-role="listview" data-inset="true" class="posts"<?php jqmobileWordApp('post');?>>
				<?php while (have_posts()) : the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>">
							<p class="ui-li-aside"><?php the_time('Y-m-d'); ?></p>
							<h3><?php the_title(); ?></h3>
							<p><strong><?php the_author(); ?></strong></p>
							<div><?php the_excerpt(); ?></div>
							<?php if (comments_open()): ?>
								<span class="ui-li-count"><?php comments_number('0', '1', '%' );?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
		<?php else : ?>
		<h2>Nothing found</h2>
		<?php endif; ?>
	</div>
<?php  include dirname( __FILE__ ) . '/inc/mobile-footer.php'; ?>