<?php
// ***this page is for the product page ,here complete information of the product will be show to buy it.
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
	<link rel="stylesheet" type="text/css" href="buyproduct.css">
	<title>Buy Product page</title>
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
//php code for checking if the user have created the profile ,he cannot buy product without creating the profile
$query="select * from uprofile where  uid =".$_SESSION['userid']."";

if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==0)
	{
		echo "<br><span>You cannot buy any product without creating your profile,kindly create your profile First..</span>";
		echo "<a href='manage.php' style='color:blue;text-decoration:underline;'>Click Here</a> <span>to create your profile..</span>";
		die();
	}
	
}
?>


	<div class="middle">


<?php
//php code for getting the buyer information...

if(isset($_GET['pid'])&& !empty($_GET['pid']))
{	
	
	$uid=$_SESSION['userid'];
	$pid=$_GET['pid'];
	$query="select up.* from uprofile up where up.uid=$uid";
	$product_query="select * from product where pid=$pid";

	if($query_run=mysql_query($query))
	{
		if($product_query_run=mysql_query($product_query))
		{


		//data from uprofile table in the database..
		$name=mysql_result($query_run,0,'name');

		$gender=mysql_result($query_run,0,'gender');

		$mobile=mysql_result($query_run,0,'mobile');

		$address=mysql_result($query_run,0,'address');

		$college=mysql_result($query_run,0,'college');

		$hostel=mysql_result($query_run,0,'hostel');

		$image=mysql_result($query_run,0,'image');


		//data from the product table.
		$product_name =mysql_result($product_query_run,0,'pname');
		$price=mysql_result($product_query_run,0, 'price');
		$p_image=mysql_result($product_query_run,0, 'pimage');

		echo "
		<div class='content'>
			<p style='color:red;'>Kindly go through the following information before procedding to buy... </p>
			<div class='buyer_info'>
				<h1 style='color:blue'>BUYER'S INFORMATION</h1>
				<img src='$image'><br>
				<p>Buyer Name :<strong>".strtoupper($name)."</strong></p>
				<p>Gender :<strong>".strtoupper($gender)."</strong></p>
				<p>Mobile Number :<strong>$mobile</strong></p>
				<span>Buyer Address :<strong style='font-size:12px;'>$address</strong></span>
			</div>
			<div class='product_info'>
				<h1 style='color:blue;''>PRODUCT'S INFORMATION</h1>
				<img src='$p_image'><br><br>
				<p>Product Name :<strong>".strtoupper($product_name)."</strong></p>
				<p>Price :<strong>Rs.$price</strong></p>
				<p style='color:red;'>(Warning) Once You Send The Request to Buy the Product ,then you <strong>Cannot Cancel</strong> the Request</p>
				<p style='color:blue;'>By clicking the following button ,you are confirm with the above details ..</p>
				<a href='buyerconfirm.php?pid=$pid'><button>Confirm And Buy</button></a><br><br>
			</div>
		</div>
	</div>";
	}
}
	else
	{
		echo "error in sql query";
	}

}
else
{
	header('location:home.php');
}

?>	
</body>
</html>