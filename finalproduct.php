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
	<link rel="stylesheet" type="text/css" href="finalproduct.css">
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


<?php
if(isset($_GET['pid']))
	{
		$product_id=$_GET['pid'];
		$query="select * from product where pid =$product_id";;
		if($query_run=mysql_query($query))
		{
			$image=mysql_result($query_run,0,'pimage');
			$product_price=mysql_result($query_run,0,'price');
			$name=mysql_result($query_run,0,'pname');
			$d1=mysql_result($query_run,0,'d1');
			$d2=mysql_result($query_run,0,'d2');
			$d3=mysql_result($query_run,0,'d3');
		}
		else{
			echo "not ok";
		}
	}
	else
	{
		header('location:mysell.php');
	}
	
?>



	<div class="middle">
					<div class='product'>
						<div class='image'>
							<img src='<?php echo $image;?>'>
						</div>
						<div class='info'>
							<h2><strong><?php echo $name;?></strong></h2>
							<hr>
							<p style='text-align:left;'>Price : <strong><?php echo 'Rs'.$product_price;?></strong></p>
							<ul>
								<li><?php echo $d1;?></li>
								<li><?php echo $d2;?></li>
								<li><?php echo $d3;?></li>
							</ul>
						</div>
					</div>
	</div>

			

</body>
</html>