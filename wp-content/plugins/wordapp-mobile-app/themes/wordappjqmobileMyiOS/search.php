<?php  include dirname( __FILE__ ) . '/inc/mobile-header.php'; ?>
<div class="without-search">
	<div class="">
	<?php if (have_posts()) : ?>
		<?php get_search_form(); ?>
		<ul data-role="listview" data-inset="true"<?php jqmobileWordApp('post');?>>
			<?php while (have_posts()) : the_post(); ?>
				<li>
					
					<a href="<?php the_permalink() ?>">
						
						<?php 

	echo get_the_post_thumbnail( the_ID(), 'thumbnail' ); 


?>
						
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
		<?php get_search_form(); ?>
		<h2>No posts found.</h2>
	<?php endif; ?>
	</div>

</div>
<?php  include dirname( __FILE__ ) . '/inc/mobile-footer.php'; ?>