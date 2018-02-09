<center>
		<?php echo __('Made with &#10084; by geeks who love wordpress & mobile','wordapp-mobile-app');?>
</center>

	<?php
$varGA = (array)get_option( 'WordApp_ga' );
if(!isset($varGA['chatHide'])) $varGA['chatHide'] ='';
if($varGA['chatHide']== ''){
?>
<!-- Start of appdeveloper Zendesk Widget script -->
   <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/596f4ff71dc79b329518f24e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->		
<?php

}
?>