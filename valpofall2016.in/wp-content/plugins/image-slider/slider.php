<?php
/*
Plugin Name: Image Slider
Plugin URI: http://www.tejuscreative.com/sliderinstructions.docx
Description: This plugin is used to Slide show
Version: 1.0
Author: Dhananjay Singh, Ashwani
Author URI: http://www.tejuscreative.com
License:  GPL2
*/
?>
<?php
/* call a function named dj_myplugin_activate to create a datbase at the activation of plugin*/
register_activation_hook( __FILE__, 'as_tejus_myplugin_activate' );
/* call a function named dj_myplugin_deactivate to delete already craeted datbase at the deactivation of plugin*/
register_deactivation_hook( __FILE__, 'as_tejus_myplugin_deactivate' );
/* craeting daatabase*/
function as_tejus_myplugin_activate(){
global $wpdb;
$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
$sql = "CREATE TABLE  ".$as_tejus_table_name." (
         id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		 path VARCHAR(300),
		 url VARCHAR(300),
		 slideorder INT,
		 caption VARCHAR(200)
       );" ;
$wpdb->query($sql);
}
/*deleting database*/
function as_tejus_myplugin_deactivate(){
global $wpdb;
$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
 $sql= "DROP TABLE IF EXISTS ".$as_tejus_table_name ;
 $wpdb->query($sql);
 }
 add_action('init', 'as_tejus__mysite_init');
/* function to include javascript file*/
function as_tejus__mysite_init() {
wp_enqueue_script( 'jquery' );
$as_tejus_plugin_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
wp_enqueue_script('as_tejus_slidejq', $as_tejus_plugin_path . "js/as_tejus_slidejq.js");
wp_enqueue_script('as_tejus_easing', $as_tejus_plugin_path . "js/as_tejus_easing.js");
wp_enqueue_script('as_tejus_anythingslider', $as_tejus_plugin_path . "js/as_tejus_anythingslider.js");
wp_enqueue_script('as_tejus_anythingslidermin', $as_tejus_plugin_path . "js/as_tejus_anythingslidermin.js");
wp_enqueue_style( 'anythingslider',  $as_tejus_plugin_path . "css/anythingslider.css");
}
 add_action('admin_menu','as_tejus_toaddmymenu');
