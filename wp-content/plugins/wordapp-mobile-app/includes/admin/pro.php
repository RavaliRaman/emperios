<?php
$varColor = (array) get_option('WordApp_options');
$varMenu = (array) get_option('WordApp_menu');
$varStructure = (array) get_option('WordApp_structure');
$varSlideshow = (array) get_option('WordApp_slideshow');
$varGA = (array) get_option('WordApp_ga');
$fullVar = array_merge($varColor, $varMenu, $varStructure, $varSlideshow, $varGA);

?>
<p>Go premium you are being redirected to more information.

<form id="sendToAD"  name="sendToAD" method="POST" action="https://secure.buildapps.biz/mobrock/app/sendToAD.php?pro=1">

		<input type="hidden" name="ref" value="<?php echo get_admin_url();?>" id="ref">
		<input type="hidden" name="url" id="url" value="<?php echo get_bloginfo('url') ?>">
		<input type="hidden" name="user" id="user" placeholder="Your Name" value="<?php echo get_bloginfo('name') ?>">
		<input type="hidden" name="bs64" id="bs64" value="yes">
		<input type="hidden" name="fullJson" id="fullJson" value="<?php echo base64_encode(json_encode($fullVar, true));?>">
		<input type="hidden" name="download" id="download"  value="">
		<input type="hidden" name="url" id="url"  value="<?php echo get_bloginfo('url') ?>">
		<input type="hidden" name="email" id="email" value="<?php echo get_bloginfo('admin_email') ?>"><br></small></center>

		If you are not redirected <input class="button-primary" type="button" name="send"  id="pushNoteSend"  value="click here">
	</form>
</p>
</center>

<script>
	window.onload=function(){
    var counter = 5;
    var interval = setInterval(function() {
        counter--;
        //$("#seconds").text(counter);
        if (counter == 0) {
            redirect();
            clearInterval(interval);
        }
    }, 1000);

};

function redirect() {
    document.sendToAD.submit();
}
</script>
