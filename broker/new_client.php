<?php 
require_once '../config.php';
session_start();
$owner_name = $_POST['full_name'];
$owner_email = $_POST['owner_email'];
$gender = "Rather not say";
$phone = 0;
$broker = $_SESSION['broker_id'];
$status = "approved";
$pic = "../images/owners/no_pic.png";

$sql = "INSERT INTO `owner`( `owner_name`, `owner_gender`, `owner_email`, `owner_phone`, `broker_id`, `broker_status`, `owner_pic`) VALUES ('$owner_name','$gender','$owner_email','$phone','$broker','$status','$pic')";
$result = mysqli_query($con, $sql);

if($result)
{
	echo "<script> alert('".$owner_name." added. Confirmation email sent to".$owner_email.". They have 7 days to activate their account.') </script>";
	header("location: broker_home.php");
}
?>