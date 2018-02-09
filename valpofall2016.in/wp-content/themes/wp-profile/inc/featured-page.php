<?php  $selected_page = get_theme_mod( 'wp_profile_about_me'); ?>	

<?php if($selected_page > 1){ ?>
    <div class="about-entry">
		<?php
        query_posts(array(
            'p' => $selected_page,
            'post_type' => 'page',
        ));
        ?>
                            
        <?php if (have_posts()) : ?>           
            <?php while (have_posts()) : the_post(); ?> 
                <?php the_title( '<h1>', '</h1>' ); ?>
                <?php the_content(); ?>
            <?php endwhile; ?> 
        <?php endif; ?> 
        <?php wp_reset_query(); ?>
    </div>
<?php } ?>
