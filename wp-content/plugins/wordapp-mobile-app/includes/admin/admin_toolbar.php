<?php
if ( !current_user_can( 'manage_options' ) )  {
	wp_die( __( 'You do not have sufficient permissions to access this page.','WordApp' ) );
}
include WORDAPP_DIR.'/includes/config.php';
$active_tab ='';

$jsonApp = '';
$jsonApp = json_decode(get_option('WordApp_theme_options'),true);
$varColor = (array) get_option('WordApp_options');

if( isset( $_GET[ 'tab' ] ) ) {
	$active_tab = sanitize_text_field($_GET[ 'tab' ]);
}
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
?>
<div class="notice notice-error is-dismissible">
        <p><?php _e( 'Localhost Users, WordApp will only work on websites that have access to a URL, web address or an external IP.', 'sample-text-domain' ); ?></p>
       
    </div>
<?php 
	
	}
?>    
    
<?php if (!isset($_COOKIE['hidePopWordApp'])):?>
<!-- Start of appdeveloper Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="appdeveloper.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
/*]]>*/</script>
<!-- End of appdeveloper Zendesk Widget script -->
<?php endif; ?>
<div class="wrap">

   <div class="wordAppheader"><a href="<?php echo MAINURL; ?>" class="wordApplogo"><img  style="  width: 100%;max-width:300px" src="<?php echo plugin_dir_url(APPNAME.'/images/logo.png', __FILE__); ?>logo.png"></a> <div class="wordAppsubscribe">
	 <?php _e('Get tips & tricks about WordApp & Mobile Marketing.','wordapp-mobile-app');?><br />
	  <script src="https://apis.google.com/js/platform.js"></script>

<script>
  function onYtEvent(payload) {
    if (payload.eventType == 'subscribe') {
      // Add code to handle subscribe event.
    } else if (payload.eventType == 'unsubscribe') {
      // Add code to handle unsubscribe event.
    }
    if (window.console) { // for debugging only
      window.console.log('YT event: ', payload);
    }
  }
</script>

<div class="g-ytsubscribe" data-channelid="UC7NJLsf6IonOy8QI8gt5BeA" data-layout="default" data-count="default" data-onytevent="onYtEvent"></div>
	   </div>
	   <div style="float:left;text-align:center;margin-left: 140px;">
		     <?php

/* After accepting the t&c this registers users blog so we can display app and send the android version automatically via email */
$url64 = base64_encode(get_bloginfo('url'));

if(get_option( 'wordapp_firstVisit' ) == ""){
	update_option( 'WordApp_ga', array('mobilesite' => 'on'));
}
else{
}

?>


 <?php  if(get_option( 'wordapp_firstVisit' ) == ""){  ?>
		 <div class="updated" id="" style="">
			<div><?php _e('Thank you for using','wordapp-mobile-app');?>
				<?php echo APPNAME_FRIENDLY; ?>,  <?php _e('we hope you enjoy using our plugin.','wordapp-mobile-app');?>
			  	 <?php _e('If you continue using','wordapp-mobile-app');?>  <?php echo APPNAME_FRIENDLY; ?>  <?php _e('you agree to our','wordapp-mobile-app');?> <a href="http://app-developers.biz/terms-conditions/" > <?php _e('terms of service.','wordapp-mobile-app');?></a>
				<br /><?php _e('Thank you for supporting our plugin.','wordapp-mobile-app');?>
				<div style="float: right;">
				<small><a href="#"><?php _e('Hide','wordapp-mobile-app');?></a> </small>
				</div>
			</div>
		</div>
			<?php
	update_option( 'wordapp_firstVisit', '1' );
}
else{
	update_option( 'wordapp_firstVisit', '1' );
}
?>

	   </div>
	</div>
         <div id="dashicons-admin-plugins" class="icon32"></div>

<h2 class="nav-tab-wrapper">

    <a href="?page=WordAppBuilder&tab=" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>"><?php echo __('Design','wordapp-mobile-app'); ?></a>
	<?php if($jsonApp["option"] == 'on'): ?>
					<a href="?page=WordAppBuilder&tab=builder" class="nav-tab <?php echo $active_tab == 'builder' ? 'nav-tab-active' : ''; ?>"><?php echo __('Home Builder','wordapp-mobile-app'); ?></a>
	  <?php endif; ?>
    <a href="?page=WordAppBuilder&tab=step2" class="nav-tab <?php echo $active_tab == 'step2' ? 'nav-tab-active' : ''; ?>"><?php echo __('Menus & Bars','wordapp-mobile-app'); ?></a>

<?php if ($varColor['theme'] == 'MyTheme') {
	
}else{
	 ?>
		<a href="?page=WordAppBuilder&tab=slideshow" class="nav-tab <?php echo $active_tab == 'slideshow' ? 'nav-tab-active' : ''; ?>"><?php echo __('Slideshow','wordapp-mobile-app'); ?></a>
<?php 
	}
	
?>		
		
    <a href="?page=WordAppBuilder&tab=step3" class="nav-tab <?php echo $active_tab == 'step3' ? 'nav-tab-active' : ''; ?>"><?php echo __('App Structure','wordapp-mobile-app'); ?></a>
    <a href="?page=WordAppBuilder&tab=step4" style="background-color: #00a0d2;color: #fff;margin-left: 10%;" class="nav-tab <?php echo $active_tab == 'step4' ? 'nav-tab-active' : ''; ?>"><?php echo __('Publish App','wordapp-mobile-app'); ?></a>



</h2>
	<?php
$varGA = (array)get_option( 'WordApp_ga' );
if(!isset($varGA['chatHide'])) $varGA['chatHide'] ='';
if($varGA['chatHide']== ''){
?>
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
