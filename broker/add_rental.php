<?php
require_once "../config.php";

$room01 = $room02 = $room03 = $room04 = $room05 = "no_pic.jpg";
$room06 = $room07 = $room08 = $room09 = $room010 = "no_pic.jpg";
$a1 = $a2 = $a3 = $a4 =  $a5 = $a6 = $a7 = $a8 = $a9 = $a = $rental_name = $rental_location = $category = "";
$occupied = $rent = "no";
$tenant_id = $owner_id = $rental_price = 0;

if(isset($_POST['rental_owner']))
{
    echo $owner_id = $_POST['rental_owner'];
}

//Add new rental

if(isset($_POST['rental_name']))
{
    echo $rental_name = $_POST['rental_name'];
}


if(isset($_POST['rental_price']))
{
   echo $rental_price =$_POST['rental_price']; 
}


if(isset($_POST['rental_location']))
{
    echo $rental_location = $_POST['rental_location'];
}

if(isset($_POST['new_category0']))
{
    echo $category = $_POST['new_category0'];
}

$beds = 1;
if(isset($_POST['beds']))
{
    echo $beds = $_POST['beds'];

}
$baths = 1;
if(isset($_POST['baths']))
{
    echo $baths = $_POST['baths'];

}
if(isset($_POST['amenity']))
{
    echo $a = $_POST['amenity'];
}

if(isset($_POST['amenity1']))
{
    echo $a1 = $_POST['amenity1'];
}

if(isset($_POST['amenity2']))
{
    echo $a2 = $_POST['amenity2'];
}
if(isset($_POST['amenity3']))
{
    echo $a3 = $_POST['amenity'];
}
if(isset($_POST['amenity4']))
{
    echo $a4 = $_POST['amenity4'];
}
if(isset($_POST['amenity5']))
{
    echo $a5 = $_POST['amenity5'];
}
if(isset($_POST['amenity6']))
{
    $a6 = $_POST['amenity6'];
}
if(isset($_POST['amenity7']))
{
    $a7 = $_POST['amenity7'];
}
if(isset($_POST['amenity8']))
{
    $a8 = $_POST['amenity8'];
}
if(isset($_POST['amenity9']))
{
    $a9 = $_POST['amenity9'];
}


if (isset($_POST['room1']))
{
    $room01 = $_FILES["room01"]["name"];
}
if (isset($_POST['room2']))
{
    $room02 = $_FILES["room02"]["name"];
}
if (isset($_POST['room3']))
{
    $room03 = $_FILES["room03"]["name"];
} 
if (isset($_POST['room4']))
{
    $room04 = $_FILES["room04"]["name"];
}
if (isset($_POST['room5']))
{
    $room05 = $_FILES["room05"]["name"];
} 
if (isset($_POST['room6']))
{
    $room06 = $_FILES["room06"]["name"];
}  
if (isset($_POST['room7']))
{
    $room07 = $_FILES["room07"]["name"];
}    
if (isset($_POST['room8']))
{
    $room08 = $_FILES["room08"]["name"];
}    
if (isset($_POST['room9']))
{
    $room09 = $_FILES["room09"]["name"];
}    
if (isset($_POST['room10']))
{
    $room010 = $_FILES["room010"]["name"];
}

$sql2 = "INSERT INTO `rentals`( `rental_name`, `rental_location`, `rental_price`, `bedrooms`, `bathrooms`, `owner_id`, `category`, `occupied`, `rent_paid`, `client_id`, `room1`, `room2`, `room3`, `room4`, `room5`, `room6`, `room7`, `room8`, `room9`, `room10`, `amenity1`, `amenity2`, `amenity3`, `amenity4`, `amenity5`, `amenity6`, `amenity7`, `amenity8`, `amenity9`, `amenity10`) VALUES ('$rental_name', '$rental_location','$rental_price', '$beds','$baths', '$owner_id', '$category', '$occupied', '$rent','$tenant_id' , '$room01', '$room02', '$room03', '$room04' , '$room05', '$room06' , '$room07', '$room08' , '$room09', '$room010', '$a', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9') ";

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