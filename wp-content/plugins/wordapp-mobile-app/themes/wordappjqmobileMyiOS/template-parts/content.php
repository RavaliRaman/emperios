<?php
/**
 * Template part for displaying posts.
 *
 * @package WordAppjqmobile
 */


$data = (array)get_option( 'WordApp_options' );

 if(!isset($data['style'])) $data['style']='';

if($data['style'] == 'tiles'){

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="box" style="text-align: left;">
	<a href="<?php echo esc_url( get_permalink()  ); ?>" rel="bookmark"   class="boxLink">
	<div class="boxImgDiv">
							<?php 
		$default_attr = array('class' => "imgBox");
		echo get_the_post_thumbnail(get_the_ID(),'post-thumbnail', $default_attr) ?> 
		 <h2 class="boxH2"><span class="boxH2span"><?php the_title(); ?></span></h2></div>
			
		
			<p class="txtBox"><?php the_excerpt(); ?></p>
						<div class="boxFoot"><span class="time"><?php if ( 'post' == get_post_type() ) : ?>
		
		
		<?php endif; ?></span>
					</a>
				</div>
<?php	
}
else{
	
	?>
	<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="<?php echo esc_url( get_permalink()  ); ?>" rel="bookmark" >
						<?php 
				$default_attr = array('class' => "imgBoxList");
		echo get_the_post_thumbnail(get_the_ID(),array('200','200'),$default_attr ) ?> 
						<p class="ui-li-aside" style="display:none"><?php echo  the_date('d-m-Y'); ?></p>
						<h3><?php echo the_title(); ?></h3>
						<p><strong><?php  the_excerpt(get_the_ID()); ?></strong></p>
						<div style="display:none"><?php  the_excerpt(get_the_ID()); ?></div>
						
					</a>
				</li>

	<?php
}
?>		
