<?php
$data = array();

$u = 0;

$data[$u]['id'] = "1";
$data[$u]['name'] = "MyTheme";
$data[$u]['title'] = "Use your own theme.";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/icons/yourTheme2.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|blog";
$data[$u]['title'] = "Blogger";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/blog.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|football";
$data[$u]['title'] = "Football club";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Football club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/football.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|hospitals";
$data[$u]['title'] = "Hospital theme";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Test Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/hospitals.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|beer";
$data[$u]['title'] = "Beer";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/beer.png";
$u++;


if(function_exists('wp_remote_get')){

	$request  = wp_remote_get( 'http://app-developers.biz/jsonTemplatesSite.php?dss' );
	$response = wp_remote_retrieve_body( $request, true );

	$json =  json_decode($response,true);


	foreach ($json as $key=>$value){

		$data[$u]['id'] = $json[$key]['id'];
		$data[$u]['name'] = $json[$key]['name'];
		$data[$u]['title'] = $json[$key]['title'];
		$data[$u]['local'] =  $json[$key]['local'];
		$data[$u]['category'] = $json[$key]['category'];
		$data[$u]['url'] = $json[$key]['url'];
		$data[$u]['thumbnail_small'] = $json[$key]['thumbnail_small'];
		$u++;
	}

}

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|villa";
$data[$u]['title'] = "Real estate";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/villa.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|vet";
$data[$u]['title'] = "Vets";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/vet.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|beauty";
$data[$u]['title'] = "Beauty";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/beauty.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|coffeeshop";
$data[$u]['title'] = "Coffee Shop";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/coffeeshop.png";
$u++;



$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|fooddrink";
$data[$u]['title'] = "Food & Drink";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Food & Drink";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/fooddrink.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|asso";
$data[$u]['title'] = "Friends & Family";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/asso.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|nightclub3";
$data[$u]['title'] = "Music / Night Club";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/nightclub3.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|squarebtn";
$data[$u]['title'] = "Posh.";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/squarebtn.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|rock";
$data[$u]['title'] = "Rock Music";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/rock.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|sport";
$data[$u]['title'] = "Sports Football";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/sport.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|hair2";
$data[$u]['title'] = "Fasion Hair Salon ";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/hair2.png?1A";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|hair3";
$data[$u]['title'] = "Fasion Hair Salon #2";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/hair3.png?1A";
$u++;



$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|desk";
$data[$u]['title'] = "Desk Holiday";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/desk.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|church";
$data[$u]['title'] = "Religion";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/church.png";
$u++;



$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|cars";
$data[$u]['title'] = "Cars automobile";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/cars.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|photo";
$data[$u]['title'] = "Photograph ";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Photo ";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/photo.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|fashion2";
$data[$u]['title'] = "Fasion Blog #2 ";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/fashion2.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|golf";
$data[$u]['title'] = "Golf Club";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/golf.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|suit";
$data[$u]['title'] = "Homme Fashion for men";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Fashion";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/suit.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|suit2";
$data[$u]['title'] = "Fashion";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Fashion";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/suit2.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|fashion";
$data[$u]['title'] = "iOS Fasion #1";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Fashion";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/fashion.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|nightclub2";
$data[$u]['title'] = "NightClub #2";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/nightclub2.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|nightclub";
$data[$u]['title'] = "NightClub";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Night Club";
$data[$u]['url'] = "";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/nightclub.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|gym";
$data[$u]['title'] = "iOS Gym";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Health";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/gym.png";
$u++;

$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|bigslider";
$data[$u]['title'] = " Beautiful Slider";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Health";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/bigslider.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|biz";
$data[$u]['title'] = "iOS Biz ";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Business";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/biz.png";
$u++;



$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|biz3";
$data[$u]['title'] = "iOS Biz #3";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Business";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/biz3.png";
$u++;


$data[$u]['id'] = $u;
$data[$u]['name'] = "MyiOS|rock";
$data[$u]['title'] = "Rock Star";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['category'] = "Music";
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/screenshot/rock.png";
$u++;


$data[$u]['id'] = "1";
$data[$u]['name'] = "wooWordApp";
$data[$u]['title'] = "WooCommerce Theme";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/icons/woocommerce.png";
$u++;



$data[$u]['id'] = "1";
$data[$u]['name'] = "2015";
$data[$u]['title'] = "2015 basic theme";
$data[$u]['url'] = "";
$data[$u]['local'] =  'local';
$data[$u]['thumbnail_small'] = "https://s3.amazonaws.com/cordovajs/images/icons/2015.png";
$u++;
