<?php
		include("way2sms-api.php");

		if(isset($_REQUEST['sub']))
		{
				$m=$_REQUEST['mob'];
				$mx=explode(',',$m);
				$mg=$_REQUEST['msg'];

				foreach($mx as $ex)
				{
					sendWay2SMS ( '8866415196' , '7415963' , $ex , $mg);
				}
		}
?>

<html>
		<head>
				<title>w2sms</title>
		</head>
		<body>
				<h1 align="center">Send Message</h1>
				<form method="post">
						<table border="1" align="center">
							<tr>
									<td>Mobile : </td>
									<td><input type="text" name="mob"></td>
							</tr>
							<tr>
									<td>msg : </td>
									<td><textarea name="msg"></textarea></td>
							</tr>
							<tr>
									<td colspan="2" align="center"><input type="submit" name="sub" value="Send"></td>
							</tr>
						</table>

				</form>
		</body>
</html>