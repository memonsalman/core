<?php
	require("db.php");

	if(isset($_REQUEST['log_sub']))
	{
		
		$u=$_REQUEST['unm'];
		$p=$_REQUEST['pass'];
		$uu=mysqli_real_escape_string($con,$u);
		$pp=mysqli_real_escape_string($con,$p);

		$sel="select * from reg where unm='$uu' and pass='$pp'";
		$qq=$con->query($sel);
		$nm=$qq->num_rows;
		if($nm>0)
		{
			$ff=$qq->fetch_object();
			$idd=$ff->rid;
			$sel="select * from reg where status='Active' and rid='$idd' ";
			$qq=$con->query($sel);
			$num=$qq->num_rows;
			if($num>0)
			{

			$ch=$_REQUEST['chh'];
			if(!empty($ch))
			{
				setcookie("username",$u,time()+3600);
				setcookie("password",$p,time()+3600);
			}
 

			session_start();
			$_SESSION['user']=$ff->unm;
			$_SESSION['userid']=$ff->rid;

			header("location:home.php");
		}
		else
		{
			$msg="You are Blocked..!!";
		}

		}
		else
		{
			$msg="Wrong Username And Password..!!";
		}

	}

?>
<html>
<head>
	<title>Demo</title>
</head>
<body>
		<h1 align="center">Login Form</h1>
        <h3 align="right"><a href="index.php">register Here...</a></h3>
        <h3 align="center"><?php
        if(isset($msg))
        {
        	echo $msg;
        }
        ?></h3>
		<form method="post" id="frm">
			<table border="1" align="center">
				<tr>
					<td>Username :</td>
					<td><input type="text" name="unm" value="<?php 
					if(isset($_COOKIE['username']))
					{
						echo $_COOKIE['username'];
					}
					?>"></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type="text" name="pass"  value="<?php 
					if(isset($_COOKIE['password']))
					{
						echo $_COOKIE['password'];
					}
					?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="checkbox" name="chh" value="1">Remember Me..!!</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><a href="forget.php">Forget Passwords..!!</a></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="log_sub" value="Submit"></td>
				</tr>
			</table>
		</form>
</body>
</html>