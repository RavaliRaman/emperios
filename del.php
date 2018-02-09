<?php 
require_once('database.php'); 



    $Userid = $_GET['q'];
    $sql = "SELECT * FROM OrgChart WHERE Userid ={$Userid}";
    $row = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $result_id =$row['parent_id'];

    $sql = "UPDATE OrgChart SET parent_id = ";
    $sql .= "'{$result_id}' WHERE parent_id = {$Userid} LIMIT 1";
    $row = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $result_id =$row['Userid'];
    $sql = "DELETE FROM OrgChart WHERE Userid ={$Userid}";
    mysqli_query($db, $sql);
   
	header("Location: work.php");


?>