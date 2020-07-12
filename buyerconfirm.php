
<?php
//this is php code to redirect the user to welcome page if not does not login and try to acess this page using url
session_start();
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');
if(!isset($_SESSION['userid'])||empty($_SESSION['userid']))
{
	header('location:hostelmandi.php');
}
?>

<?php


//declaring the date
  $date=date('Y-m-d h:i:s',time());


//php code to update the db and send the buyer request to the sender
if(isset($_GET['pid'])&& !empty($_GET['pid']))
{

	$pid=$_GET['pid'];
	$userid=$_SESSION['userid'];
	//First of all we will check whether this buyer has already send the request for this product or not ....

	$query1="select * from product_request where request_uid=$userid and p_id=$pid";

	if($query1_run=mysql_query($query1))
	{
		if(mysql_num_rows($query1_run)>0)
		{
			echo "<script>alert('You have already send the request for this product !! So You cannot Resend the request')</script>";

		}
		else
		{
			$query="insert into product_request values('$pid','$userid','','$date')";
			if($query_run=mysql_query($query))
			{
			echo "<script>alert('Your Request  has succesfully Send to the seller Please wait for his response toward it!!')</script>";
			//header('location:profilepage.php');
			}
			else
			{
			echo "Cannot insert the data into the db due to sql error";
			}
		}
	}
	else
	{
		echo "error in the sql query1 ";
	}
}
else
{

	echo "No Product Id is determined!!";
}
?>