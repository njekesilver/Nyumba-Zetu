<?php
require_once "../config.php";

$rental_id = $_POST['rental_id1'];

if(isset($_POST['new_name1']) && $_POST['new_name1'] != "")
{
	$new_name = $_POST['new_name1'];
	$sql1 = "UPDATE `rentals` SET `rental_name`='$new_name' WHERE `rental_id`= '$rental_id'";
	$result1 = mysqli_query($con,$sql1);	

}

if(isset($_POST['rental_owner']) && $_POST['rental_owner'] != "")
{
	$owner_id= $_POST['rental_owner'];
	$sql0 = "UPDATE `rentals` SET `owner_id`= '$owner_id' WHERE `rental_id`= '$rental_id'";
	$result0 = mysqli_query($con, $sql0);
	
}

if(isset($_POST['new_category1']) && $_POST['new_category1'] != "")
{
	$new_category = $_POST['new_category1'];
	$sql2 = "UPDATE `rentals` SET `category`='$new_category' WHERE `rental_id`= '$rental_id'";
	$result2 = mysqli_query($con,$sql2);
	


}
if(isset($_POST['new_price1']) && $_POST['new_price1'] != "" )
{
	$new_price = $_POST['new_price1'];
	$sql3 = "UPDATE `rentals` SET `price`='$new_price' WHERE `rental_id`= '$rental_id'";
	$result3 = mysqli_query($con,$sql3);
	

}
if(isset($_POST['new_location1']) && $_POST['new_location1'] != "")
{
	$new_location = $_POST['new_location1'];
	$sql4 = "UPDATE `rentals` SET `location`='$new_location' WHERE `rental_id`= '$rental_id'";
	$result4 = mysqli_query($con,$sql4);
	

}



$image_path = "/repms/images/Properties/".$rental_id."/";
if (isset($_FILES["room1"]["name"]))
{
    $room1 = $image_path.$_FILES["room1"]["name"];
    $sq = "UPDATE `rentals` SET `room1`='$room1' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room2"]["name"]))
{
    $room2 = $image_path.$_FILES["room2"]["name"];
    $sq = "UPDATE `rentals` SET `room2`='$room2' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room3"]["name"]))
{
    $room3 = $image_path.$_FILES["room3"]["name"];
    $sq = "UPDATE `rentals` SET `room3`='$room3' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
} 
if (isset($_FILES["room4"]["name"]))
{
    $room4 = $image_path.$_FILES["room4"]["name"];
    $sq = "UPDATE `rentals` SET `room4`='$room4' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room5"]["name"]))
{
    $room5 = $image_path.$_FILES["room5"]["name"];
    $sq = "UPDATE `rentals` SET `room5`='$room5' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
} 
if (isset($_FILES["room6"]["name"]))
{
    $room6 = $image_path.$_FILES["room6"]["name"];
    $sq = "UPDATE `rentals` SET `room6`='$room6' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}  
if (isset($_FILES["room7"]["name"]))
{
    $room7 = $image_path.$_FILES["room7"]["name"];
    $sq = "UPDATE `rentals` SET `room7`='$room7' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room8"]["name"]))
{
    $room8 = $image_path.$_FILES["room8"]["name"];
    $sq = "UPDATE `rentals` SET `room8`='$room8' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room9"]["name"]))
{
    $room9 = $image_path.$_FILES["room9"]["name"];
    $sq = "UPDATE `rentals` SET `room9`='$room9' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room10"]["name"]))
{
    $room10 = $image_path.$_FILES["room10"]["name"];
    $sq = "UPDATE `rentals` SET `room10`='$room10' WHERE `rental_id`='$rental_id'";
    $rq = mysqli_query($con, $sq);
}   


header("location: broker_home.php");

?>