<?php
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to delete this record?");
		if (result==true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
<?php
if(isset($_GET[delid]))
{
$sqldel = "DELETE FROM applicationform where AppId='$_GET[delid]'";
$resdel = mysqli_query($con,$sqldel);
	if(!$resdel)
	{
		echo "Failed to delete... Problem in sql query";
	}
	else
	{
		$msg = "Record deleted successfully..";
	}
}
?>

<?php
$sql="SELECT * FROM applicationform WHERE apptype='Job application'";
$resapplicationform=mysqli_query($con,$sql);
?>

<p><strong><?php echo $msg; ?></strong></p>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>View Job applicants</h2>
            <p>

<table  class="tftable" border="2">
<tr>
<th>RegNo</th>
<th>Name</th>
<th>Job Details</th>
<th>Applied date</th>
<th>Resume</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php
while($rs = mysqli_fetch_array($resapplicationform))
{
	$sql1="SELECT * FROM students where RegNo='$rs[RegNo]'";
	$resapplicationform1=mysqli_query($con,$sql1);
	$rs1 = mysqli_fetch_array($resapplicationform1);
	
	$sql2="SELECT * FROM jobs where JobId='$rs[JobId]'";
	$resapplicationform2=mysqli_query($con,$sql2);
	$rs2 = mysqli_fetch_array($resapplicationform2);
	echo "<tr>";
	echo "<td>$rs[RegNo]</td>";
	echo "<td>$rs1[FirstName] $rs1[LastName]</td>";	
	echo "<td>
	Job code: $rs2[JobId] <br>
	Job title: $rs2[JobTitle]</td>";
	echo "<td>$rs[AppliedDate]</td>";
	echo "<td>$rs[Resume]</td>";
	echo "<td>$rs[Status]</td>";
	echo "<td>
	<a href='viewapplication.php?delid=$rs[AppId]' onclick='return ConfirmDelete()'>Delete</a></td>";
	echo "</tr>";
}
?>
</table>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
	