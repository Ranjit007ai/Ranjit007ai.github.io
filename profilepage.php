<?php
//this is php code to redirect the user to welcome page if not does not login and try to acess this page using url
session_start();
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');
if(!isset($_SESSION['userid'])||empty($_SESSION['userid']))
{
	header('location:hostelmandi.php');
}

$userid=$_SESSION['userid'];		//*** session['userid'] is initialized in $userid

$query="select * from uprofile where uid=$userid";
if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==0)
		{
			echo "<h1>You Have Not Provided  Your Profile !! Kindly Create Your Profile On <a href='createprofile.php'>Manage Profile Page.</a></h1>";
			die();
		}
}
?>


<!DOCTYPE html>
<html>
<head>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

		

	<meta name='viewport' content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Profilepage.css">
	<title>Profile page</title>
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
					<a href='profilepage.php' style='color:yellow;'>Profile</a>
				</div>
			</div>
		</div>
	</header>

<?php 
$userid=$_SESSION['userid'];		//*** session['userid'] is initialized in $userid
$query="select * from uprofile where uid='$userid'";
if($query_run=mysql_query($query))
{
	$image=mysql_result($query_run,0,'image');
	$name=mysql_result($query_run,0,'name');
	$college=mysql_result($query_run,0,'college');
	$hostel=mysql_result($query_run,0,'hostel');
	$address=mysql_result($query_run,0,'address');
	$mobile=mysql_result($query_run,0,'mobile');
	$gender=mysql_result($query_run,0,'Gender');
}
?>


	<div class='profile'>
		<div class="upper">
			<div class="a">
				<div class="a_top">
					<div class='link'>
						<a href="createprofile.php">Update Profile</a>	
					</div>

					<div class='link'>
						<a href="mybuy.php">My Buy's</a>	
					</div>

				</div>
				<div class="a_bottom">
					<div class='link'>
						<a href="mysell.php">My Sell's</a>	
					</div>

					<div class='link'>
						<a href="changepassword.php">Change Password</a>	
					</div>
				</div>
			</div>
			<div class="image">
				<img src="<?php echo $image?>"/>
			</div>
			
		</div>

		<div class="lower">
			<div class="info">
				<h1 style="text-align: center;">Information</h1>
				<p><strong style="color:red;"><?php echo $name;?></strong></p>
				<p><strong>Studies At :
	<i class='fas fa-graduation-cap'></i>   </strong><?php echo $college;?></p>
				<p><strong>Lives In :<i class='fas fa-map-marker-alt'></i>   </strong><?php echo $hostel;?></p>
				<p><strong>Gender :</strong><?php echo strtoupper($gender);?></p>
				<p><strong>Contact Number :
<i class='fas fa-phone-volume'></i>       </strong><?php echo $mobile;?></p>
				<p><strong>Contacting Address :<i class='fas fa-map-marker-alt'></i>  </strong><?php echo $address;?></p>
			</div>

			</div>
		</div>
	</div>


	<div class="middle">
				<div class='activity' id='advertise'>
					<h2>My all recents activities</h2>
					<a href='#sell'>#My sell's Activity</a>
					<a href='#buy' style='padding-left: 2%'>#My Buy Activity</a>
					<h2>My Advertisment Activity</h2>
<?php
//php code for the product Advertisement activity
	$query="select price,pname,pimage,date(dateofadd) as add_date ,hour(dateofadd) as add_hour ,minute(dateofadd) as add_min,second(dateofadd) as add_sec,u.image from product p join uprofile u on (u.uid=p.uid) where p.uid=$userid order by dateofadd desc" ;
	$date=date('Y-m-d h:i:s',time());
	if($query_run=mysql_query($query))
	{
		if(mysql_num_rows($query_run)!=0)		//**this is for checking if there is any product advertise in the market or not
		{
			while($row=mysql_fetch_assoc($query_run))
			{
				$add_date=$row['add_date'];
				$add_hour=$row['add_hour'];
				$add_min=$row['add_min'];
				$add_sec=$row['add_sec'];
				$pname=$row['pname'];
				$price=$row['price'];
				$pimage=$row['pimage'];
				$uimage=$row['image'];


				echo "<img src='$uimage' style='max-width:100%;width:5em;height:5em;margin-left:2%;border-radius:50%;'>
				<span style='margin-left:3%;color:blue'>$add_date at $add_hour:$add_min:$add_sec</span>
				<p style='margin-left:2%;'>You Have SuccessFully Advertise Your Product <strong style='color:blue;'>$pname</strong> in the market for <strong style='color:blue'>Rs.$price.</strong></p>
				<img src='$pimage' style='max-width:100%;width:33em;margin-left:4%;padding-bottom:2%;'>
				<hr>";


			}
		}
		else
		{
			echo "You Have Not Advertise any Product Into the Market Till Now!!";
		}
	}
	else
	{
		echo "sql error in getting the sell activity data";
	}





