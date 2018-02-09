<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Test Application..</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="904" style="background-color:#06C">
	<tr>
		<td width="194" height="143" align="center" bgcolor="#FFFFFF">Logo Here</td>
		
		<td width="419" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="5" height="1" border="0" alt="">
		  <table border="0" align="center" cellpadding="0" cellspacing="0">
		    <tr>
		      <td><img src="images/c1.gif" width="5" height="5" border="0" alt=""></td>
		      <td style="background: url(images/c_top.gif)"><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
		      <td><img src="images/c2.gif" width="5" height="5" border="0" alt=""></td>
	        </tr>
		    <tr>
		      <td style="background: url(images/c_left.gif)"><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
		      <td width="393" align="center"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
		        <tr>
		          <td width="2%"><img src="images/spacer.gif" width="4" height="1" border="0" alt=""><a href="signup.php"><img src="images/signup1.png"></a></td>
		          <td width="40%" align="center"><a href="login.php"><img src="images/signin1.png" alt=""></a></td>
		          <td width="10%">&nbsp;</td>
	            </tr>
		        </table></td>
		      <td style="background: url(images/c_right.gif)"><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
	        </tr>
		    <tr>
		      <td><img src="images/c4.gif" width="5" height="5" border="0" alt=""></td>
		      <td style="background: url(images/c_bot.gif)"><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
		      <td><img src="images/c3.gif" width="5" height="5" border="0" alt=""></td>
	        </tr>
        </table></td>
	</tr>
</table>




<table width="903" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="top" bgcolor="#6C7577">
        
        
        </td>
	</tr>
</table>
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
$dbuser = 'dvishal_wp8';
$dbpass = 'E^PGePFTJfZEO^A]Gk~17&(6';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(! get_magic_quotes_gpc() )
{
   $Name =($_POST['full_name']);
   $Email =($_POST['Email']);
    $myusername =($_POST['Username']);
	 $mypassword =($_POST['Password']);
		  
}
else
{
    $Name =($_POST['full_name']);
   $Email =($_POST['Email']);
    $myusername =($_POST['Username']);
	 $mypassword =($_POST['Password']);
	  
}
$sql = "INSERT INTO Users".
       "(full_name,Email,Username,Password)".
       "VALUES ".
       "('$Name','$Email','$myusername','$mypassword')";
mysql_select_db('dvishal_wp8');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Your Details are successfully stored in our details, now you can login and please check the organization chart\n";
mysql_close($conn);
}
else
{
?>
                <form name="form1" method="post" action="signup.php">
                  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Full Name:</p></td>
                      <td width="724"><input name="Name" type="text" id="Name" required></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Email:</p></td>
                      <td><input name="Email" type="text" id="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                      </td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Username:</p></td>
                      <td><input name="myusername" type="text" id="myusername" required></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Password:</p></td>
                      <td><input name="mypassword" type="password" id="mypassword" required></td>
                    </tr>
                    
                    <tr>
                      <td width="90"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td width="90"></td>
                      <td><input name="add" type="submit" id="add" value="Sign up"></td>
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
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" align="left" valign="top" bgcolor="#FF0000"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="63%">
        
        
        
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</body>
</html>