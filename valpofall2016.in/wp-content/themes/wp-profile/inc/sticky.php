<?php
/**
 * @package WP Profile
 */
?>

<div id="featured-post">
    <h1 class="entry-title"><a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
    <div class="image-container-responsive">
        <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('wp-profile-feature-image'); ?></a>
    </div>
        <div class="row entry-meta">
            <div class="<?php if ( has_post_thumbnail() ) { ?>col-lg-4<?php } else {?>col-lg-12<?php }?> post-date">
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
					echo '<li><div class="tag-container"><span class="post-comments"><a href="#comments"><i class="fa fa-comments-o"></i>' . get_comments_number() .'</a></spa></div></li>';
					echo '</ul>';						
                ?>
                
            </div>
        </div>    
    <div class="post_excerpt">
        <?php the_excerpt(); ?>
    </div>
    <div id="read-more">
        <a href="<?php the_permalink('') ?>" ><?php _e( 'Read More...', 'wp-profile' ); ?></a>
    </div>
</div>