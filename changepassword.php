<?php
// ***this page is for the home page to show the list of the product in the market
//this is php code to redirect the user to welcome page if not does not login and try to acess this page using url
session_start();
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');
if(!isset($_SESSION['userid'])||empty($_SESSION['userid']))
{
	header('location:hostelmandi.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Changepassword.css">
	<title>Manage Profile</title>
</head>
<body>

	<header>
			<div class='one'>
				<div class='logo'>
					<span>HostelMandi.com</span>
				</div>
				<div class='account'>
					<span><?php echo 'Welcome Mr.'.$_SESSION['userid'];?></span><br>
					<a href='logout.php' id='a'><button>Logout</button></a>
				</div>
			</div>
			<form id='search' action='productsearch.php' method='get'>
				<input id='search_input' type="text" name="product" placeholder="Search Your Product Here" required>
				<input type="submit" name="submit" value="Search">
			</form>

		
		<div class='link'>
			<div class='link_child'>
				<div class='a'>
					<a href='hostelmandi.php'>Welcome page</a>
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
	</header>

<?php
$userid=$_SESSION['userid'];
$query="select * from uprofile where uid=$userid";
if($query_run=mysql_query($query))
{
	$uimage=mysql_result($query_run,0,'image');
	$uname=mysql_result($query_run,0,'name');

}
else
{
	echo "error in SQL";
}
?>


	<div class="middle">
		<div class="profile_form">
			<form action='changepassword.php' method='post'>
		<img src='<?php echo $uimage;?>' alt='<?php echo $uname;?>' ><br><br>
		<p style="color:white;text-align: center;font-family:verdana;">Change Your Password</p>
		<label style="color:white;">Please Provide Your Current Password :</label><br><br>
		<input type="password" name="cur_pas" placeholder='Your Current Password'required><br><br>
		<label style="color:white;">Please Provide Your New Password :</label>
		<input type="password" name="new_pas" placeholder='Your New Password' required><br><br>
		<label style="color:white;">Please Re-enter Your New Password To Confirm Your Passsword :</label><br>
		<input type="password" name="con_pas" placeholder="Confirm Your New Password" required><br><br>
		<input id='submit_button' type="submit" name="submit" value="Change Password">
	</form>
	</div>

<?php
//php code for updating the password in the database

if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$cur_pas=$_POST['cur_pas'];
	$new_pas=$_POST['new_pas'];
	$con_pas=$_POST['con_pas'];
	$md_cur_pas=md5($cur_pas);
	$md_new_pas=md5($new_pas);


	$query="select userpassword from ulogin where uid = $userid";
	if($query_run=mysql_query($query))
	{
		$password=mysql_result($query_run,0,'userpassword');

		if($md_cur_pas!=$password)
		{
			echo "<script>alert('You Have Entered Wrong Current Password,Please Provide the Correct Current Password !!')</script>";
		}
		else
		{
			if($new_pas!=$con_pas)
			{

			echo "<script>alert('Your New Password Does Not Match With New-confirmation Password,Kindly Check and Retry Again !!')</script>";
			}
			else 				//****this block of code will be for updating the new password
			{
				$query="update ulogin set userpassword='$md_new_pas' where uid=$userid";
				if($query_run=mysql_query($query))
				{

			echo "<script>alert('Your Password Have Succesfully Changed !!')</script>";
				}
			}
		}

	}
	
}
?>
	</div>
</body>
</html>