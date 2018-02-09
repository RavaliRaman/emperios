<?php
include("config.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$myusername=addslashes($_POST['username']);
$mypassword=addslashes($_POST['password']);

$sql="SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$active=$row['active'];
$count=mysql_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
session_register("myusername");
$_SESSION['login_user']=$myusername;

header("location: welcome.php");
}
else
{
$error="Your Login Name or Password is invalid";
}
}
?>
<style type="text/css">

/* form 2 */

	#form2{
		margin:40px;
		margin-left:500px;
		color:#fff;
		width:320px; /* customize width, this form have fluid layout */
		}
	#form2 h3{
		margin:0;
		background:#57a700 url(../images/form2/form_heading.gif) repeat-x;		
		color:#fff;
		font-size:20px;
		border:1px solid #57a700;
		border-bottom:none;
		}		
	#form2 h3 span{
		display:block;
		padding:10px 20px;
		background:url(../images/form2/form_ico.gif) no-repeat 93% 50%;			
		}				
	#form2 fieldset{
		margin:0;
		padding:0;
		border:none;	
		border-top:3px solid #000;
		background:#000 url(../images/form2/form_top.gif) repeat-x;		
		padding-bottom:1em;
		}		
	#form2 legend{display:none;}	
	#form2 p{margin:.5em 20px;}	
	#form2 label{display:block;}	
	#form2 input, #form2 textarea{		
		width:272px;
		border:1px solid #111;
		background:#282828 url(../images/form2/form_input.gif) repeat-x;
		padding:5px 3px;
		color:#fff;
		}		
	#form2 textarea{
		height:125px;
		overflow:auto;
		}					
	#form2 p.submit{
		text-align:right;
		}	
	#form2 button{
		padding:0 20px;
		height:32px;
		line-height:32px;		
		border:1px solid #70ad2e;
		background:#5aae00 url(../images/form2/form_button.gif) repeat-x;
		color:#fff;
		cursor:pointer;		
		text-align:center;		
		}				

/* // form 2 */

</style>
<form action="" method="post" id="form2">
		
			<h3><span>Admin Login</span></h3>
		
  <fieldset><legend>Netraa Login</legend>
				<p class="first">
					<label for="name">Name</label>
					<input type="text" name="username" id="username" size="30" />
				</p>
				<p>
					<label for="email">Password</label>
					<input type="password" name="password" id="password" size="30" />
				</p>
							
				
				<p class="submit"><button type="submit">Login</button></p>		
							
			</fieldset>					
						
		</form>	
        <p style="font-family:'Arial Black', Gadget, sans-serif; font-size:13px; font-weight:bolod; text-align:center; text-transform:uppercase; color:#F30;">Please Enter Valid Admin Username and Password</p>