<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Register.css">
	<title>Register page</title>
</head>
<body>

<?php
//php code to check if the user is logged or not according to that give different navigations
session_start();
if(isset($_SESSION['userid'])&&!empty($_SESSION['userid']))
{
		
	echo "
	<header>
		<div class='one'>
			<div class='logo'>
				<span>HostelMandi.com</span>
			</div>
			<div class='account'>

			<span>Welcome Mr.".$_SESSION['userid']."</span><br>
			<a href='logout.php' id='a'><button>Logout</button></a>
			</div>
		</div>
		
		<div class='link'>
			<div class='link_child'>
				<div class='a'>
					<a href='hostelmandi.php' style='color:yellow;'>Welcome page</a>
				</div>
				<div class='a'>
					<a href='home.php'>Home page</a>
				</div>
				<div class='a'>
					<a href=''>Manage Profile</a>
				</div>
			</div>
			<div class='link_child'>
				<div class='a'>
					<a href=''>Sell My Product</a>
				</div>
				<div class='a'>
					<a href=''>Profile</a>
				</div>
			</div>
		</div>
	</header>";
	die('You Are Already Logged In ..');
}
else
{

	echo "
	<header>
		<div class='one'>
			<div class='logo'>
				<span>HostelMandi.com</span>
			</div>
			<div class='account'>
				<span>Not Logged In</span><br>
				
			</div>
		</div>
		
		<div class='link'>
			<div class='link_child'>
				<div class='a'>
					<a href='hostelmandi.php'>Welcome</a>
				</div>
				<div class='a'>
					<a href='register.php' style='color:yellow'>Register</a>
				</div>
			</div>
			<div class='link_child'>
				<div class='a'>
					<a href='login.php'>Login</a>
				</div>
			</div>
		</div>
	</header>";
}
?>	
<div class="middle">
	<div class="register_form">
			<form action='register.php' method='post'>
				<img src='user.jpg' alt='no picture' ><br><br>
				<p style="color:yellow;font-family:verdana;font-size:20px;margin-left: 10px;">Create Your HostelMandi Account</p>
				<span style="color:white;font-family:arial;color:white;margin-left: 10px;">(*) represents that field is mandatory</span><br>
				<BR>
				<label style="color:white;font-family:arial;margin-left: 10px;">* Username </label><br>
				<input type='text' placeholder='Enter the the username' name='username'  required><br><br>
				
				<label style="color:white;font-family:arial;margin-left: 10px;">* Password </label><br>
				<input type='password' placeholder='Create your password' name='password' required><br><br>
				<label style="color:white;font-family:arial;margin-left: 10px;">* re-enter your password </label><br>
				
				<input type='password' placeholder='Enter your password again' name='repassword' required><br><br>
				<input id='submit_button' type='submit' value='Create Account' name='submit'>
				<br><br>
				<p style='color:white;margin-left: 10px;padding:1px;'>In case you have already created your account ,you can <a href='login.php' style='color:yellow;font-weight: bold;'>login</a> directly </p>
			</form>
	</div>
</div>

<?php
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');

if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$username=ltrim($username);			//the username after triming the left side of the username				
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	$hash_password=md5($password);						//md5 enctrypted form of the password

	//we will check that if the username already exist in database ,if yes then error
	//writing the query to fetch the username
	$query="select * from ulogin where username like '$username'";

	if($query_run=mysql_query($query))
	{
		if($password!=$repassword)
		{
			echo "<script>alert('The password does not match with conform password')</script>";
		}
		else
		{
			if(mysql_num_rows($query_run)>0)
		{
			echo "<script>alert('The username already exists!please try for the new username')</script>";
		}
		else
		{
			$query="insert into ulogin values('','$username','$hash_password')";
			if($query_run=mysql_query($query))
			{
				echo "<script>alert('You have Successfully Create your account !!')</script>";
			}

		}
		}
		
	}
	else
	{
		echo "query error";
	}




}
?>



</body>
</html>