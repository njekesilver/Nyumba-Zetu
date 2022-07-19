<?php 
require_once '../config.php';
session_start();
$servicer_id = 0;
if(isset($_SESSION['client_id']))
{
	$requester_id = $_SESSION['client_id'];
	$requester_type = "client";
}

$from_email = $_SESSION['client_email'];
$request_title = $_POST['request-title'];

if($request_title == "Password Change")
{
	$servicer_id = 103023;
}
if($request_title == "Issues with Offers Made")
{
	$servicer_id = 103026;
}

if($request_title == "Electrical Issues" || $request_title == "Plumbing and Water Supply" || $request_title == "Home Security Issue" || $request_title == "Rent Issues" || $request_title == "Repairs" || $request_title == "Bills & Uilities")
{
	if(isset($_POST['property-name']))
	{
		$property_name = $_POST['property-name'];
		echo $property_name;

		$sq = "SELECT broker.broker_id FROM property JOIN owner ON property.owner_id = owner.owner_id JOIN broker ON owner.broker_id = broker.broker_id WHERE property_name = '$property_name'";
		$res = mysqli_query($con, $sq);

		
			if(mysqli_num_rows($res) > 0)
			{
				while($row = mysqli_fetch_assoc($res))
				{
					$servicer_id = $row['broker_id'];
				}
			}
		
		else// if its not a for sale property, yaani a rental
		{
			echo 2;
			$sq1 = "SELECT broker.broker_id FROM rentals JOIN owner ON rentals.owner_id = owner.owner_id JOIN broker ON owner.broker_id = broker.broker_id WHERE rental_name = '$property_name'";

			$res1 = mysqli_query($con, $sq1);

			if(mysqli_num_rows($res1) > 0)
				{
					while($row = mysqli_fetch_assoc($res1))
					{
						$servicer_id = $row['broker_id'];
					}
				}
		}
		

		
	}
	
}
$request_content = $_POST['request-content'];

date_default_timezone_set("Africa/Nairobi");
$date_sent =  date('Y-m-d h:i:s');

echo $servicer_id; //.$request_title.$request_content.$date_sent;

$sql = "INSERT INTO `requests`( `requester_type`, `requester_id`, `servicer_id`, `request_title`, `request_content`, `date_sent`) VALUES ('client', '$requester_id', '$servicer_id', '$request_title', '$request_content', '$date_sent')";
$rs = mysqli_query($con, $sql);


if($rs)
{
	echo "<script> alert('Successful') </script>";
	header("location: requests.php");

}
else
{
	echo "<script> alert('Unsuccessful') </script>";
	header("location: requests.php");
}
?>