

<?php
if (!isset($_SERVER['PHP_AUTH_USER']) == 'admin'  && !isset($_SERVER['PHP_AUTH_PW']) == 'admin@123') {
header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
header("HTTP/1.0 401 Unauthorized");
print "Oops! It require login to proceed further. Please enter your login details <a href='http://empeiros.internship-test.us/login.php'>here</a>\n";
exit;
} else {

if ($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin@123') {
echo 'User validated';
header("Location:majeed.html");
exit;
}
}

?>
