<?php
/*
Plugin Name: CloudGuard
Plugin URI: https://wordpress.org/plugins/cloudguard/
Description: Restrict access to your login page using Cloudflare Geolocation.
Author: pipdig
Author URI: https://www.pipdig.co/
Version: 1.4.0
Text Domain: cloudguard
*/

/*
Copyright 2017 pipdig Ltd.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Load languages
function cloudguard_textdomain() {
	load_plugin_textdomain('cloudguard', false, 'cloudguard/lang');
}
add_action('plugins_loaded', 'cloudguard_textdomain');

function cloudguard_php_login_check() {
	if (in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
		
		if (!isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {  // check if Geolocation enabled. If not, bail.
			return;
		} else {
			$attempt_country_code = strip_tags(strtoupper($_SERVER["HTTP_CF_IPCOUNTRY"]));
		}
		
		$options = get_option('cloudguard_options');
		if (empty($options['accepted_country'])) { // check if country code added to options page. If not, bail.
			return;
		} else {
			$accepted_country_list = strip_tags($options['accepted_country']);
			$accepted_country_list = str_replace(" ", "", $accepted_country_list);
			$accepted_country_list = strtoupper($accepted_country_list);
			$accepted_country_list = preg_replace('/,+/', ',', $accepted_country_list); // remove consecutive commas
			$accepted_countries = explode(',',$accepted_country_list); // convert comma list into array
		}
		
		if (!in_array($attempt_country_code, $accepted_countries)) {
			
			$blocked_attempts = get_option('cloudguard_blocked_attempts');

			if (empty($blocked_attempts[$attempt_country_code])) {
				$blocked_attempts[$attempt_country_code] = 1;
			} else {
				$blocked_attempts[$attempt_country_code]++;
			}

			update_option( 'cloudguard_blocked_attempts', $blocked_attempts );
			
			// if redirect option set, redirect to url
			if (!empty($options['cloudguard_redirect'])) {
				wp_redirect(esc_url($options['cloudguard_redirect']), 301);
				die();
			}
			
			// display message to blocked user
			if (!empty($options['cloudguard_message'])) {
				$message = strip_tags($options['cloudguard_message']);  // need to escape
			} else {
				$message = 'Access denied.';
			}
			
			// status code
			/*
			$status_code = absint($options['cloudguard_status'])
			if (!$status_code) {
				$status_code = 403;
			}
			*/
			
			$status_code = 403;
			status_header($status_code);
			wp_die($message);
		}

	}
	return;
}
add_action('init', 'cloudguard_php_login_check');


function cloudguard_plugin_action_links($links) {
   $links[] = '<a href="'.get_admin_url(null, 'options-general.php?page=cloudguard').'">'.__('Settings', 'cloudguard').'</a>';
   return $links;
}
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'cloudguard_plugin_action_links' );


function cloudguard_admin_menu() {
	global $submenu;
	add_submenu_page('options-general.php', 'CloudGuard', 'CloudGuard', 'manage_options', 'cloudguard', 'cloudguard_options_page');
}
add_action('admin_menu', 'cloudguard_admin_menu', 99);


function cloudguard_options_init() { 
	register_setting('cloudguard_page', 'cloudguard_options');
	add_settings_section(
		'cloudguard_page_section', 
		'', // title
		'cloudguard_options_section_callback', 
		'cloudguard_page'
	);
	add_settings_field( 
		'cloudguard_country_code', 
		__('2 Letter Country Code', 'cloudguard'), 
		'cloudguard_country_code_render', 
		'cloudguard_page', 
		'cloudguard_page_section' 
	);
	add_settings_field( 
		'cloudguard_message', 
		__('Message to display to user when blocked by CloudGuard (Optional)', 'cloudguard'), 
		'cloudguard_message_render', 
		'cloudguard_page', 
		'cloudguard_page_section' 
	);
	add_settings_field( 
		'cloudguard_redirect', 
		__('URL to redirect user to when blocked by CloudGuard (Optional)', 'cloudguard'), 
		'cloudguard_redirect_render', 
		'cloudguard_page', 
		'cloudguard_page_section' 
	);
}
add_action('admin_init', 'cloudguard_options_init');



