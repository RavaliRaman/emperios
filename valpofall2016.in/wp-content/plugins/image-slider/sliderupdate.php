<?php
require_once('../../../wp-blog-header.php');
$actiontotake = $_POST['action'];
if($actiontotake=="update"){
$id = $_POST['id'];
$order = $_POST['order'];
$url =$_POST['url'];
$caption =$_POST['caption'];

global $wpdb;

$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";

$sql = "update {$as_tejus_table_name} SET url='{$url}', slideorder={$order}, caption='{$caption}' where id={$id}";
$wpdb->query($sql);
}
if($actiontotake=="delete"){
$id= $_POST['id'];
global $wpdb;

$as_tejus_table_name = $wpdb->prefix."as_tejus_slideshow";
$query = "DELETE FROM ".$as_tejus_table_name." WHERE id =".$id;
$wpdb->query($query);

}
?>