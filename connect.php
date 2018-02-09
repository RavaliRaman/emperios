<!DOCTYPE html>
<html>
<body>
<?php

         session_start();

	 $servername = 'localhost';
         $username = 'dvishal_wp8';
         $password = 'E^PGePFTJfZEO^A]Gk~17&(6';
         $database = 'dvishal_wp8';
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully and please wait for org chart ";
echo "Work which need to be completed as logout button and then have the login information to the page and then org chart with hrover";

?>
</body>
</html>