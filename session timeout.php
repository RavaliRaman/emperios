<?php
session start();
$_session['username']= $Username;

$_session['timeout']= time();

if ($_session['timeout']+ 2*60 < time())
{ session_destroy();
echo "Your session has expired!";
header ("location: login.php");
}
else
{
$Username = active;
}
?>