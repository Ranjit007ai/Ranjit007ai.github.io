<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Hostelmandi.css">
	<title>Home page</title>
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
					<a href='createprofile.php'>Manage Profile</a>
				</div>
			</div>
			<div class='link_child'>
				<div class='a'>
					<a href='sellproduct.php'>Sell My Product</a>
				</div>
				<div class='a'>
					<a href='profilepage.php'>Profile</a>
				</div>
			</div>
		</div>
	</header>";
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
					<a href='hostelmandi.php' style='color:yellow'>Welcome</a>
				</div>
				<div class='a'>
					<a href='register.php'>Register</a>
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
		<br>
		<div class="content">
			<h2>THIS IS AN ONLINE SHOPPING SITE <br>WHERE YOU CAN SELL AND BUY THE PRODUCT FROM YOUR SURROUNDING FRIEND</h2>			
		</div>
	</div>
	<footer>
		
	</footer>

</body>
</html>