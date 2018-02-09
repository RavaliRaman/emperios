<?php
require_once('database.php'); 


if(isset($_POST['create']))
    {
        $update_Name = $_POST['Name'];
	    $update_Position = $_POST['Position'];
	    $update_parent_id = $_POST['parent_id'];
$update_Emailid = $_POST['Emailid'];
$update_Contact = $_POST['Contact'];
$update_Address = $_POST['Address'];
$update_ReportTo = $_POST['ReportTo'];
$update_ReportedBy = $_POST['ReportedBy'];
$update_Detail = $_POST['Detail'];
	    $update_image = $_POST['image'];
	    
	    
            $sql = "INSERT INTO OrgChart(parent_id, Name, Position,Emailid,Contact,Address,ReportTo,ReportedBy,Detail,image) ";
            $sql .= "VALUE('{$update_parent_id}','{$update_Name}','{$update_Position}','{$update_Emailid}','{$update_Contact}','{$update_Address}','{$update_ReportTo}','{$update_ReportedBy}','{$update_Detail}','{$update_image}')";
            $result = mysqli_query($db,$sql);
            if(!$result)
            {
                die('Query failsad' . mysqli_error($db));
            }
            else{
    	header("Location: work.php");
    }
        
    }

if(isset($_POST['update']))
{
    $update_Name = $_POST['Name'];
	    $update_Position = $_POST['Position'];
	    $update_parent_id = $_POST['parent_id'];
$update_Emailid = $_POST['Emailid'];
$update_Contact = $_POST['Contact'];
$update_Address = $_POST['Address'];
$update_ReportTo = $_POST['ReportTo'];
$update_ReportedBy = $_POST['ReportedBy'];
$update_Detail = $_POST['Detail'];
	    $update_image = $_POST['image'];
    $update_id =$_GET['id'];
    $sql = "UPDATE OrgChart SET ";
    $sql .= "parent_id = '{$update_parent_id}',Name = '{$update_Name}',Position = '{$update_Position}',Emailid = '{$update_Emailid}', Contact = '{$update_Contact}',Address = '{$update_Address}',ReportTo = '{$update_ReportTo}',ReportedBy = '{$update_ReportedBy}',Detail = '{$update_Detail}',image = '{$update_image}'  WHERE Userid = '$update_id' LIMIT 1";
    $result = mysqli_query($db,$sql);

    if(!$result)
    {
        die('Query fail' . mysqli_error($db));
    } else{
    	header("Location: work.php");
    }
}


    // main code



if(isset($_GET['edit']))
 { 
	
    $edit_id = $_GET['edit'];
    $sql = "SELECT * FROM OrgChart WHERE Userid ={$edit_id} LIMIT 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    
                        $Userid =$row['Userid'];
	                $parent_id =$row['parent_id'];
	                $Name =$row['Name'];
	                $Position =$row['Position'];
                        $Emailid =$row['Emailid'];
                        $Contact =$row['Contact'];
                        $Address =$row['Address'];
                        $ReportTo =$row['ReportTo'];
                        $ReportedBy =$row['ReportedBy'];
                        $Detail =$row['Detail'];
	                $image =$row['image'];
  ?>
       <form action="update.php?Userid=<?php echo $Userid; ?>" method = "post">
        <div class="form-group">
        <lable for "cat-title"> Edit User</label><br>
       Name: <input value = "<?php if(isset($Name)) { echo $Name; } ?>" type="text" class="form-control" name="name"><br>
       Parentid: <input value = "<?php if(isset($parent_id)) { echo $parent_id; } ?>" type="text" class="form-control" name="parent_id"><br>
       Position: <input value = "<?php if(isset($Position)) { echo $Position; } ?>" type="text" class="form-control" name="Position"><br>
        Emailid:<input value = "<?php if(isset($Emailid)) { echo $Emailid; } ?>" type="text" class="form-control" name="Emailid"><br>
        Contact:<input value = "<?php if(isset($Contact)) { echo $Contact; } ?>" type="text" class="form-control" name="Contact"><br>
        Address:<input value = "<?php if(isset($Address)) { echo $Address; } ?>" type="text" class="form-control" name="Address"><br>
        Reporting To:<input value = "<?php if(isset($ReportTo)) { echo $ReportTo; } ?>" type="text" class="form-control" name="ReportTo"><br>
        Reported By:<input value = "<?php if(isset($ReportedBy)) { echo $ReportedBy; } ?>" type="text" class="form-control" name="ReportedBy"><br>
        Detailed Information: <input value = "<?php if(isset($Detail)) { echo $Detail; } ?>" type="text" class="form-control" name="Detail"><br>
       Image Source: <input value = "<?php if(isset($image)) { echo $image; } ?>" type="text" class="form-control" name="image"><br>
        </div>
        <div class="form-group">
        <input classs= "btn btn-primary" type="submit" name="update" value = "Update_User">
        </div>
    </form>
  <?php } 
  if(isset($_GET['create']))
 { 
 	$parent_id = $_GET['create'];


 ?>
       <form action="update.php?>" method = "post">
        <div class="form-group">
        <lable for "cat-title"> Create User</label><br>
        <input  type="text" class="form-control" name="Name"><br>
        <input  value = "<?php if(isset($parent_id)) { echo $parent_id; } ?>" type="text" class="form-control" name="parent_id"><br>
        <input  type="text" class="form-control" name="Position"><br>
        <input  type="text" class="form-control" name="Emailid"><br>
        <input  type="text" class="form-control" name="Contact"><br>
        <input  type="text" class="form-control" name="Address"><br>
        <input  type="text" class="form-control" name="ReportTo"><br>
        <input  type="text" class="form-control" name="ReportedBy"><br>
        <input  type="text" class="form-control" name="Detail"><br>
        <input  type="text" class="form-control" name="image"><br>
        </div>
        <div class="form-group">
        <input classs= "btn btn-primary" type="submit" name="create" value = "ADD_User">
        </div>
    </form>
  <?php } 
    ?>