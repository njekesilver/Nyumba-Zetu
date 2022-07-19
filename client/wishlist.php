<?php 
require_once '../config.php';

session_start();

$client_id = $_SESSION['client_id'];
$property_id =  $_POST['pid'];
$_SESSION['property_id'] = $_POST['pid'];

echo $property_id."<br>".$client_id;

$state = $_POST['state'];

if($state == 'disliked')
{
	$sql = "INSERT INTO `wishlist` (`client_id`, `property_id`) VALUES ('$client_id', '$property_id')";
	$result = mysqli_query($con, $sql);

	echo "<script>alert('Added to Wishlist')</script>";
	header("location: display_property.php");

}

if($state == 'liked')
{
	$sql1 = "DELETE FROM wishlist WHERE `client_id` = '$client_id' AND `property_id` = '$property_id' ";
	$result1 = mysqli_query($con, $sql1);

	echo "<script>alert('Removed from Wishlist')</script>";
	header("location: display_property.php");
}

if($state == 'remove')
{
	$sql1 = "DELETE FROM wishlist WHERE `client_id` = '$client_id' AND `property_id` = '$property_id' ";
	$result1 = mysqli_query($con, $sql1);

	echo "<script>alert('Removed from Wishlist')</script>";
	header("location: client_home.php");
}
?>
