<?php
	require("db.php");
	require("w2s/way2sms-api.php");
	if(isset($_REQUEST['veri_sub']))
	{
		$u=$_REQUEST['mob'];
		$sel="select * from reg where mob='$u'";
		$qq=$con->query($sel);
		$nm=$qq->num_rows;
		if($nm>0)
		{
			session_start();
			$ot=rand(1000,10000);
			$_SESSION['otp']=$ot;
			$msg="Your OTP is here ".$ot;
			sendWay2SMS ( '8866415196' , 'password' , $u , $msg);
			header("location:updatepass.php");
		}
		else
		{
			echo "wrong mobile";
		}

	}

?>
<html>
<head>
	<title>Demo</title>
</head>
<body>
		<h1 align="center">Verify Form</h1>
        
		<form method="post" id="frm">
			<table border="1" align="center">
				<tr>
					<td>Mobile :</td>
					<td><input type="text" name="mob"> 
					
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="veri_sub" value="Submit"></td>
				</tr>
			</table>
		</form>
</body>
</html>