<?php
class HomeContent{
	function __construct(){
	}
	public function upload_Content(){
		$heading = $_POST['heading'];
		$content = $_POST['content'];
		$newcontent=str_replace(Chr(13),'<p>', $content);
		mysql_query("INSERT INTO homecontent(heading,content,today) VALUES('$heading','$content',now())");
		header("location:homecontent.php");	
	}
}
?>