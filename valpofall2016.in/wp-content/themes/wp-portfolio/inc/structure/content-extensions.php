<?php
/**
 * Adds content structures.
 *
 * @package Theme Horse
 * @subpackage WP_Portfolio
 * @since WP_Portfolio 1.0
 * @license http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link http://themehorse.com/themes/portfolio
 */
/****************************************************************************************/
add_action( 'wp_portfolio_main_container', 'wp_portfolio_content', 10 );
/**
 * Function to display the content for the single post, single page, archive page, index page etc.
 */
function wp_portfolio_content() {
	get_template_part( 'content');
}
/****************************************************************************************/
add_action( 'wp_portfolio_before_loop_content', 'wp_portfolio_loop_before', 10 );
/**
 * Contains the opening div
 */
function wp_portfolio_loop_before() {
	echo '<div id="main">';
}
/****************************************************************************************/
add_action( 'wp_portfolio_loop_content', 'wp_portfolio_theloop', 10 );
/**
 * Shows the loop content
 */
function wp_portfolio_theloop() {
	if( is_page() ) {
		wp_portfolio_theloop_for_page();
	}
	elseif( is_single() ) {
		wp_portfolio_theloop_for_single();
	}
	elseif( is_search() ) {
		wp_portfolio_theloop_for_search();
	}
	else {
		wp_portfolio_theloop_for_archive();
	}
}
/****************************************************************************************/
if ( ! function_exists( 'wp_portfolio_theloop_for_archive' ) ) :
/**
 * Fuction to show the archive loop content.
 */
function wp_portfolio_theloop_for_archive() {
	global $post;
	global $wp_portfolio_settings,$array_of_default_settings;
	$wp_portfolio_settings = wp_parse_args(  get_option( 'wp_portfolio_theme_settings', array() ),  wp_portfolio_get_option_defaults() );
	$wp_portfolio_post_layout = $wp_portfolio_settings['wp_portfolio_post_layout'];
	if($wp_portfolio_post_layout !='blog_layout') {?>
	<div class="post-main clearfix">
	<?php  }
		if( have_posts() ) {
			while( have_posts() ) {
				the_post();
				do_action( 'wp_portfolio_before_post' );
				$attachment_id = get_post_thumbnail_id(); ?>
					<section id="post-<?php the_ID(); ?> clearfix" <?php post_class('clearfix'); ?>>
						<?php do_action( 'wp_portfolio_before_post_header' );
						 if($wp_portfolio_post_layout =='blog_layout') {?>
						<article class="entry-wrap clearfix">
						<?php
							if( has_post_thumbnail()) { ?>
							<figure class="post-featured-image">
								<a style="background-image:url('<?php echo esc_url(wp_get_attachment_image_url($attachment_id,'full'))?>');" href="<?php the_permalink(); ?>" title="<?php the_title();?>"></a>
							</figure><!-- .post-featured-image -->
							<?php } ?>
							<div class ="entry-main post-content">
							<?php if ( is_sticky() && is_home() && ! is_paged() ) {?>
							<span class="sticky-post"><?php _e('Featured','wp-portfolio');?></span>
							<?php } ?>
							<header class="entry-header">
								<?php 
								if (get_the_author() !=''){?>
									<div class="entry-meta">
										<span class="cat-links"><?php the_category(', '); ?></span><!-- .cat-links --> 
									</div> <!-- .entry-meta -->
								<?php
								} ?>
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
											<?php the_title();?>
										</a>
									</h2><!-- .entry-title -->
								<?php 
						      if (has_category() !=''){?>
									<div class="entry-meta clearfix">
										<div class="by-author vcard author">
											<span class="fn">
												<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php  esc_attr(the_author()); ?>">
												<?php the_author(); ?> </a>
											</span>
										</div>
										<div class="date updated"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>">
											<?php the_time( get_option( 'date_format' ) ); ?></a>
										</div>
										<?php 
										if ( comments_open() ) { ?>
										<div class="comments">
											<?php comments_popup_link( __( 'No Comments', 'wp-portfolio' ), __( '1 Comment', 'wp-portfolio' ), __( '% Comments', 'wp-portfolio' ), '', __( 'Comments Off', 'wp-portfolio' ) ); ?>
										</div>
										<?php
										} ?>
									</div><!-- .entry-meta -->
								</header><!-- .entry-header -->
								<div class="entry-content clearfix">
									<p><?php the_excerpt(); ?></p>
									<p><a href="<?php the_permalink();?>" class="readmore"><?php _e('Contiune reading','wp-portfolio')?></a>
									</p>
								</div><!-- .entry-content -->
									<?php $tag_list = get_the_tag_list( '', __( ', ', 'wp-portfolio' ) ); ?>
								<footer class="entry-meta clearfix">
									<?php if(!empty($tag_list)){ ?>
									<span class="tag-links">
										<?php   echo $tag_list; ?>
									</span><!-- .tag-links -->
								<?php  } ?>
								</footer><!-- .entry-meta -->
								<?php 
								}else { ?>
									<p><?php the_content(); ?></p>
								</header><!-- .entry-header -->
								<?php } ?>
							</div><!-- .entry-main .post-content -->
						</article>
					<?php } else{ ?>
					<a class="entry-wrap" href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( has_post_thumbnail()): ?>style="background-image:url('<?php echo esc_url(wp_get_attachment_image_url($attachment_id,'full'))?>');" <?php endif; ?>>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
						<span class="sticky-post"><?php _e('Featured','wp-portfolio');?></span>
						<?php } ?>
						<span class ="entry-main">
							<h2 class="entry-title"><?php the_title();?></h2><!-- .entry-title -->
							<?php if (has_category() !=''){?>
							<p><?php  echo substr(get_the_excerpt(),0,126); ?></p>
							<?php }else { ?>
							<p><?php  the_content(); ?></p>
							<?php } ?>
						</span><!-- .entry-main -->
					</a><!-- .entry-wrap -->
					<?php } ?>
					</section><!-- post -->
				<?php do_action( 'wp_portfolio_after_post' );
			}
		} else { ?>
			<h2 class="entry-title">
				<?php _e( 'No Posts Found.', 'wp-portfolio' ); ?>
			</h2>
		<?php } 
	if($wp_portfolio_post_layout !='blog_layout') {	?>
	</div><!-- #post-main -->
	<?php }
	}
