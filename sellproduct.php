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
	<link rel="stylesheet" type="text/css" href="sellproduct.css">
	<title>Sell My Product</title>
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
					<a href='sellproduct.php' style="color:yellow;">Sell My Product</a>
				</div>
				<div class='a'>
					<a href='profilepage.php'>Profile</a>
				</div>
			</div>
		</div>
	</header>

	<div class="middle">
		<div class="product_form">
			<form action='sellproduct.php' method='post' enctype='multipart/form-data'>
				<h1> DEFINE YOUR PRODUCT</h1>
				<label>Product Name :</label><br><br>
				<input type='text' name='pname' placeholder='Give your product a name' REQUIRED><br><br>
				<label>Upload Your Product Photo :</label><br><br>
				<i class='fa fa-camera' style="color:red;font-size:2em;"></i>
				<input type='file' name='pimage'  required><br><br>
				<label>Price at which you want to sell your your product : </label><br><br>
				<input type='text' name='price' placeholder="Price"   required> 
				<br><br>
				<label>Describe  your product :</label><br>
				<label>Description 1:</label><br><br>
				<textarea name='d1' rows='5' cols='30'  placeholder='Describe Your Product here..' required></textarea><br><br>
				<label>Description 2:</label><br><br>
				<textarea name='d2' rows='5' cols='30' placeholder='Describe Your Product here..' required></textarea><br><br>
				<label>Description 3:</label><br><br>
				<textarea name='d3' rows='5' cols='30' placeholder='Describe Your Product here..' required></textarea><br><br>
				<input id='submit_button' type='submit' name='submit' value='Advertise My Product'>
		</form>


<?php
		

		 	//declaring the date 
		 	  $date=date('Y-m-d h:i:s',time());
if(isset($_POST['submit']))
{
	$pimage=$_FILES['pimage']['name'];
	$temp=$_FILES['pimage']['tmp_name'];
	$path='product/'.$pimage;
	move_uploaded_file($temp,$path);
	$pimage;
	$pname=$_POST['pname'];
	$price=$_POST['price'];
	$desc1=$_POST['d1'];
	$desc2=$_POST['d2'];
	$desc3=$_POST['d3'];

	if(!ctype_digit($price))
			{
				echo "<script>alert('Please Enter the Valid Price')</script>";
			}
			else
			{



					$userid=$_SESSION['userid'];
					$query="insert into product values('','$userid','$pname','$price','$desc1','$desc2','$desc3','$path','$date')";

					if($query_run=mysql_query($query))
					{

						$query1="select pid from product where uid=$userid order by pid desc limit 1";		//query to find the pid 
						if($query_run=mysql_query($query1))
						{
							$pid=mysql_result($query_run,0,'pid');
							$query2="insert into productstatus (pid,p_status) values('$pid','')";		//		query to insert the status and pid into productstatus
							if($query_run=mysql_query($query2))
							{
								header('location:mysell.php');
							}


						}

					
					}
					else{
						mysql_error($query_run);
					}
			}		

}

?>




		</div>
	</div>
</body>
</html>