<?php
include('menu.php');
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = 'select a.id, a.Name, a.Email,a.City, b.SelectAd,b.Title,b.Description,b.Price from signup a, postad b where a.Email=b.EmailId'; 

mysql_select_db('netra');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<br><br><table border='1' width=998 cellpadding=2 cellspacing=2 align=center style=font-family:verdana;>";
echo "<tr> <th>S.No</th> <th>Name</th> <th>Email</th> <th>City</th> <th>SelectAd</th> <th>Title</th> <th>Description</th> <th>Price</th> <th>picture</th> </tr>";
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	
	
    echo "<tr><td>"; 
	echo $row['id'];
	echo "</td><td>"; 
	echo $row['Name'];
	echo "</td><td>"; 
	echo $row['Email'];
	echo "</td><td>";
	echo $row['City'];
	echo "</td><td>";
	echo $row['SelectAd'];
	echo "</td><td>";
	echo $row['Title'];
	echo "</td><td>";
	echo $row['Description'];
	echo "</td><td>";
	echo $row['Price'];
	echo "</td></tr>"; 
	
} 
echo "</table>";
mysql_close($conn);
?>