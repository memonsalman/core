<?php
	require("db.php");
	session_start();

	if(isset($_REQUEST['del']))
	{
		$id=$_REQUEST['del'];

		$sel="select * from reg where rid='$id'";
		$qq=$con->query($sel);
		$ff=$qq->fetch_object();
		$st=$ff->image;

		$del="delete from reg where rid='$id'";
		$con->query($del);
		unlink($st);
		header("location:home.php");
	}

	if(isset($_REQUEST['muld']))
	{
		$m=$_REQUEST['mul'];
		foreach($m as $mm)
		{

			$sel="select * from reg where rid='$mm'";
			$qq=$con->query($sel);
			$ff=$qq->fetch_object();
			$st=$ff->image;
			$del="delete from reg where rid='$mm'";
			$con->query($del);
			@unlink($st);
		}
	}


	if(isset($_REQUEST['sts']))
	{
		$id=$_REQUEST['sts'];
		$sel="select * from reg where rid='$id'";
		$qq=$con->query($sel);
		$ff=$qq->fetch_object();
		
		$st=$ff->status;
		if($st=="Active")
		{
			$upd="update reg set status='Block' where rid='$id'";
			$con->query($upd);
		}
		else if($st=="Block")
		{
			$upd="update reg set status='Active' where rid='$id'";
			$con->query($upd);
		}
		header("location:home.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
		<script type="text/javascript" src="bv/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="bv/jquery.dataTables.min.js"></script>
	<link type="text/css" rel="stylesheet" href="bv/jquery.dataTables.min.css">
</head>
<body>
			<h1 align="center">Homepage</h1>
			<h3 align="center"><?php 
			if(isset($_SESSION['user']))
			{
				echo "Welcome ".$_SESSION['user'];
			}
			else
			{
				header("location:login.php");
			}
			 ?></h3>
			 <h3 align="right"><a href="logout.php">Logout</a></h3>
			 <form method="post">
			 <table border="1" id="tbl" align="center">
			 <thead>
			 	<tr>
			 		<td>#</td>
			 		<td>No.</td>
			 		<th>Pic</th>
			 		<td>Username</td>
			 		<td>Password</td>
			 		<td>Gender</td>
			 		<td>Hobby</td>
			 		<td>State</td>
			 		<td>Delete</td>
			 		<td>Edit</td>
			 		<td>Status</td>
			 	</tr>
			 	</thead>
			 	<tbody>
			 	<?php
			 	
			 	$i=1;
			 	$sel="select * from reg join state on reg.state=state.sid where status='Active'";
			 	$qe=$con->query($sel);
			 	while($fr=$qe->fetch_object())
			 	{
			 	?>
			 	<tr>
			 		<td><input type="checkbox" name="mul[]" value="<?php echo $fr->rid; ?>"></td>
			 		<td><?php echo $i; ?></td>
			 		<td><img src="<?php echo $fr->image; ?>" height="100px" width="100px"></td>
			 		<td><?php echo $fr->unm; ?></td>
			 		<td><?php echo $fr->pass; ?></td>
			 		<td><?php echo $fr->gender; ?></td>
			 		<td><?php echo $fr->hobby; ?></td>
			 		<td><?php echo $fr->sname; ?></td>
			 		<td><a href="home.php?del=<?php echo $fr->rid; ?>">Delete</a></td>
			 		<td><a href="update.php?edt=<?php echo $fr->rid; ?>">Edit</a></td>
			 		<td><a href="home.php?sts=<?php echo $fr->rid; ?>"><?php echo $fr->status; ?></a></td>
			 	</tr>
			 	<?php
			 		$i++;
		 			}
			 	?>
			 	</tbody>
			 	<tr>
			 		<td colspan="11" align="center"><input type="submit" name="muld" value="Delete"></td>
			 	</tr>
			 </table>
			 </form>
			 <script type="text/javascript">
			 	$(document).ready(function(){
    $('#tbl').DataTable();
});
			 </script>
</body>
</html>