<?php
require_once '../config.php';
session_start();
$bids; $bd;
$amount = 0;
$display_bid;
$bidder = $client_id = "";
$bid_made =0;
$bidders = array();
$close_btn = $open_btn = $block_btn = $comment = "";

if(isset($_SESSION['broker_id']))
{
	$broker_id = $_SESSION['broker_id'];
}

else
{
	echo "<script>alert('Login First!')</script>";
	header("location: ../Nyumba Zetu/homepage.php");
}

//retrieve
$broker_email = "";
$broker_name = "";
$broker_id = $_SESSION['broker_id'];
$broker_gender = "";
$broker_phone_number = "";
$broker_location = "";
$broker_pic = "../images/brokers/no_pic.png";

$sql = "SELECT * FROM broker WHERE broker_id = '$broker_id'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$broker_name = $_SESSION['broker_name'] = $row['broker_name'];
		$broker_gender = $row['broker_gender'];
		$broker_phone_number = $row['broker_phone_number'];
		$broker_location = $row['broker_location'];
		$broker_email = $row['broker_email'];
		$broker_pic = "../images/Brokers/".$row['broker_pic'];
	}
}





?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../repms2.css">
	<script type="text/javascript" src="../repms.js"></script>
	<title><?php echo $broker_name ?></title>
	 <link href="../Nyumba Zetu/css/styles.css" rel="stylesheet" />
	 <link rel="stylesheet" type="text/css" href="../w3schools.css">
	 <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    <!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    
	<style>
		.form
		{
			border-radius: 30px;
			max-width: 800px;
			margin: auto;
			box-shadow: rgba(2, 2, 4, 0.56) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
		}
		#broker_details p
		{
			font-size: 1.4em !important;
		}
		#view_options
		{
			width: 25%;
			display: inline-block;
		}
		.view_bids
		{
			width: 40%;
			display: inline;
			font-size: 1.3em;	
		}
		#view_options button
		{
			background-color: white;
			color: #130435;
			padding: 8%;
			width: 100%;
			text-align: right;
			border-bottom: 1px solid #E1E8EE;
			border-right: 1px solid #E1E8EE;
		}
		#view_options button.active
		{
			color: #3c3cae;
			font-size: 1.3em;
		}
		#bids_made div
		{
			vertical-align: top;
		}

		a
		{
		  text-decoration: none;
		}
		a:visited
		{
		  color: inherit;
		  text-decoration: none;
		}
		.title1
		{
			display: inline-block;
			padding: 20px 30px;
			color: #5E6977;
			font-size: 1.5em;
			
		}
		.approve_bids input[type=submit]
		{
			background-color: white;
			color: #130435;
			border: none;
		}
		.approve_bids input[type=submit]:hover
		{
			font-size: 1em;
		}
		.card 
		{
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2) !important;
			max-width: 350px !important;
			margin: 6px !important;
			text-align: center !important;
			font-family: arial !important;
			display: inline-block !important;
			width: 18%;
		}
		.card img 
		{
			height: 250px;
			object-fit: contain;
		}

		.title 
		{
			color: grey;
			font-size: 18px;
		}
		#services
		{
			background-color: white;
		}
		.dibz
		{
			width: 20%;
		}
		.service-icon:hover
		{
			transform: scale(1.5, 1.5) 3s ease;
		}s
		.form-label {
			margin-bottom: .5rem;
			font-size: 16px !important;
		}
		.form-control
		{
			display: inline-block !important;
			height: 50px;
		}
		.forming
		{
			display: inline-block !important;
			width: 45%;
			padding: 20px;
		}
		.form-img label
		{
			padding: 10px;
			margin-bottom: 5px;
			width: 110px;
		}
		.custom-file-upload {
	        border: 1px solid #ccc;
	        display: inline-block;
	        padding: 6px 12px;
	        cursor: pointer;
	    }
	    .sb-btn
	    {
	    	width: 40%;
			height: 50px;
			font-size: 1.2em;
			margin: auto;
	    }
	    .edit-radios div
	    {
	    	width: 46%;
			display: inline-block;
			padding: 1em;
			font-size: 1.2em;
	    }
		.ames
		{
			padding: 10px;
		}
		
		.ames input
		{
			display: flex inline;
			width: 18%;
			padding: 15px;
		}
	</style>
	
</head>

