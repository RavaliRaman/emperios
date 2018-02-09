<html>
<body>

<form action="query.php"method="POST">
  Population:<br>
  <input type="text" name="query" ><br>
    <input type="submit" value="Search">
  <input type="reset">
    
</form>

<?php
mysql_connect("localhost", "root134", "Welcome@123") or
    die("Could not connect: " . mysql_error());
mysql_select_db("netra");

$result = mysql_query("SELECT ID, Name, CountryCode, District,Population FROM city");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);
echo "<br><br><table border='1' cellpadding=5  width=998 cellspacing=5 align=center style=font-family:verdana;>";
echo "<tr> <th>ID</th> <th>Name</th> <th>CountryCode</th> <th>District</th> <th>Population</th></tr>";
// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result )) {
	// Print out the contents of each row into a table
	echo "<tr><td>"; 
	echo $row['ID'];
	echo "</td><td>"; 
	echo $row['Name'];
	echo "</td><td>"; 
	echo $row['CountryCode'];
	echo "</td><td>"; 
	echo $row['District'];
	echo "</td><td>"; 
	echo $row['Population'];
	echo "</td><td>";
	 
}
 
$result1 = mysql_query("SELECT Population FROM city");
if(!result1>270007)
{
echo 'Could not run query: ' . mysql_error();
    exit;

}
$row = mysql_fetch_row($result1);
echo "<tr> <th>ID</th> <th>Name</th> <th>CountryCode</th> <th>District</th> <th>Population</th></tr>";
// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result1 )) {
	// Print out the contents of each row into a table
	echo "<tr><td>"; 
	echo $row['ID'];
	echo "</td><td>"; 
	echo $row['Name'];
	echo "</td><td>"; 
	echo $row['CountryCode'];
	echo "</td><td>"; 
	echo $row['District'];
	echo "</td><td>"; 
	echo $row['Population'];
	echo "</td><td>";
	 
}

echo "</table>";

?>
</body>
</html>


