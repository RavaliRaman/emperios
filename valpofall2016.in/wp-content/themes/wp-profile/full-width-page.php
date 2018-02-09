<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 */
 
get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
    <header class="entry-header">
    	<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </div>				
    </header><!-- .entry-header -->
    <div class="breadcrumb-container">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
					<?php wp_profile_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
		<?php get_template_part( 'content', 'full-page' ); ?>			
	</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>