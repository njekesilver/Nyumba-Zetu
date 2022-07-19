<?php
require_once "../config.php";
session_start();
$client_id = $_SESSION['client_id'];
$client_name = $_SESSION['client_name'];
$highest_bid = $owner_name = $broker_name = $broker_phone = $broker_email = $a1 = $a2 = $a3 = $a4 = $a5 = "";
if(isset($_POST['pid']))
{
	$property_id = $_SESSION['property_id'] = $_POST['pid'] ;
}
else
{
	$property_id = $_SESSION['property_id'];
}
$state; $property_name;
$sql = "SELECT * FROM property WHERE property_id = '$property_id'";
$result = mysqli_query($con, $sql);

//selects property details
if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$property_name = $row["property_name"];
			$property_id = $row['property_id'];
			$price = $row["price"];
			$location = $row["location"];
			$category = $row["category"];
			$owner_id = $row["owner_id"];
			$bedrooms = $row["bedrooms"];
			$bathrooms = $row['bathrooms'];
			$owner_id = $row['owner_id'];
			$room1 = $row["room1"];
			$room2 = $row["room2"];
			$room3 = $row["room3"];
			$room4 = $row["room4"];
			$room5 = $row["room5"];

			if($category == 'Apartment')
			{
				$icon = "<i class='fa-solid fa-building'></i>";
			}

			else if($category == 'Bungalow' || $category == 'Farm House'|| $category == 'Mansion' || $category == 'Cabin' )
			{
				$icon = "<i class='fa-solid fa-house'></i>";
			}

			$ss = "SELECT amount FROM bid WHERE property_id='$property_id'";
			$rr = mysqli_query($con, $ss);

			if(mysqli_num_rows($rr) > 0)
			{
				$bid_count = mysqli_num_rows($rr);
				if($bid_count = 0)
				{
					$bss = "No bids made yet.";
				}
				else if($bid_count = 1)
				{
					$bss = " bid made.";
				}
				else if($bid_count > 1)
				{
					$bss = " bids made.";
				}
			}
			//check if property is in favourites for bidding
			$sss = "SELECT * FROM wishlist WHERE property_id='$property_id' AND client_id='$client_id'";
			$rrr = mysqli_query($con, $sss);

			//if($rrr)//if property is in wishlist show thumbs-dowm
			//{
				if(mysqli_num_rows($rrr) > 0)
				{
					$bid_btn = "<form action='wishlist.php' method='post'>
						      		<input type='hidden' name='pid' id='pid'
						      		 value='".$property_id."'>
						      		 <input type='hidden' name='state' id='state' value='liked'>
						      		<button title='Remove From Bid List' style='background-color: transparent; width: fit-content; border: none;'><i style='color: black; width: 50px; height: 50px;' class='fa-solid fa-thumbs-down'></i></button>
						      	</form>";
				}
			
			else //if not in wishlist then put thumbs-up
			{
				$bid_btn = "<form action='wishlist.php' method='post'>
					      		<input type='hidden' name='pid' id='pid'
					      		 value='".$property_id."'>
					      		 <input type='hidden' name='state' id='state' value='disliked'>
					      		<button title='Add to Bid List' style='background-color: transparent; width: fit-content; border: none;'><i style='color: black; width: 50px; height: 50px;' class='fa-solid fa-thumbs-up'></i></button>
					      	</form>";
			}

			$ss1 = "SELECT MAX(amount) AS highest_bid FROM bid WHERE property_id='$property_id'";
			$rr1 = mysqli_query($con, $ss1);
			if(mysqli_num_rows($rr1) > 0)
			{
				while($row_= mysqli_fetch_assoc($rr1))
				{
					$highest_bid = $row['highest_bid'];
				}
			}

		}
	}



	$sql3 = "SELECT * FROM `owner`JOIN broker ON owner.broker_id=broker.broker_id WHERE `owner_id`='$owner_id'";
	$result3 = mysqli_query($con, $sql3);

	if(mysqli_num_rows($result3) > 0)
	{
		while($row = mysqli_fetch_assoc($result3))
		{
			$owner_name = $row["owner_name"];
			$owner_pic = $row['owner_pic'];
			$broker_id = $row['broker_id'];

		}

		$sql4 = "SELECT broker_name, broker_phone_number, broker_email FROM broker WHERE broker_id='$broker_id'";
		$result4 = mysqli_query($con, $sql4);

		if(mysqli_num_rows($result4) > 0)
		{
			while($row = mysqli_fetch_assoc($result4))
			{
				$broker_name = $row['broker_name'];
				$broker_phone = $row['broker_phone_number'];
				$broker_email = $row['broker_email'];
			}
		}
	}





?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $property_name ?></title>
	<link rel="stylesheet" type="text/css" href="../repms2.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script type="text/javascript" src="../repms.js"></script>
	<link href="../Nyumba Zetu/css/styles.css" rel="stylesheet" />
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="client.css">
	<style type="text/css">
		#one1 button, #two button
		{
			background-color: white;
			border: none;
		}

		
	</style>
