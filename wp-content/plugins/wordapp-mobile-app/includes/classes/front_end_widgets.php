<?php
class WordApp_widget extends WP_Widget {


	/** constructor -- name this the same as the class above */

	public function __construct() {

		parent::__construct(false, $name = 'WordAPP Download our app');
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {
		extract( $args );
		$title   = apply_filters('widget_title', $instance['title']);
		$message  = $instance['message'];
		$message2  = $instance['message2'];
		$varGA = (array)get_option( 'WordApp_ga' );
		if(!isset($varGA['powered'])) $varGA['powered'] ='';

?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
			echo $before_title . $title . $after_title; ?>
							<ul>
								<li><a href="<?php echo $message; ?>"><img src="<?php echo plugins_url(APPNAME.'/images/widget/applestore_en.png')?>"></a></li>
								<li><a href="<?php echo $message2; ?>"><img src="<?php echo plugins_url(APPNAME.'/images/widget/googleplaystore_en.png')?>"></a></li>
							</ul>
							
							
<?php
	if ($varGA['powered'] != 'off') {
?>

<a href="http://wordapp.co" style="float:right"><img  alt="convert wordpress to a mobile app" src="<?php echo plugins_url(APPNAME.'/images/widget/poweredby_en.png')?>"></a>

<?php 
	}
?>
              <?php echo $after_widget; ?>
        <?php
	}

	/** @see WP_Widget::update -- do not rename this */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
		$instance['message2'] = strip_tags($new_instance['message2']);
		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form($instance) {

		$title   = esc_attr($instance['title']);
		$message = esc_attr($instance['message']);
		$message2 = esc_attr($instance['message2']);
?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('iTunes Link'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message2'); ?>"><?php _e('Play Store Link'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('message2'); ?>" name="<?php echo $this->get_field_name('message2'); ?>" type="text" value="<?php echo $message2; ?>" />
        </p>

        <?php
	}


} // end class WordApp_widget

?>