function cloudguard_country_code_render() { 
	$options = get_option('cloudguard_options');
	$accepted_country = strip_tags($options['accepted_country']);
	?>
	<input type="text" name="cloudguard_options[accepted_country]" id="country_code" <?php if (!empty($accepted_country)) { ?>style="text-transform: uppercase;" <?php } ?> placeholder="<?php echo esc_attr(__('For example: US', 'cloudguard')); ?>" value="<?php if (isset($accepted_country)) { echo $accepted_country; } ?>"/>
	<script>
	document.getElementById('country_code').onkeyup = function(event) {
		this.value = this.value.replace(/[^a-zA-Z,]/g, '');
	}
	</script>
	<?php
}

function cloudguard_message_render() {
	$options = get_option('cloudguard_options');
	$cloudguard_message = strip_tags($options['cloudguard_message']);
	?>
	<input type="text" name="cloudguard_options[cloudguard_message]" placeholder="<?php echo esc_attr(__('Default: Access denied.', 'cloudguard')); ?>" value="<?php if (!empty($cloudguard_message)) { echo $cloudguard_message; } ?>"/>
	<?php
}

function cloudguard_redirect_render() {
	$options = get_option('cloudguard_options');
	$cloudguard_redirect = esc_url($options['cloudguard_redirect']);
	?>
	<input type="url" name="cloudguard_options[cloudguard_redirect]" placeholder="e.g. https://www.google.com" value="<?php if (!empty($cloudguard_redirect)) { echo $cloudguard_redirect; } ?>"/>
	<span>If you'd like to automatically redirect countries that do not have access.</span>
	<?php
}


function cloudguard_options_section_callback() {
	?><p><?php printf( __('Enter the <a href="%s" target="_blank">2 digit code</a> of the country you wish to <b>ALLOW</b> access from.', 'cloudguard'), esc_url('http://data.okfn.org/data/core/country-list') ); ?></p><?php 
	?><p><?php _e('You can allow access to multiple countries by entering a comma separated list. For example: GB,US,AU', 'cloudguard'); ?></p><?php 
	?><p><?php _e('All <b>other</b> countries will be blocked from accessing the login/register page.', 'cloudguard'); ?></p><?php 
	if (isset($_SERVER['HTTP_CF_IPCOUNTRY'])){ ?><p><?php _e('Your current location:', 'cloudguard'); ?> <?php echo strip_tags(strtoupper($_SERVER["HTTP_CF_IPCOUNTRY"])); ?></p><?php }  
}

