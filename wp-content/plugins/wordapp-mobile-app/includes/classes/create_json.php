<?php

class WordAppClass_json  {

	/*--  JSON RETURN --*/
	public function __construct() {

	}

	/*--  JSON RETURN --*/
	function WordApp_produce_my_json() {

		if (!empty($_GET['wordapp_download'])) {
			$varGA = (array)get_option( 'WordApp_ga' ); // Settings page

			if(!isset($varGA['iOSURL']))$varGA['iOSURL']="";
			if(!isset($varGA['androidURL']))$varGA['androidURL']="";

			$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
			$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
			$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
			$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

			//do something with this information
			if( $iPod || $iPhone ){
				header('Location: '.$varGA['iOSURL']);
				exit;
				//browser reported as an iPhone/iPod touch -- do something here
			}else if($iPad){
					header('Location: '.$varGA['iOSURL']);
					exit;
					//browser reported as an iPad -- do something here
				}else if($Android){

					header('Location: '.$varGA['androidURL']);
					exit;
					//browser reported as an Android device -- do something here
				}else if($webOS){
					//browser reported as a webOS device -- do something here
				}else{

			}

		}
		if (!empty($_GET['wp_apppp'])) {


			/* terrible declarations to be shorted out asap */
			if(!isset($jsonpost)) $jsonpost = "";
			if(!isset($varColor)) $varColor = "";
			if(!isset($varGA)) $varGA = "";
			if(!isset($varMenu)) $varMenu = "";
			if(!isset($varStructure)) $varStructure = "";
			if(!isset($varSlideshow)) $varSlideshow = "";

			if(!isset($jsonpost["name"])) $jsonpost['name']="";
			if(!isset($jsonpost["title"])) $jsonpost["title"]="";
			if(!isset($jsonpost["color"])) $jsonpost["color"] ="";
			if(!isset($jsonpost["logo"])) $jsonpost['logo']="";
			if(!isset($jsonpost["style"])) $jsonpost['style']="";
			if(!isset($jsonpost["page_id"])) $jsonpost['page_id']="";
			if(!isset($jsonpost["menu"])) $jsonpost['menu']="";
			if(!isset($jsonpost["menuTop"])) $jsonpost['menuTop']="";
			if(!isset($jsonpost["menuBottom"])) $jsonpost['menuBottom']="";
			if(!isset($jsonpost["bottom"])) $jsonpost['bottom']="";
			if(!isset($jsonpost["side"])) $jsonpost['side']="";
			if(!isset($jsonpost["top"])) $jsonpost['top']="";
			if(!isset($jsonpost["google"])) $jsonpost['google']="";
			if(!isset($jsonpost["slideActive"])) $jsonpost["slideActive"]="";
			if(!isset($jsonpost["slide"][0])) $jsonpost["slide"][0] ="";
			if(!isset($jsonpost["slide"][1])) $jsonpost["slide"][1] ="";
			if(!isset($jsonpost["slide"][2])) $jsonpost["slide"][2] ="";
			if(!isset($jsonpost["slide"][3])) $jsonpost["slide"][3] ="";
			if(!isset($jsonpost["slide"][4])) $jsonpost["slide"][4] ="";
			if(!isset($jsonpost["icon"])) $jsonpost['icon']="";
			if(!isset($jsonpost["splash"])) $jsonpost['splash']="";
			if(!isset($jsonpost["description"])) $jsonpost['description']="";
			if(!isset($jsonpost["cat"])) $jsonpost['cat']="";
			if(!isset($jsonpost["keywords"])) $jsonpost['keywords']="";


			$jsonpost = array();
			$jsonpost["id"] = "mobileApp";

			$varColor = (array)get_option( 'WordApp_options' );
			$varGA = (array)get_option( 'WordApp_ga' ); // Settings page
			$varMenu = (array)get_option( 'WordApp_menu' );
			$varStructure = (array)get_option( 'WordApp_structure' );
			$varSlideshow = (array)get_option( 'WordApp_slideshow' );




			if(!isset($varColor['Title']))$varColor['Title']="";
			if(!isset($varColor['Color']))$varColor['Color']="";
			if(!isset($varColor['logo']))$varColor['logo']="";
			if(!isset($varColor['style']))$varColor['style']="";
			if(!isset($varColor['page_id']))$varColor['page_id']="";
			if(!isset($varMenu['menu']))$varMenu['menu']="";
			if(!isset($varMenu['menuTop']))$varMenu['menuTop']="";
			if(!isset($varMenu['menuBottom']))$varMenu['menuBottom']="";
			if(!isset($varMenu['bottom']))$varMenu['bottom']="";
			if(!isset($varMenu['side']))$varMenu['side']="";
			if(!isset($varMenu['top']))$varMenu['top']="";
			if(!isset($varGA['google']))$varGA['google']="";
			if(!isset($varSlideshow['onoff']))$varSlideshow['onoff']="";
			if(!isset($varSlideshow['one']))$varSlideshow['one']="";
			if(!isset($varSlideshow['two']))$varSlideshow['two']="";
			if(!isset($varSlideshow['three']))$varSlideshow['three']="";
			if(!isset($varSlideshow['four']))$varSlideshow['four']="";
			if(!isset($varSlideshow['five']))$varSlideshow['five']="";
			if(!isset($varStructure['icon']))$varStructure['icon']="";
			if(!isset($varStructure['splash']))$varStructure['splash']="";
			if(!isset($varStructure['version']))$varStructure['version']="0.0.1";
			if (!isset($varStructure['fullappname'])) {
		$varStructure['fullappname'] = '';
	}
			if(!isset($varStructure['description']))$varStructure['description']="";
			if(!isset($varStructure['cat']))$varStructure['cat']="";
			if(!isset($varStructure['keywords']))$varStructure['keywords']="";
			if(!isset($jsonpost["bottomIconCount"]))$jsonpost['bottomIconCount']="";
			if(!isset($jsonpost["bottomIcon"]))$jsonpost['bottomIcon']="";
			if(!isset($varSlideshow['five']))$varSlideshow['five']="";
			$jsonpost["name"] = get_bloginfo('name');


			$jsonpost["title"]   = $varColor['Title'];
			$jsonpost["color"]  = $varColor['Color'];
			$jsonpost["logo"]   = $varColor['logo'];
			$jsonpost["style"]   = $varColor['style'];
			$jsonpost["page_id"] = $varColor['page_id'];


			$jsonpost["menu"]   = $varMenu['menu'];
			$jsonpost["menuTop"]  = $varMenu['menuTop'];
			$jsonpost["menuBottom"] = $varMenu['menuBottom'];
			$jsonpost["bottom"]  = $varMenu['bottom'];
			$jsonpost["side"]   = $varMenu['side'];
			$jsonpost["top"]   = $varMenu['top'];

			$jsonpost["google"]  = $varGA['google'];

			$jsonpost["slideActive"]  = $varSlideshow['onoff'];
			$jsonpost["slide"][0]  = $varSlideshow['one'];
			$jsonpost["slide"][1] = $varSlideshow['two'];
			$jsonpost["slide"][2] = $varSlideshow['three'];
			$jsonpost["slide"][3] = $varSlideshow['four'];
			$jsonpost["slide"][4] = $varSlideshow['five'];

			$jsonpost["icon"] = $varStructure['icon'];
			$jsonpost["splash"]  = $varStructure['splash'];
			$jsonpost["description"]   = $varStructure['description'];
			$jsonpost["cat"]   = $varStructure['cat'];
			$jsonpost["keywords"]   = $varStructure['keywords'];
			$jsonpost["version"]   = $varStructure['version'];
			
			$jsonpost["fullappname"]   = $varStructure['fullappname'];
			//$menuItems = wp_get_nav_menu_items($varMenu['bottom']);
			$menuItems =   wp_get_nav_menu_items(  $varMenu['menuBottom'] );


			$jsonpost["bottomIconCount"] =   count($menuItems);

			//print_r($menuItems);
			for ($i = 0; $i < count($menuItems); ++$i) {
				if(!isset($jsonpost["bottomIcon"][$i]))  $jsonpost["bottomIcon"][$i]='';
				if(!isset($varMenu['bottomIcon'][$i]))   $varMenu['bottomIcon'][$i]='';

				$jsonpost["bottomIcon"][$i]  = $varMenu['bottomIcon'][$i];
			}


			$encoded=json_encode($jsonpost);
			header( 'Content-Type: application/json' );
			echo $encoded;
			exit;
		}
	}

	/*--  /JSON RETURN-- */
}