<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WP Profile
 */

get_header();
?>
<header class="entry-header">
    	<div class="container">
			<h1 class="entry-title"><?php _e('Oops! That page can&rsquo;t be found.', 'wp-profile'); ?></h1>
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
        <div class="row">
            <div class="page-content col-md-9">
                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-profile'); ?></p>
    
                <?php get_search_form(); ?>
    
                <?php the_widget('WP_Widget_Recent_Posts'); ?>
    
                <?php if ( wp_profile_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
                <div class="widget widget_categories">
                    <h2 class="widget-title"><?php _e('Most Used Categories', 'wp-profile'); ?></h2>
                    <ul>
                    <?php
                        wp_list_categories( array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => 1,
                            'title_li'   => '',
                            'number'     => 10,
                        ) );
                    ?>
                    </ul>
                </div><!-- .widget -->
                <?php endif; ?>
    
                <?php
                    /* translators: %1$s: smiley */
                    $archive_content = '<p>' . sprintf( __('Try looking in the monthly archives. %1$s', 'wp-profile'), convert_smilies( ':)' ) ) . '</p>';
                    the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
                ?>
    
                <?php the_widget('WP_Widget_Tag_Cloud'); ?>
    
            </div><!-- .page-content -->			
        	<div class="col-md-3 ">
                <aside id="widget" class="widget-container">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
