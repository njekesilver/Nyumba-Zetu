<?php 
require_once '../config.php';
session_start();

if(isset($_SESSION['client_id']) && isset($_SESSION['client_name']))
{
    $client_id = $_SESSION['client_id'];
    $client_name = $_SESSION['client_name'];
}
else
{
    echo "<script>alert('Login First!')</script>";
    header("location: ../Nyumba Zetu/homepage.php");
}
$client_id = $_SESSION['client_id'];
$client_name = $_SESSION['client_name'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../repms2.css">
    <link href="../Nyumba Zetu/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="text/javascript" src="../repms.js"></script>
    <title>View Properties</title>
    <style>
        .display-btn
        {
            background-color: inherit;
            border: none;
            font-size: 20px !important;
            color: black !important;
            font-weight: bold;
        }
        .sort-btns
        {
            width: fit-content;
            margin: auto;
            padding: 10px
        }
        #sort-btn
        {
            display: flex inline;
            padding: 1em; 
        }
        .radio-x
        {
            width: 20px;
        }
        #sort-btn label
        {
            font-size: 1.25em;
        }
    </style>
</head>
<body>
    <div id="nn">
            
        <div class="navbar" >                
                    
            <div id="navbar_options"><a title="Nyumba Zetu"  href="../Nyumba Zetu/homepage.php">Nyumba Zetu</a></div>
            <div id="navbar_options"><a class="active" href="display.php" title="Property Listings">For Sale</a></div>
            <div id="navbar_options"><a title='Rentals' href="rentals.php">Rentals</a></div>
            <div id="navbar_options"><a href="client_home.php#contact_info" title="Contact Us">Contact Us</a></div>

            <div id="navbar_options"><a title="Open Settings" href="settings.php">Settings</a></div>

            <div id="navbar_options" ><a href="logout.php"  title="Logout"><?php echo $client_name ?></a></div>
            <div id="navbar_options" >
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
    
        </div>
        <br>

    <div class="sort-btns">
        <h5 style="text-align:center">Sort By: </h5>

        <div id="sort-btn">
            <input class="radio-x" type="radio" name="sort-btns" id="by-name" onclick="sort()">
            <label for="by-name">Property Name</label>
        </div>
        <div id="sort-btn">
            <input class="radio-x" type="radio" name="sort-btns" id="by-price-low" onclick="sort()">
            <label for="by-price-low">Price - Lowest</label>
        </div>
        <div id="sort-btn">
            <input class="radio-x" type="radio" name="sort-btns" id="by-price-high" onclick="sort()">
            <label for="by-price-high">Price - Lowest</label>
        </div>
        <div id="sort-btn">
            <input class="radio-x" type="radio" name="sort-btns" id="by-location" onclick="sort()">
            <label for="by-location">Location</label>
        </div>
    </div>

    <div id="property_listings" style="display: block; width: 80%; margin: auto;">
            
            <?php 
            
            $sql = "SELECT * FROM rentals ORDER BY rental_name";

                $result = mysqli_query($con, $sql);


                if(mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $picture_url = $row["room1"];
                            $rental_id = $row["rental_id"];

                            
                            echo "<div class='w3-container' style='width: 50%; display: inline-block; padding: 1em 16px !important;'>
                                  
                                  <div class='w3-card-4' style='width:100%'>
                                    <form action='display_rental.php' method='post'>
                                        <input type='hidden' id='rid' name='rid' value='". $rental_id ."'>
                                        <img src='".$picture_url."' alt='' style='width:100%;max-height: 400px;object-fit: cover;'>
                                        <div class='w3-container w3-center' style='text-align: center !important'>
                                          <h3><strong>".$row['rental_name']."</strong></h3>
                                          <p>Ksh. ".$row['rental_price']."</p>
                                          <p style='color: gray;'>".$row['rental_location']."</p>
                                        </div>
                                        <div class='w3-center style='width: fit-content;margin: auto;'>
                                            <button class='display-btn w3-center'>View</button>
                                            </div>
                                    </form>
                                  </div>
                                </div>";
                        }
                    }
            ?>
            
    

        </div>
</body>
</html>