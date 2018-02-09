<?php
	$db = mysqli_connect("localhost", "dvishal_wp8", "E^PGePFTJfZEO^A]Gk~17&(6", "dvishal_wp8");
	$msg = "";

	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		
$Name = mysqli_real_escape_string($db,$_POST['Name']);
		$Position = mysqli_real_escape_string($db, $_POST['Position']);
               $Emailid = mysqli_real_escape_string($db, $_POST['Emailid']);
$Contact = mysqli_real_escape_string($db, $_POST['Contact']);
$Address = mysqli_real_escape_string($db, $_POST['Address']);
$ReportTo = mysqli_real_escape_string($db, $_POST['ReportTo']);
$ReportedBy = mysqli_real_escape_string($db, $_POST['ReportedBy']);
$Detail = mysqli_real_escape_string($db, $_POST['Detail']);

//$sql = "INSERT INTO OrgChart (Image,Name,Position,Emailid,Contact,Address,ReportTo,ReportedBy,Detail) VALUES ('$Image', '$Name','$Position','$Emailid','$Contact','$Address','$ReportTo','$ReportedBy','$Detail')";

		$sql = "INSERT INTO OrgChart (image,Name,Position,Emailid,Contact,Address,ReportTo,ReportedBy,Detail) VALUES ('$image', '$Name','$Position','$Emailid','$Contact','$Address','$ReportTo','$ReportedBy','$Detail')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}

	$result = mysqli_query($db, "SELECT * FROM OrgChart ORDER BY Userid desc LIMIT 1");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<style type="text/css">
		#content{
			width: 50%;
			margin: 20px auto;
			border: 1px solid #cbcbcb;
		}
		form{
			width: 50%;
			margin: 20px auto;
		}
		form div{
			margin-top: 5px;
		}
		#img_div{
			width: 80%;
			padding: 5px;
			margin: 15px auto;
			border: 1px solid #cbcbcb;
		}
		#img_div:after{
			content: "";
			display: block;
			clear: both;
		}
		img{
			float: left;
			margin: 5px;
			width: 300px;
			height: 140px;
		}
	</style>
</head>
<body>
<div id="content">
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<div id='img_div'>";
			echo "<img src='images/".$row['image']."' >";
                        echo "<p>".$row['Name']."</p>";
                        echo "<p>".$row['Position']."</p>";
                        echo "<p>".$row['Emailid']."</p>";
                       echo "<p>".$row['Contact']."</p>";
                       echo "<p>".$row['Address']."</p>";
                       echo "<p>".$row['ReportTo']."</p>";
                       echo "<p>".$row['ReportedBy']."</p>";
                       echo "<p>".$row['Detail']."</p>";
			
		echo "</div>";
	}
?>

	<form method="POST" action="bad.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>

<div>
Name: <input id="Name" name="Name"  type="text" required ><br/>
</div>
<div>

Position: <input id="Position" name="Position"type="text" required><br/>
</div>
<div>
Emailid: <input type="text" id="Emailid" name="Emailid" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br/>
</div>
<div>
Contact: <input type="text"id="Contact" name="Contact" required> <br/>
</div>
<div>
Address: <input type="Text"id="Address" name="Address" required><br/>
</div>
<div>
Report To:  <input type="Text"id ="ReportTo" name="ReportTo" required ><br/>
</div>
<div>
Reported By: <br/><input type: "Text"id="ReportedBy" name="ReportedBy" required> <br/>
</div>
<div>
Detailed information: <br/><input type: "Text"id="Detail" name="Detail" required> <br/>
</div>	
		
		<div>
			<button type="submit" name="upload">Submit</button>
		</div>
	</form>
</div>
</body>
</html>