endif;
/****************************************************************************************/
if ( ! function_exists( 'wp_portfolio_theloop_for_page' ) ) :
/**
 * Fuction to show the page content.
 */
function wp_portfolio_theloop_for_page() {
	echo '<div class="entry-main">
		<div class="entry-content">';
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
				do_action( 'wp_portfolio_before_post' );
				do_action( 'wp_portfolio_after_post_header' );
				do_action( 'wp_portfolio_before_post_content' );
				the_content(); ?>
				<?php
					wp_link_pages( array( 
					'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'wp-portfolio' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
					) );
				?>
				<?php 
					do_action( 'wp_portfolio_after_post_content' );
					do_action( 'wp_portfolio_before_comments_template' );
					comments_template(); 
					do_action ( 'wp_portfolio_after_comments_template' );
				?>
		<?php
			do_action( 'wp_portfolio_after_post' );
		}
	}
	else { ?>
	<h2 class="entry-title">
		<?php _e( 'No Posts Found.', 'wp-portfolio' ); ?>
	</h2>
<?php
	}
		echo '</div><!-- .entry-content -->
	</div><!-- .entry-main -->';
}
endif;
/****************************************************************************************/
if ( ! function_exists( 'wp_portfolio_theloop_for_single' ) ) :
/**
 * Fuction to show the single post content.
 */
