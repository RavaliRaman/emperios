<?php
$mysql_hostname = "localhost";
$mysql_user = "root134";
$mysql_password = "Welcome@123";
$mysql_database = "netra";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>