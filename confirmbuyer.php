<?php
session_start();
mysql_connect('localhost','ranjit',null);
mysql_select_db('hostelmandi');


//Query to update the database 
//************Set  confirm_status =1 (for request accepted) and -1 for request rejected*****************

  $date=date('Y-m-d h:i:s',time());

if(isset($_GET['userid'])&&!empty($_GET['userid']) && isset($_GET['productid'])&&!empty($_GET['productid']))
{
	$uid=$_GET['userid'];
	$pid=$_GET['productid'];


	$query="update product_request set confirm_status= case request_uid when $uid then 1 else -1 end where p_id=$pid";
	//#####query to update the product status for sold(1) or unsold(0)
	$query1="update productstatus set p_status=1,buyerid=$uid,confirm_date='$date' where pid=$pid";
	if($query_run=mysql_query($query))
	{
		if($query1_run=mysql_query($query1))
		{

			header('location:mysell.php');
		}
		else{
			echo "Cannot udpate the product_status";
		}
	}
	else{
		echo "error in sql ,cannot update the confirm Status ..";
	}
}
else{
	echo "No userid is provided...";
}
?>