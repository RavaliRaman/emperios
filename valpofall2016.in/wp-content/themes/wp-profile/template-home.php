<?php 
/**
 * Template Name: Home Page
 * Description: 
 */
get_header(); ?>

<?php if (get_theme_mod('wp_profile_display') ) {?>
	<div class="home-profile-thumb">
        <div class="container">
            <div  class="row">
                <div class="col-md-12">
                    <div class="profile-main-image">
                        <?php if ( get_theme_mod( 'wp_profile_featured_photo' ) ) { ?>
                    		<img src="<?php echo esc_url(get_theme_mod( 'wp_profile_featured_photo' )); ?>" alt="" class="aligncenter" />
                        <?php } else {?>
                        	<i class="fa fa-user"></i>
                        <?php } ?>  
                    </div>                             
                    <div class="social-media">
                    	<ul class="clearfix">
                        	<?php if ( get_theme_mod( 'wp_profile_facebook' ) ){ ?>
                        		<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_facebook' ) ); ?>" title="<?php _e('Facebook', 'wp-profile'); ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_twitter' ) ){ ?>
                            	<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_twitter' ) ); ?>" title="<?php _e('Twitter', 'wp-profile'); ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_gplus' ) ){ ?>
                            	<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_gplus' ) ); ?>" title="<?php _e('Google Plus', 'wp-profile'); ?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_linkedin' ) ){ ?>
                            	<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_linkedin' ) ); ?>" title="<?php _e('LinkedIn', 'wp-profile'); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_pinterest' ) ){ ?>
                            	<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_pinterest' ) ); ?>" title="<?php _e('Pinterest', 'wp-profile'); ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_youtube' ) ){ ?> 
                            	<li><a href="<?php echo esc_url( get_theme_mod( 'wp_profile_youtube' ) ); ?>" title="<?php _e('YouTube', 'wp-profile'); ?>"><i class="fa fa-youtube-play"></i></a></li>
                            <?php } ?>
                            <?php if ( get_theme_mod( 'wp_profile_email' ) ) { ?>
                            	<li><a href="<?php _e('mailto:', 'wp-profile'); echo sanitize_email( get_theme_mod( 'wp_profile_email' ) ); ?>" title="<?php _e('Email', 'wp-profile'); ?>"><i class="fa fa-envelope"></i></a></li>
                        	<?php } ?> 
                        </ul>
                        
                    </div>    
                 
                </div>        
            
            </div>
        </div>
	</div>
    <div class="home-profile-details">
    	<div class="container">
            <div  class="row">
                <div class="col-md-12">
					<h1><?php echo get_theme_mod( 'wp_profile_name' ); ?></h1>
					<p><?php echo get_theme_mod( 'wp_profile_short_description' ); ?></p>
                </div>        
            
            </div>
        </div>    	
	</div>
<?php } ?>

    <div class="home-content">
    	<div class="container">
            <div  class="row">
				<?php get_template_part( 'inc/featured-page' ) ?>
            </div>        
            
            </div>
        </div>    	
	</div>
    
	<?php if (get_theme_mod('wp_profile_display_links') ) {?>
        <div class="home-profile-services">
            <div class="container">
                <ul>
                    <?php if ( get_theme_mod( 'wp_profile_resume_url' ) ){ ?>
                    <li>
                        <div class="service_cont orange_b">
                            <a href="<?php echo get_theme_mod( 'wp_profile_resume_url' ); ?>"><?php echo get_theme_mod( 'wp_profile_resume_text' ); ?></a>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'wp_profile_portfolio_url' ) ){ ?>
                    <li>
                        <div class="service_cont blue_b">
                            <a href="<?php echo get_theme_mod( 'wp_profile_portfolio_url' ); ?>"><?php echo get_theme_mod( 'wp_profile_portfolio_text' ); ?></a>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'wp_profile_blog_url' ) ){ ?>
                    <li>
                        <div class="service_cont green_b">
                            <a href="<?php echo get_theme_mod( 'wp_profile_blog_url' ); ?>"><?php echo get_theme_mod( 'wp_profile_blog_text' ); ?></a>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if ( get_theme_mod( 'wp_profile_contact_url' ) ){ ?>
                    <li>
                        <div class="service_cont yellow_b">
                            <a href="<?php echo get_theme_mod( 'wp_profile_contact_url' ); ?>"><?php echo get_theme_mod( 'wp_profile_contact_text' ); ?></a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
	<?php }?>       
	</section>


	

<?php get_footer(); ?>