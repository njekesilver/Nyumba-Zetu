<?php 
require_once '../config.php';
session_start();

$state = $_POST['statee'];
$owner_id = $_POST['oid'];
echo $state;
echo $owner_id;

if($state == "pending")
{
	if(isset($_POST['accept-btn']))
	{
		$sql = "UPDATE `owner` SET `broker_status`='approved' WHERE owner_id='$owner_id'";
		$rs = mysqli_query($con, $sql);

		if($rs)
		{
			echo "<script> alert('Representation Accepted!') </script>";
			header("location: broker_home.php");
		}
		else
		{
			echo "<script> alert('Representation NOT Accepted!') </script>";
			header("location: broker_home.php");
		}

	}
	if(isset($_POST['reject-btn']))
	{
		$sql = "UPDATE `owner` SET `broker_status`='rejected' WHERE owner_id='$owner_id'";
		$rs = mysqli_query($con, $sql);

		if($rs)
		{
			echo "<script> alert('Representation Rejected!') </script>";
			header("location: broker_home.php");
		}
		else
		{
			echo "<script> alert('Representation Rejection NOT Sent!') </script>";
			header("location: broker_home.php");
		}

	}
}

if($state == " unknown")
{
	$sql = "UPDATE `owner` SET `broker_id`='$broker_id',`broker_status`='requested' WHERE owner_id='$owner_id'";
	$rs = mysqli_query($con, $sql);

	if($rs)
	{
		echo "<script> alert('Representation Request Sent!') </script>";
		header("location: broker_home.php");
	}
	else
	{
		echo "<script> alert('Representation Request NOT Sent!') </script>";
		header("location: broker_home.php");
	}
}

 ?>