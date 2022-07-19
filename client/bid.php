<?php 
require_once '../config.php';
session_start();

$property_id = $_POST['pid'];
$client_id = $_SESSION['client_id'];

$new_bid = $_POST['amount'];
date_default_timezone_set("Africa/Nairobi");
$date_made =  date('Y-m-d h:i:s');
$date_approved  = "0000-00-00";

$sql1 = "INSERT INTO `bid`( `property_id`, `client_id`, `amount`, `date_made`, `date_approved`) VALUES ('$property_id', '$client_id', '$new_bid', '$date_made', '$date_approved')";
$result1 = mysqli_query($con, $sql1);

if($result1)
	{
		echo "<script>alert('Bid of Ksh. ".$new_bid." Made!')</script>";
		header ('location: client_home.php');
	}
	else
	{
		echo "<script>alert('Bid of Ksh. ".$new_bid." NOT Made!')</script>";
		header ('location: client_home.php');
	}
			
	

?>
