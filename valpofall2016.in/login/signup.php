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
		<td width="291" align="center" bgcolor="#FFFFFF"><img src="images/add2.jpg" width="279" height="116"></td>
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
		          <td width="40%" align="center"><a href="signin.php"><img src="images/signin1.png" alt=""></a></td>
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
        <?php
			include('includes/menu.php');
		?>
        
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
   $myusername =($_POST['myusername']);
    $mypassword =($_POST['mypassword']);
	 $Email =($_POST['Email']);
	  $City =($_POST['City']);
	   $Cell =($_POST['Cell']);
	    $State =($_POST['State']);
}
else
{
    $Name =($_POST['Name']);
   $myusername =($_POST['myusername']);
    $mypassword =($_POST['mypassword']);
	 $Email =($_POST['Email']);
	  $City =($_POST['City']);
	   $Cell =($_POST['Cell']);
	    $State =($_POST['State']);
}
$sql = "INSERT INTO signup".
       "(Name,myusername,mypassword,Email,City,Cell,State)".
       "VALUES ".
       "('$Name','$myusername','$mypassword','$Email','$City','$Cell','$State')";
mysql_select_db('netra');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
}
else
{
?>
                <form name="form1" method="post" action="signup.php">
                  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Name</p></td>
                      <td width="724"><input name="Name" type="text" id="Name"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">User Id</p></td>
                      <td><input name="myusername" type="text" id="myusername">
                      </td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Password</p></td>
                      <td><input name="mypassword" type="password" id="mypassword"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Email</p></td>
                      <td><input name="Email" type="text" id="Email"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">City</p></td>
                      <td><input name="City" type="text" id="City"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">Cell</p></td>
                      <td><input name="Cell" type="text" id="Cell"></td>
                    </tr>
                    <tr>
                      <td><p style="font-weight:bold; font-size:12px; color:#000;">State</p></td>
                      <td><input name="State" type="text" id="State">
                      </td>
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
        
        <?php
			include('includes/footer.php');
		?>
        
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