<?php
	require("db.php");

	if(isset($_REQUEST['sib']))
	{
		$u=$_REQUEST['unm'];
		$p=$_REQUEST['pass'];
		@$g=$_REQUEST['gen'];
		@$h=$_REQUEST['hh'];
		@$hh=implode(",",$h);
		@$s=$_REQUEST['stat'];


		$fl=$_FILES['img']['name'];
		$tmp=$_FILES['img']['tmp_name'];
		// $sz=$_FILES['img']['size'];
		// $tp=$_FILES['img']['type'];
		
		$str=str_replace(".",time().".",$fl);

		$path="upload/".$str;
		
		move_uploaded_file($tmp,$path);

		$i=0;
		$msgg=array("username"=>$u,"Password"=>$p,"Gender"=>$g,"Hobby"=>$hh,"state"=>$s);
		foreach($msgg as $mk=>$mv)
		{
			$value = trim($mv);
			if(empty($value))
			{
				$i++;
				echo "Plzz fill ".$mk." Proper..!!";
				echo "<br>";
			}
		}

	if($i==0)
	{	
		$ins="insert into reg(unm,pass,gender,hobby,state,image) values('$u','$p','$g','$hh','$s','$path')";
		$qq=$con->query($ins);
		if($qq==true)
		{ 
			$msg="Successfully Inserted..!!";
		}
		else
		{
			$msg="Something is Wrong..!!";
		}
	}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
	<script type="text/javascript" src="bv/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="bv/jquery.bvalidator-yc.js"></script>
	<link type="text/css" rel="stylesheet" href="bv/bvalidator.css">
</head>
<body>
			<h1 align="center">Register Form</h1>
        <h3 align="right"><a href="login.php">Login Here...</a></h3>
        <h3 align="center"><?php
        if(isset($msg))
        {
        	echo $msg;
        }
        ?></h3>
		<form method="post" id="frm" enctype="multipart/form-data">
			<table border="1" align="center">
				<tr>
					<td>Username :</td>
					<td><input type="text" name="unm"  data-bvalidator="alpha,required" data-bvalidator-msg="username nakho..!!"></td>
				</tr> 
				<tr>
					<td>Password :</td>
					<td><input type="password" name="pass" data-bvalidator="alphanum,required"></td>
				</tr>
				<tr>
					<td>Gender :</td>
					<td><input type="radio" name="gen" value="Male" data-bvalidator="required">Male
					<input type="radio" name="gen" value="Female">Female</td>
				</tr>
				<tr>
					<td>Hobby :</td>
					<td><input type="checkbox" name="hh[]" data-bvalidator="min[2],required" value="Cricket">Cricket
					<input type="checkbox" name="hh[]" value="Chess">Chess</td>
				</tr>
                <tr>
                	<td>state :</td>
                    <td><select name="stat" data-bvalidator="required">
               	<?php
               		$sel="select * from state";
               		$qq=$con->query($sel);
               		while($ff=$qq->fetch_object())
               		{
               			?>
               			<option value="<?php echo $ff->sid; ?>"><?php echo $ff->sname; ?></option>
               			<?php
               		}
               	?>
                    </select></td>
                </tr>
                <tr>
                	<td>Image :</td>
                	<td><input type="file" name="img"></td>
                </tr>
				<tr> 
					<td colspan="2" align="center"><input type="submit" name="sib" value="Submit"></td>
				</tr>
			</table>
		</form>
		<script type="text/javascript"> 
    $(document).ready(function () {
        $('#frm').bValidator();
    });
</script> 
</body>
</html>