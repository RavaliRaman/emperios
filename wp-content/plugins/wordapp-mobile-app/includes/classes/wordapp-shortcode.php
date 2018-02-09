<?php
/**
 * WordApp - Home Page class
 * - over write homepage settings
 */

class WordAppShortcode {


	/**
	 * constructor - sets up actions & filters
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {


	}

	function wordapp_get_shortcode(){
		global $post;
		//the_content();
		return true;

	}

	function wordapp_shortcode_is_mobile( $atts, $content = "" ) {

		if(wp_is_mobile ()):

			return "$content";

		endif;


	}
	/*****
	QRCODE READER
	*****/

	function wordapp_qrcodeReaderShortcode($atts, $content = null)
	{
		$a = shortcode_atts(array('buttontext' => 'Scan QR Code', 'url' => 'http://google.com/'), $atts);

		return '<button  id="qrcodebutton" ng-click="appQRreader(\''.$a['url'].'\');" >'.$a['buttontext'].'</button>';
	}

	/*****
SOCIAL SHARE
*****/

	function wordapp_socialShareShortcode($atts, $content = null)
	{
		$a = shortcode_atts(array('buttontext' => 'Share with friends', 'url' => 'http://google.com/', 'subject' => 'Go visit our app', 'message' => 'Find our amazing app. Powered by WordApp'), $atts);

		return '<button  id="socialsharebutton" ng-click="appShare(\''.$a['message'].'\',\''.$a['subject'].'\',\''.$a['url'].'\');" >'.$a['buttontext'].'</button>';
	}
	/*****
Rate My App
*****/

	function wordApp_rateMyApp($atts, $content = null)
	{
		$a = shortcode_atts(array('buttontext' => 'Rate our app', 'url' => 'http://google.com/'), $atts);

		return '<button  id="ratemyapp" ng-click="appRateMyApp(\''.$a['url'].'\');" >'.$a['buttontext'].'</button>';
	}

	/*****
	MAPS
	*****/

	function wordapp_googleMapShortcode($atts, $content = null)
	{
		extract(shortcode_atts(array("id" => 'myMap', "type" => 'road', "latitude" => '36.394757', "longitude" => '-105.600586', "zoom" => '9', "message" => 'This is the message...', "width" => '300', "height" => '300'), $atts));

		$mapType = '';
		if($type == "satellite")
			$mapType = "SATELLITE";
		else if($type == "terrain")
				$mapType = "TERRAIN";
			else if($type == "hybrid")
					$mapType = "HYBRID";
				else
					$mapType = "ROADMAP";

				echo '

    <!-- Google Map -->
        <script type="text/javascript">
        jQuery(document).ready(function() {
          function initializeGoogleMap() {

              var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
              var myOptions = {
                center: myLatlng,
                zoom: '.$zoom.',
                mapTypeId: google.maps.MapTypeId.'.$mapType.'
              };
              var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);

              var contentString = "'.$message.'";
              var infowindow = new google.maps.InfoWindow({
                  content: contentString
              });

              var marker = new google.maps.Marker({
                  position: myLatlng
              });

              google.maps.event.addListener(marker, "click", function() {
                  infowindow.open(map,marker);
              });

              marker.setMap(map);

          }
          initializeGoogleMap();

        });
        </script>';

			return '<div id="'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}




	/**********
	Contact Form
	*/


	function wordapp_deliver_mail($senttext) {

		// if the submit button is clicked, send the email
		if ( isset( $_POST['cf-wordapp-submitted'] ) ) {

			// sanitize form values
			$name    = sanitize_text_field( $_POST["cf-wordapp-name"] );
			$email   = sanitize_email( $_POST["cf-wordapp-email"] );
			$subject = sanitize_text_field( $_POST["cf-wordapp-subject"] );
			$message = esc_textarea( $_POST["cf-wordapp-message"] );

			// get the blog administrator's email address
			$to = get_option( 'admin_email' );

			$headers = "From: $name <$email>" . "\r\n";

			// If email has been process for sending, display a success message
			if ( wp_mail( $to, $subject, $message, $headers ) ) {
				echo '<div>';
				echo '<p>'.$senttext.'</p>';
				echo '</div>';
			} else {
				echo 'An unexpected error occurred';
			}
		}
	}

	function wordapp_contact_shortcode($atts) {


		extract(shortcode_atts(array("id" => 'contatctForm', "yournametext" => 'Your Name', "youremailtext" => 'Your Email', "subjecttext" => 'Subject', "messagetext" =>  'Your Message', "sendtext" =>  'Send', "senttext" =>  'Thanks for contacting me, expect a response soon.'), $atts));

		ob_start();
		$this->wordapp_deliver_mail($senttext);

		echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
		echo '<p>';

		echo '<input type="text" name="cf-wordapp-name" placeholder="'.$yournametext.'" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-wordapp-name"] ) ? esc_attr( $_POST["cf-wordapp-name"] ) : '' ) . '" size="40" />';
		echo '</p>';
		echo '<p>';

		echo '<input type="email" placeholder="'.$youremailtext.'" name="cf-wordapp-email" value="' . ( isset( $_POST["cf-wordapp-email"] ) ? esc_attr( $_POST["cf-wordapp-email"] ) : '' ) . '" size="40" />';
		echo '</p>';
		echo '<p>';

		echo '<input type="text" name="cf-wordapp-subject" placeholder="'.$subjecttext.'" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-wordapp-subject"] ) ? esc_attr( $_POST["cf-wordapp-subject"] ) : '' ) . '" size="40" />';
		echo '</p>';
		echo '<p>';

		echo '<textarea rows="10" cols="35" name="cf-wordapp-message" placeholder="'.$messagetext.'" >' . ( isset( $_POST["cf-wordapp-message"] ) ? esc_attr( $_POST["cf-wordapp-message"] ) : '' ) . '</textarea>';
		echo '</p>';
		echo '<p><button type="submit"  class="btn btn-primary btn-block" name="cf-wordapp-submitted">'.$sendtext.'</button></p>';
		echo '</form>';

		return ob_get_clean();
	}

	/*
	END Contact Form
	*/



	function wordapp_phone_shortcode($atts) {


		extract(shortcode_atts(array("id" => 'phoneForm', "number" => '000000', "text" => 'Call Us!'), $atts));

		ob_start();

		echo '<p><a href="tel:'.$number.'"  class="btn btn-positive btn-block"><i class="fa fa-phone"></i>  '.$text.'</a></p>';


		return ob_get_clean();
	}


}
