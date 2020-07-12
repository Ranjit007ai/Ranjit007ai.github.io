<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Login.css">
	<title>Login page</title>
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
	die('You Are Already Logged In..');
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
					<a href='register.php'>Register</a>
				</div>
			</div>
			<div class='link_child'>
				<div class='a'>
					<a href='login.php' style='color:yellow'>Login</a>
				</div>
			</div>
		</div>
	</header>";
}
?>	
<div class="middle">
	<div class="register_form">
			<form action='login.php' method='post'>
		<img src='user.jpg' alt='no picture' ><br><br>
	
		
		<p style="color:yellow;font-size:20px;margin-left: 20px;">Login to HostelMandi</p>
		<label style="color:white;font-family:arial;margin-left: 20px;">Enter Username </label><br>
		<input type='text' placeholder='Enter the the username' name='username' required><br><br>
		<label style="color:white;font-family:arial;margin-left: 20px;">Enter Password </label><br>
		<input type='password' placeholder='Create your password' name='password' required><br><br>
		
		<input id='submit_button' type='submit' value='Login' name='submit'>
		<br><br>
		<p style='color:white;'>In case you do not have created your Account,you can <a href='register.php' style='color:yellow;font-weight: bold;'>Create Account</a></p>

	</form>
	</div>
</div>


<?php
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$hash_password=md5($password);
	 $hash_password;
	$query="select * from ulogin where username like '$username' and userpassword like '$hash_password'";
	if($query_run=mysql_query($query))
	{
		if(mysql_num_rows($query_run)==null)
		{
			echo "<script>alert('No such Username exists! please enter correct username/password!')</script>";
		}
		else{
				$userid=mysql_result($query_run,0,'uid');
				$_SESSION['userid']=$userid;
				header('location:home.php');
				
		}
	}
	else
	{
		echo "not run";
	}
}

?>

</body>
</html>