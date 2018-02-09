<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'admin_toolbar_misc.php';
$url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=UU7NJLsf6IonOy8QI8gt5BeA&key=AIzaSyC1BT7o1xH2bM-WYaniC3VUfgvELj48850&maxResults=10";




$request = wp_remote_get($url);


$postas = json_decode(wp_remote_retrieve_body( $request ),true);

if(!isset($posta['user_url'])) $posta['user_url']='';
if(!isset($posta['id'])) $posta['id']='';
if(!isset($posta['description'])) $posta['description']='';
if(!isset($posta['user_name'])) $posta['user_name']='';
if(!isset($activate['homeVideo'])) $activate['homeVideo']='';
if(!isset($activate['videoVideo'])) $activate['videoVideo']=$activate['homeVideo'];
$url = "http://52.27.101.150/mobrock/app/activateJson.php";
$activate = json_decode(wp_remote_retrieve_body(wp_remote_get($url)),true);


?>

	<div id="poststuff">

		<div id="the-list">
 
		<?php
foreach ($postas['items'] as $posta) {
?><hr>
<div class="plugin-card plugin-card-akismet">
			<div class="plugin-card-top wordapp-plugin-card-top">
				<a href="https://www.youtube.com/embed/<?php echo $posta['snippet']['resourceId']['videoId']; ?>?TB_iframe=true&amp;width=772&amp;height=259" class="thickbox plugin-icon"><img src="<?php echo $posta['snippet']['thumbnails']['default']['url']; ?>"></a>
				<div class="name column-name">
					<h4><a href="https://www.youtube.com/embed/<?php echo $posta['snippet']['resourceId']['videoId']; ?>?TB_iframe=true&amp;width=772&amp;height=259" class="thickbox"><?php echo $posta['snippet']['title']; ?></a></h4>
				</div>
				<div class="action-links">
					<ul class="plugin-action-buttons"><li><a href="https://www.youtube.com/embed/<?php echo $posta['snippet']['resourceId']['videoId']; ?>?TB_iframe=true&amp;width=772&amp;height=259" class="thickbox install-now button" href="" aria-label="Watch Now" data-name="Watch Now"><?php _e('Watch Now','wordapp-mobile-app'); ?></a></li><li></li></ul>				</div>
				<div class="desc column-description">
					<p><?php echo $posta['snippet']['title']; ?></p>
					<p class="authors"> <cite></cite></p>
				</div>
			</div>
			<div class="plugin-card-bottom wordapp-plugin-card-bottom">

				<div class="column-updated">
					<strong><?php _e('By','wordapp-mobile-app'); ?> </strong> <span title="6 Jul 2015 @ 23:44"><a href="https://www.youtube.com/c/DaveASargent"><?php echo $posta['snippet']['channelTitle']; ?></a>
									</span>
				</div>

				<div class="wordapp-column-compatibility">
					<span class=""><strong></strong> </span>				</div>
			</div>
		</div>

<?php
}
?>
<center><a href="https://www.youtube.com/c/DaveASargent"><?php _e('More videos on our YouTube channel','wordapp-mobile-app'); ?></a></center>
<hr>
			</div>
</div> <!-- .wrap -->
<?php
include trailingslashit( plugin_dir_path( __FILE__ ) ) . 'footer.php';
?>
