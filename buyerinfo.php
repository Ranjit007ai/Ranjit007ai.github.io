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
	<title>Buyer Info page</title>
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

$buyerid;//declaring the variable to get the buyerid
if(isset($_GET['bid'])&&!empty($_GET['bid']) && isset($_GET['pid'])&& !empty($_GET['pid']))
{	
	$bid=$_GET['bid'];
	$pid=$_GET['pid'];

	//php code to check if the url buyerid is legal or not
	//We will check the db and check if buyerid is same as of the db requestid

	$query="select ps.buyerid from product_request pr join productstatus ps on (pr.p_id = ps.pid) where pr.p_id = $pid and pr.confirm_status = 1 ";
	
	if($query_run=mysql_query($query))
	{
		$buyerid=mysql_result($query_run,0,'buyerid');


		if($buyerid==$bid)
		{
			$query="select * from uprofile where uid=$buyerid";			//***** this is the query to get the buyer information
			if($query_run=mysql_query($query))
			{
				if(mysql_num_rows($query_run)==0)
				{
					echo "<h1>Their is no Buyer For this id</h1>";
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
									<p>Address: <i class='fas fa-map-marker-alt'></i><strong style='font-size:12px;'>     ".strtoupper($address)."</strong></p>
									<p>Phone Number:<i class='fas fa-phone-volume'></i><strong>          ".strtoupper($mobile)."</strong></p>
									<p>Gender :<strong>".strtoupper($gender)."</strong></p>
								</div>
							</div>";
				}
			}
			else
			{
				echo "their is an error in the sql query (for buyer information)";
			}

		}
		else
		{
				
			echo "<h2>Invalid Entry</h2>";
		}
		

	}else
	{
		echo "<h2>mysql error for buyer id</h2>";
	}
}	
else
{
	echo "No buyerid defined!!";
}

?>
	</div>

</body>
</html>