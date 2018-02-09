<?php

if($_GET['resetPages'] == '1'){
  echo "All done! Added new pages.";
  $my_post = array(
  'post_title'    => 'Mobile Homepage',
  'post_content'  => 'Enter content on this page under the <u>Mobile Pages</u> tab or <br>choose another page under <br> WordApp-> App Builder-> Redirect page<br> <center><img src="http://52.27.101.150/dev/wordpress/wp-content/uploads/2015/12/changeTheme-e1449504203106.png"></center>',
  'post_status'   => 'publish',
	'post_type'     => 'wordapp_mobile_pages'
);
$wp_error = '';	
$post_ID_home = wp_insert_post( $my_post, $wp_error ); 
update_option( 'wordapp_mobile_pages_home', $post_ID_home);
$varHomePages = $post_ID_home;
$post = get_post($post_ID_home);
$slug = $post->post_name;
update_option( 'wordapp_mobile_pages_home_slug', $slug);
	
$my_post = array(
  'post_title'    => 'Contact us',
  'post_content'  => '[wordApp_googlemap id="myMap" zoom="9" latitude="51.507351" longitude="-0.127758" message="We are here" width="100%"]<hr /><h3>Contact us via email</h3>[wordApp_contact_form yournametext="Your Name" youremailtext="Your Email" subjecttext="Subject" messagetext="Your Message" sendtext="Send" senttext="Thanks for contacting me, expect a response soon."]<h3>Opening Hours</h3><blockquote><strong>Monday</strong>: 9am - 5pm<strong>Tuesday</strong>: 9am - 5pm<strong>Wednesday</strong>: 9am - 5pm<strong>Thursday</strong>: 9am - 5pm<strong>Friday</strong>: 9am - 5pm</blockquote>[wordApp_tel number="000000" text="Call us"]',
 	'post_status'   => 'publish',
	'post_type'     => 'wordapp_mobile_pages'
);
	
$post_ID_contact = wp_insert_post( $my_post, $wp_error ); 
update_option( 'wordapp_mobile_pages_contact', $post_ID_contact);
	
}


?>