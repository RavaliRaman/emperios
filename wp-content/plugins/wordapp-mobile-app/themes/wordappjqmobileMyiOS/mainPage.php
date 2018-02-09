<?php



### Variables
$links_text = '';

### Load Print Post/Page Template
$varColor = (array)get_option( 'WordApp_options' );
if (strpos($varColor['theme'], '|') !== false) {
			list($themeSelected, $themeType) = explode('|', $varColor['theme']);
		}else{
			$themeSelected = $varColor['theme'];
			$themeType = '';
		}


if(file_exists(dirname( __FILE__ ) .'/main-'.$themeType.'.php')) {
	include(dirname( __FILE__ ) .'/main-'.$themeType.'.php');
} else {
	include(WORDAPP_DIR.'/themes/wordappjquerymobileMyiOS/main-'.$themeType.'.php');
}