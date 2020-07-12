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
	<link rel="stylesheet" type="text/css" href="productsearch.css">
	<title>Product Search page</title>
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
<?php
if(isset($_GET['submit']) && !empty($_GET['submit']))
{
	
	$product=$_GET['product'];
	$query="select * from product p join productstatus ps on (p.pid=ps.pid) where ps.p_status =0  and p.pname like '%$product%'";
	if($query_run=mysql_query($query))
	{
		if(mysql_num_rows($query_run)==0)
		{
			echo "No such product in the market";
		}
		else
		{

			echo "<p>Here are some <strong style='color:blue'>Related Products</strong> Regarding <strong style='color:blue;'>$product</strong></p>";

			while($row=mysql_fetch_assoc($query_run))
			{
				$pname=$row['pname'];
				$pimage=$row['pimage'];
				$price=$row['price'];
				$p_id=$row['pid'];
					

					echo "
					<div class='product'>
						<div class='image'>
							<img src='$pimage' style='max-width:100%;width:15em; '>
						</div>
						<div class='info'>
						<p>Product Name :<strong>$pname</strong></p>
						<p>Price :<strong>Rs.$price</strong></p>
						</div>
						<div class='buy_button'>
							<a href='product.php?pid=$p_id'><button style='outline:none;'>Complete Information</button></a>
						</div>	
					</div>";
				}
		}
	}
	else
	{
		echo "Sql error !";
	}
}
else
{
	header('location:home.php');
}
?>
	</div>
</body>
</html>