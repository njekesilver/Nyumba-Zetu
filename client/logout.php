<?php
require_once '../config.php';
session_start();

$client_id = $_SESSION['client_id'];

$sql = "SELECT * FROM session WHERE user_id = '$client_id'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0)
{
	$sql1 = "DELETE FROM session WHERE 1";
	$result1 = mysqli_query($con, $sql1);
}

session_unset();
session_destroy();
header("location: ../Nyumba Zetu/homepage.php");
?>