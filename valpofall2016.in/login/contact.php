<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Test Application..</title>
<meta name="description" content="">
<meta name="keywords" content="">
</head>
<body>





<table width="908" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><table width="903" border="0" align="center" cellpadding="3" cellspacing="3" style="background-color:#fff;">
      <tr>
        <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td width="100%" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" height="250"><?php
if(isset($_POST['add']))
{
$dbhost = 'localhost';
$dbuser = 'root134';
$dbpass = 'Welcome@123';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(! get_magic_quotes_gpc() )
{
  $Name =($_POST['Name']);
   $phonenumber =($_POST['phonenumber']);
    $comment =($_POST['comment']);
	 $Email =($_POST['Email']);
	   $State =($_POST['State']);
}
else
{
    $Name =($_POST['Name']);
   $phonenumber =($_POST['phonenumber']);
    $comment =($_POST['comment']);
	 $Email =($_POST['Email']);
	   $State =($_POST['State']);
}
$sql = "INSERT INTO login".
       "(Name,phonenumber,comment,Email,State)".
       "VALUES ".
       "('$Name','$phonenumber','$comment','$Email','$State')";
mysql_select_db('netra');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Thank you for your information, Data is successfully Added to the Database, We would Get back to you on this information.\n";
mysql_close($conn);
}
else
{
?>
                <form name="form1" method="post" action="contact.php">
                  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Name</p></td>
                      <td width="724"><input name="Name" type="text" id="Name"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">User Id</p></td>
                      <td><input name="phonenumber" type="text" id="phonenumber">
                      </td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Password</p></td>
                      <td><input name="comment" type="password" id="comment"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Email</p></td>
                      <td><input name="Email" type="text" id="Email"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">State</p></td>
                      <td><id="State"> 
                      <select name="State">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option></input>
                      
                      </td>
                    </tr>
                    <tr>
                      <td width="90"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td width="90"></td>
                      <td><input name="add" type="submit" id="add" value="Submit"></td>
                    </tr>
                  </table>
                </form>
              <?php
}
?>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          
</body>
</html>