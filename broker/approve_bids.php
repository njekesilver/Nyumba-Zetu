<?php 	
require_once '../config.php';

if(isset($_POST['Approve']) && isset($_POST['bdd']) && ($_POST['Approve'] == 'Approve'))
{	
	$property_id = $_POST['ppp'];
	$client_id = $_POST['bdd'];

	$sql ="UPDATE `bid` SET `bid_approval`='yes', `bid_state`='pending', `bid_status`='blocked'  WHERE `client_id`='$client_id' AND `property_id`='$property_id' ";
	$result = mysqli_query($con, $sql);
	if($result)
	{
		echo "<script> alert('Bid Approved!')</script>";
		header('location: broker_home.php');
	}
	else
	{
		echo "<script> alert('Failed to change the Bid Status!')</script>";
	}
}
if(isset($_POST['Disapprove']) && ($_POST['Disapprove'] == 'Disapprove'))
{
	$property_id = $_POST['ppp'];
	$client_id = $_POST['bdd'];
	$sql ="UPDATE `bid` SET `bid_approval`='no', `bid_state`='incomplete', `bid_status`='open' WHERE `client_id`='$client_id' AND `property_id`='$property_id' ";
	$result = mysqli_query($con, $sql);
	if($result)
	{
		echo "<script> alert('Bid Disapproved!')</script>";
		header('location: broker_home.php');
	}
	else
	{
		echo "<script> alert('Failed to change the Bid Status!')</script>";
	}

}

?>