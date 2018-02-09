<?php
	$db = mysqli_connect("localhost", "dvishal_wp8", "E^PGePFTJfZEO^A]Gk~17&(6", "dvishal_wp8");
	$msg = "";

	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		$text = mysqli_real_escape_string($db, $_POST['text']);

             if(['name']== $target)
{
echo "Sorry there is a file already exists with same name";
header(upload.php);
}
		$sql = "INSERT INTO image (image, text) VALUES ('$image', '$text')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}

	$result = mysqli_query($db, "SELECT * FROM image ORDER BY id desc LIMIT 1");

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
			echo "<p>".$row['text']."</p>";
		echo "</div>";
	}
?>

	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>
		<div>
			<textarea id="text" cols="40" rows="4" name="text" placeholder="Say something about this image..."></textarea>
		</div>
Name: <input id="Name" name="Name"  type="text" required ><br/>
Position: <input id="Position" name="Position"type="text" required><br/>
Emailid: <input type="text" id="Emailid" name="Emailid" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br/>
Contact: <input type="text"id="Contact" name="Contact" required> <br/>
Address: <input type="Text"id="Address" name="Address" required><br/>
Report To:  <input type="Text"id ="ReportTo" name="ReportTo" required ><br/>
Reported By: <br/><input type: "Text"id="ReportedBy" name="ReportedBy" required> <br/>
Detailed information: <br/><input type: "Text"id="Detail" name="Detail" required> <br/>
		<div>
			<button type="submit" name="upload">Submit it</button>
		</div>
	</form>
</div>
</body>
</html>