function cloudguard_options_page() { ?>

	<div class="wrap">
	
	<style scoped>
		.wrap input[type="text"], .wrap input[type="url"] { width: 280px; max-width: 100%; }
	</style>
	
	<h1><?php _e('CloudGuard Settings', 'cloudguard'); ?></h1>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-1">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<div class="inside">
						
						<?php if (!isset($_SERVER['HTTP_CF_IPCOUNTRY'])) { // check if CF geo active ?>

							<h3><?php _e('Settings currently disabled. You will need to complete the steps below to enable the use of this plugin:'); ?></h3>
							
								<ol>
									<li><?php printf( __('Enable <a href="%s" target="_blank">Geolocation</a> for this site in your Cloudflare dashboard.', 'cloudguard'), esc_url('https://support.cloudflare.com/hc/en-us/articles/200168236-What-does-CloudFlare-IP-Geolocation-do-') ); ?></li>
								</ol>

						
						<?php } else { // cloudflare geo enabled, let's display options: ?>
						
							<form action='options.php' method='post'>
							<?php
							settings_fields('cloudguard_page');
							do_settings_sections('cloudguard_page');
							submit_button();
							?>
							</form>
							<?php 
							
						} //end if for cloudlare geo
						?>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->
					
					
					<?php
					$options = get_option('cloudguard_options');
					if (isset($_SERVER['HTTP_CF_IPCOUNTRY']) && !empty($options['accepted_country'])) { // check if CF geo active
					
					$accepted_country_list = strip_tags($options['accepted_country']);
					$accepted_country_list = str_replace(" ", "", $accepted_country_list);
					$accepted_country_list = strtoupper($accepted_country_list);
					$accepted_countries = explode(',',$accepted_country_list); //convert comma list into array
					$blocked_attempts = get_option('cloudguard_blocked_attempts');
					?>
					<div class="postbox">
						<div  style="text-align: center">
						<?php
							if (!empty($blocked_attempts)) {
								?>
								<h3><?php _e('CloudGuard has protected your website from:', 'cloudguard'); ?></h3>
							<?php } else { ?>
								<h3><?php _e('This area will display blocked login attempts over time.', 'cloudguard'); ?></h3>
								<p><?php printf( __('Want to test if CloudGuard is working? try entering your login url to <a href="%s" target="_blank">gtmetrix.com</a>.', 'cloudguard'), esc_url('https://gtmetrix.com/') ); ?></p>
								<p>(<?php _e('This will send a login attempt from Canada by default. If you have allowed access from CA, you can change the location on that page. Useful, eh?', 'cloudguard'); ?>)</p>
							<?php } ?>
						</div>
						<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ammaps/3.13.0/ammap.js"></script>
						<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ammaps/3.13.0/maps/js/worldLow.js"></script>

						<!-- amCharts javascript code -->
						<script type="text/javascript">
							AmCharts.makeChart("map",{
									"type": "map",
									"pathToImages": "https://www.amcharts.com/lib/3/images/",
									"addClassNames": true,
									"fontSize": 14,
									"color": "#ffffff",
									"backgroundAlpha": 1,
									"backgroundColor": "rgba(255,255,255,0)",
									"dataProvider": {
										"map": "worldLow",
										"getAreasFromMap": true,
										"areas": [
											<?php
											foreach ($blocked_attempts as $country => $attempts) {
												if ($attempts <= 2) {
													$opacity = '0.2';
												} elseif ($attempts > 2 && $attempts <= 5) {
													$opacity = '0.25';
												} elseif ($attempts > 5 && $attempts <= 10) {
													$opacity = '0.3';
												} elseif ($attempts > 10 && $attempts <= 20) {
													$opacity = '0.35';
												} elseif ($attempts > 20 && $attempts <= 35) {
													$opacity = '0.4';
												} elseif ($attempts > 35 && $attempts <= 50) {
													$opacity = '0.45';
												} elseif ($attempts > 50 && $attempts <= 75) {
													$opacity = '0.5';
												} elseif ($attempts > 75 && $attempts <= 125) {
													$opacity = '0.6';
												} elseif ($attempts > 125 && $attempts <= 250) {
													$opacity = '0.68';
												} elseif ($attempts > 250 && $attempts <= 500) {
													$opacity = '0.8';
												} elseif ($attempts > 500 && $attempts <= 750) {
													$opacity = '0.9';
												} elseif ($attempts > 750) {
													$opacity = '0.98';
												}
											echo '
											{
												"id": "'.esc_attr($country).'",
												"title": "'.$attempts.' '.__('blocked from', 'cloudguard').' '.cloudguard_code_to_country($country).'",
												"color": "rgba(204, 33, 39,'.$opacity.')"
											}, ';
											}
											foreach ($accepted_countries as $accepted_country) { ?>
											{
												"id": "<?php echo esc_attr($accepted_country); ?>",
												"title": "<?php echo esc_attr(__('Access granted:', 'cloudguard')); ?> <?php echo cloudguard_code_to_country($accepted_country); ?>",
												"color": "rgba(202, 223, 170,1)"
											},
											<?php } // end foreach ?>
										]
									},
									"balloon": {
										"horizontalPadding": 15,
										"borderAlpha": 0,
										"borderThickness": 1,
										"verticalPadding": 15
									},
									"areasSettings": {
										"color": "rgba(170, 170, 170,0.5)",
										"outlineColor": "rgba(80,80,80,0)",
										"rollOverOutlineColor": "rgba(80,80,80,1)",
										"rollOverBrightness": 20,
										"selectedBrightness": 20,
										"selectable": false,
										"unlistedAreasAlpha": 0,
										"unlistedAreasOutlineAlpha": 0
									},
									"zoomControl": {
										"zoomControlEnabled": true,
										"homeButtonEnabled": false,
										"panControlEnabled": false,
										"right": 38,
										"bottom": 30,
										"minZoomLevel": 0.25,
										"gridHeight": 100,
										"gridAlpha": 0.1,
										"gridBackgroundAlpha": 0,
										"gridColor": "#ffffff",
										"draggerAlpha": 1,
										"buttonCornerRadius": 2
									}
								});
						</script>

						<div id="map" style="width: 90%; height: 450px; margin: 20px;"></div>
						
					</div>
					<!-- .postbox -->
					<?php } // end if CF plugin and geo active ?>
				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

		</div>
		<!-- #post-body .metabox-holder .columns-1 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->

<?php	
}



// dashboard widget
function cloudguard_dash_widgets() {
	add_meta_box( 
		'cloudguard_dash_widget',
		'CloudGuard',
		'cloudguard_dash_widget_func',
		'dashboard',
		'side',
		'high'
	);
}
add_action( 'wp_dashboard_setup', 'cloudguard_dash_widgets' );

