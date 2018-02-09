<?php
include('menu.php');
mysql_connect("localhost", "root134", "Welcome@123") or
    die("Could not connect: " . mysql_error());
mysql_select_db("netra");

$result = mysql_query("SELECT id, Name, myusername, mypassword, Email, City, Cell, State FROM signup");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);
echo "<br><br><table border='1' cellpadding=5  width=998 cellspacing=5 align=center style=font-family:verdana;>";
echo "<tr> <th>S.No</th> <th>Name</th> <th>User Name</th> <th>Password</th> <th>Email</th> <th>City</th> <th>Cell</th> <th>State</th> </tr>";
// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result )) {
	// Print out the contents of each row into a table
	echo "<tr><td>"; 
	echo $row['id'];
	echo "</td><td>"; 
	echo $row['Name'];
	echo "</td><td>"; 
	echo $row['myusername'];
	echo "</td><td>"; 
	echo $row['mypassword'];
	echo "</td><td>"; 
	echo $row['Email'];
	echo "</td><td>";
	echo $row['City'];
	echo "</td><td>";
	echo $row['Cell'];
	echo "</td><td>";   
	echo $row['State'];
	echo "</td></tr>"; 
} 

echo "</table>";
?>
