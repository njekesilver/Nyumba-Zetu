<?php
require_once '../config.php';
session_start();

$st = "color: #868a8a;";
$apr = "Not Approved";
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

$client_email = $pay_btn = "";
$client_name = "";
$client_gender = "";
$client_phone_number = "";
$client_location = "";
$client_pic = "";

$bids =0;
$property_id =0;
$property_name;
$price;
$location;
$category;
$wish_pic;
$amount = 0;

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
		$client_email = $row['email'];
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

                    <div id="navbar_options" class="navbar-brand "><a href="requests.php">Service Requests</a></div>

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

			    
				<script>
						function slide( x,  y){

						  var slider = document.getElementById(x);
						  var output = document.getElementById(y);
						  output.innerHTML = slider.value;

						  slider.oninput = function() {
						    output.innerHTML = this.value;
						    }
						}
						function open_form(x){
							var a = document.getElementById(x);

							if (a.style.display === "none") {
							    a.style.display = "block";
							  } else {
							    a.style.display = "none";
							  }

						}
						</script>
			</div>

			<div id="client_home_bottom">
				<div class="market">
				  <!-- Title -->
				  <div class="title">
				    Properties For Sale
				    <p>Make Offers, Wait for approval and buy your dream house!</p>
				  </div>
				 
				  <?php 
					$s1 = "SELECT property.* FROM `wishlist` JOIN property ON property.property_id = wishlist.property_id WHERE `client_id`='$client_id' ORDER BY property_name";
					$r1 = mysqli_query($con, $s1);

					//if there are any wishes in db
					if(mysqli_num_rows($r1) > 0)
					{
						while($row = mysqli_fetch_assoc($r1))
						{
							$property_name = $row['property_name'];
							$property_id = $row['property_id'];
							$price = $row['price'];
							$location = $row['location'];
							$category = $row['category'];
							$wish_pic = $row['room1'];
							$baths = $row['bathrooms'];
							$beds = $row['bedrooms'];

							$s3 = "SELECT amount FROM bid WHERE property_id = '$property_id'";
							$r3 = mysqli_query($con, $s3);
							if(mysqli_num_rows($r3) > 0)
							{
								$bids = mysqli_num_rows($r3);

								if($bids = 1)
								{
									$bc = "Offer";
								}
								else if($bids > 1)
								{
									$bc = "Offers";
								}
							}
							else
							{
								$bids = 0;
								$bc = "Offers";
							}
							

							$s2 = "SELECT bid_id, bid_approval, MAX(amount) AS amount, date_approved  FROM bid WHERE client_id = '$client_id' AND property_id = '$property_id'";
							$r2 = mysqli_query($con, $s2);

							if(mysqli_num_rows($r2) > 0)
							{
								while($row = mysqli_fetch_assoc($r2))
								{
									$bid_id = $row['bid_id'];
									$set_bid = $row['amount'];
									$status = $row['bid_approval'];

									if($status == 'yes')
										{
											$st = "display: block;color: #2e74b5;";
											$apr = "Approved";
											$pay_btn = "block";
										}
										else
										{	
											$st = "color: #868a8a;";
											$apr = "Not Approved";
											$pay_btn = "none";
										}
									date_default_timezone_set("Africa/Nairobi");

									$sq = "SELECT * FROM bid WHERE bid_id= '$bid_id'";
									$rs = mysqli_query($con, $sq);

									if(mysqli_num_rows($rs) > 0)
									{
									  while($row = mysqli_fetch_assoc($rs))
									  {
									    $date_made = $row['date_made'];
									    $expiry_date = $row['approval_expiry']; 
									  }
									  $date_made = strtotime($date_made);
									$currentTime = new DateTime($expiry_date);
									$expirationTime = new DateTime(date("Y-m-d H:i:s",$date_made));

									$countdown = $currentTime->diff($expirationTime);
									$countdown1 = $countdown->format("%a days");
									//echo $countdown1;
								
							}
							else
							{
								$set_bid = 0;
							}
						}

							
							}


							
							
							echo "<div class='item'>
									     
									    <div class='image'>
									      <img src='".$wish_pic."' alt='No pic'>
									    </div>
									 
									    <div class='description'>
										    <form action='display_property.php' method='post'>
											    <input type='hidden' name='pid' value='".$property_id."' >
											    <button class='clear-btn' title='View ".$property_name."'><strong>".$property_name."</strong></button>
											    <p style='color:#8d9aa6;'>".$location."</p>
											    <p>Ksh. ".$price."</p>
											    <p  >".$beds." beds <strong>|</strong> ".$baths." baths</p>
											    <p style='font-size: 16px; color: #868a8a;' >".$bids." ".$bc." made.</p>
											    </form>
											    <form action='wishlist.php' method='post'>
											    	<input type='hidden' name='pid' id='pid' Value='".$property_id."'>
						      		 				<input type='hidden' name='state' id='state' value='remove'>
						      		 				<button title='Remove From Offers List' style='width: 30px; height: 30px' class='clear-btn'><i class='fa-solid fa-circle-minus'></i></button>
											    </form>
										      
									    </div>

									    <div class='bid'>
									    	<p><strong>Offers Made</strong></p>
											<br>
											<p>Ksh. ".$set_bid."</p>
											<p>
												<form action='remove_bid.php' method='post' style='width: fit-content;margin: auto;'>
												<input type='hidden' name='pid' value='".$property_id."'>
												<input type='submit' value='Revoke Offer' style='border: none;background: inherit;color: #e24d2b;'>
												</form>
											</p>
											<p <p style='".$st."font-size: 16px; padding:7px;'>".$apr."</p>
											<a href='../payment/payment.php' style='display:".$pay_btn."' id='pay-btn'>Pay</a>
											<p style='display:".$pay_btn.";' id='bid-note'>You have <strong>".$countdown1."</strong> to complete your purchase before <strong>".$property_name."</strong> is put back on the market.</p>
										
										</div>
										<div class='bid' style='padding-top:20px'>
									      <form action='bid.php' method='post'>
										      <label for='amount'><strong>Make A New Offer</strong></label>
										      <br>
										      <input type='int' name='amount' id='amount' value='".$price."'>
										      <button name='bid-btn' id='bid-btn' style='width:40%; padding:6px; margin: 20px 30%;'>Make Offer</button>

										      <input type='hidden' name='pid' value='".$property_id."' >
										      <input type='hidden' name='cid' value='".$client_id."' >
										  </form>
									      
									    </div>
									  </div>";

						}

	
					}
					?>

				  
				 
				 </div>	

				 <div class="market">
				  <!-- Title -->
				  <div class="title">
				    Rentals
				  </div>
				 
				  <?php 
					$s12 = "SELECT * FROM rentals WHERE `client_id`='$client_id'";
					$r12 = mysqli_query($con, $s12);

					//if there are any wishes in db
					if(mysqli_num_rows($r12) > 0)
					{
						while($row = mysqli_fetch_assoc($r12))
						{
							$rental_name = $row['rental_name'];
							$rental_id = $row['rental_id'];
							$rental_price = $row['rental_price'];
							$rental_location = $row['rental_location'];
							$category = $row['category'];
							$baths = $row['bathrooms'];
							$beds = $row['bedrooms'];
							$rental_status = $row_['rental_status'];
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
											    <p style='font-size: 16px; color: #868a8a;' >Rent Paid: ".$rental_status."</p>
										    </form>  
									    </div>

									    								      
									    </div>
									  </div>";

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


		</div>

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
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">Third-Wheel Avenue, Kileleshwa</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">nyumbazetuke@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
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