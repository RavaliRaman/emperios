<?php if(have_comments()) : ?>
	<a name="comments"></a>
	<h3 id="comments-title"><?php _e('Comments', 'snapshot') ?></h3>
	<ul id="comment-list">
		<?php
		wp_list_comments(array(
			'callback' => 'snapshot_single_comment'
		))
		?>
	</ul>
	<?php if(get_option('page_comments') && get_comment_pages_count() > 1) : ?>
		<div id="comment-navigation">
			<?php paginate_comments_links(); ?>
		</div>
	<?php endif; ?>
<?php endif ?>

<?php if ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<div id="comments-closed">
		<p><?php _e('Comments Are Closed', 'snapshot') ?></p>
	</div>
<?php endif ?>

<?php
$commenter = wp_get_current_commenter();
$required = ( get_option( 'require_name_email' , true) ? " required='required'" : '' );
comment_form(array(
	'fields' => array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'snapshot' ) . '</label>' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $required . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' , 'snapshot' ) . '</label>' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $required . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' , 'snapshot' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	),
	'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea>',
	'comment_notes_after' => '',
));
?>