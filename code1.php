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
echo "Uploaded";

?>