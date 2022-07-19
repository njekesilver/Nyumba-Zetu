<?php
require_once "../config.php";

$property_id = $_POST['property_id1'];

if(isset($_POST['new_name']) && $_POST['new_name'] != "")
{
	$new_name = $_POST['new_name'];
	$sql1 = "UPDATE `property` SET `property_name`='$new_name' WHERE `property_id`= '$property_id'";
	$result1 = mysqli_query($con,$sql1);	

}

if(isset($_POST['property_owner']) && $_POST['property_owner'] != "")
{
	$owner_id= $_POST['property_owner'];
	$sql0 = "UPDATE `property` SET `owner_id`= '$owner_id' WHERE `property_id`= '$property_id'";
	$result0 = mysqli_query($con, $sql0);
	
}

if(isset($_POST['new_category']) && $_POST['new_category'] != "")
{
	$new_category = $_POST['new_category'];
	$sql2 = "UPDATE `property` SET `category`='$new_category' WHERE `property_id`= '$property_id'";
	$result2 = mysqli_query($con,$sql2);
	


}
if(isset($_POST['new_price']) && $_POST['new_price'] != "" )
{
	$new_price = $_POST['new_price'];
	$sql3 = "UPDATE `property` SET `price`='$new_price' WHERE `property_id`= '$property_id'";
	$result3 = mysqli_query($con,$sql3);
	

}
if(isset($_POST['new_location']) && $_POST['new_location'] != "")
{
	$new_location = $_POST['new_location'];
	$sql4 = "UPDATE `property` SET `location`='$new_location' WHERE `property_id`= '$property_id'";
	$result4 = mysqli_query($con,$sql4);
	

}



$image_path = "/repms/images/Properties/".$property_id."/";
if (isset($_FILES["room1"]["name"]))
{
    $room1 = $image_path.$_FILES["room1"]["name"];
    $sq = "UPDATE `property` SET `room1`='$room1' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room2"]["name"]))
{
    $room2 = $image_path.$_FILES["room2"]["name"];
    $sq = "UPDATE `property` SET `room2`='$room2' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room3"]["name"]))
{
    $room3 = $image_path.$_FILES["room3"]["name"];
    $sq = "UPDATE `property` SET `room3`='$room3' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
} 
if (isset($_FILES["room4"]["name"]))
{
    $room4 = $image_path.$_FILES["room4"]["name"];
    $sq = "UPDATE `property` SET `room4`='$room4' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}
if (isset($_FILES["room5"]["name"]))
{
    $room5 = $image_path.$_FILES["room5"]["name"];
    $sq = "UPDATE `property` SET `room5`='$room5' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
} 
if (isset($_FILES["room6"]["name"]))
{
    $room6 = $image_path.$_FILES["room6"]["name"];
    $sq = "UPDATE `property` SET `room6`='$room6' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}  
if (isset($_FILES["room7"]["name"]))
{
    $room7 = $image_path.$_FILES["room7"]["name"];
    $sq = "UPDATE `property` SET `room7`='$room7' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room8"]["name"]))
{
    $room8 = $image_path.$_FILES["room8"]["name"];
    $sq = "UPDATE `property` SET `room8`='$room8' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room9"]["name"]))
{
    $room9 = $image_path.$_FILES["room9"]["name"];
    $sq = "UPDATE `property` SET `room9`='$room9' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}    
if (isset($_FILES["room10"]["name"]))
{
    $room10 = $image_path.$_FILES["room10"]["name"];
    $sq = "UPDATE `property` SET `room10`='$room10' WHERE `property_id`='$property_id'";
    $rq = mysqli_query($con, $sq);
}   


header("location: broker_home.php");

?>