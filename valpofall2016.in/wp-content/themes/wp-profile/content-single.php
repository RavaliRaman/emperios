<?php
/**
 * @package WP Profile
 */
?>
<div class="row">
    <div id="primary" class="content-area col-md-9">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                	<div class="row">
                        <div class="col-lg-10">
                            <div class="image-container-responsive featured-thumb">
                               <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('wp-profile-feature-image'); ?></a>
                            </div>
                        </div>
                        <div class="<?php if ( has_post_thumbnail() ) { ?>col-lg-2<?php } else {?>col-lg-12<?php }?> post-date">
                            <?php
                                $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
                                if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                                    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                                }
                            
                                $time_string = sprintf( $time_string,
                                    esc_attr( get_the_date( 'c' ) ),
                                    esc_html( get_the_date() ),
                                    esc_attr( get_the_modified_date( 'c' ) ),
                                    esc_html( get_the_modified_date() )
                                );
                            
                                $posted_on = sprintf(
                                    _x( '%s', 'post date', 'wp-profile' ),
                                    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-clock-o"></i>' . $time_string . '</a>'
                                );
                                
                                    echo '<ul class="featured-items">';
                                    echo '<li><div class="tag-container"><span class="byline">' . $posted_on . '</span></div></li>';
                                    echo '<li><div class="tag-container"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fa fa-user fa-6"> </i>'. esc_html( get_the_author() ) .'</a></span></div></li>';
                                    echo '<li><div class="tag-container"><span class="post-comments"><a href="#comments"><i class="fa fa-comments-o"></i>' . $post->comment_count .'</a></spa></div></li>';
                                    echo '</ul>';
                            ?>
                        </div>
					</div>
                    
                    <div class="row entry-meta">
                        <div id="featured-category" class="col-lg-8">
                            <?php
                                $categories_list = get_the_category_list( __( ', ', 'wp-profile' ) );
                                if ( $categories_list && wp_profile_categorized_blog() ) {
                                    printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'wp-profile' ) . '</span>', $categories_list );
                                }
                            ?>
                        </div>
                        
                    </div>
                    <?php the_content(); ?>
                    <?php if (get_theme_mod('wp_profile_author_bio') ) : ?>
                        <div class="author-bio">        
                            <?php 
                            $author_avatar = get_avatar( get_the_author_meta('email'), '75' );
                            if ($author_avatar) : ?>
                                <div class="author-thumb"><?php echo $author_avatar; ?></div>
                            <?php endif; ?>
                            
                            <div class="author-info">
                                <?php $author_posts_url = get_author_posts_url( get_the_author_meta( 'ID' )); ?> 
                                <h4 class="author-title"><?php _e('Posted by ', 'wp-profile'); ?><a href="<?php echo esc_url($author_posts_url); ?>" title="<?php printf( __( 'View all posts by %s', 'wp-profile' ), get_the_author() ) ?>"><?php the_author(); ?></a></h4>
                                <?php $author_desc = get_the_author_meta('description');
                                if ( $author_desc ) : ?>
                                <p class="author-description"><?php echo $author_desc; ?></p>
                                <?php endif; ?>
                                <?php $author_url = get_the_author_meta('user_url');
                                if ( $author_url ) : ?>
                                <p><?php _e('Website: ', 'wp-profile') ?><a href="<?php echo esc_url($author_url); ?>"><?php echo esc_url($author_url); ?></a></p>
                                <?php endif; ?>
                            </div>
                    </div>
                    <?php endif; ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'wp-profile' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div><!-- .entry-content -->
                <?php wp_profile_post_nav(); ?>
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