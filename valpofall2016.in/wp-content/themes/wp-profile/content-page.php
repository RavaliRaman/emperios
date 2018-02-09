<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WP Profile
 */
?>
<div class="row">
    <div id="primary" class="content-area col-md-9">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'wp-profile' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div><!-- .entry-content -->
            
                <footer class="entry-footer">
                    <?php edit_post_link( __( 'Edit', 'wp-profile' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-footer -->
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
            </article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->
    <div class="col-md-3 ">
        <aside id="widget" class="widget-container">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>