function wp_portfolio_theloop_for_single() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'wp_portfolio_before_post' ); ?>
			<section id="post-<?php the_ID(); ?> clearfix" <?php post_class('clearfix'); ?>>
			<?php do_action( 'wp_portfolio_before_post_header' ); ?>
				<article class="entry-wrap">
					<div class="entry-main">
						<header class="entry-header">
							<?php if(get_the_time( get_option( 'date_format' ) )) { ?>
							<div class="entry-meta">
								<span class="cat-links">
									<?php the_category(', '); ?>
								</span><!-- .cat-links --> 
							</div><!-- .entry-meta -->
							<h2 class="entry-title"><?php the_title();?> </h2> <!-- .entry-title -->
							<div class="entry-meta clearfix">
								<div class="by-author vcard author">
									<span class="fn">
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"  title="<?php  esc_attr(the_author()); ?>">
										<?php the_author(); ?> </a>
									</span>
								</div>
								<div class="date updated"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>">
									<?php the_time( get_option( 'date_format' ) ); ?> </a>
								</div>
								<?php if ( comments_open() ) { ?>
								<div class="comments">
									<?php comments_popup_link( __( 'No Comments', 'wp-portfolio' ), __( '1 Comment', 'wp-portfolio' ), __( '% Comments', 'wp-portfolio' ), '', __( 'Comments Off', 'wp-portfolio' ) ); ?>
								</div>
								<?php } ?>
							</div><!-- .entry-meta --> 
						<?php
							} ?>
						</header><!-- .entry-header -->
						<div class="entry-content clearfix">
							<?php the_content();
							wp_link_pages( array( 
								'before'			=> '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'wp-portfolio' ),
								'after'			=> '</div>',
								'link_before'	=> '<span>',
								'link_after'	=> '</span>',
								'pagelink'		=> '%',
								'echo'			=> 1
							) ); ?>
						</div><!-- entry content clearfix -->
						<?php if( is_single() ) {
							$tag_list = get_the_tag_list( '', __( ', ', 'wp-portfolio' ) ); ?>
						<footer class="entry-meta clearfix">
							<?php if( !empty( $tag_list ) ) { ?>
								<span class="tag-links">
									<?php echo $tag_list;?>
								</span><!-- .tag-links -->
							<?php } ?>
						</footer><!-- .entry-meta -->
						<?php 
						}
							do_action( 'wp_portfolio_before_comments_template' );
							comments_template();
							do_action ( 'wp_portfolio_after_comments_template' );
						?>
					</div><!-- .entry-main -->
				</article>
		</section><!-- .post -->
<?php
			do_action( 'wp_portfolio_after_post_content' );
			do_action( 'wp_portfolio_after_post' );
		}
	}
	else {
	?>
		<h2 class="entry-title">
			<?php _e( 'No Posts Found.', 'wp-portfolio' ); ?>
		</h2>
	<?php
	}
}
endif;
/****************************************************************************************/
if ( ! function_exists( 'wp_portfolio_theloop_for_search' ) ) :
/**
 * Fuction to show the search results.
 */
function wp_portfolio_theloop_for_search() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'wp_portfolio_before_post' ); ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<article class="entry-wrap">
				<?php do_action( 'wp_portfolio_before_post_header' ); ?>
					<div class="entry-main">
						<header class="entry-header">
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
									<?php the_title(); ?>
								</a>
							</h2><!-- .entry-title -->
						</header>
						<?php do_action( 'wp_portfolio_after_post_header' ); ?>
						<?php do_action( 'wp_portfolio_before_post_content' ); ?>
						<div class="entry-content clearfix">
							<?php the_excerpt(); ?>
						</div>
						<?php do_action( 'wp_portfolio_after_post_content' ); ?>
					</div><!-- .entry-main -->
			</article>
		</section>
			<?php do_action( 'wp_portfolio_after_post' );
		}
	}
	else {
		?>
	<h2 class="entry-title">
		<?php _e( 'No Posts Found.', 'wp-portfolio' ); ?>
	</h2>
<?php
	}
}
endif;
/****************************************************************************************/
add_action( 'wp_portfolio_after_loop_content', 'wp_portfolio_next_previous', 5 );
/**
 * Shows the next or previous posts
 */
