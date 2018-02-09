		</div> <!--end main-container-->
    </div><!-- end main-wrap -->  
      
    <footer id="footer">
    	<div id="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">                    
                    	<?php dynamic_sidebar('footer-one-widget'); ?>
                    </div>
                    <div class="col-md-4">                    
                    	<?php dynamic_sidebar('footer-two-widget'); ?>
                    </div>
                    <div class="col-md-4">                    
                    	<?php dynamic_sidebar('footer-three-widget'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">                    
                        <p><?php echo __('&copy; ', 'wp-profile') . esc_attr( get_bloginfo( 'name', 'display' ) );  ?>
                        <?php if(is_home() || is_front_page()){?>            
                            <?php _e('- Powered by ', 'wp-profile'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wp-profile' ) ); ?>" title="<?php esc_attr_e( 'WordPress' ,'wp-profile' ); ?>"><?php _e('WordPress' ,'wp-profile'); ?></a>
                            <?php _e(' and ', 'wp-profile'); ?><a href="<?php echo esc_url( __( 'http://invictusthemes.com/', 'wp-profile' ) ); ?>"><?php _e('Invictus Themes', 'wp-profile'); ?></a>
                        <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>