function cloudguard_dash_widget_func() {
	
	if (current_user_can('manage_options')) {
		// clear stats if button clicked
		if (isset($_POST['cloudguard_clear_log'])) {
			delete_option('cloudguard_blocked_attempts');
			echo '<div id="message" class="updated fade"><p>'. __('CloudGuard stats have been cleared', 'cloudguard'). '</p></div>';
		}
	}
	
	$blocked_attempts = get_option('cloudguard_blocked_attempts');
	
	if (!empty($blocked_attempts)) {
	
		arsort($blocked_attempts);
		echo '<p>'.__('Top 5 login attempts blocked by CloudGuard:', 'cloudguard').'</p>';
		echo '<style scoped>.cg_flag{position:relative;top:3px}</style>';
		$i = $top_blocked = 0;
		foreach ($blocked_attempts as $country => $attempts) {
			echo '<p><img class="cg_flag" src="https://pipdigz.co.uk/flags/'.strtolower($country).'.png" alt=""/> '.cloudguard_code_to_country($country).' ('.absint($attempts).')</p>';
			if ($i == 0) {
				$top_blocked = absint($attempts);
			}
			if (++$i == 5) break;
		}
		if (current_user_can('manage_options')) {
			echo '<p><a href="'.get_admin_url(null, 'options-general.php?page=cloudguard').'">'.__('Click here for more statistics', 'cloudguard').'</a></p>';
		}
		
		if (current_user_can('manage_options')) {
		?>
			<form action="index.php" method="post">
				<?php wp_nonce_field('cloudguard-nonce'); ?>
				<input type="hidden" value="true" name="cloudguard_clear_log" />
				<p class="submit">
					<input name="submit" class="button" value="<?php echo esc_attr(__('Clear stats', 'cloudguard')); ?>" type="submit" />
				</p>
			</form>
		<?php
			// show some love if more than 75 blocks have been successful
			if (!get_option('cloudguard_nag') && ($top_blocked > 75)) {
				?>
				<div id="cloudguard_nag_wrapper">
				<hr style="margin-top: 30px">
				<p><strong>It looks like CloudGuard is working very well on your site!</strong></p>
				<p>Would you like to <a href="https://wordpress.org/support/plugin/cloudguard/reviews/?rate=5#new-post" target="_blank">leave a rating</a>? This will help us to provide continued support and updates.</p>
				<p><a href="https://wordpress.org/support/plugin/cloudguard/reviews/?rate=5#new-post" target="_blank" class="button">Leave a rating</a> <a href="#" id="cloudguard_remove_nag" class="button">Remove this notice</a></p>
				</p>
				
				<script>
				jQuery(document).ready(function($) {
					$('#cloudguard_remove_nag').click(function(e) {
						var data = {action: 'cloudguard_nag_ajax'};
						$.post(ajaxurl, data, function(response) {
							//alert(response);
							$('#cloudguard_nag_wrapper').fadeOut(500);
						});
					});
				});
				</script>
				</div>				
			<?php
			} // endif nag checker
		
		}
	
	} else {
		echo '<p>'.sprintf( __('This widget will display recent login attempts blocked by <a href="%s" target="_blank">CloudGuard</a>.', 'cloudguard'), esc_url('https://wordpress.org/plugins/cloudguard/') ).'</p>';
	}
}


function cloudguard_nag_ajax_callback() {
	update_option('cloudguard_nag', 1);
	//echo 'heeeey';
	wp_die();
}
add_action( 'wp_ajax_cloudguard_nag_ajax', 'cloudguard_nag_ajax_callback' );


function cloudguard_code_to_country($code){

	$code = strtoupper($code);

	$countryList = array(
		'AF' => 'Afghanistan',
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BQ' => 'Bonaire, Saint Eustatius and Saba',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CW' => 'Curacao',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'CD' => 'Democratic Republic of the Congo',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'TL' => 'East Timor',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island and McDonald Islands',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'CI' => 'Ivory Coast',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'XK' => 'Kosovo',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Laos',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'KP' => 'North Korea',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'CG' => 'Republic of the Congo',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russia',
		'RW' => 'Rwanda',
		'BL' => 'Saint Barthelemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent and the Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome and Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SX' => 'Sint Maarten',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia and the South Sandwich Islands',
		'KR' => 'South Korea',
		'SS' => 'South Sudan',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard and Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syria',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'VI' => 'U.S. Virgin Islands',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UM' => 'United States Minor Outlying Islands',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VA' => 'Vatican',
		'VE' => 'Venezuela',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe',
	);

	if(!$countryList[$code]) return $code;
	else return $countryList[$code];
}