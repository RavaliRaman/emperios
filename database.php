<?php  


$db['db_host'] = 'localhost';
$db['db_user'] = 'dvishal_wp8';
$db['db_password'] = 'E^PGePFTJfZEO^A]Gk~17&(6';
$db['db_name'] = 'dvishal_wp8';

foreach($db as $key => $value){
	define(strtoupper($key),$value);
}

function db_connect() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    confirm_db_connect();
    return $connection;
  }

  function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }

  
  function confirm_db_connect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }

  
$db = db_connect();

?>