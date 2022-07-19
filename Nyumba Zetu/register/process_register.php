<?php 
require_once '../../config.php';
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$location = $_POST["location"];
$phone_number = $_POST["phone_number"];
$account = $_POST["account"];
$file=$_FILES["file"];
$filename = $_FILES["file"]["name"]; 
    $fileTmpName=$_FILES["file"]["tmp_name"];
    $fileSize=$_FILES["file"]["size"];
    $fileError=$_FILES["file"]["error"];
    $fileType=$_FILES["file"]["type"];

    $fileExt= explode('.', $filename);
    $fileActualExt=strtolower(end($fileExt));
    $allowed=array('jpg','jpeg','png');

    $fileNameNew=uniqid('', true).".".$fileActualExt;

               
                


$new_pwd = $_POST["new_pwd"];
$confirm_pwd = $_POST["confirm_pwd"];
if($new_pwd == $confirm_pwd)
{
	$password = password_hash($new_pwd, PASSWORD_DEFAULT);

}
else
{
	 echo "Passwords don't match!";
}

 


if($account == 'broker')
{
	$folder='images/brokers/'.$fileNameNew;

    $fileDestination='images/brokers'.$fileNameNew;
    move_uploaded_file($fileTmpName, $fileDestination);
	
	$sql = "INSERT INTO `broker`( `broker_name`, `broker_gender`, `broker_location`, `broker_phone_number`, `broker_email`, `password`, `broker_pic`) VALUES ('$name', '$gender', '$location', '$phone_number', '$email', '$password', '$folder')";
	
	$result = mysqli_query($con, $sql);

	
	if($result)
	{
		echo '<script type="text/javascript">';
		echo ' alert("Account Created! Welcome!")';
		echo '</script>';
		
		$sql3 = "SELECT broker_id FROM broker WHERE broker_name='$name'";
		$result3 = mysqli_query($con, $sql3);

		if(mysqli_num_rows($result3) > 0)
		{
			while($row = mysqli_fetch_assoc($result3))
			{
				$broker_id = $row['broker_id'];
				$_SESSION['broker_id'] = $broker_id;
				header("location: ../../broker/broker_home.php");
			}
		}

	}

	else
	{
		echo '<script type="text/javascript">';
		echo ' alert("Failed to Create Account! Please Try Again")';
		echo '</script>';
	}

}

if($account == 'client')
{
	$folder='images/clients/'.$fileNameNew;

                $fileDestination='images/clients'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
	
	$sql2 = "INSERT INTO client (client_name, gender, phone_number, location, email, password, picture_url) VALUES ('$name','$gender', '$phone_number', '$location', '$email', '$password', '$folder')";
	$result2 = mysqli_query($con, $sql2);

	if($result2)
	{
		echo '<script type="text/javascript">';
		echo ' alert("Account Created! Welcome!")';
		echo '</script>';
		
		$sql3 = "SELECT client_id FROM client WHERE client_name='$name'";
		$result3 = mysqli_query($con, $sql3);

		if(mysqli_num_rows($result3) > 0)
		{
			while($row = mysqli_fetch_assoc($result3))
			{
				$client_id = $row['client_id'];
				$_SESSION['client_id'] = $client_id;
				header("location: ../../client/client_home.php");
			}
		}

	}

	else
	{
		echo '<script type="text/javascript">';
		echo ' alert("Failed to Create Account! Please Try Again")';
		echo '</script>';
	}
}

if($account == 'owner')
{
	$folder='images/owners/'.$fileNameNew;

    $fileDestination='images/owners'.$fileNameNew;
    move_uploaded_file($fileTmpName, $fileDestination);

	$account_status="not verified";
	
	$sql = "INSERT INTO `owner`( `owner_name`, `owner_gender`, `owner_email`, `owner_phone`, `broker_id`, `broker_status`, `account_status`, `owner_pic`, `password`) VALUES ('$name', '$gender', '$email',  '$phone_number', 0, 'unknown','$account_status', '$folder', '$password')";
	$result = mysqli_query($con, $sql);

	if($result)
	{
		echo '<script type="text/javascript">';
		echo ' alert("Account Created! Welcome!")';
		echo '</script>';
		
		$sql3 = "SELECT owner_id FROM owner WHERE owner_name='$name'";
		$result3 = mysqli_query($con, $sql3);

		if(mysqli_num_rows($result3) > 0)
		{
			while($row = mysqli_fetch_assoc($result3))
			{
				$owner_id = $row['owner_id'];
				$_SESSION['owner_id'] = $owner_id;
				header("location: ../../owner/owner_home.php");
			}
		}

	}

	else
	{
		echo '<script type="text/javascript">';
		echo ' alert("Failed to Create Account! Please Try Again")';
		echo '</script>';
	}

}

?>