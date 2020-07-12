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
	<link rel="stylesheet" type="text/css" href="showrequest.css">
	<title>Buyer Request Info page</title>
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


	<div class="middle">
<h3 style="text-transform: uppercase;">Here are Some Buyer's Request </h3>

<?php
//php code for listing out all the user requested for the product
// first of all we will access the pid from the url using the GET method
//**************we have to use ?name1=2 & name2=3 for url get method

if(isset($_GET['productid'])&& !empty($_GET['productid']))
{
	$pid=$_GET['productid'];
	$query="select u.*,pr.* from uprofile u join product_request pr on (u.uid=pr.request_uid) where pr.p_id=$pid";
	if($query_run=mysql_query($query))
	{
		if(mysql_num_rows($query_run)!=0)
		{
			while($row=mysql_fetch_assoc($query_run))
			{
				$userpic=$row['image'];
				$name=$row['name'];
				$mobile=$row['mobile'];
				$address=$row['address'];
				$college=$row['college'];
				$hostel=$row['hostel'];
				$uid=$row['uid'];
				$pid=$row['p_id'];
				$gender=$row['gender'];

			echo "
					<div class='person_info'>
						<div class='image'>
							<img src='$userpic' style='max-width:100%;width:15em; '>
						</div>
						<div class='info'>
							<p>Buyer's Name :<strong>".strtoupper($name)."</strong></p>
							<p>Address:<strong id='address_strong'>".strtoupper($address)."</strong></p>
							<p>Phone Number:<strong>".strtoupper($mobile)."</strong></p>
							<p>Gender :<strong>".strtoupper($gender)."</strong></p>
							<br>
							<span style='color:red'>*Warning:Once You Have Sold to this Buyer ,than You cannot Change the Buyer..</span>
							<p style='color:blue'>By Clicking the following Button,you have accepted the request and ready to sell the product to this buyer</p>
							<div class='buy_button'>
								<a href='confirmbuyer.php?userid=$uid & productid=$pid'><button style='outline:none;'>Confirm Request And Sell</button></a>
							</div>		

				
						</div>
								
					</div>";
	
		

			}
		}
		else{
			echo "<h1>Their is no Buyer for this Product Till Now!!</h1>";
		}
		
	}
	else{
		mysql_error();
	}
}
else{
	echo "Sorry the product id is not given in the url";
}

?>

	</div>

</body>
</html>