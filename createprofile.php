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
	<link rel="stylesheet" type="text/css" href="Createprofile.css">
	<title>Manage Profile</title>
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
					<a href='createprofile.php' style='color:yellow;'>Manage Profile</a>
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
		<div class="profile_form">
			<?php
//php code for checking the Creating Profile or Updating Profile
$userid=$_SESSION['userid'];

$query="select * from 	uprofile where uid = $userid";
if($query_run=mysql_query($query))
{
	if(mysql_num_rows($query_run)==0)
	{
			echo "<form action='createprofile.php' method='post' enctype='multipart/form-data' style='color:white;'>
		<img src='user.jpg' alt='no picture' ><br><br>
		
		<p style='color:yellow;font-size:20px;'>CREATE PROFILE</p>
			
			<label style='font-family:arial;'>Upload Your Image :</label>
			<input type='file' name='image' required><br><br>
		<label style='font-family:arial;'>Your Name :</label><br>
		<input type='text' placeholder='Enter your name' required name='name' autocomplete><br><br>
		<label style='font-family:arial;'>Your Gender </label><br>
		<input type='radio' name='gender' value='male' style='width: 15px;' checked>Male
		<input type='radio' name='gender' value='female' style='width: 15px;'>Female
		<br><br>
		<label style='font-family:arial;'>Your Mobile Number :</label><BR>
		<input type='text' name='phoneno' placeholder='Your contacting mobile number' pattern='[0-9]{10}' required><br><br>
		<label>Your college name:</label>
		<select name='college' required>
			<option value='POORNIMA GROUP OF INSTITUTIONS'>POORNIMA GROUP OF INSTITUTIONS</option>
			<option value='POORNIMA COLLEGE OF ENGINEERING'>POORNIMA COLLEGE OF ENGINEERING</option>
			<option value='POORNIMA INSTITUTE OF TECHNOLOGY'>POORNIMA INSTITUTE OF TECHNOLOGY</option>
			<option value=' OTHER COLLEGES'> OTHER COLLEGES</option>
			<option value='NONE OF THESE'>NONE OF THESE</option>
		</select>
		<br><br>
		<label>Your Hostel Name :</label><BR>
		<select name='hostel'>
			<option value='GAYATRI HOSTEL'>GAYATRI HOSTEL</option>
			<option value='GAYATRI ARAVALI HOSTEL'>GAYATRI ARAVALI HOSTEL</option>
			<option value='GURUSHIKAR HOSTEL'>GURUSHIKAR HOSTEL</option>
			<option value='NONE OF THE ABOVE HOSTEL'>NONE OF THE ABOVE HOSTEL</option>
			<option value='NOT A HOSTLER'>NOT A HOSTLER</option>
		</select>
		<BR><BR>
		<label>Your contacting address :</label><br><br>
		<textarea name='address' placeholder='eg:roomno:XXX,hostelname:XXX or house, city XXX,state XXX,etc..'  cols='40' rows='5' required></textarea>
		<br><br>
		<input id='submit_button' type='submit' name='submit' value='Create my profile'>
	
	</form>";


		//php code for the above form
		if(isset($_POST['submit']))
		{


			$name=$_POST['name'];
			$gender=$_POST['gender'];
			$phone=$_POST['phoneno'];
			$college=$_POST['college'];
			$hostel=$_POST['hostel'];
			$address=$_POST['address'];
			$uid=$_SESSION['userid'];



			$image_name=$_FILES['image']['name'];
			$tmp_path=$_FILES['image']['tmp_name'];
			$path='profile/'.$image_name;			//it is path of image which is stored in the profile folder 
			move_uploaded_file($tmp_path,$path);


			$query="insert into uprofile values('$uid','$name','$gender','$phone','$college','$hostel','$address','$path')";
			if($query_run=mysql_query($query))
			{
				echo "<script>alert('You have successfully created your profile !please go to profile page')</script>";
			}
			else
			{
				echo "error in sql";
			}


		}


	}
	else
	{

			//query to take data and set it to the value of the input
		$query="select * from uprofile where uid=$userid";
		if($query_run=mysql_query($query))
		{
			$Name=mysql_result($query_run,0,'name');
			$Gender=mysql_result($query_run,0,'gender');
			$Mobile=mysql_result($query_run,0,'mobile');
			$Address=mysql_result($query_run,0,'address');
		}
		else
		{
			echo "SQL error!!";
		}

			echo "<form action='createprofile.php' method='post' enctype='multipart/form-data' style='color:white;'>

		<img src='user.jpg' alt='no picture' ><br><br>
		
		<p style='color:yellow;font-size:20px;'>UPDATE PROFILE</p>
			<label style='font-family:arial;'>Upload Your Image :</label>
			<br>
			<label style='color:lightgreen'>(*)You Must Re-upload Your Pic </label>	<br>
			<span class='glyphicon glyphicon-camera' style='color:red;font-size:2em;'></span>
			<input type='file' name='image' required ><br><br>
		<label style='font-family:arial;'>Your Name :</label><br>
		<input  type='text' placeholder='Enter your name'  name='name' required value='$Name'><br><br>
		<label style='font-family:arial;'>Your Gender </label><br>
		<label style='color:lightgreen'>(*)You Must select Your Gender Again</label><br>
		<input type='radio' name='gender' value='male' style='width: 15px' checked>Male
		<input type='radio' name='gender' value='female' style='width: 15px;'>Female
		<br><br>
		<label style='font-family:arial;'>Your Mobile Number :</label><BR>
		<input  type='text' name='phoneno' placeholder='Your contacting mobile number' required value='$Mobile' pattern='[0-9]{10}'><br><br>
		<label>Your college name:</label>
		<br>
		<label style='color:lightgreen'>(*)You Must Select Your College Again</label>
		<select name='college' required>
			<option value='POORNIMA GROUP OF INSTITUTIONS' >POORNIMA GROUP OF INSTITUTIONS</option>
			<option value='POORNIMA COLLEGE OF ENGINEERING' >POORNIMA COLLEGE OF ENGINEERING</option>
			<option value='POORNIMA INSTITUTE OF TECHNOLOGY'>POORNIMA INSTITUTE OF TECHNOLOGY</option>
			<option value='OTHER COLLEGES'> OTHER COLLEGES</option>
			<option value='NONE OF THESE'>NONE OF THESE</option>
		</select>
		<br><br>
		<label>Your Hostel Name :</label><BR>
		<label style='color:lightgreen'>(*) You Must Select Your Hostel Again</label><BR>
		<select name='hostel'>
			<option value='GAYATRI HOSTEL'>GAYATRI HOSTEL</option>
			<option value='GAYATRI ARAVALI HOSTEL'>GAYATRI ARAVALI HOSTEL</option>
			<option value='GURUSHIKAR HOSTEL'>GURUSHIKAR HOSTEL</option>
			<option value='NONE OF THE ABOVE HOSTEL'>NONE OF THE ABOVE HOSTEL</option>
			<option value='NOT A HOSTLER'>NOT A HOSTLER</option>
		</select>
		<BR><BR>
		<label>Your contacting address :</label><br><br>
		<textarea  name='address' placeholder='eg:roomno:XXX,hostelname:XXX or house, city XXX,state XXX,etc..'  cols='40' rows='5' required >$Address</textarea>
		<br><br>
		<input id='submit_button' type='submit' name='submit' value='Update profile'>
	
	</form>";


		//php code for the above form
		if(isset($_POST['submit']))
		{
			$name=$_POST['name'];
			$gender=$_POST['gender'];
			$phone=$_POST['phoneno'];
			$college=$_POST['college'];
			$hostel=$_POST['hostel'];
			$address=$_POST['address'];
			$uid=$_SESSION['userid'];




			$image_name=$_FILES['image']['name'];
			$tmp_path=$_FILES['image']['tmp_name'];
			$path='profile/'.$image_name;			//it is path of image which is stored in the profile folder 
			move_uploaded_file($tmp_path,$path);

			$update_query="update uprofile set name = '$name',gender='$gender',mobile='$phone',college='$college',hostel='$hostel',address='$address',image='$path' where uid=$uid";
			if($query_run=mysql_query($update_query))
			{
				echo "<script>alert('Your Profile Has Successfully Updated!!')</script>";
			}
			else
			{
			echo "<h1>".mysql_error()."</h1>";
			}


		}
		
	}
}
else
{
	echo "ERROR IN SQL!";
}





?>

		</div>
	</div>
</body>
</html>