<?php
/**
 * @package WP Profile
 */
?>
<?php if(is_sticky()){ ?>
        	<?php get_template_part( 'inc/sticky' ); ?>
<?php } else {?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
	<?php if(has_post_thumbnail()) {?> 
    <div class="col-md-12">
        <div class="row">
        	<header class="post-entry col-md-12">
				<?php the_title( sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>'); ?>
            </header>
            <div class="col-md-10 entry-thumb">
                <div class="image-container-responsive">
                    <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('wp-profile-large-image'); ?></a>
                </div>
            </div>
            
            <div class="col-md-2 f-list-wrapper">
                <?php if('post' == get_post_type()) : ?>
                <div class="entry-meta">
                    <?php wp_profile_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			echo wp_profile_excerpt('40');
			
		?>
		<div id="read-more">
             <a href="<?php the_permalink('') ?>" class="read-more" ><span><?php _e( 'Read More', 'wp-profile' ); ?></span></a>
        </div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wp-profile' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

    </div>
    <?php } else {?>
    <div class="col-md-12">
    <header class="post-entry">
		<?php the_title( sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>'); ?>

		<?php if('post' == get_post_type()) : ?>
		<div class="entry-meta">
			<?php wp_profile_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt();
			
		?>
		<div id="read-more" >
             <a href="<?php the_permalink('') ?>" class="read-more" ><span><?php _e( 'Read More', 'wp-profile' ); ?></span></a>
        </div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wp-profile' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


    </div>
    <?php } ?>
</div>
</article><!-- #post-## -->
 <?php } ?>