<body>

	<div id="nn">
            
                <div class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" >                
                    
                    <div id="navbar_options" class="navbar-brand "><a title="Nyumba Zetu" style="font-size: 1.5em;" href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
                    
                    <div id="navbar_options" class="navbar-brand "><a href="#contact_info">Contact Us</a></div>

                    <div id="navbar_options" class="navbar-brand "><a href="../settings.php">Settings</a></div>

                    <div id="navbar_options" class="navbar-brand "><a href="view_requests.php">Service Requests</a></div>

                    <div id="navbar_options" class="navbar-brand ">
                    	<a href="" class="active" title=""><?php echo $broker_name ?>
                      	</a>
					</div>

                    <div id="navbar_options" class="navbar-brand ">
                    	

                    <div title="Logout">
					
					<label class="switch">
						<a href="logout.php">
							<input type="checkbox">
							<span class="slider round"></span>
						</a>
					</label>
							
				</div>
                    </div>

                </div>
    </div>
        
        <div id="broker_home ">
			<div id="broker_home_top">        
			    <div id="broker">
			    	<fieldset>
			    		<div id="broker_pic">
			    			
			    			<img style="width: 200px;height: 200px; border-radius: 50%;object-fit: cover;" src="<?php echo $broker_pic ?>">
			    		</div>
			    		
			    		<div id="broker_details" >
			    			<p><strong>Name: </strong><?php echo $broker_name ?></p>
			    			<p><strong>Email: </strong><?php echo $broker_email ?></p>
			    			<p><strong>Location: </strong><?php echo $broker_location ?></p>

			    		</div>
			    		</fieldset>
			    </div>
			    <br><br><br>
			</div> 
			
				<section class="content-section bg-primary text-black text-center" style="" id="services">
                    <div class="container px-4 px-lg-5" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                        <div><h2>Click Me To:</h2></div>
                        <div class="row gx-4 gx-lg-5" >

                            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 dibz">
                            	<span class="service-icon rounded-circle mx-auto mb-3"><button class="clear-btn" id="fs-form-btn" onclick="open_form('for-sale-form')"><i class="fa fa-home" aria-hidden="true"></i></button>
                            	</span>
                            	<h4><strong>New Property For sale</strong></h4>
                            	<div class="popup" id='pop1'>
                                <i class="fa-solid fa-circle-question" id="popupss" onclick="popup1('pop1', 'myPopup1')"></i>
                                 <span class="popuptext" id="myPopup1" style="display: none; font-size: 13px;color: white; padding: 10px;">
                                     <p class="text-faded mb-0">Add a new property For Sale.</p>
                                 </span>
                            	</div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 dibz">
                            	<button class="clear-btn" id="rental-form-btn" onclick="open_form('rent-form')"><span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-house"></i></span></button>
                                
                                <h4><strong>New Rental</strong></h4>
                                <div class="popup" id='pop2'>
                                <i class="fa-solid fa-circle-question" id="popupss" onclick="popup1('pop2', 'myPopup2')"></i>
                                 <span class="popuptext" id="myPopup2" style="display: none; font-size: 13px;color: white; padding: 10px;">
                                     <p class="text-faded mb-0">Add a new Rental. </p>
                                 </span>
                            </div>
                                
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5 mb-md-0 dibz">
                            	<button class="clear-btn" id="edit-property-btn" onclick="open_form('edit-property')"><span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-pen-to-square"></i></span></button>
                                
                                <h4><strong>Edit Property Details</strong></h4>
                                <div class="popup" id="pop3">
                                <i class="fa-solid fa-circle-question" id="popupss" onclick="popup1('pop3', 'myPopup3')"></i>
                                 <span class="popuptext" id="myPopup3" style="display: none; font-size: 13px;color: white; padding: 10px;">
                                    <p class="text-faded mb-0">Edit property details such as name and images.</p>
                                 </span>
                            </div>
                                
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5 mb-md-0 dibz">
                            	<button class="clear-btn" id="client-form-btn" onclick="open_form('client-form')"><span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-person-circle-plus"></i></i></span></button>
                                
                                <h4><strong>New Client</strong></h4>
                                <div class="popup" id="pop4">
                                <i class="fa-solid fa-circle-question" id="popupss" onclick="popup1('pop4', 'myPopup4')"></i>
                                 <span class="popuptext" id="myPopup4" style="display: none; font-size: 13px;color: white; padding: 10px;">
                                    <p class="text-faded mb-0">Temporarily Register a new client. </p>
                            		<p class="text-faded mb-0">An account activation link will be sent to their email. </p>
                                 </span>
                            </div>
                                
                            </div>
                            <div class="col-lg-3 col-md-6 mb-5 mb-md-0 dibz">
                            	<button class="clear-btn" id="owner-form-btn" onclick="open_form('owner-form')"><span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-eye"></i></span></button>
                                
                                <h4><strong>All Clients</strong></h4>
                                <div class="popup" id="pop5">
	                                <i class="fa-solid fa-circle-question" id="popupss" onclick="popup1('pop5', 'myPopup5')"></i>
	                                <span class="popuptext" id="myPopup5" style="display: none; font-size: 13px;color: white; padding: 10px;">
	                                    <p class="text-faded mb-0">View your clients.</p>
		                                <p class="text-faded mb-0"> Accept or Revoke representation. Reequest to represent users.</p>
		                                <p class="text-faded mb-0">Request to represent users.</p>
	                                </span>
                            </div>
                                
                            </div>
                        </div>

                    
                </section>
				
				<div style=" padding: 10px;margin: auto; height: fit-content;  ">

					<div style="display: none" id="for-sale-form" class="fmms"><!-- adds a new for sale property -->

						<form id="broker-add"  class="w3-container w3-white w3-card-4 form" method="post" action="add_property.php">
							  <h2 class="w3-text-black w3-center">New Property Form</h2>
							  <p class="w3-center">Fill out the form to register a new property you represent.</p>

							  <div class="forming">
								  <label class=" form-label">Full Property Name</label>
								  <input class="form-control" name="property_name" type="text">
								</div>

								<div class="forming">
								  <label class=" form-label">What Type of Property is it?</label>
								  <br>
								  <select name="new_category" id="new_category" class="form-control">
										<option value="">-</option>
										<option value="Apartment">Apartment</option>
										<option value="Bungalow">Bungalow</option>
										<option value="Cabin">Cabin</option>
										<option value="Condo">Condo</option>
										<option value="Cottage">Cottage</option>
										<option value="Farm house">Farm house</option>
										<option value="Mansionette">Mansionette</option>
										<option value="Mansion">Mansion</option>
										<option value="Mobile House">Mobile House</option>
										<option value="Semi-detached">Semi-detached</option>
										<option value="Tiny House">Tiny House</option>
										
									</select>
								</div>

							  <div class="forming">
							  
								  <label class=" form-label">Number of Bathrooms</label>
								  <br>
								  <label style="margin-right:20px"><span id="demo">     </span></label>
								  
								  <input onload="load_slider('baths')" style="width:150px" class="w3-radio" type="range" name="baths"  id="baths"step="1" value="0" min="0" max="10"  onChange="slide('baths','demo')">
								  
								  <br>
								</div>
								<div class="forming">

								  <label class=" form-label">Number of Bedrooms</label>
								  <br>
								  <label style="margin-right:20px"><span id="demo1"></span></label>
								  
								  <input onload="load_slider('beds')" style="width:200px" class="w3-radio" type="range" name="beds"  id="beds"step="1" value="0" min="0" max="15" onChange="slide('beds','demo1')">
								  
								</div>

								<div class="forming">
								  <label class=" form-label">Property Price</label>
								  <br>
								  <input class="form-control" name="property_price" type="int">
								  
								</div>

								<div class="forming">
								  <label class=" form-label">Location</label>
								  <input class="form-control" name="property_location" type="text">
								</div>

								<div class="forming">
							  		<label class=" form-label">Property Owner</label>
							  		<br>
							  	 	<select class="form-control" id="property_owner" name="property_owner">
							  	 		<option selected disabled>-</option>
									  	<?php 	
									  	$sl = "SELECT owner_name, owner_id FROM owner WHERE broker_id='$broker_id' ORDER BY owner_name";
									  	$rl = mysqli_query($con, $sl);

									  	if(mysqli_num_rows($rl) > 0)
									  	{
									  		while($row = mysqli_fetch_assoc($rl))
									  		{
									  			$oon = $row['owner_name'];
									  			$ood = $row['owner_id'];

									  			echo "<option value='".$ood."'>".$oon."</option>";
									  		}
									  	}
									  	?>
								  		
								  	</select>
								</div>
								<div class="forming" style="display: block !important; width: 100% !important">
								  <label class=" form-label">Amenities</label>
								    <br>
								    <div class="ames">

								    <input placeholder="Amenity 1" type="text" name="amenity" id="amenity">
								    <input placeholder="Amenity 2" type="text" name="amenity1" id="amenity1">
								    <input placeholder="Amenity 3" type="text" name="amenity2" id="amenity2">
								    <input placeholder="Amenity 4" type="text" name="amenity3" id="amenity3">
								    <input placeholder="Amenity 5" type="text" name="amenity4" id="amenity4">
								    </div>

								    <div class="ames">
								      
								    <input placeholder="Amenity 6" type="text" name="amenity5" id="amenity5">
								    <input placeholder="Amenity 7" type="text" name="amenity6" id="amenity6">
								    <input placeholder="Amenity 8" type="text" name="amenity7" id="amenity7">
								    <input placeholder="Amenity 9" type="text" name="amenity8" id="amenity8">
								    <input placeholder="Amenity 10" type="text" name="amenity9" id="amenity9">
								    </div>
								  <br>
								</div>
								<br>
							  <label class=" form-label">Please Upload at least 5 photos of the Property</label>
							  <div class="form-img">
								  
								  <br>

								  <input type="file" name="room1" id="room1" style="display: none;">
								  <label class='login-label custom-file-upload' for="room1">Image 1</label>

								  <input type="file" name="room2" id="room2" style="display: none;">
								  <label class='login-label custom-file-upload' for="room2">Image 2</label>
								  
								  <input type="file" name="room3" id="room3" style="display: none;">
								  <label class='login-label custom-file-upload' for="room3">Image 3</label>

								  <input type="file" name="room4" id="room4" style="display: none;">
								  <label class='login-label custom-file-upload' for="room4">Image 4</label>

								  <input type="file" name="room5" id="room5" style="display: none;">
								  <label class='login-label custom-file-upload' for="room5">Image 5</label>

								  <input type="file" name="room6" id="room6" style="display: none;">
								  <label class='login-label custom-file-upload' for="room6">Image 6</label>

								  <input type="file" name="room7" id="room7" style="display: none;">
								  <label class='login-label custom-file-upload' for="room7">Image 7</label>

								  <input type="file" name="room8" id="room8" style="display: none;">
								  <label class='login-label custom-file-upload' for="room8">Image 8</label>

								  <input type="file" name="room9" id="room9" style="display: none;">
								  <label class='login-label custom-file-upload' for="room9">Image 9</label>

								  <input type="file" name="room10" id="room10" style="display: none;">
								  <label class='login-label custom-file-upload' for="room10">Image 10</label>

								</div>
								<div style="width: fit-content;margin: auto;padding: 30px;">
							  		<button style="width: 350px;" class="sb-btn">Register</button>
							  	</div>
							</form>
					</div>

					<div style="display: none;" id="rent-form"  class="fmms">/<!-- adds a new rental -->

						<form  class="w3-container w3-white w3-card-4 form" action="add_rental.php" method="post">
						  <h2 class="w3-text-black w3-center">New Rental Form</h2>
						  <p class="w3-center">Fill out the form to register a new Rental you represent.</p>
						  <br>
						  	<div class="forming">
							  <label class=" form-label">Full Rental Name</label>
							  <br>
							  <input class="form-control" name="rental_name" type="text">
							</div>

						  	<div class="forming">
								<label class=" form-label">What Type of Rental is it?</label>
								<br>
								<select name="new_category0" id="new_category0" class="form-control">
									<option value="">-</option>
									<option value="Apartment">Apartment</option>
									<option value="Bungalow">Bungalow</option>
									<option value="Cabin">Cabin</option>
									<option value="Condo">Condo</option>
									<option value="Cottage">Cottage</option>
									<option value="Farm house">Farm house</option>
									<option value="Mansionette">Mansionette</option>
									<option value="Mansion">Mansion</option>
									<option value="Mobile House">Mobile House</option>
									<option value="Semi-detached">Semi-detached</option>
									<option value="Tiny House">Tiny House</option>
										
								</select>
							</div>

							<div class="forming">
							  <label class=" form-label">Number of Bathrooms</label>
							  <br>
							  <label style="margin-right:20px"><span id="demo3">     </span></label>

						  
							  <input onload="load_slider('baths1')" style="width:150px" class="w3-radio" type="range" name="baths"  id="baths1"step="1" value="0" min="0" max="10"  onChange="slide('baths1','demo3')">
							</div>

							<div class="forming">
								<label class=" form-label">Number of Bedrooms</label>
							  	<br>
							  	<label style="margin-right:20px"><span id="demo4"></span></label>
							  
							  	<input onload="load_slider('beds1')" style="width:200px" class="w3-radio" type="range" name="beds"  id="beds1" step="1" value="0" min="0" max="15" onChange="slide('beds1','demo4')">
							</div>

							<div class="forming">
							  <label class=" form-label">Rental Price</label>
							  <input class="form-control" name="rental_price" type="int">
							</div>

							<div class="forming">
							  	<label class=" form-label">Location</label>
						  		<input class="form-control" name="rental_location" type="text">
						  	</div>

						  	<div class="forming">
							  <label class=" form-label">Rental Owner</label>
							  <br>
							  <select class="form-control" id="rental_owner" name="rental_owner">
							  	<option selected disabled>-</option>
									  	<?php 	
									  	$sl = "SELECT owner_name, owner_id FROM owner WHERE broker_id='$broker_id' ORDER BY owner_name";
									  	$rl = mysqli_query($con, $sl);

									  	if(mysqli_num_rows($rl) > 0)
									  	{
									  		while($row = mysqli_fetch_assoc($rl))
									  		{
									  			$oon = $row['owner_name'];
									  			$ood = $row['owner_id'];

									  			echo "<option value='".$ood."'>".$oon."</option>";
									  		}
									  	}
									  	?>
								  		
								  	</select>
							</div>

							<div class="forming" style="display: block !important; width: 100% !important">
								  <label class=" form-label">Amenities</label>
								    <br>
								    <div class="ames">

								    <input placeholder="Amenity 1" type="text" name="amenity" id="amenity">
								    <input placeholder="Amenity 2" type="text" name="amenity1" id="amenity1">
								    <input placeholder="Amenity 3" type="text" name="amenity2" id="amenity2">
								    <input placeholder="Amenity 4" type="text" name="amenity3" id="amenity3">
								    <input placeholder="Amenity 5" type="text" name="amenity4" id="amenity4">
								    </div>

								    <div class="ames">
								      
								    <input placeholder="Amenity 6" type="text" name="amenity5" id="amenity5">
								    <input placeholder="Amenity 7" type="text" name="amenity6" id="amenity6">
								    <input placeholder="Amenity 8" type="text" name="amenity7" id="amenity7">
								    <input placeholder="Amenity 9" type="text" name="amenity8" id="amenity8">
								    <input placeholder="Amenity 10" type="text" name="amenity9" id="amenity9">
								    </div>
								  <br>
								</div>				  
						  
						  <label class=" form-label">Please Upload at least 5 photos of the Rental</label>
						  <br>

						  		<div class="form-img">
								  
								  <br>
								  							  
								  <input type="file" name="room01" id="room01" style="display: none;">
								  <label class='login-label custom-file-upload' for="room01">Image 1</label>

								  <input type="file" name="room02" id="room02" style="display: none;">
								  <label class='login-label custom-file-upload' for="room02">Image 2</label>
								  
								  <input type="file" name="room03" id="room03" style="display: none;">
								  <label class='login-label custom-file-upload' for="room03">Image 3</label>

								  <input type="file" name="room04" id="room04" style="display: none;">
								  <label class='login-label custom-file-upload' for="room04">Image 4</label>

								  <input type="file" name="room05" id="room05" style="display: none;">
								  <label class='login-label custom-file-upload' for="room05">Image 5</label>

								  <input type="file" name="room06" id="room06" style="display: none;">
								  <label class='login-label custom-file-upload' for="room06">Image 6</label>

								  <input type="file" name="room07" id="room07" style="display: none;">
								  <label class='login-label custom-file-upload' for="room07">Image 7</label>

								  <input type="file" name="room08" id="room08" style="display: none;">
								  <label class='login-label custom-file-upload' for="room08">Image 8</label>

								  <input type="file" name="room09" id="room09" style="display: none;">
								  <label class='login-label custom-file-upload' for="room09">Image 9</label>

								  <input type="file" name="room010" id="room010" style="display: none;">
								  <label class='login-label custom-file-upload' for="room010">Image 10</label>

								</div>

								<div style="width: fit-content;margin: auto;padding: 30px;">
							  		<button style="width: 350px;" class="sb-btn">Edit</button>
							  	</div>
							</form>							
					</div>

					<div id="edit-property" style="display: none;" class="fmms">

						<div class="edit-radios" style="width: 640px;margin: auto;">
							<div>
								<input onclick="open_edit('fs-edit', 'rent-edit')" type="radio" name="edit-forms" id="sale-form" >
								<label for="sale-form">Edit 'For Sale' property</label>
							</div>
							
							<div>
								<input onclick="open_edit( 'rent-edit','fs-edit')" type="radio" name="edit-forms" id="rental-form" >
							<label for="rental-form">Edit Rental</label>
							</div>
						</div>
						

						<form style="display: none;" id="fs-edit"  class="w3-container w3-white w3-card-4 form" method="post" action="edit_property.php">
							<h3 class="w3-text-black w3-center">Fill out the areas you would like to edit</h3>
							<div class="forming">
								<label class=" form-label" for="property_name1"><strong>Property Name</strong></label>
								<br>
								<select class="form-control"  id="property_name1" name="property_id1" required>
									<option selected disabled>-</option>
									<?php 
									//retrive properties and display as options
									$sql1 = "SELECT property_name, property_id FROM property ORDER BY property_name";
									$result1 = mysqli_query($con, $sql1);
									if(mysqli_num_rows($result1) > 0)
									{
										while ($row = mysqli_fetch_assoc($result1))
										{
										$n = $row["property_name"];
										$i = $row['property_id'];
										echo "<option value='".$i."'>".$n."</option>";

										}
									}

									?>
								</select>  
							</div>
							<div class="forming">
								<label class=" form-label" for="property_owner"><strong>Owner</strong></label>
								<br>
								<select class="form-control" id="property_owner" name="property_owner">
							  	 		<option selected disabled>-</option>
									  	<?php 	
									  	$sl = "SELECT owner_name, owner_id FROM owner WHERE broker_id='$broker_id' ORDER BY owner_name";
									  	$rl = mysqli_query($con, $sl);

									  	if(mysqli_num_rows($rl) > 0)
									  	{
									  		while($row = mysqli_fetch_assoc($rl))
									  		{
									  			$oon = $row['owner_name'];
									  			$ood = $row['owner_id'];

									  			echo "<option value='".$ood."'>".$oon."</option>";
									  		}
									  	}
									  	?>
								  		
								  	</select> 
							</div>

							<div class="forming">
								<label class=" form-label" for="new_name"><strong>New Property Name</strong></label>
								<br>
								<input class="form-control" type="text" name="new_name" id="new_name">  
							</div>

							<div class="forming">
								<label class=" form-label" for="new_category"><strong>New Category</strong></label>
								<br>
								<select class="form-control" name="new_category" id="new_category">
									<option value="">-</option>
									<option value="Apartment">Apartment</option>
									<option value="Bungalow">Bungalow</option>
									<option value="Cabin">Cabin</option>
									<option value="Condo">Condo</option>
									<option value="Cottage">Cottage</option>
									<option value="Farm house">Farm house</option>
									<option value="Mansionette">Mansionette</option>
									<option value="Mansion">Mansion</option>
									<option value="Mobile House">Mobile House</option>
									<option value="Semi-detached">Semi-detached</option>
									<option value="Tiny House">Tiny House</option>
									
								</select>  
							</div>
							
							<div class="forming">
								<label class=" form-label" for="new_price"><strong>New Price</strong></label>
								<br>
								<input class="form-control" type="int" name="new_price" id="new_price">
							</div>

							<div class="forming">
								 <label class=" form-label" for="new_location"><strong>New Location</strong></label>
							
								<br>
								
								<input class="form-control" type="text" name="new_location" id="new_location"> 
							</div>

							<div class="forming" style="display: block !important; width: 100% !important">
								  <label class=" form-label">Amenities</label>
								    <br>
								    <div class="ames">

								    <input placeholder="Amenity 1" type="text" name="amenity" id="amenity">
								    <input placeholder="Amenity 2" type="text" name="amenity1" id="amenity1">
								    <input placeholder="Amenity 3" type="text" name="amenity2" id="amenity2">
								    <input placeholder="Amenity 4" type="text" name="amenity3" id="amenity3">
								    <input placeholder="Amenity 5" type="text" name="amenity4" id="amenity4">
								    </div>

								    <div class="ames">
								      
								    <input placeholder="Amenity 6" type="text" name="amenity5" id="amenity5">
								    <input placeholder="Amenity 7" type="text" name="amenity6" id="amenity6">
								    <input placeholder="Amenity 8" type="text" name="amenity7" id="amenity7">
								    <input placeholder="Amenity 9" type="text" name="amenity8" id="amenity8">
								    <input placeholder="Amenity 10" type="text" name="amenity9" id="amenity9">
								    </div>
								  <br>
								</div>

							<br>
							<label for="edit_images"><strong>New Images</strong></label>
							
							<div class="form-img">
								<input type="file" name="room01" id="room01" style="display: none;">
								<label class='login-label custom-file-upload' for="room01">Image 1</label>

								<input type="file" name="room02" id="room02" style="display: none;">
								<label class='login-label custom-file-upload' for="room02">Image 2</label>
								  
								<input type="file" name="room03" id="room03" style="display: none;">
								<label class='login-label custom-file-upload' for="room03">Image 3</label>

								<input type="file" name="room04" id="room04" style="display: none;">
								<label class='login-label custom-file-upload' for="room04">Image 4</label>

								<input type="file" name="room05" id="room05" style="display: none;">
								<label class='login-label custom-file-upload' for="room05">Image 5</label>

								<input type="file" name="room06" id="room06" style="display: none;">
								<label class='login-label custom-file-upload' for="room06">Image 6</label>

								<input type="file" name="room07" id="room07" style="display: none;">
								<label class='login-label custom-file-upload' for="room07">Image 7</label>

								<input type="file" name="room08" id="room08" style="display: none;">
								<label class='login-label custom-file-upload' for="room08">Image 8</label>

								<input type="file" name="room09" id="room09" style="display: none;">
								<label class='login-label custom-file-upload' for="room09">Image 9</label>

								<input type="file" name="room010" id="room010" style="display: none;">
								<label class='login-label custom-file-upload' for="room010">Image 10</label>

							</div>
								<div style="width: fit-content;margin: auto;padding: 30px;">
							  		<button style="width: 350px;" class="sb-btn">Edit</button>
							  	</div>
							</form>
								
						</form>

						<form style="display: none;" id="rent-edit"  class="w3-container w3-white w3-card-4 form" method="post" action="edit_rental.php">
							<h3 class="w3-text-black w3-center">Fill out the areas you would like to edit</h3>
							<div class="forming">
								<label class=" form-label" for="rental_name1"><strong>Rental Name</strong></label>
								<br>
								<select class="form-control" id="rental_name1" name="rental_id1" required>
									<?php 
									//retrive properties and display as options
									$sl1 = "SELECT rental_name, rental_id FROM rental WHERE broker_id='$broker_id";
									$rt1 = mysqli_query($con, $sl1);
									if(mysqli_num_rows($rt1) > 0)
									{
										while ($row = mysqli_fetch_assoc($rt1))
										{
										$nn = $row["rental_name"];
										$ii = $row['rental_id'];
										echo "<option value='".$ii."'>".$nn."</option>";

										}
									}

									?>
								</select>
							</div>

							<div class="forming">
								<label class=" form-label" for="rental_owner"><strong>Rental Owner</strong></label>
								<br>
								<select class="form-control" id="rental_owner" name="property_owner">
							  	 		<option selected disabled>-</option>
									  	<?php 	
									  	$sl = "SELECT owner_name, owner_id FROM owner WHERE broker_id='$broker_id' ORDER BY owner_name";
									  	$rl = mysqli_query($con, $sl);

									  	if(mysqli_num_rows($rl) > 0)
									  	{
									  		while($row = mysqli_fetch_assoc($rl))
									  		{
									  			$oon = $row['owner_name'];
									  			$ood = $row['owner_id'];

									  			echo "<option value='".$ood."'>".$oon."</option>";
									  		}
									  	}
									  	?>
								  		
								  	</select>
							</div>
							
							<div class="forming">
								<label class=" form-label" for="new_name1"><strong>New Rental Name</strong></label>
								<br>
								<input class="form-control" type="text" name="new_name1" id="new_name1">
							</div>
							
							<div class="forming">
								<label class=" form-label" for="new_category"><strong>New Category</strong></label>
							<br>
							<select class="form-control" name="new_category" id="new_category">
								<option value="">-</option>
								<option value="Apartment">Apartment</option>
								<option value="Bungalow">Bungalow</option>
								<option value="Cabin">Cabin</option>
								<option value="Condo">Condo</option>
								<option value="Cottage">Cottage</option>
								<option value="Farm house">Farm house</option>
								<option value="Mansionette">Mansionette</option>
								<option value="Mansion">Mansion</option>
								<option value="Mobile House">Mobile House</option>
								<option value="Semi-detached">Semi-detached</option>
								<option value="Tiny House">Tiny House</option>
								
							</select>
							</div>
							
							<div class="forming">
								<label class=" form-label" for="new_price1"><strong>New Price</strong></label>
								<br>
								<input class="form-control" type="int" name="new_price1" id="new_price1">

							</div>
							
							<div class="forming">
								<label class=" form-label" for="new_location1"><strong>New Location</strong></label>
							
								<br>
								
								<input class="form-control" type="text" name="new_location1" id="new_location1">
							</div>

							<div class="forming" style="display: block !important; width: 100% !important">
								  <label class=" form-label">Amenities</label>
								    <br>
								    <div class="ames">

								    <input placeholder="Amenity 1" type="text" name="amenity" id="amenity">
								    <input placeholder="Amenity 2" type="text" name="amenity1" id="amenity1">
								    <input placeholder="Amenity 3" type="text" name="amenity2" id="amenity2">
								    <input placeholder="Amenity 4" type="text" name="amenity3" id="amenity3">
								    <input placeholder="Amenity 5" type="text" name="amenity4" id="amenity4">
								    </div>

								    <div class="ames">
								      
								    <input placeholder="Amenity 6" type="text" name="amenity5" id="amenity5">
								    <input placeholder="Amenity 7" type="text" name="amenity6" id="amenity6">
								    <input placeholder="Amenity 8" type="text" name="amenity7" id="amenity7">
								    <input placeholder="Amenity 9" type="text" name="amenity8" id="amenity8">
								    <input placeholder="Amenity 10" type="text" name="amenity9" id="amenity9">
								    </div>
								  <br>
								</div>

							
							<label><strong>New Images</strong></label>
							
							<div class="form-img">
                  
			                  <br>
			                                  
			                  <input type="file" name="room1" id="room1" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room1">Image 1</label>

			                  <input type="file" name="room2" id="room2" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room2">Image 2</label>
			                  
			                  <input type="file" name="room3" id="room3" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room3">Image 3</label>

			                  <input type="file" name="room4" id="room4" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room4">Image 4</label>

			                  <input type="file" name="room5" id="room5" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room5">Image 5</label>

			                  <input type="file" name="room6" id="room6" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room6">Image 6</label>

			                  <input type="file" name="room7" id="room7" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room7">Image 7</label>

			                  <input type="file" name="room8" id="room8" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room8">Image 8</label>

			                  <input type="file" name="room9" id="room9" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room9">Image 9</label>

			                  <input type="file" name="room10" id="room10" style="display: none;">
			                  <label class='login-label custom-file-upload' for="room10">Image 10</label>

			                </div>

			                <div style="width: fit-content;margin: auto;padding: 30px;">
			                    <button style="width: 350px;" class="sb-btn">Register</button>
			                  </div>
						</form><!-- edits property details both for sale or for rent -->

					</div>
					

					<div id="client-form" style="display: none;" class="fmms">
						<form class="w3-container w3-white w3-card-4 form" action="add_client.php" method="post">
							<h3 class="w3-center">Fill the Owner's name and email.</h3>
							<h5 class="w3-center">They will receive an email asking them to verify their account and fill their details.</h5>

							<div class="forming">
								<label class=" form-label">Owner Name</label>
							  	<input class="form-control" name="full_name" type="text">
							  </div>
							<div class="forming">
							  	<label class=" form-label">Email</label>
							 	<input class="form-control" name="owner_email" type="email">
							 </div>

						  	<div style="width: fit-content;margin: auto;padding: 30px;">
							  		<button style="width: 350px;" class="sb-btn">Send</button>
							  	</div>
						  	<br>

						  	
						</form>
					</div>

					<div id="owner-form" class='w3-container w3-white w3-card-4 fmms' style=" width: 80%; margin: auto; display: none; overflow-y: scroll; max-height: 570px; box-shadow: rgba(2, 2, 4, 0.56) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" class="fmms">
						
						<?php 
						$sq = "SELECT * FROM owner JOIN broker ON owner.broker_id = broker.broker_id WHERE owner.broker_id ='$broker_id' ORDER BY broker_status";
						$rs = mysqli_query($con, $sq);

						if(mysqli_num_rows($rs) >  0)
						{
							while($row = mysqli_fetch_assoc($rs))
							{	$ow_id = $row['owner_id'];
								$ow_na = $row['owner_name'];
								$ow_em = $row['owner_email'];
								$ow_ph = $row['owner_phone'];
								$ow_pi = $row['owner_pic'];
								$broker_status = $row['broker_status'];

								if($broker_status == 'pending')
								{
									echo "
											<div class='card'>
											<form  action='approve_client.php' method='post'>
											<input type='hidden' name='statee' value='pending'>
											<input type='hidden' name='oid' value='".$ow_id."'>
												<img src=' ".$ow_pi."' alt=' ' style='width:100%'>
												<h3> ".$ow_na."</h3>
												<p class='title'>Property Owner</p>
												<div style='margin: 24px 0;'>
												    <p> ".$ow_em."</p>
												    <p>+254 ".$ow_ph."</p> 
												    <button title='Accept Offer' class='clear-btn' name='accept-btn'><i class='fa-solid fa-circle-check'></i></button>
												    <button title='Reject Offer' class='clear-btn' name='reject-btn' ><i class='fa-solid fa-circle-minus'></i></button>
												</div>

												</form>	
												</div>
											
										";
								}
								else if($broker_status == 'unknown')
								{
									echo "
											<div class='card'>
											<form  action='approve_client.php' method='post'>
											<input type='hidden' name='statee' value='unknown'>
											<input type='hidden' name='oid' value='".$ow_id."'>
												<img src=' ".$ow_pi."' alt=' ' style='width:100%'>
												<h3> ".$ow_na."</h3>
												<p class='title'>Property Owner</p>
												<div style='margin: 24px 0;'>
												    <p>".$ow_em."</p>
												    <p>+254 ".$ow_ph."</p> 
												    <button title='Send Representation request' class='clear-btn'><i class='fa-solid fa-circle-plus'></i></button>
												    
												</div>
												</form>
												
												</div>	
												
										";
								}

								else if($broker_status == 'approved')
								{
									echo "
											<div class='card'>
											<form  action='approve_client.php' method='post'>
											<input type='hidden' name='statee' value='unknown'>
											<input type='hidden' name='oid' value='".$ow_id."'>
												<img src=' ".$ow_pi."' alt=' ' style='width:100%'>
												<h3> ".$ow_na."</h3>
												<p class='title'>Property Owner</p>
												<div style='margin: 24px 0;'>
												    <p>".$ow_em."</p>
												    <p>+254 ".$ow_ph."</p> 
												    <button title='Stop Representing' class='clear-btn'><i class='fa-solid fa-circle-minus'></i></button>
												    
												</div>
												</form>
												
												</div>	
												
										";
								}
							}
						}

						?>
					</div>

				</div>
			</div>

			<div id="broker_home_bottom">
				<div class="market">
				  <!-- Title -->
				  <div class="title">Properties For Sale</div>
				 <div style="border-bottom: 1px solid #E1E8EE">
				 	<div class="title1" style="width: 47%;">Property</div>
				 	<div class="title1" style="width: 25%;">Bids</div>
				 	<div class="title1" style="width: 20%;">Owners</div>
				 </div>
				  <?php 
					$s1 = "SELECT DISTINCT  property.*, owner.*  FROM  property  JOIN owner ON owner.owner_id = property.owner_id WHERE broker_id = '$broker_id' ORDER BY property.property_name";
					$r1 = mysqli_query($con, $s1);

					//if there are any wishes in db
					if(mysqli_num_rows($r1) > 0)
					{
						while($row = mysqli_fetch_assoc($r1))
						{
							//retrieve property details
							$property_name = $row['property_name'];
							$property_id = $row['property_id'];
							$price = $row['price'];
							$location = $row['location'];
							$category = $row['category'];
							$room1 = $row['room1'];
							$baths = $row['bathrooms'];
							$beds = $row['bedrooms'];

							//retrieve owner details
							$owner_name = $row['owner_name'];
							$owner_email = $row['owner_email'];
							$owner_phone = $row['owner_phone'];
							$owner_gender = $row['owner_gender'];



							$s3 = "SELECT amount FROM bid WHERE property_id = '$property_id'";
							$r3 = mysqli_query($con, $s3);

							if(mysqli_num_rows($r3) > 0)
							{							
								$bids = mysqli_num_rows($r3);
								if($bids = 1)
								{
									$bd = ' Bid';
								}
								if($bids > 1)
								{
									$bd = ' Bids';
								}
								
							}
							else
							{
								$bids = 0;
								$bd = '';

							}

							$s4 = "SELECT bid.bid_id, bid.amount, bid.bid_status, bid.bid_approval, client_name, bid.client_id, bid.bid_state FROM bid JOIN client ON bid.client_id = client.client_id  WHERE  property_id = '$property_id'";
							$r4 = mysqli_query($con, $s4);

							if(mysqli_num_rows($r4) > 0)
							{
								$d = 0;

								while($row = mysqli_fetch_assoc($r4))
								{
										$bid_id = $row['bid_id']; 
										$amount = $row['amount'];
										$bidder =  $row['client_name'];
										$bid_approval = $row['bid_approval'];
										$client_id = $row['client_id'];
										$bid_state = $row['bid_state'];//payment completed or not
										$bid_status = $row['bid_status'];//bid is open or closed

										if($bid_approval == 'yes')
										{
											$style1 = "color: #2e74b5;'";
											$ap = "Disapprove";
										}
										else
										{
											$style1 = "";
											$ap = "Approve";
										}

										if($bid_state == 'pending' && $bid_status == 'blocked')//bids are currently blocked
										{
											$open_btn = $close_btn = "";
											$block_btn = "disabled style='color:gray'";
											$comment = "<p>Payment Pending.</p> <a href='cancel_bid.php'>Cancel</a>";

										}
										else if($bid_state == 'incomplete' && $bid_status == 'open')//bids are open
										{
											$close_btn = $block_btn = "";
											$open_btn ="disabled style='color:gray'";
											$comment = "";
										}
										else if ($bid_state == 'complete' && $bid_status == 'closed')//bid state is complete meaning bids are closed
										{
											$close_btn = $open_btn = $block_btn = "style = 'display: none'";
											$comment = "<p>Transaction Complete. <a href ='my_receipts.php'> View Receipt </a>";
										}
										
										
										$display_bid = "<div><p><a style='".$style1."' onclick='openApprove()' ><strong>".$bidder."</strong>: Ksh. ".$amount."</a></p>
												<div class='approve_bids' id='approve_bids' style='display: ;'>
													<form action='approve_bids.php' method='post'>
														<input type='submit'  value='".$ap."'>
														<input type='hidden' name='".$ap."' value='".$ap."'>
														<input type='hidden' name='bdd' value='".$client_id."'>
														<input type='hidden' name='ppp' value='".$property_id."'>
													</form>	

												</div>
												
												</div>";
										

										$bidders[$d] = $display_bid;
										$d++;

										
								}
							}
							else
								{
									$close_btn = $open_btn = $block_btn = "style = 'display: none'";
									$comment = "";
								}

							
							

							echo "<div class='item'>
									     
									    <div class='image'>
									      <img src='".$room1."' alt='No pic'>
									    </div>
									 
									    <div class='description'>
										    <form action='property_details.php' method='post'>
											    <input type='hidden' name='pid' value='".$property_id."' >
											    <a title='View ".$property_name."' ><strong>".$property_name."</strong></a>
											</form>

											    <p style='color:#8d9aa6;'>".$location."</p>
											    <p>Amenities: </p>
											    <p>Ksh. ".$price."</p>
											    <p  >".$beds." beds <strong>|</strong> ".$baths." baths</p>

											    <p style='font-size: 16px; color: #868a8a;'><a href='broker_home.php#part1' title='View Bids'>".$bids.$bd." made.</a></p>
											    </form>
										      
									    </div>

									    <div class='view_bids'>
									    	<div id='bids_made' style='overflow-y: auto'>
									    	<p><strong>Bids Made: </strong></p>

									    	<form action='change_bid.php' method='post'>
									    		<input type='hidden' name='pidd' id='pidd' value='".$property_id."'>
									    		<input type='hidden' name='cidd' id='cidd' value='".$client_id."'>
												<input type='submit' value='Close Bids' name='close' ".$close_btn.">
												<input type='submit' value='Open Bids' name='open' ".$open_btn.">
												<input type='submit' value='Block Bids' name='block' ".$block_btn.">
												".$comment."
											</form>
									    ";
									for($d = 0; $d< count($bidders); $d++)
									{
										echo $bidders[$d];
									}
									$bidders = array('<p>No Bids made.</p>');

									echo "	</div> 
									   </div>";

									

									    	

									   

									 echo "	<div class='description' style='padding-top:20px'>
											
									          <p><strong>".$owner_name."</strong></p>
									          <p style='color:#8d9aa6;'>".$owner_gender."</p>
									          <p>".$owner_email."</p>
									          <p>+254 ".$owner_phone."</p>
									      
									    </div>
									  </div>";

						}
					}
				?>

				</div>

				
			</div>

			<div class="market">
				  <!-- Title -->
				  <div class="title">
				    Rentals
				  </div>
				 
				  <?php 
				  	$sql33 = "SELECT requests.*, client_name FROM requests JOIN client ON requests.requester_id = client.client_id WHERE servicer_id='$broker_id'";
					$rs33 = mysqli_query($con, $sql33);

					if(mysqli_num_rows($rs33) > 0)
					{
						$total_requests = mysqli_num_rows($rs33);

						while($row = mysqli_fetch_assoc($rs33))
						{
							$request_title = $row['request_title'];
							$requester_name = $row['client_name'];
							$request_date = $row['date_sent'];
							$req_section = "<div class='description'>
										    	<h5><strong>Service Requests</strong></h5>
										    	<p>You have ".$total_requests." Pending Service Requests</p>
										    	<p><strong>".$request_title."</strong> from <strong>".$requester_name."</strong> on ".$request_date."</strong></p>

										    	<a href='service_requests.php'>View All Requests</a>
										    </div>";
						}
					}
					else
					{
						$req_section = "<div class='description'>
										    	<h5><strong>Service Requests</strong></h5>
										    	<p>You have No Pending Service Requests</p>
										    </div>";
					}

					$s122 = "SELECT rentals.*, owner.owner_name, broker.broker_name  FROM rentals JOIN owner ON rentals.owner_id = owner.owner_id JOIN broker ON owner.broker_id = broker.broker_id WHERE broker.broker_id = '$broker_id'";

					$r122 = mysqli_query($con, $s122);

					//if there are any wishes in db
					if(mysqli_num_rows($r122) > 0)
					{
						while($row = mysqli_fetch_assoc($r122))
						{
							$rental_name = $row['rental_name'];
							$rental_id = $row['rental_id'];
							$rental_price = $row['rental_price'];
							$rental_location = $row['rental_location'];
							$category = $row['category'];
							$baths = $row['bathrooms'];
							$beds = $row['bedrooms'];
							$rental_status = $row['rent_paid'];
							if($rental_status == 'no')
							{
								$ren = "No.";
							}
							else if($rental_status)
							{
								$ren = "Yes.";
							}
							$room11 = $row['room1'];
							$room22 = $row['room2'];
							$room33 = $row['room3'];
							$room44 = $row['room4'];
							$room55 = $row['room5'];

							

							echo "<div class='item'>
									     
									    <div class='image'>
									      <img src='".$room11."' alt='No pic'>
									    </div>
									 
									    <div class='description'>
										    <form action='display_property.php' method='post'>
											    <input type='hidden' name='pid' value='".$rental_id."' >
											    <a title='View ".$rental_name."'><strong>".$rental_name."</strong></a>
											    <p style='color:#8d9aa6;'>".$rental_location."</p>
											    <p>Ksh. ".$rental_price."</p>
											    <p  >".$beds." beds <strong>|</strong> ".$baths." baths</p>
											    <p style='font-size: 16px; color: #868a8a;' >Rent Paid: ".$ren."</p>
										    </form>  
									    </div>

									    ".$req_section."

									    
									    								      
									    </div>
									  ";

						}

	
					}
					else
					{
						echo "<div class='item'>
									<p style='margin: auto'>You are not letting out any house</p>
								</div>";
					}
					?>

				  
				 
				 </div>
		</div>

		<script>
							function slide( x,  y){

							  var slider = document.getElementById(x);
							  var output = document.getElementById(y);
							  output.innerHTML = slider.value;

							  slider.oninput = function() {
							    output.innerHTML = this.value;
							    }
							}
							function open_form(x)
							{	
								var b = document.getElementById(x);
								if (b.style.display === "none") 
								{
									var arrayOfElements=document.getElementsByClassName('fmms');
									var lengthOfArray=arrayOfElements.length;
									

									for (var i=0; i<lengthOfArray;i++)
									{
									    arrayOfElements[i].style.display='none';
									}
								
								    b.style.display = "block";  
								} 
								else if(b.style.display === "block")
								{
									b.style.display = "none";
								}

							}

							function open_edit( x, y)
							{
								var a = document.getElementById(x);
								var b = document.getElementById(y);

								if (a.style.display === "none") {
								    a.style.display = "block";
								    b.style.display = "none";
								  } 
								
							}
							function load_slider(x) {
								var a = document.getElementById(x);
								a.innerHTML = this.value;
							}

							// When the user clicks on div, open the popup
					        function popup1(x,y) {
					          var popup = document.getElementById(y);
					          var style = popup.style.display;

					          if(style ===  'block')
					          {
					            popup.style.display = 'none';
					          }
					          else if(style ===  'none')
					          {
					            popup.style.display = 'block';
					          }
					          popup.classList.toggle("show");
					        }
			
			function openApprove() 
			{
			  var x = document.getElementById('approve_bids');
			  if (x.style.display === "none") 
			  {
			    x.style.display = "block";
			  } 
			  else 
			  {
			    x.style.display = "none";
			  }
			} 

		</script>
				
	<!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Email address input-->
                            <div class="row input-group-newsletter">
                                <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                                <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Notify Me!</button></div>
                            </div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.</div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3 mt-2 text-white">
                                    <div class="fw-bolder">Form submission successful!</div>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section id="contact_info" class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100" style="width: 100%">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">Third-Wheel Avenue, Kileleshwa</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100" style="width: 100%;">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">nyumbazetuke@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100" style="width: 100%;">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+254 704 172 740</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Nyumba Zetu KE 2022</div></footer>

</body>
</html>