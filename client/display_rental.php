<?php 
require_once "../config.php";
session_start();
$client_id = $_SESSION['client_id'];
$client_name = $_SESSION['client_name'];
$a1 = $a2 = $a3 = $a4 = $a5 = '';
if(isset($_POST['rid']))
{
	$rental_id = $_POST['rid'];
}


$sql = "SELECT * FROM rentals WHERE rental_id = '$rental_id'";
$rs = mysqli_query($con, $sql);

if(mysqli_num_rows($rs) > 0)
{
	while($row = mysqli_fetch_assoc($rs))
	{
		$rental_name = $row["rental_name"];
		$price = $row["rental_price"];
		$location = $row["rental_location"];
		$category = $row["category"];
		$owner_id = $row["owner_id"];
		$occupied = $row['occupied'];
		$bedrooms = $row["bedrooms"];
		$bathrooms = $row['bathrooms'];
		$owner_id = $row['owner_id'];
		$room1 = $row["room1"];
		$room2 = $row["room2"];
		$room3 = $row["room3"];
		$room4 = $row["room4"];
		$room5 = $row["room5"];
		$a1 = $row['amenity1'];
		$a2 = $row['amenity2'];
		$a3 = $row['amenity3'];
		$a4 = $row['amenity4'];
		$a5 = $row['amenity5'];

		if($category == 'Apartment')
		{
			$icon = "<i class='fa-solid fa-building'></i>";
		}

		else if($category == 'Bungalow' || $category == 'Farm House'|| $category == 'Mansion' || $category == 'Cabin' )
		{
			$icon = "<i class='fa-solid fa-house'></i>";
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

		$sql4 = "SELECT broker_name, broker_phone_number, broker_email, broker_pic FROM broker WHERE broker_id='$broker_id'";
		$result4 = mysqli_query($con, $sql4);

		if(mysqli_num_rows($result4) > 0)
		{
			while($row = mysqli_fetch_assoc($result4))
			{
				$broker_name = $row['broker_name'];
				$broker_phone = $row['broker_phone_number'];
				$broker_email = $row['broker_email'];
				$broker_pic = $row['broker_pic'];
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $rental_name ?></title>
	<link rel="stylesheet" type="text/css" href="../repms2.css">
	<link href="../Nyumba Zetu/css/styles.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="client.css">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    	
		button {
		  border: none;
		  outline: 0;
		  display: inline-block;
		  padding: 8px;
		  color: white;
		  background-color: #000;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		  font-size: 18px;
		}

		a {
		  text-decoration: none;
		  font-size: 22px;
		  color: black;
		}

		button:hover, a:hover {
		  opacity: 0.7;
		}	
		.w3-container::after, .w3-container::before, .w3-panel::after, .w3-panel::before, .w3-row::after, .w3-row::before, .w3-row-padding::after, .w3-row-padding::before, .w3-cell-row::before, .w3-cell-row::after, .w3-clear::after, .w3-clear::before, .w3-bar::before, .w3-bar::after
		{
			content: none !important;
		}
    </style>
</head>
<body>
	<div class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" >                
                    
        <div id="navbar_options" class="navbar-brand "><a title="Nyumba Zetu" style="font-size: 1.5em;" href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
        <div id="navbar_options" class="navbar-brand "><a href="client_home.php">My Page</a></div>
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
     	
    	<div id="rental-slides">

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

			<div id="rental-info " style="width: 50%; display: inline-block;margin: 30px;">
				<div class="w3-card-4">
				    <header class="w3-container w3-black">
				      <h1><?php echo $rental_name ?></h1>
				    </header>

				    <div class="w3-container">
				      <p><?php echo $rental_name ?> is a luxurious <?php echo $bedrooms ?> bedroom <?php echo $category ?> in <?php echo $location ?>. It has <?php echo $bathrooms ?> bathrooms.</p>
				      <h3>Ksh. <?php echo $price ?> per month.</h3>
				      <p><?php echo $icon." ".$category ?></p>
				      <p><i class="fa-solid fa-bed"></i> <?php echo $bedrooms ?> bedrooms</p>
				      <p><i class="fa-solid fa-bath"></i> <?php echo $bathrooms ?> bathrooms</p>
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


			<div id="rental-form">
				<form action="inquire.php" method="post" class="w3-container w3-card-4 w3-white w3-text-black w3-margin">
					<h2 class="w3-center">Contact <?php echo $broker_name ?></h2>
					 
					<div class="w3-row w3-section">
					  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
					    <div class="w3-rest">
					      <input class="w3-input w3-border" name="first" type="text" placeholder="Full Name">
					    </div>
					</div>

					<div class="w3-row w3-section">
					  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa-solid fa-at"></i></div>
					    <div class="w3-rest">
					      <input class="w3-input w3-border" name="email" type="text" placeholder="Email">
					    </div>
					</div>

					<div class="w3-row w3-section">
					  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
					    <div class="w3-rest">
					      <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone">
					    </div>
					</div>

					<div class="w3-row w3-section">
					  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
					    <div class="w3-rest">
					    	<textarea class="w3-input w3-border" name="message" id="message" placeholder="Message"></textarea>
					    </div>
					</div>

					<button class="w3-button w3-block w3-section w3-black w3-text-white w3-ripple w3-padding">Send</button>

				</form>
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