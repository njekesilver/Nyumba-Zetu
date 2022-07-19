<?php
require_once '../config.php';
session_start();

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

$sql1 = "SELECT requests.*, client_name FROM requests JOIN client ON requests.requester_id = client.client_id WHERE servicer_id='$broker_id'";
$rs1 = mysqli_query($con, $sql1);





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
                    
	        <div id="navbar_options" class="navbar-brand "><a title="Nyumba Zetu" style="font-size: 1.5em;" href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
	                    
	        <div id="navbar_options" class="navbar-brand "><a href="broker_home.php#contact_info">Contact Us</a></div>

	        <div id="navbar_options" class="navbar-brand "><a href="../settings.php">Settings</a></div>

	        <div id="navbar_options" class="navbar-brand active"><a href="">Service Requests</a></div>

	        <div id="navbar_options" class="navbar-brand ">
	        	<a href="broker_home.php" class="active" title=""><?php echo $broker_name ?>
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
			</div>

			<div id="broker_home_bottom">
				<div class="market">
					  <!-- Title -->
					  <div class="title">Service Requests</div>

					 <div style="border-bottom: 1px solid #E1E8EE">
					 	<div class="title1" style="width: 47%; margin: ;text-align: center;">Service Request</div>
					 	<div class="title1" style="width: 47%; margin: ;text-align: center;">Response</div>
					 </div>
					 <?php 
					 if(mysqli_num_rows($rs1) > 0)
						{
							while($row = mysqli_fetch_assoc($rs1))
							{
								$request_id = $row['request_id'];
								$request_title = $row['request_title'];
								$requester_name = $row['client_name'];
								$request_date = $row['date_sent'];
								$request_content = $row['request_content'];
								$requester_id = $row['requester_id'];
								echo "<div class='item'>
									    
										<div class='request' >
											<p><strong>".$request_title."</strong></p>
											<p>".$request_content."</p>
											<p>Sent on ".$request_date."</p>
										</div>";
								echo "  <div class='response'>
											<form action='send_response.php' method='post'>

												<div class='forming'>
													<label class=' form-label'>To: </label>
												  	<input class='form-control' name='can' type='int' value='".$requester_name."' disabled>
											  	</div>
											  	<div class='forming'>
												  	<input class='form-control' type='text'  value='".$request_title."' disabled>
												  	<input type='hidden' name='response-title' value='".$request_title."'>
												  	<input  type='hidden' name='rid' value=".$request_id.">
											  </div>

											  <div class='forming' style='width: 100%;'>
											  	<textarea name='response-content' style='height: 70px;' class='form-control' placeholder='Type your response here.'></textarea>
											  </div>
											  <div class='forming' >
											  <input type='submit' class='form-control' value='Reply'>	
											  </div>
											</form>
										</div>
									</div>";

							}
						}
						else
						{
							echo "<div class='desci' style='text-align: center;'>
												<h5><strong>Service Requests</strong></h5>
												<p>You have No Pending Service Requests</p>
											</div>";
						}
					 ?>
					 
			</div>
		</div>


	</body>
</html>