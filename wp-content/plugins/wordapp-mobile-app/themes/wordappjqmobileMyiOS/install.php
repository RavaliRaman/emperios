<?php

if(DEBUG_WORDAPP):
			echo "Calling install file.";
			echo "Done!";
			echo "Installed : ".$themeType;
			echo 'Requesting json file';
			echo '<pre>';
			print_r($_REQUEST);
			echo '</pre>';
endif;
/* Create main Page */
$url = 'http://52.27.101.150/mobrock/app/jsonThemeOptions.php?option=on&theme='. urlencode($_REQUEST['appThemeSelected']);

$activate = json_decode(wp_remote_retrieve_body(wp_remote_get($url)),true);	
//print_r($activate);

print_r( (DEBUG_WORDAPP) ? $activate : '');


update_option('WordApp_theme_options', json_encode($activate));


//echo get_option('WordApp_theme_options');


$varHomePages = get_option( 'wordapp_mobile_pages_home' );

if($varHomePages == ''){
  
  $my_post = array(
  'post_title'    => 'Mobile Homepage',
  'post_content'  => 'Enter content on this page under the <u>Mobile Pages</u> tab or <br>choose another page under <br> WordApp-> App Builder-> Redirect page<br> <center><img src="http://52.27.101.150/dev/wordpress/wp-content/uploads/2015/12/changeTheme-e1449504203106.png"></center>',
  'post_status'   => 'publish',
	'post_type'     => 'wordapp_mobile_pages'
);
	
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

/* General Settings */


$myOptionsGet = get_option('WordApp_options');
if(empty($myOptionsGet)){
	$myOptionsGet['nothing'] = true;
}	
foreach($myOptionsGet as $option => $value) {
	//echo $option . " => " . $value . "<br />";
	$myOptions[$option] = $value;
}
 if (!isset($_REQUEST['appName'])) { $_REQUEST['appName'] = '';}

	$myOptions['theme'] = $_REQUEST['appThemeSelected'];
	$myOptions['Color'] = '#ffffff';
	$myOptions['style'] = 'page';
	$myOptions['appName'] = $_REQUEST['appName'];
	$myOptions['Title'] = $_REQUEST['appName'];
	$myOptions['local'] = 'local';
	
	$myOptions['page_id'] = $varHomePages;
  
  /* background  settings */
  $myOptions['background'] = 'https://secure.buildapps.biz/mobrock/images/'.$themeType.'/bg.png';;
	
	
update_option('WordApp_options', $myOptions);
	

/* Add Slideshow */
	$varSlideshow = get_option( 'WordApp_slideshow' );
if(empty($varSlideshow)){
	$varSlideshow['nothing'] = true;
}	
    foreach($varSlideshow as $option => $value) {
	
	    $myOptionsSlide[$option] = $value;
      
    }	
$myOptionsSlide['onoff'] = 'on';

$myOptionsSlide['one'] = 'https://secure.buildapps.biz/mobrock/images/'.$themeType.'/slide1.png';
$myOptionsSlide['two'] = 'https://secure.buildapps.biz/mobrock/images/'.$themeType.'/slide2.png';
	
		
update_option('WordApp_slideshow', $myOptionsSlide);
	
/* Add Menus */


$menu_name = 'primary';
$locations = get_nav_menu_locations();
$menu_id = $locations[ $menu_name ] ;

/* Menu  */
$myOptions2Get = get_option('WordApp_menu');
	if(empty($myOptions2Get)){
	$myOptions2Get['nothing'] = true;
}	
foreach($myOptions2Get as $option => $value) {
	
	$myOptions2[$option] = $value;
}	
	
$myOptions2['side'] = 'on';
$myOptions2['menu'] = $menu_id;
	
$myOptions2['bottom'] = 'on';
$myOptions2['menuBottom'] = $menu_id;
	
		
update_option('WordApp_menu', $myOptions2);


/* Options */



?>