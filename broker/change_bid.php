<?php 
require_once '../config.php';

$pidd = $_POST['pidd'];

if(isset($_POST['open']))
{
	$sql = "UPDATE `bid` SET `bid_status`='open' WHERE `property_id`='$pidd'";
	$rs = mysqli_query($con, $sql);

	if($rs)
	{
		echo "<script> alert('Bids Opened!') </script>";
		header( "location: broker_home.php");
	}
	else
	{
		echo "<script> alert('Bids Status has NOT changed!') </script>";
		header( "location: broker_home.php");
	}

}
else if(isset($_POST['close']))
{
	$sql = "UPDATE `bid` SET `bid_status`='close' WHERE `property_id`='$pidd'";
	$rs = mysqli_query($con, $sql);

	if($rs)
	{
		echo "<script> alert('Bids Closed!') </script>";
		header( "location: broker_home.php");
	}
	else
	{
		echo "<script> alert('Bids Status has NOT changed!') </script>";
		header( "location: broker_home.php");
	}

}

else if(isset($_POST['block']))
{
	$sql = "UPDATE `bid` SET `bid_status`='blocked' WHERE `property_id`='$pidd'";
	$rs = mysqli_query($con, $sql);

	if($rs)
	{
		echo "<script> alert('Bids Blocked!') </script>";
		header( "location: broker_home.php");
	}
	else
	{
		echo "<script> alert('Bids Status has NOT changed!') </script>";
		header( "location: broker_home.php");
	}

}
?>