</head>
<body>
	
	<div class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" >                
                    
        <div id="navbar_options" class="navbar-brand "><a title="Nyumba Zetu" style="font-size: 1.5em;" href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
        <div id="navbar_options" class="navbar-brand "><a href="display.php">For Sale</a></div>
        <div id="navbar_options" class="navbar-brand "><a href="rentals.php">Rentals</a></div>
        <div id="navbar_options" class="navbar-brand "><a href="#contact_info">Contact Us</a></div>

        <div id="navbar_options" class="navbar-brand "><a href="settings.php">Settings</a></div>

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

     <!-- Slideshow -->
     <div class="rental-rental">
     	
    	<div id="rental-slides" style="padding: 15px;">

			<div class="w3-content" style="max-width:1200px">
			  <img class="mySlides" src="<?php echo $room1 ?>" style="width:100%">
			  <img class="mySlides" src="<?php echo $room2 ?>" style="width:100%;display:none">
			  <img class="mySlides" src="<?php echo $room3 ?>" style="width:100%;display:none">
			  <img class="mySlides" src="<?php echo $room4 ?>" style="width:100%;display:none">
			  <img class="mySlides" src="<?php echo $room5 ?>" style="width:100%;display:none">

			  <div class="w3-row-padding w3-section">
				    <div class="w3-col s4">
				      <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $room1 ?>" style="width:100%;cursor:pointer" onclick="currentDiv(1)">
				    </div>
				    <div class="w3-col s4">
				      <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $room2 ?>" style="width:100%;cursor:pointer" onclick="currentDiv(2)">
				    </div>
				    <div class="w3-col s4">
				      <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $room3 ?>" style="width:100%;cursor:pointer" onclick="currentDiv(3)">
				    </div>
				    <div class="w3-col s4">
				      <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $room4 ?>" style="width:100%;cursor:pointer" onclick="currentDiv(4)">
				    </div>
				    <div class="w3-col s4">
				      <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $room5 ?>" style="width:100%;cursor:pointer" onclick="currentDiv(5)">
				    </div>
			  </div>
			</div>

			<script>
				function currentDiv(n) {
				  showDivs(slideIndex = n);
				}

				function showDivs(n) {
				  var i;
				  var x = document.getElementsByClassName("mySlides");
				  var dots = document.getElementsByClassName("demo");
				  if (n > x.length) {slideIndex = 1}
				  if (n < 1) {slideIndex = x.length}
				  for (i = 0; i < x.length; i++) {
				    x[i].style.display = "none";
				  }
				  for (i = 0; i < dots.length; i++) {
				    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
				  }
				  x[slideIndex-1].style.display = "block";
				  dots[slideIndex-1].className += " w3-opacity-off";
				}
			</script>
			     
			     	
		</div>
		<div id="rental-data">

			<div id="rental-info " style="width: 50%; display: inline-block;">
				<div class="w3-card-4" style="margin-bottom: 80px;">
				    <header class="w3-container w3-black">
				      <h1><?php echo $property_name ?></h1>
				    </header>

				    <div class="w3-container">
				      <p><?php echo $property_name ?> is a luxurious <?php echo $bedrooms ?> bedroom <?php echo $category ?> in <?php echo $location ?>. It has <?php echo $bathrooms ?> bathrooms.</p>
				      <h3>Ksh. <?php echo $price ?> </h3>
				      <br>
				      <p><?php echo $icon." ".$category ?></p>
				      <p><i class="fa-solid fa-bed"></i> <?php echo $bedrooms ?> bedrooms</p>
				      <p><i class="fa-solid fa-bath"></i> <?php echo $bathrooms ?> bathrooms</p>
				      <p><i class="fa-solid fa-signs-post"></i> <?php echo $bid_count.$bss ?></p>
				      <p>Highest bid made: <?php echo $highest_bid ?></p>
				      <div>
				      	<?php echo $bid_btn ?>
				      </div>

				      <p><?php echo $a1 ?></p>
				      <p><?php echo $a2 ?></p>
				      <p><?php echo $a3 ?></p>
				      <p><?php echo $a4 ?></p>
				      <p><?php echo $a5 ?></p>


				    </div>

				    <footer class="w3-container w3-black">
				      
				    </footer>
				  </div>
			</div>
				
			<div id="rental-broker">
				 	
				<div class="card">
					<img src="<?php echo $broker_pic ?>" alt=" " style="width:100%">
					<h1><?php echo $broker_name ?></h1>
					<p class="title">Property Broker</p>
					<div style="margin: 24px 0;">
					    <p><?php echo $broker_email ?></p>
					    <p>+254 <?php echo $broker_phone ?></p> 
					</div>
					
				</div>	
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