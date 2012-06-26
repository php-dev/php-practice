<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Nettuts.com | Login</title>
<link rel="stylesheet" type="text/css" media="All" href="css/style.css" />
</head>
<body>

	<div id="wrap">
		
		<?php 
		
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("db_nepalstay") or die(mysql_error());
			
		if(isset($_POST['email']) && isset($_POST['password'])){
			// Verify
			$email = mysql_escape_string($_POST['email']);
			$password = md5($_POST['password']);
			
			$gUser = mysql_query("SELECT * FROM stay_user WHERE user_email='".$email."' AND user_pass_md5='".$password."' LIMIT 1") or die(mysql_error());
			$verify = mysql_num_rows($gUser);
			
			if($verify > 0){
				echo '<h2>Login Complete</h2>
				      <p>Click here to download our program</p>';
			}else{
				echo '<h2>Login Failed</h2>
				      <p>Sorry your login credentials are incorrect.';
			}
		}else{
		?>
		<h2>Login</h2>
		<p>Please enter your login credentials to get access to the download area</p>
		
		<form method="post" action="">
			<fieldset>
				<label for="email">Email:</label><input type="text" name="email" value="" />
				<label for="password">Password:</label><input type="text" name="password" value="" />
				<input type="submit" value="Login" />
			</fieldset>
		</form>
		
		<?php
		}
		?>
		   
	</div>

</body>
</html>
