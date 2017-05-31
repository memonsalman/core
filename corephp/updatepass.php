<?php
	require("db.php");
	//require("w2s/way2sms-api.php");
	if(isset($_REQUEST['veri_sub']))
	{
		$u=$_REQUEST['otp'];
		$m=$_REQUEST['mob'];
		$p=$_REQUEST['pass'];
		
		session_start();
		print_r($_SESSION);
		if($_SESSION['otp']==$u)
		{
			$sel="select * from reg where mob='$m'";
			$qq=$con->query($sel);
			$nn=$qq->num_rows;
			if($nn>0)
			{
				$ff=$qq->fetch_object();
				$id=$ff->rid;
				$upd="update reg set pass='$p' where rid='$id'";
				$con->query($upd);
				session_destroy();
				header("location:login.php");
			}
			else
			{
				echo "your mobile number is wrong..!!";
			}
		}
		else
		{
			echo "OTP is Incorrect..!!";
		}

	}

?>
<html>
<head>
	<title>Demo</title>
</head>
<body>
		<h1 align="center">Update Pass</h1>
        
		<form method="post" id="frm">
			<table border="1" align="center">
				<tr>
					<td>OTP :</td>
					<td><input type="text" name="otp">
				</tr>
				<tr>
					<td>Mobile :</td>
					<td><input type="text" name="mob"></td>
				</tr>
				<tr>
					<td>New Password :</td>
					<td><input type="text" name="pass">
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="veri_sub" value="Submit"></td>
				</tr>
			</table>
		</form>
</body>
</html>