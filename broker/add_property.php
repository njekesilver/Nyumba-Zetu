<?php
require_once "../config.php";

$room1 = $room2 = $room3 = $room4 = $room5 = $room6 = $room7 = $room8 = $room9 = $room10 = "";

$owner_id = $_POST['property_owner'];
//Add new property
$property_name = $_POST['property_name'];
$property_price =$_POST['property_price'];
$property_location = $_POST['property_location'];



$category = $_POST['new_category'];

$beds = 1;
if(isset($_POST['beds']))
{
    $beds = $_POST['beds'];
}
$baths = 1;
if(isset($_POST['baths']))
{
    $baths = $_POST['baths'];
}

$am = $_POST['amenity'];
$a1 = $_POST['amenity1'];
$a2= $_POST['amenity2'];
$a3 = $_POST['amenity3'];
$a4 = $_POST['amenity4'];
$a5 = $_POST['amenity5'];
$a6 = $_POST['amenity6'];
$a7 = $_POST['amenity7'];
$a8 = $_POST['amenity8'];
$a9 = $_POST['amenity9'];

$image_path = "/repms/images/Properties/";
    $room1 = $image_path.$_FILES["room1"]["name"];
    $room2 = $image_path.$_FILES["room2"]["name"];
    $room3 = $image_path.$_FILES["room3"]["name"];
    $room4 = $image_path.$_FILES["room4"]["name"];
    $room5 = $image_path.$_FILES["room5"]["name"];
    $room6 = $image_path.$_FILES["room6"]["name"];
    $room7 = $image_path.$_FILES["room7"]["name"];
    $room8 = $image_path.$_FILES["room8"]["name"];
    $room9 = $image_path.$_FILES["room9"]["name"];
    $room10 = $image_path.$_FILES["room10"]["name"];


$sql2 = "INSERT INTO `property`( `property_name`, `price`, `bedrooms`, `bathrooms`, `location`, `category`, `owner_id`, `room1`, `room2`, `room3`, `room4`, `room5`, `room6`, `room7`, `room8`, `room9`, `room10`, `amenity1`, `amenity2`, `amenity3`, `amenity4`, `amenity5`, `amenity6`, `amenity7`, `amenity8`, `amenity9`, `amenity10`) VALUES ('$property_name','$property_price', '$beds','$baths','$property_location', '$category', '$owner_id', '$room1', '$room2', '$room3', '$room4' , '$room5', '$room6' , '$room7', '$room8' , '$room9', '$room10', '$am', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9') ";

$result2 = mysqli_query($con,$sql2);

if($result2)
{
    echo "<script> alert('New Property Added!') </script>";
    header("location: broker_home.php");
}
else
{
    echo "<script>alert('Property not Added!')</script>";
    //header("location: broker_home.php");
}

?>