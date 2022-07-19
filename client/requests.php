<?php
require_once '../config.php';
session_start();

$response_title = $response_date = $response_content = "";

//retrieve client_id
if(isset($_SESSION['client_id']))
{
	$client_id = $_SESSION['client_id'];

}
else
{
	echo "<script>alert('Login First!')</script>";
	header("location: ../Nyumba Zetu/homepage.php");
}


$sql1 = "SELECT * FROM client WHERE client_id = '$client_id'";
$result1 = mysqli_query($con, $sql1);

if(mysqli_num_rows($result1) > 0)
{
	while($row = mysqli_fetch_assoc($result1))
	{
		$client_name = $row['client_name'];
		$client_gender = $row['gender'];
		$client_phone_number = $row['phone_number'];
		$client_location = $row['location'];
		$_SESSION['client_name'] = $client_name;
		$client_email = $_SESSION['client_email'] =  $row['email'];
		$client_pic = "../images/clients/".$row['picture_url'];
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
	<title><?php echo $client_name ?></title>
	<link href="../Nyumba Zetu/css/styles.css" rel="stylesheet" />
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<style>
		#client_details p
		{
			font-size: 1.4em;
		}
		.dropbtn {
		  background-color: #4CAF50;
		  color: white;
		  padding: 16px;
		  font-size: 16px;
		  border: none;
		  cursor: pointer;
		}

		.dropdown {
		  position: relative;
		  display: inline-block;
		}

		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: white;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		  border-radius: 12px;
		  font-size: 17px;
		  text-align: left !important;
		}

		.dropdown-content a {
		  color: black !important;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		  

		}

		.dropdown-content a:hover {background-color: #f1f1f1}

		.dropdown:hover .dropdown-content {
		  display: block;
		}

		.dropdown:hover .dropbtn {
		  background-color: #3e8e41;
		}
		.title1
		{
			display: inline-block;
			width: 47%;
			text-align: center;
			font-size: 1.4.em;

		}
		.form-control
		{
			display: inline-block;
			width: 100%;
			padding: 10px;
			margin: 10px;
		}
		.forming
		{
			display: inline-block;
		}
		.request, .response
		{
			width: 48%;
			padding: 1em;
		}
	</style>
</head>
<body>
	
	<div id="nn">
            
        <div class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" >                
                    
            <div id="navbar_options" class="navbar-brand "><a style="font-size: 1.5em;" title="Nyumba Zetu" href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
            
            <div id="navbar_options" class="navbar-brand "><a href="display.php">For Sale</a></div>
            
            <div id="navbar_options" class="navbar-brand "><a href="rentals.php">Rentals</a></div>
            
            <div id="navbar_options" class="navbar-brand "><a href="#contact_info">Contact Us</a></div>

            <div id="navbar_options" class="navbar-brand dropdown">
	            <a href="../settings.php">Settings</a>
	            <div class="dropdown-content">
					<a href="../settings.php">My Details</a>
					<a href="../settings.php">My Account</a>
				</div>
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

        
    <div id="client_home ">
			<div id="client_home_top"> 

			    <div id="client">
			    	<fieldset>
			    		<div id="client_pic">
			    			<img style="width: 200px;height: 200px; border-radius: 50%;object-fit: cover;" src="<?php echo $client_pic ?>">
			    		</div>
			    		
			    		<div id="client_details">
			    			<p><strong>Name: </strong><?php echo $client_name ?></p>
			    			<p><strong>Email: </strong><?php echo $client_email ?></p>
			    			<p><strong>Location: </strong><?php echo $client_location ?></p>

			    		</div>
			    	</fieldset>
			    </div>
			</div>

			<div id="client_home_bottom">
				 <div class="market view-requests-made">
					  <!-- Title -->

					  <div class="title">Service Requests</div>
					  <div style="border-bottom: 1px solid #E1E8EE;">
					  	<button title="New Request" style="border: none;/*! background: none; */colour: black;width: 70px;margin: 20px;padding: 15px;height: 70px;" onclick="open_req()"><i style="height: 2.5em !important;" class="fa-solid fa-circle-plus"></i></button>
					  </div>

					  <script>
							function open_req()
							{
								var a = document.getElementById('send-request');

								if(a.style.display === "none")
								{
									
									a.style.display = "block";
								}
								else if( a.style.display === "block")
								{
									a.style.display = "none";
								}

								
							} 
							
					  </script>

					 
					 
					 <div class="item" id="send-request" style="display: none; ">

					 	<form action="send_request.php" method="post" style="width: 100%;padding: 20px;">
					 		<h5 style="width: fit-content;margin: auto;">Fill The Form Below to Send a Service Request.</h5>
					 		<datalist id="services">
					 			<option value="Electrical Issues">Electrical Issues</option>
					 			<option value="Plumbing and Water Supply">Plumbing and Water Supply</option>
					 			<option value="Issues with Offers Made">Issues with Offers Made</option>
					 			<option value="Password Change">Password Change</option>
					 			<option value="Home Security Issue">Home Security Issue</option>
					 			<option value="Rent Issues">Rent Issues</option>
					 			<option value="Bills & Uilities">Bills & Uilities</option>
					 			<option value="Home Repairs">Home Repairs</option>
					 			
					 		</datalist>

					 		<div class="forming" style="width: 34%;">
						 		<input class="form-control" type="email" name="from-email" placeholder="<?php echo $client_email ?>" disabled>
						 	</div>
						 	<div class="forming" style="width: 65%;">
						 		<input list="services" class="form-control" type="text" name="request-title" id="request-title" placeholder="Request Title" required>

						 	</div>
						 	<div class="forming" style="display: block; width: 100%">
						 		<select class="form-control" name="property-name">

						 			<option selected disabled>Pick The Property Concerned</option>
						 			<optgroup label="Properties For Sale">
						 				<?php 
							 			$sq = "SELECT property_name, property_id FROM property ORDER BY property_name";
							 			$rs2 = mysqli_query($con, $sq);

							 			if(mysqli_num_rows($rs2) > 0)
							 			{
							 				while($row = mysqli_fetch_assoc($rs2))
							 				{
							 					echo "<option value='".$row['property_name']."'>".$row['property_name']."</option>";
							 				}
							 			}
							 			?>
						 			</optgroup>
						 			<optgroup label="Rentals">
						 				<?php 
							 			$sq3 = "SELECT rental_name, rental_id FROM rentals ORDER BY rental_name";
							 			$rs3 = mysqli_query($con, $sq3);

							 			if(mysqli_num_rows($rs3) > 0)
							 			{
							 				while($row = mysqli_fetch_assoc($rs3))
							 				{
							 					echo "<option value='".$row['rental_name']."'>".$row['rental_name']."</option>";
							 				}
							 			}
							 			?>
						 			</optgroup>
						 			
						 		</select>
						 	</div>
						 	<div class="forming" style="display: block; width: 100%">
						 		<textarea class="form-control" name="request-content" placeholder="Write your request here" required></textarea>
						 	</div>

						 	<div class="forming" style="display: block; width: 30%; margin: auto;">
						 		<input class="form-control" type="submit" value="Send">

						 	</div>

					 	</form>
					 </div>
					 <?php 
					 $sql = "SELECT * FROM requests WHERE requester_id= '$client_id'";
					 $rs1 = mysqli_query($con, $sql);
					 if($rs1)
					 {
					 	echo "<div style='border-bottom: 1px solid #E1E8EE'>
							 	<div class='title1'>Service Request</div>
							 	<div class='title1' >Response</div>
							 </div>";
					 	if(mysqli_num_rows($rs1) > 0)
						{
							while($row = mysqli_fetch_assoc($rs1))
							{
								$request_id = $row['request_id'];
								$request_title = $row['request_title'];
								$request_date = $row['date_sent'];
								$request_content = $row['request_content'];
								$requester_id = $row['requester_id'];

								echo "<div class='item'>
									    
										<div class='request' style='border-right: 4px solid #8080804f;'>
											<p><strong>".$request_title."</strong></p>
											<p>".$request_content."</p>
											<p>Sent on ".$request_date."</p>
										</div>";

								$sq1 = "SELECT * FROM responses WHERE request_id='$request_id'";
								$rs = mysqli_query($con, $sq1);

								if($rs)
								{
									if(mysqli_num_rows($rs) > 0)
									{
										while($row = mysqli_fetch_assoc($rs))
										{
											$response_title = $row['response_title'];
											$response_date = $row['date_sent'];
											$response_content = $row['response_content'];

											echo		"<div class='response' style='text-align: right;'>
															<p><strong>".$response_title."</strong></p>
															<p>".$response_content."</p>
															<p>Sent on ".$response_date."</p>
														</div>
													";
										}
									}
									else
								{
									echo "<div class='response'>
											
											<p style='text-align: right'>You have not received Any Responses Yet.</p>
										</div>";
								}
									
								}
								else
								{
									echo "<div class='response'>
											<p style='text-align: right'>You have not received Any Responses Yet.</p>
										</div>";
								}

								echo "</div>";

							}
						}
					}
					else
					{
						echo "<div id='desci' style='text-align: center; padding: 20px;'>
									<h5><strong>Service Requests</strong></h5>
									<p>You have No Service Requests</p>
									<button class='clear-btn' style='font-size: 15px !important; color: #bf5238;' onclick='open_req()'>Send New Request</button>
								</div>";
					}
					?>

				</div>

				<div class='market make-new-request'>
					
				</div>
			</div>
	</div>
</body>
</html>