function wp_portfolio_next_previous() {
	if( is_archive() || is_home() || is_search() ) {
		/**
		 * Checking WP-PageNaviplugin exist
		 */
		if ( function_exists('wp_pagenavi' ) ) :
			wp_pagenavi();
		else: 
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : ?>
				<div class="nav-links clearfix">
					<div class="nav-previous">
						<span class="meta-nav"><?php next_posts_link( __( 'Previous', 'wp-portfolio' ) ); ?></span>
					</div>
					<div class="nav-next">
						<span class="meta-nav"><?php previous_posts_link( __( 'Next', 'wp-portfolio' ) ); ?></span>
					</div>
				</div>
			<?php
			endif;
		endif;
	}
}
/****************************************************************************************/
add_action( 'wp_portfolio_after_post_content', 'wp_portfolio_next_previous_post_link', 10 );
/**
 * Shows the next or previous posts link with respective names.
 */
function wp_portfolio_next_previous_post_link() {
	if ( is_single() ) {
		if( is_attachment() ) {
		?>
		<div class="nav-links clearfix">
			<div class="nav-previous">
				<span class="meta-nav"> <?php previous_image_link( false, __( 'Previous', 'wp-portfolio' ) ); ?> </span>
			</div>
				<div class="nav-next">
					<span class="meta-nav"><?php next_image_link( false, __( 'Next', 'wp-portfolio' ) ); ?></span>
				</div>
			</div>
		<?php
		}
		else {
		?>
		<div class="nav-links clearfix">
			<div class="nav-previous">
				<?php previous_post_link( '%link', '<span class="meta-nav">' . _x( 'Previous', ' post link', 'wp-portfolio' ) . '</span>'. '<span class="screen-reader-text">' . _x( 'Previous post:', 'post link', 'wp-portfolio') . '</span>' . ' <span class="post-title">%title </span>' ); ?>
			</div>
			<div class="nav-next">
				<?php next_post_link( '%link', '<span class="meta-nav">' . _x( 'Next', ' post link', 'wp-portfolio' ) . '</span>'. '<span class="screen-reader-text">' . _x( 'Next post:', 'post link','wp-portfolio') . '</span>'.'<span class="post-title">%title </span>' ); ?>
			</div>
		</div>
<?php
		}
	}
}
/****************************************************************************************/
add_action( 'wp_portfolio_after_loop_content', 'wp_portfolio_loop_after', 10 );
/**
 * Contains the closing div
 */
function wp_portfolio_loop_after() {
	echo '</div><!-- #main -->';
}
/****************************************************************************************/
if ( ! function_exists( 'wp_portfolio_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wp_portfolio_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WP_Portfolio 1.0
 */
function wp_portfolio_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<p>
		<?php _e( 'Pingback:', 'wp-portfolio' ); ?>
		<?php comment_author_link(); ?>
		<?php edit_comment_link( __( '(Edit)', 'wp-portfolio' ), '<span class="edit-link">', '</span>' ); ?>
	</p>
	<?php
		break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<header class="comment-meta comment-author vcard">
			<?php
				echo get_avatar( $comment, 44 );
				printf( '<cite class="fn">%1$s %2$s</cite>',
				get_comment_author_link(),
				// If current post author is also comment author, make it known visually.
				( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'wp-portfolio' ) . '</span>' : ''
				);
				printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
				esc_url( get_comment_link( $comment->comment_ID ) ),
				get_comment_time( 'c' ),
				/* translators: 1: date, 2: time */
				sprintf( __( '%1$s at %2$s', 'wp-portfolio' ), get_comment_date(), get_comment_time() )
				);
			?>
		</header> <!-- .comment-meta -->
		<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation">
				<?php _e( 'Your comment is awaiting moderation.', 'wp-portfolio' ); ?>
			</p>
		<?php endif; ?>
		<section class="comment-content comment">
			<?php comment_text(); ?>
			<?php edit_comment_link( __( 'Edit', 'wp-portfolio' ), '<p class="edit-link">', '</p>' ); ?>
		</section><!-- .comment-content -->
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'wp-portfolio' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply --> 
	</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
?>
