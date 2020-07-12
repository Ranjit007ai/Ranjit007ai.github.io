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
	<link rel="stylesheet" type="text/css" href="mysell.css">
	<title>Mysell page</title>
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
			<p id='middle_heading'>Here Are Your product you Advertise in the market.</p>
<?php
//***********confirm status =0 mean you have the request if 1 mean request accepted if -1 then rejected
$userid=$_SESSION['userid'];
$query="select p.*,ps.*,count(pr.p_id ) as no_of_request,u.name as bname,u.image,u.uid as bid from product p left join productstatus ps on (p.pid=ps.pid) left join product_request pr on(p.pid=pr.p_id) left join uprofile u on (u.uid=pr.request_uid and pr.confirm_status=1) where p.uid=$userid group by p.pid order by p.pid desc";
if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==null)
	{
		echo "<h1 style='color:red;'>You have not advertise any product into the market</h1>";
	}
	else{

		function status($a)						//creating the function status to find out if product is sold or unsold
				{
					if($a==0)
					{
						return "<span style='color:red'>Unsold</span>";
					}
					else
					if($a==1)
					{
							return "<i class='fa fa-handshake-o' style='font-size:3em;color:green;'></i><span style='color:green;font-family:arial;font-size:3em;'>SOLD</span>";
					}
					
				}


					//function for the no of request the seller get thier product 
				function request($b,$pid,$pstatus,$buyername,$price,$bid)
				{
					if($pstatus==0)
					{
						if($b==0)
						{
							return "<span style='color:red;'>You do not have any buyer for this Product till Now!</span>";
						}else
						{
							return "<a href='showrequest.php?productid=$pid' style='color:blue;text-decoration:underline;'>You have got ".$b." Buyer Request..</a>";
						}
					}
					else if($pstatus==1)
					{
						return "<span style='color:green;font-size:1.1em;'>The Product is Sold to <a href='buyerinfo.php?bid=$bid&pid=$pid' style='color:blue'>$buyername</a> for Rs.$price.</span>";
					}
					
				}

		while($row=mysql_fetch_assoc($query_run))
		{	
			$image=$row['pimage'];
			$pname=$row['pname'];
			$pstatus=$row['p_status'];
			$p_id=$row['pid'];
			$no_of_request=$row['no_of_request'];
			$buyername=$row['bname'];
			$buyerid=$row['bid'];
			$price=$row['price'];
			


			echo "
			<div class='product'>
				<div class='image'>
					<img src='$image' style='max-width:100%;width:15em;'>
				</div>
				<div class='info'>
					<p>Product Name :<strong>".strtoupper($pname)."</strong></p>
					<p>Status :<strong>".status($pstatus)."</strong></p>
					<p>".request($no_of_request,$p_id,$pstatus,$buyername,$price,$buyerid)."</p>  			
				</div>
				<div class='buy_button'>
					<a href='finalproduct.php?pid=$p_id'><button style='outline:none;'>Complete Product Information</button></a>
				</div>
			</div>";	

			
		}

		
	}
}
else{
	echo "not ok";
}
?>
</div>
</body>
</html>