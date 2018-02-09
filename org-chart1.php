<?php
mysql_connect("localhost", "dvishal_wp8", "E^PGePFTJfZEO^A]Gk~17&(6") or
    die("Could not connect: " . mysql_error());
mysql_select_db("dvishal_wp8");
$result = mysql_query("SELECT user_id,Name,Position,Email_id,Contact,Address,ReportTo,ReportedBy,Detail,Image FROM OrgChart ");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);
echo "<br><br><table border='1' cellpadding=5  width=998 cellspacing=5 align=center style=font-family:verdana;>";
echo "<tr> <th>user_id</th> <th>Name</th> <th>Position</th> <th>Email_id</th> <th>Contact</th> <th>Address</th> <th>ReportTo</th> <th>ReportedBy</th> <th>Detail</th><th>Image</th></tr>";
// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result )) {
	// Print out the contents of each row into a table
	echo "<tr><td>";
	echo $row['user_id'];
	echo "</td><td>";
	echo $row['Name'];
	echo "</td><td>";
	echo $row['Position'];
	echo "</td><td>";
	echo $row['Email_id'];
	echo "</td><td>";
	echo $row['Contact'];
	echo "</td><td>";
	echo $row['Address'];
	echo "</td><td>";
	echo $row['ReportTo'];
	echo "</td><td>";
	echo $row['ReportedBy'];
	echo "</td><td>";
	echo $row['Detail'];
	echo "</td><td>";
//header("Content-type: image/jpeg");
echo $row['Image'];
     // echo $row['Image'];
	echo "</td></tr>";
}

echo "</table>";

?>