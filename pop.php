<!DOCTYPE html>
<html>
<head>
<title>Popup contact form</title>
<link href="popcss.css" rel="stylesheet">
<script src="popjs.js"></script>
</head>
<!-- Body Starts Here -->
<body id="body" style="overflow:hidden;">
<?php
	$db = mysqli_connect("localhost", "dvishal_wp8", "E^PGePFTJfZEO^A]Gk~17&(6", "dvishal_wp8");
	$msg = "";

	if (isset($_POST['submit'])) {
		$target = "images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
                 $imagetemp=addslashes (file_get_contents($_FILES['image']['name']));


             if(['name']== $target)
{
echo "Sorry there is a file already exists with same name";
header(upload.php);
}
		$sql = "INSERT INTO Image VALUES ('$imagetemp','$image')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}

	$result = mysqli_query($db, "SELECT * FROM Image ORDER BY id desc LIMIT 1");

?>
<div id="abc">
<!-- Popup Div Starts Here -->
<div id="popupContact">
<!-- Contact Us Form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" method="post" name="form" enctype="multipart/form-data">
<img id="close" src="" onclick ="div_hide()">

<h2>Employee information</h2>
<button onclick="openWin()">X</button>
<hr>
Name: <input id="Name" name="Name"  type="text" required ><br/>
Position: <input id="Position" name="Position"type="text" required><br/>
Emailid: <input type="text" id="Emailid" name="Emailid" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br/>
Contact: <input type="text"id="Contact" name="Contact" required> <br/>
Address: <input type="Text"id="Address" name="Address" required><br/>
Report To:  <input type="Text"id ="ReportTo" name="ReportTo" required ><br/>
Reported By: <br/><input type: "Text"id="ReportedBy" name="ReportedBy" required> <br/>
Detailed information: <br/><input type: "Text"id="Detail" name="Detail" required> <br/>
Upload an Image:<input type="hidden" name="size" value="1000000">
<div>
			<input type="file" name="image">
		</div>

<input type="submit" id="submit" name="submit"></a>
</form>
</div>
<!-- Popup Div Ends Here -->
</div>
<button id="close" onclick="div_show()"></button>
<?php
 

//Connect to the database
    $host = "127.0.0.1";
    $user = "dvishal_wp8";                     //Your Cloud 9 username
    $pass = "E^PGePFTJfZEO^A]Gk~17&(6";                                  //Remember, there is NO password by default!
    $db = "dvishal_wp8";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());

$con = mysql_connect("localhost","dvishal_wp8","E^PGePFTJfZEO^A]Gk~17&(6");
mysql_select_db("dvishal_wp8", $con);

@$a=$_POST['Name']; 
@$b=$_POST['Position'];
@$c=$_POST['Emailid'];
@$d=$_POST['Contact'];
@$e=$_POST['Address'];
@$f=$_POST['ReportTo'];
@$g=$_POST['ReportedBy'];
@$h=$_POST['Detail'];
@$i=$_POST['Image'];
if(@$_POST['submit'])
{
 $s="insert into OrgChart(Name,Position,Emailid,Contact,Address,ReportTo,ReportedBy,Detail,Image) values('$a','$b','$c','$d','$e','$f','$g','$h','$i')"; 
echo "Your Data Inserted successfully in the respective fields";
mysql_query($s);
}


?>
</body>
<!-- Body Ends Here -->
</html>