<?php
	session_start();
	include("db.php");

	if(isset($_SESSION['userid']))
	{
		$id=$_SESSION['userid'];
		$sel="select * from reg where rid='$id'";
		$qq=$con->query($sel);
		$fer=$qq->fetch_object();


		if(isset($_REQUEST['upd_sub']))
		{
			$u=$_REQUEST['unm'];
			$p=$_REQUEST['pass'];
			$g=$_REQUEST['gen'];
			$h=$_REQUEST['hh'];
			$hh=implode(",",$h);
			$s=$_REQUEST['stat'];

			$upd="update reg set unm='$u',pass='$p',gender='$g',hobby='$hh',state='$s' where rid='$id'";
			$con->query($upd);
			header("location:home.php");
		}



	}


	// if(isset($_REQUEST['edt']))
	// {
	// 	$id=$_REQUEST['edt'];
	// 	$sel="select * from reg where rid='$id'";
	// 	$qq=$con->query($sel);
	// 	$fer=$qq->fetch_object();
	// }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
			<h1 align="center">Update Form</h1>
        
		<form method="post" id="frm">
			<table border="1" align="center">
				<tr>
					<td>Username :</td>
					<td><input type="text" name="unm" value="<?php echo $fer->unm; ?>" ></td>
				</tr> 
				<tr>
					<td>Password :</td>
					<td><input type="password" name="pass" value="<?php echo $fer->pass; ?>" ></td>
				</tr>
				<tr>
					<td>Gender :</td>
					<td><input type="radio" name="gen"
					<?php
						if($fer->gender=="Male")
						{
							echo "checked='checked'";
						}
					?>
					 value="Male">Male
					<input type="radio" name="gen"
					<?php
						if($fer->gender=="Female")
						{
							echo "checked='checked'";
						}
					?>
					 value="Female">Female</td>
				</tr>
				<tr>
				<?php
				$hh=$fer->hobby;
				$ex=explode(",",$hh);

				?>
					<td>Hobby :</td>
					<td><input type="checkbox" name="hh[]"
					<?php
					if(in_array("Cricket",$ex))
					{
						echo "checked='checked'";
					}	

					?>
					 value="Cricket">Cricket
					<input type="checkbox" name="hh[]"
					<?php
					if(in_array("Chess",$ex))
					{
						echo "checked='checked'";
					}	

					?> value="Chess" >Chess</td>
				</tr>
                <tr>
                	<td>state :</td>
                    <td><select name="stat" >
               	<?php
               		$sel="select * from state";
               		$qq=$con->query($sel);
               		while($ff=$qq->fetch_object())
               		{
               			if($fer->state==$ff->sid)
               			{
               			?>
               			<option selected value="<?php echo $ff->sid; ?>"><?php echo $ff->sname; ?></option>
               			<?php
               			}	
               			else
               			{
               			?>
               			<option  value="<?php echo $ff->sid; ?>"><?php echo $ff->sname; ?></option>
               			<?php
               			}
               		}
               	?>
                    </select></td>
                </tr>
				<tr> 
					<td colspan="2" align="center"><input type="submit" name="upd_sub" value="Submit"></td>
				</tr>
			</table>
		</form>
</body>
</html> 