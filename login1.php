         <?php
include("config.php");

$host="localhost"; // Host name
$username="goteti"; // Mysql username
$password="Welcome@123"; // Mysql password
$db_name="dvishal_wp8"; // Database name
$tbl_name="login"; // Table name

// Connect to server and select databse.
$db=mysql_connect("$host", "$username", "$password",$tbl_name)or die("cannot connect");
mysql_select_db("dvishal_wp8")or die("cannot select DB");

// username and password sent from form
$username=$_POST['username'];
$password=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
//$myusername =($myusername);
//$mypassword =($mypassword);

$sql="SELECT id FROM login WHERE username='$username' AND password='$password'";
//$sql="SELECT * FROM `login` WHERE username= admin and password= Welcome@123";

//$sql=SELECT * FROM  `login` WHERE  `username` =  'admin';
$result=mysql_query($db,$sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("$myusername");
session_register("$mypassword");
echo "Made it";
header("success.php");
}
else {
echo $result;
echo "Your Login Name or Password is invalid";
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
		
  <fieldset><legend> Login</legend>
				<p class="first">
					<label for="name">Name</label>
					<input type="text" name="username" id="username" size="30" required/>
				</p>
				<p>
					<label for="email">Password</label>
					<input type="password" name="password" id="password" size="30" required/>
				</p>
							
				
				<p class="submit"><button type="submit">Login</button></p>		

							
			</fieldset>					
						
		</form>	
