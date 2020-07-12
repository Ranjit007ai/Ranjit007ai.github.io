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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="mybuy.css">
	<title>My Buy's page</title>
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
function pstatus($status,$s_id,$p_id)
{
	switch($status)
	{
		case 0: return "<span style='color:blue;'><STRONG style='font-size:1.9em;'>REQUEST SEND</STRONG>,WAITING FOR RESPONSE FROM SELLER...</span>";
		break;
		case 1: return "<span style='color:green;'><i class='fa fa-handshake-o' style='color:green;font-size:3em;'></i><strong style='font-size:1.9em;'>REQUEST ACCEPTED</strong> BY SELLER.</span>
		<br><a href='sellerinfo.php?sid=$s_id&pid=$p_id'  style='color:blue;text-decoration:underline;padding:2px;'>View Seller Information</a>";
		break;
		case -1:return "<span style='color:red;'>REQUEST <STRONG style='font-size:1.9em;'>REJECTED </STRONG>,SINCE PRODUCT IS SOLD TO OTHER BUYER..</span>";
		break;
		default: return "error";
	}
}
//code for getting the product list and status for this userid
$userid=$_SESSION['userid'];
$query="select pr.*,p.* from product_request pr join product p on (p.pid=pr.p_id) where pr.request_uid =$userid order by date_of_request desc ";
if($query_run=mysql_query($query))
{
		if(mysql_num_rows($query_run)!=0)
		{
			while($row=mysql_fetch_assoc($query_run))
			{
				$p_name=$row['pname'];
				$price=$row['price'];
				$pimage=$row['pimage'];
				$status=$row['confirm_status'];
				$s_id=$row['uid'];
				$p_id=$row['pid'];
					echo "
			<div class='product'>
				<div class='image'>
					<img src='$pimage' style='max-width:100%;width:15em;'>
				</div>
				<div class='info'>
					<p>Product Name :<strong>".strtoupper($p_name)."</strong></p>
					<p>Product Price :<strong>Rs.".strtoupper($price)."</strong></p>
					<p Product Status : >".pstatus($status,$s_id,$p_id)."</p>  			
				</div>
				<div class='buy_button'>
					<a href='finalproduct.php?pid=$p_id'><button style='outline:none;'>Complete Product Information</button></a>
				</div>
			</div>";
			}
				
		}
		else
		{
		echo "<h1>You Have Not Bought Any Product Till Now !</h1>";
		}
}		
	
else
{
	echo "it's not working";
}
?>
			

</div>
</body>
</html>