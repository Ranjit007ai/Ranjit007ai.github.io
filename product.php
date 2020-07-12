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
	<link rel="stylesheet" type="text/css" href="Product.css">
	<title>Product page</title>
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
if(isset($_GET['pid']))
{
		$p_id=$_GET['pid'];				//the product id
		
		$query="select * from product where pid=$p_id";
		if($query_run=mysql_query($query))
		{
			if(mysql_num_rows($query_run)==null)
			{
				echo "<h1>No product is available for this product id</h1>";
			}
			else
			{
				while($row=mysql_fetch_assoc($query_run))
				{
					$pimage=$row['pimage'];
					$pname=$row['pname'];
					$price=$row['price'];
					$d1=$row['d1'];
					$d2=$row['d2'];
					$d3=$row['d3'];
					echo "
					<div class='product'>
						<div class='image'>
							<img src='$pimage'>
						</div>
						<div class='info'>
							<h2><strong>$pname</strong></h2>
							<hr>
							<p style='text-align:left;'>Price : <strong>Rs.$price</strong></p>
							<ul>
								<li>$d1</li>
								<li>$d2</li>
								<li>$d3</li>
							</ul>
						</div>
						<div class='buy_button'>
							<a href='buyproduct.php?pid=$p_id'><button style='outline:none;'>Buy Now</button></a>
						</div>	
					</div>";
				}
			}
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