require 'connection.php';
$conn    = Connect();
$name    = $conn->real_escape_string($_POST['Name']);
$position    = $conn->real_escape_string($_POST['Position']);
$contact  = $conn->real_escape_string($_POST['Contact']);
$email   = $conn->real_escape_string($_POST['Emailid']);
$address   = $conn->real_escape_string($_POST['Address']);
$reportto   = $conn->real_escape_string($_POST['ReportTo']);
$reportedby  = $conn->real_escape_string($_POST['ReportedBy']);
$detail   = $conn->real_escape_string($_POST['Detail']);
$query   = "INSERT into OrgChart(Name,Position,Emailid,Address,ReportTo,ReportedBy,Detail) VALUES('" . $name . "','" . $position . "','" . $contact . "','" . $email . "','" . $address . "','" . $reportto . "','" . $reportedby . "','" . $detail . "',)";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}
 
echo "Thank You For Contacting Us <br>";
 
$conn->close();
 
?>