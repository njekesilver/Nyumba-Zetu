<?php

date_default_timezone_set("Africa/Nairobi");

$sq = "SELECT * FROM bid WHERE bid_id= 20";
$rs = mysqli_query($con, $sq);

if(mysqli_num_rows($rs) > 0)
{
  while($row = mysqli_fetch_assoc($rs))
  {
    $date_made = $row['date_made'];
    $expiry_date = $row['approval_expiry']; 
  }
}


$date_made = strtotime($date_made);
$currentTime = new DateTime($expiry_date);
$expirationTime = new DateTime(date("Y-m-d H:i:s",$date_made));

$countdown = $currentTime->diff($expirationTime);
$countdown1 = $countdown->format("%a days");
print_r($countdown1);die;

echo "<br>";
echo $expirationTime;
?>