?>

	</div>


	<div class='activity' id='buy'>
		<a href='#sell'>#My sell's Activity</a>
		<a href='#buy' style='padding-left: 2%'>#My Buy Activity</a>
		<h2>My Buy's Activity</h2>
		
		
<?php
//for the product buy
//php code for getting the product details which are buyed by the user

$query="select * from uprofile where uid=$userid";
if($query_run=mysql_query($query))
{
	$uimage=mysql_result($query_run,0,'image');

}
else
{
	echo "not ok";
}

$query="select u.image,u.name,date(confirm_date) as buy_date,hour(confirm_date) as buy_hour,minute(confirm_date) as buy_min,second(confirm_date) as buy_sec ,p.* from productstatus ps join product p on (p.pid=ps.pid) join uprofile u on (u.uid=p.uid) where ps.buyerid=$userid and ps.p_status =1 order by confirm_date desc";
if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==0)
	{
		echo "<h3>You Have Not Buyed Any Product !!</h3>";
	}
	else
	{
		while($row=mysql_fetch_assoc($query_run))
		{	
			$sname=$row['name'];
			$simage=$row['image'];
			$buy_date=$row['buy_date'];
			$buy_hour=$row['buy_hour'];
			$buy_min=$row['buy_min'];
			$buy_sec=$row['buy_sec'];
			$pname=$row['pname'];
			$pimage=$row['pimage'];
			$price=$row['price'];

			echo "<img src='$uimage' style='max-width:100%;width:5em;height:5em;margin-left:2%;border-radius:50%;'>
				<span style='margin-left:3%;color:blue'>$buy_date at $buy_hour:$buy_min:$buy_sec</span>
				<p style='margin-left:2%;'>You Have SuccessFully Buy <strong style='color:blue;'>$pname</strong> in <strong style='color:blue'>Rs.$price.</strong> from <strong style='color:red'>".strtoupper($sname)."</strong></p>
				<img src='$pimage' style='max-width:100%;width:33em;margin-left:4%;padding-bottom:2%;'>
				<hr>";

		}
	}
}
else
{
	echo "sql error in getting the product buyed data";
}


?>

	</div>


	<div class='activity' id='sell'>
		<a href="#advertise">My Adevertisment's Activity</a>
		<a href='#sell'>#My sell's Activity</a>
		<a href='#buy' style='padding-left: 2%'>#My Buy Activity</a>
		<h2>My Sell's Activity</h2>
		
<?php
$query="select * from uprofile where uid=$userid";
if($query_run=mysql_query($query))
{
	$uimage=mysql_result($query_run,0,'image');

}
else
{
	echo "not ok";
}

//query for getting the product and buyer information

$query="select date(confirm_date) as date_sold , hour(confirm_date) as hour_sold,minute(confirm_date) as min_sold,second(confirm_date) as sec_sold,u.*,p.pname,p.price,p.pimage from productstatus ps join uprofile u on (ps.buyerid=u.uid) join product p on (ps.pid=p.pid) where 	p.uid=$userid order by  confirm_date desc";
if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==0)
	{
		echo "You Have Not Sold Any Product !!";
	}
	else
	{

		while($row=mysql_fetch_assoc($query_run))
		{
			$bname=$row['name'];
			$bimage=$row['image'];
			$date_sold=$row['date_sold'];
			$pname=$row['pname'];
			$pimage=$row['pimage'];
			$price=$row['price'];
			$hour_sold=$row['hour_sold'];
			$min_sold=$row['min_sold'];
			$sec_sold=$row['sec_sold'];

			echo "<img src='$uimage' style='max-width:100%;width:5em;height:5em;margin-left:2%;border-radius:50%;'>
				<span style='margin-left:3%;color:blue'>$date_sold at $hour_sold:$min_sold:$sec_sold</span>
				<p style='margin-left:2%;'>You Have SuccessFully Sold <strong style='color:blue;'>$pname</strong> in <strong style='color:blue'>Rs.$price.</strong> to <strong style='color:red'>$bname</strong></p>
				<img src='$pimage' style='max-width:100%;width:33em;margin-left:4%;padding-bottom:2%;'>
				<hr>";



		}
	}
}
else
{
	echo "not ok";
}
?>
	</div>

	
			</div>

	
	
</body>
</html>