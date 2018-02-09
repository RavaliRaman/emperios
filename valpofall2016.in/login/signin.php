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
        <td width="449" valign="top"><table border="0" cellpadding="0" cellspacing="0"  style="background: url(images/left_bg.gif)">
            <tr>
              <td><img src="images/left_left.gif" width="21" height="29" border="0" alt=""></td>
              <td><img src="images/spacer.gif" width="7" height="1" border="0" alt=""></td>
              <td width="404"><div class="lb">FEATURED PRODUCTS</div>
                <div class="lw">Sign in</div></td>
              <td><img src="images/left_right.gif" width="6" height="29" border="0" alt=""></td>
            </tr>
          </table>
          <table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td align="left" valign="top">
           <?php

$host="localhost"; // Host name
$username="root134"; // Mysql username
$password="Welcome@123"; // Mysql password
$db_name="netra"; // Database name
$tbl_name="signup"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("netra")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
//$myusername =($myusername);
//$mypassword =($mypassword);

$sql="SELECT * FROM signup WHERE myusername='$myusername' and mypassword='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword");
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
?>


<form method="post" action="signin.php">
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
  <td><p style="font-weight:bold; font-size:12px; color:#000;">User Id</p></td>
  <td width="262">
    <input name="myusername" type="text" id="myusername">    </td>
</tr>
<tr>
  <td><p style="font-weight:bold; font-size:12px; color:#000;">Password</p></td>
  <td><input name="mypassword" type="password" id="mypassword"></td>
</tr>
<tr>
  <td width="142"> </td>
  <td> </td>
</tr>
<tr>
<td width="142"> </td>
<td>
<input name="add" type="submit" id="add" value="Signin"></td>
</tr>
</table>
</form>              </td>
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