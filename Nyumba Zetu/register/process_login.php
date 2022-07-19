<?php 
session_start();
require_once '../../config.php';

$login_username = $_POST["username"];
$login_pwd = $_POST["password"];
//echo $login_username;

$sql = "SELECT client_name, password, client_id FROM client WHERE `client_name`='$login_username' OR `email` = '$login_username'";
$result = mysqli_query($con, $sql);

if($result)
{
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$check_pwd = $row["password"];

			$client_name = $row['client_name'];
			$client_id = $row['client_id'];

			if(isset($_POST['keep_login']))
			{
				$sql0 = "INSERT INTO `session`( `user_id`) VALUES ('$client_id')";
				$result0 = mysqli_query($con, $sql0);
			}

		}
		if(password_verify($login_pwd, $check_pwd) == true)
		{
			$_SESSION['client_id'] = $client_id;
			header("location: ../../client/client_home.php");
		
		}
		else
		{
			echo "<script> alert('Incorrect Credentials!')</script>";
			header("location: ../homepage.php");
		}
	}
}
else
{
	echo "<script>alert('Incorrect Username or Password!')</script>";
	header('location: ../homepage.php');
}



$sql1 = "SELECT `broker_name`,`password`, `broker_id` FROM broker WHERE `broker_name`='$login_username' OR broker_email = '$login_username'";
$result1 = mysqli_query($con, $sql1);

if($result1)
{

	if(mysqli_num_rows($result1) > 0)
		{
			while ($row = mysqli_fetch_assoc($result1))
			{
				$check_pwd = $row["password"];
				$broker_name = $row['broker_name'];
				$broker_id = $row['broker_id'];

				if(isset($_POST['keep_login']))
				{
					$sql0 = "INSERT INTO `session`( `user_id`) VALUES ('$broker_id')";
					$result0 = mysqli_query($con, $sql0);
				}
			}

			if(password_verify($login_pwd, $check_pwd) == true)
			{
				$_SESSION['broker_id'] = $broker_id;
				header("location: ../../broker/broker_home.php");
			}
			else
			{
				echo "<script> alert('Login Failed!')</script>";
			}
		}
}
else
{
	echo "<script>alert('Incorrect Username or Password!')</script>";
	header('location: ../homepage.php');
}


$sql2 = "SELECT admin_name, password, admin_id, admin_type FROM admin WHERE `admin_id` = '$login_username' OR `admin_email`='$login_username' OR `admin_name`='$login_username'";
$result2 = mysqli_query($con, $sql2);

if($result2)
{
	

	if(mysqli_num_rows($result2) > 0)
		{echo "yes";
			while ($row = mysqli_fetch_assoc($result2))
			{	
				$admin_type = $row['admin_type'];
				$check_pwd = $row["password"];
				$admin_id = $row['admin_id'];
				echo $admin_type. $check_pwd. $admin_id;
			}
			if(password_verify($login_pwd, $check_pwd) == true)
			{	echo "VERIFIED!";
				$_SESSION['admin_id'] = $admin_id;
				$_SESSION['admin_type'] = $admin_type;

				if($admin_type == "user_manager")
				{
					header("location: ../../admin/user_manager.php");
				}

				if($admin_type == "property_manager")
				{
					header("location: ../../admin/property_manager.php");
				}
				
			}

			else
			{
				echo "<script> alert('Login Failed!')</script>";
			}
		}
}
else
{
	echo "<script>alert('Incorrect Admin Username or Password!')</script>";
	header('location: login.html');
}

$sql3 = "SELECT owner_name, password, owner_id FROM owner WHERE `owner_name`='$login_username' OR `owner_email` = '$login_username'";
$result3 = mysqli_query($con, $sql3);

if($result3)
{
	if(mysqli_num_rows($result3) > 0)
	{
		while ($row = mysqli_fetch_assoc($result3))
		{
			$check_pwd = $row["password"];

			$owner_name = $row['owner_name'];
			$owner_id = $row['owner_id'];

		}
		if(password_verify($login_pwd, $check_pwd) == true)
		{
			$_SESSION['owner_id'] = $owner_id;
			header("location: ../../owner/owner_home.php");
		
		}
		else
		{
			echo "<script> alert('Incorrect Credentials!')</script>";
			header("location: ../homepage.php");
		}
	}
}
else
{
	echo "<script>alert('Incorrect Username or Password!')</script>";
	header('location: ../homepage.php');
}


 ?>
