<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
<div id="sidebar" class="clearfix">

	<?php if(is_archive()){ ?>
		<?php if(is_active_sidebar('archives-sidebar')) { ?>
			<?php dynamic_sidebar('archives-sidebar'); ?>
		<?php } else { ?>
        	<?php dynamic_sidebar( 'defaul-sidebar' ); ?>
        <?php } ?>
    <?php } elseif(is_single()) { ?>
    	<?php if(is_active_sidebar('post-sidebar')) { ?>
			<?php dynamic_sidebar('post-sidebar'); ?>
		<?php } else { ?>
        	<?php dynamic_sidebar( 'defaul-sidebar' ); ?>
        <?php } ?>
        
    <?php } elseif (is_page() ) { ?>
    	<?php if(is_active_sidebar('page-sidebar')) { ?>
			<?php dynamic_sidebar('page-sidebar'); ?>
		<?php } else { ?>
        	<?php dynamic_sidebar('defaul-sidebar'); ?>
        <?php } ?>
    
    <?php } else {?>
    		<?php dynamic_sidebar('defaul-sidebar'); ?>
    <?php } ?>
    
    
</div>
<!-- END sidebar -->