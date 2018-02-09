 <!DOCTYPE html>
<html>
<head>
<title>Popup contact form</title>
<link href="popcss.css" rel="stylesheet">
<script src="popjs.js"></script>
</head>
<!-- Body Starts Here -->
<body id="body" style="overflow:hidden;">
<div id="abc">
<!-- Popup Div Starts Here -->
<div id="popupContact">
<!-- Contact Us Form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" method="post" name="form" enctype="multipart/form-data">
<img id="close" src="" onclick ="div_hide()">

<h2>Employee information</h2>
<button onclick="openWin()">X</button>
<hr>
Please select the image: <input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div><br/>
Name: <input id="Name" name="Name"  type="text" required ><br/>
Position: <input id="Position" name="Position"type="text" required><br/>
Emailid: <input type="text" id="Emailid" name="Emailid" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br/>
Contact: <input type="text"id="Contact" name="Contact" required> <br/>
Address: <input type="Text"id="Address" name="Address" required><br/>
Report To:  <input type="Text"id ="ReportTo" name="ReportTo" required ><br/>
Reported By: <br/><input type: "Text"id="ReportedBy" name="ReportedBy" required> <br/>
Detailed information: <br/><input type: "Text"id="Detail" name="Detail" required> <br/>


<input type="submit" id="submit" name="submit"></a>
</form>
</div>
<!-- Popup Div Ends Here -->
</div>
<button id="close" onclick="div_show()"><img src="C:\Users\Public\Pictures\Sample Pictures\Desert.jpg"></button>

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
//@$a=$_POST['OrderDate'];
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
 $s="insert into OrgChart(Name,Position,Emailid,Contact,Address,ReportTo,ReportedBy,Detail,Image) values('$a','$b','$c','$d','$e','$f','$g','$h',$i)"; 
if (move_uploaded_file($_FILES['Image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
//echo "Your Data Inserted successfully in the respective fields";
$result = mysqli_query($con, "SELECT * FROM OrgChart ORDER BY id desc LIMIT 1");
mysql_query($result);
echo $result;
}

    //And now to perform a simple query to make sure it's working
    //$query = "SELECT * FROM orders";
    //$result = mysqli_query($connection, $query);
    //$work = mysqli_query($connection, $query);
   // $text = $_GET['OrderDate','Desiredservice', 'Desireditem', 'Desiredamount', 'FromDate', 'ToDate','Priceitemday', 'Deliveryorpickup', 'CustName', 'CustAddress', 'Custemail' , 'CCNumber']; 

    //while ($row = mysqli_fetch_assoc($result)) {
      //  echo "The date is: " . $row['OrderDate'] . " and the Username is: " . $row['CustName'];
        
        
    //}
    
    //$query="INSERT INTO ClarionConcertTickets (orders)VALUES ('$text')";

?>
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<div id='img_div'>";
			echo "<img src='images/".$row['image']."' >";
			echo "<p>".$row['Name']."</p>";
		echo "</div>";
	}
if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		$text = mysqli_real_escape_string($db, $_POST['text']);

             if(['name']== $target)
{
echo "Sorry there is a file already exists with same name";
header(upload.php);
}
		$sql = "INSERT INTO OrgChart (Image) VALUES ('$image')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}

	$result = mysqli_query($db, "SELECT * FROM OrgChart ORDER BY id desc LIMIT 1");
?>
</body>
<!-- Body Ends Here -->
</html>