<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['user_id'];

   $ses_sql = mysqli_query($db,"select user_id from Users where Username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['Username'];

   if(!isset($_SESSION['user_id'])){
      header("location:login.php");
   }
   if(isset($_SESSION["user_id"])) {
   	if(!isLoginSessionExpired()) {
   		header("Location:login.php");
   	} else {
   		header("Location:logout.php?session_expired=1");
   	}
}
?>
