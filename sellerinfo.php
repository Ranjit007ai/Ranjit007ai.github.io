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
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="buyerinfo.css">
	<title>seller Info page</title>
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

if(isset($_GET['sid']) && !empty($_GET['sid']) && isset($_GET['pid']) && !empty($_GET['pid']))
{

			$s_id=$_GET['sid'];
			$pid=$_GET['pid'];
			//query to check if the pid match with the corresponding sid.
			$query="select uid from product where pid =$pid ";
			if($query_run=mysql_query($query))
				{
					$sellerid=@mysql_result($query_run,0,'uid');
					if($sellerid!=$s_id)
					{
						die('<h2>Illegal Entry!!</h2>');
					}
				}
?>	

<?php

	$query="select * from uprofile where uid =$s_id";
	if($query_run=mysql_query($query))
	{
		if(mysql_num_rows($query_run)==0)
		{
			echo "<h1>THERE IS NO DATA FOR THIS SELLER </h1>";
		}
		else
		{
			$name=mysql_result($query_run,0,'name');
			$image=mysql_result($query_run,0,'image');
			$address=mysql_result($query_run,0,'address');
			$mobile=mysql_result($query_run,0,'mobile');
			$gender=mysql_result($query_run,0,'gender');

				echo "
							<div class='person_info'>
								<div class='image'>
									<img src='$image' style='max-width:100%;width:15em; '>
								</div>
								<div class='info'>
									<p>Buyer's Name :<strong>".strtoupper($name)."</strong></p>
									<p>Address: <i class='fas fa-map-marker-alt'></i> <strong style='font-size:12px;'>".strtoupper($address)."</strong></p>
									<p>Phone Number:<i class='fas fa-phone-volume'></i><strong>".strtoupper($mobile)."</strong></p>
									<p>Gender :<strong>".strtoupper($gender)."</strong></p>
								</div>
							</div>";



		}
		
	}
	else
	{
		echo "Sql Error!!";
	}
}
else
{
	echo "Invalid Entery!!";
}
?>
	
						
	</div>

</body>
</html>