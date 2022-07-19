<?php 
require_once '../config.php';
session_start();

$client_id = $_SESSION['client_id'];
$property_id = $_POST['pid'];

$sql = "";
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "<script> alert('Offer Revoked Successfully!') </script>";
	header("location: client_home.php");
}
else
{
	{
	echo "<script> alert('Error Revoking Offer. Please Try Again!') </script>";
	header("location: client_home.php");
}
}
?>