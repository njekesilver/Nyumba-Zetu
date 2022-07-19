<?php
require_once '../config.php';
session_start();

$request_id = $_POST['rid'];

$sq = "UPDATE `requests` SET `viewed`='yes' WHERE `request_id`='$request_id'";
$res = mysqli_query($con, $sq);


$response_title = $_POST['response-title'];

$response_content = $_POST['response-content'];
date_default_timezone_set("Africa/Nairobi");
$date_sent =  date('Y-m-d h:i:s');$date_sent = 

$sql = "INSERT INTO `responses`( `request_id`, `response_title`, `response_content`, `date_sent`) VALUES ('$request_id', '$response_title', '$response_content', '$date_sent')";
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "<script>alert('Response Recorded!')</script>";
	header("location: view_requests.php");
}
else
{
	echo "<script>alert('Response NOT Recorded!')</script>";
	header("location: view_requests.php");
}
?>