/* to add various menus of plugin to admin panel*/
function as_tejus_toaddmymenu(){
/* adding top level menu */
add_menu_page( 'slide show', 'Image Slider', 'manage_options', 'as_tejus_slideshow', 'as_tejus_callitmyfunction' );
add_submenu_page('as_tejus_slideshow','add option','options','manage_options','as_tejus_slideshow_options','slide_show_option');
}
function as_tejus_callitmyfunction(){
?>
<div class="wholeform">
<h4> call this function in template file to show slideshow as_tejus_show_slideshow();</h4>
<br/>
<h4>OR use this shortcode [as_tejus_slides] in posts or pages.</h4>
</div>
<div class="wholeform">
<form name="createform" method="post" enctype="multipart/form-data">
<input name="astejusimg" type="file" value="" size="100" >
<label> url </label><input type="text" name="url" VALUE=""/>
<input type="hidden" value="1" name="updatevalueform"/>
<input type="submit" name="createbutton" value="upload" />
</form></div>
<?php
if($_POST['updatevalueform']){
$as_tejus_url = $_POST['url'];
$as_tejus_order = 0;
$as_tejus_caption = $_POST['caption'];
//$djcatformimages = $_POST['djcatimages'];
if(isset($_FILES[ 'astejusimg' ]) && ($_FILES[ 'astejusimg']['size'] > 0)) {
require_once( ABSPATH . 'wp-admin/includes/file.php' );
// Get the type of the uploaded file. This is returned as "type/extension"
 $arr_file_type = wp_check_filetype(basename($_FILES['astejusimg']['name']));
 $uploaded_file_type = $arr_file_type['type'];
// Set an array containing a list of acceptable formats
 $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');
 // If the uploaded file is the right format
 if(in_array($uploaded_file_type, $allowed_file_types)) {
 // Options array for the wp_handle_upload function. 'test_upload' => false
 $upload_overrides = array( 'test_form' => false ); 
 // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
  $returnigurlofimage = wp_handle_upload($_FILES['astejusimg'], $upload_overrides);
 }
if($returnigurlofimage['url']){ $savethisimageurl = $returnigurlofimage['url'] ;
global $wpdb;
$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
$sql = "INSERT INTO ".$as_tejus_table_name."  VALUES (DEFAULT,'{$savethisimageurl}','{$as_tejus_url}',0,'{$as_tejus_caption}') ";
$wpdb->query($sql);
}
}
}
$as_tejus_plugin_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
global $wpdb;
$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
$sql= "SELECT * FROM ". $as_tejus_table_name;
$djalladdedimagestoslides = $wpdb->get_results($sql, ARRAY_A);
?>
<div class="wholecategorywimagebox">
<table class="widefat" style="width: 80%">
<thead>
<tr>
<th>image id</th>
<th>IMAGE</th>
<th>url</th>
<th>order</th>
<th>caption</th>
<th>UPDATE<th>
<th>Delete</th>
</tr>
</thead>
<tfoot>
<tr>
<th>image id</th>
<th>IMAGE</th>
<th>url</th>
<th>order</th>
<th>caption</th>
<th>UPDATE<th>
<th>Delete</th>
</tr>
</tfoot>
<tbody>
<?php
/*
if($_GET['typeofform']=="updateanddelete"){
if($_GET['task']=="edit"){ $sql = "UPDATE ".$as_tejus_table_name." SET slideorder = ".$_GET['slideorder']." WHERE id = '".$_GET['id']."'";
echo $sql;
$wpdb->query($sql);}

if($_GET['task']=="delete"){ $query = "DELETE FROM ".$as_tejus_table_name." WHERE id ='".$_GET['id']."'";
$wpdb->query($query); }
}*/
foreach($djalladdedimagestoslides as $djalladdedimagestoslide){
echo '<tr>';
echo  '<td id="imageidis'.$djalladdedimagestoslide['id'].'">'.$djalladdedimagestoslide['id'].'</td><td><img src="'.$djalladdedimagestoslide['path'].'" width="50" height="50"/></td><td><input type="text" name="url" value="'.$djalladdedimagestoslide['url'].' " id="urlimagesis'.$djalladdedimagestoslide['id'].'"></td><td><input id="orderofimage'.$djalladdedimagestoslide['id'].'" type="text" name="order" value="'.$djalladdedimagestoslide['slideorder'].'"></td><td><input type="text" name="caption" value="'.$djalladdedimagestoslide['caption'].' " id="captionimagesis'.$djalladdedimagestoslide['id'].'"></td><td><input type="button" name="update" id = "as_tejus_update'.$djalladdedimagestoslide['id'].'" value="update" ></td><td><input type="button" name="delete" value="delete" id = "as_tejus_delete'.$djalladdedimagestoslide['id'].'"  ></td>';
echo '</tr>';
}
?>
 </tbody>
</table></div>
<script>
 jQuery(function($){ 
 $.ajaxSetup({
  error:function(x,e){
   if(x.status==0){
   alert('You are offline!!\n Please Check Your Network.');
   }else if(x.status==404){
   alert('Requested URL not found.');
   }else if(x.status==500){
   alert('Internel Server Error.');
   }else if(e=='parsererror'){
   alert('Error.\nParsing JSON Request failed.');
   }else if(e=='timeout'){
   alert('Request Time out.');
   }else {
   alert('Unknow Error.\n'+x.responseText);
   }
  }
 });
<?php
global $wpdb;
$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
$sql= "SELECT * FROM ". $as_tejus_table_name;
$djalladdedimagestoslides = $wpdb->get_results($sql, ARRAY_A);
foreach($djalladdedimagestoslides as $djalladdedimagestoslide){
?>
$("#as_tejus_update<?php echo $djalladdedimagestoslide['id']; ?>").click( function (){
var id<?php echo $djalladdedimagestoslide['id']; ?> = $("#<?php echo 'imageidis'.$djalladdedimagestoslide['id']; ?>").html();
var order<?php echo $djalladdedimagestoslide['id']; ?> = $("#<?php echo 'orderofimage'.$djalladdedimagestoslide['id']; ?>").val();
var url<?php echo $djalladdedimagestoslide['id']; ?> = $("#<?php echo 'urlimagesis'.$djalladdedimagestoslide['id']; ?>").val();
var caption<?php echo $djalladdedimagestoslide['id']; ?> = $("#<?php echo 'captionimagesis'.$djalladdedimagestoslide['id']; ?>").val();
var datastring<?php echo $djalladdedimagestoslide['id']; ?> = "id="+id<?php echo $djalladdedimagestoslide['id']; ?>+"&order="+order<?php echo $djalladdedimagestoslide['id']; ?>+"&url="+url<?php echo $djalladdedimagestoslide['id']; ?>+"&caption="+caption<?php echo $djalladdedimagestoslide['id']; ?>+"&action=update";
//alert(datastring<?php echo $djalladdedimagestoslide['id']; ?>);
 $.ajax({
      type: "POST",
      url: "<?php echo $as_tejus_plugin_path; ?>sliderupdate.php",
      data: datastring<?php echo $djalladdedimagestoslide['id']; ?>,
	
      success: function(html) {
       
	window.location.replace("<?php echo $_SERVER['REQUEST_URI']; ?>");
       
      }
     }); });
	 
	 $("#as_tejus_delete<?php echo $djalladdedimagestoslide['id']; ?>").click( function (){
	
var id<?php echo $djalladdedimagestoslide['id']; ?> = $("#<?php echo 'imageidis'.$djalladdedimagestoslide['id']; ?>").html();
var datastring<?php echo $djalladdedimagestoslide['id']; ?> = "id="+id<?php echo $djalladdedimagestoslide['id']; ?>+"&action=delete";
//alert(datastring<?php echo $djalladdedimagestoslide['id']; ?>);
 $.ajax({
      type: "POST",
      url: "<?php echo $as_tejus_plugin_path; ?>sliderupdate.php",
      data: datastring<?php echo $djalladdedimagestoslide['id']; ?>,

      success: function(html) {
       
       window.location.replace("<?php echo $_SERVER['REQUEST_URI']; ?>");
       
      }
     }); });
<?php } ?>

});
 </script>
<?php } ?>
<?php function as_tejus_show_slideshow(){
?>
<ul id="slider2">
<?php
		global $wpdb;
		$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
		$sql ='SELECT * from '.$as_tejus_table_name.' ORDER BY slideorder ASC';
		$djalladdedimagestoslides = $wpdb->get_results($sql, ARRAY_A);
		$counter=10;
		foreach($djalladdedimagestoslides as $djalladdedimagestoslide){
		$counter++;
	?>
  <li class="pane<?php echo $counter;?>">
  <div class="textSlide">
    <a href="<?php echo $djalladdedimagestoslide['url'];?>" target="_blank"><img src="<?php echo $djalladdedimagestoslide['path']; ?>"class="<?php echo get_option('my_quoteSlide'); ?>"></a>
	<h3><?php echo $djalladdedimagestoslide['caption'];?></h3>
	</div>
	<?php } ?>
  </li> 
 </ul> 
 <script type="text/javascript">
	$(function(){
 $('#slider2') // Demo 2 code, using FX full control
  .anythingSlider({
   resizeContents      : <?php echo get_option('resize'); ?>,
   autoPlay            : <?php echo get_option('auto'); ?>,
   delay			   : <?php if(get_option('delay_time')){ echo get_option('delay_time'); }else{ echo 10000;} ?>,
   buildArrows         : <?php echo get_option('navigation'); ?>,
   buildNavigation     : <?php echo get_option('Show_Navigation'); ?>,
   buildStartStop      : <?php echo get_option('Show_start_button'); ?>,
   toggleArrows        : <?php echo get_option('Show_Navigation_hover'); ?>,
   toggleControls      : <?php echo get_option('Show_start_hover'); ?>
  })
  .anythingSliderFx({
   // base FX definitions can be mixed and matched in here too.
   '.fade' : [ 'fade' ],

   // for more precise control, use the "inFx" and "outFx" definitions
   // inFx = the animation that occurs when you slide "in" to a panel
   inFx : {
    '.textSlide h3'  : { opacity: 0.8, duration: 400, easing : 'easeOutBounce' },
    '.textSlide li'  : { opacity: 1, left : 0, duration: 400 },
    '.textSlide img' : { opacity: 1, duration: 400},
    '.quoteSlide'    : { top : 0, duration: 400, easing : 'easeOutElastic' },
    '.expand'        : { width: '100%', top: '0%', left: '0%', duration: 400, easing : 'easeOutBounce' }
   },
   // out = the animation that occurs when you slide "out" of a panel
   // (it also occurs before the "in" animation)
   outFx : {
    '.textSlide h3'      : { opacity: 0, duration: 350 },
    '.textSlide li:odd'  : { opacity: 0, left : '-200px', duration: 350 },
    '.textSlide li:even' : { opacity: 0, left : '200px',  duration: 350 },
    '.textSlide img'     : { opacity: 0, duration: 350 },
    '.quoteSlide:first'  : { top : '-500px', duration: 350 },
    '.quoteSlide:last'   : { top : '500px', duration: 350 },
    '.expand'            : { width: '10%', top: '50%', left: '50%', duration: 350 }
   }
  });
});
	</script>
<?php
} ?>
<?php add_shortcode( 'as_tejus_slides', 'as_tejus_show_slideshow' ); ?>
<?php function slide_show_option(){
 if ( $_POST['update_effctoptions'] == 'true' ) { effctoptions_update(); }
?>
 <form method="POST" id="admin-theme" action="">
<input type="hidden" name="update_effctoptions" value="true" />
<table border="0" cellspacing="15" cellpadding="0">
<tr><td colspan="2"><h2>Slider Show Option</h2></td></tr>
<tr><td>Slide Effect</td><td>
<select name="my_quoteSlide">
<option value="quoteSlide" <?php if( get_option('my_quoteSlide')=="quoteSlide"){echo "selected";} ?> id="quoteSlide">quoteSlide</option>
<option value="fade" <?php if( get_option('my_quoteSlide')=="fade"){echo "selected";} ?> id="fade" >fade</option>
<option value="expand" <?php if( get_option('my_quoteSlide')=="expand"){echo "selected";} ?> id="expand" >expand</option>
</select>
</td></tr>
<tr>
<td>Auto play</td>
<td>
<select name="auto">
<option id="true" <?php  if( get_option('auto')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('auto')=="false"){echo "selected";}?> >false</option>
</select>
</td>
</tr>
<tr>
<td>Delay Time( In mili seconds)</td>
<td><input type="text" id="dtime" name="dtime" size="10" value="<?php echo get_option('delay_time');?>"></td>
</tr>
<tr>
<td>Navigation Arrows</td>
<td>
<select name="navigation">
<option id="true" <?php  if( get_option('navigation')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('navigation')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
</tr>
<tr>
<td>Auto resize</td>
<td>
<select name="resize">
<option id="true" <?php  if( get_option('resize')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('resize')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
<tr>
<td>Show Navigation</td>
<td>
<select name="Show_Navigation">
<option id="true" <?php  if( get_option('Show_Navigation')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('Show_Navigation')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
<tr>
<td>Show Navigation on hover</td>
<td>
<select name="Show_Navigation_hover">
<option id="true" <?php  if( get_option('Show_Navigation_hover')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('Show_Navigation_hover')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
<tr>
<td>Show start button</td>
<td>
<select name="Show_start_button">
<option id="true" <?php  if( get_option('Show_start_button')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('Show_start_button')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
<tr>
<td>Show start button on hover</td>
<td>
<select name="Show_start_hover">
<option id="true" <?php  if( get_option('Show_start_hover')=="true"){echo "selected";} ?> >true</option>
<option id="false" <?php  if( get_option('Show_start_hover')=="false"){echo "selected";} ?> >false</option>
</select>
</td>
</tr>
</table>
<input type="submit" name="submit" value="Update Options" />
</form>
<?php }?>
<?php function effctoptions_update()
{
update_option('my_quoteSlide',  $_POST['my_quoteSlide']);
update_option('auto',  $_POST['auto']);
update_option('delay_time',  $_POST['dtime']);
update_option('navigation',  $_POST['navigation']);
update_option('Show_Navigation_hover',  $_POST['Show_Navigation_hover']);
update_option('resize',  $_POST['resize']);
update_option('Show_Navigation',  $_POST['Show_Navigation']);
update_option('Show_start_button',  $_POST['Show_start_button']);
update_option('Show_start_hover',  $_POST['Show_start_hover']);
 }?>